@extends('financeAdmin.dashboard')
@section('content')

    
<main class="container">
<table class="table">

    <a href="{{action('ServicePaymentController@create')}}" class="btn btn-success m-20">Add Service Payment</a>
    <thead>
        <tr>
        <th scope="col">Member Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Date</th>
        <th scope="col">Amount</th>
        <th scope="col">Reason</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($servicePayments as $servicePayment)
        <tr>
        <td>{{$servicePayment->memberName}}</td>
        <td>{{$servicePayment->phone}}</td>
        <td>{{$servicePayment->paidDate}}</td>
        <td>{{$servicePayment->amount}}</td>
        <td>{{$servicePayment->reason}}</td>
        <td>
            <div class="d-flex">
                <a href="{{action('ServicePaymentController@edit', ['servicePayment'=>$servicePayment->id])}}" class="btn btn-success">Edit</a>
            </div>
            
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
</main>



@endsection


      