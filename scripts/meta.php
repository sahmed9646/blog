	<?php 
		if (isset($_GET['pageid'])) {
			$pagetitle = $_GET['pageid'];
			$query = "SELECT * from page where pageId='$pagetitle' ";
			$pages = $db->select($query);
			if ($pages) {
				while ($result = $pages->fetch_assoc()) {
	?>
		<title><?php echo $result['pageName']; ?>-<?php echo TITLE; ?></title>
	<?php } } }elseif(isset($_GET['id'])){
		$posttitle = $_GET['id'];
		$query = "SELECT * from post where id='$posttitle' ";
		$post = $db->select($query);
		if ($post) {
			while ($result = $post->fetch_assoc()) {
	?>
	<title><?php echo $result['title']; ?>-<?php echo TITLE; ?></title>
	<?php } } }else{ ?>
		<title><?php echo $fm->title(); ?>-<?php echo TITLE; ?></title>
	<?php } ?>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php 
		if (isset($_GET['id'])) {
			$key = $_GET['id'];
			$query = "SELECT * from post where id = '$key' ";
			$keywords = $db->select($query);
			if ($keywords) {
				while ($result = $keywords->fetch_assoc()) {
	?>
	<meta name="keywords" content="<?php echo $result['tags']; ?>">
	<?php } } } else{ ?>
	<meta name="keywords" content="<?php echo KEYWORDS; ?>">
	<?php } ?>
	<meta name="author" content="Delowar">