<?php

use yii\helpers\Html;
use yii\helpers\BaseStringHelper;
//use firdows\menu\models\Navigate;
//use culturePnPsu\material\components\Navigate;
use mdm\admin\components\Helper;

/* @var $this \yii\web\View */
/* @var $content string */

$controller = $this->context;
//$menus = $controller->module->menus;
//$route = $controller->route;
$user = Yii::$app->user->identity->profile->resultInfo;
$module = $this->context->module->id;
?>
<?php $this->beginContent('@app/views/layouts/main.php') ?>

<div class='box box-info'>
    <div class='box-header with-border'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->

    <div class='box-body pad'>
        <?= $content ?>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>


<?php $this->endContent(); ?>
