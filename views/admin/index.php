<?php
use yii\helpers\Html;
use yii\bootstrap5\Nav;

/** @var yii\web\View $this */

$this->title = 'Административная панель';
$this->params['breadcrumbs'][] = $this->title;

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

.admin-page {
    font-family: 'Raleway', sans-serif;
    background-color: #f5f5f5;
    min-height: 100vh;
}

.admin-header {
    background-color: white;
    box-shadow: var(--shadow);
    padding: 1rem 0;
    border-bottom: 1px solid var(--beige-medium);
}

.admin-title {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    color: var(--navy-dark);
    margin-bottom: 0;
}

.admin-container {
    max-width: 1400px;
    margin: 2rem auto;
    padding: 0 1rem;
    display: flex;
    gap: 2rem;
}

.admin-sidebar {
    width: 250px;
    background: white;
    border-radius: 8px;
    box-shadow: var(--shadow);
    padding: 1.5rem;
    height: fit-content;
}

.admin-content {
    flex: 1;
    background: white;
    border-radius: 8px;
    box-shadow: var(--shadow);
    padding: 2rem;
}

.sidebar-menu .nav-link {
    color: var(--navy-dark);
    padding: 0.75rem 1rem;
    border-radius: 6px;
    margin-bottom: 0.5rem;
    transition: all 0.3s;
    font-weight: 500;
}

.sidebar-menu .nav-link:hover,
.sidebar-menu .nav-link.active {
    background-color: var(--beige-light);
    color: var(--navy-light);
}

.sidebar-menu .nav-link i {
    width: 24px;
    text-align: center;
    margin-right: 0.75rem;
}

.admin-widget {
    background: var(--beige-light);
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.widget-title {
    font-family: 'Playfair Display', serif;
    color: var(--navy-dark);
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--beige-medium);
}

.quick-stats {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1.5rem;
}

.stat-card {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: var(--shadow);
    text-align: center;
}

.stat-value {
    font-size: 2rem;
    font-weight: 600;
    color: var(--navy-dark);
    margin-bottom: 0.5rem;
}

.stat-label {
    color: var(--text-light);
    font-size: 0.9rem;
}

.recent-orders table {
    width: 100%;
    border-collapse: collapse;
}

.recent-orders th {
    background: var(--beige-light);
    color: var(--navy-dark);
    padding: 1rem;
    text-align: left;
}

.recent-orders td {
    padding: 1rem;
    border-bottom: 1px solid var(--beige-medium);
}

.order-status {
    display: inline-block;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.status-new {
    background-color: #E3F2FD;
    color: #0D47A1;
}

.status-processing {
    background-color: #FFF8E1;
    color: #FF8F00;
}

.status-completed {
    background-color: #E8F5E9;
    color: #2E7D32;
}

@media (max-width: 992px) {
    .admin-container {
        flex-direction: column;
    }
    
    .admin-sidebar {
        width: 100%;
    }
    
    .quick-stats {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 576px) {
    .quick-stats {
        grid-template-columns: 1fr;
    }
    
    .admin-content {
        padding: 1.5rem;
    }
}
CSS;

$this->registerCss($css);
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;600&display=swap');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
?>

<div class="admin-page">
    <header class="admin-header">
        <div class="container">
            <h1 class="admin-title">
                <i class="fas fa-cog"></i> Административная панель
            </h1>
        </div>
    </header>

    <div class="admin-container container">
        <aside class="admin-sidebar">
            <?= Nav::widget([
                'options' => ['class' => 'sidebar-menu nav flex-column'],
                'items' => [
                    [
                        'label' => '<i class="fas fa-tachometer-alt"></i> Главная',
                        'url' => ['/admin/index'],
                        'encode' => false,
                        'active' => $this->context->route == 'admin/index'
                    ],
                    [
                        'label' => '<i class="fas fa-book"></i> Товары',
                        'url' => ['/product/catalog'],
                        'encode' => false
                    ],
                    [
                        'label' => '<i class="fas fa-book"></i> Добавить книгу',
                        'url' => ['/product/create'],
                        'encode' => false
                    ],
                    [
                        'label' => '<i class="fas fa-users"></i> Пользователи',
                        'url' => ['/user/index'],
                        'encode' => false
                    ],
                    [
                        'label' => '<i class="fas fa-shopping-cart"></i> Заказы',
                        'url' => ['/order/index'],
                        'encode' => false
                    ],
                    [
                        'label' => '<i class="fas fa-user-tie"></i> Авторы',
                        'url' => ['/author/catalog'],
                        'encode' => false
                    ],
                    [
                        'label' => '<i class="fas fa-tags"></i> Жанры',
                        'url' => ['/genre/index'],
                        'encode' => false
                    ],
                ],
            ]) ?>
        </aside>

        <main class="admin-content">
        <main class="admin-content">
    <div class="admin-widget">
        <h2 class="widget-title"><i class="fas fa-tachometer-alt"></i> Общая статистика</h2>
        <div class="quick-stats">
            <div class="stat-card">
                <div class="stat-label">Все заказы</div>
                <?= Html::a('Посмотреть все', ['/order/index'], ['class' => 'btn btn-sm btn-outline-primary mt-2']) ?>
            </div>
            <div class="stat-card">
                <div class="stat-label">Все товары в каталоге</div>
                <?= Html::a('Управление', ['/product/catalog'], ['class' => 'btn btn-sm btn-outline-primary mt-2']) ?>
            </div>
            <div class="stat-card">
                <div class="stat-label">Все пользователи</div>
                <?= Html::a('Список', ['/user/index'], ['class' => 'btn btn-sm btn-outline-primary mt-2']) ?>
            </div>
        </div>
    </div>


    <div class="admin-widget mt-4">
        <h2 class="widget-title"><i class="fas fa-tasks"></i> Быстрые действия</h2>
        <div class="d-flex flex-wrap gap-2">
            <?= Html::a('<i class="fas fa-plus"></i> Добавить товар', ['/product/create'], ['class' => 'btn btn-outline-primary']) ?>
            <?= Html::a('<i class="fas fa-user-plus"></i> Добавить автора', ['/author/create'], ['class' => 'btn btn-outline-primary']) ?>
            <?= Html::a('<i class="fas fa-tag"></i> Добавить жанр', ['/genre/create'], ['class' => 'btn btn-outline-primary']) ?>
        </div>
    </div>
</main>
        </main>
    </div>
</div>