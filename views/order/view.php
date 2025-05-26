<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Order;
use yii\helpers\ArrayHelper;
use app\models\OrderStatus;

$this->title = 'Заказ #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Мои заказы', 'url' => ['index']];
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

.order-view-page {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
    font-family: 'Raleway', sans-serif;
}

.page-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    color: var(--navy-dark);
    margin-bottom: 2rem;
    text-align: center;
    position: relative;
}

.page-title::after {
    content: '';
    display: block;
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, var(--navy-dark), var(--beige-medium));
    margin: 1rem auto 0;
}

.order-container {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: var(--shadow);
    margin-bottom: 2rem;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--beige-light);
}

.order-id {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--navy-dark);
}

.order-date {
    font-size: 1rem;
    color: var(--text-light);
}

.order-status {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 1rem;
    font-weight: 600;
}

.status-new {
    background-color: #E3F2FD;
    color: #0D47A1;
}

.status-processing {
    background-color: #FFF8E1;
    color: #FF8F00;
}

.status-completed {
    background-color: #E8F5E9;
    color: #2E7D32;
}

.status-cancelled {
    background-color: #FFEBEE;
    color: #C62828;
}

.order-details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.detail-card {
    background: var(--beige-light);
    border-radius: 8px;
    padding: 1.5rem;
}

.detail-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    color: var(--navy-dark);
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--beige-medium);
}

.detail-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.8rem;
}

.detail-label {
    font-weight: 600;
    color: var(--navy-dark);
}

.detail-value {
    color: var(--text-dark);
    text-align: right;
}

.order-items {
    margin-top: 2rem;
}

.order-items-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: var(--navy-dark);
    margin-bottom: 1.5rem;
}

.order-item {
    display: flex;
    align-items: center;
    padding: 1.5rem 0;
    border-bottom: 1px solid var(--beige-medium);
}

.order-item:last-child {
    border-bottom: none;
}

.item-image {
    width: 80px;
    height: 120px;
    object-fit: cover;
    border-radius: 4px;
    margin-right: 2rem;
    box-shadow: var(--shadow);
}

.item-info {
    flex-grow: 1;
}

.item-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    color: var(--navy-dark);
    margin-bottom: 0.5rem;
}

.item-author {
    font-size: 0.9rem;
    color: var(--text-light);
    font-style: italic;
    margin-bottom: 0.5rem;
}

.item-price {
    font-size: 1rem;
    color: var(--navy-dark);
    font-weight: 600;
}

.item-quantity {
    font-size: 1rem;
    color: var(--text-dark);
    margin-right: 2rem;
}

.item-total {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--navy-dark);
    min-width: 100px;
    text-align: right;
}

.order-summary {
    margin-top: 3rem;
    background: var(--beige-light);
    border-radius: 8px;
    padding: 2rem;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.summary-total {
    font-weight: 600;
    font-size: 1.3rem;
    color: var(--navy-dark);
    border-top: 1px solid var(--beige-medium);
    padding-top: 1rem;
    margin-top: 1rem;
}

.order-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
}

.btn {
    padding: 0.8rem 1.5rem;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s;
    font-weight: 600;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background-color: var(--navy-dark);
    color: white;
}

.btn-primary:hover {
    background-color: var(--navy-light);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-danger {
    background-color: #e74c3c;
    color: white;
}

.btn-danger:hover {
    background-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.status-form {
    margin-top: 2rem;
    padding: 1.5rem;
    background: var(--beige-light);
    border-radius: 8px;
}

.status-form-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    color: var(--navy-dark);
    margin-bottom: 1rem;
}

.status-select {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.status-select select {
    flex-grow: 1;
    padding: 0.5rem;
    border: 1px solid var(--beige-medium);
    border-radius: 4px;
    background: white;
    font-family: 'Raleway', sans-serif;
}

.status-select button {
    padding: 0.5rem 1.5rem;
}
@media (max-width: 768px) {
    .order-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .order-details-grid {
        grid-template-columns: 1fr;
    }
    
    .order-item {
        flex-wrap: wrap;
        position: relative;
        padding-bottom: 3rem;
    }
    
    .item-image {
        width: 60px;
        height: 90px;
        margin-right: 1rem;
    }
    
    .item-quantity {
        position: absolute;
        left: 80px;
        bottom: 1.5rem;
    }
    
    .item-total {
        position: absolute;
        right: 10px;
        bottom: 1.5rem;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 2rem;
    }
    
    .order-container {
        padding: 1.5rem;
    }
}
CSS;

$this->registerCss($css);
?>

<div class="order-view-page">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

    <div class="order-container">
        <div class="order-header">
            <div>
                <span class="order-id">Заказ #<?= $model->id ?></span>
                <span class="order-date"><?= Yii::$app->formatter->asDate($model->date, 'long') ?></span>
            </div>
            <span class="order-status status-<?= strtolower($model->status->name ?? 'new') ?>">
                <?= $model->status->name ?? 'Новый' ?>
            </span>
        </div>
        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
            <div class="status-form">
                <h3 class="status-form-title">Изменение статуса заказа</h3>
                
                <?php if (!in_array($model->status_id, [4, 5])): // Если статус не "Отменен" и не "Доставлен" ?>
                    <?php $form = \yii\widgets\ActiveForm::begin([
                        'action' => ['order/update-status', 'id' => $model->id],
                        'options' => ['class' => 'status-form']
                    ]); ?>
                    
                    <div class="status-select">
                        <?= Html::dropDownList(
                            'status_id',
                            $model->status_id,
                            ArrayHelper::map(OrderStatus::find()->all(), 'id', 'name'),
                            ['class' => 'form-control']
                        ) ?>
                        
                        <?= Html::submitButton('Обновить статус', [
                            'class' => 'btn btn-primary',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите изменить статус заказа?',
                                'method' => 'post',
                            ]
                        ]) ?>
                    </div>
                    
                    <?php \yii\widgets\ActiveForm::end(); ?>
                <?php else: ?>
                    <p>Статус "<?= $model->status->name ?>" нельзя изменить.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div> 
        <div class="order-details-grid">
            <div class="detail-card">
                <h3 class="detail-card-title">Информация о заказе</h3>
                <div class="detail-row">
                    <span class="detail-label">Дата создания:</span>
                    <span class="detail-value"><?= Yii::$app->formatter->asDatetime($model->date, 'medium') ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Статус:</span>
                    <span class="detail-value"><?= $model->status->name ?? 'Новый' ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Способ оплаты:</span>
                    <span class="detail-value"><?= $model->payment_method ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Адрес доставки:</span>
                    <span class="detail-value"><?= Html::encode($model->adress) ?></span>
                </div>
            </div>
            
            <?php  if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
            <div class="detail-card">
                <h3 class="detail-card-title">Информация о клиенте</h3>
                <div class="detail-row">
                    <span class="detail-label">ID клиента:</span>
                    <span class="detail-value"><?= $model->user->id ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Имя:</span>
                    <span class="detail-value"><?= Html::encode($model->user->username) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value"><?= Html::encode($model->user->email) ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Телефон:</span>
                    <span class="detail-value"><?= Html::encode($model->user->phone ?? 'Не указан') ?></span>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="order-items">
            <h3 class="order-items-title">Состав заказа</h3>
            
            <?php foreach ($model->carts as $item): ?>
                <div class="order-item">
                    <?= Html::img('@web/' . $item->product->photo, [
                        'class' => 'item-image',
                        'alt' => $item->product->name
                    ]) ?>
                    
                    <div class="item-info">
                        <div class="item-name"><?= Html::encode($item->product->name) ?></div>
                        <div class="item-author"><?= Html::encode($item->product->author->name ?? '') ?></div>
                        <div class="item-price"><?= number_format($item->product->price, 0, '', ' ') ?> ₽</div>
                    </div>
                    
                    <div class="item-quantity">
                        <?= $item->count ?> шт.
                    </div>
                    
                    <div class="item-total">
                        <?= number_format($item->product->price * $item->count, 0, '', ' ') ?> ₽
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="order-summary">
            <div class="summary-row">
                <span>Товары (<?= count($model->carts) ?>):</span>
                <span><?= number_format($model->getTotalSum(), 0, '', ' ') ?> ₽</span>
            </div>
            <div class="summary-row">
                <span>Доставка:</span>
                <span>Бесплатно</span>
            </div>
            <div class="summary-row summary-total">
                <span>Итого:</span>
                <span><?= number_format($model->getTotalSum(), 0, '', ' ') ?> ₽</span>
            </div>
        </div>
        
    </div>
</div>