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
        $copyrightTextUpdate = $tss->updateCopyrightText($_POST);
    }
?>

<div class="grid_10">

<div class="box round first grid">
    <h2>Update Copyright Text</h2>
    <div class="block copyblock"> 
    <?php
        if (isset($copyrightTextUpdate)) {
           echo $copyrightTextUpdate;
        }
    ?>
    <?php 
        $viewData = $tss->viewCopyrightText();
        if ($viewData) {
            while ($result = $viewData->fetch_assoc()) {
    ?> 
     <form action="" method="post">
        <table class="form">					
            <tr>
                <td>
                    <input type="text" value="<?php echo $result['ctext']; ?>" name="ctext" class="large" />
                </td>
            </tr>
			
			 <tr> 
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