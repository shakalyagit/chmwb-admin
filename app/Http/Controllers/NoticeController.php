<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Notice;
use App\Models\NoticeType;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NoticeController extends Controller
{
    public function notice_list()
    {
        $notice_types = NoticeType::get();
        $notices = Notice::leftjoin('notice_types', 'notice_types.id', '=', 'notices.notice_type_id')
            ->leftjoin('media', 'media.ref_id', '=', 'notices.id')
            ->select('notices.*', 'notice_types.notice_type', 'media.file_path')
            ->where('notices.status', 'Publish')
            ->where('notices.publish_date_time', '<=', Carbon::now())
            ->orderBy('notices.id', 'desc')
            ->paginate(25);
        return view('admin.notice.notice_list', compact('notices', 'notice_types'));
    }

    public function add_notice()
    {
        $notice_types = NoticeType::get();
        return view('admin.notice.add', compact('notice_types'));
    }

    public function add_notice_action(Request $request)
    {
        $request->validate([
            'notice_type'    => 'required',
            'notice_subject' => 'required|string|max:255',
            'document'       => 'required|file|mimes:jpg,png,pdf,doc,docx|max:2048|max:2048',
            'datetime'       => 'required|date',
            'notice_body'    => 'required|string',
            'status'         => 'required|in:Publish,Unpublish',
        ]);

        DB::beginTransaction();

        try {
            // Insert into notices table
            $notice = new Notice();
            $notice->notice_type_id    = $request->notice_type;
            $notice->notice_subject = $request->notice_subject;
            $notice->publish_date_time       = $request->datetime;
            $notice->notice_body    = $request->notice_body;
            $notice->status         = $request->status;
            $notice->save();

            // Handle File Upload
            if ($request->hasFile('document')) {

                $file = $request->file('document');

                $fileName = rand(111111, 999999) . '.' . $file->getClientOriginalExtension();

                $destinationPath = 'assets/notices';

                // Create folder if not exists
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                // Move file
                $file->move($destinationPath, $fileName);

                $filePath = 'assets/notices/' . $fileName;

                // Insert into media table
                $media = new Media();
                $media->ref_id = $notice->id;
                $media->ref_table = 'notices';
                $media->file_name = $fileName;
                $media->file_type = $file->getClientMimeType();
                $media->file_path = $filePath;
                $media->save();
            }

            DB::commit();
            return redirect()->route('notice_list')->with('success', 'Notice added successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit_notice($id)
    {
        $id = Crypt::decrypt($id);

        $notice = Notice::leftJoin('media', function ($join) {
            $join->on('media.ref_id', '=', 'notices.id')
                ->where('media.ref_table', 'notices');
        })
            ->where('notices.id', $id)
            ->select('notices.*', 'media.file_path', 'media.media_id')
            ->first();

        $notice_types = NoticeType::all();

        return view('admin.notice.edit', compact('notice', 'notice_types'));
    }

    public function update_notice(Request $request)
    {
        $request->validate([
            'notice_id'      => 'required',
            'notice_type'    => 'required',
            'notice_subject' => 'required|string|max:255',
            'document'       => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'datetime'       => 'required|date',
            'notice_body'    => 'required|string',
            'status'         => 'required|in:Publish,Unpublish',
        ]);

        DB::beginTransaction();

        try {

            $notice = Notice::findOrFail($request->notice_id);

            // Update notice
            $notice->notice_type_id = $request->notice_type;
            $notice->notice_subject = $request->notice_subject;
            $notice->publish_date_time = $request->datetime;
            $notice->notice_body = $request->notice_body;
            $notice->status = $request->status;
            $notice->save();

            // Check existing media
            $media = Media::where('ref_id', $notice->id)
                ->where('ref_table', 'notices')
                ->first();

            // If new file uploaded
            if ($request->hasFile('document')) {

                $file = $request->file('document');

                $fileName = $notice->id . '_' . rand(11111111, 99999999) . '.' . $file->getClientOriginalExtension();

                $destinationPath = 'assets/notices';

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                // Delete old file
                if ($media && File::exists($media->file_path)) {
                    File::delete($media->file_path);
                }

                // Upload new file
                $file->move($destinationPath, $fileName);

                $filePath = 'assets/notices/' . $fileName;

                if ($media) {
                    // Update existing
                    $media->file_name = $fileName;
                    $media->file_type = $file->getClientMimeType();
                    $media->file_path = $filePath;
                    $media->save();
                } else {
                    // Insert new
                    $newMedia = new Media();
                    $newMedia->ref_id = $notice->id;
                    $newMedia->ref_table = 'notices';
                    $newMedia->file_name = $fileName;
                    $newMedia->file_type = $file->getClientMimeType();
                    $newMedia->file_path = $filePath;
                    $newMedia->save();
                }
            }

            DB::commit();
            return redirect()->route('notice_list')->with('success', 'Notice updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function notice_filter(Request $request)
    {
        $query = Notice::leftJoin('notice_types', 'notice_types.id', '=', 'notices.notice_type_id')
            ->leftJoin('media', function ($join) {
                $join->on('media.ref_id', '=', 'notices.id')
                    ->where('media.ref_table', 'notices');
            })
            ->select('notices.*', 'notice_types.notice_type', 'media.file_path');

        // Filters
        if ($request->notice_type) {
            $query->where('notices.notice_type_id', $request->notice_type);
        }

        if ($request->from_date) {
            $query->whereDate('notices.publish_date_time', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->whereDate('notices.publish_date_time', '<=', $request->to_date);
        }

        $notices = $query->orderBy('notices.id', 'desc')
            ->paginate(25)
            ->appends($request->all());

        // Table HTML
        $html = '';
        if ($notices->count()) {
            foreach ($notices as $notice) {

                $fileLink = $notice->file_path
                    ? '<a href="' . asset($notice->file_path) . '" target="_blank">
                        <i class="bi bi-file-earmark-arrow-down fs-8"></i>
                   </a>'
                    : 'No File';

                $statusBadge = $notice->status == 'Publish'
                    ? '<span class="bg-success-subtle pt-1 pb-1 ps-3 pe-3 rounded rounded-pill border border-success text-success">Publish</span>'
                    : '<span class="bg-danger-subtle pt-1 pb-1 ps-3 pe-3 rounded rounded-pill border border-danger text-danger">Unpublish</span>';

                $html .= '
                <tr>
                    <td>' . $notice->id . '</td>
                    <td>' . $notice->notice_type . '</td>
                    <td>' . $notice->notice_subject . '</td>
                    <td>' . $fileLink . '</td>
                    <td>' . $notice->publish_date_time . '</td>
                    <td>' . $statusBadge . '</td>
                    <td>
                        <a href="' . route('edit_notice', Crypt::encrypt($notice->id)) . '" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                </tr>
            ';
            }
        } else {
            $html = '<tr><td colspan="7" class="text-center">No record Found</td></tr>';
        }

       $pagination = $notices->links('pagination::bootstrap-5')->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
            'pagination' => $pagination
        ]);
    }
}
