<?php
/**
 * User Forgot (user-forgot)
 * @var $this ForgotController
 * @var $model UserForgot
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Users
 * @contact (+62)856-299-4114
 *
 */
 
	$this->breadcrumbs=array(
	'User Forgots'=>array('manage'),
		'Create',
	);

if(isset($_GET['name']) && isset($_GET['email'])) {
	if(isset($_GET['type']) && $_GET['type'] == 'success') {
		echo '<a class="button" href="'.Yii::app()->createUrl('site/login').'" title="'.Phrase::trans(1006,2).'">'.Phrase::trans(1006,2).'</a>';
	}
	
} else {
	echo $this->renderPartial('_form', array(
		'model'=>$model,
	));
}?>