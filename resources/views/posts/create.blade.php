@extends('layouts.app')
@section('content')
<div class="card">
    <div class=" card-header text-uppercase">
        {{isset($post)?'Edit  posts':'Create posts'}}
    </div>
    <div class=" card-body">
        @include('partials.errors')
        <form action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($post))
        @method('PUT')
       
        @endif
        <div class=" form-group">
            <label for="title">
                Title
            </label>
            <input type="text" class=" form-control" id="title" name="title" value="{{isset($post)?$post->title:''}}">
        </div>
        <div class=" form-group">
            <label for="des">
               Description
            </label>
          <textarea class=" form-control" id="des" name="des">{{isset($post)?$post->description:''}}</textarea>
        </div>
        <div class=" form-group">
            <label for="content">
               Content
            </label>
          <input id="content" type="hidden" name="content" value="{{isset($post)?$post->content:''}}">
          <trix-editor input="content"></trix-editor>
        </div>
        <div class=" form-group">
            <label for="pub_at">
                Published  At
            </label>
            <input type="text" class=" form-control" id="pub_at" name="pub_at" value="{{isset($post)?$post->published_at:''}}">
        </div>
        @if(isset($post))
        <div class=" form-group">
            <img src="/storage/{{$post->img}}" alt="" style="width: 100%">
        </div>
        @endif
        <div class=" form-group">
            <label for="img">
                Image
            </label>
            <input type="file" class=" form-control" id="img" name="img">
        </div>
        
        <div class=" form-group">
            <label for="category">Category</label>
            <select class=" form-control" name="category" id="category">
                @foreach ($categories as $c)
                    <option value="{{$c->id}}"
                        @if (isset($post))
                        @if ($c->id == $post->category_id)
                        selected
                    @endif
                    @endif
                    >
                        {{$c->name}}
                    </option>
                @endforeach

            </select>
        </div>
        <div class=" form-group">
         @if($tags->count()>0)
         <label for="tags">Tags</label>
         <select name="tags[]" id="tags" class=" form-control tags-selector" multiple>
             @foreach($tags as $t)
             <option value="{{$t->id}}"
                @if(isset($post))
                @if($post->hastag($t->id))
                selected
                @endif
                @endif
                >
                 {{$t->name}}
             </option>
             @endforeach
         </select>
         @endif
        </div>
        <div class=" form-group text-center">
            <button type="submit" class=" btn btn-success">
             {{isset($post)?'Edit post':'Create Post'}}
            </button>
        </div>
        </form>
    </div>    
</div>    
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        flatpickr('#pub_at',{
            enableTime:true,
            enableSeconds:true
        });
        $(document).ready(function() {
    $('.tags-selector').select2();
});
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection