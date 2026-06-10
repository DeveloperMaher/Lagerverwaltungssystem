<div class="position-absolute btn-group dropleft list-actions">
   
    <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bars text-light"></i>
    </button>
    

    <div class="dropdown-menu dropdown-menu-right sub-list">
        <a class="dropdown-item" href="{{url('/rechner/rechner')}}" data-toggle="tooltip" data-placement="top" title="Material berechnen">
            <i class="fa fa-calculator text-success mx-2"></i>Rechner</a>
        <a class="dropdown-item diagramm"  href="{{url('/diagramme/chart')}}" data-toggle="tooltip" data-placement="top" title="Diagramme anzeigen">
            <i class="fa fa-chart-bar text-success mx-2"></i>Diagramme</a>
        <a class="dropdown-item" href="{{url('/add/add')}}" data-toggle="tooltip" data-placement="top" title="Material hinzufügen">
            <i class="fa fa-plus-square text-success mx-2"></i>einfügen</a>
        
        {{-- show this option (Datenbank Table) only if the user deletes an item  --}}
        @if ($deletedItems > 0)
            <a class="dropdown-item" href="{{url('/datenbank/deleted_material')}}" data-toggle="tooltip" data-placement="top" title="gelöschte Daten anzeigen">
                <i class="fa fa-database text-success mx-2"></i>Datenbank</a>
        @endif

        <a class="dropdown-item" href="{{url('/status/userstatus')}}" data-toggle="tooltip" data-placement="top" title="Benutzer Status anzeigen">
            <i class="fa fa-user text-success mx-2"></i>Benutzer
            @if ( $count > 0)
                {{-- <i class="fa fa-bell text-danger mx-2"></i> --}}
                <span class="bell"></span>
            @endif
        </a>
        
        {{-- show this option (Merkliste Table) only if the user adds an item  --}}
        @if ($rememberItems > 0)
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{url('/remember/rememberlist')}}" data-toggle="tooltip" data-placement="top" title="Merkliste anzeigen">
            <i class="fa fa-memory text-success mx-2"></i>Merkliste
            
            @if ($rememberListCount > 0)
                {{-- <i class="fa fa-bell text-danger mx-2"></i> --}}
                <span class="bell"></span>
            @endif
        </a>
        @endif

            <div class="dropdown-divider"></div>
        <a class="dropdown-item text-danger" href="{{url('/logout')}}" data-toggle="tooltip" data-placement="top" title="abmelden">
            <i class="fa fa-sign-out-alt mx-2"></i>abmelden</a>
    </div>
</div>
