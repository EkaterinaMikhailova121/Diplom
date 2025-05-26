<?php
/** @var yii\web\View $this */
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Контакты';
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

.contact-page {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 2rem;
    font-family: 'Raleway', sans-serif;
    color: var(--text-dark);
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
    margin: 1rem auto 2rem;
}

.contact-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}

.contact-map {
    height: 400px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: transform 0.3s;
}

.contact-map:hover {
    transform: translateY(-5px);
}

.contact-info {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: var(--shadow);
}

.info-section {
    margin-bottom: 2rem;
}

.section-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: var(--navy-dark);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
}

.section-title i {
    margin-right: 1rem;
    color: var(--navy-light);
}

.info-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.info-item i {
    color: var(--navy-light);
    margin-right: 1rem;
    margin-top: 0.2rem;
}

.info-text {
    flex: 1;
}

.info-text a {
    color: var(--navy-dark);
    text-decoration: none;
    transition: color 0.3s;
}

.info-text a:hover {
    color: var(--navy-light);
    text-decoration: underline;
}

.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--navy-dark);
    color: white;
    transition: all 0.3s;
}

.social-link:hover {
    background-color: var(--navy-light);
    transform: translateY(-3px);
}

.contact-form {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: var(--shadow);
    margin-top: 2rem;
}

.form-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--navy-dark);
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .contact-container {
        grid-template-columns: 1fr;
    }
    
    .contact-map {
        height: 300px;
    }
    
    .page-title {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .contact-page {
        padding: 1rem;
    }
    
    .section-title {
        font-size: 1.3rem;
    }
}
CSS;

$this->registerCss($css);
?>
<div class="contact-page">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

    <div class="contact-container">
        <div class="contact-map" id="map"></div>
        
        <div class="contact-info">
            <div class="info-section">
                <h2 class="section-title"><i class="fas fa-map-marker-alt"></i> Наш адрес</h2>
                <div class="info-item">
                    <i class="fas fa-building"></i>
                    <div class="info-text">
                        г. Москва, ул. Книжная, 15<br>
                        Вход со стороны двора
                    </div>
                </div>
            </div>
            
            <div class="info-section">
                <h2 class="section-title"><i class="fas fa-clock"></i> Часы работы</h2>
                <div class="info-item">
                    <i class="fas fa-calendar-week"></i>
                    <div class="info-text">
                        <strong>Пн-Пт:</strong> 9:00 - 20:00<br>
                        <strong>Сб-Вс:</strong> 11:00 - 18:00
                    </div>
                </div>
            </div>
            
            <div class="info-section">
                <h2 class="section-title"><i class="fas fa-phone-alt"></i> Контакты</h2>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <div class="info-text">
                        <a href="tel:+74951234567">+7 (495) 123-45-67</a>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div class="info-text">
                        <a href="mailto:info@knizhnaya-polka.ru">info@knizhnaya-polka.ru</a>
                    </div>
                </div>
            </div>
            
            <div class="social-links">
                <a href="#" class="social-link"><i class="fab fa-vk"></i></a>
                <a href="#" class="social-link"><i class="fab fa-telegram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
    function init() {
        var myMap = new ymaps.Map("map", {
            center: [55.751244, 37.618423], // Координаты Москвы
            zoom: 15,
            controls: ['zoomControl']
        });

        var myPlacemark = new ymaps.Placemark([55.751244, 37.618423], {
            hintContent: 'Книжная полка',
            balloonContent: 'Добро пожаловать в наш книжный магазин!'
        }, {
            iconLayout: 'default#image',
            iconImageHref: '/images/book-marker.png',
            iconImageSize: [40, 40],
            iconImageOffset: [-20, -40]
        });

        myMap.geoObjects.add(myPlacemark);
        myMap.behaviors.disable('scrollZoom');
    }
</script>