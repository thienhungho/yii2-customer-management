<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Customer')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Customer Billing Address')),
        'content' => $this->render('_dataCustomerBillingAddress', [
            'model' => $model,
            'row' => $model->customerBillingAddresses,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Customer Note')),
        'content' => $this->render('_dataCustomerNote', [
            'model' => $model,
            'row' => $model->customerNotes,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Customer Reminders')),
        'content' => $this->render('_dataCustomerReminders', [
            'model' => $model,
            'row' => $model->customerReminders,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Customer Shipping Address')),
        'content' => $this->render('_dataCustomerShippingAddress', [
            'model' => $model,
            'row' => $model->customerShippingAddresses,
        ]),
    ],
    ];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'class' => 'tes',
    'pluginOptions' => [
        'bordered' => true,
        'sideways' => true,
        'enableCache' => false
    ],
]);
?>
