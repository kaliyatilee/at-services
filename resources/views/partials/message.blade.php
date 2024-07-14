@if(session('status'))
<div class="success_error_message {{session('status')=='success' ? 'text-success':'text-danger' }}">
    {{ session('message') }}
</div>
@endif
