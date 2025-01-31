<?php

namespace App\Http\Controllers\cms;

use App\Models\Enquiry;
use App\Mail\EnquiryMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EnquiryRequest;
use Yajra\DataTables\Facades\DataTables;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Enquiry::select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('cms.enquiry.index');
    }

    public function storeEnquiry(EnquiryRequest $request)
    {
        $enquiry                    =       new Enquiry();
        $enquiry->name              =       $request->name;
        $enquiry->email             =       $request->email;
        $enquiry->date              =       $request->date;
        // $enquiry->looking_for       =       $request->looking_for;
        // $enquiry->treatment_for     =       $request->treatment_for;
        $enquiry->location          =       $request->location;
        $enquiry->save();

        // Mail::to('laserbygurr@gmail.com')->send(new EnquiryMail($enquiry));

        return redirect(route('dashboard'));
    }
}
