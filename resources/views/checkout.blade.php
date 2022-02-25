@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Checkout</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Checkout</li>
	</ul>
</div>
@endpush


@section('content')
<a href="{{route('addorder')}}" class="btn btn-success text-center">Back</a></br>
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body custom-edit-service">


			<!-- Add Medicine -->
			<form method="post" enctype="multipart/form-data" id="update_service" action="{{route('checkoutadd')}}">
				@csrf
                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Bill To<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="name" value="" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>IPD No<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="ipd_no" value="" required>
							</div>
						</div>

					</div>
				</div>

                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Doctor Name<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="doctor_name" value="" required>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Amount<span class="text-danger">*</span></label>
								<input class="form-control" type="number" name="amount" value="" required>
							</div>
						</div>

					</div>
				</div>

                <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Paid Amount<span class="text-danger">*</span></label>
								<input class="form-control" type="number" name="paid_amount" value="" required>
							</div>
						</div>
                        <input class="form-control" type="hidden" name="order_id" value="{{$order_id}}">
					</div>
				</div>
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

