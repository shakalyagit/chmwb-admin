<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Media;
use App\Models\OurServices;
use App\Models\WhyChooseUsWeb;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $get_all_services = OurServices::all();
        $get_wcu = WhyChooseUsWeb::all();
        $portfolio_images = Media::where('media_type', 'portfolio_img')
                                    ->where('ref_table', 'portfolio')
                                    ->orderBy('id', 'desc')
                                    ->take(5)
                                    ->get();
        return view('web.home-page', compact('get_all_services', 'get_wcu','portfolio_images'));
    }

    public function about_us(){
        $get_wcu = WhyChooseUsWeb::all();
        $get_all_services = OurServices::with('media')->get();
        return view('web.about', compact('get_wcu', 'get_all_services'));
    }

    public function services(){
        $get_all_services = OurServices::with('media')->get();
        $get_wcu = WhyChooseUsWeb::all();
        return view('web.services', compact('get_all_services', 'get_wcu'));
    }

    public function contact_us(){
        return view('web.contact');
    }

    public function portfolio(){
        $portfolio_images = Media::where('media_type', 'portfolio_img')
                                ->where('ref_table', 'portfolio')
                                ->get();
        return view('web.portfolio', compact('portfolio_images'));
    }

    public function generate_certificate($id){
        $selectedApplication = \App\Models\ApplicationHead::with(['details','media'])->find($id);
        if (!$selectedApplication) {
            return redirect()->back()->with('error', 'Application not found');
        }
        return view('web.generate-certificate', compact('selectedApplication'));
    }

    public function generate_certificate_2($id){
        $selectedApplication = \App\Models\ApplicationHead::with(['details','media'])->find($id);
        if (!$selectedApplication) {
            return redirect()->back()->with('error', 'Application not found');
        }
        return view('web.generate-certificate_2', compact('selectedApplication'));
    }
    
}
