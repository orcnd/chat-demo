<form hx-post="{{route('sendMessage')}}" action="{{route('sendMessage')}}" hx-swap="outerHTML" class="d-flex flex-row ">
    
        <label for="messageInput" class="my-1 me-2">Message</label>
    
        <input type="text" name="message" id="messageInput" class="form-control my-1">
    
        <input type="submit" value="Send" class="btn btn-primary my-1">
</form>