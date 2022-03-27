@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">View IPD Report</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">View IPD Report</li>
	</ul>
</div>
@endpush


@section('content')
<a href="{{route('addorder')}}" class="btn btn-success text-center">Back</a></br>
<strong>Sale</strong>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Doctor Name</th>
      <th scope="col">IPD No</th>
      <th scope="col">Bill Type</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
      <?php $purchase_amt = 0; ?>
      @foreach($ipdreports as $report)
    <tr>
      <th scope="row">{{$report->order__id}}</th>
      <td>{{$report->name}}</td>
      <td>{{$report->doctor_name}}</td>
      <td>{{$report->ipd_id}}</td>
      <td>{{$report->sale_type}}</td>
      <td>{{$report->amount}}</td>
      <?php $purchase_amt+= $report->amount; ?>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"><strong>Total Amount:</strong></div>
    <div class="col-sm-3">{{$purchase_amt}}</div>
</div>
</br>
<strong>Return</strong>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Doctor Name</th>
      <th scope="col">IPD No</th>
      <th scope="col">Bill Type</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
  <?php $return_amt = 0; ?>
      @foreach($ipdreports as $report)
    <tr>
      <th scope="row">{{$report->order__id}}</th>
      <td>{{$report->name}}</td>
      <td>{{$report->doctor_name}}</td>
      <td>{{$report->ipd_id}}</td>
      <td>{{$report->sale_type}}</td>
      <td>{{$report->amount}}</td>
      <?php $return_amt+= $report->amount; ?>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"><strong>Total Amount:</strong></div>
    <div class="col-sm-3">{{$return_amt}}</div>
</div>
</br>

@endsection

@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush

