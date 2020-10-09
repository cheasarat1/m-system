@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li>
            @role('evaluation')
            <a href="{{ route('evaluation.create') }}" rel='add' class="add">
                <i class="fa fa-plus"></i> Add new
            </a>
            @endrole
        </li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('evaluation.title') }}</h3>
        </div>
        <div class="box-body">
            <table id="evaluation" class="table table-bordered table-striped dataTable table-hover" data-url="{{ url('/') }}/evaluation">
                <thead>
                    <tr>
                        <th class="col-xs-1">#</th>
                        <th class="col-xs-3">{{ trans('evaluation.date') }}</th>
                        <th class="col-xs-4">{{ trans('evaluation.school') }}</th>
                        <th class="col-xs-3">{{ trans('evaluation.evaluated_by') }}</th>
                        <th class="col-xs-1">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="box-footer">&nbsp;</div>
    </div>
</section>

<div id="search" style="display: none;">
    
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-8">
            <div class="checkbox">
                <label>
                    {{ trans('evaluation.show') }}
                    <select name="duplicate" class="form-control input-sm" style="width: 150px;">
                        <option value="0" selected>{{ trans('evaluation.all') }}</option>
                        <option value="1">{{ trans('evaluation.duplicate') }}</option>
                    </select>
                </label>
            </div>
        </div>
    </div>
</div>
@endsection