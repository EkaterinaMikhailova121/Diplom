<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Условия и информация';
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

.info-page {
    max-width: 1000px;
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

.info-section {
    margin-bottom: 3rem;
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: var(--shadow);
}

.section-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--navy-dark);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
}

.section-title i {
    margin-right: 1rem;
    color: var(--navy-light);
}

.info-content {
    line-height: 1.8;
}

.info-list {
    list-style-type: none;
    padding: 0;
}

.info-list li {
    margin-bottom: 1rem;
    padding-left: 2rem;
    position: relative;
}

.info-list li::before {
    content: '\\f054';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    left: 0;
    color: var(--navy-light);
}

.contact-info {
    margin-top: 2rem;
    padding: 1.5rem;
    background-color: var(--beige-light);
    border-radius: 8px;
}

.contact-info p {
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}

.contact-info i {
    margin-right: 0.8rem;
    color: var(--navy-dark);
    width: 20px;
    text-align: center;
}

@media (max-width: 768px) {
    .info-page {
        padding: 1rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 1.5rem;
    }
    
    .info-section {
        padding: 1.5rem;
    }
}
CSS;

$this->registerCss($css);
?>
<div class="info-page">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

    <div class="info-section">
        <h2 class="section-title"><i class="fas fa-truck"></i> Доставка и оплата</h2>
        <div class="info-content">
            <p>Мы предлагаем несколько удобных способов доставки и оплаты:</p>
            <ul class="info-list">
                <li><strong>Курьерская доставка</strong> - по Москве в течение 1-2 дней (300 руб.)</li>
                <li><strong>Почта России</strong> - доставка по всей России (сроки и стоимость рассчитываются индивидуально)</li>
                <li><strong>Самовывоз</strong> - бесплатно из нашего магазина по адресу: г. Москва, ул. Книжная, 15</li>
                <li><strong>Оплата</strong> - наличными курьеру, банковской картой онлайн или при получении</li>
            </ul>
            <p>Минимальная сумма заказа для доставки - 1000 руб. Бесплатная доставка при заказе от 5000 руб.</p>
        </div>
    </div>

    <div class="info-section">
        <h2 class="section-title"><i class="fas fa-exchange-alt"></i> Возврат и обмен</h2>
        <div class="info-content">
            <p>Вы можете вернуть или обменять книгу в течение 14 дней с момента покупки при соблюдении следующих условий:</p>
            <ul class="info-list">
                <li>Книга не была в употреблении</li>
                <li>Сохранен товарный вид и потребительские свойства</li>
                <li>Имеется чек или иное подтверждение покупки</li>
                <li>Книга не входит в список невозвращаемых товаров</li>
            </ul>
            <p>Для инициализации возврата или обмена свяжитесь с нами по телефону или email.</p>
        </div>
    </div>

    <div class="info-section">
        <h2 class="section-title"><i class="fas fa-question-circle"></i> Вопросы и ответы</h2>
        <div class="info-content">

            <h4>Можно ли заказать книгу, которой нет в наличии?</h4>
            <p>Да, мы можем заказать для вас любую книгу из каталога наших поставщиков. Сроки поставки уточняйте у менеджера.</p>
            
            <h4>Есть ли у вас подарочные сертификаты?</h4>
            <p>Да, мы предлагаем электронные и пластиковые подарочные сертификаты номиналом от 1000 руб.</p>
        </div>
    </div>

    <div class="info-section">
        <h2 class="section-title"><i class="fas fa-shield-alt"></i> Политика конфиденциальности</h2>
        <div class="info-content">
            <p>Мы серьезно относимся к защите ваших персональных данных:</p>
            <ul class="info-list">
                <li>Все данные передаются по защищенному соединению</li>
                <li>Мы не передаем ваши данные третьим лицам</li>
                <li>Вы можете в любой момент запросить удаление ваших данных</li>
                <li>Мы используем cookies только для улучшения работы сайта</li>
            </ul>
            <p>Полная версия политики конфиденциальности доступна по запросу.</p>
        </div>
    </div>

    <div class="contact-info">
        <h3>Нужна помощь?</h3>
        <p><i class="fas fa-phone"></i> <a href="tel:+74951234567">+7 (495) 123-45-67</a></p>
        <p><i class="fas fa-envelope"></i> <a href="mailto:info@knizhnaya-polka.ru">info@knizhnaya-polka.ru</a></p>
        <p><i class="fas fa-map-marker-alt"></i> г. Москва, ул. Книжная, 15 (пн-пт 10:00-20:00, сб-вс 11:00-18:00)</p>
    </div>
</div>