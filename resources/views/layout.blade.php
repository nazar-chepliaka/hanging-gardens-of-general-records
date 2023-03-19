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

        #sigma-container {
            height: 600px;
            background: white;
        }
    </style>

    {{-- {{ Vite::useManifestFilename('manifest.json')
            ->withEntryPoints(['resources/js/app.ts']) }} --}}
            
    <script src="{{ asset('/js/app.js') }}"></script>
</head>
<body>
    @yield('content')
</body>
</html>