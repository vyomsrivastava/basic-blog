@include('includes.header')
<main class="container mt-4">
    @if (Session::has('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    @if (Session::has('error'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('error') }}
    </div>
    @endif
    @if(count($posts) > 0)
      <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
          <div class="col-md-6 px-0">
              <h1 class="display-4 fst-italic">{{$posts[0]->title}}</h1>
              <p class="lead my-3">{!! $posts[0]->content !!}</p>
              <p class="lead mb-0"><a href="{{route('detail-article', ['id' => $posts[0]->id])}}"
                      class="text-white fw-bold">Continue reading...</a></p>
          </div>
      </div>
    @endif
    <div class="row mb-2">
        @foreach($posts as $post)
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0">{{$post->title}}</h3>
                    <div class="mb-1 text-muted">{{$post->updated_at}}</div>
                    <p class="card-text mb-auto">{!! substr($post->content, 0, 100) !!}</p>
                    <a href="{{route('detail-article', ['id' => $post->id])}}" class="stretched-link">Continue
                        reading</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <img src="{{$post->featured_image}}" class="bd-placeholder-img" width="200" height="250"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false"></img>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</main>
@include('includes.footer')