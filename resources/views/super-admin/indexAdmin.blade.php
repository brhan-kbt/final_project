@extends('super-admin.dashboard')


@section('content')
<main class="container">
<table class="table">

    <a href="{{action('AdminController@create')}}" class="btn btn-success m-20">Add Manager</a>
    <thead>
        <tr>
        <th scope="col">Full Name</th>
        <th scope="col">username</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mgrs as $mgr)
        <tr>
        <td>{{$mgr->adminName}}</td>
        <td>{{$mgr->user->username}}</td>
        <td>{{$mgr->adminRole}}</td>
        <td>
            <div class="d-flex">
                <a href="{{action('AdminController@edit', ['managemgr'=>$mgr->id])}}" class="btn btn-success">Edit</a>
            
            
                {!!Form::open(['action'=>['AdminController@destroy', $mgr->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
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