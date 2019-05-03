@switch($value['name'])
@case('numbers')
	<div class='row'>
  		@foreach($value['fields'] as $number)
  			<div data-type='number' data-value='{{ (isset($eval)) ? $eval["number_".strtolower($number)] : "" }}' class='rubric-selection numbers
	{{ (isset($fall) && $fall["number_".strtolower($number)] === 1) ? "fall" : "" }}
	{{ (isset($winter) && $winter["number_".strtolower($number)] === 1) ? "winter" : "" }}
	{{ (isset($spring) && $spring["number_".strtolower($number)] === 1) ? "spring" : "" }}'>{{ $number }}</div>
			<input type='text' id='number_{{strtolower($number) }}' name='number_{{ strtolower($number) }}' value='{{ (isset($eval)) ? $eval[$value["name"]] : ""}}' hidden />
 		@endforeach
	</div>
@break

@case('shapes')
	<div class='row'>
		@foreach($value['fields'] as $shape)
  			<div data-type='shape' data-value='{{ (isset($eval)) ? $eval["shape_".strtolower($shape)] : "" }}' class='rubric-selection shapes
	{{ (isset($fall) && $fall["shape_".strtolower($shape)] === 1) ? "fall" : "" }}
	{{ (isset($winter) && $winter["shape_".strtolower($shape)] === 1) ? "winter" : "" }}
	{{ (isset($spring) && $spring["shape_".strtolower($shape)] === 1) ? "spring" : "" }}'>{{ $shape }}</div>
			<input type='text' id='shape_{{ strtolower($shape) }}' name='shape_{{ strtolower($shape) }}' value='{{ (isset($eval)) ? $eval[$value["name"]] : ""}}' hidden />
		@endforeach
 	</div>
@break

@case('colors')
	<div class='row'>
		@foreach($value['fields'] as $color)
  			<div data-type='color' data-value='{{ (isset($eval)) ? $eval["color_".strtolower($color)] : "" }}' class='rubric-selection colors
	{{ (isset($fall) && $fall["color_".strtolower($color)] === 1) ? "fall" : "" }}
	{{ (isset($winter) && $winter["color_".strtolower($color)] === 1) ? "winter" : "" }}
	{{ (isset($spring) && $spring["color_".strtolower($color)] === 1) ? "spring" : "" }}'>{{ $color }}</div>
			<input type='text' id='color_{{ strtolower($color) }}' name='color_{{ strtolower($color) }}' value='{{ (isset($eval)) ? $eval[$value["name"]] : ""}}' hidden />
  		@endforeach
	</div>
@break
	
@case('letters')
	<div class='row letters'>
		@foreach($value['fields'] as $letter)
  			<div data-type='letter' data-value='{{ (isset($eval)) ? $eval["letter_".strtolower($letter)] : "" }}' class='col-2 rubric-selection letter
	{{ (isset($fall) && $fall["letter_".strtolower($letter)] === 1) ? "fall" : "" }}
	{{ (isset($winter) && $winter["letter_".strtolower($letter)] === 1) ? "winter" : "" }}
	{{ (isset($spring) && $spring["letter_".strtolower($letter)] === 1) ? "spring" : "" }}'>{{ $letter }}</div>
			<input type='text' id='letter_{{ strtolower($letter) }}' name='letter_{{ strtolower($letter) }}' value='{{ (isset($eval)) ? $eval[$value["name"]] : ""}}' hidden />
 		@endforeach
 	</div>
@break

@case ('letter_sounds')
	<div class='row letters'>
		@foreach($value['fields'] as $letter)
  			<div data-type='letter_sound' data-value='{{ (isset($eval)) ? $eval["letter_sound_".strtolower($letter)] : "" }}' class='col-2 rubric-selection letter
	{{ (isset($fall) && $fall["letter_sound_".strtolower($letter)] === 1) ? "fall" : "" }}
	{{ (isset($winter) && $winter["letter_sound_".strtolower($letter)] === 1) ? "winter" : "" }}
	{{ (isset($spring) && $spring["letter_sound_".strtolower($letter)] === 1) ? "spring" : "" }}'>{{ $letter }}</div>
			<input type='text' id='letter_sound_{{ strtolower($letter) }}' name='letter_sound_{{ strtolower($letter) }}' value='{{ (isset($eval)) ? $eval[$value["name"]] : ""}}' hidden />
  		@endforeach
  	</div>
@break
@endswitch