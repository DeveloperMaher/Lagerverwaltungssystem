@include('head')  
    <link rel="stylesheet" href="{{asset ('css/style-add.css')}}">
</head>
<body>
    {{ $total_stück }}
<div class="main">
    <div class="content">

        @include('subheader')
   
        <div id="msg" class="alert alert-warning alert-dismissible hide" role="alert">
            Alle Felder sind erforderlich!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
     
        <div class="text-center mb-4 title">
            <div class="text-center mb-4 title">
                <h3>Berechnungsabschnitt</h3>
                <p class="text-muted">Wählen Sie die gewünschten Informationen aus, um nach der Anzahl der Stücke <strong>nur im Lager</strong> zu suchen</p>
            </div>
        </div>  
        <div class="container d-flex justify-content-center">
        
            <form action ="{{ url('rechner/rechner') }}" method="POST" style ="min-width:330px; max-width:700px" class="text-center">
                @csrf
                @method('POST')

                <div class="row mb-4 sel">

                    <div class="col mb-2">
                        <select id='material' name='material' class='form-select position-relative'>
                            <option value='' disabled selected>Material auswählen</option>
                            @foreach($materialList as $item)
                                <option value="{{ $item->name_material }}" {{ old('material', $material) == $item->name_material ? 'selected' : '' }}>
                                    {{ $item->name_material }}
                                </option>
                            @endforeach  
                        </select>
                    </div>
                  
                    <div class="col mb-2">
                        <select id="farbe" name="farbe" class="form-select">
                            <option value="" disabled selected>Farbe auswählen</option>
                            <option value="Anthrazit RAL 7016" {{ old('farbe', $farbe) == 'Anthrazit RAL 7016' ? 'selected' : '' }}>Anthrazit RAL 7016</option>
                            <option value="Grün RAL 6005" {{ old('farbe', $farbe) == 'Grün RAL 6005' ? 'selected' : '' }}>Grün RAL 6005</option>
                            <option value="Feuerverzinkt" {{ old('farbe', $farbe) == 'Feuerverzinkt' ? 'selected' : '' }}>Feuerverzinkt</option>
                        </select>
                    </div>
                    
                    <div class="col mb-2">
                        <select id="höhe" name="höhe" class="form-select">
                            <option value="" disabled selected>Höhe auswählen</option> 
                            <option value="0830" {{ old('höhe', $höhe) == '0830' ? 'selected' : '' }}>0830</option>
                            <option value="1030" {{ old('höhe', $höhe) == '1030' ? 'selected' : '' }}>1030</option>
                            <option value="1230" {{ old('höhe', $höhe) == '1230' ? 'selected' : '' }}>1230</option>
                            <option value="1430" {{ old('höhe', $höhe) == '1430' ? 'selected' : '' }}>1430</option>
                            <option value="1630" {{ old('höhe', $höhe) == '1630' ? 'selected' : '' }}>1630</option>
                            <option value="1830" {{ old('höhe', $höhe) == '1830' ? 'selected' : '' }}>1830</option>
                            <option value="2030" {{ old('höhe', $höhe) == '2030' ? 'selected' : '' }}>2030</option>
                        </select>
                    </div> 

                </div>

                <div id="zweck" name= "zweck"> 
                    <input type="radio" id="lager-opt" name="zweck" value="lager" @if(old('zweck', $zweck) == 'lager') checked @endif checked>
                    <label for="lager" id="label-lager">Lager</label>
                    
                    <input type="radio" id="kunden-opt" name="zweck" value="kunden" @if(old('zweck', $zweck) == 'kunden') checked @endif>
                    <label for="kunden" id="label-kunden">Kunden</label>
                </div>

                <br>
            
                <input class="text-center app-stu" id="result" name="stück" type="number" value ="{{ session('total_stück') }}" readonly disabled>
                <label for="" class="form-label">Stü.</label>
              
                <hr>
                <div class="d-flex justify-content-center">
                    <button type ="submit" class="btn btn-success p-1 m-1" id="rechnen-material" name="action" value ="rechnen"
                    value="rechnen" data-toggle="tooltip" data-placement="top" title="rechnen">rechnen</button>
                    
                    <a href="{{url('/home')}}" class="btn btn-danger p-1 m-1" id="abbrechen"
                    data-toggle="tooltip" data-placement="top" title="schließen und zurück zur Startseite">schließen</a>
                    
                    <button class="btn btn-primary p-1 m-1" id="zurücksetzen"
                    data-toggle="tooltip" data-placement="top" title="die Kästchen zurücksetzen">zurücksetzen</button>
                </div>

                
                <br>
                @include('rechner/rechnermsg')
                
                
                
            </form>
        </div>  


       @include('rechner/rechnerreset')

    <!-- Start Footer section -->
    @include('footer')  
    <!-- End Footer section -->

</div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  
    <script> 
        document.addEventListener("load", function() {
        // Your JavaScript code here

            const rechnenMaterial = document.getElementById("rechnen-material");
            const msg_app = document.getElementById("msg");
            let selectLists = document.querySelectorAll(".sel select");
            const material = document.getElementById("material");
            const farbe = document.getElementById("farbe"); 
            const höhe = document.getElementById("höhe");
            
   
            function msgEmptyFelder() {
                if (material.value === "" || farbe.value === "" || höhe.value === "") {
                    msg_app.classList.remove('hide');
                    for (let i = 0; i < selectLists.length; i++) {
                        selectLists[i].classList.add("form-control-danger");
                    }
                }
            }
           
            rechnenMaterial.addEventListener('click', function(event) {
                // event.preventDefault();  // prevent form submission
                console.log('JAAA');
                setTimeout(msgEmptyFelder, 5000);
            });
           
        });
        // rechnenMaterial.addEventListener('click', msgEmptyFelder, 5000);

        // rechnenMaterial.addEventListener('click', {()=> msgEmptyFelder()}, 5000);

    </script> 

     <script>
        const inputValueApp = document.querySelector('.input-app');
        const changeValueBtn = document.querySelector('.change');
        changeValueBtn.disabled = true;
        
        inputValueApp.addEventListener('keyup', ()=> {
            if(inputValueApp.value == ''){
                changeValueBtn.disabled= true;
            }else {
                changeValueBtn.disabled= false;
            }
        });
       

    </script>

    <script>
            // Add an event listener to the "zurücksetzen" button
            document.getElementById('zurücksetzen').addEventListener('click', function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();
            
            // Reset the selected options of the select elements to their first options
            document.getElementById('material').selectedIndex = 0;
            document.getElementById('farbe').selectedIndex = 0;
            document.getElementById('höhe').selectedIndex = 0;
            document.getElementById('result').value = '';
            document.getElementById('lager-opt').checked = true;
        });
    </script>

   
    
</body>
</html>