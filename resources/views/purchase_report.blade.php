@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Sales Report</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Sales Report</li>
	</ul>
    <a href="{{route('addorder')}}" class="btn btn-success text-center" style="float: right; margin-top: -58px;">Back</a>
</div>
@endpush


@section('content')
<div class="container">
    <form action="{{route('reports')}}" method="get">
    @csrf
        <div class="row">
            <div class="col-5">
            <label> From Date </label>
            <input type="date" class="form-control" name="from_date" value="{{ Request::get('from_date') }}">
            </div>
            <div class="col-5">
            <label> From Date </label>
            <input type="date" class="form-control" name="to_date" value="{{ Request::get('to_date') }}">
            </div>
            <div class="col-2">
            <label>  </label>
            <button type="submit" class="btn btn-primary mb-2" style="margin-top: 30px;">Filter</button>
            </div>
        </div>
    </form>
</div>
<br>
<br>
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
      <?php $count=1; $total_amount = 0;?>
      @foreach($reports as $report)
      <?php $total_amount += $report->amount; ?>
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$report->name}}</td>
      <td>{{$report->doctor_name}}</td>
      <td>{{$report->ipd_id}}</td>
      <td>{{$report->payment_type}}</td>
      <td>{{$report->discount_amount}}</td>
      <td>{{$report->amount}}</td>
      <td>{{date("d-m-Y", strtotime($report->created_at))}}</td>
      <td><a href="{{route('salesrecipt',[$report->order__id])}}">Print Receipt</a></td>
    </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>Total :-</strong></td>
        <td><strong>{{$total_amount}}</strong></td>
    </tr>
  </tbody>
</table>

@endsection

@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush

