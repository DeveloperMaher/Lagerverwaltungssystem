@php
    use Carbon\Carbon;
    function calculateLastSeen($lastSeenTimestamp, $isOnline) {
        if ($isOnline) {
            return '<strong class="text-success">Online Jetzt</strong>';
        }

        // Convert the lastSeenTimestamp to a Unix timestamp
        $lastSeenTime = strtotime($lastSeenTimestamp);
       
        // Get the current Unix timestamp
        $currentTime = time();
            
        // Calculate the time difference between the current time and last seen time
        $timeDifference =  $currentTime - $lastSeenTime;

    
        // Define time intervals in descending order
        $intervals = array(
            31536000 => array('Jahr', 'Jahre'),
            2592000 => array('Monat', 'Monate'),
            604800 => array('Woche', 'Wochen'),
            86400 => array('Tag', 'Tagen'),
            3600 => array('Stunde', 'Stunden'),
            60 => array('Minute', 'Minuten'),
            1 => array('Sekunde', 'Sekunden'),
        );

        // Loop through the intervals and find the appropriate one
        foreach ($intervals as $seconds => $labels) {

            // Check if the time difference is greater than or equal to the current interval
            if ($timeDifference >= $seconds) {
               
                // Calculate the number of units (weeks, days, hours, etc.)
                $time = floor($timeDifference / $seconds);

                // Choose the correct label based on the number of units
                $label = ($time > 1) ? $labels[1] : $labels[0];

                // Return the formatted time difference message
                return '<strong>' . $time . '</strong> ' . $label . ' her';
            }
        }
    }
@endphp

@include('head')  
    <link rel="stylesheet" href="{{asset ('css/style.css')}}">
</head>
<body>
    
   
    <nav class="head">
        <h4 class="p-3 mt-2 text-light bg-success">Benutzerstatus</h4>
    </nav>
    @if(session('success'))
        <div id="messageDiv" class="d-flex justify-content-center alert alert-success alert-dismissible w-50 text-center">
            {{ session('success') }}
        </div>
        <script>
            // Function to hide the message after 3 seconds
            setTimeout(function() {
                $('#messageDiv').fadeOut('slow', function() {
                    // After fading out, remove the message and clear the session data
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
                            {{-- Set the icon color based on online status --}}
                            @php
                                $lastSeen = $user->last_logged_out;
                                $isOnline = ($user->status_user === 'online');
                                $iconColorClass = $isOnline ? 'text-success' : 'text-danger';
                            @endphp
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->user_type}}</td>

                            <!-- Check of the User online OR offline and change the color  -->  
                            <td>
                                @if($isOnline)
                                    <span class="online light">online</span>
                                    {{-- <i class="fa fa-user {{$iconColorClass}} mx-2 light"></i> --}}
                                    @else 
                                    <span class="offline">offline</span>
                                    {{-- <i class="fa fa-user {{$iconColorClass}} mx-2"></i> --}}
                                @endif
                            </td>

                            <!-- Show the Last Seen of User  -->  
                            <td>{!! calculateLastSeen($lastSeen, $isOnline) !!}</td>
                            
                            <!-- Show the Period of the Session of User  --> 
                            <td>
                                @if($isOnline)
                                    <strong>Die Sitzung geht weiter</strong>    
                                @else 
                                    <?php echo number_format((strtotime($user->last_logged_out) - strtotime($user->last_seen)) / 60, 2) . ' Min'; ?>
                                @endif
                            </td>
                            
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
                        <div id="delete-msg-{{$user->id}}" class="delete-msg" style="display:none;">
                            <div class="popup-content">
                                <div class="cont">
                                    <span class="fa fa-check-circle text-success"></span>
                                    <span class="msg"><strong class="bestät">Bestätigungsmeldung</strong><br>
                                        Möchten Sie wirklich {{$user->name}}'s Konto für immer löschen?
                                    </span>
                                </div>
                                <div class="btns">
                                    <button class="cancel-btn" onclick="closePopup({{$user->id}})">
                                        Abbrechen
                                    </button>
                                    <form action="{{ url('status/userstatus', $user->id) }}" method="post">
                                        @csrf
                                        @method('post')
                                        <button type="submit" class='btn delete-btn'>
                                            ja
                                        </button>
                                    </form>
                                </div>
                            </div> 
                        </div> 
                       
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

<script>
    // This function is executed when the document is ready
    $(document).ready(function () {
        // Attach a change event listener to elements with the class 'activeUser'
        $('.activeUser').on('change', function () {
            // Get the user ID by finding the closest 'tr' (table row) and selecting the text of the first 'td' (table cell)
            var userId = $(this).closest('tr').find('td:first').text();

            // Determine the user status based on whether the checkbox is checked or unchecked
            var isActive = $(this).is(':checked') ? 'active' : 'inactive';
            // Make an AJAX request to update the database
            $.ajax({
                type: 'POST',
                url: '{{ route("user.status.change", ["userId" => ":userId", "isActive" => ":isActive"]) }}'
                    .replace(':userId', userId)
                    .replace(':isActive', isActive),
                data: {
                    userId: userId, // Pass the user ID to the server
                    isActive: isActive,// Pass the user status to the server
                    _token: '{{ csrf_token() }}'
                },

                success: function (response) {
                    // Handle the response from the server (e.g., log it to the console)
                    console.log(response);
                },

                error: function (error) {
                    // Handle any errors that occur during the AJAX request
                    console.error('Error updating user status:', error);
                }
            });
        });
    });
</script>

<script>
    function showPopup(id) {
        let d = document.getElementById("delete-msg-" + id);
        if(d !== null){
            d.style.display = "block";
        }
    }

    function closePopup(id) {
        document.getElementById("delete-msg-" + id).style.display = "none";
    }
</script>

</body>
</html>