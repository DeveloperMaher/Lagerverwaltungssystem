 <!-- Start add new Material box section -->
 <div class="add-material-list">
    <button class="close-fenster"
    data-toggle="tooltip" data-placement="top" title="schließen"><i class="fas fa-times"></i></button>
    <form action="{{ url('addtolist/add') }}" method="Post" class="mt-5 d-flex justify-content-center">
        @csrf
        @method('POST')

        <input type="text" class="input-fenster" name="newMaterialList" placeholder ="Neues Material eingeben" autocomplete = "off">
        <button type="submit" name="addMaterial" class="btn btn-success add-material-fenster"
        data-toggle="tooltip" data-placement="top" title="einfügen"><i class="fas fa-plus"></i></button>
    </form>
  
   <div class="table-responsive mb-3 mt-4 w-100 tabel-material" id="table">
        <label class="label-fenster">Tabelle der Auswahlliste</label>
        <table class="table table-bordered text-center h6" id="table-data">
            <thead>
                <tr>
                    <th>Materialname</th>
                    <th>löschen</th>
                </tr>
            </thead>
            <tbody>  
                
                @foreach ($materialList as $item)
                    <form action="{{ url('addtolist/add', $item->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <tr>
                            <td>{{$item->name_material}}</td>
                            <td> 
                                <button type="submit" id="löschen" data-toggle="tooltip" data-placement="top" title="löschen">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </td>  
                        </tr>
                    </form>
                 @endforeach
            </tbody>
        </table> 
   </div>
</div>
<!-- End add new Material box section -->
