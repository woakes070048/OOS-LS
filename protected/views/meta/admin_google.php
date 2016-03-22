<?php
/**
 * Ommu Meta (ommu-meta)
 * @var $this MetaController
 * @var $model OmmuMeta
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Metas'=>array('manage'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
	);
?>

<div class="form" name="post-on">

	<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
		'id'=>'ommu-meta-form',
		'enableAjaxValidation'=>true,
		//'htmlOptions' => array('enctype' => 'multipart/form-data')
	)); ?>

	<?php //begin.Messages ?>
	<div id="ajax-message">
		<?php echo $form->errorSummary($model); ?>
	</div>
	<?php //begin.Messages ?>

	<fieldset>

		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('office_on');?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->radioButtonList($model,'office_on', array(
					1 => Phrase::trans(283,0),
					0 => Phrase::trans(284,0),
				)); ?>
				<?php echo $form->error($model,'office_on'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('office_location');?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->textField($model,'office_location',array('maxlength'=>32, 'class'=>'span-4')); ?>
				<?php echo $form->error($model,'office_location'); ?>
				<span class="small-px silent"><?php echo Phrase::trans(581,0);?></span>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'office_name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'office_name', array('maxlength'=>64, 'class'=>'span-4')); ?>
				<?php echo $form->error($model,'office_name'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('office_place');?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->textArea($model,'office_place',array('rows'=>6, 'cols'=>50, 'class'=>'span-8 smaller')); ?>
				<div class="pt-10"></div>
				<?php echo $form->textField($model,'office_village', array('maxlength'=>32, 'class'=>'span-4', 'placeholder'=>$model->getAttributeLabel('office_village'))); ?>
				<?php echo $form->textField($model,'office_district', array('maxlength'=>32, 'class'=>'span-4', 'placeholder'=>$model->getAttributeLabel('office_district'))); ?>
				<?php echo $form->error($model,'office_place'); ?>
				<span class="small-px silent"><?php echo Phrase::trans(577,0);?></span>
			</div>
		</div>

		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('office_city');?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->dropDownList($model,'office_city', OmmuZoneCity::getCity($model->office_province)); ?>
				<?php echo $form->error($model,'office_city'); ?>
				<span class="small-px silent"><?php echo Phrase::trans(579,0);?></span>
			</div>
		</div>

		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('office_province');?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->dropDownList($model,'office_province', OmmuZoneProvince::getProvince($model->office_country)); ?>
				<?php echo $form->error($model,'office_province'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('office_zipcode');?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->textField($model,'office_zipcode',array('maxlength'=>6, 'class'=>'span-3')); ?>
				<?php echo $form->error($model,'office_zipcode'); ?>
				<span class="small-px silent"><?php echo Phrase::trans(586,0);?></span>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'office_phone'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'office_phone',array('maxlength'=>32, 'class'=>'span-5')); ?>
				<?php echo $form->error($model,'office_phone'); ?>
				<span class="small-px silent"><?php echo Phrase::trans(585,0);?></span>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'office_fax'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'office_fax',array('maxlength'=>32, 'class'=>'span-5')); ?>
				<?php echo $form->error($model,'office_fax'); ?>
				<span class="small-px silent"><?php echo Phrase::trans(584,0);?></span>
			</div>
		</div>

		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('office_email');?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->textField($model,'office_email',array('maxlength'=>32, 'class'=>'span-5')); ?>
				<?php echo $form->error($model,'office_email'); ?>
				<span class="small-px silent"><?php echo Phrase::trans(583,0);?></span>
			</div>
		</div>
		
		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('office_website');?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->textField($model,'office_website',array('maxlength'=>32, 'class'=>'span-5')); ?>
				<?php echo $form->error($model,'office_website'); ?>
				<span class="small-px silent"><?php echo Phrase::trans(582,0);?></span>
			</div>
		</div>
		
		<div class="submit clearfix">
			<label>&nbsp;</label>
			<div class="desc">
				<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save'), array('onclick' => 'setEnableSave()')); ?>
			</div>
		</div>

	</fieldset>
	<?php $this->endWidget(); ?>

</div>
