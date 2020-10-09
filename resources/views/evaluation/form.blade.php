@csrf
<section class="content-header">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('evaluation.index') }}" rel='add' class="add"><i class="fa fa-arrow-left"></i> Back</a>
        </li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border hidden-print">
            <h3 class="box-title">សំនួរវាយតម្លៃ</h3>
        </div>
        <div class="box-body">
            @include('evaluation.header')
            <div class="row">
                <div class="col-xs-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#checklist" data-tab="checklist" data-toggle="tab">{{ trans('evaluation.checklist') }}</a>
                            </li>
                            <li>
                                <a href="#effective" data-tab="effectiveness" data-url="{{ url('/') }}/tab/effective" data-toggle="tab">{{ trans('evaluation.effective') }}</a>
                            </li>
                            <li>
                                <a href="#report" data-tab="report" data-url="{{ url('/') }}/tab/report" data-toggle="tab">{{ trans('evaluation.report') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="checklist">
                                @include('evaluation.checklist')
                            </div>
                            <div class="tab-pane" id="effective"></div>
                            <div class="tab-pane" id="report"></div>
                        </div>
                    </div>
                </div>
            </div>
            @include('evaluation.footer')
        </div>
        <div class="box-footer hidden-print">
            <div class="pull-right">
                <button type="button" class="print-evaluation btn btn-primary">
                    <i class="fa fa-print"></i> Print
                </button>
                <button type="button" class="btn btn-save btn-primary" id="save">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </div>
    </div>
    @include('evaluation.modal')
</section>

@isset($evaluation)
    <script type="text/javascript">
        var evaluations = {!! json_encode($evaluation->scores->toArray()) !!};
    </script>
@endisset