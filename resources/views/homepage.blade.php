<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Homepage</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .login-page {
            background-image: url("{{ asset('img/Homepage Images/Background.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }
        .block-text{
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
        }

    </style>
</head>

<body class="hold-transition login-page">
<div class="icon-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <img src="{{ asset('img/Homepage Images/70796666_2354739484778614_3238115637049950208_n.png') }}" width="100" height="100">
    <img src="{{ asset('img/Homepage Images/49652614_345409099627982_9019432575730450432_n.png') }}" width="100" height="100">
</div>
<div class="login-box" style="width: auto">

    <!-- /.login-logo -->
    <div class="col-md-12">
        <div class="">
            <h3 class="login-box-msg block-text text-center" style="font-family: futura;">FACILITIES MANAGEMENT FOR JOSÉ RIZAL UNIVERSITY</h3>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<div class="login-box">
    <div class="center">
        <a type="button"  class="btn btn-success btn-lg btn-block">TICKETING MAINTENANCE</a>
    </div>
    <div class="center">
        <a type="button" href="{{ route('StudentLogin') }}" stlye='text-color: black;'class="btn btn-success btn-lg btn-block">RESERVATION FACILITIES</a>
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js')}}"></script>

</body>
</html>
