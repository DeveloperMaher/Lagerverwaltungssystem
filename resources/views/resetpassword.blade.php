<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materialien Management System</title>
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{asset ('css/style-form.css')}}">
</head>
<body>
    <div class="form-container">
        <form action="{{ url('resetpassword') }}" method="post">
            @csrf
            @method('POST')
            <h3><strong>Lagerverwaltungssystem</strong><br>Passwort zurücksetzen</h3>

            @if(isset($errors))
                        
                @foreach($errors->all() as $error)
                    @if($error =='Das Passwort wurde zurückgesetzt')

                        <span  class="success">{{$error}}</span>
                    @else 
                        
                        <span class="error-msg">{{$error}}</span>
                    @endif
                    
                @endforeach
            
            @endif

            @if(isset($success))
                        
                @foreach($success->all() as $success)
                @endforeach
            
            @endif

          
            <input type="email" name="email" required placeholder="E-Mail eingeben"
            data-toggle="tooltip" data-placement="top" title="Bitte füllen Sie dieses Feld aus" autocomplete = "off">
            <input type="password" name="resetpass" required placeholder="neues passwort eingeben"
            data-toggle="tooltip" data-placement="top" title="Bitte füllen Sie dieses Feld aus" autocomplete = "off">
            <input type="password" name="resetpass_confirm" required placeholder="Passwort bestätigen"
            data-toggle="tooltip" data-placement="top" title="Bitte füllen Sie dieses Feld aus" autocomplete = "off">
            <input type="submit" value="zurücksetzen" name="submit" class="form-btn btn btn-success w-50 p-1 m-1">

            <p><a href="{{url('/login')}}">Jetzt einloggen</a></p>
        </form>
    </div>
    
</body>
</html>