@include('head') 
    <link rel="stylesheet" href="{{asset ('css/style.css')}}">
</head>
<body>


    <nav class="head">
        <h4 class="p-3 mt-2 text-light bg-danger text-center">Tabelle der gelöschten Zeilen (Lager & Kunden)</h4>
    </nav>

  

    <div class="rahmen">
       
        <div class="container-fluid table-responsive mb-3 text-center" id="table">   
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif           
            <table class="table table-bordered mt-2 table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Material</th>
                        <th>Farbe</th>
                        <th>Höhe</th>
                        <th>Paket</th>
                        <th>Stück</th>
                        <th>Zweck</th>
                        <th>Datum</th>
                        <th>Anmerkungen</th> 
                        <th>wiederherstellen</th>
                    </tr>
                </thead>
                <tbody id="tbody"> 
                    @foreach ( $deletedMaterials as $item)
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
                            
                                <a href="{{ route('restore.material', ['id' => $item->id]) }}" id="wiederherstellen"
                                    data-toggle="tooltip" data-placement="top" title="wiederherstellen">
                                    <i class="fa fa-undo"></i>
                                </a>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>  

           

            <?php
        
                if ($count >= 4) {
                    echo '<div class="w-100 mb-2">';
                    echo '<form action="delete_database.php" method="POST" id="delete-form" class="form-control d-flex justify-content-between text-center">';
                    echo '<div class="d-flex div">';
                    echo '<input type="checkbox" id="" name="" class="check-box">';
                    echo '<p class="h6 text-muted mb-0 p-check-box">Markieren Sie, um die Taste zu aktivieren</p>';
                    echo '</div>';
                    echo '<input class="h6" type="hidden" name="confirm_msg" value="Wollen Sie wirklich alle Daten insg.('.$count.' Reihen) aus der Datenbank löschen?">';
                    echo '<button class="btn btn-danger text-center p-1 disabled db-delete-btn"
                            data-toggle="tooltip" data-placement="top" title="die Datenbank löschen">
                            <i class="fa fa-database text-light mx-2"></i>löschen
                        </button>';
                    echo '</form>';
                    echo '</div>';

                }
            ?>
           

            <div class="popup hide" id="msgAll">
                <img src="{{asset('images/exclamation_mark.png')}}">
                <h2 id="confirm-msg"></h2>
                <p class="text-muted mb-5">Die Rückerstattung der Daten ist nicht möglich  <strong>!</strong></p>
                <button class="btn btn-danger text-center p-1 w-25" type="button" id="schließenAll">Nein</button>
                <a name="" class="btn btn-outline-danger text-center p-1 w-25" type="button" id="deleteAll">Ja</a>
            </div> 
        
        </div>
        <div class="d-flex justify-content-center">
            <a href= "{{url('home')}}" id="closeChart" class="btn btn-danger p-1 mb-4" 
            data-toggle="tooltip" data-placement="top" title="schließen und zurück zur Startseite">schließen</a>
        </div>
    </div>
   
     <!-- Start Footer section -->
     @include('footer')  
     <!-- End Footer section -->
     
    <script src="{{ asset('js/script.js') }}"></script>

    <script>
         const checkBoxDataDelete = document.querySelector('.check-box');
        const dbDeleteBtn = document.querySelector('.db-delete-btn');

        if (checkBoxDataDelete !== null ) {

            checkBoxDataDelete.addEventListener('change', function(){
                if(this.checked){
    
                    dbDeleteBtn.classList.remove('disabled');
                }else {
    
                    dbDeleteBtn.classList.add('disabled');
                }
            })
        }
        const deleteForm = document.getElementById('delete-form');
        if(deleteForm !== null){
            const confirmMsgInput = deleteForm.querySelector('input[name="confirm_msg"]');
            const confirmMsg = confirmMsgInput.value;
            const confirmMsgEl = document.getElementById('confirm-msg');

            deleteForm.addEventListener('submit', function(event) {
            event.preventDefault();
            confirmMsgEl.textContent = confirmMsg;
            document.getElementById('msgAll').classList.add('show');
            });
        }
    
        document.getElementById('schließenAll').addEventListener('click', function(event) {
        document.getElementById('msgAll').classList.remove('show');
     
        });
    
        document.getElementById('deleteAll').addEventListener('click', function(event) {
        document.getElementById('msgAll').classList.remove('show');
        deleteForm.submit();
        });
    </script>
</body>
</html>