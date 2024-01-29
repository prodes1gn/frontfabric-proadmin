@if(session('danger'))
<div class="alert alert-danger" role="alert">{{ session('danger') }}</div>
@endif
@if(session('message'))
<div class="alert alert-success" role="alert">{{ session('message') }}</div>
@endif
<!--@if($errors->count() > 0)
<div class="alert alert-danger">
    <ul class="list-unstyled">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif-->
@if(session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<!--@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif-->