<?php
	include('user.php');
	class Cashier extends User{
		protected $cashier_no;
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

?>