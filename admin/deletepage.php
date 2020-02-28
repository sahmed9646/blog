<?php 
    include '../lib/Session.php';
    Session::checkSession();
?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>



<?php 
    $db = new Database();
?>

<?php 
	if (isset($_GET['delpage'])) {
		$id = $_GET['delpage'];
		
		$query = "DELETE FROM page WHERE pageId='$id' ";
		$deletePage = $db->delete($query);
		if ($deletePage) {
			echo "<script>alert('Page deleted successfully');</script>";
			echo "<script>window.location='index.php';</script>";
		}else{
			echo "<script>alert('Page Not Deleted');</script>";
			echo "<script>window.location='index.php';</script>";
		}
	}else{
		echo "<script>window.location='index.php';</script>";
	}	
?>