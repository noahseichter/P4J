<div class='row dual-option-row' data-criteria-name='{{$value["name"]}}'>
	<div class='col-7'>
		<strong>{{$value['header']}}</strong>
	</div>
	<div data-value='1' data-checked='{{ (isset($fall) && $fall[$value["name"]] === 1) ? 1 : 0 }}' class='col-2 semester-option-tile {{ (isset($fall) && $fall[$value["name"]] === 1) ? "fall" : "" }}'>
		{{$value['1']}}
	</div>
	<div data-value='2' data-checked='{{ (isset($spring) && $spring[$value["name"]] === 1) ? 1 : 0 }}' class='col-2 semester-option-tile {{ (isset($spring) && $spring[$value["name"]] === 1) ? "spring" : "" }}'>
		{{$value['2']}}
	</div>
	<input type='text' id='{{$value["name"]}}' name='{{$value["name"]}}' value='{{ (isset($eval)) ? $eval[$value["name"]] : ""}}' hidden s/>
</div>