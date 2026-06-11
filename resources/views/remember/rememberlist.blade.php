
@include('head')  
    <link rel="stylesheet" href="{{asset ('css/style.css')}}">
    {{-- <link rel="stylesheet" href="{{asset ('css/style-add.css')}}"> --}}
</head>
<body>
    

    <nav class="head">
        <h4 class="p-3 mt-2 text-light bg-success">Merkliste</h4>
    </nav>

   

    @if (session('delete'))
        <div id="messageDiv" class="d-flex justify-content-center alert alert-danger alert-dismissible text-center">
            {{ session('delete') }}
        </div>
    @elseif (session()->has('message'))
        <div id="messageDiv" class="d-flex justify-content-center alert alert-success alert-dismissible text-center">
            {{ session()->get('message') }}
        </div> 
    @endif
    
    @if (session()->has('deleteAll'))
        <div id="messageDiv" class="d-flex justify-content-center alert alert-danger alert-dismissible w-50 text-center">
            {{ session()->get('deleteAll') }}
        </div> 
    @endif
   
    <div class="rahmen">


        <div class="container-fluid table-responsive mb-3 text-center" id="table">              
            <form action="{{ url('/remember/rememberlist') }}" method="POST">
                @csrf
                @method('POST')

                

                <table class="table table-bordered mt-2 table-striped" id="table-data">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Material</th>
                            <th>Farbe</th>
                            <th>Höhe</th>
                            <th>Stück</th>  
                            <th>Status</th>    
                            <th>Delete</th>  
                        </tr>
                    </thead>
                    <tbody id="tbody"> 
                        @foreach ($rememberList as $item)
                            <tr>
                                <td class="border-start border-3 border-{{$item->status == 0 ? 'danger' : 'success'}}">{{$item->id}}</td>
                                <td>{{$item->material}}</td>
                                <td>{{$item->farbe}}</td>
                                <td>{{$item->höhe}}</td>
                                <td>{{$item->stück}}</td>

                                <!-- Check of the material bestellt or not -->  
                                <td>
                                    <a href="rememberlist/{{$item->id}}" id="changeStatus" class="btn btn-sm btn-{{$item->status ? 'success' : 'danger'}} {{$item->status ? 'light' : ''}}" data-toggle="tooltip" data-placement="top" title="{{
                                            $item->status == 0 ? 'als bestellt markieren' : 'als nicht bestellt markieren'
                                        }}">
                                        <strong>{{$item->status ? 'Bestellt' : 'nicht Bestellt'}}</strong>
                                    </a>
                                </td>

                                <td>
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button type="submit" name="deleteItem" class='btn bg-transparent border-transparent'
                                    data-toggle="tooltip" data-placement="top" title="Reihe löschen">
                                        <a id="löschen">
                                            <i class="fa fa-trash-alt"></i>
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>  

                @if ($rememberListCount > 1)
                    <button class="btn btn-danger p-1 mb-4" 
                        type="submit" name="deleteAllMerkliste" data-toggle="tooltip" data-placement="top" 
                        title="Alle Zeilen löschen"> 
                        <i class="fa fa-trash-alt"></i> 
                    </button>
                @endif
              
            </form>

            @if ($rememberListCount >= 1)
                <label class="count-num">Reihenanzahl : 
                    (<strong class="text-secondary">{{$rememberListCount}}</strong>) <br>
                    <hr>
                    (<span class="text-success">bestellt : </span><strong class="text-secondary">{{$rememberListCountBestellt}}</strong> &
                    <span class="text-danger">nicht bestellt : </span><strong class="text-secondary">{{$rememberListCountNotBestellt}}</strong>)
                </label>
            @endif
            
        </div>
        
        <!-- End Table of Users section -->

        <div class="d-flex justify-content-center">
            <a href= "{{url('home')}}" id="closeChart" class="btn btn-danger p-1 mb-4" 
            data-toggle="tooltip" data-placement="top" title="schließen und zurück zur Startseite">schließen</a>
        </div>
    </div>
     <!-- Start Footer section -->
     @include('footer')  
     <!-- End Footer section -->

    <script>
        // Function to hide the message after 3 seconds
        setTimeout(function() {
            $('#messageDiv').fadeOut('slow', function() {
                // After fading out, remove the message and clear the session data
                $(this).remove();
            });
        }, 3000);
    </script>

</body>
</html>