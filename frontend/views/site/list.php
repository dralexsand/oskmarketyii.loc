<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <h1>Users</h1>
    <hr>

    <button id="add_user" style="font-size:16px" class="btn btn-primary">Добавить пользователя <i
                class="fas fa-plus"></i></button>
    <hr>
    <table id="users_list" class="display" style="width:100%">
        <?php
        if (isset($table)) {
            echo $table;
        }
        ?>
    </table>

    <!--<code><? /*= __FILE__ */ ?></code>-->
</div>
