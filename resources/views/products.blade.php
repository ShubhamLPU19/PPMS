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
<div class="col-sm-5 col">
	<a href="{{route('add-product')}}" class="btn btn-primary float-right mt-2">Add New</a>
</div>
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
								<th>Supplier</th>
								<th>Category</th>
								<th>Medicine</th>
								<th>Brand</th>
								<!--<th>Quantity</th>
                                <th>Price &#x20B9</th>
								<th>Expiry Date</th> -->
                                <th>Created At</th>
								<th class="action-btn">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($products as $product)
								<tr>
                                    <td>{{ $product->sup_name }} </td>
                                    <td>{{$product->cat_name}}</td>
									<td>{{$product->medicine_name}}</td>
									<td>{{ $product->brand_name }}</td>
                                    <!-- <td> {{ $product->quantity }}</td>
									<td>{{$product->price}}</td> -->
									<td>
									{{date_format(date_create($product->expire_date),"d M, Y")}}</span>
									</td>
									<td>
										<div class="actions">
                                            <a class="btn btn-sm bg-success-light" href="{{route('editProduct',$product->id)}}">
												<i class="fe fe-pencil"></i> Update Product
											</a>
                                            <a class="btn btn-sm bg-success-light" href="{{route('add-batch',$product->id)}}">
												<i class="fe fe-pencil"></i> Add Batch
											</a>
											<a data-id="{{$product->id}}" href="javascript:void(0);" class="btn btn-sm bg-danger-light deletebtn" data-toggle="modal">
												<i class="fe fe-trash"></i> Delete
											</a>
										</div>
									</td>
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
