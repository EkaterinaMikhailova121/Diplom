<?php
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Управление пользователями';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;600&display=swap');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

$css = <<<CSS
:root {
    --beige-light: #F8F4E9;
    --beige-medium: #E8E0D2;
    --navy-dark: #162A40;
    --navy-light: #2A4B6A;
    --text-dark: #333333;
    --text-light: #5A5A5A;
    --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.user-admin-page {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
    font-family: 'Raleway', sans-serif;
}

.page-title {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    color: var(--navy-dark);
    margin-bottom: 2rem;
    position: relative;
}

.page-title::after {
    content: '';
    display: block;
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, var(--navy-dark), var(--beige-medium));
    margin: 1rem 0;
}

.admin-container {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: var(--shadow);
}

.btn-create {
    background-color: var(--navy-dark);
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    font-size: 1rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s;
    font-weight: 600;
    margin-bottom: 1.5rem;
    display: inline-flex;
    align-items: center;
}

.btn-create:hover {
    background-color: var(--navy-light);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-create i {
    margin-right: 0.5rem;
}

/* Стили для таблицы */
.table-responsive {
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1.5rem;
}

.table th {
    background-color: var(--beige-light);
    color: var(--navy-dark);
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid var(--beige-medium);
}

.table td {
    padding: 1rem;
    border-bottom: 1px solid var(--beige-medium);
    vertical-align: middle;
}

.table tr:hover td {
    background-color: rgba(248, 244, 233, 0.5);
}

/* Стили для кнопок действий */
.action-column {
    white-space: nowrap;
    text-align: center;
}

.action-column a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    margin: 0 0.2rem;
    transition: all 0.3s;
}

.action-view {
    color: var(--navy-light);
    background-color: rgba(42, 75, 106, 0.1);
}

.action-update {
    color: #28a745;
    background-color: rgba(40, 167, 69, 0.1);
}

.action-delete {
    color: #dc3545;
    background-color: rgba(220, 53, 69, 0.1);
}

.action-column a:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Бейдж администратора */
.admin-badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.admin-true {
    background-color: #e8f5e9;
    color: #2e7d32;
}

.admin-false {
    background-color: #e3f2fd;
    color: #0d47a1;
}

/* Адаптивность */
@media (max-width: 768px) {
    .page-title {
        font-size: 1.8rem;
    }
    
    .admin-container {
        padding: 1.5rem;
    }
    
    .table th, .table td {
        padding: 0.75rem;
    }
}
CSS;

$this->registerCss($css);
?>

<div class="user-admin-page">
    <h1 class="page-title">
        <i class="fas fa-users-cog"></i> <?= Html::encode($this->title) ?>
    </h1>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                
                [
                    'attribute' => 'id',
                    'headerOptions' => ['width' => '80px'],
                ],
                
                'nickname',
                'username',
                'email:email',
                'phone',
                
                [
                    'attribute' => 'admin',
                    'label' => 'Роль',
                    'value' => function($model) {
                        return $model->admin 
                            ? '<span class="admin-badge admin-true"><i class="fas fa-crown"></i> Админ</span>'
                            : '<span class="admin-badge admin-false"><i class="fas fa-user"></i> Пользователь</span>';
                    },
                    'format' => 'raw',
                    'filter' => [
                        1 => 'Администраторы',
                        0 => 'Пользователи'
                    ],
                ],
                
                [
                    'class' => ActionColumn::className(),
                    'header' => 'Действия',
                    'headerOptions' => ['width' => '120px', 'class' => 'action-column'],
                    'contentOptions' => ['class' => 'action-column'],
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="fas fa-eye"></i>', $url, [
                                'class' => 'action-view',
                                'title' => 'Просмотр'
                            ]);
                        },
                    ],
                    'urlCreator' => function ($action, User $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
</div>