<!doctype html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
        @yield('title','INTERACTIVE')
    </title>


    <link rel="stylesheet" href="/css/appPortalInteractive.css">
    <!--<link rel="stylesheet" href="/css/app.css">-->
    <link rel="stylesheet" href="/css/appCir.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/sb-admin-2.min.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://kit.fontawesome.com/b476d3b0ae.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/fullcalendar.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.6/css/bootstrap-select.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/datatables.min.css"/>
    </head>


<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <!--
    <a class="navbar-brand" href="#">CIRO by&nbsp;&nbsp;<img src="https://ciro.interactive-mr.com/logo.gif" width="120px"></a>
    -->
    <a class="navbar-brand" href="#"><img src="http://ciro.interactive-mr.com/logo.gif" width="120px"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="/generaTarget"><i class="fa fa-folder-o" aria-hidden="true"></i> TARGET</a>
                    </li>



        </ul>


        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
        @else
            <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                       <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('userManagement') }}">
                                    Gestione Utenti
                                </a>

                        <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                        </a>
                        <form id="logout-form" action="" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
        @endguest
        </ul>
    </div>
</nav>






<main role="main" class="mycontainer">

  @yield('content')


</main>

@section('footer')
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/js/bootstrap4-toggle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="/js/fullcalendar.js"></script>
    <script src="/js/fullcalendar-columns.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/sb-admin-2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.6/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="/vendor/chart.js/Chart.min.js"></script>
    <script src="https://kit.fontawesome.com/b476d3b0ae.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/datatables.min.js"></script>




@show

</body>
</html>
