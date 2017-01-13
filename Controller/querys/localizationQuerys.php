<?php
class localizationQuerys {

    public  $localization_array;
    public  $localizationAdministrator_array;

    function __construct()
    {
        $this->localization_array[] = array();
        $this->localizationAdministrator_array = array();
    }
    
    
	function getLocalization (){

		open_database();
		$qry =  "SELECT IdLocalizacion, Nombre FROM localizacion";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();

		if(mysql_num_rows($result)!=0) {
			 
			while($row = mysql_fetch_array($result)) {

				$this->localization_array[] = array("IdLocalizacion"=>$row["IdLocalizacion"],
										        "Nombre"=>$row["Nombre"]
				);

			}
			return true;
		}
		else{
			return false;
		}
	}
}
?>