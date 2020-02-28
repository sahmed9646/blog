<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 
    include '../classes/Slider.php';
    $slider = new Slider();
?>

<?php
//get all values from a single id 
    if (!isset($_GET['editsliderid']) || $_GET['editsliderid']==NULL) {
        echo "<script>window.location=postlist.php;</script>";
    }else{
        $sliderId = $_GET['editsliderid'];
    }

//For updating existing post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sliderUpdate = $slider->updateSliderFromAdmin($_POST, $_FILES, $sliderId);
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Slider</h2>
                <div class="block">     
                <?php
                    if (isset($sliderUpdate)) {
                        echo $sliderUpdate;
                    }
                ?> 
                <?php 
                  $getSlider = $slider->getsliderById($sliderId);  
                  if ($getSlider) {
                      while ($values = $getSlider->fetch_assoc()) {
                ?>         
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Slider Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $values['title'];?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Slider Link</label>
                            </td>
                            <td>
                                <input type="text" name="link" value="<?php echo $values['link'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Slider Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $values['image'];?>" width="150px" height="100px" />
                                <input type="file" name="image"/>
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
<!-- /TinyMCE -->
<style type="text/css">
    #tinymce{font-size:15px !important;}
</style>    
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>    
<?php include 'inc/footer.php'; ?>