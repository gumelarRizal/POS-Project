<!DOCTYPE html>
<html lang="en">

<head>
    @include('Layouts.Partials.Head')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('Layouts.Partials.Nav')
            @include('Layouts.Partials.Sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        @yield('title')
                        <div class="section-header-breadcrumb">
                            @if ($titleBreadcrump == 'Dashboard')
                                <div class="breadcrumb-item">{{ $titleBreadcrump }}</div>
                            @else
                                <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
                                <div class="breadcrumb-item">{{ $titleBreadcrump }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
            </div>
            @include('Layouts.Partials.Footer')
        </div>
    </div>
    @include('Layouts.Partials.Scripts')
</body>

</html>
