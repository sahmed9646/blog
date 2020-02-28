
<?php 
	include 'classes/Slider.php';
	$slider = new Slider();
?>
<div class="slidersection templete clear">
	
        <div id="slider">
    <?php 
		$showSlides = $slider->showSlideInFrontView();
		if ($showSlides) {
			while ($result = $showSlides->fetch_assoc()) {
	?>
            <a href="<?php echo $result['link']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['title']; ?>" title="<?php echo $result['title']; ?>" /></a>
     <?php } } ?>
         </div>
        
</div>