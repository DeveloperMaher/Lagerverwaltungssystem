
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materialien Management System</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{asset('css/style-form.css')}}">
</head>

<body>
    
    
    <div>
        @if(session('logout'))
            <div id="info-logout" class="d-flex justify-content-center alert alert-success alert-dismissible w-50 text-center">
                {{ session('logout') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="form-container">
        

        <form action="{{ url('login') }}" method="post">
            @csrf
            @method('POST')
            <h3><strong>Lagerverwaltungssystem</strong><br>Melden Sie sich an</h3>

            @if(isset($errors) && count($errors) > 0)
                
                @foreach($errors->all() as $error)
                     <span class="error-msg">{{$error}}</span>
                @endforeach
              
            @endif

            <input type="email" name="email" value="{{ old('email') }}" required placeholder="E-Mail eingeben"
            data-toggle="tooltip" data-placement="top" title="Bitte füllen Sie dieses Feld aus" autocomplete = "off">
            <input type="password" name="password" required placeholder="Passwort eingeben"
            data-toggle="tooltip" data-placement="top" title="Bitte füllen Sie dieses Feld aus" autocomplete = "off">
            <input type="submit" value="anmelden" name="submit" class="form-btn btn btn-success w-50 p-1 m-1">
            
            <p>* Haben Sie das Passwort vergessen? <a href="{{url('resetpassword')}}">zurücksetzen</a></p>
            <p>* Haben Sie kein Konto? <a href="{{url('register')}}">Jetzt registrieren</a></p>
        </form>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const infoAlert = document.getElementById('info-logout');
            if (infoAlert) {
                setTimeout(() => {
                    infoAlert.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</body>
</html>