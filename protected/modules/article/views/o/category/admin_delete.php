<?php
/**
 * Article Category (article-category)
 * @var $this CategoryController
 * @var $model ArticleCategory
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Articles
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Article Categories'=>array('manage'),
		'Delete',
	);
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'article-category-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>
	<div class="dialog-content">
		<?php echo Phrase::trans(172,0);?>
	</div>
	<div class="dialog-submit">
		<?php echo CHtml::submitButton(Phrase::trans(173,0), array('onclick' => 'setEnableSave()')); ?>
		<?php echo CHtml::button(Phrase::trans(174,0), array('id'=>'closed')); ?>
	</div>
<?php $this->endWidget(); ?>