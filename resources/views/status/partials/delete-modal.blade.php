<div id="delete-msg-{{$user->id}}" class="delete-msg" style="display:none;">
    <div class="popup-content">
        <div class="cont">
            <span class="fa fa-check-circle text-success"></span>

            <span class="msg">
                <strong class="bestät">Bestätigungsmeldung</strong><br>
                Möchten Sie wirklich {{$user->name}}'s Konto für immer löschen?
            </span>
        </div>

        <div class="btns">
            <button class="cancel-btn" onclick="closePopup({{$user->id}})">
                Abbrechen
            </button>

            <form action="{{ url('status/userstatus', $user->id) }}" method="post">
                @csrf

                <button type="submit" class="btn delete-btn">
                    Ja
                </button>
            </form>
        </div>
    </div>
</div>