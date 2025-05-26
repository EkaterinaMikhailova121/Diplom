<?php

namespace app\controllers;
use Yii;
class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function beforeAction($action)
    {
        // Если пользователь не авторизован - перенаправляем на страницу входа
        if (Yii::$app->user->isGuest) {
            Yii::$app->user->loginRequired();
            return false;
        }
        
        // Проверяем, что пользователь имеет права администратора (admin = 1)
        if (Yii::$app->user->identity->admin != 1) {
            // Можно вывести сообщение об ошибке
            Yii::$app->session->setFlash('error', 'У вас нет прав доступа к этой странице');
            
            // Перенаправляем на главную страницу или другую подходящую
            $this->redirect(['site/index']);
            return false;
        }
        
        return parent::beforeAction($action);
    }
}
