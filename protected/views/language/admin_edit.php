<?php
/**
 * Ommu Languages (ommu-languages)
 * @var $this LanguageController
 * @var $model OmmuLanguages
 * @var $form CActiveForm
 * version: 1.1.0
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Languages'=>array('manage'),
		$model->name=>array('view','id'=>$model->language_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>