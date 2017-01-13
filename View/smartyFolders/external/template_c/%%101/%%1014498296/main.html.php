<?php /* Smarty version 2.6.1, created on 2014-08-23 22:31:20
         compiled from main.html */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="product" content="Exportaciones">
    <meta name="description" content="Simple responsive css framework">
    <meta name="author" content="Scripts, sas">
    <meta name="keywords" content="js, css, metro, framework, windows 8, metro ui">

    <link href="View/css/metro-bootstrap.css" rel="stylesheet">
    <link href="View/css/metro-bootstrap-responsive.css" rel="stylesheet">
    <link href="View/css/docs.css" rel="stylesheet">
    <link href="View/css/scripts.css" rel="stylesheet">
    <link href="View/js/prettify/prettify.css" rel="stylesheet">

    <!-- Load JavaScript Libraries -->
     <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script src="View/js/jquery/jquery.min.js"></script>
    <script src="View/js/jquery/jquery.widget.min.js"></script>
    <script src="View/js/jquery/jquery.mousewheel.js"></script>
    <script src="View/js/prettify/prettify.js"></script>

    <!-- Metro UI CSS JavaScript plugins -->
    <script src="View/js/load-metro.js"></script>
    <script src="View/js/metro/metro-calendar.js"></script>
    <script src="View/js/metro/metro-datepicker.js"></script>

    <!-- Local JavaScript -->
    <script src="View/js/docs.js"></script>
    <script src="View/js/github.info.js"></script>

     <!-- Personal JavaScript -->
    <script src="View/js/main-control.js"></script>
    <script src="View/js/menu-control.js"></script>
    <script src="View/js/utilities-scripts.js"></script>

    
    <!--JS Modulos -->
    <script type="text/javascript" src="View/js/cliente/cliente-control.js"></script>
    <script type="text/javascript" src="View/js/empleado/empleado-control.js"></script>
    <script type="text/javascript" src="View/js/contenedor/contenedor-control.js"></script>
    <script type="text/javascript" src="View/js/mercancia/mercancia-control.js"></script>
    <script type="text/javascript" src="View/js/caja/caja-control.js"></script>
    <script type="text/javascript" src="View/js/rol/rol-control.js"></script>
    <script type="text/javascript" src="View/js/modulo/modulo-control.js"></script>
    <script type="text/javascript" src="View/js/reporte/reporte-control.js"></script>
    <script type="text/javascript" src="View/js/observacion/observacion-control.js"></script>
    <script type="text/javascript" src="View/js/envio/envio-control.js"></script>

    <title><?php echo $this->_tpl_vars['Label_App']; ?>
</title>

</head>
<body class="metro" style="background-color: #efeae3">

    <!-- Div Menu -->
    <div id="divMenu">
        <div class="navigation-bar dark">
		    <div class="navigation-bar-content container">
		        <a href="/Exportc" class="element">
                    <span class="icon-home"></span>
                        <?php echo $this->_tpl_vars['Label_App']; ?>
 
                    <sup><?php echo $this->_tpl_vars['Label_Version']; ?>
</sup>
                </a>
		        <span class="element-divider"></span>
		
		        <a class="element1 pull-menu" href="#"></a>
		        <ul class="element-menu">
		            <li>
		             <a href="#" id="idLogin"><?php echo $this->_tpl_vars['Label_Login']; ?>
</a>
		            </li>
		            
		            <li>
		              <a href="#" id="idAbout"><?php echo $this->_tpl_vars['Label_About']; ?>
</a>
		            </li>
		            
		        </ul>
		       
		    </div>
		</div>
    </div>
    
    <!-- Div Principal -->
    <div id="divMain">
        <div style="background: url(View/images/b1.jpg) top left no-repeat; background-size: cover; height: 300px;">
            <div class="container" style="padding: 50px 20px">
                <h1 class="fg-white"><?php echo $this->_tpl_vars['Label_App']; ?>
</h1>
            </div>
        </div>
            
        <div class="bg-steel" style="padding: 150px">
               <!--   
               <div class="place-right">
                    <img src="View/images/logo_@2x.png"/>
               </div>
               -->
               <h2 class="fg-white ntm">Profesionales a su disposicion</h2>
              
        
            <div class="fg-white" >
                2014, <?php echo $this->_tpl_vars['Label_App']; ?>
 &copy; by  <a href="mailto:info@scriptsteam.com" class="fg-yellow">Scripts SAS</a>
            </div>
        
        </div>
        
    </div>
    
    <!--Cargando-->
	<div id="cargando" hidden="true" style="z-index: 100009; position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; background: #000000; filter: alpha(opacity =60); -moz-opacity: 0.6; opacity: 0.6;">
	    <div align="center">
			<img src="View/images/cargando.gif" alt="image04" style="margin-top: 22%;width: 50px" />
		</div>
    </div> 
    <!--Fin Cargando-->
    

    <script src="View/js/hitua.js"></script>

</body>
</html>