<?php

namespace app\controllers;

use app\models\Author;
use app\models\AuthorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;
/**
 * AuthorController implements the CRUD actions for Author model.
 */
class AuthorController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Author models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AuthorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCatalog()
    {
        $searchModel = new AuthorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_products', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel
            ]);
        }
    
        return $this->render('catalog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Author model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Author model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Author();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->photo=UploadedFile::getInstance($model,'photo');
            $file_name='image/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->photo->extension;
            $model->photo->saveAs(\Yii::$app->basePath .'/web/'. $file_name);
            if ($model->save(false)) {
            Yii::$app->db->createCommand()->update('author', ['photo' => $file_name], "id = '$model->id'")->execute();
                return $this->redirect(['/author/catalog']);
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Author model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $currentPhoto = $model->photo; // Сохраняем текущее фото
    
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $uploadedPhoto = UploadedFile::getInstance($model, 'photo');
            
            if ($uploadedPhoto) {
                // Если загружено новое фото - обрабатываем его
                $file_name = 'image/' . \Yii::$app->getSecurity()->generateRandomString(50) . '.' . $uploadedPhoto->extension;
                $uploadedPhoto->saveAs(\Yii::$app->basePath . '/web/' . $file_name);
                $model->photo = $file_name;
            } else {
                // Если фото не загружено - оставляем текущее
                $model->photo = $currentPhoto;
            }
    
            if ($model->save(false)) {
                return $this->redirect(['/author/catalog']);
            }
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Author model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/author/catalog']);
    }

    /**
     * Finds the Author model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Author the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Author::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
