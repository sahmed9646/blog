

<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

<?php 
    include '../classes/Category.php';
    $cat = new Category();
?>
<?php 
//for getting a single product before edit
    if (!isset($_GET['catid']) || $_GET['catid'] == null) {
       echo "<script>window.location = catlist.php;</script>";
    }else{
        $id = $_GET['catid'];
    }

//for editing a single product
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName = $_POST['catName'];
        $catUpdate = $cat->updateCategory($catName, $id);
   }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock">
               <?php 
                //for editing a single product
                if (isset($catUpdate)) {
                   echo $catUpdate;
                }
               ?>
               <?php
               //for getting a single product before edit
                    $getCat = $cat->getSingleCatById($id);
                    if ($getCat) {
                        while ($result = $getCat->fetch_assoc()) {
                ?> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                            <td>
                                <a href="..\admin\catlist.php" style="color:blue;font-style:italic;">show category</a>
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
<?php include 'inc/footer.php'; ?>
