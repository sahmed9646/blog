

<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>



        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Change Theme</h2>
               <div class="block copyblock">
               
                <?php 
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $theme = mysqli_real_escape_string($db->link, $_POST['theme']);
                        $query = "UPDATE theme SET theme='$theme' where id = '1' ";
                        $updateRow = $db->update($query);
                        if ($updateRow) {
                        $msg = "<span style='color:green; font-size:18px'>Theme Updated Successfully!!!</span>";
                        echo $msg;
                    }else{
                        $msg = "<span style='color:red; font-size:18px'>Theme Not Updated!!!</span>";
                        echo $msg;
                    }
                }
                ?>

                <?php 
                    $query = "SELECT * from theme where id = '1' ";
                    $themes = $db->select($query);
                    if ($themes) {
                        while ($result=$themes->fetch_assoc()) {
                 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>
                                    <input 
                                        <?php if ($result['theme'] == 'default') {
                                            echo "checked";
                                        }?> 
                                    type="radio" name="theme" value="default" class="" />Default
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <input 
                                        <?php if ($result['theme'] == 'green') {
                                            echo "checked";
                                        }?> 
                                    type="radio" name="theme" value="green" class="" />Green
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <input 
                                        <?php if ($result['theme'] == 'red') {
                                            echo "checked";
                                        }?> 
                                    type="radio" name="theme" value="red" class="" />Red
                                </label>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
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
