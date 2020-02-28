<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 
    include '../classes/Slider.php';
    $slider = new Slider();
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sliderAdd = $slider->addSliderFromAdmin($_POST, $_FILES);
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Slide</h2>
                <div class="block">     
                <?php
                    if (isset($sliderAdd)) {
                        echo $sliderAdd;
                    }
                ?>          
                 <form action="addslide.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Slider Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Slider Title..." class="medium" />
                            </td>
                        </tr>
                     
                         <tr>
                            <td>
                                <label>Slider Link</label>
                            </td>
                            <td>
                                <input type="text" name="link" placeholder="Please enter or copy slider link..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        
						<tr>
                            <td></td>
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