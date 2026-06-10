<div id="msg-stu" class="alert alert-warning alert-dismissible mt-2 hide" role="alert">
    Es gibt nur {{session('total_stück')}} Stü. davon, dieses Material muss bestellt werden <br>
    <span class="rememberlist-text">
        zur Merkliste hinzufügen, klicken
        <button class="button" type="submit" name="action" value="rememberlist-btn">
            <strong class="rememberlist-btn">&#43;</strong>
        </button>
    </span> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@if (session('total_stück') >= 0 && session('total_stück') < $rechnerValue && session('total_stück') != "")
    <script>document.getElementById("msg-stu").classList.remove("hide");</script>
@endif

    @if(session('info'))
        <div id="info-alert" class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif
    @if(session('add'))
    <div class="rememberlist-msg alert alert-success alert-dismissible mt-2" role="alert">
        <i class="fa fa-check-circle"></i> 
        {{ session('add') }}
        <br>
        <a href = "{{url('remember/rememberlist')}}" >
            <strong class="merkliste">die Merkliste anzeigen</strong>
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

{{-- Start remember list message --}}
<div class="rememberlist-msg alert alert-success alert-dismissible mt-2 hide" role="alert">
    <i class="fa fa-check-circle"></i> 
        Das Material wurde erfolgreich hinzugefügt
    <a href = "{{url('remember/rememberlist')}}" >
        <strong class="merkliste">die Merkliste anzeigen</strong>
    </a>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
{{-- End remember list message --}}

<script>
    const btnRemList = document.querySelector('.rememberlist-btn');
    const infoAlert = document.getElementById('info-alert');
    const msgRemList = document.querySelector('.rememberlist-msg');

    // Automatically hide the info alert after 5 seconds
    setTimeout(() => {
        if (infoAlert) {
            infoAlert.style.display = 'none';
        }
    },  5000);

    setTimeout(() => {
        if (msgRemList) {
            msgRemList.classList.add('hide');
        }
    },  5000);

</script>