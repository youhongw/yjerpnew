<?php
    
    //Include the barcode script
    
    include_once 'barcode.php';
    
    //Handle if text posted
	
	if($_GET['code']) {
		
        //Create the barcode
        
		$img			=	code128BarCode($_GET['code'], 1);
		
        //Start output buffer to capture the image
        //Output PNG image
        
		ob_start();
		imagepng($img);
		
        //Get the image from the output buffer
        
		$output_img		=	ob_get_clean();
		
	}
      header("Content-Type: image/png; name=\"barcode.png\"");
      imagepng($img);
      imagedestroy($img);
?>

	
	<?php //if($_GET['code']) echo '<img src="data:image/png;base64,' . base64_encode($output_img) . '" />'; ?>
