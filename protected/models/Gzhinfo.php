<?php

/**
 * This is the model class for table "{{gzhinfo}}".
 *
 * The followings are the available columns in table '{{gzhinfo}}':
 * @property string $id
 * @property string $gzh_tid
 * @property string $gzh_name
 * @property string $gzh_number
 * @property string $gzh_headimg
 * @property string $gzh_codeimg
 * @property integer $gzh_creatid
 * @property integer $gzh_ctime
 * @property string $gzh_openid
 * @property integer $gzh_order
 * @property string $ghz_descript
 * @property string $gzh_certified_text
 * @property string $gzh_appid
 * @property string $gzh_appsecret
 */
class Gzhinfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{gzhinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gzh_creatid, gzh_ctime, gzh_order', 'numerical', 'integerOnly'=>true),
			array('gzh_tid', 'length', 'max'=>10),
			array('gzh_name, gzh_number, gzh_headimg, gzh_codeimg, gzh_openid, gzh_appid, gzh_appsecret', 'length', 'max'=>100),
			array('ghz_descript, gzh_certified_text', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, gzh_tid, gzh_name, gzh_number, gzh_headimg, gzh_codeimg, gzh_creatid, gzh_ctime, gzh_openid, gzh_order, ghz_descript, gzh_certified_text, gzh_appid, gzh_appsecret', 'safe', 'on'=>'search'),
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
			'posts' => array(self::HAS_MANY, 'Artilcle', '', 'on'=>'Article.article_uid=id','select'=>'*'),
			'term' => array(self::BELONGS_TO, 'Term','', 'on'=>'Term.id=gzh_tid','select'=>'*'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gzh_tid' => 'Gzh Tid',
			'gzh_name' => 'Gzh Name',
			'gzh_number' => 'Gzh Number',
			'gzh_headimg' => 'Gzh Headimg',
			'gzh_codeimg' => 'Gzh Codeimg',
			'gzh_creatid' => 'Gzh Creatid',
			'gzh_ctime' => 'Gzh Ctime',
			'gzh_openid' => 'Gzh Openid',
			'gzh_order' => 'Gzh Order',
			'ghz_descript' => 'Ghz Descript',
			'gzh_certified_text' => 'Gzh Certified Text',
			'gzh_appid' => 'Gzh Appid',
			'gzh_appsecret' => 'Gzh Appsecret',
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
		$criteria->compare('gzh_tid',$this->gzh_tid,true);
		$criteria->compare('gzh_name',$this->gzh_name,true);
		$criteria->compare('gzh_number',$this->gzh_number,true);
		$criteria->compare('gzh_headimg',$this->gzh_headimg,true);
		$criteria->compare('gzh_codeimg',$this->gzh_codeimg,true);
		$criteria->compare('gzh_creatid',$this->gzh_creatid);
		$criteria->compare('gzh_ctime',$this->gzh_ctime);
		$criteria->compare('gzh_openid',$this->gzh_openid,true);
		$criteria->compare('gzh_order',$this->gzh_order);
		$criteria->compare('ghz_descript',$this->ghz_descript,true);
		$criteria->compare('gzh_certified_text',$this->gzh_certified_text,true);
		$criteria->compare('gzh_appid',$this->gzh_appid,true);
		$criteria->compare('gzh_appsecret',$this->gzh_appsecret,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gzhinfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
