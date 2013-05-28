<?php
	class Pagination{
		public $temp_hostname ="";
		public $total_cnt = 0;
		public $adjacents = 2;
		public $tbl_name = '';
		public $target_page = '';
		public $limit = 10;  //how many items to show per page
		public $page = 0;
		public $start = 0;
		public $pagination = "";
		public $second_last = 0;
		
		public function getStorePagination($total_count,$page_name,$page_no = 0 ){
			//echo $total_count.",".$page_name;exit;
			$this->total_cnt = $total_count;
			$this->target_page = $this->temp_hostname.$page_name;
			$this->page = $page_no;
			
			if($this->page){
				$this->start = ($this->page - 1) * $this->limit; 	//first item to display on this page
			
			}
			if ($this->page == 0) $this->page = 1;					//if no page var is given, default to 1.
			$this->prev = $this->page - 1;						
			$this->next = $this->page + 1;							
			$this->lastpage = ceil($this->total_cnt/$this->limit);	//lastpage is = total pages / items per page, rounded up.
			$this->second_last = $this->lastpage - 1;						
			//echo $this->lastpage;exit;
		
			if($this->lastpage > 1){	
			
				$this->pagination .= "<div class=\"pagination\">";
						
				//$this->pagination .= "<div style=\"margin:0 auto; float:left; text-align:center; padding:3px;width: 92%;\">";
				//previous button
				if ($this->page > 1) 
					$this->pagination.= "<a href=\"$this->target_page&page=$this->prev\"> Prev</a>";
				else
					$this->pagination.= "<span class=\"disabled\">Prev</span>";	
			
				if ($this->lastpage < 7 + ($this->adjacents * 2)){	 
				
					for ($this->counter = 1; $this->counter <= $this->lastpage; $this->counter++){
				
						if ($this->counter == $this->page)
							$this->pagination.= "<span class=\"current\">$this->counter</span>";
						else
							$this->pagination.= "<a href=\"$this->target_page&page=$this->counter\">$this->counter</a>";					
					}
				}
				elseif($this->lastpage > 5 + ($this->adjacents * 2)){
			
					if($this->page < 1 + ($this->adjacents * 2)){		
						for ($this->counter = 1; $this->counter < 4 + ($this->adjacents * 2); $this->counter++){
			
							if ($this->counter == $this->page)
								$this->pagination.= "<span class=\"current\">$this->counter</span>";
							else
								$this->pagination.= "<a href=\"$this->target_page&page=$this->counter\">$this->counter</a>";					
						}
					$this->pagination.= "...";
					$this->pagination.= "<a href=\"$this->target_page&page=$this->second_last\">$this->second_last</a>";
					$this->pagination.= "<a href=\"$this->target_page&page=$this->lastpage\">$this->lastpage</a>";		
				}
			//in middle; hide some front and some back
				elseif($this->lastpage - ($this->adjacents * 2) > $this->page && $this->page > ($this->adjacents * 2)){
			
					$this->pagination.= "<a href=\"$this->target_page/1\">1</a>";
					$this->pagination.= "<a href=\"$this->target_page/2\">2</a>";
					$this->pagination.= "...";
					for ($this->counter = $this->page - $this->adjacents; $this->counter <= $this->page + $this->adjacents; $this->counter++) {
						if ($this->counter == $this->page)
							$this->pagination.= "<span class=\"current\">$this->counter</span>";
						else
							$this->pagination.= "<a href=\"$this->target_page&page=$this->counter\">$this->counter</a>";					
					}
					$this->pagination.= "...";
					$this->pagination.= "<a href=\"$this->target_page&page=$this->second_last\">$this->second_last</a>";
					$this->pagination.= "<a href=\"$this->target_page&page=$this->lastpage\">$this->lastpage</a>";		
				}
				//at the end; only hide early pages
				else{
					$this->pagination.= "<a href=\"$this->target_page/1\">1</a>";
					$this->pagination.= "<a href=\"$this->target_page/2\">2</a>";
					$this->pagination.= "...";
					for ($this->counter = $this->lastpage - (2 + ($this->adjacents * 2)); $this->counter <= $this->lastpage; $this->counter++){
						if ($this->counter == $this->page)
							$this->pagination.= "<span class=\"current\">$this->counter</span>";
						else
							$this->pagination.= "<a href=\"$this->target_page&page=$this->counter\">$this->counter</a>";					
					}
				}
			}
				//next button
				if ($this->page < $this->counter - 1) 
					$this->pagination.= "<a href=\"$this->target_page&page=$this->next\">Next</a>";
				else
					$this->pagination.= "<span class=\"disabled\">Next</span>";
					$this->pagination.= "</div>\n";		
			}
			
			return $this->pagination;
		}
		
		
		public function getPagination($total_count,$page_name,$page_no = 0,$ptype = '' ){
			$this->total_cnt = $total_count;
			$this->target_page = $this->temp_hostname.$page_name;
			if($ptype != ''){
				$this->target_page = $this->temp_hostname.$page_name."/".$ptype;
			}
			//echo $this->target_page;exit;
			//if(isset($_GET['page'])) {
				$this->page = $page_no;
			//}
			if($this->page){
				$this->start = ($this->page - 1) * $this->limit; 	//first item to display on this page
			
			}
			if ($this->page == 0) $this->page = 1;					//if no page var is given, default to 1.
			$this->prev = $this->page - 1;						
			$this->next = $this->page + 1;							
			$this->lastpage = ceil($this->total_cnt/$this->limit);		//lastpage is = total pages / items per page, rounded up.
			$this->second_last = $this->lastpage - 1;						
		
		
			if($this->lastpage > 1){	
			
				$this->pagination .= "<div class=\"pagination\">";
						
				//$this->pagination .= "<div style=\"margin:0 auto; float:left; text-align:center; padding:3px;width: 92%;\">";
				//previous button
				if ($this->page > 1) 
					$this->pagination.= "<a href=\"$this->target_page/$this->prev\"> Prev</a>";
				else
					$this->pagination.= "<span class=\"disabled\">Prev</span>";	
			
				if ($this->lastpage < 7 + ($this->adjacents * 2)){	 
				
					for ($this->counter = 1; $this->counter <= $this->lastpage; $this->counter++){
				
						if ($this->counter == $this->page)
							$this->pagination.= "<span class=\"current\">$this->counter</span>";
						else
							$this->pagination.= "<a href=\"$this->target_page/$this->counter\">$this->counter</a>";					
					}
				}
				elseif($this->lastpage > 5 + ($this->adjacents * 2)){
			
					if($this->page < 1 + ($this->adjacents * 2)){		
						for ($this->counter = 1; $this->counter < 4 + ($this->adjacents * 2); $this->counter++){
			
							if ($this->counter == $this->page)
								$this->pagination.= "<span class=\"current\">$this->counter</span>";
							else
								$this->pagination.= "<a href=\"$this->target_page/$this->counter\">$this->counter</a>";					
						}
					$this->pagination.= "...";
					$this->pagination.= "<a href=\"$this->target_page/$this->second_last\">$this->second_last</a>";
					$this->pagination.= "<a href=\"$this->target_page/$this->lastpage\">$this->lastpage</a>";		
				}
			//in middle; hide some front and some back
				elseif($this->lastpage - ($this->adjacents * 2) > $this->page && $this->page > ($this->adjacents * 2)){
			
					$this->pagination.= "<a href=\"$this->target_page/1\">1</a>";
					$this->pagination.= "<a href=\"$this->target_page/2\">2</a>";
					$this->pagination.= "...";
					for ($this->counter = $this->page - $this->adjacents; $this->counter <= $this->page + $this->adjacents; $this->counter++) {
						if ($this->counter == $this->page)
							$this->pagination.= "<span class=\"current\">$this->counter</span>";
						else
							$this->pagination.= "<a href=\"$this->target_page/$this->counter\">$this->counter</a>";					
					}
					$this->pagination.= "...";
					$this->pagination.= "<a href=\"$this->target_page/$this->second_last\">$this->second_last</a>";
					$this->pagination.= "<a href=\"$this->target_page/$this->lastpage\">$this->lastpage</a>";		
				}
				//at the end; only hide early pages
				else{
					$this->pagination.= "<a href=\"$this->target_page/1\">1</a>";
					$this->pagination.= "<a href=\"$this->target_page/2\">2</a>";
					$this->pagination.= "...";
					for ($this->counter = $this->lastpage - (2 + ($this->adjacents * 2)); $this->counter <= $this->lastpage; $this->counter++){
						if ($this->counter == $this->page)
							$this->pagination.= "<span class=\"current\">$this->counter</span>";
						else
							$this->pagination.= "<a href=\"$this->target_page/$this->counter\">$this->counter</a>";					
					}
				}
			}
				//next button
				if ($this->page < $this->counter - 1) 
					$this->pagination.= "<a href=\"$this->target_page/$this->next\">Next</a>";
				else
					$this->pagination.= "<span class=\"disabled\">Next</span>";
					$this->pagination.= "</div>\n";		
			}
			
			return $this->pagination;
		}
		
	}


?>
