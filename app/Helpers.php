<?php

namespace App;

class Helpers {

	public static function question($question, $sub = '', $disabled = '', $color = '', $colorTotal = 'yellow')
	{
		$html = "";

		if ($question->level != 'score' && $question->level != 'result') {

			$html.= "<tr class='$question->id sub-of-$sub' data-question-id= '$question->id' style='background-color:$color;'>";

			$html.= ($color == '') ? "<td></td><td>$question->name</td>": "<td colspan='2'>$question->name</td>";

			$html.= "
				<td>
				    <input
				    	$disabled
				    	type ='text'
				    	data-sub-of ='$sub'
				    	data-evaluation = '1'
				        name ='$question->id'
				        style='text-align:center;'
				        class='score form-control'
				    />
				</td>";

			$html.= "
				<td>
				    <input
				    	$disabled
				        type ='text'
				        data-sub-of='$sub'
				        data-evaluation= '2'
				        name ='$question->id'
				        style='text-align:center;'
				        class='score form-control'
				    />
				</td>";

			$html.= "
				<td>
				    <input
				    	$disabled
				        type ='text'
				        data-sub-of='$sub'
				        data-evaluation= '3'
				        name ='$question->id'
				        style='text-align:center;'
				        class='score form-control'
				    />
				</td>";

			$html.= "
				<td style='background-color:gold;'>
				    <input
				    	disabled
				        type ='text'
				        data-sub-of='$sub'
				        data-evaluation= '4'
				        name ='$question->id'
				        style='text-align:center;'
				        class='score form-control'
				    />
				</td>";

			$html.= "
				<td style='background-color:white;' class='no-print'>
				    <input
				        type ='text'
				        class='form-control'
				        data-evaluation= '5'
				        name ='$question->id'
				        style='text-align:center;'
				    />
				</td>";

			$html.= "
				<td style='background-color:white;' class='no-print'>
				    <input
				        type ='text'
				        data-evaluation= '6'
				        name ='$question->id'
				        class='form-control'
				        style='text-align:center;'
				    />
				</td>";
		}

		if ($question->level == 'score') {
			$html.= "<tr class='$question->id $sub' data-question-id= '$question->id' style='background-color:$colorTotal;'>";

			$html.= "<td colspan='2' class='text-right font-weight-bold'>$question->name</td>";

			$html.= "
				<td>
				    <input
				    	disabled
				        type ='text'
				        data-evaluation= '1'
				        name ='$question->id'
				        class='form-control'
				        style='text-align:center;'
				    />
				</td>";

			$html.= "
				<td>
				    <input
				    	disabled
				        type ='text'
				        data-evaluation= '2'
				        name ='$question->id'
				        class='form-control'
				        style='text-align:center;'
				    />
				</td>";

			$html.= "
				<td>
				    <input
				    	disabled
				        type ='text'
				        data-evaluation= '3'
				        name ='$question->id'
				        class='form-control'
				        style='text-align:center;'
				    />
				</td>";

			$html.= "
				<td style='background-color:gold;'>
				    <input
				    	disabled
				        type ='text'
				        data-evaluation= '4'
				        name ='$question->id'
				        class='form-control'
				        style='text-align:center;'
				    />
				</td>";

			$html.= "
				<td style='background-color:white;' class='no-print'>
				    <input
				        type ='text'
				        data-evaluation= '5'
				        class='form-control'
				        style='text-align:center;'
				    />
				</td>";

			$html.= "
				<td style='background-color:white;' class='no-print'>
				    <input
				        type ='text'
				        data-evaluation= '6'
				        class='form-control'
				        style='text-align:center;'
				    />
				</td>";
		}

		if ($question->level == 'result') {
			$html.= "<tr class='$question->id' data-question-id= '$question->id'>";
			$html.= "<td>លទ្ធផលៈ</td>";
			$html.= "<td font-weight-bold'>$question->name</td>";
			$html.= "<td colspan='4' class='text-center'></td>";
			$html.= "
				<td style='background-color:white;' class='no-print'>
				    <input
				        type ='text'
				        data-evaluation= '5'
				        class='form-control'
				        name ='$question->id'
				        style='text-align:center;'
				    />
				</td>";
			$html.= "
				<td style='background-color:white;' class='no-print'>
				    <input
				        type ='text'
				        data-evaluation= '6'
				        class='form-control'
				        name ='$question->id'
				        style='text-align:center;'
				    />
				</td>";
		}

		$html.= "</tr>";
		return $html;
	}

}