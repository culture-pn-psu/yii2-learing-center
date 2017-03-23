<?php

use yii\bootstrap\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use culturePnPsu\learningCenter\models\LearningCenterHistory;
use kartik\widgets\TimePicker;

// echo "<pre>";
// print_r($model->history);
// exit();
/* @var $this yii\web\View */
/* @var $model culturePnPsu\learningCenter\models\LearningCenter */
/* @var $form yii\widgets\ActiveForm */
$template['horizontalCssClasses'] = [
                    'label' => false,
                    'offset' => false,
                    'wrapper' => 'col-sm-12',
                    'error' => '',
                    'hint' => '',
                ];
?>


   <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.house-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-house',
        'deleteButton' => '.remove-house',
        'model' => $modelsRange[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'description',
        ],
    ]); ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width: 30%;"><?=Yii::t('culture/learning', 'Title Range')?></th>
                <th style="width: 60%;"><?=Yii::t('culture/learning', 'Time')?></th>
                <th class="text-center" style="width: 90px;">
                    <button type="button" class="add-house btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsRange as $key => $item): ?>
        
            <tr class="house-item">
                <td class="vcenter">
                    <?= $form->field($item, "[{$key}]title",$template)->label(false)->textInput(['maxlength' => true]) ?>
                </td>
                <td>
                   <?= $form->field($item, "[{$key}]time",$template)->label(false)->widget(TimePicker::className(),
                   [
                   
                    'pluginOptions' => [
                        'showSeconds' => false,
                        'showMeridian' => false,
                        'minuteStep' => 1,
                        'secondStep' => 5,
                    ]
                ]) ?>
                </td>
                <td class="text-center vcenter" style="width: 90px; verti">
                    <button type="button" class="remove-house btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
                </td>
            </tr>
            
         <?php endforeach; ?>
        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>
   
   
