@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('projects.edit'))

@section('content')
	<div class="row">
		<div class="col">
			<h1>Editar Proyecto</h1>
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
        <div class="col-12">
            <div class="card shadow-sm">
                <!--<div class="card-header">
                    <i class="fas fa-edit"></i> Editar
                </div> -->    
                <div class="card-body">
                	<form id="editarproject" method="POST" action="{{ route('projects.update', $project->id) }}">
                		@method('PUT')
                        @csrf
	                	<div class="form-group">
	                        <label for="name">Nombre</label>
	                        <input
		                        id="name"
		                        name="name"
		                        type="text" required
		                        placeholder="Nombre"
		                        value="{{ $project->name }}"
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
		                        rows="2" required
		                        placeholder="Descripción del contratista..."
		                        class="form-control @error('description') is-invalid @enderror"
	                        >{{ $project->description }}</textarea>
	                        @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
	                    </div>

                        <div class="form-group row">
                            <div class="col-4">
                                <label for="name">Valor contrato $</label>
                                <input
                                    id="valor"
                                    name="valor"
                                    type="text" readonly
                                    placeholder="Valor" required
                                    value="{{ $project->valor }}"
                                    class="form-control @error('valor') is-invalid @enderror"
                                >
                                @error('valor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-4">

                                <label for="name">Tiempo</label>
                                <input
                                    id="tiempo"
                                    name="tiempo"
                                    type="number" required
                                    placeholder="Tiempo"
                                    value="{{ $project->tiempo }}"
                                    class="form-control @error('tiempo') is-invalid @enderror"
                                >
                                @error('tiempo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-4">
                                <label for="status">Estado</label>
                                <select
                                    id="status"
                                    name="status" required
                                    class="form-control @error('status') is-invalid @enderror"
                                >
                                    @foreach ($states as $key => $value)
                                        <option value="{{ $key }}" {{ ($project->status == $key) ? 'selected' : '' }}>
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
                        </div>

                        <!-- Seccion de impuestos -->
			            <hr>
                        <!-- <div class="">
                            <i class="fas fa-plus-circle"></i>  
                            <b> Impuestos cliente </b>
                        </div><br>-->

	                    <div class="form-group row">
                            <div class="col-2">
                                <label for="valorbruto"><b>VALOR BRUTO $</b> </label>
                                <input
                                    id="valorbruto"
                                    name="valorbruto"
                                    type="number"
                                    onkeyup="calcularImpuestos();"
                                    placeholder="0" required
                                    min="1" 
                                    value="{{ $project->valorbruto}}"
                                    class="form-control @error('valorbruto') is-invalid @enderror"
                                >
                                @error('valorbruto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-2">
                                <label for="iva">IVA % </label>
                                <input
                                    id="iva"
                                    name="iva"
                                    onkeyup="calcularImpuestos();"
                                    type="number"
                                    step=".01" required
                                    placeholder="0.00"
                                    value="{{ $project->iva}}"
                                    class="form-control @error('iva') is-invalid @enderror"
                                >
                                @error('iva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-2">
                                <label for="iva_v">IVA $ </label>
                                <input
                                    id="iva_v"
                                    name="iva_v"
                                    type="text"
                                    placeholder="0.00"
                                    readonly
                                    value="{{$project->iva_v}}"
                                    class="form-control "
                                >
                            </div>
                            <div class="col-2">
                                <label for="retfuente">RTEFUENTE % </label>
                                <input
                                    id="retfuente"
                                    name="retfuente"
                                    type="number"
                                    step=".01" required
                                    onkeyup="calcularImpuestos();"
                                    placeholder="0.00"
                                    value="{{$project->retfuente}}"
                                    class="form-control @error('retfuente') is-invalid @enderror"
                                >
                                @error('retfuente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-2">
                                <label for="retfuente_v">RTEFUENTE $ </label>
                                <input
                                    id="retfuente_v"
                                    name="retfuente_v"
                                    type="text"
                                    placeholder="-0.00"
                                    readonly
                                    value="{{$project->retfuente_v}}"
                                    class="form-control "
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-2">
                                <label for="ica">ICA % </label>
                                <input
                                    id="ica"
                                    name="ica"
                                    type="number"
                                    step="0.001" required
                                    onkeyup="calcularImpuestos();"
                                    placeholder="0.00"
                                    value="{{$project->ica}}"
                                    class="form-control @error('ica') is-invalid @enderror"
                                >
                                @error('ica')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-2">
                                <label for="ica_v">ICA $ </label>
                                <input
                                    id="ica_v"
                                    name="ica_v"
                                    type="text"
                                    placeholder="-0.00"
                                    readonly
                                    value="{{$project->ica_v}}"
                                    class="form-control "
                                >
                            </div>

                            <div class="col-2">
                                <label for="retiva">RTE IVA % </label>
                                <input
                                    id="retiva"
                                    name="retiva"
                                    type="number"
                                    step=".01" required
                                    onkeyup="calcularImpuestos();"
                                    placeholder="0.00"
                                    value="{{$project->retiva}}"
                                    class="form-control @error('retiva') is-invalid @enderror"
                                >
                                @error('retiva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-2">
                                <label for="retiva_v">RTE IVA $ </label>
                                <input
                                    id="retiva_v"
                                    name="retiva_v"
                                    type="text"
                                    placeholder="-0.00"
                                    readonly
                                    value="{{$project->retiva_v}}"
                                    class="form-control "
                                >
                            </div>

                            <div class="col-2">
                                <label for="estampillas">ESTAMPILLAS % </label>
                                <input
                                    id="estampillas"
                                    name="estampillas"
                                    type="number" required
                                    step=".01"
                                    onkeyup="calcularImpuestos();"
                                    placeholder="0.00"
                                    value="{{$project->estampillas}}"
                                    class="form-control @error('estampillas') is-invalid @enderror"
                                >
                                @error('estampillas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-2">
                                <label for="estampillas_v">ESTAMPILLAS $ </label>
                                <input
                                    id="estampillas_v"
                                    name="estampillas_v"
                                    type="text"
                                    placeholder="-0.00"
                                    readonly
                                    value="{{$project->estampillas_v}}"
                                    class="form-control "
                                >
                            </div>
                        </div>

                        <div class="">
                            <!-- <i class="fas fa-plus-circle"></i>  -->
                            <b> Impuestos a terceros </b>
                        </div><br>

                        <div class="form-group row">
                            <div class="col-2">
                                <label for="cree">CREE % </label>
                                <input
                                    id="cree"
                                    name="cree"
                                    type="number"
                                    onkeyup="calcularImpuestos();"
                                    step=".01" required
                                    placeholder="0.00"
                                    value="{{$project->cree}}"
                                    class="form-control @error('cree') is-invalid @enderror"
                                >
                                @error('cree')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-2">
                                <label for="cree_v">CREE $ </label>
                                <input
                                    id="cree_v"
                                    name="cree_v"
                                    type="text"
                                    placeholder="-0.00"
                                    readonly
                                    value="{{$project->cree_v}}"
                                    class="form-control @error('cree_v') is-invalid @enderror"
                                >
                            </div>

                            <div class="col-2">
                                <label for="ica_t">ICA </label>
                                <input
                                    id="ica_t"
                                    name="ica_t"
                                    type="number"
                                    onkeyup="calcularImpuestos();"
                                    step=".001"
                                    placeholder="0.00" required
                                    value="{{$project->ica_t}}"
                                    class="form-control @error('ica_t') is-invalid @enderror"
                                >
                                @error('ica_t')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-2">
                                <label for="ica_tv">ICA $ </label>
                                <input
                                    id="ica_tv"
                                    name="ica_tv"
                                    type="text"
                                    placeholder="-0.00"
                                    readonly
                                    value="{{$project->ica_tv}}"
                                    class="form-control "
                                >
                            </div>
                            <div class="col-2">
                                <label for="retica">RET ICA % </label>
                                <input
                                    id="retica"
                                    name="retica"
                                    type="number"
                                    onkeyup="calcularImpuestos();"
                                    step=".01" required
                                    placeholder="0.00"
                                    value="{{$project->retica}}"
                                    class="form-control @error('retica') is-invalid @enderror"
                                >
                                @error('retica')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-2">
                                <label for="retica_v">RET ICA $ </label>
                                <input
                                    id="retica_v"
                                    name="retica_v"
                                    type="text"
                                    placeholder="-0.00"
                                    readonly
                                    value="{{$project->retica_v}}"
                                    class="form-control "
                                >
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">

                            <div class="col-4">
                                <label for="netopagar"><b>NETO A PAGAR $ </b></label>
                                <input
                                    id="netopagar"
                                    name="netopagar"
                                    type="text"
                                    placeholder="0.00"
                                    readonly
                                    value="{{$project->netopagar}}"
                                    class="form-control "
                                >
                            </div>
                            <div class="col-4">
                                <label for="totimpuesto"><b>TOTAL IMPUESTOS $ </b></label>
                                <input
                                    id="totimpuesto"
                                    name="totimpuesto"
                                    type="text"
                                    placeholder="0.00"
                                    readonly
                                    value="{{$project->totimpuesto}}"
                                    class="form-control "
                                >
                            </div>                         
                            <div class="col-4">
                                <label for="neto"><b>NETO $</b> </label>
                                <input
                                    id="neto"
                                    name="neto"
                                    type="text"
                                    placeholder="0.00"
                                    readonly
                                    value="{{$project->neto}}"
                                    class="form-control "
                                >
                            </div>

                        </div>

                        <hr>
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="valorbruto_c">VALOR BRUTO DEL CONTRATO</label>
                            </div >
                            <div class="col-3">
                                <input id="valorbruto_c" name="valorbruto_c" type="text" placeholder="0.00"  readonly
                                value="{{$project->valorbruto_c}}" class="form-control " >
                            </div>                         
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="impuestos">IMPUESTOS</label>
                            </div >
                            <div class="col-3">
                                <input id="impuestos" name="impuestos" type="text" placeholder="0.00"  readonly
                                value="{{$project->impuestos}}" class="form-control " >
                            </div>                         
                        </div>  

                        <hr> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="totpolizas">PÓLIZAS</label>
                            </div >
                            <div class="col-3">
                                <input id="totpolizas" name="totpolizas" type="text" placeholder="0.00"  readonly
                                value="{{$project->totpolizas}}" class="form-control " >
                            </div>  
                            @if ($projectpolizas->count()>0)
                            <div class="col-1">
                                <button class="btn btn-primary btn-block" onclick="addPolizaEdit({{$projectpolizas->count()}})" type="button"> + </button>
                            </div>
                            @endif     
                            @if ($projectpolizas->count()==0)
                            <div class="col-1">
                                <button class="btn btn-primary btn-block" onclick="addPolizaEdit(1)" type="button"> + </button>
                            </div>
                            @endif     
                        </div>
                        
                        <div id="contenedor_polizas">
                            @if ($projectpolizas->count()>0)
                            @foreach ($projectpolizas as $key => $value0)
                            <div id="poliza_{{$key}}" class="form-group row" >  
                                <div class="col-4">
                                    <select id="sel_poliza_{{$key}}" name="sel_poliza_{{$key}}"  name="status" class="form-control" >
                                        @foreach ($polizas as $keyp => $value)
                                            <option  value="{{ $value->id}}" {{ ($value->id == $value0->idpolicie) ? 'selected' : '' }}  >
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input id="poliza_v_{{$key}}" name="poliza_v_{{$key}}" onkeyup="calTotPolizas()" required type="number" placeholder="$ 0.00" value="{{$value0->valor}}"  class="form-control " >
                                </div>   
                                @if ($key == 0)  
                                <div class="col-1">
                                    <button class="btn btn-danger btn-block d-none" type="button" onclick="delPoliza({{$key}})"> <i class="far fa-trash-alt"></i> </button>
                                </div>  
                                @endif   
                                @if ($key != 0)  
                                <div class="col-1">
                                    <button class="btn btn-danger btn-block " type="button" onclick="delPoliza({{$key}})"> <i class="far fa-trash-alt"></i> </button>
                                </div>  
                                @endif   
                            </div>   
                            @endforeach
                            @endif 

                            @if ($projectpolizas->count()==0)
                            <div id="poliza_0" class="form-group row" >  
                                <div class="col-4">
                                    <select id="sel_poliza_0" name="sel_poliza_0"  name="status" class="form-control" >
                                        @foreach ($polizas as $key => $value)
                                            <option value="{{ $value->id }}" >
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input id="poliza_v_0" name="poliza_v_0" onkeyup="calTotPolizas()" required type="number" placeholder="$ 0.00" value="0"  class="form-control " >
                                </div>     
                                <div class="col-1">
                                    <button class="btn btn-danger btn-block d-none" type="button" onclick="delPoliza(0)"> <i class="far fa-trash-alt"></i> </button>
                                </div>     
                            </div>                               
                            @endif 
                        </div>     
                        
                        <hr> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="totcontratistas">CONTRATISTAS</label>
                            </div >
                            <div class="col-3">
                                <input id="totcontratistas" name="totcontratistas" type="text" placeholder="0.00"  readonly
                                value="{{$project->totcontratistas}}" class="form-control @error('totcontratistas') is-invalid @enderror" >
                                @error('valor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>  
                            @if ($projectcontratistas->count()>0)
                            <div class="col-1">
                                <button class="btn btn-primary btn-block" onclick="addContratistaE({{$projectcontratistas->count()}})" type="button"> + </button>
                            </div>     
                            @endif
                            @if ($projectcontratistas->count()==0)
                            <div class="col-1">
                                <button class="btn btn-primary btn-block" onclick="addContratistaEdit(1)" type="button"> + </button>
                            </div>     
                            @endif
                        </div>
                        
                        <div id="contenedor_contratistas">
                            @if ($projectcontratistas->count()>0)
                            @foreach ($projectcontratistas as $key => $value0)
                            <div id="poliza_{{$key}}" class="form-group row" >  
                                <div class="col-4">
                                    <select id="sel_contratista_{{$key}}" name="sel_contratista_{{$key}}"  name="status" class="form-control" >
                                        @foreach ($contratistas as $keyp => $value)
                                            <option  value="{{ $value->id}}" {{ ($value->id == $value0->idcontractor) ? 'selected' : '' }}  >
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input id="contratista_v_{{$key}}" name="contratista_v_{{$key}}" onkeyup="calTotContratistas()" required type="number" 
                                    placeholder="$ 0.00" value="{{$value0->valor}}"  class="form-control " >
                                </div>   
                                @if ($key == 0)  
                                <div class="col-1">
                                    <button class="btn btn-danger btn-block d-none" type="button" onclick="delContratista({{$key}})"> <i class="far fa-trash-alt"></i> </button>
                                </div>  
                                @endif   
                                @if ($key != 0)  
                                <div class="col-1">
                                    <button class="btn btn-danger btn-block " type="button" onclick="delContratista({{$key}})"> <i class="far fa-trash-alt"></i> </button>
                                </div>  
                                @endif   
                   
                            </div>   
                            @endforeach
                            @endif 

                            @if ($projectcontratistas->count()==0)
                            <div id="contratista_0" class="form-group row" >  
                                <div class="col-4">
                                    <select id="sel_contratista_0"  name="sel_contratista_0" class="form-control" >
                                        @foreach ($contratistas as $key => $value)
                                            <option value="{{$value->id}}" >
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input id="contratista_v_0" name="contratista_v_0" onkeyup="calTotContratistas()" required type="number" placeholder="$ 0.00" value="0" min="0"  class="form-control " >
                                </div>     
                                <div class="col-1">
                                    <button class="btn btn-danger btn-block d-none" type="button" onclick="delContratista(0)"> <i class="far fa-trash-alt"></i> </button>
                                </div>     
                            </div>  
                            @endif   
                        </div>   

                        <hr> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="subtotal"><b>SUBTOTAL</b></label>
                            </div >
                            <div class="col-3">
                                <input id="subtotal" name="subtotal" type="text" placeholder="0.00"  readonly
                                       value="{{$project->subtotal}}" class="form-control " >
                            </div>                 
                        </div>   

                        <hr> 
                        <div class="form-group row">
                            <div class="col-4 text-center">
                                <label ><b>ITEM</b></label>
                            </div>
                            <div class="col-3 ">
                                <label ><b>VALOR SUBTOTAL $</b></label>
                            </div>
                            <div class="col-2 text-center">
                                <label ><b>%</b></label>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="comisionreferido">COMISION COMERCIAL REFERIDO</label>
                            </div >
                            <div class="col-3">
                                <input id="comisionreferido_v" name="comisionreferido_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->comisionreferido_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="comisionreferido" name="comisionreferido" required onkeyup="calCostosExternos();" type="number" step=".01" 
                                placeholder="0.00 %" value="{{$project->comisionreferido}}"
                                    class="form-control @error('comisionreferido') is-invalid @enderror" >
                                @error('comisionreferido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>        
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="imprevistos">MARCA</label>
                            </div >
                            <div class="col-3">
                                <input id="imprevistos_v" name="imprevistos_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->imprevistos_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="imprevistos" name="imprevistos" required onkeyup="calCostosExternos();" type="number" step=".01" 
                                placeholder="0.00" value="{{$project->imprevistos}}"
                                    class="form-control @error('imprevistos') is-invalid @enderror" >
                                @error('imprevistos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>                        


                        <div class="form-group row">
                            <div class="col-4">
                                <label for="apalancamiento">APALANCAMIENTO</label>
                            </div >
                            <div class="col-3">
                                <input id="apalancamiento_v" name="apalancamiento_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->apalancamiento_v}}" class="form-control " >
                            </div>    
                            <div class="col-2">
                                <input id="apalancamiento" name="apalancamiento" required onkeyup="calCostosExternos();" type="number" step=".01" 
                                placeholder="0.00" value="{{$project->apalancamiento}}"
                                    class="form-control @error('apalancamiento') is-invalid @enderror" >
                                @error('apalancamiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>                          

                        <div class="form-group row">
                            <div class="col-4">
                                <label for="obligafinancieras">OBLIGACIONES FINANCIERAS</label>
                            </div >
                            <div class="col-3">
                                <input id="obligafinancieras_v" name="obligafinancieras_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->obligafinancieras_v}}" class="form-control @error('obligafinancieras_v') is-invalid @enderror" >
                            </div>    
                            <div class="col-2">
                                <input id="obligafinancieras" name="obligafinancieras" required onkeyup="calCostosExternos();" type="number"
                                 step=".01" placeholder="0.00" value="{{$project->obligafinancieras}}"
                                    class="form-control @error('obligafinancieras') is-invalid @enderror" >
                                @error('obligafinancieras')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>                          
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="rse">RSE</label>
                            </div >
                            <div class="col-3">
                                <input id="rse_v" name="rse_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->rse_v}}" class="form-control " >
                            </div>    
                            <div class="col-2">
                                <input id="rse" name="rse" required type="number" required onkeyup="calCostosExternos();" step=".01" 
                                placeholder="0.00" value="{{$project->rse}}"
                                    class="form-control @error('rse') is-invalid @enderror">
                                @error('rse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 

                        </div>      
                        
                        <hr> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="costosexternos"><b>NETO OPERACIONAL</b></label>
                            </div >
                            <div class="col-3">
                                <input id="costosexternos" name="costosexternos" type="text" placeholder="0.00"  readonly
                                       value="{{$project->costosexternos}}" class="form-control " >
                            </div>                 
                        </div>   

                        <hr> 
                        <div class="form-group row" style="background-color: #ccc;" >
                            <div class="col-12 text-center">
                                <label ><b>INVERSIONES</b></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4 text-center">
                                <label ><b>ITEM</b></label>
                            </div>
                            <div class="col-3 ">
                                <label ><b>VALOR SUBTOTAL $</b></label>
                            </div>
                            <div class="col-2 text-center">
                                <label ><b>%</b></label>
                            </div>
                        </div>                         
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="arqejecutivofirma">REINVERSION - IMPREVISTOS </label>
                            </div >
                            <div class="col-3">
                                <input id="arqejecutivofirma_v" name="arqejecutivofirma_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->arqejecutivofirma_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="arqejecutivofirma" name="arqejecutivofirma" required type="number" onkeyup="calCostosFijosGestora();"
                                 step=".01" placeholder="0.00" value="{{$project->arqejecutivofirma}}"
                                    class="form-control @error('arqejecutivofirma') is-invalid @enderror" >
                                @error('arqejecutivofirma')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div> 

                        <hr> 
                        <div class="form-group row" style="background-color: #ccc;" >
                            <div class="col-12 text-center">
                                <label ><b>COSTOS FIJOS LATTITUDE</b></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4 text-center">
                                <label ><b>ITEM</b></label>
                            </div>
                            <div class="col-3 ">
                                <label ><b>VALOR SUBTOTAL $</b></label>
                            </div>
                            <div class="col-2 text-center">
                                <label ><b>%</b></label>
                            </div>
                        </div>                         
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="nominafija">NOMINA FIJA</label>
                            </div >
                            <div class="col-3">
                                <input id="nominafija_v" name="nominafija_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->nominafija_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="nominafija" name="nominafija" type="number" required onkeyup="calCostosFijosGestora();" step=".01"
                                 placeholder="0.00" value="{{$project->nominafija}}"
                                    class="form-control @error('nominafija') is-invalid @enderror" >
                                @error('nominafija')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>                        
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="contratistalattitude">CONTRATISTA LATTITUDE</label>
                            </div >
                            <div class="col-3">
                                <input id="contratistalattitude_v" name="contratistalattitude_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->contratistalattitude_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="contratistalattitude" name="contratistalattitude" required type="number" onkeyup="calCostosFijosGestora();" step=".01"
                                 placeholder="0.00" value="{{$project->contratistalattitude}}"
                                    class="form-control @error('contratistalattitude') is-invalid @enderror" >
                                @error('contratistalattitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="subtotcostosfijos"><b>SUBTOTAL COSTOS FIJOS</b></label>
                            </div >
                            <div class="col-3">
                                <input id="subtotcostosfijos_v" name="subtotcostosfijos_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->subtotcostosfijos_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="subtotcostosfijos" name="subtotcostosfijos" type="text" readonly placeholder="0.00 %" 
                                value="{{$project->subtotcostosfijos}}"
                                    class="form-control" >
                            </div> 
                        </div> 
                        
                        <hr> 
                        <div class="form-group row" style="background-color: #ccc;" >
                            <div class="col-12 text-center" >
                                <label ><b>COSTOS FIJOS PLATAFORMA 401</b></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4 text-center">
                                <label ><b>ITEM</b></label>
                            </div>
                            <div class="col-3 ">
                                <label ><b>VALOR SUBTOTAL $</b></label>
                            </div>
                            <div class="col-2 text-center">
                                <label ><b>%</b></label>
                            </div>
                        </div>  
                        <!--                       
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="marcalattitude">MARCA LATTITUDE</label>
                            </div >
                            <div class="col-3">
                                <input id="marcalattitude_v" name="marcalattitude_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->marcalattitude_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="marcalattitude" name="marcalattitude" required type="number" onkeyup="calCostosFijos401();" step=".01"
                                 placeholder="0.00" value="{{$project->marcalattitude}}"
                                    class="form-control @error('marcalattitude') is-invalid @enderror" >
                                @error('marcalattitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div> 
                        -->                       
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="tecnologia">EQUIPOS, REDES, TECNOLOGIA</label>
                            </div >
                            <div class="col-3">
                                <input id="tecnologia_v" name="tecnologia_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->tecnologia_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="tecnologia" name="tecnologia" required type="number" onkeyup="calCostosFijos401();" step=".01" 
                                placeholder="0.00" value="{{$project->tecnologia}}"
                                    class="form-control @error('tecnologia') is-invalid @enderror" >
                                @error('tecnologia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="serviciospublicos">SERVICIOS PUBLICOS Y ADMINISTRACION</label>
                            </div >
                            <div class="col-3">
                                <input id="serviciospublicos_v" name="serviciospublicos_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->serviciospublicos_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="serviciospublicos" name="serviciospublicos" required type="number" onkeyup="calCostosFijos401();" step=".01" 
                                placeholder="0.00" value="{{$project->serviciospublicos}}"
                                    class="form-control @error('serviciospublicos') is-invalid @enderror" >
                                @error('serviciospublicos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="subtotcostosplataforma"><b>SUBTOTAL COSTOS PLATAFORMA</b></label>
                            </div >
                            <div class="col-3">
                                <input id="subtotcostosplataforma_v" name="subtotcostosplataforma_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->subtotcostosplataforma_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="subtotcostosplataforma" name="subtotcostosplataforma" type="text" readonly placeholder="0.00" 
                                value="{{$project->subtotcostosplataforma}}"
                                    class="form-control" >
                                </div> 
                        </div> 
                        <hr> 
                        <div class="form-group row" style="background-color: #ccc;" >
                            <div class="col-12 text-center">
                                <label ><b>RELACIONES CORPORATIVAS</b></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4 text-center">
                                <label ><b>ITEM</b></label>
                            </div>
                            <div class="col-3 ">
                                <label ><b>VALOR SUBTOTAL $</b></label>
                            </div>
                            <div class="col-2 text-center">
                                <label ><b>%</b></label>
                            </div>
                        </div>                         
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="recursoshumanos">RECURSOS HUMANOS</label>
                            </div >
                            <div class="col-3">
                                <input id="recursoshumanos_v" name="recursoshumanos_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->recursoshumanos_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="recursoshumanos" name="recursoshumanos" type="number" required onkeyup="calRelacionesCorp();" step=".01" placeholder="0.00" value="{{$project->recursoshumanos}}"
                                    class="form-control @error('recursoshumanos') is-invalid @enderror" >
                                @error('recursoshumanos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>                        
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="pryviaticos">PR Y VIATICOS</label>
                            </div >
                            <div class="col-3">
                                <input id="pryviaticos_v" name="pryviaticos_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->pryviaticos_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="pryviaticos" name="pryviaticos" type="number" required onkeyup="calRelacionesCorp();" step=".01" placeholder="0.00" value="{{$project->pryviaticos}}"
                                    class="form-control @error('pryviaticos') is-invalid @enderror" >
                                @error('pryviaticos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="comunicaciones">COMUNICACIONES</label>
                            </div >
                            <div class="col-3">
                                <input id="comunicaciones_v" name="comunicaciones_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->comunicaciones_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="comunicaciones" name="comunicaciones" type="number" required onkeyup="calRelacionesCorp();" step=".01" placeholder="0.00" value="{{$project->comunicaciones}}"
                                    class="form-control @error('comunicaciones') is-invalid @enderror" >
                                @error('comunicaciones')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="subtotrelacorporativas"><b>SUBTOTAL RELACIONES CORPORATIVAS</b></label>
                            </div >
                            <div class="col-3">
                                <input id="subtotrelacorporativas_v" name="subtotrelacorporativas_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->subtotrelacorporativas_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="subtotrelacorporativas" name="subtotrelacorporativas" type="text" readonly placeholder="0.00" value="{{$project->subtotrelacorporativas}}"
                                    class="form-control" >
                            </div> 
                        </div> 
                        <hr>
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="subtotnetogestora"><b>SUBTOTAL NETO GESTORA</b></label>
                            </div >
                            <div class="col-3">
                                <input id="subtotnetogestora_v" name="subtotnetogestora_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->subtotnetogestora_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="subtotnetogestora" name="subtotnetogestora" type="text" readonly placeholder="0.00" value="{{$project->subtotnetogestora}}"
                                    class="form-control" >
                            </div> 
                        </div> 

                        <hr>
                        <div class="form-group row" style="background-color: #ccc;" >
                            <div class="col-12 text-center">
                                <label ><b>NETO OPERACIONAL A EJECUTAR (participantes)</b></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="subtotnetoaejecutar"><b>SUBTOTAL NETO A EJECUTAR</b></label>
                            </div >
                            <div class="col-3">
                                <input id="subtotnetoaejecutar_v" name="subtotnetoaejecutar_v" type="text" placeholder="0.00"  readonly
                                       value="{{$project->subtotnetoaejecutar_v}}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="subtotnetoaejecutar" name="subtotnetoaejecutar" type="text" readonly placeholder="0.00" value="{{$project->subtotnetoaejecutar}}"
                                    class="form-control" >
                            </div> 
                        </div> 

                        <hr>
                        <div class="form-group row">
                            <div class="col-3 text-center">
                                <label ><b>ITEM</b></label>
                            </div>
                            <div class="col-1 text-center">
                                <label ><b>PART $</b></label>
                            </div>
                            <div class="col-1 text-center">
                                <label ><b>PART %</b></label>
                            </div>
                            <div class="col-1 text-center">
                                <label ><b>Fase 1 %</b></label>
                            </div>
                            <div class="col-1 text-center">
                                <label ><b>Fase 2 %</b></label>
                            </div>
                            <div class="col-1 text-center">
                                <label ><b>Fase 3 %</b></label>
                            </div>
                            <div class="col-1 text-center">
                                <label title="Total Fases %"><b>Tot Fases %</b></label>
                            </div>
                            <div class="col-1 text-center">
                                <label title="Participación Final %"><b>P Final %</b></label>
                            </div>
                            <div class="col-1 text-center">
                                <label title="Participación Final $"><b>P Final $</b></label>
                            </div>


                            @if ($projectasociados->count()>0)
                            <div class="col-1">
                                <button class="btn btn-primary btn-block" onclick="addAsociadoEdit({{$projectasociados->count()}})" type="button"> + </button>
                            </div>     
                            @endif
                            @if ($projectasociados->count()==0)
                            <div class="col-1">
                                <button class="btn btn-primary btn-block" onclick="addAsociadoEdit(1)" type="button"> + </button>
                            </div>     
                            @endif
                        </div>     
                        <div id="contenedor_asociados">
                            @if ($projectasociados->count()>0)
                            @foreach ($projectasociados as $key => $value0)
                            @if($value0->idassociate!=999)
                            <div id="div_asociado_{{$key}}" class="form-group row" >  
                                <div class="col-3">
                                    <select id="sel_asociado_{{$key}}"  name="sel_asociado_{{$key}}" class="form-control" >
                                        @foreach ($asociados as $keyp => $value)
                                            <option value="{{ $value->id}}" {{ ($value->id == $value0->idassociate) ? 'selected' : '' }} >
                                                {{ $value->first_name }} {{ $value->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-1">
                                    <input id="asociado_v_{{$key}}" name="asociado_v_{{$key}}" readonly required type="text" 
                                    placeholder="0" value="{{$value0->valor}}"   class="form-control text-right" >
                                </div>     
                                <div class="col-1">
                                    <input id="asociado_{{$key}}" name="asociado_{{$key}}" onkeyup="calTotAsociados()" required type="number" 
                                    placeholder="0" value="{{$value0->porcentaje}}" step="0.01"  class="form-control text-center" {{ ($value0->fase1ok == 1 || $value0->fase2ok == 1|| $value0->fase3ok == 1) ? 'readonly' : '' }} >
                                </div>  
                                <div class="col-1">
                                    <input  id="fase1_{{$key}}" name="fase1_{{$key}}" onkeyup="valFases(1,{{$key}})" required type="number"  step="0.01" 
                                    placeholder="0" value="{{$value0->fase1}}"  class="form-control text-center" {{ ($value0->fase1ok == 1) ? 'readonly' : '' }} >
                                    <input title="Click para marcar como pagado!!!" type="checkbox" onclick="valFaseOk(1,{{$key}})" id="fase1ok_{{$key}}" name="fase1ok_{{$key}}" value="1" {{ ($value0->fase1ok == 1) ? 'checked' : '' }}>
                                </div>  
                                <div class="col-1">
                                    <input id="fase2_{{$key}}" name="fase2_{{$key}}" onkeyup="valFases(2,{{$key}})" required type="number" step="0.01" 
                                    placeholder="0" value="{{$value0->fase2}}"  class="form-control text-center" {{ ($value0->fase2ok == 1) ? 'readonly' : '' }} >
                                    <input title="Click para marcar como pagado!!!" type="checkbox" onclick="valFaseOk(2,{{$key}})" id="fase2ok_{{$key}}" name="fase2ok_{{$key}}" value="1" {{ ($value0->fase2ok == 1) ? 'checked' : '' }}>
                                </div>  
                                <div class="col-1">
                                    <input id="fase3_{{$key}}" name="fase3_{{$key}}" onkeyup="valFases(3,{{$key}})" required type="number" step="0.01"
                                     placeholder="0" value="{{$value0->fase3}}"  class="form-control text-center" {{ ($value0->fase3ok == 1) ? 'readonly' : '' }}>
                                     <input title="Click para marcar como pagado!!!" type="checkbox" onclick="valFaseOk(3,{{$key}})" id="fase3ok_{{$key}}" name="fase3ok_{{$key}}" value="1" {{ ($value0->fase3ok == 1) ? 'checked' : '' }}>
                                </div>  
                                <div class="col-1">
                                    <input id="totfases_{{$key}}" name="totfases_{{$key}}"  required type="text" readonly placeholder="0.00%" 
                                      class="form-control text-center" value="{{$value0->totfases}}">
                                </div>  
                                <div class="col-1">
                                    <input id="partfinal_p_{{$key}}" name="partfinal_p_{{$key}}"  required type="text" readonly placeholder="0.00%" 
                                      class="form-control text-center" value="{{$value0->partfinal_p}}">
                                </div>  
                                <div class="col-1">
                                    <input id="partfinal_{{$key}}" name="partfinal_{{$key}}"  required type="text" readonly placeholder="0.00" 
                                      class="form-control text-right" value="{{$value0->partfinal}}">
                                </div>  


                                @if ($key == 0)  
                                <div class="col-1">
                                    <button class="btn btn-danger btn-block d-none" type="button" onclick="delAsociado({{$key}})"> <i class="far fa-trash-alt"></i> </button>
                                </div>     
                                @endif             
                                @if ($key != 0)  
                                <div class="col-1">
                                    <button class="btn btn-danger btn-block" type="button" onclick="delAsociado({{$key}})"> <i class="far fa-trash-alt"></i> </button>
                                </div>     
                                @endif      

                            </div>
                            @endif
                            @endforeach
                            @endif

                            @if ($projectasociados->count()==0)
                            <div id="div_asociado_0" class="form-group row" >  
                                <div class="col-3">
                                    <select id="sel_asociado_0"  name="sel_asociado_0" class="form-control" >
                                        @foreach ($asociados as $key => $value)
                                            <option value="{{ $value->id }}" >
                                                {{ $value->first_name }} {{ $value->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-1">
                                    <input id="asociado_v_0" name="asociado_v_0" readonly required type="text" placeholder="0" value="0"   class="form-control " >
                                </div>     
                                <div class="col-1">
                                    <input id="asociado_0" name="asociado_0" onkeyup="calTotAsociados()" required type="number" placeholder="0" value="0" step="0.01"  class="form-control " >
                                </div>  
                                <div class="col-1">
                                    <input id="fase1_0" name="fase1_0" onkeyup="valFases(1,0)" required type="number"  step="0.01" placeholder="0" value="0"  class="form-control " >
                                    
                                </div>  
                                <div class="col-1">
                                    <input id="fase2_0" name="fase2_0" onkeyup="valFases(2,0)" required type="number" step="0.01" placeholder="0" value="0"  class="form-control " >
                                </div>  
                                <div class="col-1">
                                    <input id="fase3_0" name="fase3_0" onkeyup="valFases(2,0)" required type="number" step="0.01" placeholder="0" value="0"  class="form-control " >
                                </div>  

                                <div class="col-1">
                                    <button class="btn btn-danger btn-block d-none" type="button" onclick="delAsociado(0)"> <i class="far fa-trash-alt"></i> </button>
                                </div>                       
                            </div>
                            @endif   
                        </div> 

                        @if ($projectasociados->count()>0)
                        @foreach ($projectasociados as $key => $value0)
                        @if($value0->idassociate==999)
                        <div id="div_bolsaremanente" class="form-group row" >  
                            <div class="col-3">
                                <label for="bolsaremanente">BOLSA REMANENTE</label>
                            </div>
                            <div class="col-1">
                                <input id="bolsaremanente" name="bolsaremanente" readonly required  type="text" placeholder="0"   
                                class="form-control text-right" value="{{$value0->valor}}" >
                            </div>     
                            <div class="col-1">
                                <input id="bolsaremanente_p" name="bolsaremanente_p" readonly  required type="text" placeholder="0"   
                                class="form-control text-center" value="{{$value0->porcentaje}} %"  >
                            </div>   
                            <div class="col-4"></div>
                            <div class="col-1">
                                <input id="partfinal_p_999" name="partfinal_p_999"  required type="text" readonly placeholder="0.00%" 
                                  class="form-control text-center" value="{{$value0->partfinal_p}}">
                            </div>  
                            <div class="col-1">
                                <input id="partfinal_999" name="partfinal_999"  required type="text" readonly placeholder="0.00" 
                                  class="form-control text-right" value="{{$value0->partfinal}}">
                            </div>  

                        </div>   
                        @endif
                        @endforeach
                        @endif
                        @if ($projectasociados->count()<=1)
                        <div id="div_bolsaremanente" class="form-group row" >  
                            <div class="col-4">
                                <label for="bolsaremanente">BOLSA REMANENTE</label>
                            </div>
                            <div class="col-2">
                                <input id="bolsaremanente" name="bolsaremanente" readonly required  type="text" placeholder="0"   class="form-control " >
                            </div>     
                            <div class="col-2">
                                <input id="bolsaremanente_p" name="bolsaremanente_p" readonly  required type="text" placeholder="0"   class="form-control " >
                            </div>     
                            <div class="col-4"></div>
                            <div class="col-1">
                                <input id="partfinal_p_999" name="partfinal_p_999"  required type="text" readonly placeholder="0.00%" 
                                  class="form-control text-center" >
                            </div>  
                            <div class="col-1">
                                <input id="partfinal_999" name="partfinal_999"  required type="text" readonly placeholder="0.00" 
                                  class="form-control text-right" >
                            </div>  


                        </div>                         
                        @endif


                        <hr>
                        <div id="div_bolsaremanente" class="form-group row" >  
                            <div class="col-3">
                                <label for="subtotoperaejecutar"><b>SUBTOTAL OPERACIONAL A EJECUTAR</b></label>
                            </div>
                            <div class="col-1">
                                <input id="subtotoperaejecutar" name="subtotoperaejecutar" value="{{$project->subtotoperaejecutar}}" readonly   
                                type="text" placeholder="0"   class="form-control text-right" >
                            </div>     
                            <div class="col-1">
                                <input id="subtotoperaejecutar_p" name="subtotoperaejecutar_p" value="{{$project->subtotoperaejecutar_p}}" readonly  
                                type="text" placeholder="0"   class="form-control text-center" >
                            </div>                
                        </div>   
                        <hr><hr>
                        <div id="div_total" class="form-group row" >  
                            <div class="col-4">
                                <label for="total"><b>TOTAL</b></label>
                            </div>
                            <div class="col-3">
                                <input id="total" name="total" readonly  type="text" placeholder="0"  value="{{$project->total}}"  class="form-control " >
                            </div>     
                            <div class="col-2">
                                <input id="total_p" name="total_p" readonly  type="text" placeholder="0" value="{{$project->total_p}}"  class="form-control " >
                            </div>                
                        </div>   
                        <hr>
                        

                        
			            <hr>
	                    <div class="row">
    						<div class="col-2">
    							<a role="button"
    								class="btn btn-secondary btn-block"
    								href="{{ route('projects.index') }}"
    							>
									<i class="fas fa-undo-alt"></i> Regresar
								</a>
    						</div>
    						<div class="col-2">
    							<button class="btn btn-primary btn-block" type="button" onclick="validar_editarproject()">
									<i class="far fa-save"></i> Actualizar
								</button>
    						</div>
    					</div>
			        </form>
                </div>
            </div>
        </div>
    </div>
@endsection