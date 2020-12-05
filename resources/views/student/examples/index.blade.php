@extends('admin.layouts.master')



@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>{{$example->name}}</span>
                </div>
                <div class="card-body">
                    @if(!empty($less->body))
                        <div class="img-thumbnail p-3">


                            {!! $example->body !!}
                            <hr>


                        </div>
                    @endif

                    <form action="{{route('student.example.complete.store',$example->id)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label>ملف مرفق</label>
                            <input accept="image/jpeg,image/png,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="pdf" type="file" class="form-control-file">
                            @error('pdf')
                            <span class="text-danger small">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>وصف تنفيذ التدريب</label>
                            <textarea name="body" id="" cols="30" rows="10"
                                      class="form-control">{{old('body')}}</textarea>
                            @error('body')
                            <span class="text-danger small">{{$message}}</span>
                            @enderror
                        </div>

                        <button class="btn btn-sm btn-primary" type="submit">إرسال</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop