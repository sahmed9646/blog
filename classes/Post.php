<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath. '/../lib/Database.php');
	include_once ($filepath. '/../helpers/format.php');
?>

<?php 
	/**
	* Post class 
	*/
	class Post {

		private $db; 
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new format();
		}

		public function addPostFromAdmin($data, $file){

			$title = mysqli_real_escape_string($this->db->link, $data['title']);
			$category = mysqli_real_escape_string($this->db->link, $data['catId']);
			$body = mysqli_real_escape_string($this->db->link, $data['body']);
			$tags = mysqli_real_escape_string($this->db->link, $data['tags']);
			$author = mysqli_real_escape_string($this->db->link, $data['author']);
			$userid = mysqli_real_escape_string($this->db->link, $data['userid']);

			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_tmp = $file['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "upload/".$unique_image;

			if ($title=="" || $category=="" || $file_name=="" || $body=="" || $tags=="" || $author=="" || $userid=="" ) {
				$msg = "<span style='color:red; font-size:18px'>Field Must Not Empty!!!</span>";
				return $msg;
			}else{
				move_uploaded_file($file_tmp, $uploaded_image);
				$query = "INSERT INTO 
				post(title, catId, image, body, tags, author, userid) 
				VALUES('$title', '$category', '$uploaded_image', '$body', '$tags', '$author','$userid' )";
				$insertedRow = $this->db->insert($query);
				if ($insertedRow) {
					$msg = "<span style='color:green; font-size:18px'>Post Added Successfully!!!</span>";
				return $msg;
				}else{
					$msg = "<span style='color:red; font-size:18px'>Post Not Added!!!</span>";
				return $msg;
				}
			}
		}

		public function showAllPost(){
			$query = "SELECT post.*, category.catName FROM post INNER JOIN category ON post.catId = category.catId ORDER BY post.title DESC ";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			}
		}

		public function getPostById($id){
			$query = "SELECT * FROM post WHERE id = '$id' ";
			$result = $this->db->select($query);
			if ($result) {
				return $result;
			}
		}

		public function updatePostFromAdmin($data, $file, $id){
			$title = mysqli_real_escape_string($this->db->link, $data['title']);
			$category = mysqli_real_escape_string($this->db->link, $data['catId']);
			$body = mysqli_real_escape_string($this->db->link, $data['body']);
			$tags = mysqli_real_escape_string($this->db->link, $data['tags']);
			$author = mysqli_real_escape_string($this->db->link, $data['author']);
			$userid = mysqli_real_escape_string($this->db->link, $data['userid']);

			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_tmp = $file['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "upload/".$unique_image;

			if ($title=="" || $category=="" || $body=="" || $tags=="" || $author==""|| $userid=="" ) {
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
				    	$query = "UPDATE post SET
				    		catId = '$category',
				    		title = '$title',
				    		body = '$body',
				    		image = '$uploaded_image',
				    		tags = '$tags',
				    		author = '$author',
				    		userid = '$userid'
				    		WHERE id = '$id' ";
				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span style='color:green; font-size:18px'>Post Updated Successfully!!!</span>";
						return $msg;
				    	}else{
				    		$msg = "<span style='color:red; font-size:18px'>Post Not Updated !!!</span>";
							return $msg;	
				    	}	
				    }
				}else{
					$query = "UPDATE post SET
				    		catId = '$category',
				    		title = '$title',
				    		body = '$body',
				    		tags = '$tags',
				    		author = '$author',
				    		userid = '$userid'
				    		WHERE id = '$id' ";
				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span style='color:green; font-size:18px'>Post Updated Successfully!!!</span>";
						return $msg;
				    	}else{
				    		$msg = "<span style='color:red; font-size:18px'>Post Not Updated !!!</span>";
							return $msg;	
				    	}	
				}
			}
		}

		public function deletePostFromAdmin($id){
			$query = "SELECT * FROM post WHERE id = '$id' ";
			$selected_data = $this->db->select($query);
			if ($selected_data) {
				while ($result = $selected_data->fetch_assoc()) {
					$delImageLink = $result['image'];
					unlink($delImageLink);
				}
			}

			$delQuery = "DELETE FROM post WHERE id = '$id' ";
			$delPost = $this->db->delete($delQuery);
			if ($delPost) {
				$msg = "<span style='color:green; font-size:18px'>Post Deleted Successfully !!!</span>";
				return $msg;
			}
		}	
	}	
?>		