<div class="container">
    <div class="row">
        <div class="col">
            <h3>Welcome {{$name}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
              <div id="messageList"
              hx-get="{{route('messages')}}" sse-swap="innerHTML"
                hx-trigger="newMessage"
                placeholder="loading"
              >
                
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col">
            @include('messageSend')
        </div>
    </div>
</div>

<script>
    var lastUpdate=-1;

    function getUpdateAction() {        
        $.ajax({
            method:'GET',
            url:"{{route('lastUpdate')}}",
            cache:false,
        }).done(function (latest) {
            latest=parseInt(latest);
            if (latest>lastUpdate) {
                lastUpdate=latest;
                htmx.trigger("#messageList", "newMessage")
            }
            setTimeout(getUpdateAction,3000);
        });
    }
    
    getUpdateAction();

</script>