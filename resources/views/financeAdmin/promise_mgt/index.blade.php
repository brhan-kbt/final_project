@extends('financeAdmin.dashboard')
@section('content')

    
<main class="container">
<table class="table">

    <a href="{{action('PromiseController@create')}}" class="btn btn-success m-20">Add Promise</a>
    <thead>
        <tr>
        <th scope="col">Member Name</th>
        <th scope="col">Promised Amount</th>
        <th scope="col">Paid Amount</th>
        <th scope="col">Balance</th>
        <th scope="col">Promised Date</th>
        <th scope="col">Reason</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($promises as $promise)
        <tr>
        <td>{{$promise->memberName}}</td>
        <td>{{$promise->promisedAmount}}</td>
        <td>{{$promise->paidAmount}}</td>
        <td>{{$promise->balance}}</td>
        <td>{{$promise->promisedDate}}</td>
        <td>{{$promise->reason}}</td>
        <td>
            <div class="d-flex">
                <a href="{{action('PromiseController@edit', ['promise'=>$promise->id])}}" class="btn btn-success">Edit</a>
            </div>
            
        </td>
        </tr>
        @endforeach 
    </tbody>
</table>
</main>



@endsection


      