<?php
use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\OrderStatus;

/** @var yii\web\View $this */
/** @var app\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Мои заказы';
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

.orders-page {
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

.orders-container {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: var(--shadow);
    margin-bottom: 2rem;
}

.order-card {
    border: 1px solid var(--beige-medium);
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    transition: all 0.3s;
}

.order-card:hover {
    box-shadow: var(--shadow);
    transform: translateY(-2px);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--beige-light);
}

.order-id {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    color: var(--navy-dark);
}

.order-date {
    font-size: 0.9rem;
    color: var(--text-light);
}

.order-status {
    display: inline-block;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.85rem;
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

.order-details {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}

.detail-item {
    margin-bottom: 0.5rem;
}

.detail-label {
    font-size: 0.85rem;
    color: var(--text-light);
    margin-bottom: 0.2rem;
}

.detail-value {
    font-weight: 600;
    color: var(--navy-dark);
}

.order-actions {
    display: flex;
    justify-content: flex-end;
    gap: 0.8rem;
    margin-top: 1rem;
}

.btn-view {
    background-color: var(--navy-dark);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s;
    font-size: 0.9rem;
}

.btn-view:hover {
    background-color: var(--navy-light);
    color: white;
}

.empty-orders {
    text-align: center;
    padding: 3rem;
}

.empty-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--navy-dark);
    margin-bottom: 1rem;
}

.empty-text {
    font-size: 1.1rem;
    color: var(--text-light);
    margin-bottom: 2rem;
}

.continue-shopping {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    background-color: var(--navy-dark);
    color: white;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s;
}

.continue-shopping:hover {
    background-color: var(--navy-light);
    color: white;
    transform: translateY(-2px);
}
.status-filter {
    margin-bottom: 2rem;
    background: var(--beige-light);
    padding: 1.5rem;
    border-radius: 8px;
}

.filter-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    color: var(--navy-dark);
    margin-bottom: 1rem;
}

.filter-form {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

.filter-select {
    flex: 1;
    min-width: 200px;
    padding: 0.5rem;
    border: 1px solid var(--beige-medium);
    border-radius: 4px;
    background: white;
    font-family: 'Raleway', sans-serif;
}

.filter-button {
    padding: 0.5rem 1.5rem;
    background-color: var(--navy-dark);
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}

.filter-button:hover {
    background-color: var(--navy-light);
}

.reset-button {
    padding: 0.5rem 1.5rem;
    background-color: var(--beige-medium);
    color: var(--navy-dark);
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}

.reset-button:hover {
    background-color: var(--beige-light);
}
@media (max-width: 768px) {
    .order-details {
        grid-template-columns: 1fr;
    }
    
    .order-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 2rem;
    }
    
    .orders-container {
        padding: 1.5rem;
    }
    
    .empty-title {
        font-size: 1.5rem;
    }
}
CSS;

$this->registerCss($css);
?>

<div class="orders-page">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

    <div class="orders-container">
        <?php if ($dataProvider->getCount() > 0): ?>
            <?php foreach ($dataProvider->models as $order): ?>
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <span class="order-id">Заказ #<?= $order->id ?></span>
                            <span class="order-date"><?= Yii::$app->formatter->asDate($order->date, 'long') ?></span>
                        </div>
                        <span class="order-status status-<?= strtolower($order->status->name) ?>">
                            <?= $order->status->name ?>
                        </span>
                    </div>
                    
                    <div class="order-details">
                        <div class="detail-item">
                            <div class="detail-label">Способ оплаты</div>
                            <div class="detail-value"><?= $order->payment_method ?></div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Адрес доставки</div>
                            <div class="detail-value"><?= Html::encode($order->adress) ?></div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Сумма заказа</div>
                            <div class="detail-value"><?= number_format($order->getTotalSum(), 0, '', ' ') ?> ₽</div>
                        </div>
                    </div>
                    
                    <div class="order-actions">
                        <?= Html::a('Подробнее', ['view', 'id' => $order->id], ['class' => 'btn-view']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-orders">
                <h2 class="empty-title">У вас пока нет заказов</h2>
                <p class="empty-text">Начните покупки в нашем каталоге</p>
                <?= Html::a('Перейти в каталог', ['product/catalog'], ['class' => 'continue-shopping']) ?>
            </div>
        <?php endif; ?>
    </div>
</div>