<?php
	class Owns{
		public $admin_no;
		public $stall_no;
		
		public function __construct(){
		}
		
		//getter
		public function getAdminNo(){
			return $this->admin_no;
		}
		
		public function getStallNo(){
			return $this->stall_no;
		}
		
		//setter
		public function setAdminNo($admin_no){
			$this->admin_no=$admin_no;
		}
		
		public function setStallNo($stall_no){
			$this->stall_no=$stall_no;
		}
		
		public function getOwns($admin_no){
			$getOwn = "SELECT * FROM owns WHERE admin_no='$admin_no'";
			return $getOwn;
		}
		
		public function setOwns($admin_no){
			$getOwn = mysql_query("SELECT * FROM owns WHERE admin_no='$admin_no'");
			while($row=mysql_fetch_array($getOwn)){
				$this->setStallNo($row['stall_no']);
			}
		}

	}
?>