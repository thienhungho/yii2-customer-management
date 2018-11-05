<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model thienhungho\CustomerManagement\modules\CustomerBase\Customer */

$this->title = Yii::t('app', 'Create Customer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
