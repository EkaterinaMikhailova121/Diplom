<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCatalog()
    {
        $searchModel = new ProductSearch();
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
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->photo=UploadedFile::getInstance($model,'photo');
            $file_name='image/' . \Yii::$app->getSecurity()->generateRandomString(50). '.' . $model->photo->extension;
            $model->photo->saveAs(\Yii::$app->basePath .'/web/'. $file_name);
            if ($model->save(false)) {
            Yii::$app->db->createCommand()->update('product', ['photo' => $file_name], "id = '$model->id'")->execute();
                return $this->redirect(['/product/catalog']);
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
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
                return $this->redirect(['/product/catalog']);
            }
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
