<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Genre $model */
/** @var yii\widgets\ActiveForm $form */

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

.genre-form-container {
    max-width: 600px;
    margin: 2rem auto;
    padding: 0 1rem;
    font-family: 'Raleway', sans-serif;
}

.form-title {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    color: var(--navy-dark);
    margin-bottom: 2rem;
    text-align: center;
    position: relative;
}

.form-title::after {
    content: '';
    display: block;
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, var(--navy-dark), var(--beige-medium));
    margin: 1rem auto 0;
}

.form-card {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: var(--shadow);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    font-weight: 600;
    color: var(--navy-dark);
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    border: 1px solid var(--beige-medium);
    border-radius: 6px;
    padding: 0.8rem 1rem;
    font-size: 1rem;
    width: 100%;
    transition: all 0.3s;
    font-family: 'Raleway', sans-serif;
}

.form-control:focus {
    border-color: var(--navy-light);
    box-shadow: 0 0 0 0.2rem rgba(42, 75, 106, 0.15);
    outline: none;
}

.btn-submit {
    background-color: var(--navy-dark);
    color: white;
    border: none;
    padding: 0.8rem 2rem;
    font-size: 1.1rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s;
    font-weight: 600;
    display: inline-block;
    margin-top: 1rem;
}

.btn-submit:hover {
    background-color: var(--navy-light);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-cancel {
    background-color: var(--beige-medium);
    color: var(--navy-dark);
    border: none;
    padding: 0.8rem 2rem;
    font-size: 1.1rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s;
    font-weight: 600;
    display: inline-block;
    margin-top: 1rem;
    margin-left: 1rem;
    text-decoration: none;
}

.btn-cancel:hover {
    background-color: var(--beige-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    color: var(--navy-dark);
}

.help-block {
    font-size: 0.85rem;
    color: var(--text-light);
    margin-top: 0.5rem;
}

.has-error .form-control {
    border-color: #dc3545;
}

.has-error .help-block {
    color: #dc3545;
}

@media (max-width: 576px) {
    .form-card {
        padding: 1.5rem;
    }
    
    .form-title {
        font-size: 1.8rem;
    }
    
    .btn-submit, .btn-cancel {
        width: 100%;
        margin-left: 0;
        margin-top: 0.5rem;
    }
}
CSS;

$this->registerCss($css);
?>

<div class="genre-form-container">
    <h1 class="form-title">
        <?= $model->isNewRecord ? 'Добавить новый жанр' : 'Редактировать жанр' ?>
    </h1>
    
    <div class="form-card">
        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <?= $form->field($model, 'name')->textInput([
                'maxlength' => true,
                'class' => 'form-control',
                'placeholder' => 'Например: Фэнтези, Детектив, Роман'
            ]) ?>
        </div>

        <div class="form-group text-center">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', [
                'class' => 'btn-submit'
            ]) ?>
            
            <?php if (!$model->isNewRecord): ?>
                <?= Html::a('Отмена', ['view', 'id' => $model->id], [
                    'class' => 'btn-cancel'
                ]) ?>
            <?php else: ?>
                <?= Html::a('Отмена', ['index'], [
                    'class' => 'btn-cancel'
                ]) ?>
            <?php endif; ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>