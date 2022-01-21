@if(count($spreadsheet) > 0)
	<div id="list" class="my-1.5">
		<button type="button" class="add_sales_btn text-sm">Add To</button>
		<select id="sheet_page_list" class="text-sm rounded" name="selects">
				@foreach($spreadsheet as $ss)
				<option id="{{$ss->spreadsheet_id}}">Spreadsheet: {{$ss->spreadsheet_name}}</option>
				@endforeach
		</select>
	</div>
@endif