<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CustomerModel;

class Customer extends ResourceController
{
    use ResponseTrait;


    // all users
    public function index(){
      $model = new CustomerModel();
      $data['Customers'] = $model->orderBy('id', 'DESC')->findAll();
      return $this->respond($data);
    }
    // create
    public function create() {
        $model = new CustomerModel();
        $data = [
            'name' => $this->request->getVar('name'),
        ];
        $model->insert($data);
        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Customer created successfully'
          ]
      ];
      return $this->respondCreated($response);
    }
    // single user
    public function show($id = null){
        $model = new CustomerModel();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Customer found');
        }
    }
    // update
    public function update($id = null){
        $model = new CustomerModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
        ];
        $model->update($id, $data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Customer updated successfully'
          ]
      ];
      return $this->respond($response);
    }
    // delete
    public function delete($id = null){
        $model = new CustomerModel();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Customer successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Customer found');
        }
    }


}