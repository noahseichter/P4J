<div class='row dual-option-row' data-criteria-name='{{$value["name"]}}'>
	<div class='col-7'>
		<strong>{{$value['header']}}</strong>
	</div>
	<div data-value='1' class='col-2 dual-option-tile
	{{ (isset($fall) && $fall[$value["name"]] === 1) ? "fall" : "" }}
	{{ (isset($winter) && $winter[$value["name"]] === 1) ? "winter" : "" }}
	{{ (isset($spring) && $spring[$value["name"]] === 1) ? "spring" : "" }}'>
		{{$value['1']}}
	</div>
	<div data-value='2' class='col-2 dual-option-tile
	{{ (isset($fall) && $fall[$value["name"]] === 2) ? "fall" : "" }}
	{{ (isset($winter) && $winter[$value["name"]] === 2) ? "winter" : "" }}
	{{ (isset($spring) && $spring[$value["name"]] === 2) ? "spring" : "" }}'>
		{{$value['2']}}
	</div>
	<input class='required' type='text' id='{{$value["name"]}}' name='{{$value["name"]}}' value='{{ (isset($eval)) ? $eval[$value["name"]] : ""}}' hidden s/>
</div>