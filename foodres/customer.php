<?php
	include('user.php');
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
	
	//$louie = new Customer();
	//$louie->setPhone('09263458910');
	//echo $louie->getPhone();
	
?>
