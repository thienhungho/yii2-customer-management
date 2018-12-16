<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use thienhungho\Widgets\models\GridView;

/* @var $this yii\web\View */
/* @var $model thienhungho\CustomerManagement\modules\CustomerBase\Customer */

?>
<div class="customer-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'user.username',
            'label' => Yii::t('app', 'User'),
        ],
        'avatar',
        'first_name',
        'last_name',
        'company',
        'phone',
        'email:email',
        'website',
        'vat_number',
        'language',
        'address:ntext',
        'country',
        'city',
        'state',
        'zip_code',
        'currency',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>