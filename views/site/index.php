<?php
use yii\helpers\Url;
use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'Книжная полка - ваш литературный мир';
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

.site-index {
    font-family: 'Raleway', sans-serif;
    color: var(--text-dark);
}

.hero-section {
    background: linear-gradient(rgba(22, 42, 64, 0.8), rgba(22, 42, 64, 0.8)), 
                url('/image/hero-books.jpeg');
    background-size: cover;
    background-position: center;
    color: white;
    padding: 6rem 1rem;
    text-align: center;
    margin-bottom: 3rem;
}

.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 3.5rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
}

.hero-subtitle {
    font-size: 1.3rem;
    max-width: 700px;
    margin: 0 auto 2.5rem;
    line-height: 1.6;
}

.btn-hero {
    background-color: var(--beige-medium);
    color: var(--navy-dark);
    padding: 1rem 2.5rem;
    font-size: 1.1rem;
    border-radius: 4px;
    border: none;
    font-weight: 600;
    transition: all 0.3s;
    display: inline-block;
    text-decoration: none;
}

.btn-hero:hover {
    background-color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.section-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    color: var(--navy-dark);
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
}

.section-title::after {
    content: '';
    display: block;
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, var(--navy-dark), var(--beige-medium));
    margin: 1rem auto 0;
}

.featured-books {
    padding: 3rem 1rem;
    background-color: white;
}

.books-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
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
    height: 300px;
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
    padding: 1.5rem;
}

.book-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    color: var(--navy-dark);
    margin-bottom: 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.book-author {
    font-size: 0.9rem;
    color: var(--text-light);
    margin-bottom: 0.5rem;
    font-style: italic;
}

.book-price {
    font-weight: 600;
    color: var(--navy-dark);
    font-size: 1.1rem;
}

.categories-section {
    padding: 3rem 1rem;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1.5rem;
}

.category-card {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: var(--shadow);
    border-top: 3px solid var(--navy-light);
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
}

.category-icon {
    font-size: 2rem;
    color: var(--navy-light);
    margin-bottom: 1rem;
}

.category-name {
    font-family: 'Playfair Display', serif;
    color: var(--navy-dark);
    font-size: 1.1rem;
}

.about-section {
    padding: 4rem 1rem;
    background-color: white;
    text-align: center;
}

.about-content {
    max-width: 800px;
    margin: 0 auto;
    font-size: 1.1rem;
    line-height: 1.8;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .books-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    }
}
CSS;

$this->registerCss($css);
?>
<div class="site-index">
    <section class="hero-section">
        <h1 class="hero-title">Откройте мир книг</h1>
        <p class="hero-subtitle">Более 10 000 книг различных жанров для вашего вдохновения, обучения и развлечения</p>
        <a href="<?= Url::to(['product/catalog']) ?>" class="btn-hero">Перейти в каталог</a>
    </section>

    <section class="featured-books">
        <div class="container">
            <h2 class="section-title">Популярные книги</h2>
            <div class="books-grid">
                <?php foreach ($featuredBooks as $book): ?>
                    <div class="book-card">
                        <a href="<?= Url::to(['product/view', 'id' => $book->id]) ?>">
                            <div class="book-cover">
                                <?= Html::img(Url::to('@web/' . $book->photo), [
                                    'alt' => $book->name,
                                    'title' => $book->name
                                ]) ?>
                            </div>
                            <div class="book-info">
                                <h3 class="book-title"><?= Html::encode($book->name) ?></h3>
                                <div class="book-author"><?= Html::encode($book->author->name) ?></div>
                                <div class="book-price"><?= number_format($book->price, 0, '', ' ') ?> ₽</div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="categories-section">
        <div class="container">
            <h2 class="section-title">Жанры</h2>
            <div class="categories-grid">
                <?php foreach ($categories as $category): ?>
                    <a class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3 class="category-name"><?= Html::encode($category->name) ?></h3>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <h2 class="section-title">О нашем магазине</h2>
            <div class="about-content">
                <p>Мы - независимый книжный магазин с более чем 10-летней историей. Наша миссия - прививать любовь к чтению и делать качественную литературу доступной для каждого. В нашем ассортименте только проверенные издания от лучших издательств.</p>
                <p>Наши консультанты помогут вам подобрать книгу по вкусу и ответят на все ваши вопросы о литературе.</p>
            </div>
        </div>
    </section>
</div>