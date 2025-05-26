<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Author $model */
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

.author-form-container {
    max-width: 800px;
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

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

.file-input-wrapper {
    position: relative;
    margin-top: 0.5rem;
}

.file-input-wrapper .form-control {
    padding: 0.5rem 1rem;
}

.file-input-preview {
    margin-top: 1rem;
    display: none;
}

.file-input-preview img {
    max-width: 200px;
    max-height: 200px;
    border-radius: 4px;
    border: 1px solid var(--beige-medium);
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
}
CSS;

$this->registerCss($css);
?>

<div class="author-form-container">
    <h1 class="form-title">Автор</h1>
    
    <div class="form-card">
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

        <div class="form-group">
            <?= $form->field($model, 'name')->textInput([
                'maxlength' => true,
                'class' => 'form-control',
                'placeholder' => 'Введите полное имя автора'
            ]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'photo')->fileInput([
                'class' => 'form-control',
                'accept' => 'image/*'
            ]) ?>
            
            <?php if (!$model->isNewRecord && $model->photo): ?>
                <div class="file-input-preview" style="display: block;">
                    <p>Текущее фото:</p>
                    <?= Html::img(Url::to('@web/' . $model->photo), [
                        'alt' => $model->name,
                        'style' => 'max-width: 200px;'
                    ]) ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'description')->textarea([
                'rows' => 6,
                'class' => 'form-control',
                'placeholder' => 'Описание автора, биография, достижения...'
            ]) ?>
        </div>

        <div class="form-group text-center">
            <?= Html::submitButton('Сохранить', ['class' => 'btn-submit']) ?>
            
            <?php if (!$model->isNewRecord): ?>
                <?= Html::a('Отмена', ['view', 'id' => $model->id], [
                    'class' => 'btn-submit',
                    'style' => 'background-color: var(--beige-medium); color: var(--navy-dark); margin-left: 1rem;'
                ]) ?>
            <?php else: ?>
                <?= Html::a('Отмена', ['index'], [
                    'class' => 'btn-submit',
                    'style' => 'background-color: var(--beige-medium); color: var(--navy-dark); margin-left: 1rem;'
                ]) ?>
            <?php endif; ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
// Превью загружаемого изображения
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.querySelector('input[type="file"]');
    const previewContainer = document.querySelector('.file-input-preview');
    
    if (fileInput && previewContainer) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    if (!previewContainer.querySelector('img')) {
                        previewContainer.innerHTML = '<p>Новое фото:</p><img src="'+event.target.result+'" alt="Превью" style="max-width: 200px;">';
                    } else {
                        previewContainer.querySelector('img').src = event.target.result;
                    }
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>