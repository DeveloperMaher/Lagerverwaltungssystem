<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materialien Management System</title>
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="assets/css/normalize.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    {{-- <link rel="stylesheet" href="{{url('css/style-form.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/style-form.css')}}">
</head>
<body>
    <div class="form-container">
        <form action="{{ url('register') }}" method="post">
        @csrf
        @method('POST')
        <h3><strong>Lagerverwaltungssystem</strong><br>Anmeldeformular</h3>

            @if(isset($errors) && count($errors) > 0)
                    
                @foreach($errors->all() as $error)
                    <span class="error-msg">{{$error}}</span>
                @endforeach
            
            @endif


            <input type="text" name="name" required placeholder="Name eingeben" 
            data-toggle="tooltip" data-placement="top" title="Bitte füllen Sie dieses Feld aus" autocomplete = "off">
            <input type="email" name="email" required placeholder="E-Mail eingeben" 
            data-toggle="tooltip" data-placement="top" title="Bitte füllen Sie dieses Feld aus"autocomplete = "off">
            <input type="password" name="password" required placeholder="Passwort eingeben" 
            data-toggle="tooltip" data-placement="top" title="Bitte füllen Sie dieses Feld aus" autocomplete = "off">
            <input type="password" name="cpassword" required placeholder="Passwort bestätigen" 
            data-toggle="tooltip" data-placement="top" title="Bitte füllen Sie dieses Feld aus" autocomplete = "off">
            <select name="user_type">
                <option value="administrator">Administrator</option>
                <option value="benutzer">Benutzer</option>
            </select>
            <input type="submit" value="registrieren" name="submit" class="form-btn btn btn-success w-50 p-1 m-1">
            <p>* Haben Sie bereits ein Konto? <a href="{{url('/login')}}">Jetzt einloggen</a></p>
         </form>
    </div>
</body>
</html>