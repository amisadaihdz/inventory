<?php
 include('login.php');
	session_start();

if(isset($_SESSION['userid'])){
header('Location: inventario.php');
}

?>

<html>
    
<head>
 <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">   
<link rel="stylesheet" type="text/css" href="./css/index.css">
<link href="./css/miredgen.css" rel="stylesheet">
<link href="./css/jquery.dataTables.css" rel="stylesheet">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link href="./css/material-design-iconic-font.css" rel="stylesheet">
<link href="./css/jquery.toastmessage.css" rel="stylesheet">
<style>

body {  
background-image: url(./img/banner.jpg);background-repeat: no-repeat;background-attachment: fixed;
background-size:cover;margin:0px;padding:0px;margin;0
 } 
 

 
 </style>

</head>
<body style="height:100%">
  <center> 
   <!--<video autoplay="autoplay" loop="loop" id="video_background" preload="auto" volume="50"/>
  <source src="./img/banner.mp4" type="video/mp4" />
</video>-->
<div style="width:100%;height:100%;">
     <div style="background-color:rgba(69, 69, 69, 0.67);width:450px;height:500px;margin-top:10%;">
        <form action="" method="post"  >	
            <table>
                
                <tr>
                  
                    <td width="30%" align="center">
                        <span style="color:red"><?php echo $message; ?></span><br/><br/>
                      <img src="./img/logo.png" style="height:150px"/><br/><br/>
                      <span>Acceso a Inventarios</span><br/><br/>
                        <input type="text" class="loginput" id="txtusr" name="txtusr" placeholder="Usuario"><br/><br/>
                        <input type="password" class="loginput" id="txtpass" name="txtpass" placeholder="Password"><br/><br/>
                        
                        <input type="submit" id="button" class="boton" value="Iniciar Sesi&oacute;n"/>
                        
                      
                    </td>
                   
                </tr> 
                
            </table>    
            
         </form>  
      </div>
     </div> 
 </center>
</body>                
    
    <script src="./js/index1.js"></script>
    
    <script src="./js/jquery-2.1.1.min.js" ></script>
<script src="./js/jquery.dataTables.js" ></script> 
<script src="./js/bootstrap.js" ></script>
<script src="./js/jquery.toastmessage.js" ></script>  
<script src="./js/jquery.alphanum.js" ></script>
<script src="./js/jquery.mask.min.js" ></script>  
</html>