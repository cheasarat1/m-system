@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>&nbsp;</h1>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('report.title') }}</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-7">
                    <div class="row">
                        <div class="col-xs-3 form-group">
                            <label>{{ trans('report.start_date') }}</label>
                            <input type="text" class="start date form-control" />
                        </div>
                        <div class="col-xs-3 form-group">
                            <label>{{ trans('report.end_date') }}</label>
                            <input type="text" class="end date form-control" />
                        </div>
                        <div class="col-xs-3 form-group">
                            <label>{{ trans('report.level') }}</label>
                            <select name="level" class="form-control" style="width: 100%;">
                                <option value=""> - </option>
                                @foreach($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-3 form-group">
                            <label>{{ trans('report.zone') }}</label>
                            <select name="zone" class="form-control" style="width: 100%;">
                                <option value=""> - </option>
                                @foreach($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="row">
                        <div class="col-xs-12">
                            <center>
                                <label>{{ trans('report.percentage') }}</label>
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <input type="text" name="good" class="form-control text-center" disabled/>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name="medium" class="form-control text-center" disabled />
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name="weak" class="form-control text-center" disabled/>
                        </div>
                    </div>
                </div>

                <div class="col-xs-1">
                    <label>{{ trans('report.orientation') }}</label>
                    <select name="orientation" class="form-control" style="width: 100%">
                        <option value=""> - </option>
                        <option value="173,246"> ល្អ </option>
                        <option value="124,172"> មធ្យម </option>
                        <option value="1,123"> ខ្យោយ </option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <table id="effectiveness" class="table table-bordered table-striped dataTable table-hover" data-url="{{ url('/') }}/report/effectiveness">
                        <thead>
                            <tr>
                                <th class="col-xs-1">#</th>
                                <th class="col-xs-1">{{ trans('report.code') }}</th>
                                <th class="col-xs-1">{{ trans('report.school') }}</th>
                                <th class="col-xs-1">{{ trans('report.level') }}</th>
                                <th class="col-xs-1">{{ trans('report.zone') }}</th>
                                <th class="col-xs-1">{{ trans('report.location') }}</th>
                                <th class="col-xs-1">{{ trans('report.date') }}</th>
                                <th class="col-xs-1">{{ trans('report.score') }}</th>
                                <th class="col-xs-1">{{ trans('report.rang') }}</th>
                                <th class="col-xs-1">{{ trans('report.orientation') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="box-footer">&nbsp;</div>
    </div>
</section>
@endsection