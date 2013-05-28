<?php
	
	class Db{
		
		const HOST = "localhost";
		const USER = "bluebonn_bb";
		const PWD = "ec{9%$}J?0d-";
		const DATABASE = "bluebonn_bb";
		
		function __construct(){
			
			$this->handler =  mysql_connect(self::HOST,self::USER,self::PWD);
			if(!$this->handler){
				// echo " connection error";
			}else {
				$this->db =  mysql_select_db(self::DATABASE,$this->handler);
				if(!$this->db){
					 //db selection error
				}else {
				
					//connection to host and db selection done
							
				}
			
			}
		
		
		}

	}

?>