@include('admin.includes.head')
<div class="container mt-4">
    <div class="row mb-2">
        @foreach($articles as $article)
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
                <h3 class="mb-0">{{$article->title}}</h3>
                <div class="mb-1 text-body-secondary">{{$article->updated_at}}</div>
                <p class="card-text mb-auto">{!! substr($article->content, 0, 100) !!}</p>
                <a href="{{route('edit-article', ['id' => $article->id])}}" class="icon-link gap-1 icon-link-hover stretched-link">
                    Edit
                    <svg class="bi">
                        <use xlink:href="#chevron-right"></use>
                    </svg>
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