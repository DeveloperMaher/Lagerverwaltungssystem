@include('head')  
    <link rel="stylesheet" href="{{asset ('css/style-add.css')}}">
</head>
<body>
    
    @include('addtolist.add')  

    <!-- start header section -->
    @include('subheader')
    <!-- End header section -->
    

    <div class="content">

         <!-- Start Alert Message section -->
        <div id="msg" class="alert alert-warning alert-dismissible hide" role="alert">
            <strong>!</strong> Alle Felder sind erforderlich!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- End Alert Message section -->
        
        @if(session('success'))
            <div class="d-flex justify-content-center alert alert-success alert-dismissible w-50 text-center">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    
        <!-- Start add section -->
        <div class="text-center mb-4 title">
            <h3>Materialabschnitt hinzufügen</h3>
            <p class="text-muted">Füllen Sie das folgende Formular aus, um ein neues Material in der Materialtabelle hinzuzufügen</p>
        </div>
        <div class="container d-flex justify-content-center">
            <form action ="{{ url('add/add') }}" method ="post" style ="min-width:330px; max-width:700px" class="text-center">
                @csrf
                @method('POST')
                <div class="row mb-4">
                    <div class="col mb-2">
                        <select id='material' name='material' class='form-select position-relative'>
                            <option value='' disabled selected>Material auswählen</option>
                            @foreach($materialList as $item)
                                <option value="{{$item->name_material}}">{{$item->name_material}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="btn-add">
                        <button type= "button" class= 'open-fenster' data-toggle="tooltip" data-placement="top" title="Sie können neues Material in die Auswahlliste einfügen">+</button>
                    </div>
                    <div class="col mb-2">
                        <!-- <label class="form-label">Farbe</label> -->
                        <select id="farbe" name="farbe" class="form-select">
                            <option value="" disabled selected>Farbe auswählen</option>
                            <option value="Anthrazit RAL 7016">Anthrazit RAL 7016</option>
                            <option value="Grün RAL 6005">Grün RAL 6005</option>
                            <option value="Feuerverzinkt">Feuerverzinkt</option>
                        </select>
                    </div>
                    <div class="col">
                        <!-- <label class="form-label">Höhe</label> -->
                        <select id="höhe" name="höhe" class="form-select">
                            <option value="" disabled selected>Höhe auswählen</option>
                            <option value="0830">0830</option>
                            <option value="1030">1030</option>
                            <option value="1230">1230</option>
                            <option value="1430">1430</option>
                            <option value="1630">1630</option>
                            <option value="1830">1830</option>
                            <option value="2030">2030</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col mb-2">
                        <label class="form-label">Pakete</label>
                        <input type="number" min="0" id="paket" class="form-control" placeholder="Anzahl der Pakete" name="paket">                
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">Stücke</label>
                        <input type="number" id="stück" class="form-control" placeholder="Anzahl der Stücke" name="stück">
                    </div>
                    <div class="col">
                        <label class="form-label">Zweck</label>
                        <!-- <input type="text" id="zweck" class="form-control" placeholder="Lager oder Kunden" name="zweck" value=""> -->
                        <select id="" name="zweck" class="form-select">
                            <option value="" disabled selected>zweck auswählen</option>
                            <option value="Lager">Lager</option>
                            <option value="Kunden">Kunden</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="form-label">Anmerkungen</label>
                    <input type="text"  id="anmerkungen" class="form-control" name="anmerkungen" placeholder = "fügen Sie Notizen hinzu" autocomplete="off">
                </div>
                <hr>

                <div class = "d-flex justify-content-center px-5 add-page">
                    <button type = "submit" id= "speichern" class = "btn btn-success ml-1 no-drop-sp" name ="submit"
                    data-toggle="tooltip" data-placement="top" title="in der Materialtabelle speichern">speichern</button>
                    <a href ="{{url('home')}}" class= "btn btn-danger no-drop-ab"
                    data-toggle="tooltip" data-placement="top" title="schließen und zurück zur Startseite">schließen</a>
                </div>
            </form>    
        </div>
    </div>
    <!-- End add section -->
    
    <!-- Start Footer section -->
    @include('footer')  
    <!-- End Footer section -->
    
</div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        const msg = document.querySelector("#msg");
        let selectLists = document.querySelectorAll(".sel select");
        let inputs = document.querySelectorAll(".form-control");
        const material = document.getElementById("material");
        const farbe = document.getElementById("farbe");
        const höhe = document.getElementById("höhe");
        const paket = document.getElementById("paket");
        const stück = document.getElementById("stück");
        const zweck = document.getElementById("zweck");
        
        speichern.addEventListener('click', ()=> {
            if(material.value == "" || farbe.value == "" || höhe.value == "" || 
            paket.value == "" || stück.value == "" || zweck.value == "" ){
                msg.classList.remove('hide');

                for(let i=0; i < selectLists.length; i++){
                    selectLists[i].classList.add("form-control-danger");
                }

                for(let i=0; i < inputs.length; i++){
                    // inputs[i].classList.remove("form-control");
                    inputs[i].classList.add("form-control-danger");
                }
            }
        });
    </script>
    <script>

        const nodropAb = document.querySelector('.no-drop-ab');
        const nodropSp = document.querySelector('.no-drop-sp');
        
        const openFenster = document.querySelector('.open-fenster');
        
        const fenster = document.querySelector('.add-material-list');

        const closeFenster = document.querySelector('.close-fenster');
        closeFenster.addEventListener('click',()=> {
            fenster.style.visibility = 'hidden';
            nodropSp.disabled = false;
            nodropAb.style.pointerEvents= 'visible';
        });
        openFenster.addEventListener('click',()=> {
            fenster.style.visibility = 'visible';
            nodropSp.disabled = true;
            nodropAb.style.pointerEvents= 'none';

        });

    </script>
    <script>
        const inputFenster = document.querySelector('.input-fenster');
        const addMaterialFenster = document.querySelector('.add-material-fenster');
        addMaterialFenster.disabled=true;
        inputFenster.addEventListener('keyup', ()=> {
            if(inputFenster.value == ''){
                addMaterialFenster.disabled= true;
            }else {
                addMaterialFenster.disabled= false;
            }
        });
        
    </script>
</body>
</html>