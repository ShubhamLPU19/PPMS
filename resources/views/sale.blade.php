@extends('layouts.app')

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Sales</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Sales</li>
	</ul>
</div>
@endpush

@section('content')
<div class="alert alert-success d-none" id="msg_div">
    <span id="res_message"></span>
</div>

<div class="container">
    <form method="post" id="contact_us" action="javascript:void(0)">
    <div class="row">
    <div class="col-sm-12">
        <input class="typeahead form-control" type="text" id="search" name="medicinename" placeholder="Please enter medicine name"></br>
    </div>
    <!-- <div class="col-sm-6">
        <div class="form-group">
            <select class="select2 form-select form-control" name="batch_name" id="batch_name" required>
                <option value="">Select Batch</option>
                <option value=""></option>
            </select>
        </div>
    </div> -->
    </div>
    <div class="row">
    <div class="col-sm-6">
      <input type="number" class="form-control" placeholder="Quantity" name="quantity">
    </div>
    <div class="col">
     <button type="submit" id="send_form" class="btn btn-success">Add</button>
    </div>
    </form>
</div>
</div>

<div class="container mt-4">

  <div class="card">
    <div class="card-header text-center font-weight-bold">
      <h2>Cart</h2>
    </div>

    <div class="card-body">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Medicine Category</th>
      <th scope="col">Medicine Name</th>
      <th scope="col">Amount</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total Amount</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php $count = 1; $totalamt = 0.0; $totalQty = 0;?>
    @if(!empty($orderitems) && isset($orderitems))
    @foreach($orderitems as $orderitem)
    <?php
    $totalamt+= $orderitem->price * $orderitem->quantity;
    $totalQty+= $orderitem->quantity;
    ?>
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$orderitem->medicine_category}}</td>
      <td id="mname">{{$orderitem->medicine_name}}</td>
      <td>{{$orderitem->price}}</td>
      <td><input type="text" id="qty" value="{{$orderitem->quantity}}"></td>
      <td>{{ $orderitem->price * $orderitem->quantity }}</td>
      <input type="hidden" id="batch" name="batch"  value="{{$orderitem->batch_no}}"/>
      <td><button class="btn btn-success text-center update" data-id="{{$orderitem->id}}">Update</button>||<button data-id="{{$orderitem->id}}" class="btn btn-danger text-center delete">Delete</button></td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
    </div>
  </div>

</div>
<div class="card">
    <!-- <div class="card-header text-center font-weight-bold">
    <span>Total Quantity: {{ $totalQty }}</span>
    </div> -->
    <div class="card-header text-center font-weight-bold">
    <span>Total Amount: {{ $totalamt }}</span>
    </div>
</div>

<div class="service-fields mb-3">
    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
            Move to Draft<input class="form-control draftcheck" type="checkbox" name="draftcheck" value="1" onchange="valueChanged()">
            </div>
        </div>
        <div class="col-lg-6 draftbox" style="display:none;">
            <div class="form-group">
                <label>Bill To<span class="text-danger">*</span></label>
                <input class="form-control" type="text"  id="billTo" name="name" value="">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header text-center font-weight-bold">
    <a href="{{route('checkout')}}" class="btn btn-success text-center submitBtn">Submit and continue</a>
    </div>
</div>
<div class="card">
    <div class="card-header text-center font-weight-bold">
    <a href="javascript:void(0)" class="btn btn-success text-center draftBtn">Move to draft</a>
    </div>
</div>
@endsection

@push('page-js')

# Test
<link src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"></link>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

/* new link */
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#search").autocomplete({
            source: function(request, response) {
                $.ajax({
                url: "{{ route('autocomplete')  }}",
                data: {
                    term : request.term
                },
                dataType: "json",
                success: function(data){
                var resp = $.map(data,function(obj){
                    var result = obj.name + '_' + obj.expiry + '_' + obj.qty + '_' + obj.batch;
                    return result;

                });

                response(resp);
                }
            });
        },
        minLength: 1
        });
    });

$(document).ready(function(){
$('#send_form').click(function(e){
    // e.preventDefault();
    /*Ajax Request Header setup*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   $('#send_form').html('Please wait..');

   /* Submit form data using ajax*/
   $.ajax({
      url: "{{ route('addorder')}}",
      method: 'post',
      data: $('#contact_us').serialize(),
      success: function(response){
         console.log(response);
            $('#send_form').html('Submit');
            $('#res_message').show();
            $('#res_message').html(response);
            $('#msg_div').removeClass('d-none');
            setTimeout(function(){
            location.reload();
            },1000);
            document.getElementById("contact_us").reset();
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },1000);
         //--------------------------
      }});
   });
});
$('.update').click(function(e){
    alert("Testing");
    var qty = $("#qty").val();
    var id = $(this).attr("data-id");
    var mname = $("#mname").text();
    var batch = $("#batch").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   $.ajax({
      url: "itemupdate/"+id,
      type: 'PUT',
      data: {qty:qty,id:id,mname:mname,batch:batch},
      success: function(response){
            $('#res_message').show();
            $('#res_message').html(response);
            $('#msg_div').removeClass('d-none');
            setTimeout(function(){
            location.reload();
            }, 1000);
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },1000);
        }
    });
});

$('.delete').click(function(e){
    var qty = $("#qty").val();
    var id = $(this).attr("data-id");
    var mname = $("#mname").text();
    var batch = $("#batch").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  $.ajax({
    url: "itemdelete/"+id,
    type: 'DELETE',
    data: {qty:qty,id:id,mname:mname,batch:batch},
    success: function(response){
      console.log(response);
        $('#res_message').show();
        $('#res_message').html(response);
        $('#msg_div').removeClass('d-none');
        setTimeout(function(){
        location.reload();
        }, 1000);
        setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
        },1000);
    }
  });
});

function valueChanged()
{
    if($('.draftcheck').is(":checked")){
        $(".draftbox").show();
        $(".draftBtn").show();
        $(".submitBtn").hide();
    }else{
        $(".draftbox").hide();
        $(".draftBtn").hide();
        $(".submitBtn").show();
    }
}

$('.draftBtn').click(function(e){
    var name = $("#billTo").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   $.ajax({
      url: "{{route('draft')}}",
      type: 'POST',
      data: {name:name},
      success: function(response){
            $('#res_message').show();
            $('#res_message').html(response);
            $('#msg_div').removeClass('d-none');
            setTimeout(function(){
            location.reload();
            }, 1000);
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },1000);
        }
    });
});

</script>
@endpush
