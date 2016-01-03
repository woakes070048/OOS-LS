<?php
/**
 * Ommu Author Contacts (ommu-author-contact)
 * @var $this AuthorcontactController
 * @var $model OmmuAuthorContact
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2015 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Author Contacts'=>array('manage'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
	);
?>

<?php echo $this->renderPartial('/author_contact/_form', array('model'=>$model)); ?>