<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
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
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column  container-fluid w-100 h-100">
<?php $this->beginBody() ?>

<header class="d-flex w-100">
    <?php
    NavBar::begin([
        'brandLabel' => 'DEVER',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [

            !Yii::$app->user->isGuest ? (
            ['label' => 'Create an article', 'url' => ['/article/create']]
            ): '',

            Yii::$app->user->isGuest ? (
            ['label' => '', 'url' => ['url']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline float-right'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link ']
                )
                . Html::endForm()
                . '</li>'
            ),

        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0 bg-light">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <section class="row">
            <div class="col-3 p-2">
                <?php if(Yii::$app->user->isGuest): ?>
                    <div class="card p-3">
                        <div class="font-weight-bold"><span class="text-primary font-weight-bold">DEVER Community</span> is a community of 796,806 amazing developers </div>
                        <p>We're a place where coders share, stay up-to-date and grow their careers. </p>
                        <?php if(Yii::$app->user->isGuest): ?>
                        <a href="/site/register" class="text-center btn btn-outline-primary">Create an account</a>
                        <a href="/site/login" class="text-center btn mt-2" style="background-color:#e7e8f8;">Login</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="bg-light p-2">
                    <ul class="list-group" style="list-style-type: none;">
                        <li class="p-2"><a href="/article/index">Articles</a></li>
                        <?php if(!Yii::$app->user->isGuest): ?>
                        <li class="p-2"><a href="/"> Your comments</a></li>
                        <?php endif; ?>
                        <li class="p-2"><a href="/site/about"> About us </a></li>
                        <li class="p-2"><a href="/site/contact"> Contact us </a></li>
                        <?php if(!Yii::$app->user->isGuest): ?>

                            <li class=""> <?php
                               echo Html::beginForm(['/site/logout'], 'post', ['class' => '']);
                                echo Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-link ']
                                );
                                echo Html::endForm()
                                ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-9"> <?= $content ?></div>
        </section>

    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; DEV-BLOGGER <?= date('M-Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
