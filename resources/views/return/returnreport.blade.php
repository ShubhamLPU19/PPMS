@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Return Report</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Return Report</li>
	</ul>
</div>
@endpush


@section('content')
<a href="{{route('addorder')}}" class="btn btn-success text-center">Back</a></br>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Doctor Name</th>
      <th scope="col">IPD No</th>
      <th scope="col">Payment Type</th>
      <th scope="col">Discount</th>
      <th scope="col">Amount</th>
      <th scope="col">Purchase Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php $count=1;?>
      @foreach($returnreports as $report)
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$report->name}}</td>
      <td>{{$report->doctor_name}}</td>
      <td>{{$report->ipd_id}}</td>
      <td>{{$report->payment_type}}</td>
      <td>{{$report->discount_amount}}</td>
      <td>{{$report->amount}}</td>
      <td>{{date("d-m-Y", strtotime($report->created_at))}}</td>
      <td><a href="{{route('returnrecipt',[$report->order__id])}}">Print Receipt</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection

@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush

