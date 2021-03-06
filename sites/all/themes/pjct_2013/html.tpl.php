<?php 
//Fix for Drupal not setting up a session for anonymous users, and thus "loosing" track of the language session setting.
if (isset ($_GET['language'])){
    $_SESSION['language']=$_GET['language'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?> lang="<?php print $language->language; ?>">
<head profile="<?php print $grddl_profile; ?>">


  <?php print $head; ?>
  <?php require_once "_includes/meta_include.php"; ?>
  
  <title><?php print $head_title; ?></title>
  
  <link type="text/css" href="/_codewise/codewise_common.css" rel="stylesheet" />
  <?php print $styles ?>
  
  <script type="text/javascript" src="/_codewise/codewise_global.js"></script>
  <script type="text/javascript" src="/_codewise/<?php echo $codewise_skin_name;?>_global.js"></script>
  
		
<script type="text/javascript">
	var aPI_loaded = false;
	var aPI_queue = new Array();

	function aPI(){
		setTimeout('aPI2()',1000);	//aPI is called a tiny bit quicker than when its done re-flowing the page.
	}	
	
	function aPI2() {
		 for (i in aPI_queue) {
	        eval(aPI_queue[i]);
	        delete(aPI_queue[i]); // cleanup after ourselves
	    }

		 aPI_loaded = true;
	};

	function when_aPI_ready(callback) {
	    // skip the queue if the skin has already completed
	    if (aPI_loaded == true)
	        eval(callback);
	    else {
	    	//if ($.inArray(callback, aPI_queue) === -1){	//only add to queue once, dom manipulation causes some calls to this function twice and we only want to add it once.
	    	if(include(aPI_queue, callback) != true){
	    		aPI_queue.push(callback);
	    	}
	    }
	}

	function include(arr, obj) {
	    for(var i=0; i<arr.length; i++) {
	        if (arr[i] == obj) return true;
	    }
	}

	<?php if($is_front){?>
	pageType = 'fullWidth';
	<?php }?>

	isHomePage = <?php echo $is_front ? 'true' : 'false';?>;

	when_aPI_ready('doIframes()');
	function doIframes(){
		$('iframe.api').each(function(){ $(this).attr('src', $(this).attr('iframe_url')); });
	}
</script>
	
<?php print $scripts ?> 	
<script type="text/javascript" >var $ = jQuery.noConflict();	//bring back $</script>
<script type="text/javascript" src="/_codewise/codewise_master.js"></script>

<script>
<?php if($is_front){?>
	//Adjust the tab heighs onclick to the max size of the columns
	when_aPI_ready('homeInitResizeTabCode()');
	function homeInitResizeTabCode(){
		$('div.tabbed ul.tabbedLinks a').click(function (){PJCT_resizeHomePageSubColumnHeights();});
	}
<?php } ?>

</script>
	
<?php //require_once('_includes/flash_detection_include.php');?>
	
	 
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	
	
<!-- ~~~~~~~~~~~~~~~~~~~ Local style definitions ~~~~~~~~~~~~~~~~~~~ -->
	
<style type="text/css" media="screen">
<!-- 
	
-->
</style>
	
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->


</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
 
  <?php print $page_top; ?>
  <?php print $page; ?>
  
  
  <?php print $page_bottom; ?>    
</body>
</html>