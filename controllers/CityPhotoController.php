<?php

namespace app\controllers;

use Yii;
use app\models\CityPhoto;
use yii\filters\AccessControl;
use app\models\CityPhotoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CityPhotoController implements the CRUD actions for CityPhoto model.
 */
class CityPhotoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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
     * Lists all CityPhoto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CityPhotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CityPhoto model.
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
     * Creates a new CityPhoto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new CityPhoto();
        $model->scenario = 'create';
        $fileSuccess = NULL;

        $files = UploadedFile::getInstances($model, 'files');

        if($files) {
            foreach ($files as $file) {
                $model = new CityPhoto();
            

                if ($request->isPost) {
                
                    $modelLoaded = $model->load($request->post());

                    if (!$modelLoaded) {
                        return $this->render('create', [
                            'model' => $model,
                            'errorMessage' => "Missing parameters!",
                        ]);
                    }
                    
                    //$conn = mysqli_connect("127.0.0.53","root", "", "dbtest");
                    $photoPath = 'Uploads/' . $model->city->name . '---' . $file->name;//Yii::$app->security->generateRandomString();
                    $fileSuccess = $file->saveAs($photoPath);
                    if ($file && !$fileSuccess) {
                        return $this->render('create', [
                            'model' => $model,
                            'errorMessage' => "Cannot write file to disk!",
                        ]);
                    }
                    if ($file && $fileSuccess) {
                        $model->setAttribute('photo', $photoPath);
                        $model->save();
                    }
                }
            }

            if ($model->validate()) {
                return $this->redirect(['view', 'id' => $model->city_photo_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'errorMessage' => NULL,
        ]);
    }

    /**
     * Updates an existing CityPhoto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        $request = Yii::$app->request;
        $fileSuccess = NULL;
        $photoPathOld = NULL;

        if ($request->isPost) {

            $modelLoaded = $model->load($request->post());

            if($model->photo){
                $photoPathOld = Yii::$app->basePath.'/web/'.$model->photo; //get the path to the existing file
            }

            if (!$modelLoaded) {
                return $this->render('update', [
                    'model' => $model,
                    'errorMessage' => "Missing parameters!",
                ]);
            }

            $files = UploadedFile::getInstances($model, 'files');

            if($files){
                foreach ($files as $file) {
                    $photoPath = 'Uploads/' . $model->city->name . '---' . $file->name;
                    if(file_exists($photoPathOld)){
                        if(strcmp($photoPath, $photoPathOld) !== 0){
                            @unlink($photoPathOld);
                        }
                    }
                    $fileSuccess = $file->saveAs($photoPath);
                }
            }

            if ($files && !$fileSuccess) {
                return $this->render('update', [
                    'model' => $model,
                    'errorMessage' => "Cannot update file to disk!",
                ]);
            }

            if ($files && $fileSuccess){
                // save the path in the db column
                $model->setAttribute('photo', $photoPath);
            }

            if ($model->validate() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->city_photo_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CityPhoto model.
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
     * Finds the CityPhoto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CityPhoto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CityPhoto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	public function actionPhotos()
    {
		 return $this->render('_photos_form');
	}
}
