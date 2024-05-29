@include('admin.includes.head')
<div class="container mt-4">
    <div class="row mb-2">
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
        @foreach($articles as $article)
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">

                <h3 class="mb-0">{{$article->title}}</h3>
                <div class="mb-1 text-body-secondary">{{$article->updated_at}}</div>
                <p class="card-text mb-auto">{!! substr($article->content, 0, 100) !!}</p>
                <a href="{{route('edit-article', ['id' => $article->id])}}" class="icon-link gap-1 icon-link-hover " >
                    Edit
                </a>

                <a href="{{route('delete-article', ['id' => $article->id])}}" class="text-danger icon-link gap-1 icon-link-hover mt-2" >
                    Delete
                </a>
            </div>
            
            <div class="col-auto d-none d-lg-block">
                <img src="{{$article->featured_image}}" class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img"
                    aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                </img>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('includes.footer')