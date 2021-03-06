<?php

namespace app\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use app\models;

/**
 * NoticeController implements the CRUD actions for Notice model.
 */
class NoticeController extends BaseController
{
    /**
     * Lists all Notice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new models\NoticeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new models\Notice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'codes' => Yii::$app->notice->prepareEventsDataForSelect(),
                'codeParams' => Yii::$app->notice->getEventsParams(),
                'types' => models\NoticeType::getList(),
                'users' => models\User::getList(),
            ]);
        }
    }

    /**
     * Updates an existing Notice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'codes' => Yii::$app->notice->prepareEventsDataForSelect(),
                'codeParams' => Yii::$app->notice->getEventsParams(),
                'types' => models\NoticeType::getList(),
                'users' => models\User::getList(),
            ]);
        }
    }

    /**
     * Deletes an existing Notice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return models\Notice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = models\Notice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
