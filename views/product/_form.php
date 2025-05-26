<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Author;
use app\models\Genre;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerCssFile('https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600&display=swap');
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
    background-color: var(--beige-light);
    font-family: 'Raleway', sans-serif;
}

.product-form {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background: white;
    border-radius: 8px;
    box-shadow: var(--shadow);
}

.form-title {
    font-size: 1.8rem;
    color: var(--navy-dark);
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--beige-medium);
    font-weight: 600;
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

textarea.form-control {
    min-height: 120px;
    resize: vertical;
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
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-submit:hover {
    background-color: var(--navy-light);
    transform: translateY(-2px);
}

.btn-submit i {
    margin-right: 0.5rem;
}

.help-block {
    font-size: 0.8rem;
    color: var(--text-light);
    margin-top: 0.3rem;
}

/* Стили для выпадающих списков */
select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%235a3e36' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px 12px;
    padding-right: 2.5rem;
}

/* Стили для загрузки файла */
.file-input-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
}

.file-input-wrapper input[type="file"] {
    position: absolute;
    font-size: 100px;
    opacity: 0;
    right: 0;
    top: 0;
    cursor: pointer;
}

.file-input-label {
    display: flex;
    align-items: center;
    padding: 0.8rem 1rem;
    background-color: var(--beige-light);
    border: 1px dashed var(--beige-medium);
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}

.file-input-label:hover {
    background-color: var(--beige-medium);
}

.file-input-icon {
    margin-right: 1rem;
    color: var(--navy-dark);
}

.file-input-text {
    flex-grow: 1;
    color: var(--text-light);
}

.file-name {
    margin-top: 0.5rem;
    font-size: 0.9rem;
    color: var(--navy-light);
    display: none;
}

@media (max-width: 768px) {
    .product-form {
        padding: 1.5rem;
        margin: 1rem;
    }
    
    .form-title {
        font-size: 1.5rem;
    }
}
CSS;

$this->registerCss($css);
?>

<div class="product-form">
    <h1 class="form-title">
        <?= $model->isNewRecord ? 'Добавить новую книгу' : 'Редактировать книгу' ?>
    </h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput([
        'class' => 'form-control',
        'placeholder' => 'Название книги'
    ]) ?>

    <?= $form->field($model, 'genre_id')->dropDownList(
        ArrayHelper::map(Genre::find()->all(), 'id', 'name'),
        [
            'class' => 'form-control',
            'prompt' => 'Выберите жанр...'
        ]
    ) ?>

    <?= $form->field($model, 'author_id')->dropDownList(
        ArrayHelper::map(Author::find()->all(), 'id', 'name'),
        [
            'class' => 'form-control',
            'prompt' => 'Выберите автора...'
        ]
    ) ?>

    <?= $form->field($model, 'description')->textarea([
        'class' => 'form-control',
        'placeholder' => 'Описание книги',
        'rows' => 5
    ]) ?>

    <div class="form-group">
        <label class="control-label">Обложка книги</label>
        <div class="file-input-wrapper">
            <label class="file-input-label">
                <span class="file-input-icon"><i class="fas fa-image"></i></span>
                <span class="file-input-text"><?= $model->photo ? 'Заменить изображение' : 'Выберите файл' ?></span>
            </label>
            <?= $form->field($model, 'photo')->fileInput([
                'class' => 'form-control',
                'accept' => 'image/*'
            ])->label(false) ?>
            <?php if ($model->photo): ?>
                <div class="file-name" id="file-name">
                    Текущее: <?= basename($model->photo) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?= $form->field($model, 'price')->textInput([
        'class' => 'form-control',
        'placeholder' => 'Цена',
        'type' => 'number',
        'min' => 0,
        'step' => 50
    ]) ?>

    <?= $form->field($model, 'count')->textInput([
        'class' => 'form-control',
        'placeholder' => 'Количество',
        'type' => 'number',
        'min' => 0
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> ' . ($model->isNewRecord ? 'Создать' : 'Обновить'), [
            'class' => 'btn-submit'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerJs(<<<JS
// Показываем имя выбранного файла
$('#product-photo').change(function() {
    var fileName = $(this).val().split('\\\\').pop();
    if (fileName) {
        $('#file-name').text('Выбрано: ' + fileName).show();
    } else {
        $('#file-name').hide();
    }
});

// Инициализация имени файла при загрузке страницы
if ($('#product-photo').val()) {
    var fileName = $('#product-photo').val().split('\\\\').pop();
    $('#file-name').text('Выбрано: ' + fileName).show();
} else if ($('#file-name').text()) {
    $('#file-name').show();
}
JS
);
?>