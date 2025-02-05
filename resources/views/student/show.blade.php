@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('Students_trans.Student_details') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.Student_details') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card-body">
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                    role="tab" aria-controls="home-02"
                                    aria-selected="true">{{ trans('Students_trans.Student_details') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                    role="tab" aria-controls="profile-02"
                                    aria-selected="false">{{ trans('Students_trans.Attachments') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                aria-labelledby="home-02-tab">
                                  @if (Session::has('done'))
                            <div class="alert alert-success done text-center col-lg-5 ">
                                {{ Session::get('done') }}
                            </div>
                            @endif
                                <table class="table table-striped table-hover" style="text-align:center">
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ trans('Students_trans.name') }}</th>
                                            <td>{{ $Student->name }}</td>
                                            <th scope="row">{{ trans('Students_trans.email') }}</th>
                                            <td>{{ $Student->email }}</td>
                                            <th scope="row">{{ trans('Students_trans.gender') }}</th>
                                            <td>{{ $Student->gender->name }}</td>
                                            <th scope="row">{{ trans('Students_trans.Nationality') }}</th>
                                            <td>{{ $Student->nationality->name }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ trans('Students_trans.Grade') }}</th>
                                            <td>{{ $Student->grade->name }}</td>
                                            <th scope="row">{{ trans('Students_trans.classrooms') }}</th>
                                            <td>{{ $Student->classroom->class_name }}</td>
                                            <th scope="row">{{ trans('Students_trans.section') }}</th>
                                            <td>{{ $Student->section->section_name }}</td>
                                            <th scope="row">{{ trans('Students_trans.Date_of_Birth') }}</th>
                                            <td>{{ $Student->birth_date }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ trans('Students_trans.parent') }}</th>
                                            <td>{{ $Student->myparent->father_name }}</td>
                                            <th scope="row">{{ trans('Students_trans.academic_year') }}</th>
                                            <td>{{ $Student->acadamic_year }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('student.Upload_attachment') }}"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        for="academic_year">{{ trans('Students_trans.Attachments') }}
                                                        : <span class="text-danger">*</span></label>
                                                    <input type="file" accept="image/*" name="photos[]" multiple
                                                        required>
                                                    <input type="hidden" name="student_name"
                                                        value="{{ $Student->name }}">
                                                    <input type="hidden" name="student_id"
                                                        value="{{ $Student->id }}">
                                                </div>
                                            </div>
                                            <br><br>
                                            <button type="submit" class="button button-border x-small">
                                                {{ trans('Students_trans.submit') }}
                                            </button>
                                        </form>
                                    </div>
                                    <br>
                                    <table class="table center-aligned-table mb-0 table table-hover"
                                        style="text-align:center">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{ trans('Students_trans.filename') }}</th>
                                                <th scope="col">{{ trans('Students_trans.created_at') }}</th>
                                                <th scope="col">{{ trans('Students_trans.Processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Student->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $attachment->filename }}</td>
                                                    <td>{{ $attachment->created_at->diffForHumans() }}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                            href="{{ route('student.Download_attachment', [$attachment->imageable->name, $attachment->filename]) }}"
                                                            role="button"><i class="fas fa-download"></i>&nbsp;
                                                            {{ trans('Students_trans.Download') }}</a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#Delete_img{{ $attachment->id }}"
                                                            title="{{ trans('Grades_trans.Delete') }}">{{ trans('Students_trans.delete') }}
                                                        </button>

                                                    </td>
                                                </tr>
                                                <!-- Deleted inFormation Student -->
                                                <div class="modal fade" id="Delete_img{{ $attachment->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">
                                                                    {{ trans('Students_trans.Delete_attachment') }}
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('student.Delete_attachment') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $attachment->id }}">

                                                                    <input type="hidden" name="student_name"
                                                                        value="{{ $attachment->imageable->name }}">
                                                                    <input type="hidden" name="student_id"
                                                                        value="{{ $attachment->imageable->id }}">
                                                                        <input type="hidden" name="filename" value="{{$attachment->filename}}" class="form-control">
                                                                    <h5 style="font-family: 'Cairo', sans-serif;">
                                                                        {{ trans('Students_trans.Delete_attachment_tilte') }}
                                                                    </h5>

                                                                      <p>{{ $attachment->filename }}</p>


                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('Students_trans.Close') }}</button>
                                                                        <button
                                                                            class="btn btn-danger">{{ trans('Students_trans.submit') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
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
