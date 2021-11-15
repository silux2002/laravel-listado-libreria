<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Jumbotron example · Bootstrap v5.1</title>
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/jumbotron.css')}}" rel="stylesheet">
    <style>
      .repiterror{
        background-color:red;
      }
    </style>
  </head>
  <body>
    <main>
      <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
            @section('header')
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Libraria List</span>
            </a>
            @show
            @yield('css')
        </header>
        <div class="content">
            @yield('content')
            
        </div>
      </div>
    </main>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    @yield('js')
  </body>
</html>
