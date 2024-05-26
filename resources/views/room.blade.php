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

    <div class="row sticky-bottom bg-white ">
        <div class="col">
            <hr>
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
    
    htmx.on("htmx:load", function(evt) {
        if ($(evt.target).hasClass('messageList')){
            window.scrollTo(0, document.body.scrollHeight);
            stickToBottom=true;
        }
    });
    getUpdateAction();

</script>