<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<style>      #products-container.products-grid { /* Добавили #products-container */
       display: grid;
       grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
       gap: 2rem;
   }

   @media (max-width: 992px) {
       #products-container.products-grid { /* И здесь тоже */
           grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
       }
   }
   </style>
<div class="products-grid" id="products-container">
    <?php foreach ($dataProvider->models as $index => $product): ?>
        <div class="product-card animate__animated animate__fadeIn" style="animation-delay: <?= $index * 0.1 ?>s">
            <?php if(!Yii::$app->user->isGuest): ?>
                <button class="favorite-btn <?= Yii::$app->user->identity->isFavorite($product->id) ? 'active' : '' ?>" 
                        data-product-id="<?= $product->id ?>">
                    <i class="<?= Yii::$app->user->identity->isFavorite($product->id) ? 'fas' : 'far' ?> fa-heart"></i>
                </button>
            <?php endif; ?>
            
            <div class="product-image-container">
                <a href="<?= Url::to(['product/view', 'product_id' => $product->id]) ?>">
                    <?= Html::img('@web/' . $product->photo, [
                        'class' => 'product-image',
                        'alt' => $product->name
                    ]) ?>
                </a>
            </div>
            
            <div class="product-body">
                <h3 class="product-title"><?= Html::encode($product->name) ?></h3>
                <div class="product-price"><?= number_format($product->price, 0, '', ' ') ?></div>
                
                <div class="product-actions">
                    <div class="d-flex justify-content-between">
                        <a href="<?= Url::to(['product/view', 'product_id' => $product->id]) ?>" 
                           class="btn-knitting btn-outline-knitting">
                           <i class="fas fa-eye mr-2"></i> Подробнее
                        </a>
                        
                        <?php if (!Yii::$app->user->isGuest): ?>
                            <?php if (Yii::$app->user->identity->isAdmin()): ?>
                                <a href="<?= Url::to(['product/update', 'product_id' => $product->id]) ?>" 
                                   class="btn-knitting btn-outline-knitting">
                                   <i class="fas fa-edit"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?= Url::to(['cart/add', 'product_id' => $product->id]) ?>" 
                                   class="btn-knitting btn-primary-knitting">
                                   <i class="fas fa-shopping-cart"></i>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>