@extends('layouts.app')
@section('content')
<div class=" card mt-3 ">
    <div class=" card-header text-uppercase">     
      {{isset($tag)?'Edit tag':'Add tag'}}
        </div>
    <div class=" card-body">
        @include('partials.errors')
        <form action="{{isset($tag)? route('tags.update',$tag->id):route('tags.store')}}" method="POST">
            @csrf
            <!--making put request for upating-->
            @if(isset($tag))
            @method('PUT')
            @endif
            <div class=" form-group">
                <label for="name">Name</label>
                <!--value should be of pervious-->
                    <input type="text" class=" form-control" name="name" id="title" value="{{isset($tag)?$tag->name:''}}">
            </div>
            <div class="form-group text-center">
                <button class=" btn btn-success">
                    {{isset($tag)?'Update tag':'Add tag'}}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection