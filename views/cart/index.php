<?php
use app\models\Cart;
use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Моя корзина';
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

.cart-page {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
    font-family: 'Raleway', sans-serif;
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
    margin: 1rem auto 0;
}

.cart-container {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: var(--shadow);
    margin-bottom: 2rem;
}

.cart-item {
    display: flex;
    align-items: center;
    padding: 1.5rem 0;
    border-bottom: 1px solid var(--beige-medium);
}

.cart-item:last-child {
    border-bottom: none;
}

.product-image {
    width: 100px;
    height: 150px;
    object-fit: cover;
    border-radius: 4px;
    margin-right: 2rem;
    box-shadow: var(--shadow);
}

.product-info {
    flex-grow: 1;
}

.product-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    color: var(--navy-dark);
    margin-bottom: 0.5rem;
}

.product-author {
    font-size: 0.9rem;
    color: var(--text-light);
    font-style: italic;
    margin-bottom: 0.5rem;
}

.product-price {
    font-size: 1.1rem;
    color: var(--navy-dark);
    font-weight: 600;
}

.quantity-control {
    display: flex;
    align-items: center;
    margin: 0 2rem;
}

.quantity-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--beige-light);
    border: 1px solid var(--beige-medium);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
}

.quantity-btn:hover {
    background: var(--navy-light);
    color: white;
    border-color: var(--navy-light);
}

.quantity-input {
    width: 50px;
    text-align: center;
    margin: 0 0.5rem;
    border: 1px solid var(--beige-medium);
    border-radius: 4px;
    padding: 0.3rem;
    font-size: 1rem;
}

.product-total {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--navy-dark);
    min-width: 100px;
    text-align: right;
    margin-right: 2rem;
}

.remove-btn {
    background: none;
    border: none;
    color: #e74c3c;
    font-size: 1.2rem;
    cursor: pointer;
    transition: transform 0.3s;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.remove-btn:hover {
    background: rgba(231, 76, 60, 0.1);
    transform: scale(1.1);
}

.cart-summary {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: var(--shadow);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.summary-total {
    font-weight: 600;
    font-size: 1.3rem;
    color: var(--navy-dark);
    border-top: 1px solid var(--beige-medium);
    padding-top: 1rem;
    margin-top: 1rem;
}

.checkout-btn {
    background-color: var(--navy-dark);
    color: white;
    border: none;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
    display: block;
    width: 100%;
    margin-top: 2rem;
    font-weight: 600;
}

.checkout-btn:hover {
    background-color: var(--navy-light);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.empty-cart {
    text-align: center;
    padding: 3rem;
}

.empty-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--navy-dark);
    margin-bottom: 1rem;
}

.empty-text {
    font-size: 1.1rem;
    color: var(--text-light);
    margin-bottom: 2rem;
}

.continue-shopping {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    background-color: var(--navy-dark);
    color: white;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s;
}

.continue-shopping:hover {
    background-color: var(--navy-light);
    color: white;
    transform: translateY(-2px);
}

/* Модальное окно оформления заказа */
.modal-header {
    border-bottom: 1px solid var(--beige-medium);
    padding: 1.5rem;
}

.modal-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--navy-dark);
}

.modal-body {
    padding: 2rem;
}

.order-form .form-group {
    margin-bottom: 1.5rem;
}

.order-form label {
    font-weight: 600;
    color: var(--navy-dark);
    margin-bottom: 0.5rem;
}

.order-form .form-control {
    border: 1px solid var(--beige-medium);
    border-radius: 4px;
    padding: 0.8rem 1rem;
    font-size: 1rem;
}

.order-form .form-control:focus {
    border-color: var(--navy-light);
    box-shadow: 0 0 0 0.2rem rgba(42, 75, 106, 0.25);
}

.order-form .btn-submit {
    background-color: var(--navy-dark);
    color: white;
    border: none;
    padding: 0.8rem 2rem;
    font-size: 1.1rem;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
    width: 100%;
    margin-top: 1rem;
}

.order-form .btn-submit:hover {
    background-color: var(--navy-light);
}

@media (max-width: 768px) {
    .cart-item {
        flex-wrap: wrap;
        position: relative;
        padding-bottom: 3rem;
    }
    
    .product-image {
        width: 80px;
        height: 120px;
        margin-right: 1rem;
    }
    
    .quantity-control {
        margin: 1rem 0;
        order: 3;
        width: 100%;
        justify-content: center;
    }
    
    .product-total {
        position: absolute;
        right: 60px;
        bottom: 1.5rem;
        margin-right: 0;
    }
    
    .remove-btn {
        position: absolute;
        right: 10px;
        bottom: 1.5rem;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 2rem;
    }
    
    .cart-container, .cart-summary {
        padding: 1.5rem;
    }
    
    .empty-title {
        font-size: 1.5rem;
    }
}
CSS;

$this->registerCss($css);
?>

<div class="cart-page">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="cart-container">
            <?php if ($dataProvider->getCount() > 0): ?>
                <?php foreach ($dataProvider->models as $item): ?>
                    <div class="cart-item" data-id="<?= $item->id ?>">
                        <?= Html::img('@web/' . $item->product->photo, [
                            'class' => 'product-image',
                            'alt' => $item->product->name
                        ]) ?>
                        
                        <div class="product-info">
                            <div class="product-name"><?= Html::encode($item->product->name) ?></div>
                            <div class="product-author"><?= Html::encode($item->product->author->name) ?></div>
                            <div class="product-price"><?= number_format($item->product->price, 0, '', ' ') ?> ₽</div>
                            <div class="product-stock">
                                Доступно: <?= $item->product->count ?> шт.
                            </div>
                        </div>
                        
                        <div class="quantity-control">
                            <button class="quantity-btn minus-btn" data-id="<?= $item->id ?>">-</button>
                            <input type="number" class="quantity-input" 
                                   value="<?= $item->count ?>" 
                                   min="1" 
                                   max="<?= $item->product->count ?>"
                                   data-id="<?= $item->id ?>"
                                   data-price="<?= $item->product->price ?>">
                            <button class="quantity-btn plus-btn" data-id="<?= $item->id ?>">+</button>
                        </div>
                        
                        <div class="product-total">
                            <?= number_format($item->product->price * $item->count, 0, '', ' ') ?> ₽
                        </div>
                        
                        <button class="remove-btn" data-id="<?= $item->id ?>">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-cart">
                    <h2 class="empty-title">Ваша корзина пуста</h2>
                    <p class="empty-text">Найдите интересные книги в нашем каталоге</p>
                    <?= Html::a('Перейти в каталог', ['product/catalog'], ['class' => 'continue-shopping']) ?>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if ($dataProvider->getCount() > 0): ?>
            <div class="cart-summary">
                <div class="summary-row">
                    <span>Товары (<?= $dataProvider->getTotalCount() ?>)</span>
                    <span><?= number_format($totalPrice, 0, '', ' ') ?> ₽</span>
                </div>
                <div class="summary-row">
                    <span>Доставка</span>
                    <span>Бесплатно</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Итого</span>
                    <span><?= number_format($totalPrice, 0, '', ' ') ?> ₽</span>
                </div>
                
                <?php Modal::begin([
                    'title' => '<h2 class="modal-title">Оформление заказа</h2>',
                    'toggleButton' => [
                        'label' => 'Оформить заказ',
                        'class' => 'checkout-btn',
                    ],
                    'options' => [
                        'class' => 'fade'
                    ],
                    'dialogOptions' => [
                        'class' => 'modal-dialog-centered'
                    ]
                ]); ?>
                
                <?php $form = ActiveForm::begin([
                    'id' => 'order-form',
                    'action' => ['order/create'],
                    'options' => [
                        'class' => 'order-form'
                    ]
                ]); ?>
                
                <?= $form->field(new Order(), 'user_id')->hiddenInput([
                    'value' => Yii::$app->user->id
                ])->label(false) ?>
                
                <?= $form->field(new Order(), 'adress')->textInput([
                    'placeholder' => 'Укажите адрес доставки',
                    'required' => true
                ])->label('Адрес доставки') ?>
                
                <?= $form->field(new Order(), 'payment_method')->dropDownList([
                    'При получении наличными' => 'Наличными при получении',
                    'При получении по карте' => 'Картой при получении',
                ], [
                    'prompt' => 'Выберите способ оплаты',
                    'required' => true
                ])->label('Способ оплаты') ?>
                
                <div class="form-group">
                    <?= Html::submitButton('Подтвердить заказ', [
                        'class' => 'btn-submit'
                    ]) ?>
                </div>
                
                <?php ActiveForm::end(); ?>
                
                <?php Modal::end(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$this->registerJs(<<<JS
$(document).ready(function() {
    // Функция для обновления количества товара
    function updateCartItem(itemId, quantity) {
        const input = $('.quantity-input[data-id="' + itemId + '"]');
        const max = parseInt(input.attr('max'));
        
        if (quantity > max) {
            alert('Недостаточно товара на складе. Максимально доступное количество: ' + max);
            input.val(max);
            quantity = max;
        }
        
        $.post('/cart/update', {
            id: itemId,
            count: quantity
        }, function(response) {
            if (response.success) {
                if (response.adjusted) {
                    alert(response.message);
                    input.val(response.newCount);
                    updateTotalPrice(itemId, response.newCount);
                }
                updateTotalPrice(itemId, quantity);
            } else {
                location.reload();
            }
        }).fail(function() {
            location.reload();
        });
    }

    // Функция для обновления итоговой цены
    function updateTotalPrice(itemId, quantity) {
        const price = parseFloat($('.quantity-input[data-id="' + itemId + '"]').data('price'));
        const total = price * quantity;
        $('.cart-item[data-id="' + itemId + '"] .product-total').text(
            total.toLocaleString('ru-RU') + ' ₽'
        );
        
        // Обновляем общую сумму
        updateSummary();
    }
    
    // Функция для обновления общей суммы
    function updateSummary() {
        let total = 0;
        $('.cart-item').each(function() {
            const itemId = $(this).data('id');
            const quantity = parseInt($('.quantity-input[data-id="' + itemId + '"]').val());
            const price = parseFloat($('.quantity-input[data-id="' + itemId + '"]').data('price'));
            total += price * quantity;
        });
        
        $('.summary-total span:last').text(total.toLocaleString('ru-RU') + ' ₽');
    }

    // Функция для удаления товара
    function removeCartItem(itemId) {
        if (confirm('Вы действительно хотите удалить этот товар из корзины?')) {
            $.post('/cart/delete', {
                id: itemId
            }, function(response) {
                if (response.success) {
                    $('.cart-item[data-id="' + itemId + '"]').remove();
                    updateSummary();
                    
                    if ($('.cart-item').length === 0) {
                        location.reload();
                    }
                } else {
                }
            }).fail(function() {
                location.reload();
            });
        }
    }

    // Увеличение количества товара
    $('.plus-btn').click(function() {
        const itemId = $(this).data('id');
        const input = $(this).siblings('.quantity-input');
        const newValue = parseInt(input.val()) + 1;
        input.val(newValue);
        updateCartItem(itemId, newValue);
    });
    
    // Уменьшение количества товара
    $('.minus-btn').click(function() {
        const itemId = $(this).data('id');
        const input = $(this).siblings('.quantity-input');
        const newValue = parseInt(input.val()) - 1;
        
        if (newValue >= 1) {
            input.val(newValue);
            updateCartItem(itemId, newValue);
        }
    });
    
    // Ручное изменение количества
    $('.quantity-input').change(function() {
        const itemId = $(this).data('id');
        let value = parseInt($(this).val());
        const max = parseInt($(this).attr('max'));
        
        if (isNaN(value) || value < 1) {
            value = 1;
            $(this).val(value);
        }
        
        if (value > max) {
            alert('Недостаточно товара на складе. Максимально доступное количество: ' + max);
            value = max;
            $(this).val(value);
        }
        
        updateCartItem(itemId, value);
    });
    
    // Удаление товара
    $('.remove-btn').click(function() {
        const itemId = $(this).data('id');
        removeCartItem(itemId);
    });
    
    // Обработка формы заказа
    $('#order-form').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Обработка...')
            .prop('disabled', true);
        
        // Удаляем предыдущие ошибки
        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    if (response.errors) {
                        // Показываем ошибки валидации
                        $.each(response.errors, function(field, errors) {
                            const input = form.find('[name="Order[' + field + ']"]');
                            input.addClass('is-invalid');
                            input.after('<div class="invalid-feedback">' + errors.join('<br>') + '</div>');
                        });
                    } else {
                    }
                }
            },
            error: function(xhr) {
            },
            complete: function() {
                submitBtn.html('Подтвердить заказ').prop('disabled', false);
            }
        });
    });
});
JS
);
?>