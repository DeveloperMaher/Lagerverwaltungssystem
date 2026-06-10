<!-- start header section -->
<nav class="head">
    <h1>LVS</h1>
    <p>Lagerverwaltungssystem</p>
    <div class = "position-absolute start-0 text-center date-heder">
        {{ now()->format('Y.m.d') }} <br>
        Welcome back <strong class="text-success"> {{ Session::get('Name') }}</strong>
    </div>

    <div class="bell-head" data-toggle="tooltip" data-placement="top" title="{{ 
        'Es gibt ' . $count . ' Online Benutzer und ' . $rememberListCount . ' Bestellungen.' }}">
        @if ($count + $rememberListCount > 0)
            <i class="fa fa-bell text-success mx-2"></i>
            <span class="light">{{$count + $rememberListCount}}</span> 
            @else
            <i class="fa fa-bell text-light mx-2"></i>
            <span class="dark"></span> 
        @endif
    </div>

    @include('navbarlist')  
</nav>
<!-- End header section -->