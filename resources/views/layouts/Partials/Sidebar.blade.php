<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">{{ config('app.name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">LV</a>
        </div>
        <ul class="sidebar-menu">
            @php
                $ulData = DB::table('mt_system')
                    ->select('SYSTEM_VALUE')
                    ->distinct()
                    ->where('SYSTEM_CD', 'like', 'MENU%')
                    ->get();
            @endphp
            @foreach ($ulData as $data)
                <li class="menu-header">{{ $data->SYSTEM_VALUE }}</li>
                @php
                    $ul = DB::table('mt_system')
                        ->where('SYSTEM_VALUE', '=', $data->SYSTEM_VALUE)
                        ->get();
                @endphp
                @foreach ($ul as $item)
                    <li><a class="nav-link" href="blank.html"><i class="fas fa-fire"></i>
                            <span>{{ $item->CHILD_VALUE }}</span></a></li>
                @endforeach
            @endforeach
        </ul>
    </aside>
</div>
