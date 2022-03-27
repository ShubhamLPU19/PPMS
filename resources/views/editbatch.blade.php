@extends('layouts.app')

@push('page-css')
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Edit Batch</h3>
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
				<form method="post" action="{{route('batchupdate',[$product->product_id])}}">
					@csrf
                @foreach($batchData as $data)
                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">
								<label>Batch<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="batch_name[]" value="{{$data->batch_name}}" required>
							</div>
						</div>
                        <div class="col-lg-1">
							<div class="form-group">
								<label>Quantity<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="quantity[]" value="{{$data->available_quantity}}" required>
							</div>
						</div>
                        <div class="col-lg-3">
							<div class="form-group">
								<label>Expire Date<span class="text-danger">*</span></label>
								<input class="form-control" type="date" name="expire_date[]" value="{{$data->expiry_date}}" required>
							</div>
						</div>
                        <div class="col-lg-2">
							<div class="form-group">
								<label>Price<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="price[]" value="{{$data->price}}" required>
							</div>
						</div>
                        <div class="col-lg-1">
							<div class="form-group">
								<label>GST<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="gst_percent[]" value="{{$data->gst_percent}}" required>
							</div>
						</div>
                        <div class="col-lg-3">
							<div class="form-group">
								<label>Location<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="location[]" value="{{$data->location}}" required>
							</div>
						</div>
					</div>
				</div>
                @endforeach
                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">
								<label>Batch<span class="text-danger"></span></label>
								<input class="form-control" type="text" name="batch_name[]" value="">
							</div>
						</div>
                        <div class="col-lg-1">
							<div class="form-group">
								<label>Quantity<span class="text-danger"></span></label>
								<input class="form-control" type="text" name="quantity[]" value="">
							</div>
						</div>
                        <div class="col-lg-3">
							<div class="form-group">
								<label>Expire Date<span class="text-danger"></span></label>
								<input class="form-control" type="date" name="expire_date[]" value="">
							</div>
						</div>
                        <div class="col-lg-2">
							<div class="form-group">
								<label>Price<span class="text-danger"></span></label>
								<input class="form-control" type="text" name="price[]" value="">
							</div>
						</div>
                        <div class="col-lg-1">
							<div class="form-group">
								<label>GST<span class="text-danger"></span></label>
								<input class="form-control" type="text" name="gst_percent[]" value="">
							</div>
						</div>
                        <div class="col-lg-3">
							<div class="form-group">
								<label>Location<span class="text-danger"></span></label>
								<input class="form-control" type="text" name="location[]" value="">
							</div>
						</div>
					</div>
				</div>

					<div class="submit-section">
						<button class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection


@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush




