@extends('layouts.app')

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Sales</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Sales</li>
	</ul>
</div>

@section('content')
<div class="alert alert-success d-none" id="msg_div">
    <span id="res_message"></span>
</div>
<div class="container">
    <form method="post" id="contact_us" action="javascript:void(0)">
    <input class="typeahead form-control" type="text" name="medicinename"></br>
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
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php $count = 1; ?>
    @if(!empty($orderitems) && isset($orderitems))
    @foreach($orderitems as $orderitem)
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$orderitem->medicine_category}}</td>
      <td>{{$orderitem->medicine_name}}</td>
      <td>{{$orderitem->price}}</td>
      <td><input type="text" id="qty" value="{{$orderitem->quantity}}"></td>
      <td><a href="#">Edit</a>||<a href="#">Delete</a></td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
    </div>
  </div>

</div>
<div class="card">
    <div class="card-header text-center font-weight-bold">
    <span></span>
    </div>
</div>
<div class="card">
    <div class="card-header text-center font-weight-bold">
    <a href="{{route('checkout')}}" class="btn btn-success text-center">Submit and continue</a>
    </div>
</div>
@endsection

@push('page-js')
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">
    var path = "{{ route('autocomplete')  }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { term: query }, function (data) {
                return process(data);
            });
        }
    });

$(document).ready(function(){
$('#send_form').click(function(e){
    e.preventDefault();
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
            $('#res_message').html(response.message);
            $('#msg_div').removeClass('d-none');
            setTimeout(function(){// wait for 5 secs(2)
            location.reload(); // then reload the page.(3)
            }, 5000);
            document.getElementById("contact_us").reset();
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },10000);
         //--------------------------
      }});
   });
});
</script>
@endpush
