<?php
use yii\helpers\Html;

$this->title = 'Заказ оформлен';
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

.order-success-page {
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

.order-success {
    background: white;
    border-radius: 8px;
    padding: 3rem 2rem;
    box-shadow: var(--shadow);
    text-align: center;
    margin-bottom: 2rem;
}

.order-success h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    color: var(--navy-dark);
    margin-bottom: 1.5rem;
}

.order-success p {
    font-size: 1.1rem;
    color: var(--text-dark);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.order-details {
    background: var(--beige-light);
    border-radius: 8px;
    padding: 2rem;
    margin: 2rem auto;
    max-width: 600px;
    text-align: left;
}

.order-details h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: var(--navy-dark);
    margin-bottom: 1.5rem;
    text-align: center;
}

.order-details p {
    font-size: 1rem;
    margin-bottom: 1rem;
    color: var(--text-dark);
}

.order-details strong {
    color: var(--navy-dark);
    font-weight: 600;
}

.btn-primary {
    background-color: var(--navy-dark);
    color: white;
    border: none;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-block;
    text-decoration: none;
    font-weight: 600;
    margin-top: 1rem;
}

.btn-primary:hover {
    background-color: var(--navy-light);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    color: white;
}

.success-icon {
    font-size: 4rem;
    color: #28a745;
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .order-success {
        padding: 2rem 1.5rem;
    }
    
    .order-success h1 {
        font-size: 1.8rem;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.8rem;
    }
    
    .order-details {
        padding: 1.5rem;
    }
}
CSS;

$this->registerCss($css);
?>

<div class="order-success-page">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

    <div class="order-success">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Заказ №<?= $order->id ?> успешно оформлен!</h1>
        <p>Спасибо за ваш заказ. Мы свяжемся с вами в ближайшее время для подтверждения.</p>
        
        <div class="order-details">
            <h2>Детали заказа</h2>
            <p><strong>Адрес доставки:</strong> <?= Html::encode($order->adress) ?></p>
            <p><strong>Способ оплаты:</strong> <?= Html::encode($order->payment_method) ?></p>
            <p><strong>Статус:</strong> <?= Html::encode($order->status->name) ?></p>
        </div>
        
        <?= Html::a('Вернуться в каталог', ['product/catalog'], ['class' => 'btn btn-primary']) ?>
    </div>
</div>