<?php

	class SqlQuery extends Db{
	
	
		public function dbQuery($qry) {
		
			$rst = mysql_query($qry);
			return $rst;
		
		
		}
		//
		public function cntNumRows($qry){
			$total_rows  = mysql_num_rows($this->dbQuery($qry));
			return $total_rows;
		
		}
	
		public function getColumnValue($result_set,$colum_name){
			//$col_val = mysql_result($result_set,$row,$colum_name);
			$rst_row = mysql_fetch_array($result_set);
			$col_val = $rst_row["$colum_name"];
			return $col_val;
		
		
		}
		
		public function getSpecificRow($qry){
			$rst  = $this->dbQuery($qry); 
			if(!$rst) {
				return array();

			}else {
				
				return mysql_fetch_array($rst);
	
			}	
		
		
		}
	
	}
	




?>