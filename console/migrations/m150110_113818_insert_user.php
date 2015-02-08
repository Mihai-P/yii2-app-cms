<?php

use yii\db\Schema;
use yii\db\Migration;

class m150110_113818_insert_user extends Migration
{
    public function up()
    {
        $this->insert('{{%user}}', [
            'username' => 'admin',
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('demo'),
            'email' => 'mihai.petrescu@gmail.com',
        ]);
    }

    public function down()
    {
        $this->delete('{{%user}}', [
            'username' => 'admin',
        ]);
    }
}
