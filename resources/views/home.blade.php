@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render())

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @role('superadministrador')
                        <!-- {{ __('Hello, Super Admin you are logged in!') }} -->
                        <!-- 
                        <div class="card-header p-3">
                            <i class="fas fa-edit"></i> Información de proyectos
                        </div> -->
                        <div class="row">
                            <div class="col-5" id="grafica1" style="height: 400px; width: 50%;"></div>
                            <div class="col-6" id="grafica2" style="height: 400px; width: 50%;"></div>
                        </div> 
                        <hr>                        
                    @endrole

                    @role('administrador')
                        {{ __('You aren´t Super Admin but, but you are an Admin logged in! :)') }}
                    @endrole

                    @role('asociado')
                        {{ __('You aren´t Super Admin but, but you are an Asociado logged in! :)') }}
                    @endrole
                </div>
            </div>
        </div>
    </div>
@endsection