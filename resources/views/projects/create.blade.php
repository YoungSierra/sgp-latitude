@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('projects.create'))

@section('content')
	<div class="row">
		<div class="col">
			<h1>Crear Proyecto</h1>
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
        <div class="col-8">
            <div class="card shadow-sm">
                <!--            
                <div class="card-header">
                    <i class="fas fa-plus-circle"></i> Nuevo
                </div> 
                -->
                <div class="card-body">
                	<form id="crearproject" method="POST" action="{{ route('projects.store') }}">
                		@method('POST')
                        @csrf
	                    <div class="form-group">
	                        <label for="name">Nombre</label>
	                        <input
		                        id="name"
		                        name="name"
                                required
		                        type="text"
		                        placeholder="Nombre del proyecto..."
		                        value="{{ old('name') }}"
		                        class="form-control @error('name') is-invalid @enderror"
	                        >
	                        @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
	                    </div>
	                	<div class="form-group">
	                        <label for="description">Descripción</label>
	                        <textarea
	                        	id="description"
		                        name="description"
                                required
		                        rows="1"
		                        placeholder="Descripción breve del proyecto..."
		                        class="form-control @error('description') is-invalid @enderror"
	                        >{{ old('description') }}</textarea>
	                        @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
	                    </div>

	                    <div class="form-group row">
                            <div class="col-4">
                                <label for="valor">Valor contrato ($)</label>
                                <input
                                    id="valor"
                                    name="valor"
                                    type="text"
                                    placeholder="0.00"
                                    readonly required
                                    value="{{ old('valor') }}"
                                    class="form-control @error('valor') is-invalid @enderror"
                                >
                                @error('valor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-4">

                                <label for="tiempo">Tiempo contrato (meses)</label>
                                <input
                                    id="tiempo"
                                    name="tiempo"
                                    type="number"
                                    required
                                    placeholder="0"
                                    value="{{ old('tiempo') }}"
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
                                        <option value="{{ $key }}" {{ (old('status') == $key) ? 'selected' : '' }}>
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
                                    value="{{ old('valorbruto') }}"
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
                                    value="{{ old('iva') }}"
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
                                    value="{{ old('iva_v') }}"
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
                                    value="{{ old('retfuente') }}"
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
                                    value="{{ old('retfuente_v') }}"
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
                                    value="{{ old('ica') }}"
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
                                    value="{{ old('ica_v') }}"
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
                                    value="{{ old('retiva') }}"
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
                                    value="{{ old('retiva_v') }}"
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
                                    value="{{ old('estampillas') }}"
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
                                    value="{{ old('estampillas_v') }}"
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
                                    value="{{ old('cree') }}"
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
                                    value="{{ old('cree_v') }}"
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
                                    value="{{ old('ica_t') }}"
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
                                    value="{{ old('ica_tv') }}"
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
                                    value="{{ old('retica') }}"
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
                                    value="{{ old('retica_v') }}"
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
                                    value="{{ old('netopagar') }}"
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
                                    value="{{ old('totimpuesto') }}"
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
                                    value="{{ old('neto') }}"
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
                                       value="{{ old('valorbruto_c') }}" class="form-control " >
                            </div>                         
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="impuestos">IMPUESTOS</label>
                            </div >
                            <div class="col-3">
                                <input id="impuestos" name="impuestos" type="text" placeholder="0.00"  readonly
                                       value="{{ old('impuestos') }}" class="form-control " >
                            </div>                         
                        </div>  

                        <hr> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="totpolizas">PÓLIZAS</label>
                            </div >
                            <div class="col-3">
                                <input id="totpolizas" name="totpolizas" type="text" placeholder="0.00" value="0"  readonly
                                       value="{{ old('totpolizas') }}" class="form-control " >
                            </div>  
                            <div class="col-1">
                                <button class="btn btn-primary btn-block" onclick="addPoliza()" type="button"> + </button>
                            </div>     
                        </div>
                        
                        <div id="contenedor_polizas">
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
                        </div>   


                        <hr> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="totcontratistas">CONTRATISTAS</label>
                            </div >
                            <div class="col-3">
                                <input id="totcontratistas" name="totcontratistas" type="text" placeholder="0.00" value="0" readonly
                                       value="{{ old('totcontratistas') }}" class="form-control @error('totcontratistas') is-invalid @enderror" >
                                @error('valor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>  
                            <div class="col-1">
                                <button class="btn btn-primary btn-block" onclick="addContratista()" type="button"> + </button>
                            </div>     
                        </div>
                        
                        <div id="contenedor_contratistas">
                            <div id="contratista_0" class="form-group row" >  
                                <div class="col-4">
                                    <select id="sel_contratista_0"  name="sel_contratista_0" class="form-control" >
                                        @foreach ($contratistas as $key => $value)
                                            <option value="{{ $value->id }}" >
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
                        </div>   


                        <hr> 
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="subtotal"><b>SUBTOTAL</b></label>
                            </div >
                            <div class="col-3">
                                <input id="subtotal" name="subtotal" type="text" placeholder="0.00"  readonly
                                       value="{{ old('subtotal') }}" class="form-control " >
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
                                       value="{{ old('comisionreferido_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="comisionreferido" name="comisionreferido" required onkeyup="calCostosExternos();" type="number" step=".01" placeholder="0.00" value="{{ old('comisionreferido') }}"
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
                                       value="{{ old('imprevistos_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="imprevistos" name="imprevistos" required onkeyup="calCostosExternos();" type="number" step=".01" placeholder="0.00" value="{{ old('imprevistos') }}"
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
                                       value="{{ old('apalancamiento_v') }}" class="form-control " >
                            </div>    
                            <div class="col-2">
                                <input id="apalancamiento" name="apalancamiento" required onkeyup="calCostosExternos();" type="number" step=".01" placeholder="0.00" value="{{ old('apalancamiento') }}"
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
                                       value="{{ old('obligafinancieras_v') }}" class="form-control @error('obligafinancieras_v') is-invalid @enderror" >
                            </div>    
                            <div class="col-2">
                                <input id="obligafinancieras" name="obligafinancieras" required onkeyup="calCostosExternos();" type="number" step=".01" placeholder="0.00" value="{{ old('obligafinancieras') }}"
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
                                       value="{{ old('rse_v') }}" class="form-control " >
                            </div>    
                            <div class="col-2">
                                <input id="rse" name="rse" required type="number" required onkeyup="calCostosExternos();" step=".01"
                                 placeholder="0.00 " value="{{ old('rse') }}" class="form-control @error('rse') is-invalid @enderror" > 
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
                                       value="{{ old('costosexternos') }}" class="form-control " >
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
                                <label for="arqejecutivofirma">REINVERSION - IMPREVISTO</label>
                            </div >
                            <div class="col-3">
                                <input id="arqejecutivofirma_v" name="arqejecutivofirma_v" type="text" placeholder="0.00"  readonly
                                       value="{{ old('arqejecutivofirma_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="arqejecutivofirma" name="arqejecutivofirma" required type="number" onkeyup="calCostosFijosGestora();" step=".01" placeholder="0.00" value="{{ old('arqejecutivofirma') }}"
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
                                       value="{{ old('nominafija_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="nominafija" name="nominafija" type="number" required onkeyup="calCostosFijosGestora();" step=".01" placeholder="0.00" value="{{ old('nominafija') }}"
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
                                       value="{{ old('contratistalattitude_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="contratistalattitude" name="contratistalattitude" required type="number" onkeyup="calCostosFijosGestora();" step=".01" placeholder="0.00" value="{{ old('contratistalattitude') }}"
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
                                       value="{{ old('subtotcostosfijos_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="subtotcostosfijos" name="subtotcostosfijos" type="text" readonly placeholder="0.00 %" value="{{ old('subtotcostosfijos') }}"
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
                                       value="{{ old('marcalattitude_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="marcalattitude" name="marcalattitude" required type="number" onkeyup="calCostosFijos401();" step=".01" placeholder="0.00" value="{{ old('marcalattitude') }}"
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
                                       value="{{ old('tecnologia_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="tecnologia" name="tecnologia" required type="number" onkeyup="calCostosFijos401();" step=".01" placeholder="0.00" value="{{ old('tecnologia') }}"
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
                                       value="{{ old('serviciospublicos_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="serviciospublicos" name="serviciospublicos" required type="number" onkeyup="calCostosFijos401();" step=".01" placeholder="0.00" value="{{ old('serviciospublicos') }}"
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
                                       value="{{ old('subtotcostosplataforma_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="subtotcostosplataforma" name="subtotcostosplataforma" type="text" readonly placeholder="0.00" value="{{ old('subtotcostosplataforma') }}"
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
                                       value="{{ old('recursoshumanos_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="recursoshumanos" name="recursoshumanos" type="number" required onkeyup="calRelacionesCorp();" step=".01" placeholder="0.00" value="{{ old('recursoshumanos') }}"
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
                                       value="{{ old('pryviaticos_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="pryviaticos" name="pryviaticos" type="number" required onkeyup="calRelacionesCorp();" step=".01" placeholder="0.00" value="{{ old('pryviaticos') }}"
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
                                       value="{{ old('comunicaciones_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="comunicaciones" name="comunicaciones" type="number" required onkeyup="calRelacionesCorp();" step=".01" placeholder="0.00" value="{{ old('comunicaciones') }}"
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
                                       value="{{ old('subtotrelacorporativas_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="subtotrelacorporativas" name="subtotrelacorporativas" type="text" readonly placeholder="0.00" value="{{ old('subtotrelacorporativas') }}"
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
                                       value="{{ old('subtotnetogestora_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="subtotnetogestora" name="subtotnetogestora" type="text" readonly placeholder="0.00" value="{{ old('subtotnetogestora') }}"
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
                                       value="{{ old('subtotnetoaejecutar_v') }}" class="form-control" >
                            </div>    
                            <div class="col-2">
                                <input id="subtotnetoaejecutar" name="subtotnetoaejecutar" type="text" readonly placeholder="0.00" value="{{ old('subtotnetoaejecutar') }}"
                                    class="form-control" >
                            </div> 
                        </div> 
                        <hr>
                        <div class="form-group row">
                            <div class="col-4 text-center">
                                <label ><b>ITEM</b></label>
                            </div>
                            <div class="col-2">
                                <label ><b>VALOR SUBTOTAL $</b></label>
                            </div>
                            <div class="col-1 text-center">
                                <label ><b>%</b></label>
                            </div>
                            <div class="col-1">
                                <label ><b>Fase 1</b></label>
                            </div>
                            <div class="col-1">
                                <label ><b>Fase 2</b></label>
                            </div>
                            <div class="col-1">
                                <label ><b>Fase 3</b></label>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-primary btn-block" onclick="addAsociado()" type="button"> + </button>
                            </div>     

                        </div>     
                        <div id="contenedor_asociados">
                            <div id="div_asociado_0" class="form-group row" >  
                                <div class="col-4">
                                    <select id="sel_asociado_0"  name="sel_asociado_0" class="form-control" >
                                        @foreach ($asociados as $key => $value)
                                            <option value="{{ $value->id }}" >
                                                {{ $value->first_name }} {{ $value->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
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
                                    <input id="fase3_0" name="fase3_0" onkeyup="valFases(3,0)" required type="number" step="0.01" placeholder="0" value="0"  class="form-control " >
                                </div>  
                                
                                

                                <div class="col-1">
                                    <button class="btn btn-danger btn-block d-none" type="button" onclick="delAsociado(0)"> <i class="far fa-trash-alt"></i> </button>
                                </div>     
                    
                            </div>   
                        </div>  
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
                        </div>   
                        <hr>
                        <div id="div_bolsaremanente" class="form-group row" >  
                            <div class="col-4">
                                <label for="subtotoperaejecutar"><b>SUBTOTAL OPERACIONAL A EJECUTAR</b></label>
                            </div>
                            <div class="col-2">
                                <input id="subtotoperaejecutar" name="subtotoperaejecutar" readonly   type="text" placeholder="0"   class="form-control " >
                            </div>     
                            <div class="col-2">
                                <input id="subtotoperaejecutar_p" name="subtotoperaejecutar_p" readonly  type="text" placeholder="0"   class="form-control " >
                            </div>                
                        </div>   
                        <hr><hr>
                        <div id="div_total" class="form-group row" >  
                            <div class="col-4">
                                <label for="total"><b>TOTAL</b></label>
                            </div>
                            <div class="col-2">
                                <input id="total" name="total" readonly  type="text" placeholder="0"   class="form-control " >
                            </div>     
                            <div class="col-2">
                                <input id="total_p" name="total_p" readonly  type="text" placeholder="0"   class="form-control " >
                            </div>                
                        </div>   
                        <hr>


                        <hr>
                        <!-- botones -->
                        <div class="form-group row">
                            <div class="col-4"></div>
    						<div class="col-2">
    							<a role="button"
    								class="btn btn-secondary btn-block"
    								href="{{ route('projects.index') }}"
    							>
									<i class="fas fa-undo-alt"></i> Regresar
								</a>
    						</div>
    						<div class="col-2">
    							<button class="btn btn-primary btn-block" type="button" onclick="validar_crearproject()">
									<i class="far fa-save"></i> Guardar
								</button>
    						</div>
    					</div>

			        </form>
                </div>
            </div>
        </div>
    </div>
@endsection