<?php
	class Item{
		public $item_no;
		public $item_name;
		public $stall_no;
		public $no_servings;
		public $price;
		public $category;
		public $statusForRes;
		public $slotsForRes;
		public $start_time;
		public $end_time;
		
		public function __constructor(){
		}
		
		public function getItemNo(){
			return $this->item_no;
		}
		public function getItemName(){
			return $this->item_name;
		}
		public function getStallNo(){
			return $this->stall_no;
		}
		public function getNoServings(){
			return $this->no_servings;
		}
		public function getPrice(){
			return $this->price;
		}
		public function getCategory(){
			return $this->category;
		}
		public function getStatusForRes(){
			return $this->statusForRes;
		}
		public function getSlotsForRes(){
			return $this->slotsForRes;
		}
		public function getStartTime(){
			return $this->start_time;
		}
		public function getEndTime(){
			return $this->end_time;
		}
		
		public function setItemNo($item_no){
			$this->item_no=$item_no;
		}
		public function setItemName($item_name){
			$this->item_name=$item_name;
		}
		public function setStallNo($stall_no){
			$this->stall_no=$stall_no;
		}
		public function setNoServings($no_servings){
			$this->no_servings=$no_servings;
		}
		public function setPrice($price){
			$this->price=$price;
		}
		public function setCategory($category){
			$this->category=$category;
		}
		public function setStatusForRes($statusForRes){
			$this->statusForRes=$statusForRes;
		}
		public function setSlotsForRes($slotsForRes){
			$this->slotsForRes=$slotsForRes;
		}
		public function setStartTime($start_time){
			$this->start_time=$start_time;
		}
		public function setEndTime($end_time){
			$this->end_time=$end_time;
		}

		public function getItem($item_no){
			$getItem="SELECT * FROM item WHERE item_no='$item_no'";
			return $getItem;
		}
		
		public function setItem($item_no){
			$setItem="SELECT * FROM item WHERE item_no='$item_no'";
			$items = mysql_query($setItem);
			while($row = mysql_fetch_array($items)){
				$this->setItemName($row['item_name']);
				$this->setStallNo($row['stall_no']);
				$this->setNoServings($row['no_servings']);
				$this->setPrice($row['price']);
				$this->setCategory($row['category']);
				$this->setStatusForRes($row['statusForRes']);
				$this->setSlotsForRes($row['slotsForRes']);
				$this->setStartTime($row['start_time']);
				$this->setEndTime($row['end_time']);
			}
		}
		
		public function getItems($stall_no){
			$getitems = "select i.category, i.item_no, i.stall_no, i.item_name, i.no_servings, i.price, i.slotsForRes, i.statusForRes, i.start_time, i.end_time
from item i, stall s where i.stall_no=s.stall_no and s.stall_no='$stall_no' ORDER BY i.slotsForRes DESC";
			return $getitems;
		}
		
		public function getItemCustCashier($category,$stall_no){
			$getitems = "select i.category, i.item_no, i.stall_no, i.item_name, i.no_servings, i.price, i.slotsForRes, i.statusForRes, i.start_time, i.end_time
from item i, stall s where i.stall_no=s.stall_no and s.stall_no='$stall_no' and i.category='$category' and (i.statusForRes='available' or i.statusForRes='sold out') ORDER BY i.slotsForRes DESC";
			return $getitems;
		}
		
		public function upItem($item_no){
			$item_name = $this->item_name;
			$noservings = $this->no_servings;
			$price = $this->price;
			$slots = $this->slotsForRes;
			$status = $this->statusForRes;
			$updated = "update item set item_name='$item_name',no_servings='$noservings',price='$price',slotsForRes='$slots',statusForRes='$status' where item_no='$item_no'";
			return $updated;
		}
		
		
		public function srcItem($item_name){
			$ret = "select * from item where item_name like '%$item_name%'";
			return $ret;
		}
	}
?>