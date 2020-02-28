<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

<?php
    include '../classes/TitleSloganSocial.php';
    $tss = new TitleSloganSocial();
?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titlesloganUpdate = $tss->updateTitleSlogan($_POST, $_FILES);
    }
?>

<style type="text/css">
    .leftside{float: left; width: 70%;}
    .rightside{float:left; width: 20%}
    .rightside img{width: 170px; height: 150px;}
</style>>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <?php
                    if (isset($titlesloganUpdate)) {
                       echo $titlesloganUpdate;
                    }
                ?>
                <?php 
                  $query = "SELECT * FROM title_slogan WHERE id = '1' ";
                  $showData = $db->select($query);
                  if ($showData) {
                        while ($result = $showData->fetch_assoc()) {
                ?>

                <div class="block sloginblock">               
                 <div class="leftside">
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title'];?>" name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['slogan'];?>" name="slogan" class="medium" />
                            </td>
                        </tr>
						 
						<tr>
                            <td>
                                <label>Upload Logo</label>
                            </td>
                            <td>
                                
                                <input type="file" name="logoImage" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                   </div> 
                   <div class="rightside">
                   <img src="<?php echo $result['logoImage'];?>" alt="" />
                   
                   </div>
                </div>
                <?php } } ?>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
<?php include 'inc/footer.php'; ?>