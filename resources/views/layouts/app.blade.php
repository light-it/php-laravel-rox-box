<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.inc.head')
    <body>
        <div id="app">
            @include('layouts.inc.header')

            <main class="py-4">

                @include('layouts.inc.messages')

                @yield('content')

            </main>

        </div>
    </body>
</html>
