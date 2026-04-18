<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'key' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'label' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['text', 'textarea', 'number', 'boolean', 'select', 'email', 'url', 'color', 'file'],
                'default'    => 'text',
            ],
            'value' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'default_value' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'options' => [
                'type'       => 'TEXT',
                'null'       => true,
                'comment'    => 'JSON encoded options for select type',
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'general',
            ],
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        // 'key' already has unique constraint above, no need to add again
        $this->forge->addKey('category');
        $this->forge->addKey('is_active');

        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
