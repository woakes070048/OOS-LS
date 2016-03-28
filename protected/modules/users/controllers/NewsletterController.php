<?php
/**
 * NewsletterController
 * @var $this NewsletterController
 * @var $model UserNewsletter
 * @var $form CActiveForm
 * version: 0.0.1
 * Reference start
 *
 * TOC :
 *	Index
 *	Subscribe
 *	Unsubscribe
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Users
 * @contect (+62)856-299-4114
 *
 *----------------------------------------------------------------------------------------------------------
 */

class NewsletterController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $defaultAction = 'index';

	/**
	 * Initialize admin page theme
	 */
	public function init() 
	{
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['folder'];
		$this->layout = $arrThemes['layout'];
	}

	/**
	 * @return array action filters
	 */
	public function filters() 
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() 
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','subscribe','unsubscribe'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level)',
				//'expression'=>'isset(Yii::app()->user->level) && (Yii::app()->user->level != 1)',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() 
	{
		$this->redirect(array('subscribe'));
	}

	/**
	 * Lists all models.
	 */
	public function actionSubscribe() 
	{
		$model=new UserNewsletter;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['UserNewsletter'])) {
			$model->attributes=$_POST['UserNewsletter'];

			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;
			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						if($model->user_id == 0) {
							$get = Yii::app()->controller->createUrl('subscribe', array('name'=>$model->email, 'email'=>$model->email));
						} else {
							$get = Yii::app()->controller->createUrl('subscribe', array('name'=>$model->user->displayname, 'email'=>$model->user->email));
						}
						echo CJSON::encode(array(
							'type' => 5,
							'get' => $get,
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
		}

		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->createUrl('site/index');
		
		$this->dialogFixed = true;
		$setting = OmmuSettings::model()->findByPk(1,array(
			'select' => 'online, construction_date',
		));

		if($setting->online == 0 && date('Y-m-d', strtotime($setting->construction_date)) > date('Y-m-d')) {
			$launch = 0;
			$title = (isset($_GET['name']) && isset($_GET['email'])) ? Phrase::trans(23105,1) : Phrase::trans(23103,1);
			$desc = (isset($_GET['name']) && isset($_GET['email'])) ? '' : Phrase::trans(23104,1);
		} else {
			$launch = 1;
			$this->dialogFixedClosed=array(
				Yii::t('phrase', 'Create Your Account')=>Yii::app()->createUrl('users/signup/index'),
			);
			$title = (isset($_GET['name']) && isset($_GET['email'])) ? Phrase::trans(23108,1) : Phrase::trans(23106,1);
			$desc = (isset($_GET['name']) && isset($_GET['email'])) ? '' : Phrase::trans(23107,1);
		}
		
		$this->pageTitle = $title;
		$this->pageDescription = $desc;
		$this->pageMeta = '';
		$this->render('front_subscribe',array(
			'model'=>$model,
			'launch'=>$launch,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionUnsubscribe() 
	{
		/**
		 * example get link
		 * http://localhost/_product/nirwasita_hijab/support/newsletter/unsubscribe/email/putra.sudaryanto@gmail.com/secret/uvijijxykmabhiijdehinofgtuuvbcGH
		 * secret = salt[Users]
		 * email = email[Users]
		 */
		 
		 $renderError = 0;
		 if(isset($_GET['success']) || (isset($_GET['email']) || isset($_GET['secret']))) {
			if(isset($_GET['success'])) {
				if(isset($_GET['date'])) {
					$title = Phrase::trans(23116,1);
					$desc = Phrase::trans(23118,1, array(
						$_GET['success'], 
						Utility::dateFormat($_GET['date']),
					));

				} else {
					$title = Phrase::trans(23119,1);
					$desc = Phrase::trans(23120,1, array(
						$_GET['success'],
					));
				}
				
			} else {
				if(isset($_GET['email']) || isset($_GET['secret'])) {
					$newsletter = UserNewsletter::model()->findByAttributes(array('email' => $_GET['email']), array(
						'select' => 'id, user_id, email, subscribe, subscribe_date, unsubscribe_date',
					));
					if($newsletter != null) {
						if($newsletter->user_id != 0) {
							$secret = Users::model()->findByAttributes(array('salt' => $_GET['secret']), array(
								'select' => 'email',
							));
							$guest = ($secret != null && $secret->email == $newsletter->email) ? 1 : 0;
						} else {
							$guest = (md5($newsletter->email.$newsletter->subscribe_date) == $_GET['secret']) ? 1 : 0;
						}
						if($guest == 1) {
							if($newsletter->subscribe == 1) {
								$newsletter->subscribe = 0;
								if($newsletter->update()) {
									$title = Phrase::trans(23116,1);
									$desc = Phrase::trans(23117,1, array(
										$newsletter->email,
									));
								}
							} else {
								$title = Phrase::trans(23116,1);
								$desc = Phrase::trans(23118,1, array(
									$newsletter->email, 
									Utility::dateFormat($newsletter->unsubscribe_date),
								));
							}					
						} else {
							$renderError = 1;
							$title = Phrase::trans(23113,1);
							$desc = Phrase::trans(23115,1, array(
								$newsletter->email,
							));
						}
					} else {
						$renderError = 1;
						$title = Phrase::trans(23113,1);
						$desc = Phrase::trans(23114,1);
					}
				}
			}
			
		} else {
			$model=new UserNewsletter;

			// Uncomment the following line if AJAX validation is needed
			$this->performAjaxValidation($model);

			if(isset($_POST['UserNewsletter'])) {
				$model->attributes=$_POST['UserNewsletter'];

				$jsonError = CActiveForm::validate($model);
				if(strlen($jsonError) > 2) {
					echo $jsonError;
					
				} else {
					if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
						if($model->validate()) {
							if($model->subscribe == 1) {
								if($model->user_id != 0) {
									$email = $model->user->email;
									$displayname = $model->user->displayname;
									$secret = $model->user->salt;
								} else {
									$email = $displayname = $model->email;
									$secret = md5($email.$model->subscribe_date);
								}
								// Send Email to Member
								$ticket = Utility::getProtocol().'://'.Yii::app()->request->serverName.Yii::app()->createUrl('support/newsletter/unsubscribe', array('email'=>$email,'secret'=>$secret));
								SupportMailSetting::sendEmail($email, $displayname, 'Unsubscribe Ticket', $ticket, 1);
								
								$url = Yii::app()->controller->createUrl('unsubscribe', array('success'=>$email));
							
							} else {
								$url = Yii::app()->controller->createUrl('unsubscribe', array('success'=>$model->email, 'date'=>$model->unsubscribe_date));
							}
							
							echo CJSON::encode(array(
								'type' => 5,
								'get' => $url,
							));
						
						} else {
							print_r($model->getErrors());
						}
					}
				}
				Yii::app()->end();
			}
			
			$title = Phrase::trans(23111,1);
			$desc = Phrase::trans(23112,1);
		}
		
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->createUrl('site/index');
		$this->dialogFixed = true;
	
		$this->pageTitle = $title;
		$this->pageDescription = $desc;
		$this->pageMeta = '';
		$this->render('front_unsubscribe', array(
			'model'=>$model,
			'renderError'=>$renderError,
			'launch'=>2,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) 
	{
		$model = UserNewsletter::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) 
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='support-newsletter-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
