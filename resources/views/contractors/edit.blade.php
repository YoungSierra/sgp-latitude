@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('contractors.edit'))

@section('content')
	<div class="row">
		<div class="col">
			<h1>Editar Contratista</h1>
		</div>
	</div>
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
        <div class="col-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-edit"></i> Editar
                </div>
                <div class="card-body">
                	<form method="POST" action="{{ route('contractors.update', $contractor->id) }}">
                		@method('PUT')
                        @csrf
	                	<div class="form-group">
	                        <label for="name">Nombre</label>
	                        <input
		                        id="name"
		                        name="name"
		                        type="text"
		                        placeholder="Nombre"
		                        value="{{ $contractor->name }}"
		                        class="form-control @error('name') is-invalid @enderror"
	                        >
	                        @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
	                    </div>
	                	<div class="form-group">
	                        <label for="name">Descripción</label>
	                        <textarea
	                        	id="description"
		                        name="description"
		                        rows="6"
		                        placeholder="Descripción del contratista..."
		                        class="form-control @error('description') is-invalid @enderror"
	                        >{{ $contractor->description }}</textarea>
	                        @error('description')
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
						      		<option value="{{ $key }}" {{ ($contractor->status == $key) ? 'selected' : '' }}>
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
			            <hr>
	                    <div class="row">
    						<div class="col">
    							<a role="button"
    								class="btn btn-secondary btn-block"
    								href="{{ route('contractors.index') }}"
    							>
									<i class="fas fa-undo-alt"></i> Regresar
								</a>
    						</div>
    						<div class="col">
    							<button class="btn btn-primary btn-block" type="submit">
									<i class="far fa-save"></i> Editar
								</button>
    						</div>
    					</div>
			        </form>
                </div>
            </div>
        </div>
    </div>
@endsection