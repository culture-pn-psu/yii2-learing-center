<?php

namespace culturePnPsu\learningCenter\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "learning_center_range".
 *
 * @property int $learngin_center_id
 * @property string $title
 * @property string $time
 * @property string $note
 *
 * @property LearningCenter $learnginCenter
 */
class LearningCenterRange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'learning_center_range';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['learngin_center_id', 'title', 'time'], 'required'],
            [['learngin_center_id'], 'integer'],
            [['time'], 'safe'],
            [['note'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['learngin_center_id', 'title'], 'unique', 'targetAttribute' => ['learngin_center_id', 'title']],
            [['learngin_center_id', 'time'], 'unique', 'targetAttribute' => ['learngin_center_id', 'time']],
            [['learngin_center_id'], 'exist', 'skipOnError' => true, 'targetClass' => LearningCenter::className(), 'targetAttribute' => ['learngin_center_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'learngin_center_id' => Yii::t('culture/learning', 'Learngin Center ID'),
            'title' => Yii::t('culture/learning', 'Title Range'),
            'time' => Yii::t('culture/learning', 'Time'),
            'note' => Yii::t('culture/learning', 'Note'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnginCenter()
    {
        return $this->hasOne(LearningCenter::className(), ['id' => 'learngin_center_id']);
    }
    
    public static function getList(){
       $model =  self::find()->distinct(['title','time'])->all();
       return ArrayHelper::map($model,'time','title');
    }
}
