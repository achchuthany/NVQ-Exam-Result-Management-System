<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <style>
#cover {
    /* background: #222 url('https://unsplash.it/1920/1080/?random') center center no-repeat; */
    background-size: cover;
    height: 100%;
    display: flex;
    align-items: center;
    position: relative;
}

#cover-caption {
    width: 100%;
    position: relative;
    z-index: 1;
}

/* only used for background overlay not needed for centering */
form:before {
    content: '';
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    background-color: rgba(100,100,100,0.5);
    z-index: -1;
    border-radius: 10px;
}
</style>
    </head>
    <body>
    <div>
       @include('includes.message')
       @include('includes.errors')
       <section id="cover" class="min-vh-100">
        <div id="cover-caption">
            <div class="container">
                <div class="row text-light">
                    <div class="form offset-md-7 col-md-5 offset-lg-8 col-lg-4  col-sm-12 px-5">
                        <h1 class="display-4 py-2">Sign In</h1>
                    <form method="POST" action="{{ route('signin') }}">
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control rounded-pill shadow-sm " id="email" name="email">
                            </div>
                            <div class="form-group">
                              <label for="password ">Password</label>
                              <input type="password" class="form-control rounded-pill shadow-sm " id="password" name="password">
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberme">
                                <label class="custom-control-label" for="rememberme">Remember Me</label>
                              </div>
                            <div class="form-group align-items-center">
                            <a href="#" class="btn btn-link text-white">Forgot Password?</a>
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary rounded-pill shadow-sm  float-right">Sign In</button>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
    </section>
    </div>
        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    </body>
</html>
