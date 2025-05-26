<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Регистрируем Font Awesome
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

// Стили для карточки
$css = <<<CSS
    :root {
        --beige-light: #F8F4E9;
        --beige-medium: #E8E0D2;
        --beige-dark: #D4C9B4;
        --navy-dark: #162A40;
        --navy-light: #2A4B6A;
        --text-dark: #333333;
        --text-light: #5A5A5A;
        --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .product-view {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        font-family: 'Raleway', sans-serif;
    }

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        border-bottom: 1px solid var(--beige-medium);
        padding-bottom: 1rem;
    }

    .product-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        color: var(--navy-dark);
        margin: 0;
        font-weight: 700;
    }

    .product-actions .btn {
        margin-left: 0.5rem;
        padding: 0.5rem 1.2rem;
        border-radius: 4px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-edit {
        background-color: var(--navy-dark);
        color: white;
        border: 1px solid var(--navy-dark);
    }

    .btn-edit:hover {
        background-color: var(--navy-light);
        transform: translateY(-2px);
    }

    .btn-delete {
        background-color: #e74c3c;
        color: white;
        border: 1px solid #e74c3c;
    }

    .btn-delete:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
    }

    .product-card {
        display: flex;
        background: white;
        border-radius: 8px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .product-image-container {
        flex: 0 0 40%;
        max-width: 400px;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-details {
        flex: 1;
        padding: 2rem;
    }

    .product-author {
        font-size: 1.1rem;
        color: var(--navy-light);
        margin-bottom: 1rem;
        font-style: italic;
    }

    .product-genre {
        display: inline-block;
        background: var(--beige-medium);
        color: var(--navy-dark);
        padding: 0.3rem 1rem;
        border-radius: 15px;
        font-size: 0.8rem;
        margin-bottom: 1.5rem;
    }

    .product-description {
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .product-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .meta-item {
        flex: 1;
        min-width: 120px;
    }

    .meta-label {
        font-size: 0.8rem;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.3rem;
    }

    .meta-value {
        font-size: 1.1rem;
        color: var(--navy-dark);
        font-weight: 600;
    }

    .product-price {
        font-size: 1.8rem;
        color: var(--navy-dark);
        font-weight: 700;
        margin-bottom: 2rem;
    }

    .product-price:after {
        content: ' ₽';
    }

    @media (max-width: 768px) {
        .product-card {
            flex-direction: column;
        }
        
        .product-image-container {
            flex: 0 0 auto;
            max-width: 100%;
            height: 300px;
        }
        
        .product-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .product-actions {
            margin-top: 1rem;
            width: 100%;
        }
        
        .product-actions .btn {
            width: 100%;
            margin: 0.3rem 0;
        }
    }
CSS;

$this->registerCss($css);
?>
<div class="product-view">
    <div class="product-header">
        <h1 class="product-title"><?= Html::encode($this->title) ?></h1>
        <?php  if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
        <div class="product-actions">
            <?= Html::a('<i class="fas fa-edit"></i> Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-edit']) ?>
            <?= Html::a('<i class="fas fa-trash"></i> Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-delete',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить эту книгу?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="product-card">
        <div class="product-image-container">
            <?= Html::img(Url::to('@web/' . $model->photo), ['class' => 'product-image', 'alt' => $model->name]) ?>
        </div>
        
        <div class="product-details">
            <div class="product-author"><?= Html::encode($model->author->name) ?></div>
            <span class="product-genre"><?= Html::encode($model->genre->name) ?></span>
            
            <p class="product-description"><?= nl2br(Html::encode($model->description)) ?></p>
            
            <div class="product-meta">
                <div class="meta-item">
                    <div class="meta-label">Доступно</div>
                    <div class="meta-value"><?= $model->count ?> шт.</div>
                </div>
            </div>
            
            <div class="product-price"><?= number_format($model->price, 0, '', ' ') ?></div>
            <?php if (!Yii::$app->user->isGuest && (!Yii::$app->user->identity->isAdmin())): ?>
            <?= Html::a('<i class="fas fa-shopping-cart"></i> В корзину', ['cart/add', 'product_id' => $model->id], [
                'class' => 'btn btn-edit',
                'style' => 'padding: 0.8rem 2rem; font-size: 1rem;'
            ]) ?>
                <?php endif; ?>
        </div>
    </div>
</div>