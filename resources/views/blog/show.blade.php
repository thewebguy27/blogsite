@extends('bloglayouts.app')
@section('content')
<div class="header" id="topheader" style="width: 100%;
height: 100vh;
background-image:linear-gradient(rgba(0,0,0,0.8),rgba(0,0,0,0.8)), url(/storage/{{$post->img}});
background-repeat: no-repeat;
background-size: 100% 100%;
position:relative;">
    <section class=" header-section">
        <div class=" center-div text-left">
            <h1 class=" font-weight-bold text-uppercase" style="font-size:2.5rem">
          {{$post->categories->name}}
           
            </h1>
            <p  style="font-size: 1.0rem;">
                By
               {{$post->user->name}}    
</p>
<p class=" ml-5">
    <img class="img-fluid rounded-circle  " src="{{Gravatar::src(asset($post->user->email))}}">
</p>

        </div>
    </section> 
      </div>
      <section class="main-content">
          <div class=" container mt-5">
              <div class=" row">
                  <div class=" col-8">
                      <h3 class=" text-center">Content</h3>
                      <hr>
                      <p >
                          {!!$post->content!!}
                      </p>
                  </div>
              </div>
              <div class=" row">
                  <div class=" col-8">
                      @foreach ($post->tags as $tag)
                      <h3>
                          <a href="{{route('blog.tag',$tag->id)}}" class=" badge badge-secondary">
                              {{$tag->name}}
                          </a>
                      </h3>
                      @endforeach
                  </div>
              </div>
              <div class=" row">
                  <hr>
                  <div class=" col-12 d-flex align-items-center justify-content-center">
                    <div id="disqus_thread"></div>
                    <script>
                    
                    /**
                    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                    
                    var disqus_config = function () {
                    this.page.url = "{{config('app.url')}}/blog/posts/{{$post->id}}";  // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = "{{$post->id}}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };
                    
                    (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = 'https://cms-m8sv7jsllf.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                    })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                  </div>
                 
                                              
                                            
              </div>
          </div>
      </section>
      <script id="dsq-count-scr" src="//cms-m8sv7jsllf.disqus.com/count.js" async></script>
@endsection