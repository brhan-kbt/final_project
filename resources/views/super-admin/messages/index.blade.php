@extends('super-admin.dashboard')
@section('content')
<main class="container">
<table class="table">

    <h3>List of Messages</h3>
    <thead>
        <tr>
        <th scope="col">Sender Name</th>
        <th scope="col">Email</th>
        <th scope="col">Title</th>
        <th scope="col">Message</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($allMessages as $allMessage)
        <tr>
        <td>{{$allMessage->senderName}}</td>
        <td>{{$allMessage->email}}</td>
        <td>{{$allMessage->title}}</td>
        <td>{{$allMessage->allMessage}}</td>
        <td>
            <div class="d-flex">
                <a href="{{action('MessageController@show',$allMessage->id)}}" class="btn btn-success">Detail</a>
            
            
                {!!Form::open(['action'=>['MessageController@destroy', $allMessage->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete', ['class'=>'btn btn-outline-danger'])}}
                {!!Form::close()!!} 


            </div>
            
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
</main>
@endsection