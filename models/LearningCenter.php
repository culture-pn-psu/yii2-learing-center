<?php

namespace culturePnPsu\learningCenter\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;

use culturePnPsu\person\models\Person;
use wowkaster\serializeAttributes\SerializeAttributesBehavior;


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
class LearningCenter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'learning_center';
    }
    
    function behaviors()
    {
        return [ 
          'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
            ],
            'serialize' => [
                'class' => SerializeAttributesBehavior::className(),
                'convertAttr' => ['history' => 'serialize']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['history'], 'safe'],
            [['title'], 'string', 'max' => 255], 
            [['title'], 'unique'],
        ];
    }
    
    
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('culture/learning', 'ID'),
            'title' => Yii::t('culture/learning', 'Title'),
            'status' => Yii::t('culture/learning', 'Status'),
            'history' => Yii::t('culture/learning', 'History'),
            'learningCenterRange' => Yii::t('culture/learning', 'Learning Center Range'),
            'created_at' => Yii::t('culture', 'Created At'),
            'created_by' => Yii::t('culture', 'Created By'),
            'updated_at' => Yii::t('culture', 'Updated At'),
            'updated_by' => Yii::t('culture', 'Updated By'),
        ];
    }
    const STATUS_CLOSE = 0;
    const STATUS_OPEN = 1;
    const STATUS_RECONSTRUCTION = 2;

    
    public function getItems($key){
        $items = [
            'status'=> [
                self::STATUS_CLOSE => Yii::t('culture/learning', 'Clone'),
                self::STATUS_OPEN => Yii::t('culture/learning', 'Open'),
                self::STATUS_RECONSTRUCTION => Yii::t('culture/learning', 'Reconstruction'),
                ]
            ];
        return ArrayHelper::getValue($items,$key);
    }
    
    public function getStatusLabel(){
        return ArrayHelper::getValue(self::getItems('status'),$this->status);
    }
    
    public static function getStatusList(){
        return self::getItems('status');
    }

    
    // public function createdBy(){
    //     return 
    // }
    
    public static function getList(){
        return ArrayHelper::map(self::find()->all(),'id','title');
    }
    
    
    public function getHistoryDisplay(){
        $result = ArrayHelper::getColumn($this->history, function ($element) {
            return '<div class="form-group"><label class="control-label col-sm-2 text-rigth">'.$element['topic'].":</label><div clas='col-sm-9'>".$element['detail']."</div></div>";
        });
        return implode('',$result);

    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
   public function getLearningCenterRange()
   {
       return $this->hasMany(LearningCenterRange::className(), ['learngin_center_id' => 'id']);
   }
   
   
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getLearningCenterRangeDisplay()
   {
       $result = ArrayHelper::getColumn($this->learningCenterRange, function ($element) {
            return '<div class="form-group"><label class="control-label col-sm-2 text-rigth">'.$element->title." :</label><div clas='col-sm-9'>".Yii::$app->formatter->asTime($element->time,"php:H:i")." น.</div></div>";
        });
        return implode('',$result);
   }
   
   /**
    * @return \yii\db\ActiveQuery
    */
//   public static function getLearningCenterRangeList()
//   {
//       $model =  self::hasMany(LearningCenterRange::className(), ['learngin_center_id' => 'id'])->distinct(['title','time'])->select(['learngin_center_id','title']);
//       return ArrayHelper::map($model,'learngin_center_id','title');
//   }
    
}
