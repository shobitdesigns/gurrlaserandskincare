<?php

namespace App\Http\Controllers\cms;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentResponseMail;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Appointment::select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status',function($data){
                    if($data->status == 'rejected')
                    {
                        return '<span class="badge badge-danger">'. ucfirst($data->status) .'</span>';
                    }elseif($data->status == 'approved'){
                        return '<span class="badge badge-success">'. ucfirst($data->status) .'</span>';
                    }else{
                        return '<span class="badge badge-warning">'. ucfirst($data->status) .'</span>';
                    }
                })->editColumn('action', function ($data) {
                    $editUrl        =   route('appointment.edit', ['appointment' => $data->id]);
                    $btn            =   '<div class="row">';
                    $btn            .=  '<a href="' . $editUrl . '"><i class="fa fa-edit"></i></a>';
                    $btn            .=  '</div>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('cms.appointment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $appointment                    =       new Appointment();
        $appointment->name              =       $request->name;
        $appointment->email             =       $request->email;
        $appointment->date              =       $request->date;
        $appointment->location          =       $request->location;
        $appointment->laser_service     =       $request->laser_service;
        $appointment->time              =       $request->time;
        $appointment->status            =       'pending';
        $appointment->save();
        // Mail::to('laserbygurr@gmail.com')->send(new EnquiryMail($enquiry));

        return back()->with('success','Appointment Submitted');
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
        $data['object']         =       Appointment::find($id);
        if(empty($data['object']))
        {
            Session::flash('error','Data not found');
            return redirect(route('appointment.index'));
        }

        $data['method']         =       'PUT';
        $data['url']            =       route('appointment.update',['appointment'=>$id]);
        $data['status']         =       ['approved'=>'Approved','rejected'=>'Rejected','pending'=>'Pending'];

        return view('cms.appointment.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'reason' => 'required_if:status,rejected',
        ]);

        $appointment        =       Appointment::find($id);
        if(empty($appointment))
        {
            Session::flash('error','Data not found');
            return redirect(route('appointment.index'));
        }

        $appointment->status        =       $request->status;
        $appointment->reason        =       $request->reason;
        $appointment->update();
        Mail::to($appointment->email)->send(new AppointmentResponseMail($appointment));

        return redirect()->route('appointment.index')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function checkAppointment(Request $request)
    {
        $date = $request->input('date');
        $time = $request->input('time');

        $appointmentExists = Appointment::where('date', $date)
            ->where('time', $time)
            ->where('status', 'approved')
            ->exists();

        return response()->json(['available' => !$appointmentExists]);
    }
}
