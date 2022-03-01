<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">
    <link rel="icon" type="image/png" href="/favicon.png" />

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100" style="background-image: url('<?php echo Yii::$app->params['bg_url_img'] ?>')">

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => '<img src="https://static.semrush.com/blog/uploads/media/43/b0/43b0b9a04c8a433a0c52360c9cc9aaf2/seo-guide-to-yoast-for-wordpress.svg" style="display:inline; vertical-align: top; height:4vh;"/>' . Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);

        if (Yii::$app->user->can('admin')) {
            $menuItems = [
                ['label' => Yii::t('app', 'Reports'), 'url' => ['/report']],
                ['label' => Yii::t('app', 'Users'), 'url' => ['/user']],
                ['label' => Yii::t('app', 'Admin'), 'url' => ['/admin']],
            ];
        } else if (Yii::$app->user->can('user')) {
            $menuItems = [
                ['label' => Yii::t('app', 'Reports'), 'url' => ['/report']],
            ];
        } else {
            $menuItems = [];
        }


        if (!Yii::$app->user->isGuest) {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    '👋🏻' . Yii::$app->user->identity->email,
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $menuItems,
        ]);

        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
