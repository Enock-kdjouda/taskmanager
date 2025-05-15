@extends('base')

@section('content')
<div class="container">
    <h2>Réinitialiser le mot de passe</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input id="email" type="email" class="form-control" name="email" required autofocus>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Nouveau mot de passe</label>
            <input id="password" type="password" class="form-control" name="password" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Réinitialiser le mot de passe</button>
    </form>
</div>
@endsection
