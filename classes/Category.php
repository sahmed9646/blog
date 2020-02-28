<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath. '/../lib/Database.php');
	include_once ($filepath. '/../helpers/format.php');
?>

<?php 
	/**
	* Category class 
	*/
	class Category {

		private $db; 
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new format();
		}

		public function getSingleCatById($id){
			$query = "select * from category where catId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateCategory($catName, $id){
			
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if (empty($catName)) {
				$msg = "<span style='color:red; font-size:18px'>Field Must Not Empty!!!</span>";
				return $msg;
			}else{
				$query = "UPDATE category SET catName='$catName' WHERE catId = '$id' ";
				$updateCategory = $this->db->update($query);
				if ($updateCategory) {
					$msg = "<span style='color:green; font-size:18px'>Category Updated Successfully!!!</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red; font-size:18px'>Category Not Updated!!!</span>";
					return $msg;
				}
			}
		}

		public function deleteCategory($id){
			$query = "DELETE FROM category WHERE catId='$id' ";
			$deleteCat = $this->db->delete($query);
			if ($deleteCat) {
				$msg = "<span style='color:green; font-size:18px'>Category Deleted Successfully!!!</span>";
					return $msg;
			}else{
				$msg = "<span style='color:red; font-size:18px'>Category Not Deleted!!!</span>";
				return $msg;
			}
		}

		public function getAllCat(){
			$query = "SELECT * from category ORDER BY catId";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>