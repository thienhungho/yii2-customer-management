<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use thienhungho\Widgets\models\GridView;

/* @var $this yii\web\View */
/* @var $model thienhungho\CustomerManagement\modules\CustomerBase\Customer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Customer').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'User')
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
    
    <div class="row">
<?php
if($providerCustomerBillingAddress->totalCount){
    $gridColumnCustomerBillingAddress = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'country',
        'city',
        'state',
        'zip_code',
        'phone',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCustomerBillingAddress,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Customer Billing Address')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnCustomerBillingAddress
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerCustomerNote->totalCount){
    $gridColumnCustomerNote = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'content',
        'type',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCustomerNote,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Customer Note')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnCustomerNote
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerCustomerReminders->totalCount){
    $gridColumnCustomerReminders = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'content',
        'type',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCustomerReminders,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Customer Reminders')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnCustomerReminders
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerCustomerShippingAddress->totalCount){
    $gridColumnCustomerShippingAddress = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'country',
        'city',
        'state',
        'zip_code',
        'phone',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCustomerShippingAddress,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Customer Shipping Address')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnCustomerShippingAddress
    ]);
}
?>
    </div>
</div>
