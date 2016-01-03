<?php
/**
 * @var $this SiteController
 * @var $error array
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Error',
	);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>