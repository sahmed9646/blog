
<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
?>


<?php 
	$db = new Database();
	$fm = new Format();
?>	

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="samepost clear">
<!--Pagination-->
	<?php 
	$per_page = 4;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}
	$start_from = ($page-1) * $per_page;
	?>
<!--Pagination-->
			<?php 
				$query = "SELECT * FROM post order by id desc limit $start_from, $per_page ";
				$post = $db->select($query);
				if($post){
					while($result = $post->fetch_assoc()){
			?>
				<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
				 <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
				<div style="display: block;margin-bottom: 40px"><p><?php echo $fm->textShorten($result['body']); ?></p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
				</div>
				</div>
				<div><span class="clear"></span></div>

					
				<?php } ?>

<!--Pagination-->
<?php 

$query = "SELECT * FROM post";
$result = $db->select($query);
$total_rows = mysqli_num_rows($result);
$total_pages = ceil($total_rows/$per_page);

echo "<span class='pagination'><a href='index.php?page=1'>".'First Page'."</a>" ;

for ($i=1; $i <= $total_pages; $i++){
	echo "<a href='index.php?page=".$i."'>".$i."</a>";
};

echo "<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>"?>
<!--Pagination-->

				<?php } else{header("Location:404.php");}?>
			</div>
			


<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>