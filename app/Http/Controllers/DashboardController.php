<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $data['services']                       =       Service::where('is_laser_option',0)->get();
        $data['laserHairRemovalOptions']        =       Service::where('is_laser_option',1)->get();

        return view('index',$data);
    }

    public function about()
    {
        $data['laserHairRemovalOptions']        =       Service::where('is_laser_option',1)->get();
        return view('aboutPage',$data);
    }

    public function contact()
    {
        $data['laserHairRemovalOptions']        =       Service::where('is_laser_option',1)->get();
        return view('contactPage',$data);
    }

    public function service()
    {
        $data['services']                       =       Service::where('is_laser_option',0)->get();
        $data['laserHairRemovalOptions']        =       Service::where('is_laser_option',1)->get();
        return view('servicesPage',$data);
    }

    public function laserServiceDetail($id)
    {
        $data['laserService']                   =       Service::where('is_laser_option',1)->where('id',$id)->first();
        if(empty($data['laserService']))
        {
            Session::flash('error','Data not found');
            return redirect(route('dashboard'));
        }
        $data['laserHairRemovalOptions']        =       Service::where('is_laser_option',1)->get();

        return view('laserServiceDetail',$data);
    }
}
