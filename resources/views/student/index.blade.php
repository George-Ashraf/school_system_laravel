@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('main_trans.list_students') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.list_students') }}
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
                            @if (Session::has('done'))
                            <div class="alert alert-success done text-center col-lg-5 ">
                                {{ Session::get('done') }}
                            </div>
                        @endif
                            <a href="{{ route('student.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{ trans('main_trans.add_student') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('Students_trans.name') }}</th>
                                            <th>{{ trans('Students_trans.email') }}</th>
                                            <th>{{ trans('Students_trans.gender') }}</th>
                                            <th>{{ trans('Students_trans.Grade') }}</th>
                                            <th>{{ trans('Students_trans.classrooms') }}</th>
                                            <th>{{ trans('Students_trans.section') }}</th>
                                            <th>{{ trans('Students_trans.Processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                {{-- 17:55 video 23 --}}
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->gender->name }}</td>
                                                <td>{{ $student->grade->name }}</td>
                                                <td>{{ $student->classroom->class_name }}</td>
                                                <td>{{ $student->section->section_name }}</td>
                                                <td>

                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            العمليات
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('student.show',$student->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp;  عرض بيانات الطالب</a>
                                                            <a class="dropdown-item" href="{{route('student.edit',$student->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;  تعديل بيانات الطالب</a>
                                                            <a class="dropdown-item" href="{{route('feeinvoice.show',$student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;اضافة فاتورة رسوم&nbsp;</a>
                                                            <a class="dropdown-item" href="{{route('receipt_student.show',$student->id)}}"><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;سند قبض</a>
                                                            <a class="dropdown-item" href="{{route('processingfee.show',$student->id)}}"><i class="fa-solid fa-money-bill-transfer" style="color: blueviolet"></i>&nbsp; &nbsp;استبعاد رسوم</a>
                                                            <a class="dropdown-item" href="{{route('payment.show',$student->id)}}"><i class="fa-solid fa-dollar-sign" style="color: orange"></i></i>&nbsp; &nbsp;سند صرف</a>

                                                            <a class="dropdown-item" data-target="#Delete_Student{{ $student->id }}" data-toggle="modal" href="#Delete_Student{{ $student->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;  حذف بيانات الطالب</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Deleted inFormation Student -->



                                            <div class="modal fade" id="Delete_Student{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('Teacher_trans.Delete_Teacher') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ trans('My_Classes_trans.Warning_class') }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                        <a href="{{route('student.destroy',$student->id)}}" type="submit" class="btn btn-danger">{{ trans('Students_trans.submit') }}</a>
                                                                    </div>
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
