@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1>Oder Details</h1><br><br>



    <table class="table table-hover">
        <thead style="background-color:#03d3fc">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name:</th>
            <th scope="col">Phone:</th>
            <th scope="col">Address:</th>
            <th scope="col">Details:</th>
            <th scope="col">Not Complete</th>
          </tr>
        </thead>
        <tbody>


            @foreach ($orders as $order )


            <tr>
                @if($order->status ==  0)
          <th scope="row">{{ $order->id }}</th>
            <td id="{{ $order->id }}-name">{{ $order->name }}</td>
            <td id="{{ $order->id }}-phone">{{ $order->phone }}</td>
            <td id="{{ $order->id }}-address">{{ $order->address }}</td>
            <td  style="display:none;" id="{{ $order->id }}-nic">{{ $order->nic }}</td>
            <td   style="display:none;" id="{{ $order->id }}-details">{{ $order->details }}</td>
            <td   style="display:none;" id="{{ $order->id }}-image">{{ asset('public/image/').'/'.$order->image}}</td>
            <td   style="display:none;" id="{{ $order->id }}-status">{{ $order->status }}</td>

            <td><button type="button"  onclick="show_details({{ $order->id }})" data-details="{{ $order->details}}" data-image="{{ $order->image}}" class="btn btn-success" data-toggle="modal" data-target="#myModal">Details</button></td>
            <td><button type="button" onclick="changeStatus({{ $order->id }})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><?php if ( $order->status == true) { echo 'Completed'; }else { echo 'Not Complete'; } ?>s</button></td>
                @endif
        </tr>
            @endforeach

        </tbody>
      </table>







<div style="padding-top: 100px;">

      <hr><h1>Completed Orders</h1>

      <table class="table table-hover">
        <thead style="background-color: #4CAF50">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name:</th>
            <th scope="col">Phone:</th>
            <th scope="col">Address:</th>
            <th scope="col">Details:</th>
            <th scope="col">Complete</th>
          </tr>
        </thead>
        <tbody>


            @foreach ($orders as $order )


            <tr>
                @if($order->status ==  1)
          <th scope="row">{{ $order->id }}</th>
            <td id="{{ $order->id }}-name">{{ $order->name }}</td>
            <td id="{{ $order->id }}-phone">{{ $order->phone }}</td>
            <td id="{{ $order->id }}-address">{{ $order->address }}</td>
            <td  style="display:none;" id="{{ $order->id }}-nic">{{ $order->nic }}</td>
            <td   style="display:none;" id="{{ $order->id }}-details">{{ $order->details }}</td>
            <td   style="display:none;" id="{{ $order->id }}-image">{{ asset('public/image/').'/'.$order->image}}</td>
            <td   style="display:none;" id="{{ $order->id }}-status">{{ $order->status }}</td>

            <td><button type="button"  onclick="show_details({{ $order->id }})" data-details="{{ $order->details}}" data-image="{{ $order->image}}" class="btn btn-success" data-toggle="modal" data-target="#myModal">Details</button></td>
            <td><button type="button"  class="btn btn-primary" data-toggle="modal" data-target=""><?php if ( $order->status == true) { echo 'Completed'; }else { echo 'Not Complete'; } ?>s</button></td>
                @endif
        </tr>
            @endforeach

        </tbody>
      </table>
    </div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Complete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <form id="myForm" action="" method="POST">
              @csrf
            <button type="submit" class="btn btn-primary">Complete</button>
          </form>
        </div>
      </div>
    </div>
  </div>





    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title"><div id="show_name"></div></h2>
          </div>
          <div class="modal-body">
           <h3> NIC: <span id="show_nic"></span> </h3>
           <h3>Phone: <span id="show_phone"></span> </h3>
            <h3>Address: <span id="show_address"></span> </h3>
                <h3>Details: <span id="show_detailss"></span> </h3>
          <h3>Image: <div class="row">
              <div class="col-md-6 col-lg-6">
                  <img class="col-md-12 col-lg-12 col-sm-12" src="" id="myImg" alt="">
                </div>
            </div>
        </h3>


        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>





  <script>
  function show_details(id) {

//Preparing the values
let name =document.getElementById(id+'-name').innerHTML;
let nic =document.getElementById(id+'-nic').innerHTML;
let phone =document.getElementById(id+'-phone').innerHTML;
let address =document.getElementById(id+'-address').innerHTML;
let details =document.getElementById(id+'-details').innerHTML;
let image =document.getElementById(id+'-image').innerHTML;
let status =document.getElementById(id+'-status').innerHTML;



        //Setting the values
        document.getElementById("show_name").innerHTML = name;
        document.getElementById("show_nic").innerHTML = nic;
        document.getElementById("show_phone").innerHTML = phone;
        document.getElementById("show_address").innerHTML = address;
        document.getElementById("show_detailss").innerHTML=details;
        //document.getElementById("show_image").innerHTML = image;
        document.getElementById("myImg").src = image;
    }


    function changeStatus($id){
        let id =$id;
        document.getElementById("myForm").action = "/pharmacy/status/"+id;
    }

  </script>



@endsection
