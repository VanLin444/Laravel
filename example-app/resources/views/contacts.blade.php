@extends('layouts.main')
@section('content')
<div style="display: flex;">
    <div class="card" style="width: 18rem; margin-right: 10px">
        <img src="{{ asset('storage\dragheadsl.jpg') }}" class="card-img-top" alt="left">  
        <div class="card-body">
            <h5 class="card-title">Тимлид</h5>
            <p class="card-text">"Ваш код — говно"</p>
            <a href="#" class="btn btn-primary">Перейти куда-нибудь</a>
        </div>
    </div>
    <div class="card" style="width: 18rem; margin-right: 10px">
        <img src="{{ asset('storage\dragheadsm.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Рекрутёр</h5>
            <p class="card-text">"Но вы сказали у вас большой опыт!"</p>
            <a href="#" class="btn btn-primary">Перейти куда-нибудь</a>
        </div>
    </div>
    <div class="card" style="width: 18rem; margin-right: 10px">
        <img src="{{ asset('storage\dragheadsr.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Я</h5>
            <p class="card-text">Да, в написании говнокода...</p>
            <a href="#" class="btn btn-primary">Перейти куда-нибудь</a>
        </div>
    </div>
</div>
@endsection