<?php
	include('user.php');
//////////////////////////////////////////////////////Class Admin
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
		
		public function updateItem($upaditem_no, $adstall_no, $item_name, $no_servings, $price, $slotsForRes){
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
	}

//////////////////////////////////////////////////////Class Cashier

	class Cashier extends User{
		protected $cashier;
		protected $cashier_password;
		
		public function __construct(){
			parent::__construct();
		}
		//getter
		public function getCashierNo() {
			return $this->cashier_no;
		} 
		
		public function getCashierPass(){
			return $this->cashier_password;
		}
		
		//setter
		public function setCashierNo($cashier_no){
			$this->cashier_no=$cashier_no;
		}
		
		public function setCashierPass($cashier_password){
			$this->cashier_password=$cashier_password;
		}
		
		public function  getCashier($user_id){
			$cashier = "SELECT * FROM cashier WHERE user_id='$user_id'";
			return $cashier;
		}
		public function setCashier($user_id){
			$getCash = "SELECT * FROM cashier WHERE user_id='$user_id'";
			$cq = mysql_query($getCash);
			while($row = mysql_fetch_array($cq)){
				$this->setCashierNo($row['cashier_no']);
				$this->setCashierPass($row['cashier_password']);
			}
		}
		public function updateTransaction($type,$transaction_no){
			$updateTrans = "UPDATE transaction set type='$type' where transaction_no='$transaction_no'";
			return $updateTrans;
		}
	
	}
//////////////////////////////////////////////////////Class Customer
	class Customer extends User{
		protected $cust_no;
		private $cust_password;
		
		public function __construct(){
			parent::__construct();
		}
		
		//getter
		public function getCustNo(){
			return $this->cust_no;
		}
		
		public function getCustPass(){
			return $this->cust_password;
		}
		
		//setter
		public function setCustNo($cust_no){
			$this->cust_no=$cust_no;
		}
		
		public function setCustPass($cust_password){
			$this->cust_password=$cust_password;
		}
		
		public function getCustomer($user_id){
			$cust = "SELECT * FROM customer WHERE user_id='$user_id'";
			return $cust;
		}
		
		public function setCustomer($user_id){
			$getCust = "SELECT * FROM customer WHERE user_id='$user_id'";
			$custq = mysql_query($getCust);
			while($row = mysql_fetch_array($custq)){
				$this->setCustNo($row['cust_no']);
				$this->setCustPass($row['cust_password']);
			}
		}
		public function updateCustomer(){
			$custpass = $this->cust_password;
			$cust_no = $this->cust_no;
			$sql= "UPDATE customer SET cust_password='$custpass'
					WHERE cust_no='$cust_no'" ;
			return $sql;
		}
		
		//register customer
		public function addCustomer(){
			$user_id = $this->user_id;
			$fname = $this->fname;
			$mname = $this->mname;
			$lname = $this->lname;
			$gender = $this->gender;
			$address = $this->address;
			$cphone = $this->phone;
			$email = $this->email;
			$cust_pass = $this->cust_password;
			$usersq="INSERT INTO user(user_id, fname, mname, lname, gender, address, email, phone, userType)	 
						VALUES ('$user_id','$fname','$mname','$lname','$gender','$address','$email','$cphone','customer')";
			if (!mysql_query($usersq))
				die('Error: ' . mysql_error());
			
			$custsq="INSERT INTO customer (user_id, cust_password)	 
						VALUES ('$user_id','$cust_pass')";
						
			return $custsq;
		}
		
		public function createTransaction($transaction_no,$cust_no,$stall_no,$item_no,$quantity){
			$getcash_no = mysql_query("select a.cashier_no from owns o, admin a, stall s where s.stall_no=o.stall_no and a.admin_no=o.admin_no and s.stall_no='$stall_no'");
			$cashier_no='';
			while($row = mysql_fetch_array($getcash_no)){
				$cashier_no=$row['cashier_no'];
			}
			$reserve = "insert into transaction(transaction_no,item_no,cust_no,cashier_no,quantity)
						values('$transaction_no','$item_no','$cust_no','$cashier_no','$quantity')";
			return $reserve;
		}
		
		public function cancelTransaction($transaction_no){
			$cancelTran = "Update transaction set type='canceled' where transaction_no='$transaction_no'";
			return $cancelTran;
		}
		
		public function getCustTransaction(){
			$cust_no = $this->getCustNo();
			$trans = new Transaction();
			return getCusTransaction($cust_no);
		}
		
		public function countTransaction($cust_no){
			   $cc = "select count(cust_no) as tor from transaction where cust_no='$cust_no'";
			   return $cc;
		}
		
	}
    
?>