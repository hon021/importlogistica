<?php
require_once('../../utils/user/session.php');
class Querys {
	
    public  $_array;
    public  $procces_array;
    public  $group_procces_array;
    public  $filter_controls_array;
    public  $detalle_array;
    public  $value_replace_array;
    public  $dynatree_childrens_array;

    function __construct()
    {
        $this->_array = array();
        $this->procces_array = array();
        $this->group_procces_array = array();
        $this->detalle_array = array();
        $this->filter_controls_array = array();
        $this->value_replace_array = array();
        $this->dynatree_childrens_array = array();
    }
    
	function loadMainMenu(){

		$user = getSession(USER_SESION);
		open_database();
		$qry =  "select r.db_reports_id, r.db_reports_title, g.db_group_reports_id, g.db_group_reports_name 
				from db_reports r,  db_group_reports g, db_option_reports_user op
				where op.db_reports_id = r.db_reports_id and op.db_user_name = '$user' and g.db_group_reports_id = r.db_group_reports_id and g.db_group_reports_status = 'A' and r.db_reports_status='0' and op.db_option_reports_user_status='A';";
		
		$result = mysql_query($qry) or die(mysql_error());
		close_database();

	        if(mysql_num_rows($result)!=0) {
	        	while($row = mysql_fetch_array($result)) {
	        			
			        $this->_array[$row["db_group_reports_name"]][] = array("db_reports_id"=>$row["db_reports_id"],
							              "db_reports_title"=>$row["db_reports_title"]);

			    }
	        }
	        
	}
	function searchReportsByOption($option_id){
			
		open_database();
		$qry =  "select * from db_reports where db_reports_id = '$option_id';";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		if(mysql_num_rows($result)!=0) {
			$row = mysql_fetch_object($result);		
		}
		return $row;

	}
	
	function searchReportsGroupProcces($option_id){			
		open_database();
		$qry =  "SELECT db_reports_group_procces_id FROM `db_reports_group_procces_intersection_reports` where db_reports_group_procces_intersection_reports_status = 'A' and db_reports_id = '$option_id' order by 	db_reports_group_procces_intersection_reports_order";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		
		if(mysql_num_rows($result)!=0) {
	    	while($row = mysql_fetch_array($result)) {
	        			
				$this->group_procces_array[] = array("db_reports_group_procces_id"=>$row["db_reports_group_procces_id"]);
	  
			    }
	        }
	        
	        
	        	
	}
	
	function searchReportsProccesByGroupProcces($group_procces_id){			
		open_database();
		$qry =  "SELECT 	db_reports_procces.db_reports_procces_id, db_reports_group_procces.db_reports_group_procces_id,
							db_reports_group_procces_intersection_reports_procces.db_reports_group_procces_intersection_reports_procces_order,
							db_reports_procces.db_procces_sql_string, 
							db_reports_group_procces_intersection_reports_procces.db_reports_group_procces_intersection_reports_procces_status
				 FROM		db_reports_group_procces, db_reports_procces,db_reports_group_procces_intersection_reports_procces
				 WHERE   	db_reports_group_procces.db_reports_group_procces_id = db_reports_group_procces_intersection_reports_procces.db_reports_group_procces_id AND
							db_reports_procces.db_reports_procces_id = db_reports_group_procces_intersection_reports_procces.db_reports_procces_id AND
							db_reports_group_procces_intersection_reports_procces.db_reports_group_procces_intersection_reports_procces_status ='A' AND	
							db_reports_group_procces_intersection_reports_procces.db_reports_group_procces_id = '$group_procces_id'
				 ORDER BY 	db_reports_group_procces_intersection_reports_procces.db_reports_group_procces_intersection_reports_procces_order;";
		
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		
		if(mysql_num_rows($result)!=0) {
	    	while($row = mysql_fetch_array($result)) {
	        			
				$this->procces_array[] = array("db_reports_procces_id"=>$row["db_reports_procces_id"],
										"db_reports_group_procces_id"=>$row["db_reports_group_procces_id"],
										"db_reports_procces_order"=>$row["db_reports_group_procces_intersection_reports_procces_order"],
										"db_procces_sql_string"=>$row["db_procces_sql_string"],
							            "db_reports_procces_status"=>$row["db_reports_group_procces_intersection_reports_procces_status"]);	  
			    }
	        }
	
	}
	
	
	function searchReportsFilterControls($option_id){			
		open_database();
		$qry =  "select * from db_reports_filter_controls where db_reports_id = '$option_id' and db_reports_filter_controls_status = 'A' order by db_reports_filter_controls_order;";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		if(mysql_num_rows($result)!=0) {
	    	while($row = mysql_fetch_array($result)) {
	        			
				$this->filter_controls_array[] = array(	"db_reports_filter_controls_id"=>$row["db_reports_filter_controls_id"],
														"db_reports_id"=>$row["db_reports_id"],
														"db_reports_filter_controls_order"=>$row["db_reports_filter_controls_order"],
														"db_reports_filter_controls_name"=>$row["db_reports_filter_controls_name"],
														"db_reports_filter_controls_name_replace"=>$row["db_reports_filter_controls_name_replace"],
														"db_reports_filter_controls_type"=>$row["db_reports_filter_controls_type"],
														"db_reports_fliters_controls_longitude"=>$row["db_reports_fliters_controls_longitude"],
														"db_reports_filters_controls_default_value"=>$row["db_reports_filters_controls_default_value"],
														"db_reports_filter_controls_status"=>$row["db_reports_filter_controls_status"],
											            "db_reports_filter_controls_source"=>$row["db_reports_filter_controls_source"]);	  
			    }
	        }
		
	}
	
	function title_reports_by_id($option_id){			
		open_database();
		$qry =  "select db_reports_title from db_reports where db_reports_id = '$option_id';";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		if(mysql_num_rows($result)!=0) {
	    	while($row = mysql_fetch_array($result)) {
	        		$title = $row["db_reports_title"];
			    }
	        }
		return $title;
	}
	
	function searchValueReplace($option_id){			
		open_database();
		$qry =  "select db_reports_filter_controls_name_replace from db_reports_filter_controls where db_reports_id = '$option_id' order by db_reports_filter_controls_order;";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		
		if(mysql_num_rows($result)!=0) {
	    	while($row = mysql_fetch_array($result)) {
	        			
				$this->value_replace_array[] = array("name_replace"=>$row["db_reports_filter_controls_name_replace"]);	  
			    }
	        }
		
	}
	
	function searchReportsFilterControlsAutocomplete($idControls){			
		open_database();
		$qry =  "select * from db_reports_filter_controls where db_reports_filter_controls_id = '$idControls';";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		if(mysql_num_rows($result)!=0) {
	    	while($row = mysql_fetch_array($result)) {
	        			
				$this->filter_controls_array[] = array(	"db_reports_filter_controls_id"=>$row["db_reports_filter_controls_id"],
														"db_reports_id"=>$row["db_reports_id"],
														"db_reports_filter_controls_order"=>$row["db_reports_filter_controls_order"],
														"db_reports_filter_controls_name"=>$row["db_reports_filter_controls_name"],
														"db_reports_filter_controls_name_replace"=>$row["db_reports_filter_controls_name_replace"],
														"db_reports_filter_controls_type"=>$row["db_reports_filter_controls_type"],
														"db_reports_fliters_controls_longitude"=>$row["db_reports_fliters_controls_longitude"],
														"db_reports_filters_controls_default_value"=>$row["db_reports_filters_controls_default_value"],
														"db_reports_filter_controls_status"=>$row["db_reports_filter_controls_status"],
											            "db_reports_filter_controls_source"=>$row["db_reports_filter_controls_source"]);	  
			    }
	        }
		
	}
	
	function dynatree_search_childrens($idControls, $level){
		
		unset($this->dynatree_childrens_array);
		open_database();
		$qry =  "select * from db_reports_filter_controls_details where db_reports_filter_controls_id = '$idControls' and db_reports_filter_controls_details_level = '$level' and db_reports_filter_controls_details_status = 'A';";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		
		if(mysql_num_rows($result)!=0) {
	    	while($row = mysql_fetch_array($result)) {
	        			
				$this->dynatree_childrens_array[] = array(	"db_reports_filter_controls_details_id"=>$row["db_reports_filter_controls_details_id"],
														"db_reports_filter_controls_id"=>$row["db_reports_filter_controls_id"],
														"db_reports_filter_controls_details_description"=>$row["db_reports_filter_controls_details_description"],
														"db_reports_filter_controls_details_default_value"=>$row["db_reports_filter_controls_details_default_value"],
														"db_reports_filter_controls_details_status"=>$row["db_reports_filter_controls_details_status"]);	  
			    }
	        }
	        
	       return $this->dynatree_childrens_array;
	}
	
	function dynatree_count_childrens($idControls){
		
		open_database();
		$qry =  "select count(*) as total from db_reports_filter_controls_details where db_reports_filter_controls_id = '$idControls' and db_reports_filter_controls_details_status = 'A' ;";
		$result = mysql_query($qry) or die(mysql_error());
		close_database();
		
		if(mysql_num_rows($result)!=0) {
	    	while($row = mysql_fetch_array($result)) {
	        			
				$total = $row["total"];	  
			    }
	        }
	     return $total;
	}
	
}
?>