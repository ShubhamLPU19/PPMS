@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Draft</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Draft</li>
	</ul>
</div>
@endpush


@section('content')
<a href="{{route('addorder')}}" class="btn btn-success text-center">Back</a></br>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Order Id</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      @foreach($draftorders as $order)
    <tr>
      <th scope="row">{{$order->id}}</th>
      <td>{{$order->name}}</td>
      <td>
          <form action="{{route('movetocart')}}" method="POST">
              @csrf
               <input type="hidden" name="id" value="{{$order->id}}">
                <button type="submit" class="btn btn-primary">Move to Cart</button>
          </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection

@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush

