<?php
/**
 * OmmuPluginPhrase
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 *
 * --------------------------------------------------------------------------------------
 *
 * This is the model class for table "ommu_core_plugin_phrase".
 *
 * The followings are the available columns in table 'ommu_core_plugin_phrase':
 * @property string $phrase_id
 * @property integer $plugin_id
 * @property string $location
 * @property string $en
 *
 * The followings are the available model relations:
 * @property OmmuCorePlugins $plugin
 */
class OmmuPluginPhrase extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OmmuPluginPhrase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ommu_core_plugin_phrase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('en', 'required'),
			array('plugin_id', 'numerical', 'integerOnly'=>true),
			array('phrase_id', 'length', 'max'=>11),
			array('location', 'length', 'max'=>32),
			array('plugin_id, location, 
				id', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('phrase_id, plugin_id, location, en', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'plugin' => array(self::BELONGS_TO, 'OmmuPlugins', 'plugin_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'phrase_id' => Phrase::trans(176,0),
			'plugin_id' => Phrase::trans(161,0),
			'location' => Phrase::trans(359,0),
			'en' => 'En',
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.phrase_id',$this->phrase_id);
		if(isset($_GET['module'])) {
			$criteria->compare('t.plugin_id',$_GET['module']);
		} else {
			$criteria->compare('t.plugin_id',$this->plugin_id);
		}
		$criteria->compare('t.location',strtolower($this->location),true);
		$criteria->compare('t.en',strtolower($this->en),true);

		if(!isset($_GET['OmmuPluginPhrase_sort']))
			$criteria->order = 'phrase_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>30,
			),
		));
	}


	/**
	 * Get column for CGrid View
	 */
	public function getGridColumn($columns=null) {
		if($columns !== null) {
			foreach($columns as $val) {
				/*
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);
				}
				*/
				$this->defaultColumns[] = $val;
			}
		}else {
			//$this->defaultColumns[] = 'phrase_id';
			$this->defaultColumns[] = 'plugin_id';
			$this->defaultColumns[] = 'location';
			$this->defaultColumns[] = 'en';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = array(
				'header' => 'ID',
				'name' => 'phrase_id',
				'value' => '$data->phrase_id',
				'htmlOptions' => array(
					'class' => 'center',
				),
			);
			$this->defaultColumns[] = array(
				'name' => 'plugin_id',
				'value' => '$data->plugin->name',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>OmmuPlugins::getPluginArray('id', 0),
				'type' => 'raw',
			);
			$this->defaultColumns[] = 'en';
			$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'location';
		}
		parent::afterConstruct();
	}

	// Get new order
	public static function getOrder($id){
		$model = self::model()->count(array(
			'condition' => 'plugin_id = :plugin',
			'params' => array(':plugin'=>$id)
		));
		$order = $model;
		return $order;
	}

}