<!-- Start form to Search -->
<div class="box mb-4">
    <form class="form-control text-center" method = "POST">
        @csrf
        @method('POST')
        <span><i class="fas fa-search i"></i></span>
        <input class="form-control lead suchen"
        type="search" placeholder="suchen" id="search_text" name="search" autocomplete = "off">
        <select id="mySelect" name="suchkategorie">
            <option value="Spalte auswählen" disabled selected>Spalte auswählen</option>
            <option value="" ></option>
            <option value="material"
            data-toggle="tooltip" data-placement="top" title="Es wird in der Materialspalte gesucht">Material</option>
            <option value="zweck"
            data-toggle="tooltip" data-placement="top" title="Es wird in der Zweckspalte gesucht">Zweck</option>
            <option value="anmerkungen"
            data-toggle="tooltip" data-placement="top" title="Es wird in der Anmerkungenspalte gesucht">Anmerkungen</option>
            
        </select>
        <p class="text-muted">* Sie können in der gesamten Tabelle suchen oder auswählen, in welcher Spalte gesucht wird</p>
    </form>
</div>
<script>
    // get data use Ajax to search
  $(document).ready(function(){
      $('#search_text, #mySelect').on('keyup', function(){
          var search = $(this).val();
          var category = $('#mySelect').val();

         if (search.length >= 1) {
            $.ajax({
                type: "POST",
                url: '{{ route("search") }}',
                data: {
                    search: search,
                    suchkategorie: category,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    
                    $('#table-data').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
           
           } 
         else {
                location.reload(); 
            }
      });
    
    //set the value of the mySelect to "Spalte auswählen"
    $('#mySelect').val("Spalte auswählen");

    // Set focus on the search input field after page refresh
    $('#search_text').focus();

   
  });
</script>
<!-- End form to Search -->

