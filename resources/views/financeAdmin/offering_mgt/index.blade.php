@extends('financeAdmin.dashboard')
@section('content')

    
<main class="container">
<table class="table">

    <a href="{{action('OfferingController@create')}}" class="btn btn-success m-20">Add Offering</a>
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
        @foreach ($offerings as $offering)
        <tr>
        <td>{{$offering->memberName}}</td>
        <td>{{$offering->phone}}</td>
        <td>{{$offering->date}}</td>
        <td>{{$offering->amount}}</td>
        <td>{{$offering->reason}}</td>
        <td>
            <div class="d-flex">
                <a href="{{action('OfferingController@edit', ['offering'=>$offering->id])}}" class="btn btn-success">Edit</a>
            </div>
            
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
</main>



@endsection


      