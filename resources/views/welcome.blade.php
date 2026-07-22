<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        <div>
            <main>
                <h1>Welcome Laravel</h1>
                {{-- apresenta $name a partir da route::view --}}
                @if(!@empty($name))
                    <p>{{ $name }}</p>
                @endif
            </main>
        </div>

    </body>
</html>
