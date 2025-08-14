<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-white min-h-screen">
<div class="container mx-auto max-w-4xl p-6 space-y-8">
    @foreach($exercicios as $key => $value)
        <div class="bg-gray-800 rounded-lg p-4 shadow-lg">
            <div class="font-medium text-xl text-gray-200">#{{ $loop->iteration }} {{ $key }}</div>
            <div class="mt-2 text-gray-400">Params:
                <span class="text-emerald-400 font-semibold">{{ is_array($value['params']) ? implode(', ', $value['params']) : $value['params'] }}</span>
            </div>
            <div class="mt-2 text-gray-400">Result:
                <span class="text-emerald-400 font-semibold">{{ $value['result'] }}</span>
            </div>
        </div>
@endforeach
</body>
</html>
