<?php include 'inc/header.php';?>

<?php
	if (!isset($_GET['id']) || $_GET['id']==NULL) {
		header("Location:404.php");
	}else{
		$id = $_GET['id'];
	}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
			<?php
				$query = "SELECT * FROM post WHERE id = $id";
				$post = $db->select($query);
				if($post){
					while($result = $post->fetch_assoc()){
			?>
				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
				<img src="admin/<?php echo $result['image']; ?>" alt="post image"/>
				<p><?php echo $result['body']; ?></p>
				
				
				
				<div class="relatedpost clear">
				<h2>Related articles</h2>
				<?php 
					$catid = $result['catId'];
					$query_relpost = "SELECT * FROM post WHERE catId = '$catid' ORDER BY rand() limit 6";
					$releted_post = $db->select($query_relpost);
					if($releted_post){
						while($releted_result = $releted_post->fetch_assoc()){
				?>
					
					<a href="post.php?id=<?php echo $releted_result['id']; ?>"><img src="admin/<?php echo $releted_result['image'];?>" alt="post image"/></a>
					
					<?php } }else{echo "No releted post here";}?>
				</div>
				<?php } }else{header("Location:404.php");}?>
			</div>
		
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>