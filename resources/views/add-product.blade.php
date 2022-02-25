@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Add Product</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Add Product</li>
	</ul>
</div>
@endpush


@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body custom-edit-service">


			<!-- Add Medicine -->
			<form method="post" enctype="multipart/form-data" id="update_service" action="{{route('add-product')}}">
				@csrf
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Category <span class="text-danger">*</span></label>
								<select class="select2 form-select form-control" name="category_id" required>
                                    <option value="">Select Category</option>
									@foreach ($categories as $category)
										<option value="{{$category->id}}">{{$category->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

                        <div class="col-lg-6">
							<div class="form-group">
								<label>Supplier <span class="text-danger">*</span></label>
								<select class="select2 form-select form-control" name="supplier_id" required>
                                    <option value="">Select Supplier</option>
									@foreach ($suppliers as $supplier)
										<option value="{{$supplier->id}}">{{$supplier->name}}</option>
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
								<input class="form-control" type="text" name="medicine_name" value="" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Batch<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="batch" value="" required>
							</div>
						</div>

					</div>
				</div>

                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Quantity<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="quantity" value="" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Expire Date<span class="text-danger">*</span></label>
								<input class="form-control" type="date" name="expire_date" value="" required>
							</div>
						</div>

					</div>
				</div>

                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Company Name<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="company_name" value="" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Price<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="price" value="" required>
							</div>
						</div>
                        <!-- <input class="form-control" type="hidden" name="status" value="Open"> -->
					</div>
				</div>

                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>GST<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="gst" value="" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Location<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="location" value="" required>
							</div>
						</div>

					</div>
				</div>

				<!-- <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Selling Price<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="price" value="{{old('price')}}">
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Discount (%)<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="discount" value="0">
							</div>
						</div>

					</div>
				</div>



				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Descriptions <span class="text-danger">*</span></label>
								<textarea class="form-control service-desc" name="description"></textarea>
							</div>
						</div>

					</div>
				</div> -->


				<div class="submit-section">
					<button class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Submit</button>
				</div>
			</form>
			<!-- /Add Medicine -->


			</div>
		</div>
	</div>
</div>
@endsection

@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush

