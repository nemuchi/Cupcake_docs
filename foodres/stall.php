<?php
	mysql_connect("localhost","root","") or	 
		die ("Could not connct to database"); 
	mysql_select_db("csc181") or	 
		die ("Could not select database");

	class Stall{
		public $stall_no;
		public $stall_name;
		public $canteen_loc;
		public $description;
		
		public function __construct(){
		}
		
		//getter
		public function getStallNo(){
			return $this->stall_no;
		}
		public function getStallName(){
			return $this->stall_name;
		}	
		public function getCanteenLoc(){
			return $this->canteen_loc;
		}
		public function getDes(){
			return $this->description;
		}	
		
		//setter
		public function setStallNo($stall_no){
			$this->stall_no=$stall_no;
		}
		public function setStallName($stall_name){
			$this->stall_name=$stall_name;
		}
		public function setCanteenLoc($canteen_loc){
			$this->canteen_loc=$canteen_loc;
		}
		public function setDes($description){
			$this->description=$description;
		}
		
		public function getStall($stall_no){
			$getStall = "SELECT * FROM stall WHERE stall_no='$stall_no'";
			return $getStall;
		}
		
		public function getStallbyLoc($canteen_loc){
			$getStall = "SELECT * FROM stall WHERE canteen_loc='$canteen_loc'";
			return $getStall;
		}
		
		public function setStall($stall_no){
			$setStall = "SELECT * FROM stall WHERE stall_no='$stall_no'";
			$stalls = mysql_query($setStall);
			while($row = mysql_fetch_array($stalls)){
				$this->setStallName($row['stall_name']);
				$this->setCanteenLoc($row['canteen_loc']);
				$this->setDes($row['description']);
			}
		}
	}
	
?>