<table class="table table-striped table-bordered" id="sof">
    <thead>
        <tr>
            <th colspan="2" class="text-center col-xs-5" rowspan="2" style="vertical-align: middle;">សូចនាករ និងលក្ខខណ្ឌដាក់ពិន្ទ</th>
            <th colspan="3" class="text-center">ពិន្ទលើភាពរីកចម្រើន</th>
            <th rowspan="2" class="text-center col-xs-1" style="vertical-align: middle;">សរុប</th>
            <th rowspan="2" class="text-center col-xs-1 no-print" style="vertical-align: middle;">កត្តា/មូលហេតុ</th>
            <th rowspan="2" class="text-center col-xs-1 no-print" style="vertical-align: middle;">ដំណោះស្រាយ</th>
        </tr>
        <tr>
            <th class="text-center col-xs-1" style="vertical-align: middle;">គ្មាន​​=១</th>
            <th class="text-center col-xs-1" style="vertical-align: middle;">មានតែមិនត្រូវ=២</th>
            <th class="text-center col-xs-1" style="vertical-align: middle;">មាននិងត្រឹមត្រូវ=៣</th>
        </tr>
    </thead>
    <tbody>
        @php $index = 1 @endphp
        @foreach ($questions as $question)
            <tr class="parent-{{ $question->id }} <?php echo ($index == count($questions)) ? 'grand-total' : 'sub-total'; ?>" data-question-id="{{ $question->id }}">
                <td colspan="2">{{ $question->name }}</td>
                <td><input type="text" name="{{ $question->id }}" data-point="point1" class="form-control" style="text-align:center;" disabled></td>
                <td><input type="text" name="{{ $question->id }}" data-point="point2" class="form-control" style="text-align:center;" disabled></td>
                <td><input type="text" name="{{ $question->id }}" data-point="point3" class="form-control" style="text-align:center;" disabled></td>
                <td><input type="text" name="{{ $question->id }}" data-point="point4" class="form-control <?php echo ($index == count($questions)) ? 'grand-total' : ''; ?>" style="text-align:center;" disabled></td>
                <td class="no-print"></td>
                <td class="no-print"></td>
            </tr>
            @php $index++ @endphp
            @foreach ($question->childrenQuestions as $children)
                @include('evaluation.children', [
                    'parent' => $question->id,
                    'children' => $children,
                    'spaces' => '&#160;&#160;&#160;',
                    'last' => count($children->questions)
                ])
            @endforeach
        @endforeach
    </tbody>
</table>