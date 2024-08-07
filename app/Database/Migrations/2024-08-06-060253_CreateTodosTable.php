<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTodosTable extends Migration
{
    public function up()
    {
        // Define the table structure
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true, // Make description optional
            ],
        ]);

        // Set the primary key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('todos');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('todos');
    }
}
