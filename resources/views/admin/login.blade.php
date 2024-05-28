@include('admin.includes.header')
<form method="POST" action="{{ route('login')}}" autocomplete="off">
    @csrf
    <img class="mb-4" src="https://geekyhumans.com/wp-content/uploads/2022/09/owl.png" alt="" width="150" height="150">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    @if (Session::has('message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {!! Session::get('message') !!}
    </div>
    @endif

    <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email"
            required>
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password"
            required>
        <label for="floatingPassword">Password</label>
    </div>


    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2024</p>
</form>


@include('includes.footer')