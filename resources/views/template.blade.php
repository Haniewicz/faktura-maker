<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('dashboard.css') }}" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>



        <title>FakturaMaker</title>
    </head>
    <body>
        <div id="viewport">
          <!-- Sidebar -->
          <div id="sidebar">
            <header>
              <a href="#">Faktura-Maker</a>
            </header>
            <ul class="nav">
              <li>
                <a href="/dashboard">
                  <i class="zmdi zmdi-view-dashboard"></i> Dashboard
                </a>
              </li>
              <li>
                <a href="/add_vat">
                  <i class="zmdi zmdi-link"></i> Wystaw nową fakturę
                </a>
              </li>
              <li>
                <a href="/list_vats">
                  <i class="zmdi zmdi-widgets"></i> Lista faktur
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="zmdi zmdi-calendar"></i> Events
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="zmdi zmdi-info-outline"></i> About
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="zmdi zmdi-settings"></i> Services
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="zmdi zmdi-comment-more"></i> Contact
                </a>
              </li>
            </ul>
          </div>
          <!-- Content -->
          <div id="content">
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <ul class="nav navbar-nav navbar-right">
                  <li>
                    <a href="#"><i class="zmdi zmdi-notifications text-danger"></i>
                    </a>
                  </li>
                  <li><a href="#" style="color:green">{{Auth::user()->name}}</a></li>
                  <li><a href="/logout" style="color:red">Wyloguj</a></li>
                </ul>
              </div>
            </nav>
            <div class="container-fluid">
                @include('contents.'.$content)
            </div>
          </div>
        </div>
        @if(isset($javascript))
            @include('javascript.'.$javascript)
        @endif
    </body>
</html>
