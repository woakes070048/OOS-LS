<?php
/**
 * Ommu Themes (ommu-themes)
 * @var $this ThemeController
 * @var $model OmmuThemes
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Themes'=>array('manage'),
		'Default',
	);
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'ommu-pages-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>
	<div class="dialog-content">
		<?php echo Phrase::trans(300,0);?>
	</div>
<div class="dialog-submit">
		<?php echo CHtml::submitButton(Phrase::trans(156,0), array('onclick' => 'setEnableSave()')); ?>
		<?php echo CHtml::button(Phrase::trans(174,0), array('id'=>'closed')); ?>
	</div>
<?php $this->endWidget(); ?>