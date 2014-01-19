<?php
	class User{
		protected $user_id;
		protected $userType;
		protected $fname;
		protected $mname;
		protected $lname;
		protected $address;
		protected $gender;
		protected $email;
		protected $phone;
		
		public function __construct(){
			
		}
		
		//getter functions
		public function getUserId(){
			return $this->user_id;
		}
		public function getUserType(){
			return $this->userType;
		}
		public function getFname(){
			return $this->fname;
		}
		public function getMname(){
			return $this->mname;
		}
		public function getLname(){
			return $this->lname;
		}
		public function getGender(){
			return $this->gender;
		}
		public function getAddress(){
			return $this->address;
		}
		public function getEmail(){
			return $this->email;
		}
		public function getPhone(){
			return $this->phone;
		}
		
		//setter functions
		public function setUserId($user_id){
			$this->user_id=$user_id;
		}
		public function setUserType($userType){
			$this->userType=$userType;
		}
		public function setFname($fname){
			$this->fname=$fname;
		}
		public function setMname($mname){
			$this->mname=$mname;
		}
		public function setLname($lname){
			$this->lname=$lname;
		}
		public function setGender($gender){
			$this->gender=$gender;
		}
		public function setAddress($address){
			$this->address=$address;
		}
		public function setEmail($email){
			$this->email=$email;
		}
		public function setPhone($phone){
			$this->phone=$phone;
		}	
	
		
		public function getUser($user_id){
			$user = "SELECT * FROM user WHERE user_id='$user_id'";
			return $user;
		}
		
		public function setUser($user_id){			
			$user = "SELECT * FROM user WHERE user_id='$user_id'";
			$sq = mysql_query($user);
			while($row = mysql_fetch_array($sq)){
				$this->setFname($row['fname']);
				$this->setMname($row['mname']);
				$this->setLname($row['lname']);
				$this->setGender($row['gender']);
				$this->setAddress($row['address']);
				$this->setEmail($row['email']);
				$this->setPhone($row['phone']);
				$this->setUserType($row['userType']);
			}
		}
		
		public function updateUser(){
			$user_id=$this->user_id;
			$fname=$this->fname;
			$mname=$this->mname;
			$lname=$this->lname;
			$gender=$this->gender;
			$phone=$this->phone;
			$email=$this->email;
			$address=$this->address;
			$sql= "UPDATE user SET fname='$fname',mname='$mname',lname='$lname',gender='$gender',phone='$phone',email='$email',address='$address' 
				WHERE user_id='$user_id'" ;
			return $sql;
		}
		
		public function countUser($user_id){
			$count = "SELECT COUNT(*) as users from user where user_id='$user_id'"; 
			return $count;
		}
	}
	

?>
