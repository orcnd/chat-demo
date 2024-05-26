<div class="container">
    <div class="row">
        <div class="col">
            <h3>Welcome {{$name}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col border border-secondary">
              <div id="messageList"
              class="gap-1"
              hx-get="{{route('messages')}}" sse-swap="innerHTML"
                hx-trigger="newMessage" placeholder="loading">
                
            </div>
        </div>
    </div>

</div>
<div class="fixed-bottom bg-white">
<div class="container">
    <div class="row ">
        <div class="col">
            <hr>
            @include('messageSend')
        </div>
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