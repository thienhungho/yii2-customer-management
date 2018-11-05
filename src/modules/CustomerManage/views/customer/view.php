<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model thienhungho\CustomerManagement\modules\CustomerBase\Customer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Customer').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
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
    <div class="row">
        <h4>User<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUser = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email:email',
        'full_name',
        'job',
        'bio',
        'company',
        'tax_number',
        'address:ntext',
        'avatar',
        'phone',
        'birth_date',
        'facebook_url',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model->user,
        'attributes' => $gridColumnUser    ]);
    ?>
    
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-customer-billing-address']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Customer Billing Address')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-customer-note']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Customer Note')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-customer-reminders']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Customer Reminders')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-customer-shipping-address']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Customer Shipping Address')),
        ],
        'columns' => $gridColumnCustomerShippingAddress
    ]);
}
?>

    </div>
</div>
