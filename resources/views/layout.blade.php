<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    @yield('head')

    <style>
        .alert-danger {
            color: #ff0000;
        }

        .alert-success {
            color: #007d00;
        }
        
        td, th {
            padding: 10px;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>