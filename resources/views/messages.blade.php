
<div class="vstack gap-0 mx-auto messageList">
    @foreach ($messages as $message)
    <div class="{{$user==$message->name?'ms':'me'}}-auto">
        <div class="alert alert-{{$user==$message->name?'primary':'secondary'}} gap-0 p-1" role="alert">
            <b>{{$message->name}}: </b> <i>{{$message->message}}</i>
            <br><span class="fs-6 fw-lighter">{{date('d/m/Y H:i:s', strtotime($message->created_at))}}</span>
        </div>
    </div>
    @endforeach
</div>