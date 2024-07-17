<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CCS Report Development</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    
    <!-- Local CSS -->
    <link rel="stylesheet" href="{{ asset('css/sidenav0.css') }}">
    <style>
        * {
            box-sizing: border-box;
        }
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            display: flex;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }
        .sidenav {
            width: 250px;
            flex-shrink: 0;
        } 
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow-y: auto;
            padding: 20px;
            background-color: #fafbfe;
        }
    </style>

  
  </head>

  <body>

    <div class="wrapper">
            @include('includes.sidenav-admin')
        <div class="main p-3">
            @yield('content')
        </div>
    </div>
     <!-- Local JS -->
    <script src="{{ asset('js/sidenav0.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
    

</body>
</html>