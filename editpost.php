<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 
    include '../classes/Category.php';
    include '../classes/Post.php';
    $cat = new Category();
    $post = new Post();
?>
<?php
//get all values from a single id 
    if (!isset($_GET['editpostid']) || $_GET['editpostid']==NULL) {
        echo "<script>window.location=postlist.php;</script>";
    }else{
        $postId = $_GET['editpostid'];
    }

//For updating existing post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $postUpdate = $post->updatePostFromAdmin($_POST, $_FILES, $postId);
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <div class="block">     
                <?php
                    if (isset($postUpdate)) {
                        echo $postUpdate;
                    }
                ?> 
                <?php 
                  $getPost = $post->getPostById($postId);  
                  if ($getPost) {
                      while ($values = $getPost->fetch_assoc()) {
                ?>         
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $values['title'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="catId">
                                    <option>Select Category</option>
                                    <?php
                                    //showing category list
                                        $showCat = $cat->getAllCat();
                                        if ($showCat) {
                                            while ($result = $showCat->fetch_assoc()) {
                                    ?>
                                    <option 
                                    <?php if ($values['catId'] == $result['catId']) { ?>
                                       selected = "selected";
                                    <?php } ?>
                                    
                                    value="<?php echo $result['catId'];?>"><?php echo $result['catName'];?></option>
                                   <?php } } ?>
                                </select>
                            </td>
                        </tr>
                   
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $values['image'];?>" width="80px" height="50px" />
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                <?php echo $values['body'];?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $values['tags'];?> class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $values['author'];?>" class="medium" />
                                 <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
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