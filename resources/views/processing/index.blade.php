@extends('layouts.master')
@section('css')
@section('title')
    معالجات الرسوم الدراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    معالجات الرسوم الدراسية
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
                                            <th>المبلغ</th>
                                            <th>البيان</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($processingfee as $ProcessingFee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ProcessingFee->student->name }}</td>
                                                <td>{{ number_format($ProcessingFee->amount, 2) }}</td>
                                                <td>{{ $ProcessingFee->description }}</td>
                                                <td>
                                                    <a href="{{ route('processingfee.edit', $ProcessingFee->id) }}"
                                                        class="btn btn-info btn-sm" role="button"
                                                        aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#Delete_receipt{{ $ProcessingFee->id }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Delete_receipt{{ $ProcessingFee->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">حذف رسوم
                                                                معالجة</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                                <h5 style="font-family: 'Cairo', sans-serif;">هل انت
                                                                    متاكد مع عملية الحذف ؟</h5>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('Students_trans.Close') }}</button>
                                                                    <a
                                                                        class="btn btn-danger" href="{{route('processingfee.destroy',$ProcessingFee->id)}}">{{ trans('Students_trans.submit') }}</a>
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
