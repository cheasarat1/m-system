@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('commune.create') }}" rel='add' class="add">
                <i class="fa fa-plus"></i> Add new
            </a>
        </li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('commune.title') }}</h3>
        </div>
        <div class="box-body">
            <table id="commune" class="table table-bordered table-striped dataTable table-hover" data-url="{{ url('/') }}/commune/datatable">
                <thead>
                    <tr>
                        <th class="col-xs-1">#</th>
                        <th class="col-xs-1">{{ trans('commune.name') }}</th>
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