<?php

use app\models\Product;
use app\models\Genre;
use app\models\Author;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Книжный каталог';
$this->params['breadcrumbs'][] = $this->title;

// Подключаем шрифты и иконки
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;600&display=swap');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
?>

<style>
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

    body {
        font-family: 'Raleway', sans-serif;
        color: var(--text-dark);
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--navy-dark);
        text-align: center;
        margin: 2rem 0;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    /* Контейнер каталога */
    .catalog-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Фильтры */
    .filter-section {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
    }

    .filter-title {
        font-family: 'Playfair Display', serif;
        color: var(--navy-dark);
        margin-bottom: 1rem;
        font-size: 1.2rem;
    }

    /* Сетка книг */
    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    /* Карточка книги */
    .book-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: var(--shadow);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .book-cover {
        height: 320px;
        overflow: hidden;
        position: relative;
    }

    .book-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .book-card:hover .book-cover img {
        transform: scale(1.03);
    }

    .book-details {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .book-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        color: var(--navy-dark);
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .book-author {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-bottom: 0.5rem;
        font-style: italic;
    }

    .book-genre {
        display: inline-block;
        background: var(--beige-medium);
        color: var(--navy-dark);
        padding: 0.3rem 0.8rem;
        border-radius: 12px;
        font-size: 0.75rem;
        margin-bottom: 1rem;
    }

    .book-description {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-bottom: 1.5rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .book-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    .book-price {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--navy-dark);
    }

    .book-actions {
        display: flex;
        gap: 0.5rem;
    }

    /* Кнопки */
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
    }

    .btn-primary {
        background-color: var(--navy-dark);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--navy-light);
        transform: translateY(-2px);
    }

    .btn-outline {
        background-color: transparent;
        color: var(--navy-dark);
        border: 1px solid var(--navy-dark);
    }

    .btn-outline:hover {
        background-color: rgba(22, 42, 64, 0.05);
    }

    /* Админские кнопки */
    .admin-actions {
        margin-top: 2rem;
        text-align: right;
    }

    /* Адаптивность */
    @media (max-width: 768px) {
        .books-grid {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.5rem;
        }

        .page-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 480px) {
        .books-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="catalog-container">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

    <!-- Фильтры -->
    <div class="filter-section">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['catalog'],
        ]); ?>

        <div class="row">
            <div class="col-md-4">
                <h3 class="filter-title">Жанр</h3>
                <?= $form->field($searchModel, 'genre_id')->dropDownList(
                    \yii\helpers\ArrayHelper::map(Genre::find()->all(), 'id', 'name'),
                    ['prompt' => 'Все жанры']
                )->label(false) ?>
            </div>
            <div class="col-md-4">
                <h3 class="filter-title">Автор</h3>
                <?= $form->field($searchModel, 'author_id')->dropDownList(
                    \yii\helpers\ArrayHelper::map(Author::find()->all(), 'id', 'name'),
                    ['prompt' => 'Все авторы']
                )->label(false) ?>
            </div>
      
        </div>

        <div class="text-right mt-3">
            <?= Html::submitButton('Применить фильтры', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Сбросить', ['catalog'], ['class' => 'btn btn-outline']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="books-grid">
    <?php foreach ($dataProvider->models as $product): ?>
        <div class="book-card">
            <div class="book-cover">
                <?= Html::img(Url::to('@web/' . $product->photo), [
                    'alt' => $product->name,
                    'title' => $product->name
                ]) ?>
            </div>
            
            <div class="book-details">
                <h3 class="book-title"><?= Html::encode($product->name) ?></h3>
                <div class="book-author"><?= Html::encode($product->author->name) ?></div>
                <span class="book-genre"><?= Html::encode($product->genre->name) ?></span>
                
                <p class="book-description"><?= Html::encode($product->description) ?></p>
                
                <div class="book-footer">
                    <div class="book-price"><?= number_format($product->price, 0, '', ' ') ?> ₽</div>
                    <div class="book-actions">
                        <?= Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $product->id], [
                            'class' => 'btn btn-outline',
                            'title' => 'Подробнее'
                        ]) ?>
                        
                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
                            <!-- Кнопки для администратора -->
                            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $product->id], [
                                'class' => 'btn btn-outline',
                                'title' => 'Редактировать'
                            ]) ?>
                            <?= Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $product->id], [
                                'class' => 'btn btn-outline',
                                'title' => 'Удалить',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить эту книгу?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?php else: ?>
                            <!-- Кнопка "В корзину" для обычных пользователей -->
                            <?= Html::a('<i class="fas fa-shopping-cart"></i>', ['cart/add', 'product_id' => $product->id], [
                                'class' => 'btn btn-primary',
                                'title' => 'В корзину'
                            ]) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>