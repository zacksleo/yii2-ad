<?php

namespace zacksleo\yii2\ad\tests\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use zacksleo\yii2\ad\models\Ad;
use yii\web\Controller;

class AdController extends Controller
{
    /**
     * Lists all Ad models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $dataProvider = new ActiveDataProvider([
            'query' => Ad::find(),
        ]);
    }

    public function actionCreate()
    {
        $data =Yii::$app->request->bodyParams;
        $model = new Ad();
        $model->setScenario('insert');
        $model->load($data) && $model->save();
        return $model;
    }

    public function actionUpdate($id)
    {
        $data =Yii::$app->request->bodyParams;
        $model = $this->findModel($id);
        $model->scenario = 'update';
        $model->load($data) && $model->save();
        return $model;
    }

    public function actionDelete($id)
    {
        return $this->findModel($id)->delete();
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    protected function findModel($id)
    {
        if (($model = Ad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
