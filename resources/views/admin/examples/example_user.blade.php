@extends('admin.layouts.master')

@section('ol')
    <li class="breadcrumb-item"><a href="{{route('dahsboard.home')}}">الرئيسية</a></li>
    <li class="breadcrumb-item">تدريبات المتدرب {{$user->name}}</li>

@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>جميع التدريبات</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>اسم الدرس</th>
                                <th>اسم التدريب</th>
                                <th>تصحيح</th>
                            </tr>
                            @foreach($examples as $example)
                            <tr>

                                <td>{{$example->example->lesson->name}}</td>
                                <td>{{$example->example->name}}</td>

                                <td>
                                    @if($example->rate=='pending')

                                    <a  href="{{route('dahsboard.examples.rateExample',['example'=>$example->example->id,'user'=>$user->id])}}" class="btn btn-sm btn-outline-success"><i class="fa fa-check"></i></a>
                               @else
                                        <star-rating  :rtl="true" :read-only="true" rating="{{$example->rate}}" :increment="0.5" :star-size="20" :max-rating="10"  text-class="custom-text" />

                                    @endif
                                </td>
                            </tr>
@endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop