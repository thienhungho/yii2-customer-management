<?php

namespace thienhungho\CustomerManagement\modules\CustomerManage\controllers;

use thienhungho\CustomerManagement\modules\CustomerBase\Customer;
use thienhungho\CustomerManagement\modules\CustomerManage\search\CustomerSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
//        $providerCustomerBillingAddress = new \yii\data\ArrayDataProvider([
//            'allModels' => $model->customerBillingAddresses,
//        ]);
//        $providerCustomerNote = new \yii\data\ArrayDataProvider([
//            'allModels' => $model->customerNotes,
//        ]);
//        $providerCustomerReminders = new \yii\data\ArrayDataProvider([
//            'allModels' => $model->customerReminders,
//        ]);
//        $providerCustomerShippingAddress = new \yii\data\ArrayDataProvider([
//            'allModels' => $model->customerShippingAddresses,
//        ]);
//
//        return $this->render('view', [
//            'model'                           => $model,
//            'providerCustomerBillingAddress'  => $providerCustomerBillingAddress,
//            'providerCustomerNote'            => $providerCustomerNote,
//            'providerCustomerReminders'       => $providerCustomerReminders,
//            'providerCustomerShippingAddress' => $providerCustomerShippingAddress,
//        ]);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $model = new Customer();
        $model->language = get_primary_language();
        $model->status = STATUS_ACTIVE;
        $model->type = 'personal';

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect([
                'update',
                'id' => $model->id,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new Customer();
        } else {
            $model = $this->findModel($id);
        }
        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect([
                'view',
                'id' => $model->id,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     *
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionPdf($id)
    {
        $model = $this->findModel($id);
        $providerCustomerBillingAddress = new \yii\data\ArrayDataProvider([
            'allModels' => $model->customerBillingAddresses,
        ]);
        $providerCustomerNote = new \yii\data\ArrayDataProvider([
            'allModels' => $model->customerNotes,
        ]);
        $providerCustomerReminders = new \yii\data\ArrayDataProvider([
            'allModels' => $model->customerReminders,
        ]);
        $providerCustomerShippingAddress = new \yii\data\ArrayDataProvider([
            'allModels' => $model->customerShippingAddresses,
        ]);
        $content = $this->renderAjax('_pdf', [
            'model'                           => $model,
            'providerCustomerBillingAddress'  => $providerCustomerBillingAddress,
            'providerCustomerNote'            => $providerCustomerNote,
            'providerCustomerReminders'       => $providerCustomerReminders,
            'providerCustomerShippingAddress' => $providerCustomerShippingAddress,
        ]);
        $pdf = new \kartik\mpdf\Pdf([
            'mode'        => \kartik\mpdf\Pdf::MODE_UTF8,
            'format'      => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content'     => $content,
            'cssFile'     => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline'   => '.kv-heading-1{font-size:18px}',
            'options'     => ['title' => \Yii::$app->name],
            'methods'     => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ],
        ]);

        return $pdf->render();
    }

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionSaveAsNew($id)
    {
        $model = new Customer();
        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }
        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect([
                'view',
                'id' => $model->id,
            ]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionAddCustomerBillingAddress()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('CustomerBillingAddress');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];

            return $this->renderAjax('_formCustomerBillingAddress', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionAddCustomerNote()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('CustomerNote');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];

            return $this->renderAjax('_formCustomerNote', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionAddCustomerReminders()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('CustomerReminders');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];

            return $this->renderAjax('_formCustomerReminders', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionAddCustomerShippingAddress()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('CustomerShippingAddress');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];

            return $this->renderAjax('_formCustomerShippingAddress', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
