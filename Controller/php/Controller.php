<?php

class Controller
{
       var $message;

       function execute( $modulo, $accion )
       {

               if( is_callable( array( $modulo , 'validate'.$accion ) ) )
               {        
                       
                       return call_user_func(array( $modulo , 'validate'.$accion));
               }        
               elseif( is_callable( array( $modulo , 'execute'.$accion ) ) )
               {        
                       
                       return call_user_func(array( $modulo , 'execute'.$accion));
               }
               else
               {        
                       echo '<h1>Error 404</h1>';        
                       return null;
               }
       }
}
?>