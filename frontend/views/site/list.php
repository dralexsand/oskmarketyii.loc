<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

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
        <thead>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Город</th>
            <th>Навыки</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="users_list_body">
        <?php
        if (isset($table)) {
            echo $table;
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Город</th>
            <th>Навыки</th>
            <th></th>
        </tr>
        </tfoot>
    </table>

    <hr>

    <!--<code><? /*= __FILE__ */ ?></code>-->
</div>
