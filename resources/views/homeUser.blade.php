@include('head')  
    <!-- custum CSS files -->
    <link rel="stylesheet" href="{{ asset('css/style-searchbar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
</head>
<body>
    <nav class="head">
        <h1>LVS</h1>
        <p>Lagerverwaltungssystem</p>
        <div class = "position-absolute start-0 text-center date-heder">
            {{ now()->format('Y.m.d') }} <br>
            Welcome back <strong class="text-success"> {{ Session::get('Name') }}</strong>
        </div>
        <div class="position-absolute btn-group dropleft list-actions">

            <a class="btn btn-sm btn-danger p-1" href="{{url('/logout')}}" data-toggle="tooltip" data-placement="top" title="abmelden">
                <i class="fa fa-sign-out-alt mx-2"></i>
            </a>
        </div>
    </nav>


      <div class="contaier">
        <div class="curd">    
            <div class="text-center mb-4 title">
                <h3>Abschnitt der Materialien & Suche</h3>
            </div>

            <div class="outputs">
                <div id="delAll"></div>

                @include('search')  

                <div class="container-fluid table-responsive mb-3 text-center" id="table">
        
                    <table class="table table-bordered mt-2 table-striped" id="table-data">
                        <label class="mt-4 text-dark text-capitalize font-weight-bold">die materialtabelle</label>

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Material</th>
                                <th>Farbe</th>
                                <th>Höhe</th>
                                <th>Paket</th>
                                <th>Stück</th>
                                <th>Zweck</th>
                                <th style="width: 110px">Datum</th>
                                <th>Anmerkungen</th>
                       
                            </tr>
                        </thead>
                        <tbody id="tbody"> 
                         
                         @foreach ($materials as $item) 
                           
                            <form action="{{ url('home', $item->id) }}" method="Post">
                              @csrf
                              @method('POST')
                             
                             <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->material}}</td>
                                <td>{{$item->farbe}}</td>
                                <td>{{$item->höhe}}</td>
                                <td>{{$item->paket}}</td>
                                <td>{{$item->stück}}</td>
                                <td>{{$item->zweck}}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->anmerkungen}}</td>
                                
                            </tr>
                            
                            </form>
                           
                        @endforeach

                        </tbody>
                    </table> 
                    
                    <label class="count-num">Reihenanzahl: 
                        (<strong class="text-secondary">{{$countAllMaterial}}</strong>),
                        (Lager: <strong class="text-secondary">{{$lager}}</strong> &
                         Kunden: <strong class="text-secondary">{{$kunden}}</strong>)
                    </label>
                </div>
                {{$materials->links('paginate', ['materials' => $materials])}}
            </div>
            
        </div>
    </div>  


    @include('footer')  
    <script src="{{asset('js/script.js')}}"></script>
    <script>
        // Prevent the user from going back to the previous page
        window.history.pushState(null, null, location.href);
        window.onpopstate = function(event) {
            event.preventDefault();
            window.history.forward();
        };
    </script>

</body>
</html>