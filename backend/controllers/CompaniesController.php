<?php

namespace backend\controllers;

use backend\models\Branches;
use Yii;
use backend\models\Companies;
use backend\models\CompaniesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;

/**
 * CompaniesController implements the CRUD actions for Companies model.
 */
class CompaniesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'view', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Companies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Companies model.
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
     * Creates a new Companies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('create-company')) {
            $model = new Companies();
            $branch = new Branches();

            if ($model->load(Yii::$app->request->post()) &&
                $branch->load(Yii::$app->request->post())) {
                $this->saveLogo($model);
                $model->created_date = date('Y/m/d H:i:s');
                $model->save();
                $branch->company_id = $model->id;
                $branch->created_date = date('Y-m-d h:m:s');
                $branch->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'branch' => $branch,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Companies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $this->saveLogo($model);
            $model->save();
            Yii::$app->mailer->compose()
                ->setFrom(['rangelvmarinov@gmail.com' => 'Rangel'])
                ->setTo('rangelvmarinov@gmail.com')
                ->setSubject('Successfully update company.')
                ->setHtmlBody('Hello ' . Yii::$app->user->identity->fullNames . ',<br>
                    You have successfully update ' . $model->name . ' company')
                ->send();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Companies model.
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
     * Finds the Companies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param Companies $model
     */
    public function saveLogo(Companies $model)
    {
        Yii::info(\yii\helpers\VarDumper::dumpAsString(111));
        $imageName = $model->name;
        //get instance of the upload file
        $model->file = UploadedFile::getInstance($model, 'file');
        if ($model->file) {
            Yii::info(\yii\helpers\VarDumper::dumpAsString(222));
            $model->file->saveAs('uploads/' . $imageName . '.' . $model->file->extension);
            $model->logo = 'uploads/' . $imageName . '.' . $model->file->extension;
        }
    }
}
