<div class="col-md-10 my-1">
    <label for="name" class="form-label">Nome*</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $usuario->name ?? '')}}" name="name" id="name">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-6 my-1">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email', $usuario->email ?? '')}}" id="email">
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-6 my-1">
    <label for="password" class="form-label">Senha</label>
    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" id="password">
    @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-6 my-1">
    <label for="password1" class="form-label">Confirmar senha</label>
    <input type="password" name="password1" class="form-control @error('password1') is-invalid @enderror" value="{{old('password1')}}" id="password1">
    @error('password1')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-12 my-1">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
