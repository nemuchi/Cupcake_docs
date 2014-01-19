<?php
	include('user.php');
	class Admin extends User{
		protected $admin_no;
		protected $admin_password;
		
		public function __construct(){
			parent::  __construct();
		}
		//getter
		public function getAdminNo(){
			return $this->admin_no;
		}
		public function getAdminPass(){
			return $this->admin_password;
		}
		
		//setter
		public function setAdminNo($admin_no){
			$this->admin_no=$admin_no;
		}
		public function setAdminPass($admin_password) {
			$this->admin_password=$admin_password;
		}
		
		public function getAdmin($user_id){
			$admin = "SELECT * FROM admin WHERE user_id='$user_id'";
			return $admin;
		}
		public function setAdmin($user_id){
			$getAd = "SELECT * FROM admin WHERE user_id='$user_id'";
			$aq = mysql_query($getAd);
			while($row = mysql_fetch_array($aq)){
				$this->setAdminNo($row['admin_no']);
				$this->setAdminPass($row['admin_password']);
			}
		}
		public function addItem($adstall_no, $item_name, $price, $no_servings, $category, $statusForRes, $slotsForRes, $start_time, $end_time){
			if($category == 'Breakfast'){
				$start_time = '08:00:00';
				$end_time = '10:00:00;';
			}
			if($category == 'Lunch'){
				$start_time = '10:00:00';
				$end_time = '13:00:00';
			}
			if($category == 'Snack'){
				$start_time = '08:00:00';
				$end_time = '16:00:00';
			}
			
			$addItem="INSERT INTO item (item_name, no_servings, price, slotsForRes, category, statusForRes, start_time, end_time, stall_no)	
						VALUES('$item_name','$no_servings','$price','$slotsForRes','$category','$statusForRes','$start_time','$end_time','$adstall_no')";
			return $addItem;
		}
		
		public function deleteItem($item_no){
			$delete_Item = "Delete From item where item_no='$item_no'";
			return $delete_Item;
		}
		
		public function updateItem($upaditem_no, $adstall_no, $item_name, $no_servings, $price, $slotsForRes, $statusForRes){
			$updateItem= "UPDATE item SET item_name='$item_name',price='$price',no_servings='$no_servings',slotsForRes='$slotsForRes',statusForRes='$statusForRes' 
					WHERE item_no='$upaditem_no' and stall_no='$adstall_no'" ;
			return $updateItem; 
		}
		
		public function getCustomer($adstall_no){
			$cus = "SELECT DISTINCT c.cust_no,u.fname,u.mname,u.lname,u.gender,u.address,u.phone,u.email,i.category,i.item_name,t.quantity,i.price,t.date_time,t.type
					FROM user u, item i, transaction t, customer c, stall s
					WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and s.stall_no='$adstall_no'
					";
			return $cus;
		}

		public function getDistinctCustomer($adstall_no){
			$cus = "select distinct u.fname, u.mname, u.lname,c.cust_no
					from transaction t, customer c, cashier x, item i, user u, admin a, owns o, stall s
					where a.cashier_no=x.cashier_no and o.admin_no=a.admin_no and o.stall_no=s.stall_no and s.stall_no=o.stall_no and
					u.user_id=c.user_id and c.cust_no=t.cust_no and x.cashier_no=t.cashier_no and i.item_no=t.item_no and s.stall_no='$adstall_no'";
			return $cus;
		}		
		
		public function searchCustomer($adstall_no,$csearch){
			$c_query = "SELECT DISTINCT u.fname, u.mname, u.lname, c.cust_no
						FROM transaction t, customer c, cashier x, item i, user u, admin a, owns o, stall s
						WHERE a.cashier_no = x.cashier_no
						AND o.admin_no = a.admin_no
						AND o.stall_no = s.stall_no
						AND s.stall_no = o.stall_no
						AND u.user_id = c.user_id
						AND c.cust_no = t.cust_no
						AND x.cashier_no = t.cashier_no
						AND i.item_no = t.item_no
						AND s.stall_no='$adstall_no'
						AND (
						u.fname LIKE  '%$csearch%'
						OR u.mname LIKE  '%$csearch%'
						OR u.lname LIKE  '%$csearch%'
						)";
			return $c_query;
		}
		
		public function report($stall_no,$curdate){
			$rep = mysql_query("SELECT SUM( i.price * t.quantity ) AS income
								FROM transaction t, item i, stall s
								WHERE i.stall_no = s.stall_no
								AND i.item_no = t.item_no
								AND t.type =  'completed'
								AND t.date_time LIKE  '%$curdate%'
								AND s.stall_no = '$stall_no'");
			$in='';
			while($row=mysql_fetch_array($rep)){
				//echo $in;
				$in = $row['income'];
			}
			return $in;
		}
	}

?>