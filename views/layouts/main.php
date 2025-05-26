<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

// Стили для хэдера и футера
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
.navbar-nav .nav-item {
    display: flex;
    align-items: center;
}

.navbar-nav .btn-link.nav-link {
    color: var(--navy-dark) !important;
    text-decoration: none;
    background: none;
    border: none;
    cursor: pointer;
    font-weight: 500;
    padding: 0.5rem 1.2rem !important;
    position: relative;
}

.navbar-nav .btn-link.nav-link:hover {
    color: var(--navy-light) !important;
    text-decoration: none;
}

.navbar-nav .btn-link.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 1.2rem;
    width: 0;
    height: 2px;
    background-color: var(--navy-light);
    transition: width 0.3s;
}

.navbar-nav .btn-link.nav-link:hover::after {
    width: calc(100% - 2.4rem);
}
/* Хэдер */
.bookish-header {
    background-color: white;
    box-shadow: var(--shadow);
    padding: 0.5rem 0;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
    border-bottom: 1px solid var(--beige-medium);
}

.navbar-brand {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: var(--navy-dark) !important;
    font-weight: 700;
    display: flex;
    align-items: center;
}

.logo {
    height: 40px;
    margin-right: 10px;
}

.navbar-nav .nav-link {
    color: var(--navy-dark) !important;
    font-weight: 500;
    padding: 0.5rem 1.2rem !important;
    position: relative;
    transition: all 0.3s;
}

.navbar-nav .nav-link:hover {
    color: var(--navy-light) !important;
}

.navbar-nav .nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 1.2rem;
    width: 0;
    height: 2px;
    background-color: var(--navy-light);
    transition: width 0.3s;
}

.navbar-nav .nav-link:hover::after {
    width: calc(100% - 2.4rem);
}

.navbar-nav .btn-logout {
    color: var(--navy-dark) !important;
    border: none;
    background: none;
    cursor: pointer;
}

.navbar-nav .btn-logout:hover {
    color: var(--navy-light) !important;
    text-decoration: underline;
}

/* Футер */
.bookish-footer {
    background-color: var(--navy-dark);
    color: var(--beige-light);
    padding: 2rem 0;
    margin-top: 3rem;
}

.footer-logo {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    display: inline-block;
}

.footer-links h5 {
    font-family: 'Playfair Display', serif;
    color: white;
    margin-bottom: 1.2rem;
    font-size: 1.2rem;
}

.footer-links ul {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 0.6rem;
}

.footer-links a {
    color: var(--beige-medium);
    text-decoration: none;
    transition: color 0.3s;
}

.footer-links a:hover {
    color: white;
    text-decoration: underline;
}

.footer-social {
    margin-top: 1.5rem;
}

.footer-social a {
    color: white;
    background: var(--navy-light);
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-right: 0.8rem;
    transition: all 0.3s;
}

.footer-social a:hover {
    background: var(--beige-medium);
    color: var(--navy-dark);
    transform: translateY(-3px);
}

.footer-bottom {
    border-top: 1px solid rgba(232, 224, 210, 0.2);
    padding-top: 1.5rem;
    margin-top: 2rem;
    color: var(--beige-medium);
    font-size: 0.9rem;
}

.book-icon {
    color: var(--beige-dark);
    margin: 0 5px;
}

/* Адаптивность */
@media (max-width: 768px) {
    .navbar-brand {
        font-size: 1.2rem;
    }
    
    .logo {
        height: 30px;
    }
    
    .footer-links {
        margin-bottom: 1.5rem;
    }
}
CSS;

$this->registerCss($css);
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;600&display=swap');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header class="bookish-header">
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="logo"><i class="fas fa-book-open book-icon"></i></span> <span>Книжная полка</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-lg navbar-light py-2'],
        'innerContainerOptions' => ['class' => 'container']
    ]);

    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto align-items-center catalog-link'],
        'items' => Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()
            ? [
                // Обычное меню для гостей и не-администраторов
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'Каталог <i class="fas fa-book-open book-icon"></i>', 'url' => ['/product/catalog'], 'encode' => false],
                ['label' => 'Авторы', 'url' => ['/author/catalog']],
                ['label' => 'Контакты', 'url' => ['/site/contact']],
                
                // Корзина - только для авторизованных пользователей
                [
                    'label' => 'Корзина', 
                    'url' => ['/cart/index'],
                    'visible' => !Yii::$app->user->isGuest,
                    'linkOptions' => ['class' => 'nav-link']
                ],
                
                // Заказы - только для авторизованных пользователей
                [
                    'label' => 'Мои заказы', 
                    'url' => ['/order/index'],
                    'visible' => !Yii::$app->user->isGuest,
                    'linkOptions' => ['class' => 'nav-link']
                ],
                
                Yii::$app->user->isGuest
                    ? [
                        'label' => 'Вход / Регистрация', 
                        'url' => ['/site/login'],
                        'linkOptions' => ['class' => 'nav-link']
                      ]
                    : [
                        'label' => Html::beginForm(['/site/logout'])
                            . Html::submitButton(
                                'Выйти (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-link nav-link p-0 border-0']
                            )
                            . Html::endForm(),
                        'encode' => false,
                        'linkOptions' => ['class' => 'nav-link']
                      ]
            ]
            : [
                // Меню только для администратора
                [
                    'label' => 'Админка', 
                    'url' => ['/admin/index'],
                    'linkOptions' => ['class' => 'nav-link']
                ],
                [
                    'label' => Html::beginForm(['/site/logout'])
                        . Html::submitButton(
                            'Выйти (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link nav-link p-0 border-0']
                        )
                        . Html::endForm(),
                    'encode' => false,
                    'linkOptions' => ['class' => 'nav-link']
                ]
            ]
    ]);
    
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main" style="margin-top: 80px;">
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="bookish-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="footer-logo">Книжная полка</div>
                <p>Ваш надежный проводник в мире литературы. Мы собрали лучшие книги для самых взыскательных читателей.</p>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-vk"></i></a>
                    <a href="#"><i class="fab fa-telegram"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-4">
                <div class="footer-links">
                    <h5>Разделы</h5>
                    <ul>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/product/catalog']) ?>">Каталог</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/author/index']) ?>">Авторы</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/genre/index']) ?>">Жанры</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/contact']) ?>">Контакты</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="footer-links">
                    <h5>Помощь</h5>
                    <ul>
                        <li><a href="/site/about">Доставка и оплата</a></li>
                        <li><a href="/site/about">Возврат и обмен</a></li>
                        <li><a href="/site/about">Вопросы и ответы</a></li>
                        <li><a href="/site/about">Политика конфиденциальности</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="footer-links">
                    <h5>Контакты</h5>
                    <ul>
                        <li><i class="fas fa-map-marker-alt me-2"></i> г. Москва, ул. Книжная, 15</li>
                        <li><i class="fas fa-phone me-2"></i> +7 (495) 123-45-67</li>
                        <li><i class="fas fa-envelope me-2"></i> info@knizhnaya-polka.ru</li>
                        <li><i class="fas fa-clock me-2"></i> Пн-Пт: 9:00 - 20:00</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="footer-bottom text-center">
                    <p>&copy; <?= date('Y') ?> Книжная полка. Все права защищены.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>