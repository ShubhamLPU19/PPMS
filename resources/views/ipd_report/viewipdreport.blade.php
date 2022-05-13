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
      @foreach($ipdreportspurchase as $report)
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
    <div class="col-sm-4"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"><strong>Total Purchase Amount:</strong></div>
    <div class="col-sm-2" id="purchaseamt">{{$purchase_amt}}</div>
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
      @foreach($ipdreportsreturn as $report)
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
    <div class="col-sm-4"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"><strong>Total Return Amount:</strong></div>
    <div class="col-sm-2">{{$return_amt}}</div>
</div>
</br>
<?php //$finalamt = $return_amt + $purchase_amt;
$finalamt = $purchase_amt; ?>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"><strong>Total Amount:</strong></div>
    <div class="col-sm-2" id="finalamt">{{$finalamt}}</div>
</div>
</br>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"><strong>Paid Amount:</strong></div>
    <div class="col-sm-2" id="finalamt">{{$totalPaid}}</div>
</div>
</br>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"><strong>Amount:</strong></div>
    <div class="col-sm-2" id="finalamt">{{$finalamt - $return_amt}}</div>
</div>
@if($totalPaid> $finalamt - $return_amt)
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"><strong>Return Amount:</strong></div>
    <div class="col-sm-2" id="finalamt">{{$totalPaid - ($finalamt - $return_amt)}}</div>
</div>
@elseif($totalPaid< $finalamt - $return_amt)
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"><strong>Left Amount:</strong></div>
    <div class="col-sm-2" id="finalamt">{{($finalamt - $return_amt) - $totalPaid}}</div>
</div>
@else
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"><strong>Balance:</strong></div>
    <div class="col-sm-2" id="finalamt">{{($finalamt - $return_amt) - $totalPaid}}</div>
</div>
@endif

<div class="service-fields mb-3">
    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
            Discount Percent(%)<input class="form-control discountcheck" type="checkbox" name="discountcheck" value="1" onchange="valueChanged()">
            </div>
        </div>
        <div class="col-lg-4 discountbox" style="display:none;">
            <div class="form-group">
            Discount Percent(%)<input class="form-control" type="number" id="discountpercent" name="discount_percent" value="">
            </div>
            <button class="btn btn-success applyBtn">Apply</button>
        </div>
    </div>
</div>
<div class="service-fields mb-3">
    <form method="post" action="{{route('storeipd')}}">
        @csrf
        <input type="hidden" name="ipd_id" value="{{$ipd_id}}">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
            <label for="exampleFormControlSelect1">Total Amount</label>
            <input class="form-control" type="number" id="" name="amount" value="" required>
            </div>
        </div>
        <div class="col-lg-4">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Select Type</label>
            <select class="form-control" name="sale_type" required>
            <option value="">Please Select</option>
            <option value="paid">Paid</option>
            <option value="refund">Refund</option>
            </select>
        </div>
        <button class="btn btn-primary submit-btn" type="submit" name="" value="submit">Submit</button>
        </div>
    </div>
    </form>
</div>
@endsection

@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

    <script>
        function valueChanged()
        {
            if($('.discountcheck').is(":checked"))
                $(".discountbox").show();
            else
                $(".discountbox").hide();
        }

        $('.applyBtn').click(function(e){
            e.preventDefault();
            var purchaseamt = $('#finalamt').text();
            var discountpercent = $('#discountpercent').val();
            var amount = (discountpercent/100)*purchaseamt;
            var updatedAmt = Math.round(purchaseamt - amount);
            $('#finalamt').text(updatedAmt);
        });
    </script>
@endpush

