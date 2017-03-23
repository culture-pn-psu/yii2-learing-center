<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use culturePnPsu\learningCenter\models\LearningCenter;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\learningCenter\models\LearningCenter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="learning-center-form">

    <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-3',
                    'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-9',
                    'error' => '',
                    'hint' => '',
                ],
            ],
            'id' => 'dynamic-form'
    ]); ?>

    <?= Html::errorSummary($model) ?>
    
    
    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(LearningCenter::getStatusList(),[
        'prompt' => Yii::t('culture','Select')
    ]) ?>

    
    <div class="form-group ">
        <?=Html::activeLabel($model,'history',['class'=>'control-label col-sm-3'])?>
        <div class="col-sm-9" style="padding:0 10px;">
            <?= $this->render('_formHistory',[
                'form' => $form,
                'model' => $model,
                'modelsHistory' => $modelsHistory
            ])?>
       </div>
    </div>
   
   
   
   

    <div class="form-group ">
        <div class="col-sm-offset-3">
        <?= Html::submitButton(Yii::t('culture/learning', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
