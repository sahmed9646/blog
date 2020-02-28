<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 
    include '../classes/Category.php';
    include '../classes/Post.php';
    $cat = new Category();
    $post = new Post();
?>
<?php 
	if (isset($_GET['delpostid'])) {
		$id = $_GET['delpostid'];
	

	$delPost = $post->deletePostFromAdmin($id);}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <?php 
                	if (isset($delPost)) {
                		echo $delPost;
                	}
                ?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">SL</th>
							<th width="10%">Category</th>
							<th width="10%%">Title</th>
							<th width="20%">Description</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$allPost = $post->showAllPost();
						if ($allPost) {
							$i = 0;
							while ($result = $allPost->fetch_assoc()) {
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
							<td><img src="<?php echo $result['image']; ?>" width="60px" height="40px" /></td>
							<td><?php echo $result['author']; ?></td>
							<td><?php echo $result['tags']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td>
							<a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>">View</a> 
							<?php 
								if (Session::get('userId')==$result['userid'] || Session::get('userRole')=='0') { ?>
								||<a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a> ||
								<a onclick="return confirm('Are You Sure To Delete')"; href="?delpostid=<?php echo $result['id']; ?>">Delete</a>
							<?php } ?>
							</td>
						</tr>
					<?php } } ?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
    
    <?php include 'inc/footer.php'; ?>