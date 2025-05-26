<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Регистрация в книжном магазине';
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

body {
    font-family: 'Raleway', sans-serif;
    color: var(--text-dark);
}

.register-container {
    max-width: 600px;
    margin: 2rem auto;
    padding: 2.5rem;
    background: white;
    border-radius: 8px;
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
}

.register-container::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 120px;
    height: 120px;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23E8E0D2"><path d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm0 18H6V4h2v8l2.5-1.5L13 12V4h5v16z"/></svg>');
    background-repeat: no-repeat;
    background-size: contain;
    opacity: 0.5;
}

.register-title {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    color: var(--navy-dark);
    margin-bottom: 1.5rem;
    text-align: center;
    position: relative;
}

.register-subtitle {
    text-align: center;
    color: var(--text-light);
    margin-bottom: 2rem;
    font-size: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    border: 1px solid var(--beige-medium);
    border-radius: 4px;
    padding: 0.8rem 1rem;
    font-size: 1rem;
    transition: all 0.3s;
    width: 100%;
}

.form-control:focus {
    border-color: var(--navy-light);
    box-shadow: 0 0 0 0.2rem rgba(42, 75, 106, 0.25);
    outline: none;
}

.control-label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--navy-dark);
    font-weight: 600;
}

.btn-submit {
    background-color: var(--navy-dark);
    color: white;
    border: none;
    padding: 0.8rem 2rem;
    font-size: 1rem;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
    display: block;
    width: 100%;
    margin-top: 1.5rem;
}

.btn-submit:hover {
    background-color: var(--navy-light);
    transform: translateY(-2px);
}

.login-link {
    text-align: center;
    margin-top: 1.5rem;
    color: var(--text-light);
}

.login-link a {
    color: var(--navy-light);
    text-decoration: none;
    font-weight: 600;
}

.login-link a:hover {
    text-decoration: underline;
}

.book-benefits {
    margin-top: 2rem;
    padding: 1.5rem;
    background-color: var(--beige-light);
    border-radius: 8px;
}

.benefits-title {
    font-family: 'Playfair Display', serif;
    color: var(--navy-dark);
    font-size: 1.2rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
}

.benefits-title i {
    margin-right: 0.8rem;
}

.benefits-list {
    list-style: none;
    padding: 0;
}

.benefits-list li {
    margin-bottom: 0.8rem;
    padding-left: 1.8rem;
    position: relative;
}

.benefits-list li::before {
    content: '\\f02d';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    left: 0;
    color: var(--navy-light);
}

@media (max-width: 768px) {
    .register-container {
        padding: 1.5rem;
        margin: 1rem;
    }
    
    .register-title {
        font-size: 1.8rem;
    }
}
CSS;

$this->registerCss($css);
?>

<div class="register-container">
    <h1 class="register-title">Добро пожаловать в наш книжный мир</h1>
    <p class="register-subtitle">Зарегистрируйтесь, чтобы получить доступ к тысячам книг</p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nickname', [
        'inputOptions' => [
            'class' => 'form-control',
            'placeholder' => 'Как вас называть?'
        ]
    ])->label('Ваше имя') ?>

    <?= $form->field($model, 'username', [
        'inputOptions' => [
            'class' => 'form-control',
            'placeholder' => 'Придумайте логин'
        ]
    ])->label('Логин') ?>

    <?= $form->field($model, 'password', [
        'inputOptions' => [
            'class' => 'form-control',
            'placeholder' => 'Не менее 6 символов'
        ]
    ])->passwordInput()->label('Пароль') ?>

    <?= $form->field($model, 'email', [
        'inputOptions' => [
            'class' => 'form-control',
            'placeholder' => 'example@mail.com'
        ]
    ])->label('Email') ?>

    <?= $form->field($model, 'phone', [
        'inputOptions' => [
            'class' => 'form-control',
            'placeholder' => '+7 (999) 123-45-67'
        ]
    ])->label('Телефон') ?>

    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn-submit']) ?>

    <div class="login-link">
        Уже есть аккаунт? <a href="<?= Url::to(['site/login']) ?>">Войдите</a>
    </div>

    <div class="book-benefits">
        <h3 class="benefits-title"><i class="fas fa-book-open"></i> Преимущества регистрации</h3>
        <ul class="benefits-list">
            <li>Доступ к эксклюзивным коллекциям книг</li>
            <li>Персональные рекомендации по вашим предпочтениям</li>
            <li>Отслеживание состояния заказов</li>
            <li>Скидки и специальные предложения</li>
            <li>Возможность составлять списки желаний</li>
        </ul>
    </div>

    <?php ActiveForm::end(); ?>
</div>