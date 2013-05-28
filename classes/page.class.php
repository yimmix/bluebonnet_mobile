<?php


class Page extends SqlQuery{
	
	
		
		public function getPageContent($page_name){
			$content = '';
			$qry = "SELECT * FROM pages WHERE url_slug='".$page_name."'";
			
			$rst =  $this->dbQuery($qry); 
			
			if(!$rst){
				// sql execution error
			
			} else{
				$content  =  mysql_result($rst,0,content);
				
				}
				return $content;	
				
			}
	
}





?>