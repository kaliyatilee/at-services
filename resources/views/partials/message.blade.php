@if(session('status'))
<div class="{{session('status')=='success' ? 'alert alert-default-success':'alert alert-default-danger' }}">
    {{ session('message') }}
</div>
@endif
