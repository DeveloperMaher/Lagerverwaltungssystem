@include('head')  
    
    <link rel="stylesheet" href="{{asset ('css/style-add.css')}}">
</head>
<body>
    <!-- <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #018a1f">
        Materialien Management System
     
    </nav> -->
    @include('subheader')  

    <div id="msg" class="alert alert-warning alert-dismissible hide" role="alert">
        <strong>Achtung!</strong> Alle Felder sind erforderlich!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible w-50 text-center">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="contaier">
        <div class="text-center mb-4 title">
            <h3>Materialien aktualisieren</h3>
            <p class="text-muted">Bearbeiten Sie die Infos, um dieses Material zu aktualisieren</p>
        </div>


        <div class="container d-flex justify-content-center">
            <form action ="{{url('edit', ['id' => $material->id]) }}" method ="post" style ="min-width:400px; max-width:900px" class="text-center">
                @csrf
                @method('POST')
                <div class="row mb-4">
                    <div class="col mb-2">
                        <select id='material' name='material' class='form-select'>
                            <option value='' disabled selected>Material auswählen</option>
                            @foreach ($materialList as $item)
                             <option value="{{$item->name_material}}" 
                                {{($material->material) == $item->name_material ? 'selected' : ''}}
                                >{{$item->name_material}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col mb-2">
                        <!-- <label class="form-label">Farbe</label> -->
                        <select id="farbe" name="farbe" class="form-select">
                            <option value="" disabled selected>Farbe auswählen</option>
                            <option value="Anthrazit RAL 7016" {{($material->farbe) == 'Anthrazit RAL 7016' ? 'selected' : ''}}>Anthrazit RAL 7016</option>
                            <option value="Grün RAL 6005" {{($material->farbe) == 'Grün RAL 6005' ? 'selected' : ''}}>Grün RAL 6005</option>
                            <option value="Feuerverzinkt" {{($material->farbe) == 'Feuerverzinkt' ? 'selected' : ''}}>Feuerverzinkt</option>
                        </select>
                    </div>
                    <div class="col">
                        <!-- <label class="form-label">Höhe</label> -->
                        <select id="höhe" name="höhe" class="form-select">
                            <option value="" disabled selected>Höhe auswählen</option>
                            <option value="0830" {{($material->höhe) == '0830' ? 'selected' : ''}} >0830</option>
                            <option value="1030" {{$material->höhe == '1030' ? 'selected' : ''}} >1030</option>
                            <option value="1230" {{$material->höhe == '1230' ? 'selected' : ''}} >1230</option>
                            <option value="1430" {{($material->höhe) == '1430' ? 'selected' : ''}} >1430</option>
                            <option value="1630" {{$material->höhe == '1630' ? 'selected' : ''}}>1630</option>
                            <option value="1830" {{$material->höhe == '1830' ? 'selected' : ''}}>1830</option>
                            <option value="2030" {{$material->höhe == '2030' ? 'selected' : ''}}>2030</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col mb-2">
                        <label class="form-label">Pakete</label>
                        <input type="number" id="paket" class="form-control" value = "{{$material->paket}}" name="paket">                
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Stücke</label>
                        <input type="number" id="stück" class="form-control" value = "{{$material->stück}}" name="stück">
                    </div>
                    <div class="col">
                        <label class="form-label">Zweck</label>
                        <select id="zweck" name="zweck" class="form-select">
                            <option value="" disabled selected>zweck auswählen</option>
                            <option value="Lager" {{ $material->zweck == 'Lager' ? 'selected' : '' }}>Lager</option>
                            <option value="Kunden" {{ $material->zweck == 'Kunden' ? 'selected' : '' }}>Kunden</option>
                        </select>
                        
                    </div>
                </div>
                <div>
                    <label class="form-label">Anmerkungen</label>
                    <input type="text"  id="anmerkungen" class="form-control" name="anmerkungen" value = "{{$material->anmerkungen}}" autocomplete="off">
                </div>
              
                <hr>
                <div class = "d-flex justify-content-center px-5 add-page">
                    <button type = "submit" id= "speichern" class = "btn btn-success" name ="submit">aktualisieren</button>
                    <a href ="{{url('home')}}" class= "btn btn-danger">schließen</a>
                </div>
            </form>    
        </div>
        
    </div>

    @include('footer')  

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   

</body>
</html>