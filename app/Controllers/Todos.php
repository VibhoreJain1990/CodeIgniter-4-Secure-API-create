<?php namespace App\Controllers;

use App\Models\TodosModel;

class Todos extends BaseController
{
    public function index()
    {
        $model = new TodosModel();
        $todos = $model->findAll();

        return $this->response->setJSON($todos);
    }

    public function create()
    {
        $model = new TodosModel();

        // Get the raw input body
        $body = $this->request->getBody();
        //print_r($body);die;
        // Decode JSON payload
        $data = json_decode($body, true);
    
        // Check if JSON decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid JSON data'
            ]);
        }
        
        /*
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ];
        */
        // Validate if the necessary data is present
        if (!isset($data['title']) || !isset($data['description'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Title and description are required'
            ]);
        }
    
        // Prepare data for updating
        $addData = [
            'title' => $data['title'],
            'description' => $data['description'],
        ];

        if ($model->save($addData)) {
            $insertedID = $model->getInsertID();
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Todo item created successfully',
                'id' => $insertedID
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to create todo item'
            ]);
        }
    }

    public function show($id)
    {
        $model = new TodosModel();
        $todo = $model->find($id);

        if ($todo) {
            return $this->response->setJSON($todo);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Todo item not found'
            ]);
        }
    }

    public function update($id)
    {
        $model = new TodosModel();
        
        // Get the raw input body
        $body = $this->request->getBody();
        //print_r($body);die;
        // Decode JSON payload
        $data = json_decode($body, true);
    
        // Check if JSON decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid JSON data'
            ]);
        }
    
        // Validate if the necessary data is present
        if (!isset($data['title']) || !isset($data['description'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Title and description are required'
            ]);
        }
    
        // Prepare data for updating
        $updateData = [
            'title' => $data['title'],
            'description' => $data['description'],
        ];
    
        // Perform the update operation
        if ($model->update($id, $updateData)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Todo item updated successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to update todo item'
            ]);
        }
    }
    

    public function delete($id)
    {
        $model = new TodosModel();

        if ($model->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Todo item deleted successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to delete todo item'
            ]);
        }
    }
}
