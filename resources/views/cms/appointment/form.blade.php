@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('appointment.index') }}">Appointment List</a></li>
                        <li class="breadcrumb-item active">Appointment Form</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Appointment Form</h3>
            </div>

            {!! Form::model($object, [
                'method' => $method,
                'url' => $url,
                'onSubmit' => "document.getElementById('submit').disabled=true;"
            ]) !!}
            <input type="hidden" name="id" value="{{ $object->id }}">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-4">
                        {{ Form::label('name', 'Name', []) }}<span style="color: red;"> *</span>
                        {{ Form::text('name', null, ['class' => 'form-control name', 'placeholder' => 'Enter First Name', 'disabled']) }}
                    </div>
                    <div class="form-group col-4">
                        {{ Form::label('email', 'Email', []) }}<span style="color: red;"> *</span>
                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'disabled']) }}
                    </div>
                    <div class="form-group col-4">
                        {{ Form::label('location', 'Location', []) }}<span style="color: red;"> *</span>
                        {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Enter location', 'disabled']) }}
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-3">
                        {{ Form::label('service', 'Service', []) }}<span style="color: red;"> *</span>
                        {{ Form::text('service', null, ['class' => 'form-control laser_service', 'placeholder' => 'Enter First Laser Service', 'disabled']) }}
                    </div>
                    <div class="form-group col-3">
                        {{ Form::label('service_type', 'Service Type', []) }}<span style="color: red;"> *</span>
                        @if($object->is_laser_service == 1)
                            {{ Form::text('service_type', 'Laser Service', ['class' => 'form-control laser_service',  'disabled']) }}
                        @else
                            {{ Form::text('service_type', 'Service', ['class' => 'form-control laser_service',  'disabled']) }}

                        @endif
                    </div>
                    <div class="form-group col-3">
                        {{ Form::label('date', 'Date', []) }}<span style="color: red;"> *</span>
                        {{ Form::text('date', null, ['class' => 'form-control', 'placeholder' => 'Enter Date', 'disabled']) }}
                    </div>
                    <div class="form-group col-3">
                        {{ Form::label('time', 'Time', []) }}<span style="color: red;"> *</span>
                        {{ Form::text('time', null, ['class' => 'form-control', 'placeholder' => 'Enter Time', 'disabled']) }}
                    </div>
                </div>

                @if($object->status == 'pending')
                    <div class="row">
                        <div class="form-group col-4">
                            {{ Form::label('status', 'Status', []) }}<span style="color: red;"> *</span>
                            {{ Form::select('status', $status,null, ['class' => 'form-control', 'placeholder' => 'Select Status', 'required']) }}
                        </div>
                        <div class="form-group col-8" id="reason-group">
                            {{ Form::label('reason', 'Reason', []) }}<span style="color: red;"> *</span>
                            {{ Form::text('reason',null, ['class' => 'form-control', 'placeholder' => 'Enter reason', 'id' => 'reason','required' => false]) }}
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="form-group col-4">
                            {{ Form::label('status', 'Status', []) }}<span style="color: red;"> *</span>
                            {{ Form::text('status', ucfirst($object->status), ['class' => 'form-control', 'placeholder' => 'Enter Status', 'disabled']) }}
                        </div>
                        @if($object->status == 'rejected' && !empty($object->reason))
                            <div class="form-group col-8">
                                {{ Form::label('reason', 'Reason', []) }}<span style="color: red;"> *</span>
                                {{ Form::text('reason', $object->reason, ['class' => 'form-control', 'placeholder' => 'Enter Reason', 'disabled']) }}
                            </div>
                        @endif
                    </div>
                @endif

            </div>
            <!-- /.card-body -->

            @if($object->status == 'pending')
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            @endif
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('footerScript')
    <script>
        $(document).ready(function() {

            if ($('#status').val() === 'approved' || $('#status').val() === 'pending') {
                $('#reason-group').hide();
                $('#reason').prop('required', false);
            }


            $('#status').change(function() {
                var status = $(this).val();

                if (status === 'rejected') {
                    $('#reason-group').show();
                    $('#reason').prop('required', true);
                } else {
                    $('#reason-group').hide();
                    $('#reason').prop('required', false);
                }
            });
        });
    </script>
@endsection
