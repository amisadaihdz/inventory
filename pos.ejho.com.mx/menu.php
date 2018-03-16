
		<style type="text/css">
			
			* {
				margin:0px;
				padding:0px;
			}
			
			#header {
				margin:auto;
				width:1000px;
				font-family:Arial, Helvetica, sans-serif;
			}
			
			ul, ol {
				list-style:none;
			}
			.nav {
				
				margin:0 auto; /*Centramos automaticamente*/
			}
			.nav > li {
				float:left;
			}
			
			.nav li a {
				/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#45484d+0,000000+100;Black+3D+%231 */
background: #45484d; /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzQ1NDg0ZCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(left, #45484d 0%, #000000 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(left, #45484d 0%,#000000 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to right, #45484d 0%,#000000 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#45484d', endColorstr='#000000',GradientType=1 ); /* IE6-8 */
				color:#fff;
				text-decoration:none;
				padding:10px 12px;
				display:block;
			}
			
			.nav li a:hover {
				background-color:#434343;
			}
			
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
			}
			
			.nav li:hover > ul {
				display:block;
			}
			
			.nav li ul li {
				position:relative;
			}
			
			.nav li ul li ul {
				right:-140px;
				top:0px;
			}
			
			#encabezado{
			    
			    height:40px;
			    width:100%;
			    position:fixed;
			    background-color:#3f4c6b;
			    z-index:1000;
			}
			
		</style>
<div id="encabezado">
    
		<div id="header">
			<ul class="nav">
				<li style="width:120px"><a href="inventario.php">Inicio</a></li>
				<li style="width:120px"><a href="">Productos</a>
					<ul>
						<li><a href="inventario.php">Menú</a></li>
						<li><a href="">Inventario</a></li>
					</ul>
				</li>
				<li style="width:120px"><a href="">Operaciones</a>
					<ul>
						<li><a href="inventario.php">Pedidos</a></li>
						<li><a href="">Centros de Trabajo</a></li>
						<li><a href="">Punto de Venta</a></li>
						<li><a href="">Corte del día</a></li>
					</ul>
				</li>
				<li style="width:120px"><a href="">Administracion</a>
					<ul>
						<li><a href="">Centros de trabajo</a></li>
						<li><a href="">Mis clientes</a></li>
						<li><a href="">Estado de Cuneta</a></li>
						
					</ul>
				</li>
				
				<li style="width:100%"><a  style="color:pink;text-align:right"><?php echo  $_SESSION["nombre"]?></a></li>
				<li style="width:120px"><a href="logout.php">Cerrar Sesi&oacute;n</a></li>
			
			</ul>
		</div>
	
	</div>	
