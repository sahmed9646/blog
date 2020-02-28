<?php 
	include 'inc/header.php';
	
?>

<?php 
	if (isset($_GET['cat']) && $_GET['cat'] != NULL) {
		$id = $_GET['cat'];  
	}else{
		header("Location:404.php");
	}
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<?php 
			$query = "SELECT * FROM post WHERE catId='$id' ";
			$post = $db->select($query);
			if($post){
				while($result = $post->fetch_assoc()){
		?>
		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
			<h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
			 <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
			<div style="display: block;margin-bottom: 40px"><p><?php echo $fm->textShorten($result['body']); ?></p>
			<div class="readmore clear">
				<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
			</div>
			</div>
			<div><span class="clear"></span></div>
		</div>
		<?php } }else{?>
		<h3>No Post Available Here In This Category</h3>>
		<?php } ?>

<?php include 'inc/sidebar.php';?>	
<?php include 'inc/footer.php';?>