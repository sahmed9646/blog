<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 
    
    include '../classes/Page.php';
    $page = new Page();
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pageAdd = $page->addPageFromAdmin($_POST);
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Page</h2>
                <div class="block">     
                <?php
                    if (isset($pageAdd)) {
                        echo $pageAdd;
                    }
                ?>          
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Page Name</label>
                            </td>
                            <td>
                                <input type="text" name="pageName" placeholder="Enter Page Name..." class="medium" />
                            </td>
                        </tr>
                     
                   
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Page Body</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="pageBody"></textarea>
                            </td>
                        </tr>
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
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