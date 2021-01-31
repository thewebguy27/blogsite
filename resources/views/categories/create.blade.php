@extends('layouts.app')
@section('content')
<div class=" card mt-3 ">
    <div class=" card-header text-uppercase">     
      {{isset($category)?'Edit Category':'Add Category'}}
        </div>
    <div class=" card-body">
    @include('partials.errors')
        <form action="{{isset($category)? route('categories.update',$category->id):route('categories.store')}}" method="POST">
            @csrf
            <!--making put request for upating-->
            @if(isset($category))
            @method('PUT')
            @endif
            <div class=" form-group">
                <label for="name">Name</label>
                <!--value should be of pervious-->
                    <input type="text" class=" form-control" name="name" id="title" value="{{isset($category)?$category->name:''}}">
            </div>
            <div class="form-group text-center">
                <button class=" btn btn-success">
                    {{isset($category)?'Update Category':'Add Category'}}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection