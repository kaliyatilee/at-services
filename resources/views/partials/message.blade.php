@if(session('status'))
<div class="card-panel {{ session('status') == 'success' ? 'green lighten-4 green-text' : 'red lighten-4 red-text' }}">
    {{ session('message') }}
</div>
@endif
