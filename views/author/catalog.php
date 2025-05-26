<?php
use app\models\Author;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AuthorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Авторы';
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

.author-index {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
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
    margin: 0.5rem auto 0;
}

.btn-create {
    background-color: var(--navy-dark);
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    font-size: 1rem;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    margin-bottom: 2rem;
}

.btn-create:hover {
    background-color: var(--navy-light);
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.btn-create i {
    margin-right: 0.5rem;
}

.authors-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.author-card {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: var(--shadow);
    display: flex;
    flex-direction: column;
    height: 100%;
}

.author-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
}

.author-photo {
    height: 300px;
    overflow: hidden;
    position: relative;
}

.author-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.author-card:hover .author-photo img {
    transform: scale(1.05);
}

.author-details {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.author-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    color: var(--navy-dark);
    margin-bottom: 1rem;
    line-height: 1.3;
    text-align: center;
}

.author-description {
    font-size: 0.9rem;
    color: var(--text-light);
    line-height: 1.5;
    margin-bottom: 1.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.author-actions {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: auto;
}

.btn-action {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    font-size: 0.85rem;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-decoration: none;
}

.btn-view {
    background-color: var(--navy-dark);
    color: white;
}

.btn-view:hover {
    background-color: var(--navy-light);
    color: white;
}

.btn-edit {
    background-color: var(--beige-medium);
    color: var(--navy-dark);
}

.btn-edit:hover {
    background-color: var(--beige-dark);
}

.btn-delete {
    background-color: #f8f4e9;
    color: #e74c3c;
    border: 1px solid #e74c3c;
}

.btn-delete:hover {
    background-color: #e74c3c;
    color: white;
}

@media (max-width: 768px) {
    .authors-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .authors-grid {
        grid-template-columns: 1fr;
    }
    
    .author-actions {
        flex-direction: column;
    }
    
    .btn-action {
        width: 100%;
    }
}
CSS;

$this->registerCss($css);
?>
<div class="author-index">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
    <p>
        <?= Html::a('<i class="fas fa-plus"></i> Добавить автора', ['create'], ['class' => 'btn btn-create']) ?>
    </p>
    <?php endif; ?>
    <div class="authors-grid">
        <?php foreach ($dataProvider->models as $author): ?>
            <div class="author-card">
                <div class="author-photo">
                    <?= Html::img(Url::to('@web/' . $author->photo), [
                        'alt' => $author->name,
                        'title' => $author->name
                    ]) ?>
                </div>
                
                <div class="author-details">
                    <h3 class="author-name"><?= Html::encode($author->name) ?></h3>
                    
                    <p class="author-description"><?= Html::encode($author->description) ?></p>
                    
                    <div class="author-actions">
                        <?= Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $author->id], [
                            'class' => 'btn-action btn-view',
                            'title' => 'Просмотр'
                        ]) ?>
                              <?php  if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
                        <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $author->id], [
                            'class' => 'btn-action btn-edit',
                            'title' => 'Редактировать'
                        ]) ?>
                        <?= Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $author->id], [
                            'class' => 'btn-action btn-delete',
                            'title' => 'Удалить',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить этого автора?',
                                'method' => 'post',
                            ],
                        ]) ?>
                                <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>