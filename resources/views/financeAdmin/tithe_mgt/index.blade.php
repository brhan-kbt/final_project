@extends('financeAdmin.dashboard')
@section('content')

    
<main class="container">
<table class="table">

    <a href="{{action('TitheController@create')}}" class="btn btn-success m-20">Add Tithe</a>
    <thead>
        <tr>
        <th scope="col">Member Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Date</th>
        <th scope="col">Amount</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tithes as $tithe)
        <tr>
        <td>{{$tithe->memberName}}</td>
        <td>{{$tithe->phone}}</td>
        <td>{{$tithe->date}}</td>
        <td>{{$tithe->amount}}</td>
        <td>
            <div class="d-flex">
                <a href="{{action('TitheController@edit', ['tithe'=>$tithe->id])}}" class="btn btn-success">Edit</a>
{{--             
            
                {!!Form::open(['action'=>['TitheController@destroy', $tithe->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete', ['class'=>'btn btn-outline-danger'])}}
                {!!Form::close()!!}  --}}


            </div>
            
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
</main>



@endsection


      