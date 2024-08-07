<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class TodosSeeder extends Seeder
{
    public function run()
    {
        // Create a new instance of Faker with US English locale
        $faker = Factory::create('en_US');

        // Prepare data to be inserted
        $data = [];
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'title' => $faker->sentence, // Generate a random English title
                'description' => $faker->paragraph, // Generate a random English description
            ];
        }

        // Insert the data into the `todos` table
        $this->db->table('todos')->insertBatch($data);
    }
}
