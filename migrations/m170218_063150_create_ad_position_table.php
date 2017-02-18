<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ad_position`.
 */
class m170218_063150_create_ad_position_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%ad_position}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull()->unique(),
            'size' => $this->string(),
            'status' => $this->boolean(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%ad_position}}');
    }
}
