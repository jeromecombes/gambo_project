<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>VWPP Database</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}?rev=20210330" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.min.css') }}?rev=20210330" rel="stylesheet">
        <link href="{{ asset('css/dataTables/jquery.dataTables_themeroller.css') }}?rev=20210330" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}?rev=20210330" rel="stylesheet">
        <link href="{{ asset('css/print.css') }}?rev=20210330" rel="stylesheet" media='print'>

        <link rel='shortcut icon' href="{{ asset('favicon.ico') }}" type='image/x-icon' />

        <script type='text/JavaScript' src='/js/jquery-ui-1.10.4/jquery-1.10.2.js?rev=20210330'></script>
        <script type='text/JavaScript' src='/js/jquery-ui-1.10.4/ui/jquery-ui.js?rev=20210330'></script>
        <script type='text/JavaScript' src='/js/dataTables/jquery.dataTables.min.js?rev=20210330'></script>
        <script type='text/JavaScript' src='/js/dataTables/sort.js?rev=20210330'></script>
        <script type='text/JavaScript' src='/js/CJScript.js?rev=20210330'></script>
        <script type='text/JavaScript' src='/js/script.js?rev=20210330'></script>
    </head>

    <body>

        <div id='body'>
            <div class="content">
                <div id='title'>
                    @if(!Auth::user()->admin)
                        VWPP Database
                    @elseif(!session('student'))
                        VWPP Database - Admin
                    @else
                        VWPP Database - {{ session('student_name') }}
                    @endif
                </div>
                <div id='loginName'>
                    <span>
                    @if(session('login_name'))
                        {{ session('login_name') }}
                    @endif
                    </span>
                    <span class='ui-icon ui-icon-triangle-1-s' id='myMenuTriangle'></span><br/>
                    <div id='myMenu'>
                        <a href="{{ route('account.index') }}">My Account</a><br/>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>

                <div class='ui-tabs ui-widget ui-widget-content ui-corner-all'>

                    @if(Auth::user()->admin)
                        @if(session('student'))
                            @include('includes.menu_admin_student')
                        @else
                            @include('includes.menu_admin')
                        @endif
                    @else
                        @include('includes.menu_student')
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success"> {{ session('success') }}</div>
                    @endif

                    @if (session('warning'))
                        <div class="alert alert-warning"> {{ session('warning') }}</div>
                    @endif

                    <section id='content'>
                        @yield('content')
                    </section> <!-- content -->

                </div>	<!-- tabs -->
            </div>
            <footer>
                <a href='http://www.jeromecombes.com' target='_blank'>Created by jeromecombes.com</a>
            </footer>
        </div> <!-- id=body or login1-->
    </body>
</html>
