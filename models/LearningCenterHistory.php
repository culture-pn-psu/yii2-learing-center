<?php

namespace culturePnPsu\learningCenter\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;

use culturePnPsu\person\models\Person;


/**
 * This is the model class for table "learning_center".
 *
 * @property int $id
 * @property int $title
 * @property int $status
 * @property string $history
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 */
class LearningCenterHistory extends \yii\base\Model
{
    public $learning_center_id;
    public $topic;
    public $detail;
    
    public function attributeLabels()
    {
        return [
            'topic' => Yii::t('culture/learning', 'Topic'),
            'detail' => Yii::t('culture/learning', 'Detail'),
        ];
    }
    
     public function learningCenter(){
         return $this->hasOne(LearningCenter::className(), ['id' => 'user_id']);
     }
     
     
     
}
