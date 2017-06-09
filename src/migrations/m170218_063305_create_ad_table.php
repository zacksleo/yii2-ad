<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ad`.
 */
class m170218_063305_create_ad_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%ad}}', [
            'id' => $this->primaryKey(),
            'position_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'img' => $this->string(),
            'text' => $this->text(),
            'type' => $this->smallInteger(),
            'url' => $this->string(),
            'status' => $this->boolean(),
            'order' => $this->smallInteger(),
        ], $tableOptions);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%ad}}');
        return true;
    }
}
