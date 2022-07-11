<?php

//insertion;
$data = array();
$data = $_POST;

   
   function sanitate($array,$conn) {
	   foreach($array as $key=>$value) {
		  if(is_array($value)) { sanitate($value,$conn); }
		  else { $array[$key] = mysqli_real_escape_string($conn,$value); }
	   }
	   return $array;
	}
	
    function autoInsert($table_name, $data,$conn,$execption='')
     {
		$data = sanitate($data,$conn);

         $fields = array_keys($data);
		 
		if($execption!=''){
			$key = array_search($execption, $fields);
			unset($fields[$key]);
			unset($data[$execption]);
		}
		
		
		/* 	var_dump($fields);
			echo "<br />";echo "<br />";echo "<br />";
			var_dump($data); */
			
         $query = "INSERT INTO `".$table_name."` (`".implode('`,`', $fields)."`) 
                   VALUES('".implode("','", $data)."')";

			//echo $query;
         return mysqli_query($conn,$query);
     }


//modification;
function autoUpdate($table_name, $data,$conn , $where='')
     {
     // check for optional where clause
        $whereSQL = '';
        if(!empty($where))
        {
     // check to see if the 'where' has been passed
          if(substr(strtoupper(trim($where)), 0, 5) != 'WHERE')
          {
          // if not found, add key word
            $whereSQL = " WHERE ".$where;
          } 
          else
          {
            $whereSQL = " ". strtoupper(trim($where));
          }
        }

      $query = "UPDATE `".$table_name."` SET ";
      $sets = array();

     foreach($data as $column => $value)
     {
        $sets[] = "`".$column."` = '".$value."'";
     }
        $query .= implode(', ', $sets);

     // append the where statement
       $query .= $whereSQL;
       return mysqli_query($conn,$query);
     }
	 
	//selection;
 function autoSelect($table,$cols,$conn,$where_clause='') 
    {
        $whereSQL = '';
		
		if($cols=="all"){
			$comma_seperated_fields = "*";
		}else{
			$fields_arr = explode("^", $cols); //explode into an array the incoming string which is seperated with symbol ^
			$comma_seperated_fields = implode("`,`", $fields_arr); //takes the array fields and creates the selected fields for SQL
			$comma_seperated_fields = " ".$comma_seperated_fields." ";
		}

        if(!empty($where_clause))
        {
            if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE') // check to see if the 'where' word exists in the incoming variable
            {
                $whereSQL = " WHERE ".$where_clause;
            } 
            else
            {
                $whereSQL = " ".strtoupper(trim($where_clause));
            }
        }

        $sql = "SELECT ".$comma_seperated_fields." FROM ".$table.$whereSQL;
		// echo $sql;
		return mysqli_query($conn,$sql);
	}
	
	 
	 
	 
?>