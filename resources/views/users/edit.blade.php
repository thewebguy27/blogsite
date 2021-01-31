@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">My profile</div>

    <div class="card-body">
        @include('partials.errors')
        <form action="{{route('users.update-profile')}}" method="POST">
        @csrf
        @method('PUT')
        <div class=" form-group">

            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="about">About</label>
            <input type="text" class=" form-control" id="about" name="about" value="{{$user->about}}" >

        </div>
        <div class=" form-group">
            <button type="submit"  class=" btn btn-success">Submit</button>
        </div>
        </form>

       
    </div>
</div>
@endsection
