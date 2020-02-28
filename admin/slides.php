<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 
    include '../classes/Slider.php';
    $slider = new Slider();
?>
<?php 
	if (isset($_GET['delsliderid'])) {
		$id = $_GET['delsliderid'];
	

	$delSlider = $slider->deleteSliderFromAdmin($id);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>All Slides</h2>
                <?php 
                	if (isset($delSlider)) {
                		echo $delSlider;
                	}
                ?>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Link</th>
							<th>Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$allSlider = $slider->showAllSlider();
						if ($allSlider) {
							$i = 0;
							while ($result = $allSlider->fetch_assoc()) {
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><?php echo $result['link']; ?></td>
							<td><img src="<?php echo $result['image']; ?>" width="200px" height="100px" /></td>
							<td>
								<?php 
									if (Session::get('userRole')=='0') { ?>
									<a href="editslider.php?editsliderid=<?php echo $result['id']; ?>">Edit</a> ||
									<a onclick="return confirm('Are You Sure To Delete')"; href="?delsliderid=<?php echo $result['id']; ?>">Delete</a>
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