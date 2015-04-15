<?php

/**
 * This is the model class for table "{{article}}".
 *
 * The followings are the available columns in table '{{article}}':
 * @property string $id
 * @property string $article_uid
 * @property string $article_title
 * @property string $article_content
 * @property string $article_headimg
 * @property string $article_description
 * @property integer $article_ctime
 * @property integer $article_status
 * @property integer $article_place
 */
class Article extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{article}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_content', 'required'),
			array('article_ctime, article_status, article_place', 'numerical', 'integerOnly'=>true),
			array('article_uid', 'length', 'max'=>10),
			array('article_title, article_description', 'length', 'max'=>500),
			array('article_headimg', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, article_uid, article_title, article_content, article_headimg, article_description, article_ctime, article_status, article_place', 'safe', 'on'=>'search'),
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
			'gzhinfo' => array(self::BELONGS_TO, 'Gzhinfo','', 'on'=>'Gzhinfo.id=article_uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'article_uid' => 'Article Uid',
			'article_title' => 'Article Title',
			'article_content' => 'Article Content',
			'article_headimg' => 'Article Headimg',
			'article_description' => 'Article Description',
			'article_ctime' => 'Article Ctime',
			'article_status' => 'Article Status',
			'article_place' => 'Article Place',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('article_uid',$this->article_uid,true);
		$criteria->compare('article_title',$this->article_title,true);
		$criteria->compare('article_content',$this->article_content,true);
		$criteria->compare('article_headimg',$this->article_headimg,true);
		$criteria->compare('article_description',$this->article_description,true);
		$criteria->compare('article_ctime',$this->article_ctime);
		$criteria->compare('article_status',$this->article_status);
		$criteria->compare('article_place',$this->article_place);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
