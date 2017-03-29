<?php
/*
 * Define your API key and your campaign id
*/
$auth_token = "YourAPIKey";
$campaign_id = 123;
$email = $_GET['email']; 
/*
 * Main view logic begins from here
*/

require( 'functions.php' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Keys</title>

	<link rel="stylesheet" href="<?php echo $thisURL ?>/assets/css/style.css" />
	<link rel="stylesheet" href="//cdn.jsdelivr.net/gumby/2.4.2/css/gumby.css" />
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" >

	<script>
		var deactivateAjaxUrl = '<?php echo ltrim($thisURL, "/") . '?action=deactivate'; ?>';
	</script>	
	
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>


</head>
<body>

<div class='introText' >Your Active License Keys</div>
<div class="introBlock">
	<i class="icon-info"></i> You must have an active license key from below to activate software...
</div>

<?php if(!empty($pk_results) OR (count($pk_results) > 0) ): ?>
	<?php foreach($pk_results as $pk_result): ?>
		<?php if(!$pk_result->status) continue; ?>
		<div class="listKeys" >
			<i class="icon-key"></i> <?php echo $pk_result->license_key; ?>
			<?php if($pk_result->guid): ?>
				<div class="listUsages">
					<i class="icon-minus"></i> <?php echo $pk_result->guid; ?> <a href="javascript:;" platform="pk" key="<?php echo $pk_result->license_key; ?>" guid="<?php echo $pk_result->guid; ?>">Deactivate</a>
				</div>
			<?php else: ?>
				<div class="listUsages">
					This license key has not been used yet.
				</div>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<div style="padding: 15px; font-weight:bold !important;">
		<h5><B>You have no license keys available... if this is a mistake, please contact support...</B></h5>
	</div>
<?php endif; ?>
	<script type="text/javascript" src="assets/js/licensepage.js"></script>
</body>
</html>