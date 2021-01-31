@extends('layouts.app')
@section('content')
<div class=" d-flex justify-content-end">
    <a href="{{route('posts.create')}}" class=" btn btn-success text-white mt-2"> Add Posts</a>
 </div>
 <div class=" card mt-3 ">
    <div class=" card-header text-uppercase">
       Posts
    </div>
    <div class=" card-body">
        @if($posts->count()>0)
        <table  class="table">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($posts as $p)
                <tr>
                    <td>
                        <img  src="/storage/{{$p->img}}" width="120px" height="60px" >
                    </td>
                    <td>
                        {{$p->title}}
                    </td>
                    <td>
                       <a href="{{route('categories.edit',$p->categories->id)}}">
                        {{$p->categories->name}}
                       </a>
                    </td>
                    <td>
                     @if(!$p->trashed())
                     <a href="{{route('posts.edit',$p->id)}}" class=" btn btn-info btn-sm text-white">Edit</a>
                     @else
                     <form action="{{route('restore-posts',$p->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                     <button  class=" btn btn-info btn-sm text-white">Restore</button>
                     </form>
                     @endif
                     <form action="{{route('posts.destroy',$p->id)}}" method="POST" class=" mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=" btn btn-danger btn-sm">
                            {{$p->trashed()?'Delete':'Trash'}}
                        </button>
                     </form> 
                    </td>
                </tr>
                    
                @endforeach
            </tbody>
        </table>
        @else
        <h3 class=" text-center">
            No posts yet
        </h3>
        @endif
  </div>
    </div>
@endsection