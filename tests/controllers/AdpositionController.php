<?php

namespace zacksleo\yii2\ad\tests\controllers;

use Yii;
use zacksleo\yii2\ad\models\AdPosition;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * AdPositionController implements the CRUD actions for AdPosition model.
 */
class AdpositionController extends Controller
{
    /**
     * @return ActiveDataProvider
     */
    public function actionIndex()
    {
        return $dataProvider = new ActiveDataProvider([
            'query' => AdPosition::find(),
        ]);
    }

    /**
     * Displays a single AdPosition model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * Creates a new AdPosition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $data = Yii::$app->request->bodyParams;
        $find = AdPosition::find()->all();
        if (count($find) == 1) {
            return $find[0];
        }
        $model = new AdPosition();
        if ($model->load($data) && $model->save()) {
            return $model;
        }
        return null;
    }

    /**
     * Updates an existing AdPosition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $data = Yii::$app->request->bodyParams;
        $model = $this->findModel($id);
        if ($model->load($data) && $model->save()) {
            return true;
        }
        return false;
    }

    /**
     * Deletes an existing AdPosition model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return $this->findModel($id)->delete();
    }

    /**
     * Finds the AdPosition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdPosition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdPosition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
