
<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/format.php';?>


<?php 
	$db = new Database();
	$fm = new format();
?>	

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html>

<head>
	<?php include 'scripts/meta.php';?>
	<?php include 'scripts/css.php';?>
	<?php include 'scripts/js.php';?>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
		<?php 
			$query = "SELECT * FROM title_slogan WHERE id = '1' ";
			$showData = $db->select($query);
			if ($showData) {
				while ($result = $showData->fetch_assoc()) {
		?>
			<div class="logo">
				<img src="admin/<?php echo $result['logoImage']; ?>" alt="Logo"/>
				<h2><?php echo $result['title']; ?></h2>
				<p><?php echo $result['slogan']; ?></p>
			</div>
		<?php } } ?>
		</a>
		<div class="social clear">
		<?php 
			$query = "SELECT * FROM social WHERE id = '1' ";
			$showData = $db->select($query);
			if ($showData) {
				while ($result = $showData->fetch_assoc()) {
		?>
			<div class="icon clear">
				<a href="<?php echo $result['facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['twitter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['linkedin']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['googleplus']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
		<?php } } ?>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
<?php 
	$path = $_SERVER['SCRIPT_FILENAME'];
	$currentPage = basename($path, '.php');
?>
	<ul>
		<li><a <?php if ($currentPage=='index') {echo "id='active'";}?> href="index.php">Home</a></li>
		<?php 
            $query = "SELECT * FROM page ";
            $showPages = $db->select($query);
            if ($showPages) {
                while ($result = $showPages->fetch_assoc()) {
         ?>
             <li><a 
             <?php if (isset($_GET['pageid']) && $_GET['pageid']==$result['pageId']) {
             	echo 'id="active"';
             }?>
             href="page.php?pageid=<?php echo $result['pageId']; ?>"><?php echo $result['pageName']; ?></a> </li>
         <?php } } ?>	
		<li><a <?php if ($currentPage=='contact') {echo "id='active'";}?> href="contact.php">Contact</a></li>
	</ul>
</div>