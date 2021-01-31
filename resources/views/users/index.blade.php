@extends('layouts.app')
@section('content')

 <div class=" card mt-3 ">
    <div class=" card-header text-uppercase">
      Users
    </div>
    <div class=" card-body">
        @if($users->count()>0)
        <table  class="table">
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
               <th></th>
            </thead>
            <tbody>
                @foreach ($users as $u)
                <tr>
                    <td>
                      <img src="{{Gravatar::src($u->email)}}" alt="">
                    </td>
                    <td>
                        {{$u->name}}
                    </td>
                    <td>
                       {{$u->email}}
                    </td>
                   <td>
                       @if (!$u->isadmin())
                       <form action="{{route('users.makeadmin',$u->id)}}" method="POST">
                        @csrf
                        <button type="submit" class=" btn btn-success btn-sm">
                            Make admin
                        </button>  
                    </form>
                          
                       @endif
                     
                   </td>
                </tr>
                    
                @endforeach
            </tbody>
        </table>
        @else
        <h3 class=" text-center">
            No users yet
        </h3>
        @endif
  </div>
    </div>
@endsection