<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath. '/../lib/Database.php');
	include_once ($filepath. '/../helpers/format.php');
?>

<?php 
	/**
	* Slider class 
	*/
	class Slider {

		private $db; 
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new format();
		}
	
		public function addSliderFromAdmin($data, $file){

			$title = mysqli_real_escape_string($this->db->link, $data['title']);
			$link = mysqli_real_escape_string($this->db->link, $data['link']);

			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_tmp = $file['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "upload/slider/".$unique_image;


			if ($title=="" || $link=="" || $file_name==""  ) {
				$msg = "<span style='color:red; font-size:18px'>Field Must Not Empty!!!</span>";
				return $msg;
			}else{
				move_uploaded_file($file_tmp, $uploaded_image);
				$query = "INSERT INTO 
				slider(title, link, image) 
				VALUES('$title', '$link', '$uploaded_image')";
				$insertedRow = $this->db->insert($query);
				if ($insertedRow) {
					$msg = "<span style='color:green; font-size:18px'>Slider Added Successfully!!!</span>";
				return $msg;
				}else{
					$msg = "<span style='color:red; font-size:18px'>Slider Not Added!!!</span>";
				return $msg;
				}
			}
		}

		public function showAllSlider(){
			$query = "SELECT * FROM slider ORDER BY id DESC ";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			}
		}

		public function getsliderById($sliderId){
			$query = "SELECT * FROM slider WHERE id = '$sliderId' ";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			}
		}

		public function updateSliderFromAdmin($data, $file, $sliderId){
			$title = mysqli_real_escape_string($this->db->link, $data['title']);
			$link = mysqli_real_escape_string($this->db->link, $data['link']);


			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_tmp = $file['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "upload/slider/".$unique_image;

			if ($title=="" ) {
				$msg = "<span style='color:red; font-size:18px'>Field Must Not Empty!!!</span>";
				return $msg;
			}if (!empty($file_name)) {

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
				    	$query = "UPDATE slider SET
				    			title = '$title',
				    			link = '$link',
				    			image = '$uploaded_image'
				    			WHERE id = '$sliderId' ";
				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span style='color:green; font-size:18px'>Slider Updated Successfully!!!</span>";
						return $msg;
				    	}else{
				    		$msg = "<span style='color:red; font-size:18px'>Slider Not Updated !!!</span>";
							return $msg;	
				    	}	
				    }
				}else{
					$query = "UPDATE slider SET
				    		title = '$title',
				    		link = '$link'
				    		WHERE id = '$sliderId' ";
				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span style='color:green; font-size:18px'>Slider Updated Successfully!!!</span>";
						return $msg;
				    	}else{
				    		$msg = "<span style='color:red; font-size:18px'>Slider Not Updated !!!</span>";
							return $msg;	
				    	}	
				}	
		}

		public function deleteSliderFromAdmin($id){
			$query = "SELECT * FROM slider WHERE id = '$id' ";
			$selected_data = $this->db->select($query);
			if ($selected_data) {
				while ($result = $selected_data->fetch_assoc()) {
					$delImageLink = $result['image'];
					unlink($delImageLink);
				}
			}

			$delQuery = "DELETE FROM slider WHERE id = '$id' ";
			$delSlider = $this->db->delete($delQuery);
			if ($delSlider) {
				$msg = "<span style='color:green; font-size:18px'>Slider Deleted Successfully !!!</span>";
				return $msg;
			}
		}

		public function showSlideInFrontView(){
			$query = "SELECT * FROM slider order by id limit 5 ";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			}
		}
	}	
?>		
