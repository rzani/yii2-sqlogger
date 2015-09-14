<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$asset = rzani\yii2\sqlogger\Assets::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
  </head>
  <body>
      <?php $this->beginBody() ?>
      <?php
      NavBar::begin([
	  'brandLabel' => 'SQLogger',
	  'brandUrl' => ['default/index'],
	  'options' => ['class' => 'navbar-inverse navbar-fixed-top'],
      ]);
      echo Nav::widget([
	  'options' => ['class' => 'nav navbar-nav navbar-right'],
	  'items' => [
	      ['label' => 'Home', 'url' => ['default/index']],
	      ['label' => 'Help', 'url' => 'http://github.com/rzani/yii2-sqlogger'],
	      ['label' => 'Application', 'url' => Yii::$app->homeUrl],
	  ],
      ]);
      NavBar::end();
      ?>

    <div class="container">
	<?= $content ?>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="pull-left">A Product of <a href="http://www.github.com/rzani">Rodrigo Zani</a></p>
      </div>
    </footer>

    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>
