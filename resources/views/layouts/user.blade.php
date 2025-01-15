<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" >
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap JS (requires jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
    <style>
        .required {    
            color: red;
            font-size: 30px;
            line-height: 26px;
            vertical-align: middle;
            display: inline-block;
        }
        .required_note{
            color: red;
            font-style: italic;
        }
        .error{
            color: red;
            margin-top: 5px;
        }
        .navbar-brand {
            float: left;
            padding: 14px 15px;
            font-size: 14px;
            line-height: 22px;
            height: 50px;
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <noscript>
        <div class="alert alert-warning">
            <strong>Opps ! </strong> JavaScript seems to be disabled in your browser. You must have JavaScript enabled in your browser to utillze the functionality of this website.
        </div>
    </noscript>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{route('dashboard')}}">
                        <img src="{{ asset('key2market-logo-long.png') }}" style="width: 100px" class="logoDesktop hidden-phone">
                    </a>
                    
                    <ul class="nav navbar-nav">
                        <a class="navbar-brand" href="{{ route('users') }}">User</a>
                        @if(in_array('show_role',$permission))
                            <a class="navbar-brand" href="{{ route('role') }}">Role</a>
                        @endif
                        @if(in_array('show_supplier',$permission))
                            <a class="navbar-brand" href="{{ route('supplier') }}">Supplier</a>
                        @endif
                        @if(in_array('show_customer',$permission))
                            <a class="navbar-brand" href="{{ route('customer') }}">Customer</a>
                        @endif
                        <a class="navbar-brand" href="javascript:void(0)" onclick="logout()">Logout</a>
                    </ul>
                    
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <script>
        var siteUrl = "{{ env('APP_URL') }}";
        var token = "{{ $token ?? '' }}";
    </script>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    @yield('script')
</body>
</html>
