<?php 

session_start();

if(!isset($_SESSION['userid'])){
header('Location: index.php'); // Redirecting To Home Page
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--Favicon-->

<link href="./css/miredgen.css" rel="stylesheet">
<link href="./css/jquery.dataTables.css" rel="stylesheet">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link href="./css/material-design-iconic-font.css" rel="stylesheet">
<link href="./css/jquery.toastmessage.css" rel="stylesheet">
<script>
 
</script>    
    
 
<!--Cierre del Sitio-->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
    <style>
        .mayusculas{
           text-transform: uppercase;
       } 
        div.botones{
            height:30px;
            width:80px;
            background-color: dodgerblue;
            color:white;
            display:inline-flex;
            margin: 10px;
            font-family: Verdana;
            cursor:pointer; 
        }
        p.pbtn{
            margin:5px 0px 10px 15px;
        }
        div.botones:hover{
            background-color: #0e3860;
        
        }
        div#pop1{
            height:100%;
            width:100%;
            position:fixed;
            z-index:100;
            background-color:rgba(173, 173, 250, 0.33);
            display: none;
        }
        p.popsley{
            color:darkred;
            font-family: Verdana;
            font-weight: bold;
            font-size:20px;
           
        }
        section#pannel1{
            
            display:none
        }
        span#nuevospn{
             cursor:pointer;
            background-color:#4474d0;   
            color:white;
        }
        span#nuevospn:hover{
             
            background-color:#a7c2f5;   
            color:#072e50;
        }
        
        .form-control{
            
            height:25px;
            font-size: 11px;
        }
        label{
            /*height:20px;
            margin:0*/
            
                font-size: 11px;
        }
      .porcentaje{
          width:130px;
          
      }
      .autocomplete-suggestions { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-no-suggestion { padding: 2px 5px;}
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: bold; color: #000; }
.autocomplete-group { padding: 2px 5px; font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }
      
      .btncstm{margin-top:15px;}
      
      
    </style>    
   
    <?php //include('menu.php'); ?>
  
     <div id="divdetallediario"  class="modal fade col-xs-12" role="dialog">
        <center>
          <div class="modal-dialog" style="width:70%;">
       <!-- Modal content-->
              <div class="modal-content" style=" max-height:700px">
                   <div class="modal-header">
                      <span > 
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                        <h5 class="modal-title">Actualizaci&oacute;n de Inventario de Prodcto </h5>  
                       
                      </span>
                      
                      
                   </div>
                   <div class="modal-body texto" id="facturastot" style=" max-height:600px;overflow-y:scroll">
                       <div class="panel-body"> 
                          <div class="col-xs-4">
                          	 <img id="imgdet" style="width:250px;height:250px" src=""/>
                          </div>   
                          <div class="col-xs-8">
					           <div class="row">
					               <div class="col-xs-4">
							        <div class="form-group" id="div-rfc">
								        <label>SKU</label>
                                        <input class="form-control mex mayusculas" id="txtsku" maxlength="250" name="" disabled/>
                                    </div>
						           </div>
						          <div class="col-xs-8">
							        <div class="form-group" id="div-rfc">
								        <label>Nombre de Producto</label>
                                        <input class="form-control mex mayusculas" id="txtnombre" maxlength="250" name="" />
                                    </div>
						           </div>
						        </div>
						        <div class="row">
						          <div class="col-xs-12">
							        <div class="form-group" id="div-rfc">
								        <label>Descripci&oacute;n</label>
                                        <input class="form-control mex mayusculas" id="txtdesc" maxlength="50" name=""/>
                                    </div>
						           </div>
						        </div>
						       <div class="row">
						          <div class="col-xs-6">
							        <div class="form-group" id="div-rfc">
								        <label>Categoría</label>
                                        <select class="form-control mex mayusculas" id="cmbcateg"  >
                                        <option value="-1">Seleccione Cateoría</option>
                                        </select>
                                    </div>
						           </div>
						        
						           <div class="col-xs-3">
							        <div class="form-group" id="div-rfc">
								        <label>Costo</label>
                                        <input class="form-control mex mayusculas" id="txtcosto" maxlength="4" name="" type="money" style="text-align:center"/>
                                    </div>
						           </div>
						           <div class="col-xs-3">
							        <div class="form-group" id="div-rfc">
								        <label>Précio</label>
                                        <input class="form-control mex mayusculas" id="txtprecio" maxlength="4" name=""  style="text-align:center"/>
                                    </div>
						           </div>
						        </div>
						      
						          
						          <div class="row">
						          <div class="col-xs-8" align="left">
						              <label>Seleccione Imagen </label>
						              <input type="file"  class=""  id="btnpreppic" sonchange="cambiaimagen();"  />
						              
						          </div>
						            <div class="col-xs-4" align="left">
						              <label>Unidad de Medida</label>
						             <select class="form-control mex mayusculas" id="cmbunidad"  >
                                        <option value="-1">Seleccione Unidad</option>
                                        <option value="1">Pieza</option>
                                        <option value="2">Mililitro</option>
                                        <option value="3">Gramo</option>
                                     </select>
						              
						          </div>
						          </div>
                          </div>   
                        </div>
                   
                     <div class="modal-footer">
                          <div class="col-xs-3" style="text-align:left">
                               <label>Buscar Productos</label>
                               <input type="text"  id="buscaproductos" class="form-control"/>

                          </div>  
                          <div class=" col-xs-2" style="text-align:left">
                               <label>ID Producto:</label>
                                <input type="text"  id="txtidprod" class="form-control"/>  
                          </div> 
                           <div class="form-group col-xs-1" style="text-align:left">
                               <label>Cantidad:</label>
                                <input type="text"  id="txtcantidad" class="form-control"/>  
                          </div> 
                                               
                          <button type="button" class="btn btn-primary btncstm" onclick="agregasub();" >Agregar Subproducto</button>
                          <button type="button" class="btn btn-primary btncstm"  id="btnporAtuorizar" onclick="GuardarCambios();" >Actualizar Producto</button>
                          <button type="button" class="btn btn-default btncstm" id="cerrarmod" data-dismiss="modal">Cerrar</button>
                     </div>
                <div class="modal-body texto" id="facturastot" style=" max-height:600px;overflow-y:scroll">
                      <div class="adv-table">
                   <table class="display table table-bordered table-striped" >
                               <thead>
                                      <tr>
                                          <th width="80px">Img</th>
                                          <th width="100px">ID</th>
                                          <th>Nombre</th>
                                          <th width="150px">Précio</th>
                                          <th width="100px">Eliminar</th>
                                         
                                       </tr>
                                </thead>
                                      
                                <tbody id="bodyrows">
                                    
                                  
                                </tbody>
                        </table>

</div>   
                    
                </div>         
              </div>
           </div>
           </div>
        </center>
    </div>  
<!-- -->
 <div id="diventprod"  class="modal fade col-xs-12" role="dialog">
        <center>
          <div class="modal-dialog" style="width:70%;">
       <!-- Modal content-->
              <div class="modal-content" style=" max-height:700px">
                   <div class="modal-header">
                      <span > 
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                        <h5 class="modal-title">Entrada de Productos </h5>  
                       
                      </span>
                      
                      
                   </div>
                     <div class="modal-body texto" id="facturastot" style=" max-height:600px;overflow-y:scroll">
                    
                    <div class="form-group col-xs-12" style="text-align:center">
                              <div class="col-xs-5" style="text-align:left">
                               <label>Buscar Productos</label>
                               <input type="text"  id="buscaproductos1" class="form-control"/>

                          </div>  
                          <div class=" col-xs-2" style="text-align:left">
                               <label>ID Producto:</label>
                                <input type="text"  id="txtidprod1" class="form-control"/>  
                          </div> 
                           <div class="form-group col-xs-2" style="text-align:left">
                               <label>Cantidad:</label>
                                <input type="number"  id="txtcantidad1" class="form-control"/>  
                          </div> 
                                               
                          <button type="button" class="btn btn-primary btncstm" onclick="agregainventario();" >Agregar Producto</button> 
                                 
                          </div> 
                       
                           
                         <div class="adv-table">
                            <table class="display table  table-striped" >
                               <thead style="height:10px">
                                      <tr style="height:10px">
                                          <th width="80px">Img</th>
                                          <th width="100px">ID</th>
                                          <th>Nombre</th>
                                          <th width="100px">Précio</th>
                                          <th width="80px">Stok</th>
                                          <th width="80px">Disponible</th>
                                         
                                       </tr>
                                </thead>
                                      
                                <tbody id="bodyrows1">
                                    
                                  
                                </tbody>
                         </table>

                      </div> 
                          <div class="form-group col-xs-12" style="text-align:center">
                               <span>Subproductos</span>
                          </div> 
                      <div class="adv-table">
                        <table class="display table table-bordered table-striped" >
                               <thead>
                                      <tr>
                                          <th width="80px">Img</th>
                                          <th width="100px">ID</th>
                                          <th>Nombre</th>
                                          <th width="100px">Précio</th>
                                          <th width="100px">Requerido</th>
                                          <th width="100px">Disponible</th>
                                         
                                       </tr>
                                </thead>
                                      
                                <tbody id="bodyrows2">
                                    
                                  
                                </tbody>
                        </table>

                    </div>   
                    
                </div> 
                     <div class="modal-footer">
                         
                          <button type="button" class="btn btn-default btncstm" id="cerrarmod" data-dismiss="modal">Cerrar</button>
                     </div>
                      
              </div>
           </div>
           </div>
        </center>
    </div>  
<!-- -->

<!-- -->
 <div id="disalprod"  class="modal fade col-xs-12" role="dialog">
        <center>
          <div class="modal-dialog" style="width:70%;">
       <!-- Modal content-->
              <div class="modal-content" style=" max-height:700px">
                   <div class="modal-header">
                      <span > 
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                        <h5 class="modal-title">Salida de Productos </h5>  
                       
                      </span>
                      
                      
                   </div>
                     <div class="modal-body texto" id="facturastot" style=" max-height:600px;overflow-y:scroll">
                    
                    <div class="form-group col-xs-12" style="text-align:center">
                              <div class="col-xs-4" style="text-align:left">
                               <label>Buscar Productos</label>
                               <input type="text"  id="buscaproductos2" class="form-control"/>

                          </div>  
                          <div class=" col-xs-1" style="text-align:left">
                               <label>ID:</label>
                                <input type="text"  id="txtidprod2" class="form-control"/>  
                          </div> 
                           <div class="form-group col-xs-1" style="text-align:left">
                               <label>Cantidad:</label>
                                <input type="number"  id="txtcantidad2" class="form-control"/>  
                          </div> 
                          <div class="form-group col-xs-2" style="text-align:left">
                               <label>Razón:</label>
                                <select type="number"  id="cmbrazon" class="form-control"/> 
                                  <option value="-1">Seleccione</option>
                                  <option value="6">Devolucion Garant</option>
                                  <option value="7">Merma Prod</option>
                                  <option value="8">Dev Subproducto</option>
                                </select>
                          </div> 
                                               
                          <button type="button" class="btn btn-primary btncstm" onclick="salidainventario();" >Salida</button> 
                                 
                          </div> 
                       
                           
                         <div class="adv-table">
                            <table class="display table  table-striped" >
                               <thead style="height:10px">
                                      <tr style="height:10px">
                                          <th width="80px">Img</th>
                                          <th width="100px">ID</th>
                                          <th>Nombre</th>
                                          <th width="100px">Précio</th>
                                          <th width="80px">Stok</th>
                                          <th width="80px">Disponible</th>
                                         
                                       </tr>
                                </thead>
                                      
                                <tbody id="bodyrows3">
                                    
                                  
                                </tbody>
                         </table>

                      </div> 
                          <div class="form-group col-xs-12" style="text-align:center">
                               <span>Subproductos</span>
                          </div> 
                      <div class="adv-table">
                        <table class="display table table-bordered table-striped" >
                               <thead>
                                      <tr>
                                          <th width="80px">Img</th>
                                          <th width="100px">ID</th>
                                          <th>Nombre</th>
                                          <th width="100px">Précio</th>
                                          <th width="100px">Requerido</th>
                                          <th width="100px">Disponible</th>
                                         
                                       </tr>
                                </thead>
                                      
                                <tbody id="bodyrows4">
                                    
                                  
                                </tbody>
                        </table>

                    </div>   
                    
                </div> 
                     <div class="modal-footer">
                         
                          <button type="button" class="btn btn-default btncstm" id="cerrarmod" data-dismiss="modal">Cerrar</button>
                     </div>
                      
              </div>
           </div>
           </div>
        </center>
    </div>  
<!-- -->
     <div id="divnuevoprod"  class="modal fade col-xs-12" role="dialog">
        <center>
          <div class="modal-dialog" style="width:70%;">
       <!-- Modal content-->
              <div class="modal-content" style=" max-height:700px">
                   <div class="modal-header">
                      <span > 
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                        <h5 class="modal-title">Captura de Nuevo Producto </h5>  
                       
                      </span>
                      
                      
                   </div>
                   <div class="modal-body texto" id="facturastot" style=" max-height:600px;overflow-y:scroll">
                       <div class="panel-body"> 
                          <div class="col-xs-4">
                          	 <img id="imgdet1" style="width:250px;height:250px"/>
                          </div>   
                          <div class="col-xs-8">
					           <div class="row">
					               <div class="col-xs-4">
							        <div class="form-group" id="div-rfc">
								        <label>SKU</label>
                                        <input class="form-control mex mayusculas" id="txtskuxp" maxlength="250" name="" />
                                    </div>
						           </div>
						          <div class="col-xs-8">
							        <div class="form-group" id="div-rfc">
								        <label>Nombre de Producto</label>
                                        <input class="form-control mex mayusculas" id="txtnombrexd" maxlength="250" name="" />
                                    </div>
						           </div>
						        </div>
						        <div class="row">
						          <div class="col-xs-12">
							        <div class="form-group" id="div-rfc">
								        <label>Descripci&oacute;n</label>
                                        <input class="form-control mex mayusculas" id="txtdescxp" maxlength="50" name=""/>
                                    </div>
						           </div>
						        </div>
						        <div class="row">
						          <div class="col-xs-6">
							        <div class="form-group" id="div-rfc">
								        <label>Categoría</label>
                                        <select class="form-control mex mayusculas" id="cmbcategxp"  >
                                        <option value="-1">Seleccione Cateoría</option>
                                        </select>
                                    </div>
						           </div>
						        
						           <div class="col-xs-3">
							        <div class="form-group" id="div-rfc">
								        <label>Costo</label>
                                        <input class="form-control mex mayusculas" id="txtcostoxp" maxlength="4" name="" type="money" style="text-align:center"/>
                                    </div>
						           </div>
						           <div class="col-xs-3">
							        <div class="form-group" id="div-rfc">
								        <label>Précio</label>
                                        <input class="form-control mex mayusculas" id="txtprecioxp" maxlength="4" name=""  style="text-align:center"/>
                                    </div>
						           </div>
						        </div>
						         <div class="row">
						          <div class="col-xs-8" align="left">
						              <label>Seleccione Imagen </label>
						              <input type="file"  class=""  id="btnpaddpic"  sonchange="nuevaimagen();" />
						              
						          </div>
						            <div class="col-xs-4" align="left">
						              <label>Unidad de Medida</label>
						             <select class="form-control mex mayusculas" id="cmbunidadxp"  >
                                        <option value="-1">Seleccione Unidad</option>
                                        <option value="1">Pieza</option>
                                        <option value="2">Mililitro</option>
                                        <option value="3">Gramo</option>
                                     </select>
						              
						          </div>
						          </div>
                          </div>   
                        </div>
                   
                     <div class="modal-footer">
                     
                                               
                         
                          <button type="button" class="btn btn-primary"  id="btnporAtuorizar" onclick="guradanuevoprod();" >Guardar Producto</button>
                          <button type="button" class="btn btn-default" id="cerrarmod" data-dismiss="modal">Cancelar</button>
                     </div>
        
              </div>
           </div>
           </div>
        </center>
    </div> 
<!-- -->


    <div style="height:50px;"></div>   

<section class="panel">
<div class="titulorgb-prealta">
<span><i class="fa fa-search"></i></span>
<h3>Inventario de Productos</h3></div>
<div class="panel-bodys">
    <div class="row"  height="20px" >
       <div class="col-xs-12" align="right">
          <div class="form-group">
              <button class="btn btn-xs btn-info  porcentaje" id="busqueda" style="margin-top:20px; margin-right:10px;" onclick="nuevoprod();"> Alta de Productos </button>
              
              <button class="btn btn-xs btn-info  porcentaje" id="busqueda" style="margin-top:20px; margin-right:10px;" onclick="entradaprods();"> Entrada de Productos </button>

            <button class="btn btn-xs btn-info  porcentaje" id="busqueda" style="margin-top:20px; margin-right:10px;" onclick="salidaproductos();"> Salida de Productos </button>
              
              <button class="btn btn-xs btn-info  porcentaje" id="btnexel" style="margin-top:20px; margin-right:10px;" onclick="executaexcel1()"> Excel </button>

         
              
              <button class="btn btn-xs btn-info  porcentaje" id="btnpdf" style="margin-top:20px; margin-right:10px;" onclick="verreporte1()">PDF </button>

            </div>
          </div>     
	</div>                                  <!--Inicio de Tabla Cadena-->
       <div class="adv-table">
                   <table class="display table table-bordered table-striped" id="clientesDT">
                               <thead>
                                      <tr>
                                          <th>img</th>
                                          <th>SKU</th>
                                          <th>Nombre</th>
                                          <th>Précio</th>
                                          <th>stok</th>
                                          <th>Pedidos</th>
                                          <th>disponibles</th>
                                          <th>Comprados</th>
                                          <th>Detalle</th>
                                       </tr>
                                </thead>
                                      
                                <tbody>
                                      <tr class="gradeA">
                                          <td width="200px" > </td>
                                          <td  > </td>
                                          <td width="80px" align="center"> </td>
                                          <td width="80px"> </td>
                                          <td width="80px"> </td>
                                          <td width="50px"> </td>
                                          <td width="50px"> </td>
                                          <td width="50px"> </td>
                                          <td width="50px"> </td>
                                      </tr>
                                  
                                </tbody>
                        </table>

</div>
<!--Cierre Contenido-->
</div>
</section>    

                            
</body>
  
<script src="./js/jquery-2.1.1.min.js" ></script>
<script src="./js/jquery.autocomplete.js" ></script> 
<script src="./js/jquery.dataTables.js" ></script> 
<script src="./js/uploadpreview.js" ></script> 
<script src="./js/inventario.js" ></script>
<script src="./js/bootstrap.js" ></script>
<script src="./js/jquery.toastmessage.js" ></script>  
<script src="./js/jquery.alphanum.js" ></script>
<script src="./js/jquery.mask.min.js" ></script>   

</html>