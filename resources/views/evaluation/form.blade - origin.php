@csrf
<section class="content-header">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('evaluation.index') }}" rel='add' class="add">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border hidden-print">
            <h3 class="box-title">Evaluation</h3>
        </div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center col-xs-5" rowspan="2" style="vertical-align: middle;">សូចនាករ និងលក្ខខណ្ឌដាក់ពិន្ទ</th>
                        <th colspan="3" class="text-center">ពិន្ទលើភាពរីកចម្រើន</th>
                        <th rowspan="2" class="text-center col-xs-1" style="vertical-align: middle;">សរុប</th>
                        <th rowspan="2" class="text-center col-xs-1 no-print" style="vertical-align: middle;">កត្តា/មូលហេតុ</th>
                        <th rowspan="2" class="text-center col-xs-1 no-print" style="vertical-align: middle;">ដំណោះស្រាយ</th>
                    </tr>
                    <tr>
                        <th class="text-center col-xs-1" style="vertical-align: middle;">គ្មាន​​ =១</th>
                        <th class="text-center col-xs-1" style="vertical-align: middle;">មានតែមិនត្រូវ=២</th>
                        <th class="text-center col-xs-1" style="vertical-align: middle;">មាននិងត្រឹមត្រូវ=៣</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <ul>
                @foreach ($questions as $question)
                <li>{{ $question->name }}</li>
                <ul>
                    @foreach ($question->childrenQuestions as $children)
                        @include('evaluation.children', ['children' => $children])
                    @endforeach
                </ul>
                @endforeach
            </ul>
        </div>
        <div class="box-footer hidden-print">
            <div class="pull-right">
                <button type="button" class="print-evaluation btn btn-primary">
                    <i class="fa fa-print"></i> Print
                </button>
                <button type="button" class="btn btn-save btn-primary" id="save" data-url="{{ route('evaluation.store') }}">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </div>
    </div>
</section>

@isset($evaluation)
    <script type="text/javascript">
        var evaluations = {!! json_encode($evaluation->scores->toArray()) !!};
    </script>
@endisset