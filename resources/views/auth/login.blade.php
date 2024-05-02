@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 class="my-4">Вход</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       
        <!-- Форма для входа -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Войти</button>
            </div>
        </form>
        
        <!-- Ссылка на страницу восстановления пароля -->
       
    </div>
</div>
@endsection
