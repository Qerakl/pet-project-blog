@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 class="my-4">Регистрация</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Форма для регистрации -->
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Имя:</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="password-confirm">Подтвердите пароль:</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
            </div>
        </form>
    </div>
</div>
@endsection
