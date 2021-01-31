@extends('layouts.app')
@section('content')
<div class=" d-flex justify-content-end">
   <a href="{{route('tags.create')}}" class=" btn btn-success text-white mt-2"> Add tag</a>
</div>
<div class=" card mt-3 ">
    <div class=" card-header text-uppercase">
        tag
    </div>
    <div class=" card-body">
      @if($tags->count()>0)
        <table  class=" table">
            <thead>
                <th>Name</th>
                <th>Created_at</th>
                <th>Post Count</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($tags as $c)
                <tr>
                    <td>
                        {{$c->name}}
                    </td>
                    <td>
                        {{$c->created_at}}
                    </td>
                    <td>
                    {{$c->posts->count()}} <!--we are not calling posts() in tag model if we wanna use query then we call-->
                    </td>
                    <td>
                        <a href="{{route('tags.edit',$c->id)}}" class=" btn btn-info btn-sm text-white">
                            Edit
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{$c->id}})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
  <!-- Modal -->
  <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
  <form action="" method="POST" id="delete-form">
    @csrf
    @method('DELETE')

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModal">Delete tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p class=" text-center text-bold text-danger">
        Are you sure??
      </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Go back</button>
        <button type="submit" class="btn btn-danger">Yes,Delete</button>
      </div>
    </div>
  </form>
    </div>
  </div>
  @else
  <h3 class=" text-center">No tag yet!</h3>
  @endif
    </div>
</div>
@endsection
@section('scripts')
<script>
    function handleDelete(id){
    $("#delete").modal('show');
    var form=document.getElementById('delete-form');
    form.action='/tags/'+id;
    }
</script>
@endsection