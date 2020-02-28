<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath. '/../lib/Database.php');
	include_once ($filepath. '/../helpers/format.php');
?>

<?php 
	/**
	* User class 
	*/
	class User {

		private $db; 
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new format();
	}
	

		public function addUserByAdmin($data){

			$username = $this->fm->validation($data['userName']);
			$password = $this->fm->validation(md5($data['password']));
			$email     = $this->fm->validation($data['email']);
			$role     = $this->fm->validation($data['role']);

			$username = mysqli_real_escape_string($this->db->link, $username);
			$password = mysqli_real_escape_string($this->db->link, $password);
			$email = mysqli_real_escape_string($this->db->link, $email);
			$role = mysqli_real_escape_string($this->db->link, $role);

			if ($username=="" ||$password=="" ||$role=="" ||$email=="") {
				$msg = "<span style='color:red; font-size:18px'>Field Must Not Be Empty!!!</span>";
				return $msg;
			}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$msg = "<span style='color:red; font-size:18px'>Invalid Email Address!!!</span>";
				return $msg;
			}else{
				$mailQuery = "SELECT * from user where email = '$email' limit 1";
				$mailCheck = $this->db->select($mailQuery);
				if ($mailCheck != false) {
					$msg = "<span style='color:red; font-size:18px'>Email Already Exists!!!</span>";
					return $msg;
				}else{

					$query = "INSERT into user(userName, password, email, role) values('$username', '$password', '$email', '$role')";
					$inserted_row = $this->db->insert($query);
					if ($inserted_row) {
						$msg = "<span style='color:green; font-size:18px'>User Successfully Created!!!</span>";
					return $msg;
					}else{
						$msg = "<span style='color:red; font-size:18px'>User Not Created!!!</span>";
					return $msg;
					}
				}	
			}	
		}

		public function getUserById($userid, $userrole){
			$query = "SELECT * FROM user WHERE id = '$userid' AND role = '$userrole' ";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			}
		}

		public function getUserFromUserlist($userid){
			$query = "SELECT * FROM user WHERE id = '$userid'";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			}
		}

		public function updateUserByUser($data, $userid){

			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$userName = mysqli_real_escape_string($this->db->link, $data['userName']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$details = mysqli_real_escape_string($this->db->link, $data['details']);
			
			if ($name=="" || $userName=="" || $email=="" || $details=="" ) {
				$msg = "<span style='color:red; font-size:18px'>Field Must Not Empty!!!</span>";
				return $msg;
			}else{
				$query = "UPDATE user SET
					    		name = '$name',
					    		userName = '$userName',
					    		email = '$email',
					    		details = '$details'
					    		WHERE id = '$userid' ";
		    	$updated_row = $this->db->update($query);
		    	if ($updated_row) {
		    		$msg = "<span style='color:green; font-size:18px'>User DaTA Updated Successfully!!!</span>";
				return $msg;
		    	}else{
		    		$msg = "<span style='color:red; font-size:18px'>user Data Not Updated !!!</span>";
					return $msg;	
		    	}	
		    }	

		}

		public function getUserlist(){
			$query = "SELECT * FROM user order by id desc ";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			}
		}

		public function deleteUser($id){
			$query = "DELETE FROM user WHERE id='$id' ";
			$deleteUser = $this->db->delete($query);
			if ($deleteUser) {
				$msg = "<span style='color:green; font-size:18px'>User Deleted Successfully!!!</span>";
					return $msg;
			}else{
				$msg = "<span style='color:red; font-size:18px'>User Not Deleted!!!</span>";
				return $msg;
			}
		}
	}
?>		