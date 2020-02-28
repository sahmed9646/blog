<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 
    
    include '../classes/Page.php';
    $page = new Page();
?>
<?php

//get all values from a single id 
    $pageid = mysqli_real_escape_string($db->link, $_GET['pageid']);

    if (!isset($pageid) || $pageid==NULL) {
        echo "<script>window.location='index.php';</script>";
    }else{
        $pageId = $pageid;
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pageUpdate = $page->updatePageFromAdmin($_POST, $pageId);
    }
?>

<style type="text/css">
    .actionDelete{margin-left: 10px;margin-top: 5px}
    .actionDelete a{

        background: #f0f0f0;
        border: 1px solid #ddd;
        color: red;
        cursor: pointer;
        padding: 2px 10px;
        font-size: 20px;
        font-weight: normal;
    }
</style>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Page</h2>
                <div class="block">     
                <?php
                    if (isset($pageUpdate)) {
                        echo $pageUpdate;
                    }
                ?> 

                <?php 
                  $getPage = $page->getPageById($pageId);  
                  if ($getPage) {
                      while ($values = $getPage->fetch_assoc()) {
                ?>          
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Page Name</label>
                            </td>
                            <td>
                                <input type="text" name="pageName" value="<?php echo $values['pageName']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                   
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Page Body</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="pageBody">
                                  <?php echo $values['pageBody']; ?>
                                </textarea>
                            </td>
                        </tr>
                        
						<tr>
                            <td></td>
                             <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="actionDelete"><a onclick="return confirm('Are You Sure To Delete')"; href="deletepage.php?delpage=<?php echo $values['pageId']; ?>">Delete</a></span>
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