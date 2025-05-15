@extends('base')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card mt-5">
      <div class="card-header">Inscription</div>
      <div class="card-body">
        <form method="POST" action="{{ route('auth.register') }}">
          @csrf

          <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input id="name" type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Adresse Email</label>
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select id="role" name="role"
                    class="form-select @error('role') is-invalid @enderror" required>
              <option value="membre" {{ old('role')=='membre' ? 'selected' : '' }}>Membre</option>
              <option value="chef"   {{ old('role')=='chef'   ? 'selected' : '' }}>Chef de projet</option>
              <option value="admin"  {{ old('role')=='admin'  ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password"
                   class="form-control"
                   name="password_confirmation" required>
          </div>

          <button type="submit" class="btn btn-success w-100">S’inscrire</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
