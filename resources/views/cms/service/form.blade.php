@extends('cms.layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('service.index') }}">Service List</a></li>
                        <li class="breadcrumb-item active">Service Form</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Service Form</h3>
            </div>

            {!! Form::model($object,['method'=>$method, 'url'=>$url,  'onSubmit' => "document.getElementById('submit').disabled=true;", 'files' => true]) !!}
                <input type="hidden" name="id" value="{{ $object->id }}">
                <div class="card-body">
                    <div class="row ml-0"><b>Note :- </b>&nbsp;<p class="text-danger">Name field should only contain
                            alphabetical characters.</p>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::label('name', 'Name', []) }}<span style="color: red;"> *</span>
                            {{ Form::text('name', null, ['class' => 'form-control name', 'placeholder' => 'Enter Service Name', 'required']) }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::label('duration', 'Duration', []) }}<span style="color: red;"> *</span>
                            {{ Form::text('duration', null, ['class' => 'form-control', 'placeholder' => 'Enter Duration', 'required']) }}
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::label('price', 'Price', []) }}<span style="color: red;"> *</span>
                            {{ Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Enter Price', 'required','min'=>'1']) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::label('description', 'Description', []) }}<span style="color: red;"> *</span>
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description', 'required']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('image', 'Image') }}
                            {{ Form::file('image',null, ['class' => 'file-upload-default','id'=>'image', 'accept' => 'image/jpg,image/png, image/jpeg']) }}
                            <div class="row">
                                <div class="old-image-preview mt-2  ml-2">
                                    @if (!empty($object->image) && file_exists("uploads/services/" . $object->image))
                                    {{ Form::label('image', 'Image',['class'=>'mr-2']) }}
                                        <img style="background:thistle;max-height: 150px;"
                                            src={{ asset('uploads/services/' . $object->image) }} />
                                    @endif
                                </div>
                                <div class="new-image-preview mt-2 ml-2">
                                    {{-- <label class="mr-2">New Image Preview</label> --}}
                                    <img id="image-preview" style="background:thistle; max-height: 150px; display: none;" alt="New Image Preview">
                                </div>
                            </div>
                        </div>

                        <div class="form-check">
                            <input id="is_laser_option" class="form-check-input" type="checkbox" name="is_laser_option"
                                value="1" @if (!empty($object->is_laser_option)) checked @endif>
                            <label for="is_laser_option" class="form-check-label">Is Laser Option</label>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <div>
                                <span class="text-danger"><b>Note:-</b></span>
                                <span> <b>*</b> Fields are Required</span>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('footerScript')
    <script>
        $(document).ready(function () {
            $('#image').on('change', function (event) {
                let file = event.target.files[0];

                if (file) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $('#image-preview').attr('src', e.target.result).show();
                    };

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
