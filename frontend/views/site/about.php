<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Pjax;

//use yii\widgets\ActiveForm;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <hr>
    <div class="btn btn-primary" id="test">Test</div>
    <hr>

    <?php Pjax::begin(); ?>
    <?= Html::a("Показать дату", ['site/date'], ['class' => 'btn btn-lg btn-success']) ?>
    <?= Html::a("Показать время", ['site/time'], ['class' => 'btn btn-lg btn-primary']) ?>
    <h1>It's: <?= $response ?></h1>
    <?php Pjax::end(); ?>


    <hr>

    <div id="pjax-container">container</div>

    <?php

    $js = <<<JS
    $('#test').on('click', function() {
        console.log('clicked');
        let url = location.origin + '/ajax/request';
        console.log(url);
      $.ajax({
        url: 'ajax/request',
        type: 'POST',
        success: function(res) {
          console.log('res: ' + res);
        },
        error: function() {
          console.log('error ajax');
        }
      });
    });
JS;

    $this->registerJs($js);
    ?>


    <hr>

    <code><?= __FILE__ ?></code>
</div>
