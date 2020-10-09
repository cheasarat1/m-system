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
                <div class="col-xs-8">
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            <label>{{ trans('report.questions') }}</label>
                            <select name="question" class="form-control" style="width: 100%">
                                <option value="0"> - </option>
                                    @foreach($questions as $question)
                                        <option value="{{ $question->id }}">
                                            {{ $question->name }}
                                        </option>
                                        @foreach ($question->childrenQuestions as $children)
                                            @include('report.children', [
                                                'children' => $children,
                                                'spaces' => '&#160;&#160;&#160;'
                                            ])
                                        @endforeach
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-xs-3 form-group">
                            <label>{{ trans('report.start_date') }}</label>
                            <input type="text" class="start date form-control" />
                        </div>
                        <div class="col-xs-3 form-group">
                            <label>{{ trans('report.end_date') }}</label>
                            <input type="text" class="end date form-control" />
                        </div>
                        <div class="col-xs-2 form-group">
                            <label>{{ trans('report.level') }}</label>
                            <select name="level" class="form-control" style="width: 100%">
                                <option value=""> - </option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="row">
                        <div class="col-xs-3 form-group">
                            <label>{{ trans('report.zone') }}</label>
                            <select name="zone" class="form-control" style="width: 100%">
                                <option value=""> - </option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-3 form-group">
                            <label>{{ trans('report.total1') }}</label>
                            <input type="text" name="total-1" class="form-control" />
                        </div>
                        <div class="col-xs-3 form-group">
                            <label>{{ trans('report.total2') }}</label>
                            <input type="text" name="total-2" class="form-control" />
                        </div>
                        <div class="col-xs-3 form-group">
                            <label>{{ trans('report.percentage') }}</label>
                            <input type="text" name="school" data-school="{{ $school }}" class="form-control" disabled />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <table id="schoolReport" class="table table-bordered table-striped dataTable table-hover" data-url="{{ url('/') }}/report/school">
                        <thead>
                            <tr>
                                <th class="col-xs-1">#</th>
                                <th class="col-xs-1">{{ trans('report.school') }}</th>
                                <th class="col-xs-1">{{ trans('report.code') }}</th>
                                <th class="col-xs-1">{{ trans('report.level') }}</th>
                                <th class="col-xs-1">{{ trans('report.zone') }}</th>
                                <th class="col-xs-1">{{ trans('report.score') }}</th>
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