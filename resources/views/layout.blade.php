<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite([
       'resources/css/app.css',
       'resources/js/app.js'
   ])

    <title>Test Exercise</title>
</head>
<body class="h-screen">

<div class="min-h-[10%]">
    @include('components.header')
</div>

<div class="max-w-screen-xl mx-auto min-h-[80%]">
    @yield('content')
</div>
<div class="min-h-[10%]">

    @include('components.footer')
</div>

</body>
</html>
