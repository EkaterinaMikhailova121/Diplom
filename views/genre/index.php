<?php
use app\models\Genre;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var app\models\GenreSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Жанры литературы';
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

.genre-index {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Raleway', sans-serif;
}

.page-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    color: var(--navy-dark);
    margin-bottom: 2rem;
    text-align: center;
    position: relative;
}

.page-title::after {
    content: '';
    display: block;
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, var(--navy-dark), var(--beige-medium));
    margin: 1rem auto 0;
}

.btn-create {
    background-color: var(--navy-dark);
    color: white;
    border: none;
    padding: 0.8rem 1.8rem;
    font-size: 1rem;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    margin-bottom: 2rem;
    box-shadow: var(--shadow);
}

.btn-create:hover {
    background-color: var(--navy-light);
    transform: translateY(-2px);
}

.btn-create i {
    margin-right: 0.7rem;
}

.genres-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.genre-card {
    background: white;
    border-radius: 8px;
    padding: 1.8rem;
    transition: all 0.3s ease;
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
    border-left: 4px solid var(--navy-light);
}

.genre-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 60px;
    height: 60px;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23E8E0D2"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>');
    background-repeat: no-repeat;
    opacity: 0.1;
}

.genre-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
}

.genre-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    color: var(--navy-dark);
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
}

.genre-name::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 40px;
    height: 2px;
    background-color: var(--beige-medium);
}

.genre-actions {
    display: flex;
    gap: 0.8rem;
    margin-top: 1.5rem;
}

.action-btn {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    font-size: 0.85rem;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    cursor: pointer;
}

.view-btn {
    background-color: var(--navy-dark);
    color: white;
}

.view-btn:hover {
    background-color: var(--navy-light);
    color: white;
}

.edit-btn {
    background-color: var(--beige-medium);
    color: var(--navy-dark);
}

.edit-btn:hover {
    background-color: var(--beige-dark);
}

.delete-btn {
    background-color: transparent;
    color: #e74c3c;
    border: 1px solid #e74c3c;
}

.delete-btn:hover {
    background-color: #e74c3c;
    color: white;
}

.action-btn i {
    margin-right: 0.5rem;
}

@media (max-width: 768px) {
    .genres-container {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    }
    
    .page-title {
        font-size: 1.8rem;
    }
}

@media (max-width: 480px) {
    .genres-container {
        grid-template-columns: 1fr;
    }
    
    .genre-actions {
        flex-direction: column;
    }
    
    .action-btn {
        width: 100%;
    }
}
CSS;

$this->registerCss($css);
?>
<div class="genre-index">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus-circle"></i> Добавить жанр', ['create'], ['class' => 'btn btn-create']) ?>
    </p>

    <div class="genres-container">
        <?php foreach ($dataProvider->models as $genre): ?>
            <div class="genre-card">
                <h3 class="genre-name"><?= Html::encode($genre->name) ?></h3>
                
                <div class="genre-actions">
                    <?= Html::a('<i class="fas fa-edit"></i> Редактировать', ['update', 'id' => $genre->id], [
                        'class' => 'action-btn edit-btn'
                    ]) ?>
                    <?= Html::a('<i class="fas fa-trash"></i> Удалить', ['delete', 'id' => $genre->id], [
                        'class' => 'action-btn delete-btn',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить этот жанр?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>