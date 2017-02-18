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
        $this->createTable('{{%ad}}', [
            'id' => $this->primaryKey(),
            'position_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'text' => $this->text(),
            'type' => $this->smallInteger(),
            'url' => $this->string(),
            'status' => $this->boolean(),
            'order' => $this->smallInteger(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%ad}}');
    }
}
