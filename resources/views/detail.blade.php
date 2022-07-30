@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Products</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Products</li>
	</ul>
</div>
<!-- <div class="col-sm-5 col">
	<a href="{{route('add-product')}}" class="btn btn-primary float-right mt-2">Add New</a>
</div> -->
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Products -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="datatable-export" class="table table-hover table-center mb-0">
						<thead>
							<tr>
								<th>Medicine Name</th>
								<th>Batch Name</th>
								<th>Price &#x20B9</th>
								<th>Expiry Date</th>
								<th>Location</th>
                                <th>Available Quantity</th>
                                <th>Used Quantity</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($productbatch as $batch)
								<tr>
                                    <td>{{ $batch->medicine_name }} </td>
                                    <td>{{$batch->batch_name}}</td>
									<td>{{$batch->price}}</td>
									<td>{{ $batch->expiry_date }}</td>
                                    <td> {{ $batch->location }}</td>
									<td>{{$batch->available_quantity}}</td>
                                    <td>{{$batch->used_quantity}}</td>
								</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /Products -->

	</div>
</div>

<!-- Delete Modal -->
<x-modals.delete :route="'products'" :title="'Product'" />
<!-- /Delete Modal -->
@endsection

@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush


