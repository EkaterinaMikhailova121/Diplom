<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Author;

/** @var yii\web\View $this */
/** @var app\models\Author $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['index']];
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

.author-view {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 2rem;
    font-family: 'Raleway', sans-serif;
}

.author-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 3rem;
    text-align: center;
}

.author-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    color: var(--navy-dark);
    margin-bottom: 1rem;
    position: relative;
}

.author-title::after {
    content: '';
    display: block;
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, var(--navy-dark), var(--beige-medium));
    margin: 1rem auto 0;
}

.author-content {
    display: flex;
    flex-wrap: wrap;
    gap: 3rem;
    margin-bottom: 3rem;
}

.author-photo-container {
    flex: 1;
    min-width: 300px;
    max-width: 400px;
}

.author-photo {
    width: 100%;
    border-radius: 8px;
    box-shadow: var(--shadow);
    aspect-ratio: 3/4;
    object-fit: cover;
}

.author-details {
    flex: 2;
    min-width: 300px;
}

.author-description {
    color: var(--text-dark);
    line-height: 1.8;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

.author-books-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--navy-dark);
    margin: 3rem 0 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--beige-medium);
}

.books-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.book-card {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: var(--shadow);
}

.book-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
}

.book-cover {
    height: 250px;
    overflow: hidden;
}

.book-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.book-card:hover .book-cover img {
    transform: scale(1.05);
}

.book-info {
    padding: 1rem;
}

.book-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    color: var(--navy-dark);
    margin-bottom: 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.book-price {
    font-weight: 600;
    color: var(--navy-dark);
}

.author-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.btn-action {
    padding: 0.8rem 1.5rem;
    border-radius: 4px;
    font-size: 1rem;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    cursor: pointer;
}

.btn-back {
    background-color: var(--beige-medium);
    color: var(--navy-dark);
}

.btn-back:hover {
    background-color: var(--beige-dark);
}

.btn-edit {
    background-color: var(--navy-dark);
    color: white;
}

.btn-edit:hover {
    background-color: var(--navy-light);
}

.btn-delete {
    background-color: transparent;
    color: #e74c3c;
    border: 1px solid #e74c3c;
}

.btn-delete:hover {
    background-color: #e74c3c;
    color: white;
}

.btn-action i {
    margin-right: 0.7rem;
}

@media (max-width: 768px) {
    .author-content {
        flex-direction: column;
        gap: 2rem;
    }
    
    .author-photo-container {
        max-width: 100%;
    }
    
    .author-title {
        font-size: 2rem;
    }
    
    .books-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
}
CSS;

$this->registerCss($css);
?>
<div class="author-view">
    <div class="author-header">
        <h1 class="author-title"><?= Html::encode($model->name) ?></h1>
    </div>

    <div class="author-content">
        <div class="author-photo-container">
            <?= Html::img(Url::to('@web/' . $model->photo), [
                'class' => 'author-photo',
                'alt' => $model->name
            ]) ?>
        </div>
        
        <div class="author-details">
            <div class="author-description">
                <?= nl2br(Html::encode($model->description)) ?>
            </div>
            
            <div class="author-actions">
                <?= Html::a('<i class="fas fa-arrow-left"></i> Назад к авторам', ['catalog'], [
                    'class' => 'btn-action btn-back'
                ]) ?>
                
                <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
    <?= Html::a('<i class="fas fa-edit"></i> Редактировать', ['update', 'id' => $model->id], [
        'class' => 'btn-action btn-edit'
    ]) ?>
    <?= Html::a('<i class="fas fa-trash"></i> Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn-action btn-delete',
        'data' => [
            'confirm' => 'Вы уверены, что хотите удалить этого автора?',
            'method' => 'post',
        ],
    ]) ?>
<?php endif; ?>
            </div>
        </div>
    </div>
    
    <?php if ($model->books): ?>
        <h2 class="author-books-title">Книги автора</h2>
        <div class="books-grid">
            <?php foreach ($model->books as $book): ?>
                <a href="<?= Url::to(['product/view', 'id' => $book->id]) ?>" class="book-card">
                    <div class="book-cover">
                        <?= Html::img(Url::to('@web/' . $book->photo), [
                            'alt' => $book->name,
                            'title' => $book->name
                        ]) ?>
                    </div>
                    <div class="book-info">
                        <h3 class="book-title"><?= Html::encode($book->name) ?></h3>
                        <div class="book-price"><?= number_format($book->price, 0, '', ' ') ?> ₽</div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>