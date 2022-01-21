@extends('layouts.noapp')

@section('title')
	Online Spreadsheet & Fee Calculator
@endsection()

@section('content')
	<h2>Select A Category To Calculate</h2>
	<div style="max-width: 1000px;margin: auto;">
	@include('inc.company')
	</div>
@endsection