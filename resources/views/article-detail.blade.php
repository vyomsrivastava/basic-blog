@include('includes.header')
<div class="container">
    <div class="card single_post mt-4">
        <div class="body">
            <div class="img-post"> <img style="width: 100% ; height: 400px;" class="d-block img-fluid" src="{{$article->featured_image}}"
                    alt="First slide"></div>
            
            {!! $article->content !!}
        </div>
    </div>
    </div>
@include('includes.footer')