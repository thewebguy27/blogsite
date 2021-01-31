@extends('bloglayouts.app')
@section('content')
<div class="header" id="topheader">
    <section class=" header-section">
        <div class=" center-div text-left">
            <h1 class=" font-weight-bold" style="font-size:2.5rem">
           {{$tag->name}}
           
            </h1>
            <p  style="font-size: 1.0rem;">
                Read and get updated    
</p>

        </div>
    </section>
      </div>
      <section class="main-area">
          <div class=" container-fluid">
              <div class=" row">
              <div class=" col-md-6">
                  <h1 class=" text-white ">POSTS</h1>
                  <hr style="border: 1px solid #fff">
                  <div class=" row">
                      @forelse ($posts as $p)
                      <div class=" col-md-6 mt-5">
                        <div class="card card-favorite">
                            <div class="card-img-container">
                              <img   src="/storage/{{$p->img}}" class="card-img"></a>
                            </div>
                            <div class="card-content">
                              <div class="card-meta">
                                <span class="meta-date meta-box">
                                        {{$p->created_at}}
                                </span>
                                <span class="meta-pulse meta-box">
                                  <a href="{{route('blog.show',$p->id)}}" class="card-share-number sharrre">{{$p->title}}</a>
                                </span>
                              </div>
                              <h2>
                                      <a href="#">
                                   {{$p->description}}      
                                </a>   
                              </h2>
                            </div>
                              <span class="meta-tags">
                                <a href="#" title="categories" class="categories">{{$p->categories->name}}</a> 
                            </span>
                          </div>
                      </div>
                      @empty
                      <p class=" text-center text-white">
                        No results found for <strong>{{request()->query('search')}}</strong>
                      </p>
                      @endforelse
                   
                  </div>
                  {{$posts->appends(['search'=>request()->query('search')])->links()}}
              </div>
            
              <div class="col-md-6 mt-5 ">
                  <div class=" row">
                      <div class=" col-md-8 ml-5">
                          <form action=""  method="GET"  >
                              <div class=" form-group">
                                <label class=" text-white" for=" search">Search</label>
                                <input type="text" name="search" class=" form-control" placeholder="Search" value="{{request()->query('search')}}">

                              </div>
                             
                          </form>
                      </div>
                  </div>
                  <div class=" row">
                    <div class=" col-md-8 ml-5">
                        <hr class="hr1">
                        <h3 class=" text-white">Categories</h3>
                      
                          @foreach ($categories as $c)
                          <a href="{{route('blog.category',$c->id)}}">
                            <span class=" badge badge-secondary">{{$c->name}}</span>  
                          </a>
                          @endforeach
                        
                       
                    </div>

             
              
              </div>
              <div class=" row">
                <div class=" col-md-8 ml-5">
                  <hr class=" hr1">
                  <h3 class=" text-white">Tags</h3>
                     @foreach ($tags as $t)
                     <a href="{{route('blog.tag',$t->id)}}">
                      <span class=" badge badge-secondary">{{$t->name}}</span>  
                    </a>
                     @endforeach
                 
                </div>
              </div>
                  </div>
              </div>
              </div>
          </div>
      </section>
@endsection