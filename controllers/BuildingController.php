<?php

namespace app\controllers;

use Yii;
use app\models\Building;
use yii\filters\AccessControl;
use app\models\BuildingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

/**
 * BuildingController implements the CRUD actions for Building model.
 */
class BuildingController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [ //these rows add permissions to the user if he is able to access the following pages
            [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                    'actions' => ['create', 'update', 'delete'],
                    'allow' => true,
                    'roles' => ['@']
                    ]
                ]
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
     * Lists all Building models.
     * @return mixed
     */
    public function actionIndex()
    {

        $request = Yii::$app->request;
        $getParams = $request->get();

        $searchModel = new BuildingSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $hasParams = $searchModel->load($getParams);

        $query = Building::find();

        // if(!empty($searchModel->city_id)) { //example
        //     $query->andFilterWhere(['city_id' => $searchModel->city_id]);
        // }
        // if (!empty($searchModel->name)) {
        //     $query->andFi
        // }

        if($hasParams) {
            $query->andFilterWhere(['city_id' => $searchModel->city_id]);
            $query->andFilterWhere(['like', 'name', $searchModel->name]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Building model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Building model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Building();
        $fileSuccess = NULL;

        if ($request->isPost) {
            
            $modelLoaded = $model->load($request->post());

            if (!$modelLoaded) {
                return $this->render('create', [
                    'model' => $model,
                    'errorMessage' => "Missing parameters!",
                ]);
            }
            // get the instance of the uploaded file
            $file = UploadedFile::getInstance($model, 'file');

            // if (!$file) {
            //     return $this->render('create', [
            //         'model' => $model,
            //         'errorMessage' => "File not selected!",
            //     ]);
            // }

            if($file){
                $photoPath = "Uploads/".$model->name."-".$file->name;
                $fileSuccess = $file->saveAs($photoPath);
            }

            if ($file && !$fileSuccess) {
                return $this->render('create', [
                    'model' => $model,
                    'errorMessage' => "Cannot write file to disk!",
                ]);
            }

            if ($file && $fileSuccess){
                // save the path in the db column
                $model->setAttribute('photo', $photoPath);
            }

            if ($model->validate() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->building_id]);
            }


        // if ($model->load(Yii::$app->request->post())) {
            
        //Yii::$app->params['uploadPath'] = Yii::getAlias("@web") . '/Uploads/';
        //$imageName = Yii::$app->security->generateRandomString()."{$model->name}";

        // get the instance of the uploaded file
        // $imageName = $model->name;
        // $model->file = UploadedFile::getInstance($model, 'file'); // model and attribute name
        // $model->file->saveAs('Uploads/'.$imageName.'.'.$model->file->extension);
        // save the path in the db column
        // $model->photo = 'Uploads/'.$imageName.'.'.$model->file->extension;

        // return $this->redirect(['view', 'id' => $model->building_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'errorMessage' => NULL,
        ]);
    }

    /**
     * Updates an existing Building model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $request = Yii::$app->request;

        if ($request->isPost) {
            
            $modelLoaded = $model->load($request->post());

            if (!$modelLoaded) {
                return $this->render('update', [
                    'model' => $model,
                    'errorMessage' => "Missing parameters!",
                ]);
            }
            // get the instance of the uploaded file
            $file = UploadedFile::getInstance($model, 'file');

            // if (!$file) {
            //     return $this->render('update', [
            //         'model' => $model,
            //         'errorMessage' => "File not selected!",
            //     ]);
            // }

            if($file){
                $photoPath = "Uploads/".$model->name."-".$file->name;
                $fileSuccess = $file->saveAs($photoPath);
            }

            if (!$fileSuccess) {
                return $this->render('update', [
                    'model' => $model,
                    'errorMessage' => "Cannot update file to disk!",
                ]);
            }
            // save the path in the db column
            $model->setAttribute('photo', $photoPath);

            if ($fileSuccess && $model->validate() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->building_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Building model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Building model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Building the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Building::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
