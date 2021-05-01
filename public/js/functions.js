//Seccion para vista de creacion de proyectos 
let valbruto_v = 0, v_cree = 0, v_ica_t = 0, v_retica = 0, v_neto = 0, v_totimpuesto = 0,totcontratistas = 0, totpolizas = 0;
let v_iva = 0, v_retfuente = 0, v_ica = 0, v_retiva = 0, v_netopagar = 0, v_estampillas = 0, subtotal=0;
let v_comisionreferido = 0, v_imprevistos = 0, v_apalancamiento = 0, v_obligafinancieras = 0, v_rse = 0;
let costosexternos = 0;

setTimeout(() => {
    if(window.location.pathname.includes('edit') && window.location.pathname.includes('projects')){
        let valorBruto = document.getElementById("valorbruto").value;
        if(valorBruto){
            calcularImpuestos();
            calTotPolizas();
            calTotContratistas();
        }   
    }
}, 2000);

function calcularImpuestos(){
    let valorBruto = document.getElementById("valorbruto");
    let iva = document.getElementById("iva");
    let retfuente = document.getElementById("retfuente");
    let ica = document.getElementById("ica");
    let retiva = document.getElementById("retiva");
    let estampillas = document.getElementById("estampillas");
    //let v_iva = 0, v_retfuente = 0, v_ica = 0, v_retiva = 0, v_netopagar = 0, v_estampillas = 0;

    //Impuestos de terceros
    let cree = document.getElementById("cree");
    let ica_t = document.getElementById("ica_t");
    let retica = document.getElementById("retica");
    //let v_cree = 0, v_ica_t = 0, v_retica = 0, v_neto = 0, v_totimpuesto = 0;

    if(valorBruto.value && iva.value){
        v_iva = Math.round(valorBruto.value * (iva.value/100));
        document.getElementById('iva_v').value = new Number(v_iva).toLocaleString("es-CO");
    }
    if(valorBruto.value && retfuente.value){
        v_retfuente = Math.round(valorBruto.value * (retfuente.value/100));
        document.getElementById('retfuente_v').value = new Number(-1 * v_retfuente ).toLocaleString("es-CO");
    }
    if(valorBruto.value && ica.value){
        v_ica = Math.round(valorBruto.value * (ica.value/100));
        document.getElementById('ica_v').value = new Number(-1 * v_ica ).toLocaleString("es-CO");
    }
    if(valorBruto.value && iva.value && retiva.value){
        v_retiva = Math.round(valorBruto.value * (iva.value/100) * (retiva.value/100));
        document.getElementById('retiva_v').value = new Number(-1 * v_retiva).toLocaleString("es-CO");
    }
    if(valorBruto.value && estampillas.value){
        v_estampillas = Math.round(valorBruto.value * (estampillas.value/100));
        document.getElementById('estampillas_v').value = new Number(-1 * v_estampillas ).toLocaleString("es-CO");
    }

    if(!valorBruto.value ){
        document.getElementById('iva_v').value = 0 ;
        document.getElementById('retfuente_v').value = 0 ;
        document.getElementById('ica_v').value = 0 ;
        document.getElementById('valor').value = 0 ;
        document.getElementById('retiva_v').value = 0 ;
        document.getElementById('estampillas_v').value = 0 ;
        document.getElementById('cree_v').value = 0 ;
        document.getElementById('ica_tv').value = 0 ;
        document.getElementById('retica').value = 0 ;
        document.getElementById('netopagar').value = 0 ;
        document.getElementById('neto').value = 0 ;
        document.getElementById('totimpuesto').value = 0 ;
        document.getElementById('impuestos').value = 0 ;
        document.getElementById('valorbruto').value = 0 ;
    }
    if(!iva.value ){
        document.getElementById('iva_v').value = 0 ;
        v_iva=0;
    }
    if(!retfuente.value ){
        document.getElementById('retfuente_v').value = 0 ;
        v_retfuente=0;
    }
    if(!ica.value ){
        document.getElementById('ica_v').value = 0 ;
        v_ica=0;
    }
    if(!retiva.value ){
        document.getElementById('retiva_v').value = 0 ;
        v_retiva=0;
    }
    if(!estampillas.value ){
        document.getElementById('estampillas_v').value = 0 ;
        v_estampillas=0;
    }


    if(valorBruto.value ){
        let iva = document.getElementById("iva");
        let v = Math.round(valorBruto.value)  ; 
        if(iva.value ){  v = Math.round(valorBruto.value) +  Math.round(valorBruto.value * (iva.value/100) ) ; }
        document.getElementById('valor').value = new Number(v).toLocaleString("es-CO");
        
        v_netopagar =  Math.round(v) - Math.round(v_retfuente) - Math.round(v_ica) - Math.round(v_retiva) - Math.round(v_estampillas) ;
        document.getElementById('netopagar').value = new Number(v_netopagar).toLocaleString("es-CO");

        document.getElementById('valorbruto_c').value = new Number(v).toLocaleString("es-CO");
        valbruto_v = v;
    }


    if(!cree.value ){
        document.getElementById('cree_v').value = 0 ;
        v_cree=0;
    }
    if(!ica_t.value ){
        document.getElementById('ica_tv').value = 0 ;
        v_ica_t=0;
    }
    if(!retica.value ){
        document.getElementById('retica_v').value = 0 ;
        v_retica=0;
    }


    if(valorBruto.value && cree.value){
        v_cree = Math.round(valorBruto.value * (cree.value/100))
        document.getElementById('cree_v').value = new Number(-1 * v_cree ).toLocaleString("es-CO");
    }
    if(valorBruto.value && ica_t.value){
        v_ica_t = Math.round(valorBruto.value * (ica_t.value/1000))
        document.getElementById('ica_tv').value = new Number(-1 * v_ica_t).toLocaleString("es-CO");
    }

    if(valorBruto.value && ica_t.value && retica.value){
        v_retica = Math.round(valorBruto.value * (ica_t.value/1000) * (retica.value/100))
        document.getElementById('retica_v').value = new Number(-1 * v_retica).toLocaleString("es-CO");
    }

    v_neto = Math.round( v_netopagar - v_iva - v_cree - v_ica_t - v_retica );
    document.getElementById('neto').value = new Number(v_neto).toLocaleString("es-CO");

    v_totimpuesto = Math.round( (v_iva - v_retiva) + v_retfuente + v_ica + v_retiva + v_cree + v_ica_t + v_retica);
    document.getElementById('totimpuesto').value = new Number(v_totimpuesto).toLocaleString("es-CO");
    document.getElementById('impuestos').value = new Number(v_totimpuesto).toLocaleString("es-CO");

    calcularSubtotal()

}


/// Manejo de polizas
let contadorPolizas = 0;
function addPoliza(){

    contadorPolizas++;
    if (contadorPolizas>19) {
        alert("No se pueden instertar más polizas.");
        return;
    }
    var original =  document.getElementById("poliza_0");
    var nuevo = original.cloneNode(true);
    nuevo.id =   "poliza_"+contadorPolizas    ;
    nuevo.firstChild.firstChild.id = "sel_poliza_" + contadorPolizas;
    nuevo.firstChild.firstChild.name = "sel_poliza_" + contadorPolizas;
    nuevo.childNodes[2].firstChild.id =  "poliza_v_" + contadorPolizas;
    nuevo.childNodes[2].firstChild.name =  "poliza_v_" + contadorPolizas;
    nuevo.childNodes[2].firstChild.value =  "0";
    nuevo.lastChild.lastChild.setAttribute("onclick", "delPoliza(" + contadorPolizas + ")");
    nuevo.lastChild.lastChild.setAttribute("class", "btn btn-danger btn-block");
    
    destino = document.getElementById("contenedor_polizas");
    destino.appendChild(nuevo);

}

function delPoliza(id){
    //console.log(id);
    if(id == 0){
        alert("No se puede eliminar este elemento.");
    }else{
       if (confirm("Realmente quiere quitar esta poliza?")){
             $("#poliza_" + id).remove();     
       }
    }
    calTotPolizas()
}


function calTotPolizas(){
    totpolizas = 0;
    for (var i = 0; i <= 19; i++) {
        let poliza_v = document.getElementById("poliza_v_"+i);
        if (poliza_v){
            if (poliza_v.value){ totpolizas = totpolizas + Math.round(poliza_v.value)   }   
        }
    }
    document.getElementById('totpolizas').value = new Number(totpolizas).toLocaleString("es-CO");
    calcularSubtotal()
}

/// Manejo de contratistas
let contadorContratistas = 0;
function addContratista(){

    contadorContratistas++;
    if (contadorContratistas>19) {
        alert("No se pueden instertar más contratistas.");
        return;
    }
    var original =  document.getElementById("contratista_0");
    var nuevo = original.cloneNode(true);
    nuevo.id =   "contratista_"+contadorContratistas    ;
    nuevo.firstChild.firstChild.id = "sel_contratista_" + contadorContratistas;
    nuevo.firstChild.firstChild.name = "sel_contratista_" + contadorContratistas;
    nuevo.childNodes[2].firstChild.id =  "contratista_v_" + contadorContratistas;
    nuevo.childNodes[2].firstChild.name =  "contratista_v_" + contadorContratistas;
    nuevo.childNodes[2].firstChild.value =  "0";
    nuevo.lastChild.lastChild.setAttribute("onclick", "delContratista(" + contadorContratistas + ")");
    nuevo.lastChild.lastChild.setAttribute("class", "btn btn-danger btn-block");
    
    destino = document.getElementById("contenedor_contratistas");
    destino.appendChild(nuevo);

}

function delContratista(id){
    //console.log(id);
    if(id == 0){
        alert("No se puede eliminar este elemento.");
    }else{
       if (confirm("Realmente quiere quitar este contratista?")){
             $("#contratista_" + id).remove();     
       }
    }
    calTotContratistas()
}

function calTotContratistas(){
    totcontratistas = 0
    for (var i = 0; i <= 19; i++) {
        let contratista_v = document.getElementById("contratista_v_"+i);
        if (contratista_v){
            if (contratista_v.value){ totcontratistas = totcontratistas + Math.round(contratista_v.value) }
        }else{
            totcontratistas = totcontratistas + Math.round(0)  
        }
    }
    document.getElementById('totcontratistas').value = new Number(totcontratistas).toLocaleString("es-CO");
    calcularSubtotal()
}

function calcularSubtotal(){
    subtotal = valbruto_v - v_totimpuesto - totpolizas - totcontratistas ;
    document.getElementById('subtotal').value = new Number(subtotal).toLocaleString("es-CO");

    calCostosExternos();
}


//Quitar desplazador mouse en inputs number
document.addEventListener("wheel", function(event){
    if(document.activeElement.type === "number"){
        document.activeElement.blur();
    }
});


function calCostosExternos(){

    let comisionreferido = document.getElementById("comisionreferido");
    let imprevistos = document.getElementById("imprevistos");
    let apalancamiento = document.getElementById("apalancamiento");
    let obligafinancieras = document.getElementById("obligafinancieras");
    let rse = document.getElementById("rse");

    if(!comisionreferido.value ){
        document.getElementById('comisionreferido_v').value = 0 ;
        v_comisionreferido=0;
    }
    if(!imprevistos.value ){
        document.getElementById('imprevistos_v').value = 0 ;
        v_imprevistos=0;
    }
    if(!apalancamiento.value ){
        document.getElementById('apalancamiento_v').value = 0 ;
        v_apalancamiento=0;
    }
    if(!obligafinancieras.value ){
        document.getElementById('obligafinancieras_v').value = 0 ;
        v_obligafinancieras=0;
    }
    if(!rse.value ){
        document.getElementById('rse_v').value = 0 ;
        v_rse=0;
    }

    if(subtotal && comisionreferido.value){
        v_comisionreferido = Math.round(subtotal * (comisionreferido.value/100))
        document.getElementById('comisionreferido_v').value = new Number(v_comisionreferido ).toLocaleString("es-CO");
    }
    if(subtotal && imprevistos.value){
        v_imprevistos = Math.round(subtotal * (imprevistos.value/100))
        document.getElementById('imprevistos_v').value = new Number(v_imprevistos ).toLocaleString("es-CO");
    }
    if(subtotal && apalancamiento.value){
        v_apalancamiento = Math.round(subtotal * (apalancamiento.value/100))
        document.getElementById('apalancamiento_v').value = new Number(v_apalancamiento ).toLocaleString("es-CO");
    }
    if(subtotal && obligafinancieras.value){
        v_obligafinancieras = Math.round(subtotal * (obligafinancieras.value/100))
        document.getElementById('obligafinancieras_v').value = new Number(v_obligafinancieras ).toLocaleString("es-CO");
    }
    if(subtotal && rse.value){
        v_rse = Math.round(subtotal * (rse.value/100))
        document.getElementById('rse_v').value = new Number(v_rse).toLocaleString("es-CO");
    }

    costosexternos = Math.round(subtotal - v_comisionreferido - v_imprevistos - v_apalancamiento - v_obligafinancieras - v_rse);
    document.getElementById('costosexternos').value = new Number(costosexternos).toLocaleString("es-CO");

    calCostosFijosGestora()
    calCostosFijos401()
    calRelacionesCorp()
    calTotAsociados()
}


let nominafija_p = 0, contratistalattitude_p = 0, arqejecutivofirma_p = 0, subtotalcostosfijos=0, subtotalcostosfijos_v = 0;
let v_nominafija = 0, v_contratistalattitude = 0, v_arqejecutivofirma= 0;
function calCostosFijosGestora(){
    let nominafija = document.getElementById("nominafija");
    let contratistalattitude = document.getElementById("contratistalattitude");
    let arqejecutivofirma = document.getElementById("arqejecutivofirma");

    if(!nominafija.value ){
        document.getElementById('nominafija_v').value = 0 ;
        v_nominafija=0;
        nominafija_p = 0
    }
    if(!contratistalattitude.value ){
        document.getElementById('contratistalattitude_v').value = 0 ;
        v_contratistalattitude=0;
        contratistalattitude_p = 0
    }
     if(!arqejecutivofirma.value ){
        document.getElementById('arqejecutivofirma_v').value = 0 ;
        v_arqejecutivofirma=0;
        arqejecutivofirma_p = 0
    }

    if(costosexternos && nominafija.value){
        nominafija_p = nominafija.value;
        v_nominafija= Math.round(costosexternos * (nominafija.value/100));
        document.getElementById('nominafija_v').value = new Number(v_nominafija).toLocaleString("es-CO");
    }
    if(costosexternos && contratistalattitude.value){
        contratistalattitude_p = contratistalattitude.value ;
        v_contratistalattitude= Math.round(costosexternos * (contratistalattitude.value/100))
        document.getElementById('contratistalattitude_v').value = new Number(v_contratistalattitude).toLocaleString("es-CO");
    }
    // if(costosexternos && arqejecutivofirma.value){
    //     arqejecutivofirma_p = arqejecutivofirma.value;
    //     v_arqejecutivofirma= Math.round(costosexternos * (arqejecutivofirma.value/100))
    //     document.getElementById('arqejecutivofirma_v').value = new Number(v_arqejecutivofirma).toLocaleString("es-CO");
    // }  
    subtotalcostosfijos = parseFloat(nominafija_p) + parseFloat(contratistalattitude_p) ;
    subtotalcostosfijos_v = v_nominafija + v_contratistalattitude ;
    document.getElementById('subtotcostosfijos').value = new Number(subtotalcostosfijos).toLocaleString("es-CO") + "%";
    document.getElementById('subtotcostosfijos_v').value = new Number(subtotalcostosfijos_v).toLocaleString("es-CO");
    calSubtotNetoGestora();
}

let marcalattitude_p = 0, tecnologia_p = 0, serviciospublicos_p = 0, subtotcostosplataforma = 0, subtotcostosplataforma_v;
let v_marcalattitude = 0, v_tecnologia = 0, v_serviciospublicos= 0;
function calCostosFijos401(){
    let marcalattitude = null;
    let tecnologia = document.getElementById("tecnologia");
    let serviciospublicos = document.getElementById("serviciospublicos");

    /*if(!marcalattitude.value ){
        document.getElementById('marcalattitude_v').value = 0 ;
        v_marcalattitude=0;
        marcalattitude_p = 0
    }*/
    if(!tecnologia.value ){
        document.getElementById('tecnologia_v').value = 0 ;
        v_tecnologia=0;
        tecnologia_p = 0
    }
    if(!serviciospublicos.value ){
        document.getElementById('serviciospublicos_v').value = 0 ;
        v_serviciospublicos=0;
        serviciospublicos_p = 0
    }

    /*if(costosexternos && marcalattitude.value){
        marcalattitude_p = marcalattitude.value;
        v_marcalattitude= Math.round(costosexternos * (marcalattitude.value/100));
        document.getElementById('marcalattitude_v').value = new Number(v_marcalattitude).toLocaleString("es-CO");
    }*/
    if(costosexternos && tecnologia.value){
        tecnologia_p = tecnologia.value ;
        v_tecnologia= Math.round(costosexternos * (tecnologia.value/100))
        document.getElementById('tecnologia_v').value = new Number(v_tecnologia).toLocaleString("es-CO");
    }
    if(costosexternos && serviciospublicos.value){
        serviciospublicos_p = serviciospublicos.value;
        v_serviciospublicos= Math.round(costosexternos * (serviciospublicos.value/100))
        document.getElementById('serviciospublicos_v').value = new Number(v_serviciospublicos).toLocaleString("es-CO");
    } 
    subtotcostosplataforma = parseFloat(marcalattitude_p) + parseFloat(tecnologia_p) + parseFloat(serviciospublicos_p);
    subtotcostosplataforma_v = v_marcalattitude + v_tecnologia + v_serviciospublicos;
    document.getElementById('subtotcostosplataforma').value = new Number(subtotcostosplataforma).toLocaleString("es-CO") + "%";
    document.getElementById('subtotcostosplataforma_v').value = new Number(subtotcostosplataforma_v).toLocaleString("es-CO");
    calSubtotNetoGestora();
}

let recursoshumanos_p = 0, pryviaticos_p = 0, comunicaciones_p = 0, subtotrelacorporativas = 0, subtotrelacorporativas_v;
let v_recursoshumanos = 0, v_pryviaticos = 0, v_comunicaciones= 0;
function calRelacionesCorp(){
    let recursoshumanos = document.getElementById("recursoshumanos");
    let pryviaticos = document.getElementById("pryviaticos");
    let comunicaciones = document.getElementById("comunicaciones");

    if(!recursoshumanos.value ){
        document.getElementById('recursoshumanos_v').value = 0 ;
        v_recursoshumanos=0;
        recursoshumanos_p = 0
    }
    if(!pryviaticos.value ){
        document.getElementById('pryviaticos_v').value = 0 ;
        v_pryviaticos=0;
        pryviaticos_p = 0
    }
    if(!comunicaciones.value ){
        document.getElementById('comunicaciones_v').value = 0 ;
        v_comunicaciones=0;
        comunicaciones_p = 0
    }

    if(costosexternos && recursoshumanos.value){
        recursoshumanos_p = recursoshumanos.value;
        v_recursoshumanos= Math.round(costosexternos * (recursoshumanos.value/100));
        document.getElementById('recursoshumanos_v').value = new Number(v_recursoshumanos).toLocaleString("es-CO");
    }
    if(costosexternos && pryviaticos.value){
        pryviaticos_p = pryviaticos.value ;
        v_pryviaticos= Math.round(costosexternos * (pryviaticos.value/100))
        document.getElementById('pryviaticos_v').value = new Number(v_pryviaticos).toLocaleString("es-CO");
    }
    if(costosexternos && comunicaciones.value){
        comunicaciones_p = comunicaciones.value;
        v_comunicaciones= Math.round(costosexternos * (comunicaciones.value/100))
        document.getElementById('comunicaciones_v').value = new Number(v_comunicaciones).toLocaleString("es-CO");
    } 
    subtotrelacorporativas = parseFloat(recursoshumanos_p) + parseFloat(pryviaticos_p) + parseFloat(comunicaciones_p);
    subtotrelacorporativas_v = v_recursoshumanos + v_pryviaticos + v_comunicaciones;
    document.getElementById('subtotrelacorporativas').value = new Number(subtotrelacorporativas).toLocaleString("es-CO") + "%";
    document.getElementById('subtotrelacorporativas_v').value = new Number(subtotrelacorporativas_v).toLocaleString("es-CO");
    calSubtotNetoGestora();
}

let subtotnetogestora = 0, subtotnetogestora_v = 0;
function calSubtotNetoGestora(){
    if(costosexternos && arqejecutivofirma.value){
        arqejecutivofirma_p = arqejecutivofirma.value;
        v_arqejecutivofirma= Math.round(costosexternos * (arqejecutivofirma.value/100))
        document.getElementById('arqejecutivofirma_v').value = new Number(v_arqejecutivofirma).toLocaleString("es-CO");
    }

    subtotnetogestora = subtotalcostosfijos + subtotcostosplataforma + subtotrelacorporativas + parseFloat(arqejecutivofirma_p);
    subtotnetogestora_v = subtotalcostosfijos_v + subtotcostosplataforma_v + subtotrelacorporativas_v + v_arqejecutivofirma;
    document.getElementById('subtotnetogestora').value = new Number(subtotnetogestora).toLocaleString("es-CO") + "%";
    document.getElementById('subtotnetogestora_v').value = new Number(subtotnetogestora_v).toLocaleString("es-CO");
    calSubtotNetoEjecutar()
}

let subtotnetoaejecutar = 0, subtotnetoaejecutar_v = 0;
function calSubtotNetoEjecutar(){
    subtotnetoaejecutar_v = costosexternos - subtotnetogestora_v ;
    subtotnetoaejecutar = 100.00 -  subtotnetogestora ;
    document.getElementById('subtotnetoaejecutar').value = new Number(subtotnetoaejecutar).toLocaleString("es-CO") + "%";
    document.getElementById('subtotnetoaejecutar_v').value = new Number(subtotnetoaejecutar_v).toLocaleString("es-CO");
    calTotAsociados()
}


/// Manejo de asociados
let contadorAsociados = 0;
function addAsociado(){

    contadorAsociados++;
    if (contadorAsociados>19) {
        alert("No se pueden instertar más asociados.");
        return;
    }
    var original =  document.getElementById("div_asociado_0");
    var nuevo = original.cloneNode(true);
    nuevo.id =   "div_asociado_"+contadorAsociados    ;
    nuevo.firstChild.firstChild.id = "sel_asociado_" + contadorAsociados;
    nuevo.firstChild.firstChild.name = "sel_asociado_" + contadorAsociados;
    nuevo.childNodes[2].firstChild.id =  "asociado_v_" + contadorAsociados;
    nuevo.childNodes[2].firstChild.name =  "asociado_v_" + contadorAsociados;
    nuevo.childNodes[2].firstChild.value =  "0";
    nuevo.childNodes[4].firstChild.id =  "asociado_" + contadorAsociados;
    nuevo.childNodes[4].firstChild.name =  "asociado_" + contadorAsociados;
    nuevo.childNodes[4].firstChild.value =  "0";
    nuevo.childNodes[6].firstChild.id =  "fase1_" + contadorAsociados;
    nuevo.childNodes[6].firstChild.name =  "fase1_" + contadorAsociados;
    nuevo.childNodes[6].firstChild.value =  "0";
    nuevo.childNodes[6].firstChild.setAttribute("onkeyup", "valFases(1," + contadorAsociados + ")");
    nuevo.childNodes[8].firstChild.id =  "fase2_" + contadorAsociados;
    nuevo.childNodes[8].firstChild.name =  "fase2_" + contadorAsociados;
    nuevo.childNodes[8].firstChild.value =  "0";
    nuevo.childNodes[8].firstChild.setAttribute("onkeyup", "valFases(2," + contadorAsociados + ")");
    nuevo.childNodes[10].firstChild.id =  "fase3_" + contadorAsociados;
    nuevo.childNodes[10].firstChild.name =  "fase3_" + contadorAsociados;
    nuevo.childNodes[10].firstChild.value =  "0";
    nuevo.childNodes[10].firstChild.setAttribute("onkeyup", "valFases(3," + contadorAsociados + ")");

    nuevo.lastChild.lastChild.setAttribute("onclick", "delAsociado(" + contadorAsociados + ")");
    nuevo.lastChild.lastChild.setAttribute("class", "btn btn-danger btn-block");
    
    destino = document.getElementById("contenedor_asociados");
    destino.appendChild(nuevo);

}

function delAsociado(id){
    //console.log(id);
    if(id == 0){
        alert("No se puede eliminar este elemento.");
    }else{
       if (confirm("Realmente quiere quitar este asociado?")){
             $("#div_asociado_" + id).remove();     
       }
    }
    calTotAsociados()
    calBolsaRemFinal()
}

let totasociados = 0, sum_p_asociados = 0, bolsaremanente_p = 0, bolsaremanente = 0, subtotoperaejecutar=0,subtotoperaejecutar_p=0;
let total = 0, total_p = 0;
function calTotAsociados(){
    totasociados = 0
    sum_p_asociados=0
    bolsaremanente_p=0
    bolsaremanente=0
    subtotoperaejecutar=0
    subtotoperaejecutar_p=0
    total = 0
    total_p = 0

    for (var i = 0; i <= 19; i++) {
        let asociado_ = document.getElementById("asociado_"+i);
        if (asociado_){
            if (asociado_.value && costosexternos){ 
              let asociado_v = Math.round(parseFloat(asociado_.value/100) * costosexternos);
              sum_p_asociados = sum_p_asociados + parseFloat(asociado_.value)
              document.getElementById('asociado_v_'+i).value = new Number(asociado_v).toLocaleString("es-CO");

              totasociados = totasociados + asociado_v
            }else{
                document.getElementById('asociado_v_'+i).value = new Number(0).toLocaleString("es-CO");

            }

        }
    }

    if(costosexternos){ bolsaremanente_p =  subtotnetoaejecutar - sum_p_asociados;}
    if(costosexternos){ bolsaremanente =  Math.round((bolsaremanente_p/100) * costosexternos);}
    if(costosexternos){ subtotoperaejecutar = Math.round(totasociados + bolsaremanente);}
    if(costosexternos){ subtotoperaejecutar_p = sum_p_asociados + bolsaremanente_p;}

    document.getElementById('bolsaremanente').value = new Number(bolsaremanente).toLocaleString("es-CO");
    //document.getElementById('bolsaremanente_p').value = new Number(bolsaremanente_p).toLocaleString("es-CO") + "%";
    document.getElementById('bolsaremanente_p').value = parseFloat(bolsaremanente_p).toFixed(2) + "%";
    document.getElementById('subtotoperaejecutar').value = new Number(subtotoperaejecutar).toLocaleString("es-CO");
    //document.getElementById('subtotoperaejecutar_p').value = new Number(subtotoperaejecutar_p).toLocaleString("es-CO") + "%";
    document.getElementById('subtotoperaejecutar_p').value = parseFloat(subtotoperaejecutar_p).toFixed(2) + "%";

    if(costosexternos){  total = Math.round(subtotnetogestora_v + subtotoperaejecutar);}
    if(costosexternos){  total_p = subtotnetogestora + subtotoperaejecutar_p;}

    document.getElementById('total').value = new Number(total).toLocaleString("es-CO");
    document.getElementById('total_p').value = new Number(total_p).toLocaleString("es-CO") + "%";


}

function validarDelProject(id){
    if (confirm("Realmente quiere eliminar este proyecto?")){
        document.getElementById('delete_'+id).submit();
    }else{
        return false;    
    }
}



/// Manejo de polizas al editar
let contadorPolizasE = 0;
function addPolizaEdit(cont){
    if (contadorPolizasE == 0){
        contadorPolizasE = cont;
    }else{
        contadorPolizasE++;
    }

    if (contadorPolizasE>19) {
        alert("No se pueden instertar más polizas.");
        return;
    }
    var original =  document.getElementById("poliza_0");
    var nuevo = original.cloneNode(true);
    nuevo.id =   "poliza_"+contadorPolizasE    ;
    nuevo.firstChild.firstChild.id = "sel_poliza_" + contadorPolizasE;
    nuevo.firstChild.firstChild.name = "sel_poliza_" + contadorPolizasE;
    nuevo.childNodes[2].firstChild.id =  "poliza_v_" + contadorPolizasE;
    nuevo.childNodes[2].firstChild.name =  "poliza_v_" + contadorPolizasE;
    nuevo.childNodes[2].firstChild.value =  "0";
    nuevo.lastChild.lastChild.setAttribute("onclick", "delPoliza(" + contadorPolizasE + ")");
    nuevo.lastChild.lastChild.setAttribute("class", "btn btn-danger btn-block");
    
    destino = document.getElementById("contenedor_polizas");
    destino.appendChild(nuevo);

}


/// Manejo de contratistas al editar
let contadorContratistasE = 0;
function addContratistaEdit(cont){

    if (contadorContratistasE == 0){
        contadorContratistasE = cont;
    }else{
        contadorContratistasE++;
    }
    if (contadorContratistasE>19) {
        alert("No se pueden instertar más contratistas.");
        return;
    }
    var original =  document.getElementById("contratista_0");
    var nuevo = original.cloneNode(true);
    nuevo.id =   "contratista_"+contadorContratistasE    ;
    nuevo.firstChild.firstChild.id = "sel_contratista_" + contadorContratistasE;
    nuevo.firstChild.firstChild.name = "sel_contratista_" + contadorContratistasE;
    nuevo.childNodes[2].firstChild.id =  "contratista_v_" + contadorContratistasE;
    nuevo.childNodes[2].firstChild.name =  "contratista_v_" + contadorContratistasE;
    nuevo.childNodes[2].firstChild.value =  "0";
    nuevo.lastChild.lastChild.setAttribute("onclick", "delContratista(" + contadorContratistasE + ")");
    nuevo.lastChild.lastChild.setAttribute("class", "btn btn-danger btn-block");
    
    destino = document.getElementById("contenedor_contratistas");
    destino.appendChild(nuevo);

}
/// Manejo de asociados al editar
let contadorAsociadosE = 0;
function addAsociadoEdit(cont){

    if (contadorAsociadosE == 0){
        contadorAsociadosE = cont;
    }else{
        contadorAsociadosE++;
    }    
    if (contadorAsociadosE>19) {
        alert("No se pueden instertar más asociados.");
        return;
    }
    var original =  document.getElementById("div_asociado_0");
    var nuevo = original.cloneNode(true);
    nuevo.id =   "div_asociado_"+contadorAsociadosE    ;
    nuevo.firstChild.firstChild.id = "sel_asociado_" + contadorAsociadosE;
    nuevo.firstChild.firstChild.name = "sel_asociado_" + contadorAsociadosE;
    nuevo.childNodes[2].firstChild.id =  "asociado_v_" + contadorAsociadosE;
    nuevo.childNodes[2].firstChild.name =  "asociado_v_" + contadorAsociadosE;
    nuevo.childNodes[2].firstChild.value =  "0";
    nuevo.childNodes[4].firstChild.id =  "asociado_" + contadorAsociadosE;
    nuevo.childNodes[4].firstChild.name =  "asociado_" + contadorAsociadosE;
    nuevo.childNodes[4].firstChild.value =  "0";
    nuevo.childNodes[4].firstChild.removeAttribute("readonly");

    nuevo.childNodes[6].firstChild.id =  "fase1_" + contadorAsociadosE;
    nuevo.childNodes[6].firstChild.name =  "fase1_" + contadorAsociadosE;
    nuevo.childNodes[6].firstChild.value =  "0";
    nuevo.childNodes[6].firstChild.setAttribute("onkeyup", "valFases(1," + contadorAsociadosE + ")");
    nuevo.childNodes[6].firstChild.removeAttribute("readonly");
    nuevo.childNodes[6].lastChild.removeAttribute("checked");
    nuevo.childNodes[6].lastChild.id=  "fase1ok_" + contadorAsociadosE;
    nuevo.childNodes[6].lastChild.name=  "fase1ok_" + contadorAsociadosE;
    nuevo.childNodes[6].lastChild.setAttribute("onclick", "valFaseOk(1," + contadorAsociadosE + ")");

    nuevo.childNodes[8].firstChild.id =  "fase2_" + contadorAsociadosE;
    nuevo.childNodes[8].firstChild.name =  "fase2_" + contadorAsociadosE;
    nuevo.childNodes[8].firstChild.value =  "0";
    nuevo.childNodes[8].firstChild.setAttribute("onkeyup", "valFases(2," + contadorAsociadosE + ")");
    nuevo.childNodes[8].firstChild.removeAttribute("readonly");
    nuevo.childNodes[8].lastChild.removeAttribute("checked");
    nuevo.childNodes[8].lastChild.id=  "fase2ok_" + contadorAsociadosE;
    nuevo.childNodes[8].lastChild.name=  "fase2ok_" + contadorAsociadosE;
    nuevo.childNodes[8].lastChild.setAttribute("onclick", "valFaseOk(2," + contadorAsociadosE + ")");

    nuevo.childNodes[10].firstChild.id =  "fase3_" + contadorAsociadosE;
    nuevo.childNodes[10].firstChild.name =  "fase3_" + contadorAsociadosE;
    nuevo.childNodes[10].firstChild.value =  "0";
    nuevo.childNodes[10].firstChild.setAttribute("onkeyup", "valFases(3," + contadorAsociadosE + ")");
    nuevo.childNodes[10].firstChild.removeAttribute("readonly");
    nuevo.childNodes[10].lastChild.removeAttribute("checked");
    nuevo.childNodes[10].lastChild.id=  "fase3ok_" + contadorAsociadosE;
    nuevo.childNodes[10].lastChild.name=  "fase3ok_" + contadorAsociadosE;
    nuevo.childNodes[10].lastChild.setAttribute("onclick", "valFaseOk(3," + contadorAsociadosE + ")");

    nuevo.childNodes[12].firstChild.id =  "totfases_" + contadorAsociadosE;
    nuevo.childNodes[12].firstChild.name =  "totfases_" + contadorAsociadosE;
    nuevo.childNodes[12].firstChild.value =  "0%";
    nuevo.childNodes[14].firstChild.id =  "partfinal_p_" + contadorAsociadosE;
    nuevo.childNodes[14].firstChild.name =  "partfinal_p_" + contadorAsociadosE;
    nuevo.childNodes[14].firstChild.value =  "0%";
    nuevo.childNodes[16].firstChild.id =  "partfinal_" + contadorAsociadosE;
    nuevo.childNodes[16].firstChild.name =  "partfinal_" + contadorAsociadosE;
    nuevo.childNodes[16].firstChild.value =  "0";


    nuevo.lastChild.lastChild.setAttribute("onclick", "delAsociado(" + contadorAsociadosE + ")");
    nuevo.lastChild.lastChild.setAttribute("class", "btn btn-danger btn-block");
    
    destino = document.getElementById("contenedor_asociados");
    destino.appendChild(nuevo);

}


function valFases(fase, id){

    var fase1 =  document.getElementById('fase1_'+id);
    var fase2 =  document.getElementById('fase2_'+id);
    var fase3 =  document.getElementById('fase3_'+id);

    let fase1_v = 0, fase2_v = 0, fase3_v = 0;

    if (fase1.value){fase1_v = parseFloat(fase1.value);}
    if (fase2.value){fase2_v = parseFloat(fase2.value);}
    if (fase3.value){fase3_v = parseFloat(fase3.value);}

    var totfases = fase1_v + fase2_v + fase3_v;

    if(totfases > 1000 ){
        alert("Las fases no pueden sumar el 1000%.");
        document.getElementById('fase'+fase+'_'+id).value = 0
    }

}


//validar envio del formulario
function validar_crearproject(){
    let hasError = false
    let total_ = document.getElementById('total');
    let total_p_ = document.getElementById('total_p');
    let bolsaremanente_p_ = document.getElementById('bolsaremanente_p');

    if(bolsaremanente_p_.value){
        var bolsaremanente_p_x = bolsaremanente_p_.value.replace('%','');
        bolsaremanente_p_x = bolsaremanente_p_x.replace(',','.');
        if(parseFloat(bolsaremanente_p_x) < 0){
            hasError = true;
        }
    }else{
        hasError = true;
    }

    if(total_.value){
        var total_x = total_.value.replace(',','');
        if(parseFloat(total_x) < 0){
            hasError = true;
        }
    }else{
        hasError = true;
    }
    
    if(total_p_.value){
        if(total_p_.value!='100%'){
            hasError = true;
        }
    }else{
        hasError = true;
    }

    if (hasError){
        alert ("No es posible guardar, verifique los valores.")
        return false;    
    }else{
        document.getElementById('crearproject').submit();
    }
}

//validar envio del formulario
function validar_editarproject(){
    let hasError = false
    let total_ = document.getElementById('total');
    let total_p_ = document.getElementById('total_p');
    let bolsaremanente_p_ = document.getElementById('bolsaremanente_p');

    if(bolsaremanente_p_.value){
        var bolsaremanente_p_x = bolsaremanente_p_.value.replace('%','');
        bolsaremanente_p_x = bolsaremanente_p_x.replace(',','.');
        if(parseFloat(bolsaremanente_p_x) < 0){
            hasError = true;
        }
    }else{
        hasError = true;
    }

    if(total_.value){
        var total_x = total_.value.replace(',','');
        if(parseFloat(total_x) < 0){
            hasError = true;
        }
    }else{
        hasError = true;
    }

    if(total_p_.value){
        if(total_p_.value!='100%'){
            hasError = true;
        }
    }else{
        hasError = true;
    }

    if (hasError){
        alert ("No es posible actualizar, verifique los valores.")
        return false;    
    }else{
        document.getElementById('editarproject').submit();
    }
}


function valFaseOk(fase, id){

    var faseok =  document.getElementById('fase'+fase+'ok_'+id);

    if (faseok.checked == true){
        document.getElementById('fase'+fase+'_'+id).setAttribute("readonly",true);
    }else{
        document.getElementById('fase'+fase+'_'+id).removeAttribute("readonly");
    }

    var fase1 =  document.getElementById('fase1_'+id);
    var fase2 =  document.getElementById('fase2_'+id);
    var fase3 =  document.getElementById('fase3_'+id);
    var fase1ok =  document.getElementById('fase1ok_'+id);
    var fase2ok =  document.getElementById('fase2ok_'+id);
    var fase3ok =  document.getElementById('fase3ok_'+id);

    if (fase1ok.checked == true || fase2ok.checked == true || fase3ok.checked == true ){
        document.getElementById('asociado_'+id).setAttribute("readonly",true);
    }else{
        document.getElementById('asociado_'+id).removeAttribute("readonly");
    }


    let fase1_v = 0, fase2_v = 0, fase3_v = 0;

    if (fase1.value && fase1ok.checked == true){fase1_v = parseFloat(fase1.value);}
    if (fase2.value && fase2ok.checked == true){fase2_v = parseFloat(fase2.value);}
    if (fase3.value && fase3ok.checked == true){fase3_v = parseFloat(fase3.value);}

    var totfases = fase1_v + fase2_v + fase3_v;

    document.getElementById('totfases_'+id).value = totfases + "%";

    var part =  document.getElementById('asociado_'+id);
    var oper = parseFloat((totfases/100) * parseFloat(part.value)).toFixed(2);
    document.getElementById('partfinal_p_'+id).value = oper + "%";

    var partfinal =  Math.round((oper/100) * costosexternos ) ;
    document.getElementById('partfinal_'+id).value = new Number(partfinal).toLocaleString("es-CO") ;

    calBolsaRemFinal();


}


function calBolsaRemFinal(){
    totpartfinal_p = 0

    for (var i = 0; i <= 19; i++) {
        let partfinal_p_ = document.getElementById("partfinal_p_"+i);
        if (partfinal_p_){
            if (partfinal_p_.value){ 
              let por = partfinal_p_.value.replace("%","");
              totpartfinal_p = totpartfinal_p + parseFloat(por)
            }
        }
    }

    var p = subtotnetoaejecutar - totpartfinal_p ;
    document.getElementById('partfinal_p_999').value = parseFloat(p).toFixed(2) + '%' ;
    var x =  Math.round((p/100) * costosexternos)
    document.getElementById('partfinal_999').value = new Number(x).toLocaleString("es-CO")  ;


}