<?php

namespace App\Http\Controllers\cms;

use Carbon\Carbon;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ServiceRequest;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data       =       Service::select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('price', function ($data){
                    return '$ '.$data->price;
                })
                ->addColumn('action', function ($data) {
                    $editUrl    = route('service.edit', ['service' => $data->id]);
                    $deleteUrl  = route('service.destroy', ['service' => $data->id]);
                    $btn        = '<div class="row">';
                    $btn        .= '<a href="' . $editUrl . '"><i class="fa fa-edit"></i></a>';
                    $btn        .= '<a style="cursor: pointer;" onclick="deleteItem(\'' . $deleteUrl . '\')">
                                    <i class="fa fa-trash text-danger ml-2"></i>
                                    </a>';
                    $btn        .= '</div>';
                    return $btn;
                })
                ->rawColumns(['price','action'])
                ->make(true);
        }
        return view('cms.service.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['object']     =       new Service();
        $data['method']     =       'POST';
        $data['url']        =       route('service.store');

        return view('cms.service.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $service                    =       new Service();
        $service->name              =       $request->name;
        $service->duration          =       $request->duration;
        $service->price             =       $request->price;
        $service->description       =       $request->description;
        $service->is_laser_option   =       isset($request->is_laser_option) ? 1 : 0;
        if ($request->has("image")) {
            $imageName  = "service_" . Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/services/'), $imageName);
            $service->image         =       $imageName;
        }
        $service->save();
        Session::flash("success", "Service Created");

        return redirect(route("service.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['object']     =       Service::find($id);
        if(empty($data['object']))
        {
            Session::flash('error','Data not found');
            return redirect(route("service.index"));
        }
        $data['method']     =       'PUT';
        $data['url']        =       route('service.update',['service'=>$id]);

        return view('cms.service.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, string $id)
    {
        $service                    =       Service::find($id);
        if(empty($service))
        {
            Session::flash('error','Data not found');
            return redirect(route("service.index"));
        }
        $service->name              =       $request->name;
        $service->duration          =       $request->duration;
        $service->price             =       $request->price;
        $service->description       =       $request->description;
        $service->is_laser_option   =       isset($request->is_laser_option) ? 1 : 0;
        if ($request->has("image")) {
            if (file_exists("uploads/services/" . $service->image)) {
                File::delete("uploads/services/" . $service->image);
            }
            $imageName              =       "service_" . Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/services/'), $imageName);
            $service->image         =       $imageName;
        }
        $service->update();
        Session::flash("success", "Service Updated");

        return redirect(route("service.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service                    =       Service::find($id);
        if(empty($service))
        {
            Session::flash('error','Data not found');
            return back();
        }

        if (file_exists("uploads/services/" . $service->image)) {
            File::delete("uploads/services/" . $service->image);
        }
        $service->delete();
        Session::flash("success", "Service Deleted");

        return  response()->json('Data Deleted',200);
    }
}
