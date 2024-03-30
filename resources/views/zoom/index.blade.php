@extends('layouts.master')
@section('css')

@section('title')
    حصص اونلاين
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    حصص اونلاين
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('zoom.create')}}" class="btn btn-success" role="button" aria-pressed="true">اضافة حصة اونلاين جديدة</a>
                                <a class="btn btn-warning" href="{{route('zoom.indirectcreate')}}">اضافة حصة اوفلاين جديدة</a>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>المرحلة</th>
                                            <th>الصف</th>
                                            <th>القسم</th>
                                            <th>المعلم</th>
                                            <th>عنوان الحصة</th>
                                            <th>تاريخ البداية</th>
                                            <th>وقت الحصة</th>
                                            <th>رابط الحصة</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($zoom as $online_classe)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$online_classe->grade->name}}</td>
                                            <td>{{ $online_classe->classroom->class_name }}</td>
                                            <td>{{$online_classe->section->section_name}}</td>
                                                <td>{{$online_classe->user->name}}</td>
                                                <td>{{$online_classe->topic}}</td>
                                                <td>{{$online_classe->start_at}}</td>
                                                <td>{{$online_classe->duration}}</td>
                                                <td class="text-danger"><a href="{{$online_classe->join_url}}" target="_blank">انضم الان</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$online_classe->meeting_id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_receipt{{$online_classe->meeting_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">حذف {{$online_classe->topic}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('zoom.destroy')}}" method="post">
                    @csrf
                    <input type="hidden" name="meeting_id" value="{{$online_classe->meeting_id}}">
                    <input type="hidden" name="id" value="{{$online_classe->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">هل انت متاكد مع عملية الحذف ؟</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                                    @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
