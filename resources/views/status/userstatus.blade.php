
@include('head')  
    <link rel="stylesheet" href="{{asset ('css/style.css')}}">
</head>
<body>
   
    <nav class="head">
        <h4 class="p-3 mt-2 text-light bg-success">Benutzertabelle</h4>
    </nav>

    @if(session('success'))
        <div id="messageDiv" class="d-flex justify-content-center alert alert-success alert-dismissible w-50 text-center">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                $('#messageDiv').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 3000);
        </script>
    @endif
    <div class="rahmen">
        <!-- Start Table of Users section -->
        <div class="container-fluid table-responsive mb-3 text-center" id="table">              
            <table class="table table-bordered mt-2 table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Status</th>  
                        <th>zuletzt gesehen</th>  
                        <th>Sitzungsdauer</th>  
                        <th>Active</th>  
                        <th>Delete User</th>  
                    </tr>
                </thead>
                <tbody id="tbody"> 
                    @foreach ( $users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->user_type}}</td>

                            <!-- Check of the User online OR offline and change the color  -->  
                           <td>
                                @if($user->isOnline())
                                    <span class="online light">online</span>
                                @else
                                    <span class="offline">offline</span>
                                @endif
                            </td>

                            <!-- Show the Last Seen of User  -->  
                            <td>{!! $user->last_seen_text !!}</td>
                            
                            <!-- Show the Period of the Session of User  --> 
                            <td>{{ $user->session_duration }}</td>
                            
                            <!-- Suspend the User  -->
                            <td>
                                @if ($user->active_user == 'active')     
                                    <input class='activeUser' type="checkbox" checked
                                    data-toggle="tooltip" data-placement="top" 
                                    title="suspend {{$user->name}} Account">
                                @else
                                    <input class='activeUser' type="checkbox"
                                    data-toggle="tooltip" data-placement="top" 
                                    title="reactivate {{$user->name}} Account">   
                                @endif
                            </td>

                            <!-- Delete user permanently  -->
                            <td class="deleteUser">
                                <a onclick="showPopup({{$user->id}})" id="löschen">
                                    <i class="fa fa-trash-alt text-danger" aria-hidden="true"
                                    data-toggle="tooltip" data-placement="top" 
                                    title="User {{$user->name}} löschen"></i>
                                </a>
                            </td> 

                        </tr>

                        <!-- Show the message before you delete a user to confirm -->
                        @include('status.partials.delete-modal', ['user' => $user])
                       
                    @endforeach

                </tbody>
            </table>  
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

    <script src="{{ asset('js/user-status.js') }}"></script>
    <script>
        const csrfToken = () => "{{ csrf_token() }}";

        const routeChangeUserStatus = (userId, isActive) =>
            "{{ route('user.status.change', ['userId' => ':userId', 'isActive' => ':isActive']) }}"
                .replace(':userId', userId)
                .replace(':isActive', isActive);
    </script>

</body>
</html>