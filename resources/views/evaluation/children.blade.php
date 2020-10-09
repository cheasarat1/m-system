@if ($last != 0)
    <tr class="parent-{{ $children->id }} child-of-{{ $parent }}" data-question-id="{{ $children->id }}">
        <td colspan="2"><?php echo $spaces.$children->name; ?></td>
        <td><input type="text" name="{{ $children->id }}" data-point="point1" data-parent="{{ $parent }}" class="form-control point" style="text-align:center;" disabled></td>
        <td><input type="text" name="{{ $children->id }}" data-point="point2" data-parent="{{ $parent }}" class="form-control point" style="text-align:center;" disabled></td>
        <td><input type="text" name="{{ $children->id }}" data-point="point3" data-parent="{{ $parent }}" class="form-control point" style="text-align:center;" disabled></td>
        <td><input type="text" name="{{ $children->id }}" data-point="point4" data-parent="{{ $parent }}" class="form-control point" style="text-align:center;" disabled></td>
        <td class="no-print"></td>
        <td class="no-print"></td>
    </tr>
@else
    <tr class="child-of-{{ $parent }}" data-question-id="{{ $children->id }}">
        <td style="width: 90px;"></td>
        <td><?php echo $children->name; ?></td>
        <td><input type="text" name="{{ $children->id }}" data-point="point1" data-parent="{{ $parent }}" class="form-control point" style="text-align:center;"></td>
        <td><input type="text" name="{{ $children->id }}" data-point="point2" data-parent="{{ $parent }}" class="form-control point" style="text-align:center;"></td>
        <td><input type="text" name="{{ $children->id }}" data-point="point3" data-parent="{{ $parent }}" class="form-control point" style="text-align:center;"></td>
        <td><input type="text" name="{{ $children->id }}" data-point="point4" data-parent="{{ $parent }}" class="form-control point" style="text-align:center;" disabled></td>
        <td class="no-print">
            <input type="hidden" name="{{ $children->id }}" data-point="point5" data-parent="{{ $parent }}" class="form-control point" disabled>
            <div class='text-center'>
                <div class='btn-group'>
                    <a href='javascript:' class='reason btn btn-danger btn-xs'>
                        <i class='fa fa-eye'></i>
                    </a>
                </div>
            </div>
        </td>
        <td class="no-print">
            <input type="hidden" name="{{ $children->id }}" data-point="point6" data-parent="{{ $parent }}" class="form-control point" disabled>
            <div class='text-center'>
                <div class='btn-group'>
                    <a href='javascript:' class='solution btn btn-danger btn-xs'>
                        <i class='fa fa-eye'></i>
                    </a>
                </div>
            </div>
        </td>
    </tr>
@endif

@if(count($children->questions))
	@php $spaces.= '&#160;&#160;&#160;' @endphp
    @php $parent = $children->id @endphp
	@foreach ($children->questions as $children)
    	@include('evaluation.children', [
            'parent' => $parent,
    		'children' => $children,
    		'spaces' => $spaces,
            'last' => count($children->questions)
    	])
    @endforeach
@endif