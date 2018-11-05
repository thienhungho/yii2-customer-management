<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model thienhungho\CustomerManagement\modules\CustomerBase\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="col-lg-9 col-xs-12">
        <!--        --><? //= $form->field($model, 'user_id', [
        //            'addon' => ['prepend' => ['content' => '<span class="fa fa-user"></span>']],
        //        ])->widget(\kartik\widgets\Select2::classname(), [
        //            'data'          => \yii\helpers\ArrayHelper::map(\thienhungho\UserManagement\modules\UserBase\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        //            'options'       => ['placeholder' => Yii::t('app', 'Choose User')],
        //            'pluginOptions' => [
        //                'allowClear' => true,
        //            ],
        //        ]); ?>

        <?= $form->field($model, 'first_name', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-user"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => t('app', 'First Name'),
        ]) ?>

        <?= $form->field($model, 'last_name', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-user"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => t('app', 'Last Name'),
        ]) ?>

        <?= $form->field($model, 'company', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-building"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => t('app', 'Company'),
        ]) ?>

        <?= $form->field($model, 'phone', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-phone"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => t('app', 'Phone'),
        ]); ?>

        <?= $form->field($model, 'email', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-envelope"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => t('app', 'Email'),
        ]) ?>

        <?= $form->field($model, 'website', [
            'addon' => ['prepend' => ['content' => '<span class="glyphicon glyphicon-link"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => 'Website',
        ]) ?>

        <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'avatar')->fileInput()
            ->widget(\kartik\file\FileInput::classname(), [
                'options'       => ['accept' => 'image/*'],
                'pluginOptions' => empty($model->avatar) ? [] : [
                    'initialPreview'       => [
                        '/' . $model->avatar,
                    ],
                    'initialPreviewAsData' => true,
                    'initialCaption'       => $model->avatar,
                    'overwriteInitial'     => true,
                ],
            ]);
        ?>
    </div>

    <div class="col-lg-3 col-xs-12">

        <?= $form->field($model, 'type', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-eye"></span>']],
        ])->radioButtonGroup([
            'personal'  => t('app', 'Personal'),
            'enterprise' => t('app', 'Enterprise'),
        ], [
            'class'       => 'btn-group-sm',
            'itemOptions' => ['labelOptions' => ['class' => 'btn green']],
        ]); ?>



        <?= $form->field($model, 'status', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-eye"></span>']],
        ])->radioButtonGroup([
            STATUS_ACTIVE  => t('app', slug_to_text(STATUS_ACTIVE)),
            STATUS_PENDING => t('app', slug_to_text(STATUS_PENDING)),
            STATUS_DISABLE => t('app', slug_to_text(STATUS_DISABLE)),
            'potential'    => t('app', 'Potential'),
            'debt'         => t('app', 'Debt'),
        ], [
            'class'       => 'btn-group-sm',
            'itemOptions' => ['labelOptions' => ['class' => 'btn green']],
        ]); ?>

        <?= $form->field($model, 'vat_number', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-bank"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => 'Vat Number',
        ]) ?>

        <?= language_select_input($form, $model) ?>

        <?= country_select_input($form, $model) ?>

        <?= $form->field($model, 'city', [
            'addon' => ['prepend' => ['content' => '<span class="glyphicon glyphicon-map-marker"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => 'City',
        ]) ?>

        <?= $form->field($model, 'state', [
            'addon' => ['prepend' => ['content' => '<span class="glyphicon glyphicon-map-marker"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => 'State',
        ]) ?>

        <?= $form->field($model, 'zip_code', [
            'addon' => ['prepend' => ['content' => '<span class="glyphicon glyphicon-barcode"></span>']],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => 'Zip Code',
        ]) ?>

        <?= $form->field($model, 'currency', [
            'addon' => ['prepend' => ['content' => '<span class="fa fa-money"></span>']],
        ])->widget(\kartik\widgets\Select2::classname(), [
            'data'          => get_all_currency_code(),
            'options'       => ['placeholder' => t('app', 'Choose Currency')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]); ?>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?><?php endif; ?><?php if (Yii::$app->controller->action->id != 'create'): ?>
                <?= Html::submitButton(Yii::t('app', 'Save As New'), [
                    'class' => 'btn btn-info',
                    'value' => '1',
                    'name'  => '_asnew',
                ]) ?><?php endif; ?>
            <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
