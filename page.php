
<?php include "inc/header.php";?>
<?php
//get all values from a single id 
    if (!isset($_GET['pageid']) || $_GET['pageid']==NULL) {
        header("Location: 404.php");
    }else{
        $pageId = $_GET['pageid'];
    }
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
            <div class="about">

        <?php 
            $query = "SELECT * FROM page where pageId = '$pageId' ";
            $showPages = $db->select($query);
            if ($showPages) {
                while ($result = $showPages->fetch_assoc()) {
         ?>
    			<h2><?php echo $result['pageName']; ?></h2>
    			<p><?php echo $result['pageBody']; ?></p>
		<?php } } ?>
            </div>
		
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>