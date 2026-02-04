<?php

namespace App\Http\Controllers;

use App\Models\ApplicationHead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function dashboard(){
        $get_all_application = ApplicationHead::count();
        $status_counts = [
            'total' => $get_all_application,
            'approved' => ApplicationHead::where('status', 'approved')->count(),
            'pending' => ApplicationHead::where('status', 'verifying')->count(),
            'rejected' => ApplicationHead::where('status', 'rejected')->count(),
        ];

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = ApplicationHead::whereMonth('created_at', $i)
                ->whereYear('created_at', date('Y'))
                ->count();
        }
        $chart_data = $data;
        return view('admin.index', compact('status_counts', 'chart_data'));
    }

    public function admin_login(){
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('admin.auth.login');
    }

    public function admin_login_action(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            if ($user->status == 'Active') {
                Auth::login($user);
                return redirect()->intended('dashboard');
            } else {
                return redirect()->route('login')->with('error', 'Your account is not active.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }

    public function logout(){
        session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }

    public function change_password(Request $request){
        $validated = $request->validate(
            [
                'old_password' => 'required|min:8|string',
                'password' => 'required|min:8|string',
                'password_confirmation' => 'required|min:8|same:password',
            ],
            [
                'old_password.required' => 'Old password field is required',
                'password.required' => 'Password field is required',
                'password_confirmation.required' => 'Confirm password field is required',
                'password_confirmation.same' => 'Password & Confirm Password does not match.'
            ]
        );

        $hashed_password = Auth::user()->password;
        if (Hash::check($request->old_password, $hashed_password)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            session()->flash('success', 'Password changed successfully.');
            return response()->json(['success' => true, 'message' => 'Password changed successfully.']);
        } else {
            return response()->json(['error' => true, 'message' => 'Old Password does not match, Please try again.'], 422);
        }
    }
}
