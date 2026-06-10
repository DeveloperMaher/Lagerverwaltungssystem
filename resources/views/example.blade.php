@include('head')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <nav class="head">
        <h4 class="p-3 mt-2 text-light bg-success">Status</h4>
    </nav>

    <div class="rahmen">
        <!-- Start Table of Users section -->
        <div class="container-fluid table-responsive mb-3 text-center" id="table">
            <table class="table table-bordered mt-2 table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($users as $user)
                        {{-- Set the icon color based on online status --}}
                        @php
                            $lastSeen = $user->last_logged_out;
                            $isOnline = $user->status_user === 'online';
                            $iconColorClass = $isOnline ? 'text-success' : 'text-danger';
                        @endphp
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>


                            <!-- Check of the User online OR offline and change the color  -->
                            <td>
                                <a href="user/{{ $user->id }}"
                                    class="btn btn-sm btn-{{ $user->status ? 'success' : 'danger' }} {{ $user->status ? 'light' : '' }}">
                                    <strong>{{ $user->status ? 'Enable' : 'Disable' }}</strong>
                                </a>
                            </td>


                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- End Table of Users section -->
        <div class="text-center">
            {{ $users->links() }}
        </div>
    </div>
    <!-- Start Footer section -->
    @include('footer')
    <!-- End Footer section -->

    <script></script>

</body>

</html>
