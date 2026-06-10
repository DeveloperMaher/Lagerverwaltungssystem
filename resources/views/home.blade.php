@include('head')  
    <!-- custum CSS files -->
    <link rel="stylesheet" href="{{ asset('css/style-searchbar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
</head>
<body>
  @include('header')  

  @if(session('delete'))
      <div class="d-flex justify-content-center alert alert-success alert-dismissible w-50 text-center">
          {{ session('delete') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif
    <div class="contaier">
        <div class="curd">    
            <div class="text-center mb-4 title">
                <h3>Abschnitt der Materialien & Suche</h3>
            </div>

            <div class="outputs">
                <div id="delAll"></div>

                @include('search')  

                <div class="container-fluid table-responsive mb-3 text-center" id="table">

                   @include('pageform')

                    <!-- Start form to Print the table -->
                    <div class="position-absolute print">
                        <a href="{{ route('materials.pdf') }}" 
                        target="_blank"
                        title="Materialtabelle als PDF speichern"
                        data-toggle="tooltip">
                            <i class="fa fa-print"></i>
                        </a>
                    </div>
                    <!-- End form to Print the table -->

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
                                <th>bearbeiten</th>
                                <th>löschen</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"> 
                         
                         @foreach ($materials->take($totalRecordsPerPage) as $item) 
                          {{-- ($materials->take($totalRecordsPerPage) as $item) --}}
                           
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
                                <td>
                                    <a href="{{url('edit', ['id' => $item->id])}}" class="" id="aktualisieren"
                                        data-toggle="tooltip" data-placement="top" title="Reihe bearbeiten">
                                        <i class="fa fa-user-edit"></i>
                                    </a>
                                </td>

                                <td>
                                    <button type="submit" class='btn bg-transparent border-transparent'>
                                        <a href="{{url('deleteMaterial', ['id' => $item->id])}}"  id="löschen" data-toggle="tooltip" data-placement="top" title="Reihe löschen">
                                            <i class="fa fa-trash-alt"></i>
                                        </a>
                                    </button>
                                </td>
                            </tr>
                            
                            </form>
                           
                        @endforeach

                        <div id="" class="delete-msg" style="display:none;">
                            <div class="popup-content">
                                <div class="cont">
                                    <span class="fa fa-check-circle text-success"></span>
                                    <span class="msg"><strong class="bestät">Bestätigungsmeldung</strong><br>
                                        Möchten Sie wirklich die Reihe () löschen?
                                    </span>
                                </div>
                                <div class="btns">
                                    <button class="cancel-btn" onclick="">Abbrechen</button>
                                    <a class="delete-btn" href="">Ja</a>
                                </div>
                            </div>
                        </div>

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
{{--    
    <script>
        window.addEventListener('beforeunload', function (event) {
            // Send AJAX request to logout endpoint
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'logout', true);
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}'); // Add CSRF token if required
            xhr.send();
        });

    </script> --}}
   
</body>
</html>