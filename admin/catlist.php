﻿<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 
    include '../classes/Category.php';
    $cat = new Category();
?>
<?php
//for deleting a category
	if (isset($_GET['delcat'])) {
		$id=$_GET['delcat'];
		$catDelete = $cat->deleteCategory($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
        	if (isset($catDelete)) {
        		echo $catDelete;
        	}
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query = "select * from category order by catId desc";
				$category= $db->select($query);
				if ($category) {
					$i=0;
					while ($result = $category->fetch_assoc()) {
						$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['catName']; ?></td>
					<td><a href="editcat.php?catid=<?php echo $result['catId'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete')" href="?delcat=<?php echo $result['catId'];?>">Delete</a></td>
				</tr>
			<?php  } }?>	
			</tbody>
		</table>
       </div>
    </div>
</div>
    <div class="clear">
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script> 
<?php include 'inc/footer.php'; ?>