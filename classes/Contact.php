<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath. '/../lib/Database.php');
	include_once ($filepath. '/../helpers/format.php');
?>

<?php 
	/**
	* Contact class 
	*/
	class Contact {

		private $db; 
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new format();
		}

		public function getAllMessageFromUser(){
			$query = "SELECT * from contact where status='0' order by id desc ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getSeenMessageFromAdmin(){
			$query = "SELECT * from contact where status='1' order by id desc ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getDraftsMessage(){
			$query = "SELECT * from contact where status='2' order by id desc ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getMessageById($id){
			$query = "SELECT * from contact where id = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function msgSeenToDrafts($drftmsgid){
			$query = "UPDATE contact SET status = '2' WHERE id = '$drftmsgid' ";
	    	$updated_row = $this->db->update($query);
	    	if ($updated_row) {
	    		$msg = "<span style='color:green; font-size:18px'>message moved to Drafts Successfully!!!</span>";
			return $msg;
	    	}else{
	    		$msg = "<span style='color:red; font-size:18px'>Something went Wrong!!!</span>";
				return $msg;	
	    	}	
		}

		public function msgSentToSeenBox($seenId){
			$query = "UPDATE contact SET status = '1' WHERE id = '$seenId' ";
			    	$updated_row = $this->db->update($query);
			    	if ($updated_row) {
			    		$msg = "<span style='color:green; font-size:18px'>message moved to seen box Successfully!!!</span>";
					return $msg;
			    	}else{
			    		$msg = "<span style='color:red; font-size:18px'>Something went Wrong!!!</span>";
						return $msg;	
			    	}	
		}

		public function msgSeenToInBox($unseenId){
			$query = "UPDATE contact SET status = '0' WHERE id = '$unseenId' ";
			    	$updated_row = $this->db->update($query);
			    	if ($updated_row) {
			    		$msg = "<span style='color:green; font-size:18px'>message moved to inbox Successfully!!!</span>";
					return $msg;
			    	}else{
			    		$msg = "<span style='color:red; font-size:18px'>Something went Wrong!!!</span>";
						return $msg;	
			    	}	
		}

		public function msgSentFromAdmin($data, $id){
			$to = $data['toEmail'];
			$from = $data['fromEmail'];
			$subject = $data['subject'];
			$message = $data['message'];

			$sendMail = mail($to, $subject, $message, $from);
			if ($sendMail) {
				$msg = "<span style='color:green; font-size:18px'>Message Sent Successfully!!!</span>";
				return $msg;
			}else{
				$msg = "<span style='color:red; font-size:18px'>Something Went Wrong,,Try Again!!!</span>";
				return $msg;
			}
		}	

		public function deleteMsg($delId){
			$query = "DELETE FROM contact WHERE id='$delId' ";
			$deleteMsg = $this->db->delete($query);
			if ($deleteMsg) {
				$msg = "<span style='color:green; font-size:18px'>Message Deleted Successfully!!!</span>";
					return $msg;
			}else{
				$msg = "<span style='color:red; font-size:18px'>Message Not Deleted!!!</span>";
				return $msg;
			}
		}
		
	}
?>