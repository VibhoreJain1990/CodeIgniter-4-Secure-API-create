<?php namespace App\Models;

use CodeIgniter\Model;

class TodosModel extends Model
{
    protected $table = 'todos';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'description'];

    // Optional: Define validation rules
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'description' => 'permit_empty|max_length[1000]',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Title is required',
            'min_length' => 'Title must be at least 3 characters long',
            'max_length' => 'Title cannot exceed 255 characters',
        ],
        'description' => [
            'max_length' => 'Description cannot exceed 1000 characters',
        ],
    ];

    protected $returnType = 'array';
}
