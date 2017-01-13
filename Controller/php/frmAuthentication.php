<?php
require('../../Lenguage/Spanish/L.sesion.php');
include_once ( "../../Controller/php/apiSmarty.php" );
include_once ( "../../Controller/php/Controller.php" );
include_once ( "../../Controller/cnn/dataBaseConnection.php" );
include_once ( "../../Controller/querys/authenticationQuerys.php" );
require_once('../../System/user/session.php');

class frmAuthentication extends Controller
{	
    private $objSmarty;
    private $objQuerys;
    private $objAccountQuerys;
	private $objSendMail;
	
    function __construct()
    {
    	$this->objSmarty = new ApiSmarty();
        $this->objQuerys = new AuthenticationQuerys();
        $this->objSmarty->template_dir = dirname( __FILE__ ) . "/../templetes";
    }

    function executeAuthentication()
    {
      
	    $username = $_REQUEST['username'];
	    $password = $_REQUEST['password'];
	   
	    $authentication = $this->objQuerys->Authentication($username, $password);
	  
		if($authentication == true){
	        echo json_encode($this->objQuerys->authentication_array);
	    }
	    else if ($authentication == false){
	        echo '{"Usuario":"0"}';
	        
	    }
       
    }
       
    function executeCreateSesion()
    {      
       	$sbUserName= $_REQUEST['UserName'];
       	$IdPerfil= $_REQUEST['IdPerfil'];
       	$IdRol= $_REQUEST['IdRol'];

	    setSession("username", $sbUserName);
	    setSession("idperfil", $IdPerfil);
	    setSession("idrol", $IdRol);
    }
            
}
$objFrmAuthentication = new frmAuthentication();
$strAccion = $_REQUEST['action'];
$objFrmAuthentication->execute( $objFrmAuthentication , $strAccion );
?>