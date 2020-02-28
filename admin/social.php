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
        $socialMediaUpdate = $tss->updateSocialMedia($_POST);
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block"> 
                <?php
                    if (isset($socialMediaUpdate)) {
                       echo $socialMediaUpdate;
                    }
                ?>
                <?php 
                    $viewData = $tss->viewSocialData();
                    if ($viewData) {
                        while ($result = $viewData->fetch_assoc()) {
                ?>              
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $result['facebook']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?php echo $result['twitter']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" value="<?php echo $result['linkedin']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="googleplus" value="<?php echo $result['googleplus']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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