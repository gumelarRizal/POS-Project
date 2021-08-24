<!DOCTYPE html>
<html lang="en">

<head>
    @include('Layouts.Partials.Head')
</head>

<body class="sidebar-mini">
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('Layouts.Partials.Nav')
            @include('Layouts.Partials.Sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
            </div>
            @include('Layouts.Partials.Footer')
        </div>
    </div>
    @yield('modal')
    @include('Layouts.Partials.Scripts')
</body>

</html>
