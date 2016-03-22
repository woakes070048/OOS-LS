<?php
/**
 * Ommu Templates (ommu-template)
 * @var $this TemplateController
 * @var $model OmmuTemplate
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Templates'=>array('manage'),
		$model->template_key,
	);
?>

<div class="dialog-content">
	<?php $this->widget('application.components.system.FDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'template_key',
			array(
				'name'=>'plugin_id',
				'value'=>$model->plugin->name,
			),
			array(
				'name'=>'user_id',
				'value'=>$model->user->displayname,
			),
			array(
				'name'=>'template',
				'value'=>$model->template,
				'type'=>'raw',
			),
			'variable',
			'creation_date',
			'modified_date',
			array(
				'name'=>'modified_id',
				'value'=>$model->modified->displayname,
			),
		),
	)); ?>
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
