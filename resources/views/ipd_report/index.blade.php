@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">IPD Report</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">IPD Report</li>
	</ul>
</div>
@endpush


@section('content')
<a href="{{route('addorder')}}" class="btn btn-success text-center">Back</a></br>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Doctor Name</th>
      <th scope="col">IPD No</th>
      <th scope="col">Bill Type</th>
      <th scope="col">Amount</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      @foreach($reports as $report)
    <tr>
      <th scope="row">{{$report->order__id}}</th>
      <td>{{$report->name}}</td>
      <td>{{$report->doctor_name}}</td>
      <td>{{$report->ipd_id}}</td>
      <td>{{ucwords($report->sale_type)}}</td>
      <td>{{$report->amount}}</td>
      <td><a href="{{route('viewipd',[$report->ipd_id])}}">View</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection

@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush

