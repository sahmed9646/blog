

<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">
               <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $catname = $fm->validation($_POST['catName']);
                    $cat = mysqli_real_escape_string($db->link, $catname);

                    if (empty($cat)) {
                       echo "<span style='color:red; font-size:18px'>Field Must Not Empty!!!</span>";
                    }else{
                        $query = "INSERT INTO category(catName) VALUES('$cat') ";
                        $catInsert = $db->insert($query);
                        if ($catInsert) {
                            echo "<span style='color:green; font-size:18px'>Category Inserted Successfully!!!</span>";
                        }else{
                            echo "<span style='color:red; font-size:18px'>Category Not Inserted!!!</span>";    
                        }
                    }
                }
               ?> 
                 <form action="addcat.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
<?php include 'inc/footer.php'; ?>
