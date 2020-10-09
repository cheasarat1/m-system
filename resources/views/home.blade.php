@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Title</h3>
        </div>
        <div class="box-body">
        	<table id="chart"></table>
            <div class="row">
            	<div class="col-xs-6">
            		<canvas id="myChart" width="400" height="320"></canvas>
            	</div>
            	<div class="col-xs-6"></div>
            </div>
        </div>
        <div class="box-footer">Footer</div>
    </div>
</section>
@endsection
