<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Вход в книжный магазин';
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

.login-page {
    max-width: 500px;
    margin: 4rem auto;
    padding: 0 1rem;
    font-family: 'Raleway', sans-serif;
}

.login-container {
    background: white;
    border-radius: 12px;
    padding: 2.5rem;
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
}

.login-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, var(--navy-dark), var(--beige-medium));
}

.page-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    color: var(--navy-dark);
    margin-bottom: 1.5rem;
    text-align: center;
}

.login-form .form-group {
    margin-bottom: 1.5rem;
}

.login-form label {
    font-weight: 600;
    color: var(--navy-dark);
    margin-bottom: 0.5rem;
    display: block;
}

.login-form .form-control {
    border: 1px solid var(--beige-medium);
    border-radius: 6px;
    padding: 0.8rem 1rem;
    font-size: 1rem;
    width: 100%;
    transition: all 0.3s;
}

.login-form .form-control:focus {
    border-color: var(--navy-light);
    box-shadow: 0 0 0 0.2rem rgba(42, 75, 106, 0.15);
}

.remember-me {
    margin: 1.5rem 0;
}

.btn-login {
    background-color: var(--navy-dark);
    color: white;
    border: none;
    padding: 0.8rem 2rem;
    font-size: 1.1rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s;
    width: 100%;
    font-weight: 600;
    margin-top: 0.5rem;
}

.btn-login:hover {
    background-color: var(--navy-light);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.links-section {
    margin-top: 2rem;
    text-align: center;
    font-size: 0.95rem;
    color: var(--text-light);
}

.links-section a {
    color: var(--navy-dark);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    border-bottom: 1px solid transparent;
}

.links-section a:hover {
    color: var(--navy-light);
    border-bottom-color: var(--navy-light);
}

.divider {
    display: flex;
    align-items: center;
    margin: 1.5rem 0;
    color: var(--text-light);
    font-size: 0.9rem;
}

.divider::before, .divider::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid var(--beige-medium);
}

.divider::before {
    margin-right: 1rem;
}

.divider::after {
    margin-left: 1rem;
}

.book-icon {
    text-align: center;
    margin-bottom: 1.5rem;
    color: var(--navy-dark);
}

@media (max-width: 576px) {
    .login-container {
        padding: 1.5rem;
    }
    
    .page-title {
        font-size: 1.8rem;
    }
}
CSS;

$this->registerCss($css);
?>

<div class="login-page">
    <div class="login-container">
        
        <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
        
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'login-form'],
            'fieldConfig' => [
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'invalid-feedback'],
            ],
        ]); ?>

        <?= $form->field($model, 'username')
            ->textInput(['autofocus' => true, 'placeholder' => 'Введите ваш email'])
            ->label('Email') ?>

        <?= $form->field($model, 'password')
            ->passwordInput(['placeholder' => 'Введите ваш пароль'])
            ->label('Пароль') ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"remember-me\">{input} {label}</div>",
        ]) ?>

        <?= Html::submitButton('Войти', ['class' => 'btn-login', 'name' => 'login-button']) ?>

        <?php ActiveForm::end(); ?>
        
        <div class="divider">или</div>
        
        <div class="links-section">
            <p>Ещё нет аккаунта? <?= Html::a('Зарегистрируйтесь', ['user/create']) ?></p>
            <p>Хотите продолжить покупки? <?= Html::a('Вернуться в магазин', ['product/catalog']) ?></p>
        </div>
    </div>
</div>