@extends('layouts.master')
@section('css')
@section('title')
    الفواتير الدراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    الفواتير الدراسية
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
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>نوع الرسوم</th>
                                            <th>المبلغ</th>
                                            <th>المرحلة الدراسية</th>
                                            <th>الصف الدراسي</th>
                                            <th>البيان</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fee_invoices as $Fee_invoice)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $Fee_invoice->student->name }}</td>
                                                <td>{{ $Fee_invoice->fee->title }}</td>
                                                <td>{{ number_format($Fee_invoice->amount, 2) }}</td>
                                                <td>{{ $Fee_invoice->grade->name }}</td>
                                                <td>{{ $Fee_invoice->classroom->class_name }}</td>
                                                <td>{{ $Fee_invoice->description }}</td>
                                                <td>
                                                    <a href="{{ route('feeinvoice.edit', $Fee_invoice->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_fee_invoice{{$Fee_invoice->id}}" ><i class="fa fa-trash"></i></button                                                </td>
                                            </tr>
                                                <!-- Deleted inFormation Student -->
                                        <div class="modal fade" id="delete_fee_invoice{{$Fee_invoice->id}}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                            class="modal-title" id="exampleModalLabel">حذف فاتورة</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                            <h5 style="font-family: 'Cairo', sans-serif;">هل انت متاكد
                                                                مع عملية الحذف ؟</h5>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Students_trans.Close') }}</button><a class="btn btn-danger" href="{{route('feeinvoice.destroy',$Fee_invoice->id)}}">{{ trans('Students_trans.submit') }}</a>
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
