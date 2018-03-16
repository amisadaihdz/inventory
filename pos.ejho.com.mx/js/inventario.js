$(document).ready( function () {
    
    
  
    clientesdatatable();
  

    $.uploadPreview({
    input_field: "#btnpaddpic",   // Default: .image-upload
    preview_box: "#imgdet1",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Change File",  // Default: Change File
    no_label: true                 // Default: false
  }); 
    

    $.uploadPreview1({
     input_field: "#btnpreppic",   // Default: .image-upload
    preview_box: "#imgdet",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Change File",  // Default: Change File
    no_label: true                 // Default: false
  });       
  
   

} );
////////////////////////////////////////////////////////////
/////////////variables///////////////////////////////////
 
var idproducto = 0;

//$(document).on("load","#btnpaddpic",function(){alert('por atras... atras');} );


///////////////////////////////////////////////////////



function clientesdatatable(){
	
	
	var tablaClientes = $('#clientesDT').DataTable({
		
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "../ajax/inventarioDT.php",
		"aaSorting": [ [1, "desc"] ],
		"aoColumnDefs": [
            //1ra columna
			{ "mRender": function ( data, type, row ) {//imagen
				var prodimg = "";
				
					
						prodimg = '<center><img  style="width:50px;height:50px"   src="http://'+row[4]+'"/></center>';
                return prodimg;
			}, "aTargets": [ 0 ] },
            //2da columna
			{ 	"mRender": function ( data, type, row ) {//sku
				return row[1];
			}, /*"sWidth": "20px",*/ "aTargets": [ 1 ] },
            //3a columna
			{ "mRender": function ( data, type, row ) {//nombre Producto
				return row[3];
			}, "bSortable": true, "aTargets": [ 2 ] },
			{ "mRender": function ( data, type, row ) {//precio
				return row[9];
			}, "bSortable": true, "aTargets": [ 3 ] },
			 //4a columna
			{ "mRender": function ( data, type, row ) {//stok
				return row[5];
			}, "bSortable": true, "aTargets": [ 4 ] },
			 //5a columna
			{ "mRender": function ( data, type, row ) {//pedidos
				return row[6];
			}, "bSortable": true, "aTargets": [ 5 ] },
			 //6a columna
			{ "mRender": function ( data, type, row ) {//disponibles
				return row[7];
			}, "bSortable": true, "aTargets": [ 6 ] },
			 //7a columna
			{ "mRender": function ( data, type, row ) {//comprados
				return row[8];
			}, "bSortable": true, "aTargets": [ 7 ] },
            
             //8a columna
	            { "mRender": function ( data, type, row ) {//actualizar
               var iconoRevisado = "";
				
					
						iconoRevisado = "<center><img title=\"Editar\" style=\"cursor:pointer\"  onclick=\"llenaeditar("+row[0]+")\" src=\"./img/edit.png\"/></center>";
                return iconoRevisado;
				
			
            }, "bSortable": false, "aTargets": [8] },
          
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






///////////////////////////////////////////////////////////



function refresh(){
    
      RefreshTable('#clientesDT', '../ajax/inventarioDT.php');
            //resetarformulario();
            $('#pannel1').css('display','none');  
    
}

function llenaeditar(idprod){
    idproducto =idprod;
    $('#divdetallediario').modal('show');
    //alert(idprod);
    
   $.post('./ajax/producto.php',{idprod:idprod},function(res){


    if(res.idProd > 0)  {  
        
          subproductoslista(idprod);
          $('#divdetallediario').modal('show');
          $('#imgdet').attr('src','http://'+res.url);
          $('#txtsku').val(res.sku);
          $('#txtnombre').val(res.nombre);
          $('#txtdesc').val(res.descripcion);
          $('#cmbcateg').val(res.categ);
          $('#txtcosto').val(res.costo);
          $('#txtprecio').val(res.precio);
          $('#cmbunidad').val(res.unidad);
    
    
    }else{

toasts('No se pudo extraer la información para mostrar. Contacte a Soporte');
}

},"JSON");




}


function GuardarCambios(){
    
    var cmf = confirm('¿Desea guardar los cambios en el inventario?');
    
    if(cmf === true){
        //idproducto;
       var descr = $('#txtdesc').val();
       var exist = $('#txtstok').val();
       var usr = 1;
       
       
       $.post('./ajax/actualizarstock.php',{idpsrod:idproducto,descr:descr,exist:exist,usr:usr },function(res){
           
           if(res.code == 0){
              refresh(); 
             toasts(res.msg); 
             llenaeditar(idproducto);
            // $('#divdetallediario').modal('hide');
             
           }else{
               
            toasts(res.msg);   
           }
       },"JSON");
       
        
    }
    
    
}

function subproductoslista(producto){
    
$('#bodyrows').empty();
    
$.post('./ajax/subproducto.php',{idprod:producto},function(res){
        
      
    $.each(res, function(i, item) {
           
            
    $('#bodyrows').append('<tr><td><img style="height:50px; width:50px" src="http://'+item.surl+'" /></td><td>'+item.idSubProd+'</td><td>'+item.nombre+'</td><td>'+item.precio+'</td><td align="center"><button type="button" class="btn btn-primary" onclick="eliminarsubprod('+item.id+')">Eliminar</button></td></tr>');
        
});
        
        
        
        
    
},"JSON");
    
    
}

function eliminarsubprod(idinf){
    
    var confsp = confirm('Desea eliminar el Subproducto?');
    if(confsp == false){return;}
    
    $.post('./ajax/eliminarSubproducto.php',{idinf:idinf},function(res){
        if(res.cod == 0){
            alert(res.msg); 
            subproductoslista(idproducto);
        }else{
            
           alert(res.msg); 
        }
        
    },"JSON");
    
   
}



 $('#buscaproductos').autocomplete({
    serviceUrl: '/ajax/buscarProductosAC.php',
    onSearchStart			: function (query) {
	$('#txtidprod').val('');
	},
    onSelect: function (suggestion) {
    $("#txtidprod").val(suggestion.data);
    }
  });
  
  
   $('#buscaproductos1').autocomplete({
    serviceUrl: '/ajax/buscarProductosAC.php',
    onSearchStart			: function (query) {
	$('#txtidprod1').val('');
	},
    onSelect: function (suggestion) {
    $("#txtidprod1").val(suggestion.data);
    mustraprod(suggestion.data);
    subproductoslista1(suggestion.data);
    }
  });
  
   $('#buscaproductos2').autocomplete({
    serviceUrl: '/ajax/buscarProductosAC.php',
    onSearchStart			: function (query) {
	$('#txtidprod2').val('');
	},
    onSelect: function (suggestion) {
    $("#txtidprod2").val(suggestion.data);
    mustraprod1(suggestion.data);
    subproductoslista2(suggestion.data);
    }
  });
  
  function agregasub(){
      
      var subprod  = $("#txtidprod").val();
      var cantidad = $("#txtcantidad").val();
      if(cantidad == '' || cantidad< 1){alert('Capture la cantidad del producto mayor que 0'); return}
      if(subprod == -1){alert('Seleccione un producto en la busqueda o capture el id del producto'); return}
      
      var confirmasub = confirm('Desea agregar el producto '+subprod+' Como subproducto?');
      
      
      if(confirmasub == false){return}
      
      $.post('./ajax/agregasubproducto.php',{idproducto:idproducto,subprod:subprod,cantidad:cantidad},function(res){
        
          if(res.cod == 0){
              alert(res.msg);
              subproductoslista(idproducto);
          }else{
              alert(res.msg);
          }
      },"JSON");
      
  }

function nuevoprod(){
    
    $('#divnuevoprod').modal('show');
    
    
}

function guradanuevoprod(){
    var skux        =  $("#txtskuxp").val();
    var nombreprd  =  $("#txtnombrexd").val();
    var descprd    =  $("#txtdescxp").val();
    var categprd   =  $("#cmbcategxp").val();
    var costoprd   =  $("#txtcostoxp").val();
    var precioprd  =  $("#txtprecioxp").val();
    var sfile      =  $('#btnpaddpic').prop('files')[0];
    var unidad     =  $("#cmbunidadxp").val();
    
    if(skux   == ''){alert('Debe capturar SKU del producto'); return;}
    if(nombreprd   == ''){alert('Debe capturar el nombre del producto'); return;}
    if(descprd     == ''){alert('Debe capturar la descripción del producto'); return;}
    //if(categprd    == -1){alert('Seleccione Una categoría'); return;}
    if(costoprd    == ''){alert('Debe capturar costo del producto'); return;}
    if(precioprd   == ''){alert('Debe capturar el precio del producto'); return;}
    if(unidad   == -1){alert('Debe seleccionar una unidad de Medida del Producto'); return;}
    
    
    var confirmalta = confirm('Desea Guardar el nuevo producto?');
    
    if(confirmalta == false){return;}
    
  
    
  
             var dataenv = new FormData(); 
             dataenv.append("sku", skux);
             dataenv.append("nombreprd", nombreprd);
             dataenv.append("descprd", descprd);
             dataenv.append("categprd", categprd);
             dataenv.append('costoprd', costoprd);
             dataenv.append('precioprd', precioprd);
             dataenv.append('unidad', unidad);
             dataenv.append('sfile', sfile);
             console.log(dataenv);
           jQuery.ajax({
    url: './ajax/guardaproducto.php',
    data: dataenv,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    type: 'POST',
    success: function(data){
        alert(data.msg);
        if(data.cod == 0){
            $('#divnuevoprod').modal('hide'); 
             var skux        =  $("#txtskuxp").val();
    $("#txtnombrexd").val('');
    $("#txtdescxp").val('');
    $("#cmbcategxp").val('');
    $("#txtcostoxp").val('');
    $("#txtprecioxp").val('');
 
        }
    }
});
   
    
}

function entradaprods(){
    
     $('#diventprod').modal('show'); 
    
}

function mustraprod(idpordm){
    
   $('#bodyrows1').empty();
    
    $.post('./ajax/producto.php',{idprod:idpordm},function(res){
    
        $('#bodyrows1').append('<tr><td ><img style="height:50px; width:50px" src="http://'+res.url+'" /></td><td>'+res.sku+'</td><td>'+res.nombre+'</td><td>'+res.precio+'</td><td>'+res.stok+'</td><td>'+res.disponible+'</td></tr>');
    },"JSON"); 
   
}

function mustraprod1(idpordm){
    
   $('#bodyrows3').empty();
    
    $.post('./ajax/producto.php',{idprod:idpordm},function(res){
    
        $('#bodyrows3').append('<tr><td ><img style="height:50px; width:50px" src="http://'+res.url+'" /></td><td>'+res.sku+'</td><td>'+res.nombre+'</td><td>'+res.precio+'</td><td>'+res.stok+'</td><td>'+res.disponible+'</td></tr>');
    },"JSON"); 
   
}
function subproductoslista1(producto){
    
$('#bodyrows2').empty();
    
$.post('./ajax/subproducto.php',{idprod:producto},function(res){
        
      
    $.each(res, function(i, item) {
           
            
    $('#bodyrows2').append('<tr><td><img style="height:50px; width:50px" src="http://'+item.surl+'" /></td><td>'+item.idSubProd+'</td><td>'+item.nombre+'</td><td>'+item.precio+'</td><td align="center">'+item.req+'</td><td align="center">'+item.disp+'</td></tr>');
});
        
},"JSON");
    
}

function subproductoslista2(producto){
    
$('#bodyrows4').empty();
    
$.post('./ajax/subproducto.php',{idprod:producto},function(res){
        
      
    $.each(res, function(i, item) {
           
            
    $('#bodyrows4').append('<tr><td><img style="height:50px; width:50px" src="http://'+item.surl+'" /></td><td>'+item.idSubProd+'</td><td>'+item.nombre+'</td><td>'+item.precio+'</td><td align="center">'+item.req+'</td><td align="center">'+item.disp+'</td></tr>');
});
        
},"JSON");
    
}
function agregainventario(){
    
    var idprodz = $("#txtidprod1").val();
    var cantz   = $("#txtcantidad1").val();
    var usrz    = 0;
    
    
    if(idprodz == ''){alert('Debe seleccionar un producto primero'); return;}
    if(cantz < 1 || cantz == ''){alert('Ingrese una Cantidad mayor que cero'); return;}
    
    var conf2 = confirm('Desea Agregar Este Producto al inventario?');
    
    if (conf2 == false){return;}
    
    $.post('./ajax/agragarInventario.php',{idprod:idprodz,cant:cantz,usr:usrz},function(res){
        if(res.cod == 0){
            alert(res.msg);
            mustraprod(idprodz);
            subproductoslista1(idprodz);
        }else{ alert(res.msg); }
        
    },"JSON");
    
    
}


function salidaproductos(){$('#disalprod').modal('show'); }

function salidainventario(){
    
   var prodv = $("#txtidprod2").val();
   var cantv= $("#txtcantidad2").val();
   var razon= $("#cmbrazon").val();
   var usrv = 0;
   if(prodv == ''){alert('Debe seleccionar un Producto'); return;}
   if(cantv == '' || cantv < 1){alert('Ingrese una cantidad mayor que cero'); return;}
   if(razon == -1){alert('Seleccione una razon de salida de Inventario'); return;}
   
 
   $.post('./ajax/salidaInventario.php',{idprod:prodv,cant:cantv,razn:razon,usr:usrv},function(res){
        if(res.cod == 0){
            alert(res.msg);
            mustraprod1(prodv);
            subproductoslista2(prodv);
        }else{ alert(res.msg); }
        
    },"JSON");
   
 
   
}