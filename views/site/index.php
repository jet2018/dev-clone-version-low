<?php

/* @var $this yii\web\View */

use yii\widgets\LinkPager;
use yii\helpers\Html;

$this->title = 'Articles';
?>
<div class="site-index">
    <?php foreach ($articles as $article): ?>
        <div class="card my-2">
            <div class="card-title d-flex p-2 border-bottom">
                <img src="<?= $article->user->getPhoto() ?>" class="img-thumbnail" style="border-radius: 200px; max-height:50px;" alt="">
                <div class="justify-content-start pl-3">
                    <div>

                        <blockquote class="blockquote">
                            <a href="#" class="h3 mb-0"><?= $article->title ?></a>
                            <footer class="blockquote-footer"><?= $article->user->name;?>, <?=  \Yii::$app->formatter->format($article->created_at, 'date') ?> ( <cite clas="pl-3"><?= Yii::$app->formatter->asRelativeTime($article->created_at, 'now');
                                    ?></cite> )</footer>
                        </blockquote>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <?php if($article->article_image): ?>
                    <img src="<?= $article->article_image ?>" class="card-img-bottom" alt="">
                <?php else: ?>
                <p class="text-truncate"><?= $article->body ?></p>
                 <a class="btn blockquote-footer float-right btn-info btn-sm">Details</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

