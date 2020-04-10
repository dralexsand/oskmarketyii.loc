<?php

use yii\db\Migration;

/**
 * Class m200410_062356_profiles
 */
class m200410_062356_profiles extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('profiles', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'skill_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('profiles');
    }
}
