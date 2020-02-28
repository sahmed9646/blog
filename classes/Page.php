<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath. '/../lib/Database.php');
	include_once ($filepath. '/../helpers/format.php');
?>

<?php 
	/**
	* Page class 
	*/
	class Page{

		private $db; 
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new format();
		}

		public function addPageFromAdmin($data){

			$pageName = $this->fm->validation($data['pageName']);
			$pageBody = $this->fm->validation($data['pageBody']);

			$pageName = mysqli_real_escape_string($this->db->link, $data['pageName']);
			$pageBody = mysqli_real_escape_string($this->db->link, $data['pageBody']);

			if ($pageName=="" || $pageBody=="" ) {
				$msg = "<span style='color:red; font-size:18px'>Field Must Not Empty!!!</span>";
				return $msg;
			}else{

				$query = "INSERT INTO page(pageName, pageBody) VALUES('$pageName', '$pageBody')";

				$insertedRow = $this->db->insert($query);

				if ($insertedRow) {
					$msg = "<span style='color:green; font-size:18px'>Page Created Successfully!!!</span>";
				return $msg;
				}else{
					$msg = "<span style='color:red; font-size:18px'>Page Not Created!!!</span>";
				return $msg;
				}
			}
		}

		public function getPageById($pageId){
			 $query = "SELECT * FROM page WHERE pageId = '$pageId' ";
             $showPages = $this->db->select($query);
             return $showPages;
		}

		public function updatePageFromAdmin($data, $id){
			$pageName = mysqli_real_escape_string($this->db->link, $data['pageName']);
			$pageBody = mysqli_real_escape_string($this->db->link, $data['pageBody']);

			
			if ($pageName=="" || $pageBody=="") {
			$msg = "<span style='color:red; font-size:18px'>Field Must Not Empty!!!</span>";
			return $msg;
			}else{
				$query = "UPDATE page SET
			    		pageName = '$pageName',
			    		pageBody = '$pageBody'
			    		
			    		WHERE pageId = '$id' ";
			    	$updated_row = $this->db->update($query);
			    	if ($updated_row) {
			    		$msg = "<span style='color:green; font-size:18px'>Page Updated Successfully!!!</span>";
					return $msg;
			    	}else{
			    		$msg = "<span style='color:red; font-size:18px'>Page Not Updated !!!</span>";
						return $msg;	
			    	}	
				}
		}
	}
?>		
