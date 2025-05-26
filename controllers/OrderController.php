<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OrderStatus;
use app\models\Cart;
use app\models\Product;
use Yii;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
    
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['site/login']);
            return false;
        }
        return true;
    } 
    
    /**
     * Lists all Order models.
     *
     * @return string
     */

    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        
        // Если пользователь не админ, добавляем условие фильтрации по его ID
        if (!Yii::$app->user->identity->isAdmin()) {
            $searchModel->user_id = Yii::$app->user->id;
        }
        
        $dataProvider = $searchModel->search($this->request->queryParams);
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $carts = Cart::find()->where(['order_id'=>$id])->all();
        if (count($carts) == 0 || (!Yii::$app->user->identity->isAdmin() && $carts[0]->user_id != Yii::$app->user->identity->id)) {
            return $this->goHome();
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Order();
        $model->user_id = Yii::$app->user->id;
        $model->status_id = OrderStatus::find()->where(['name' => 'Новый'])->scalar();
        
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Сначала сохраняем заказ
                if (!$model->save()) {
                    throw new \Exception('Не удалось сохранить заказ');
                }
                
                // Получаем товары из корзины
                $cartItems = Cart::find()
                    ->where(['user_id' => Yii::$app->user->id, 'order_id' => null])
                    ->all();
                
                if (empty($cartItems)) {
                    throw new \Exception('В корзине нет товаров');
                }
                
                // Привязываем товары к заказу и обновляем остатки
                foreach ($cartItems as $item) {
                    $product = $item->product;
                    if (!$product) {
                        throw new \Exception("Товар не найден");
                    }
                    
                    if ($product->count < $item->count) {
                        throw new \Exception("Недостаточно товара '{$product->name}' на складе");
                    }
                    
                    $product->count -= $item->count;
                    if (!$product->save()) {
                        throw new \Exception("Ошибка обновления количества товара");
                    }
                    
                    $item->order_id = $model->id;
                    if (!$item->save()) {
                        throw new \Exception("Ошибка привязки товара к заказу");
                    }
                }
                
                $transaction->commit();
                return $this->redirect(['success', 'id' => $model->id]);
                
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionSuccess($id)
    {
        $order = Order::findOne($id);
        
        if (!$order || $order->user_id != Yii::$app->user->id) {
            throw new NotFoundHttpException('Заказ не найден.');
        }
        
        return $this->render('success', [
            'order' => $order,
        ]);
    }
    
    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */


    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */


    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionUpdateStatus($id)
{
    $model = $this->findModel($id);
    
    // Проверяем, что статус еще можно изменить
    if (in_array($model->status_id, [4, 5])) {
        Yii::$app->session->setFlash('error', 'Статус заказа "'.$model->status->name.'" нельзя изменить.');
        return $this->redirect(['view', 'id' => $model->id]);
    }
    
    if (Yii::$app->request->isPost) {
        $newStatusId = Yii::$app->request->post('status_id');
        $model->status_id = $newStatusId;
        
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Статус заказа успешно обновлен.');
            
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка при обновлении статуса.');
        }
    }
    
    return $this->redirect(['view', 'id' => $model->id]);
}
    

}