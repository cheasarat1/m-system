@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('zone.create') }}" rel='add' class="add">
                <i class="fa fa-plus"></i> Add new
            </a>
        </li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('zone.title') }}</h3>
        </div>
        <div class="box-body">
            <table id="zone" class="table table-bordered table-striped dataTable table-hover" data-url="{{ url('/') }}/zone/datatable">
                <thead>
                    <tr>
                        <th class="col-xs-1">#</th>
                        <th class="col-xs-1">{{ trans('zone.name') }}</th>
                        <th class="col-xs-1">{{ trans('zone.description') }}</th>
                        <th class="col-xs-1">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="box-footer">&nbsp;</div>
    </div>
</section>
@endsection