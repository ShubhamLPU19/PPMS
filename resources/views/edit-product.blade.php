@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Edit Product</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Edit Product</li>
	</ul>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body custom-edit-service">


			<!-- Edit Medicine -->
				<form method="post" enctype="multipart/form-data" id="update_service" action="{{route('edit-product',$product)}}">
					@csrf
                    <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Category <span class="text-danger">*</span></label>
								<select class="select2 form-select form-control" name="category_id" required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{$product->category_id == $category->id  ? 'selected' : ''}}>{{ $category->name}}</option>
                                    @endforeach
								</select>
							</div>
						</div>

                        <div class="col-lg-6">
							<div class="form-group">
								<label>Supplier <span class="text-danger">*</span></label>
								<select class="select2 form-select form-control" name="supplier_id" required>
									<option value="" disabled selected>Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{$product->supplier_id == $supplier->id  ? 'selected' : ''}}>{{ $supplier->name}}</option>
                                    @endforeach
								</select>
							</div>
						</div>
					</div>
				</div>

                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Medicine<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="medicine_name" value="{{$product->medicine_name}}" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Batch<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="batch" value="{{$product->batch}}" required>
							</div>
						</div>

					</div>
				</div>

                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Quantity<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="quantity" value="{{$product->quantity}}" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Expire Date<span class="text-danger">*</span></label>
								<input class="form-control" type="date" name="expire_date" value="{{$product->expire_date}}" required>
							</div>
						</div>

					</div>
				</div>

                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Company Name<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="company_name" value="{{$product->company_name}}" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Price<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="price" value="{{$product->price}}" required>
							</div>
						</div>
					</div>
				</div>

                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>GST<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="gst" value="{{$product->gst}}" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Location<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="location" value="{{$product->location}}" required>
							</div>
						</div>

					</div>
				</div>


					<div class="submit-section">
						<button class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Submit</button>
					</div>
				</form>
			<!-- /Edit Medicine -->


			</div>
		</div>
	</div>
</div>
@endsection


@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush




