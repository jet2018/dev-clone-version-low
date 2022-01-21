<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form ActiveForm */
?>
<div class="">
    <?php if (Yii::$app->session->hasFlash('message')): ?>
        <?php Yii::$app->session->getFlash('message') ?>
    <?php endif; ?>
</div>

<div class="article-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'body')->textarea(['rows'=>6]) ?>
        <?= $form->field($model, 'image')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-create -->
