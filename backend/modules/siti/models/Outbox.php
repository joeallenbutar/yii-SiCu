<?php

namespace backend\modules\siti\models;

use Yii;

/**
 * This is the model class for table "t_m_pegawai".
 *
 * @property integer $id
 * @property string $nik
 * @property string $nama
 * @property string $email
 * @property string $no_hp
 * @property string $alias
 * @property string $id_sex
 * @property string $status_kawin
 * @property string $status_kepeg
 * @property integer $id_jabatan
 *
 * @property TKehadiran[] $tKehadirans
 * @property TJabatan $idJabatan
 * @property TMUser[] $tMUsers
 * @property TPermohonanCuti[] $tPermohonanCutis
 * @property TPermohonanIzin[] $tPermohonanIzins
 * @property TMasterCutiIzin[] $TMasterCutiIzins
 */
class Outbox extends \yii\db\ActiveRecord
{
	/**
     * @inheritdoc
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
		return 'outbox';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TextDecoded, CreatorID, DestinationNumber', 'required'),
			array('Class, RelativeValidity', 'numerical', 'integerOnly'=>true),
			array('DestinationNumber', 'length', 'max'=>20),
			array('Coding', 'length', 'max'=>22),
			array('MultiPart', 'length', 'max'=>5),
			array('SenderID', 'length', 'max'=>255),
			array('DeliveryReport', 'length', 'max'=>7),
			array('InsertIntoDB, SendingDateTime, SendBefore, SendAfter, Text, UDH, SendingTimeOut', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('UpdatedInDB, InsertIntoDB, SendingDateTime, SendBefore, SendAfter, Text, DestinationNumber, Coding, UDH, Class, TextDecoded, ID, MultiPart, RelativeValidity, SenderID, SendingTimeOut, DeliveryReport, CreatorID', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'UpdatedInDB' => 'Updated In Db',
			'InsertIntoDB' => 'Insert Into Db',
			'SendingDateTime' => 'Sending Date Time',
			'SendBefore' => 'Send Before',
			'SendAfter' => 'Send After',
			'Text' => 'Text',
			'DestinationNumber' => 'Destination Number',
			'Coding' => 'Coding',
			'UDH' => 'Udh',
			'Class' => 'Class',
			'TextDecoded' => 'Text Decoded',
			'ID' => 'ID',
			'MultiPart' => 'Multi Part',
			'RelativeValidity' => 'Relative Validity',
			'SenderID' => 'Sender',
			'SendingTimeOut' => 'Sending Time Out',
			'DeliveryReport' => 'Delivery Report',
			'CreatorID' => 'Creator',
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

		$criteria->compare('UpdatedInDB',$this->UpdatedInDB,true);
		$criteria->compare('InsertIntoDB',$this->InsertIntoDB,true);
		$criteria->compare('SendingDateTime',$this->SendingDateTime,true);
		$criteria->compare('SendBefore',$this->SendBefore,true);
		$criteria->compare('SendAfter',$this->SendAfter,true);
		$criteria->compare('Text',$this->Text,true);
		$criteria->compare('DestinationNumber',$this->DestinationNumber,true);
		$criteria->compare('Coding',$this->Coding,true);
		$criteria->compare('UDH',$this->UDH,true);
		$criteria->compare('Class',$this->Class);
		$criteria->compare('TextDecoded',$this->TextDecoded,true);
		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('MultiPart',$this->MultiPart,true);
		$criteria->compare('RelativeValidity',$this->RelativeValidity);
		$criteria->compare('SenderID',$this->SenderID,true);
		$criteria->compare('SendingTimeOut',$this->SendingTimeOut,true);
		$criteria->compare('DeliveryReport',$this->DeliveryReport,true);
		$criteria->compare('CreatorID',$this->CreatorID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
