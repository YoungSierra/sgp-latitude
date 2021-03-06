@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('breadcrumbs', Breadcrumbs::render('users.edit'))

@section('content')
	<div class="row">
		<div class="col">
			@if (session('message'))
			    <div class="alert alert-success" role="alert">
			    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  	<i class="fas fa-times-circle"></i>
					</button>
			        {{ session('message') }}
			    </div>
			@endif
		</div>
	</div>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-edit"></i> Editar Usuario
                </div>
                <div class="card-body">
                	<form method="POST" action="{{ route('users.update', $user->id) }}">
						@method('PUT')
				    	@csrf
				    	<div class="row">
	        				<div class="col">
			                    <div class="form-group">
			                        <label for="first_name">Nombres</label>
			                        <input
				                        type="text"
				                        id="first_name"
				                        name="first_name"
				                        placeholder="Nombres"
				                        autocomplete="off"
				                        value="{{ $user->first_name }}"
				                        class="form-control @error('first_name') is-invalid @enderror"
			                        >
			                        @error('first_name')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
			                    </div>
			                    <div class="form-group">
			                        <label for="email">Correo</label>
			                        <input
				                        id="email"
				                        name="email"
				                        type="text"
				                        placeholder="user@example.com"
				                        autocomplete="off"
				                        value="{{ $user->email }}"
				                        class="form-control @error('email') is-invalid @enderror"
			                        >
			                        @error('email')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
			                    </div>
			                    <div class="form-group">
			                        <label for="rol">Rol</label>
			                        <select
				                        id="rol"
				                        name="rol"
				                        class="form-control @error('rol') is-invalid @enderror"
			                        >
			                        	<option value="">Seleccionar</option>
			                        	@foreach ($roles as $rol)
								      		<option value="{{ $rol->id }}" {{ ($user_rol[0] == $rol->name) ? 'selected' : '' }}>
								      			{{ $rol->name }}
								      		</option>
			                        	@endforeach
								    </select>
								    @error('rol')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
			                    </div>
			                </div>
			                <div class="col">
			                    <div class="form-group">
			                        <label for="last_name">Apellidos</label>
			                        <input
				                        id="last_name"
				                        name="last_name"
				                        type="text"
				                        autocomplete="off"
				                        placeholder="Apellidos"
				                        value="{{ $user->last_name }}"
				                        class="form-control @error('last_name') is-invalid @enderror"
			                        >
			                        @error('last_name')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
			                    </div>
			                    <div class="form-group">
			                        <label for="status">Estado</label>
			                        <select
			                        	id="status"
				                        name="status"
				                        class="form-control @error('status') is-invalid @enderror"
			                        >
								      	@foreach ($states as $key => $value)
								      		<option value="{{ $key }}" {{ ($user->status == $key) ? 'selected' : '' }}>
								      			{{ $value }}
								      		</option>
			                        	@endforeach
								    </select>
								    @error('status')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
			                    </div>
			                    <div class="form-group">
			                        <label for="associate_id">Asociado</label>
			                        <select
				                        id="associate_id"
				                        name="associate_id"
				                        class="form-control @error('associate_id') is-invalid @enderror"
			                        >
			                        	<option value="">Seleccionar</option>
			                        	@foreach ($associates as $associate)
								      		<option value="{{ $associate->id }}" {{ ($user->associate_id == $associate->id) ? 'selected' : '' }}>
								      			{{ $associate->first_name }} {{ $associate->last_name }}
								      		</option>
			                        	@endforeach
								    </select>
								    @error('associate_id')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
			                    </div>
			                </div>
			            </div>
			            <div class="row">
							<div class="col">
								<a class="btn btn-secondary btn-block" role="button" href="{{ route('users.index') }}">
									<i class="fas fa-undo-alt"></i> Regresar
								</a>
							</div>
							<div class="col">
								<button class="btn btn-primary btn-block" type="submit">
									<i class="fas fa-check"></i> Actualizar
								</button>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
@endsection