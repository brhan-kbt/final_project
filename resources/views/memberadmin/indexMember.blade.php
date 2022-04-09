@extends('memberadmin.dashboard')
@section('content')
<main class="container">
    <a href="{{action('MemberController@create')}}" class="btn btn-success float-right mb-20">Add Member</a>

<table class="table">

    <thead>
        <tr>
        <th scope="col">Full Name</th>
        <th scope="col">Mother Name</th>
        <th scope="col">Baptismal Name</th>
        <th scope="col">Rep-F-Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Address</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
        <tr>
        <td>{{$member->fullName}}</td>
        <td>{{$member->motherName}}</td>
        <td>{{$member->baptismalName}}</td>
        <td>{{$member->repetanceFatherName}}</td>
        <td>{{$member->phone}}</td>
        <td>{{$member->address}}</td>
        <td>
            <button class="btn-sm btn-danger">
               {{$member->status}}
            </button>

        </td>
        <td>
            <div class="d-flex">
                <a href="{{action('MemberController@edit', ['manage_member'=>$member->id])}}" class="btn btn-success">Edit</a>
            
            
                {{-- {!!Form::open(['action'=>['AdminController@destroy', $member->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
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
{{-- 
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: redirectTo('member/manage-members'),
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'fullName', name: 'fullName'},
            {data: 'motherName', name: 'motherName'},
            {data: 'baptismalName', name: 'baptismalName'},
            {data: 'repetanceFatherName', name: 'repetanceFatherName'},
            {data: 'phone', name: 'phone'},
            {data: 'status', name: 'status'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script> --}}