<div class="mt-5 change-value">
    <form action="{{ url('rechner/rechnerreset')}}" method="post">
        @csrf
        @method('POST')
        <input class="input-app" min= "1" type="number" id="wert" name="wert-app" placeholder="den Wert eingeben">
        <div class="btns">
            <button class = "btn btn-success p-1 change" type="submit" name="action" value="set">ändern</button>
            @if($rechnerValue !== 10)
                <button class = "btn btn-outline-success p-1 default" type="submit" name="action" value="reset"
                data-toggle="tooltip" data-placement="top" title="den Wert auf 10 wieder einstellen">standard</button>
            @endif
        </div>
    </form>
    <p class="text-muted">* Pflichtfeld</p>
    <p class="text-muted" style="fontsize:10px;">* Der Wert, bei dem die Meldungen erscheinen, dass dieses Material zu wenig im Lager ist und bestellt werden muss</p>
    <p class="text-muted mb-4" style="fontsize:10px;">* Der aktuelle Wert ist: <strong>{{$rechnerValue}}</strong></p>
</div> 
</div>