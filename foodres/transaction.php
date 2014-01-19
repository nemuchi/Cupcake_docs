<?php
	
	class Transaction {
		public $trans_no;
		public $item_no;
		public $cust_no;
		public $cashier_no;
		public $type;
		public $date_time;
		public $quantity;
		
		public function __construct(){
		}
		
		//getter
		public function getTransNo(){
			return $this->trans_no;
		}
		public function getItemNo(){
			return $this->item_no;
		}
		public function getCustNo(){
			return $this->cust_no;
		}
		public function getCashierNo(){
			return $this->cashier_no;
		}
		public function getType(){
			return $this->type;
		}
		public function getDateTime(){
			return $this->date_time;
		}
		public function getQuantity(){
			return $this->quantity;
		}
		
		//setter
		public function setTransNo($trans_no){
			$this->trans_no=$trans_no;
		}
		public function setItemNo($item_no){
			$this->item_no=$item_no;
		}
		public function setCustNo($cust_no){
			$this->cust_no=$cust_no;
		}
		public function setCashierNo($cashier_no){
			$this->cashier_no=$cashier_no;
		} 
		public function setType($type){
			$this->type=$type;
		}
		public function setDateTime($date_time){
			$this->date_time=$date_time;
		}
		public function setQuantity($quantity){
			$this->quantity=$quantity;
		}
		
		public function countTransaction($stall_no){
			$countquery=mysql_query("select count(t.transaction_no) as totaltransaction
									 from transaction t, stall s, item i
                                     where s.stall_no=i.stall_no and i.item_no=t.item_no and s.stall_no='$stall_no'");
			while($row=mysql_fetch_array($countquery)){
				$count=$row['totaltransaction'];
			}
			return $count;
		}
		
		public function getTransaction($tran_no){
			$tran = "SELECT * FROM transaction WHERE transaction_no='$tran_no'";
			return $tran;
		}
		
		public function setTransaction($tran_no){
			$tran = "SELECT * FROM transaction WHERE transaction_no='$tran_no'";
			$tranq = mysql_query($tran) or die('Cannot query!');
			while($row=mysql_fetch_array($tranq)){
				$this->setItemNo($row['item_no']);
				$this->setCustNo($row['cust_no']);
				$this->setCashierNo($row['cashier_no']);
				$this->setType($row['type']);
				$this->setDateTime($row['date_time']);
				$this->setQuantity($row['quantity']);
			}
		}
		
		public function getStallTransaction($stall_no){
			$gettran = "SELECT c.cust_no,u.fname,u.mname,u.lname,i.category,i.item_name,i.end_time,t.transaction_no,t.quantity,i.price,t.date_time,t.type
						FROM user u, item i, transaction t, customer c, stall s
						WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and s.stall_no='$stall_no'
						ORDER BY t.type";
			return $gettran;
							
		}
		
		public function getTodayTransaction($stall_no){
			$curdate=urlEncode(date("Y-m-d"));
			$todayTrans = "SELECT t.transaction_no, u.fname,u.mname,u.lname,i.category,i.item_name,i.price,t.quantity,t.date_time,t.type
						FROM user u, item i, transaction t, customer c, stall s
						WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and s.stall_no=i.stall_no 
						and s.stall_no='$stall_no' and t.date_time like '%$curdate%' order by t.type";
			return $todayTrans;
		}
		
		public function getCusTransaction($cust_no){
			$cquery = "SELECT t.transaction_no,t.date_time,ca.user_id as cash_id, i.category,i.item_name,i.price,i.start_time,i.end_time,t.quantity,s.stall_name,t.type
							FROM user u, item i, transaction t, customer c, stall s, cashier ca
							WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and s.stall_no=i.stall_no and 
							ca.cashier_no=t.cashier_no and c.cust_no='$cust_no'";
			return $cquery;
		}
		
		public function getfilterTransaction($adstall_no,$acsearch,$transsearch,$statsearch){
			if($statsearch=='statall'){
				//echo 'flag';
				if($acsearch=='tdate'){
					//echo 'flag';
					$tran_query = "SELECT u.fname,u.mname,u.lname,i.category,i.item_name,t.quantity,i.price,t.date_time,t.type
							FROM user u, item i, transaction t, customer c, stall s
							WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and s.stall_no='$adstall_no'
							and t.date_time LIKE '%$transsearch%' LIMIT 0,30";
				}else if($acsearch=='tcat'){
					//echo 'flag';
					$tran_query = "SELECT u.fname,u.mname,u.lname,i.category,i.item_name,t.quantity,i.price,t.date_time,t.type
							FROM user u, item i, transaction t, customer c, stall s
							WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and s.stall_no='$adstall_no'
							and i.category='$transsearch' LIMIT 0,30";
				}else{
					//echo 'flag';
					$tran_query = "SELECT u.fname,u.mname,u.lname,i.category,i.item_name,t.quantity,i.price,t.date_time,t.type
							FROM user u, item i, transaction t, customer c, stall s
							WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and s.stall_no='$adstall_no'
							LIMIT 0,30";
				}
				
			}else{
				if($acsearch=='tdate'){
					$tran_query = "SELECT u.fname,u.mname,u.lname,i.category,i.item_name,t.quantity,i.price,t.date_time,t.type
								FROM user u, item i, transaction t, customer c, stall s
								WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and s.stall_no='$adstall_no'
								and t.date_time LIKE '%$transsearch%' and t.type='$statsearch' LIMIT 0,30";
				}else if($acsearch=='tcat'){
					$tran_query = "SELECT u.fname,u.mname,u.lname,i.category,i.item_name,t.quantity,i.price,t.date_time,t.type
								FROM user u, item i, transaction t, customer c, stall s
								WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and s.stall_no='$adstall_no'
								and i.category='$transsearch' and t.type='$statsearch' LIMIT 0,30";
				}else if($acsearch=='tall'){
					//echo 'flag';
					$tran_query = "SELECT u.fname,u.mname,u.lname,i.category,i.item_name,t.quantity,i.price,t.date_time,t.type
								FROM user u, item i, transaction t, customer c, stall s
								WHERE u.user_id=c.user_id and i.item_no=t.item_no and t.cust_no=c.cust_no and i.stall_no=s.stall_no and s.stall_no='$adstall_no'
								and t.type='$statsearch' LIMIT 0,30";
				}
			}
			return $tran_query;
		}
		
	}
?>