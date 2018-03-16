$(document).ready( function () {
    
    
    formatoinicial();
    clientesdatatable();
    
    
	$('#nuevospn').click(function(){$('#pannel1').css('display','block'); resetarformulario(); });
    $('#txtRFC').on('blur', function(){  var rfccc = $('#txtRFC').val(); RFCFormato();validarRFC(rfccc);});
    $('#txtCP').on('keyup', function(e){buscarColonias(e.target.value, 0);});
    $('#btnNuevoCte').click(function(){ resetarformulario(); });
    $('#btnGuardaCliente').click(function(){ guardar(); });
    
    
} );
////////////////////////////////////////////////////////////
/////////////variables///////////////////////////////////
var txtRFC          = $('#txtRFC').val();
var regimen          = $('#cmbRegimen').val();
var racsocial       = $('#txtRacSoc').val();
var telef           = $('#txtTelefono').val();
var email           = $('#txtEmail').val();

var callevar        = $('#txtCalle').val();
var interiorvar     = $('#txtNumInt').val();
var exteriorvar     = $('#txtNumExt').val();
var codigopostalvar = $('#txtCP').val();
var idcoloniavar    = $('#cmbColonia').val();
var idmunicipiovar  = $('#cmbCiudad').val();
var idestadovar     = $('#cmbEntidad').val();
var idpaisvar       = $('#cmbPais').val();


///////////////////////////////////////////////////////

function resetarformulario(){
    document.getElementById("formModUno").reset();
    resetDatosColonias();
    $('#txtRFC').prop('disabled', false);   
    
}

function clientesdatatable(){
	
	
	var tablaClientes = $('#clientesDT').DataTable({
		
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "./ajax/AlumnosPorcampusDataTable.php",
		"aaSorting": [ [1, "desc"] ],
		"aoColumnDefs": [
            //1ra columna
			{ "mRender": function ( data, type, row ) {
				return row[1];
			}, "aTargets": [ 0 ] },
            //segunda columna
			{ 	"mRender": function ( data, type, row ) {
				return row[2];
			}, /*"sWidth": "20px",*/ "aTargets": [ 1 ] },
            //3a columna
			{ "mRender": function ( data, type, row ) {
				return row[3];
			}, "bSortable": true, "aTargets": [ 2 ] },
            
             //4a columna
	
			
			{ "mRender": function ( data, type, row ) {
                
               return row[4];
			
            }, "bSortable": true, "aTargets": [ 3 ] },
            
            
            { "mRender": function ( data, type, row ) {
               var iconoRevisado = "";
				
					
						iconoRevisado = "<center><img title=\"Editar\" style=\"cursor:pointer\"  onclick=\"llenaeditar("+row[1]+")\" src=\"./img/edit.png\"/></center>";
                return iconoRevisado;
				
			
            }, "bSortable": false, "aTargets": [4] },
          
		],
			"fnDrawCallback": function ( oSettings ) {
			/* Aplicar tooltips */
			tablaClientes.$('img').tooltip({
				"delay": 0,
				"track": true,
				"fade": 250					  
			});
			//tablaPreSubCadenas.$('tr:odd').css( "background-color", "#D4DDED" );

		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			$('td:eq(0)', nRow).addClass( "dataTableNombre" );
			$('td:eq(1)', nRow).addClass( "dataTableAvance" );
		},		
		"oLanguage": {
			"sLengthMenu": "Mostrar _MENU_ registros por p&aacute;gina.",
			"sZeroRecords": "No se encontr&oacute; ning&uacute;n resultado.",
			"sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros.",
			"sInfoEmpty": "Mostrando 0 de 0 de 0 registros.",
			"sInfoFiltered": "(filtrados de un total de _MAX_ registros)",
			"sSearch": "Buscar",
			"sProcessing": "Procesando..."
		}
		
		
	});
	
	
}

function RefreshTable(tableId, urlData){
  $.getJSON(urlData, null, function( json )
  {
    table = $(tableId).dataTable();
    oSettings = table.fnSettings();

    table.fnClearTable(this);

    for (var i=0; i<json.aaData.length; i++)
    {
      table.oApi._fnAddData(oSettings, json.aaData[i]);
    }

    oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
    table.fnDraw();
  });
    
}

function toasts(mensaje){
       $().toastmessage('showToast', {
       text	: mensaje,
		sticky: false, position	: 'top-center', type: 'warning'}); 
}

function cargarcte(idcte){
	
	$.post('./application/models/ClientesCargar.php',{idcte:idcte},function(resp){
        
        if(resp.idct >0){
            
          $('#txtRFC').val(resp.rfc);
        $('#cmbRegimen').val(resp.regimen);
        $('#txtRacSoc').val(resp.raczoc);
        $('#txtEmail').val(resp.mail);
        $('#txtTelefono').val(resp.tel);
        
        $('#txtCalle').val(resp.calle);
        $('#txtNumInt').val(resp.numint);
        $('#txtNumExt').val(resp.numext);
        $('#txtCP').val(resp.cp);
        //$('#txtRFC').val(resp.idcol);
        buscarColonias(resp.cp, resp.idcol);  
            
         $('#pannel1').css('display','block');   
        }else{
           
            
            toasts('No se puedo obtener la informacion del Clinete.. Contacte a Soporte Técnico');
           
            
        }
        
       
    },"JSON");
}


function verif_rfcf(rfcs) { 
        //verifica RFC persona fisica

                var for_rfc= /^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))/;
                if(for_rfc.test(rfcs))
                    { return true; }
                    else 
                    { return false; }
                }
function verif_rfcm(rfcs) {  //verifica RFC persona Moral

                var for_rfc= /^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))/;
                if(for_rfc.test(rfcs))
                    { return true; }
                    else 
                    { return false; }
                }

function ValidateInputEmail(element, e){
	       if(e.which == 13 || e.which == 8){
		      e.preventDefault();
                return;
            }
	
	           var yourInput = $(element).val();
	           re = /[^0-9a-zA-Z@_./\s]/g;
	           var isSplChar = re.test(yourInput);
	       if(isSplChar)
	           {
		      var no_spl_char = yourInput.replace(/[^0-9a-zA-Z@_./-\s]/g,'');
		
		          $(element).val(no_spl_char);
	           }
        }

function myTrim(txt){
	if(txt != undefined && typeof txt == 'string'){
		return txt.trim();
	}
	else if(txt != undefined && typeof txt == 'number'){
		return txt;
	}
	else{
		return '';
	}
}
///////////////////////////////////////////////////////////


function formatoinicial(){
    
    
    
    $('#txtCalle').alphanum({
			disallow			: '',
			allow				: 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ()-.,\u00E1\u00E9\u00ED\u00F3\u00FA\u00C1\u00C9\u00CD\u00D3\u00DA\u00F1\u00D1\u00FC\u00DC\u0026\u002C\u002E',
			allowSpace			: true,
			allowNumeric		: true,
			allowUpper			: true,
			allowLower			: false,
			allowLatin			: false,
			allowOtherCharSets	: false,
			maxLength			: 50
		});
    
    	$('#txtnombres').alphanum({
			disallow			: '',
			allow				: 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-.,\u00E1\u00E9\u00ED\u00F3\u00FA\u00C1\u00C9\u00CD\u00D3\u00DA\u00F1\u00D1\u00FC\u00DC\u0026\u002C\u002E',
			allowSpace			: true,
			allowNumeric		: false,
			allowUpper			: true,
			allowLower			: true,
			allowLatin			: false,
			allowOtherCharSets	: false,
			maxLength			: 50
		});
        	$('#txtPatermp').alphanum({
			disallow			: '',
			allow				: 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-.,\u00E1\u00E9\u00ED\u00F3\u00FA\u00C1\u00C9\u00CD\u00D3\u00DA\u00F1\u00D1\u00FC\u00DC\u0026\u002C\u002E',
			allowSpace			: true,
			allowNumeric		: true,
			allowUpper			: true,
			allowLower			: true,
			allowLatin			: false,
			allowOtherCharSets	: false,
			maxLength			: 20
		});
    	$('#txtMaterno').alphanum({
			disallow			: '',
			allow				: 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-.,\u00E1\u00E9\u00ED\u00F3\u00FA\u00C1\u00C9\u00CD\u00D3\u00DA\u00F1\u00D1\u00FC\u00DC\u0026\u002C\u002E',
			allowSpace			: true,
			allowNumeric		: true,
			allowUpper			: true,
			allowLower			: true,
			allowLatin			: false,
			allowOtherCharSets	: false,
			maxLength			: 20
		});
    $('#txtEmail').alphanum({
			disallow			: '',
			allow				: '@abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-.\u00E1\u00E9\u00ED\u00F3\u00FA\u00C1\u00C9\u00CD\u00D3\u00DA\u00F1\u00D1\u00FC\u00DC\u0026\u002C\u002E',
			allowSpace			: true,
			allowNumeric		: true,
			allowUpper			: true,
			allowLower			: true,
			allowLatin			: false,
			allowOtherCharSets	: false,
			maxLength			: 80
		});
    
      $('#txtNumInt').alphanum({
			disallow			: '',
			allow				: 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-\u00E1\u00E9\u00ED\u00F3\u00FA\u00C1\u00C9\u00CD\u00D3\u00DA\u00F1\u00D1\u00FC\u00DC\u0026\u002C\u002E',
			allowSpace			: true,
			allowNumeric		: true,
			allowUpper			: true,
			allowLower			: false,
			allowLatin			: false,
			allowOtherCharSets	: false,
			maxLength			: 10
		});
    $('#txtNumExt').alphanum({
			disallow			: 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-\u00E1\u00E9\u00ED\u00F3\u00FA\u00C1\u00C9\u00CD\u00D3\u00DA\u00F1\u00D1\u00FC\u00DC\u0026\u002C\u002E',
			allow				: '',
			allowSpace			: true,
			allowNumeric		: true,
			allowUpper			: true,
			allowLower			: false,
			allowLatin			: false,
			allowOtherCharSets	: false,
			maxLength			: 10
		});
    $('#txtCP').alphanum({
			disallow			: '',
			allow				: '',
			allowSpace			: true,
			allowNumeric		: true,
			allowUpper			: true,
			allowLower			: false,
			allowLatin			: false,
			allowOtherCharSets	: false,
			maxLength			: 6
		});
    
    	$('#txtTelefono').mask('(00) 00-00-00-00');
    $('#txtMovil').mask('(00) 00-00-00-00');
    
}

function customTrim(txt){
	txt = txt.toString();
	return txt.replace(/^\s+|\s+$/g, '');
}
function customEmptyStore(id){
	var cmb		= document.getElementById(id);
	var length	= cmb.options.length;

	var i;
    for(i = cmb.options.length - 1 ; i >= 0 ; i--){
		cmb.remove(i);
    }
}

function isValidEmail( email ) {
	var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(expr.test(email)){
		return true;
	}
	else{
		return false;
	}
}

/////////////////////////////////////////////////////////////
function buscarColonias(nCodigoPostal, nIdColonia){
	if(nCodigoPostal == undefined){
		resetDatosColonias();
		return false;
	}

	var sCodigoPostal = customTrim(nCodigoPostal.toString());

	resetDatosColonias();
	if(sCodigoPostal.length > 5){
		resetDatosColonias();
		return false;
	}

	if(sCodigoPostal.length < 5 || sCodigoPostal.length > 5){
		resetDatosColonias();
		return false;
	}
///// id el combo colonia
	$('#cmbColonia').prop('disabled', true);
    
	$.ajax({
		url			: './application/models/buscaDatosCodigoPostal.php',
		type		: 'POST',
		dataType	: 'json',
		data		: {
			nCodigoPostal : sCodigoPostal
		}
	})
	.done(function(resp){
		if(resp.bExito == true){
			customLlenarComboColonia('cmbColonia', resp.data);
			customLlenarComboEstado('cmbEntidad', resp.data);
			customLlenarComboCiudad('cmbCiudad', resp.data);
            
            if(nIdColonia == undefined){}else{
                
              $('#cmbColonia').val(nIdColonia);  
            }
            

		}
	})
	.fail(function() {
	})
	.always(function() {
		$('#cmbColonia').prop('disabled', false);
	});
	
}


function resetDatosColonias(){
	customEmptyStore('cmbColonia');
	customEmptyStore('cmbEntidad');
	customEmptyStore('cmbCiudad');
}

function customLlenarComboEstado(id, data){
	customEmptyStore('cmbEntidad');
	var cmb		= document.getElementById(id);
	var option	= document.createElement("option");

	if(typeof option.textContent === 'undefined'){
		option.innerText = data[0].sDEstado;
	}
	else{
		option.textContent = data[0].sDEstado;
	}
	option.value	= data[0].nIdEstado;

	cmb.appendChild(option);
}

function customLlenarComboCiudad(id, data){
	customEmptyStore('cmbCiudad');
	var cmb		= document.getElementById(id);
	var option	= document.createElement("option");

	if(typeof option.textContent === 'undefined'){
		option.innerText = data[0].sDMunicipio;
	}
	else{
		option.textContent = data[0].sDMunicipio;
	}
	option.value	= data[0].nNumMunicipio;

	cmb.appendChild(option);
}

function customLlenarComboColonia(id, data){
	var data	= data;
	var length	= data.length;
	var cmb		= document.getElementById(id);

	customEmptyStore('cmbColonia');

	for(var i=0; i<length; i++){
		var option	= document.createElement("option");
		option.text	= data[i].sNombreColonia;

		if(typeof option.textContent === 'undefined'){
			option.innerText = data[i].sNombreColonia;
		}
		else{
			option.textContent = data[i].sNombreColonia;
		}
		option.value	= data[i].nIdColonia;

		cmb.appendChild(option);
	}
}

////////////////////////////////////////////////////////





function validaciones(){
    
   
var nombres         = $('#txtnombres').val();
var paterno         = $('#txtPatermp').val();    
var manterno        = $('#txtMaterno').val();
var genero          = $('#cmbGenero').val();
var nacimiento      = $('#txtNacimeinto').val();
var distrito        = $('#cmbDistrito').val();
var nivel           = $('#cmbNivel').val();
var telefono        = $('#txtTelefono').val();
var movil           = $('#txtMovil').val();
var correo          = $('#txtCorreo').val();


var callevar        = $('#txtCalle').val();

var exteriorvar     = $('#txtNumExt').val();
var codigopostalvar = $('#txtCP').val();
var idcoloniavar    = $('#cmbColonia').val();
var idmunicipiovar  = $('#cmbCiudad').val();
var idestadovar     = $('#cmbEntidad').val();
var idpaisvar       = $('#cmbPais').val();

 
    
  
    
    if(nombres == undefined || nombres.length < 3){toasts('Capture El Nombre del alumno de al menos 3 caracteres');return false;}
    if(paterno == undefined || paterno.length < 3){toasts('Capture el apellido paterno de al menos 3 caracteres');return false;}
    if(genero == -1){toasts('Seleccion el género del alumno');return false;}
    
    //buscar una validacion que  verifique que la fecha de nacimiento
    if(nacimiento == undefined || nacimiento.length < 3){toasts('Seleccione la fecha de nacimiento');return false;}
    if(distrito == -1){toasts('Debe seleccionar un Distrito');return false;}
    if(nivel == -1){toasts('Debe seleccionar un nivel Academico');return false;}

    
    //validar Telefono
     if(telefono == undefined || telefono.length < 16){toasts('Capture una Número de teléfono Válido');return false;}
     if(movil == undefined || movil.length < 16){toasts('Capture una Número de teléfono Movil Válido');return false;}
    
     //validar correo /// agragar una funcion que valida el correo electrónico
     if(correo == undefined ){toasts('Capture una Correo electrónico valido');return false;}
    
    var emailvalid = isValidEmail(correo);
    if(emailvalid == false){toasts('Capture una Correo electrónico valido');return false;}
     //validar calle
     if(callevar == undefined || callevar.length < 3){toasts('Capture una nombre de calle Válido de al menos 3 caracteres');return false;}
     //validar numexterno
     if(exteriorvar == undefined || exteriorvar.length < 1 ){toasts('Capture una Número exterior del Domicilio');return false;}
     //validar codigo postal
     if(codigopostalvar == undefined || codigopostalvar.length < 5){toasts('Capture una Codigo Postal Válido');return false;}
     //validar colonia
     if(idcoloniavar == undefined || idcoloniavar < 0){toasts('Seleccione Una Colonia');return false;}
    
    
}


function guardar(){
    
  
   var validate =  validaciones();
    
    if(validate == false){return;}
    guardaralumno();
    //setTimeout(function(){refresh();},500);
}

function guardaralumno(){
var alm             = $('#txtidalumno').val();    
var nombres         = $('#txtnombres').val();
var paterno         = $('#txtPatermp').val();    
var manterno        = $('#txtMaterno').val();
var genero          = $('#cmbGenero').val();
var nacimiento      = $('#txtNacimeinto').val();
var distrito        = $('#cmbDistrito').val();
var nivel           = $('#cmbNivel').val();
var telefono        = $('#txtTelefono').val();
var movil           = $('#txtMovil').val();
var correo          = $('#txtCorreo').val();
var usr             = 999;

var callevar        = $('#txtCalle').val();
var interiorvar     = $('#txtNumInt').val();
var exteriorvar     = $('#txtNumExt').val();
var codigopostalvar = $('#txtCP').val();
var idcoloniavar    = $('#cmbColonia').val();
var idmunicipiovar  = $('#cmbCiudad').val();
var idestadovar     = $('#cmbEntidad').val();
var idpaisvar       = $('#cmbPais').val();
var fotourl       = $('#txturl').val();
var campus = campusid;
 

    $.post('./application/models/GuardarAlumno.php',{alm:alm, nombres:nombres, paterno:paterno,  manterno:manterno, genero:genero,nacimiento:nacimiento, distrito:distrito, nivel:nivel, telefono:telefono, movil:movil, correo:correo, usr:usr,calle:callevar, int:interiorvar, ext:exteriorvar, cp:codigopostalvar, col:idcoloniavar, mun:idmunicipiovar,  edo:idestadovar,fotourl:fotourl,campus:campus},function(res){
        
        if(res.cod > 0){
            toasts(res.msg);
        }else{
            toasts(res.msg);
            RefreshTable('#clientesDT', './application/models/AlumnosPorcampusDataTable.php');
            //resetarformulario();
            $('#pannel1').css('display','none');
        }
        
         //toasts(res.msg);
           
        
    },"JSON");
    
 
   
}

function refresh(){
    
      RefreshTable('#clientesDT', './application/models/AlumnosPorcampusDataTable.php');
            //resetarformulario();
            $('#pannel1').css('display','none');  
    
}

function llenaeditar(idalumno){
    
    $.post('./application/models/AlumnosPorcampus.php',{idalumno:idalumno},function(res){


if(res.alumnoid> 0)  {  



 $('#txtidalumno').val(res.alumnoid);
  $('#txtnombres').val(res.nombre);
 $('#txtPatermp').val(res.paterno);    
$('#txtMaterno').val(res.materno);
$('#cmbGenero').val(res.genero);
 $('#txtNacimeinto').val(res.nacimiento);
 $('#cmbDistrito').val(res.distrito );
$('#cmbNivel').val(res.nivel);
$('#txtTelefono').val(res.telefono);
$('#txtMovil').val(res.movil);
$('#txtCorreo').val(res.correo);


$('#txtCalle').val(res.calle);
$('#txtNumInt').val(res.interior);
$('#txtNumExt').val(res.exterior);
$('#txtCP').val(res.cp);
buscarColonias(res.cp, res.colonia);

$('#txturl').val(res.urlfoto);
$('#pannel1').css('display','block');

}else{

toasts('No se pudo extraer la información para mostrar. Contacte a Soporte');
}

},"JSON");




}