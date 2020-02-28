<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath. '/../lib/Database.php');
	include_once ($filepath. '/../helpers/format.php');
?>

<?php 
	/**
	* TitleSloganSocial class 
	*/
	class TitleSloganSocial {

		private $db; 
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new format();
		}

		public function updateTitleSlogan($data, $file){

			$title = $this->fm->validation($data['title']);
			$slogan = $this->fm->validation($data['slogan']);

			$title = mysqli_real_escape_string($this->db->link, $title);
			$slogan = mysqli_real_escape_string($this->db->link, $slogan);

			$permited = array('png');
			$file_name = $file['logoImage']['name'];
			$file_size = $file['logoImage']['size'];
			$file_tmp = $file['logoImage']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$same_image = 'logoImage'.'.'.$file_ext;
			$uploaded_image = "upload/".$same_image;

			if ($title=="" || $slogan=="") {
				$msg = "<span style='color:red; font-size:18px'>Field Must Not Empty!!!</span>";
				return $msg;
			}else{
				if (!empty($file_name)) {

					if ($file_size >1048567) {
     					$msg = "<span class='error'>Image Size should be less then 1MB!
				     	</span>";
				     	return $msg;
				    } elseif (in_array($file_ext, $permited) === false) {
					    $msg = "<span class='error'>You can upload only:-"
					     .implode(', ', $permited)."</span>";
					    return $msg;
				    }else{
				    	move_uploaded_file($file_tmp, $uploaded_image);
				    	$query = "UPDATE title_slogan SET
					    		title = '$title',
					    		slogan = '$slogan',
					    		logoImage = '$uploaded_image'
					    		WHERE id = '1' ";
				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span style='color:green; font-size:18px'>description Updated Successfully!!!</span>";
						return $msg;
				    	}else{
				    		$msg = "<span style='color:red; font-size:18px'>description Not Updated !!!</span>";
							return $msg;	
				    	}	
				    }
				}else{
					$query = "UPDATE title_slogan SET
				    		title = '$title',
				    		slogan = '$slogan'
				    		WHERE id = '1' ";
				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span style='color:green; font-size:18px'>description Updated Successfully!!!</span>";
						return $msg;
				    	}else{
				    		$msg = "<span style='color:red; font-size:18px'>description Not Updated !!!</span>";
							return $msg;	
				    	}	
					}
				}
			}

			public function viewSocialData(){
				$query = "SELECT * FROM social WHERE id = '1' ";
				$result = $this->db->select($query);
				return $result;
			}

			public function updateSocialMedia($data){
				$facebook = $this->fm->validation($data['facebook']);
				$twitter = $this->fm->validation($data['twitter']);
				$linkedin = $this->fm->validation($data['linkedin']);
				$googleplus = $this->fm->validation($data['googleplus']);

				$facebook = mysqli_real_escape_string($this->db->link, $facebook);
				$twitter = mysqli_real_escape_string($this->db->link, $twitter);
				$linkedin = mysqli_real_escape_string($this->db->link, $linkedin);
				$googleplus = mysqli_real_escape_string($this->db->link, $googleplus);

				if ($facebook=="" || $twitter=="" || $linkedin=="" || $googleplus=="") {
				$msg = "<span style='color:red; font-size:18px'>Field Must Not Empty!!!</span>";
				return $msg;
				}else{
					$query = "UPDATE social SET
				    		facebook = '$facebook',
				    		twitter = '$twitter',
				    		linkedin = '$linkedin',
				    		googleplus = '$googleplus'
				    		WHERE id = '1' ";
				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span style='color:green; font-size:18px'>Social Media Updated Successfully!!!</span>";
						return $msg;
				    	}else{
				    		$msg = "<span style='color:red; font-size:18px'>Social Media Not Updated !!!</span>";
							return $msg;	
				    	}	
					}
			}

			//copyright section
			public function viewCopyrightText(){
				$query = "SELECT * FROM copyright WHERE id = '1' ";
				$result = $this->db->select($query);
				return $result;
			}

			public function updateCopyrightText($data){
				$ctext = $this->fm->validation($data['ctext']);
				
				$ctext = mysqli_real_escape_string($this->db->link, $ctext);
				
				if ($ctext=="") {
				$msg = "<span style='color:red; font-size:18px'>Field Must Not Empty!!!</span>";
				return $msg;
				}else{
					$query = "UPDATE copyright SET
				    		ctext = '$ctext'
				    		WHERE id = '1' ";
				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span style='color:green; font-size:18px'>Copyright text Updated Successfully!!!</span>";
						return $msg;
				    	}else{
				    		$msg = "<span style='color:red; font-size:18px'>SCopyright text Not Updated !!!</span>";
							return $msg;	
				    	}	
					}
			}
	}
?>		