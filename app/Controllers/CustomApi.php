<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CustomerModel;
use App\Models\CustomerPhoneModel;
use App\Models\CustomerDetailMongoDB;
use App\Models\CustomerDetailModel;

class CustomApi extends ResourceController
{

    private $customermodel;
    private $customerphonemodel;
    private $customerdetailmongodb;
    private $customerdetail;
 
    public function __construct() {
        $this->customermodel = new CustomerModel();
        $this->customerphonemodel = new CustomerPhoneModel();
        $this->customerdetailmongodb = new CustomerDetailMongoDB();
        $this->customerdetail = new CustomerDetailModel();
    }

	public function index(){

		$db      = \Config\Database::connect();
        $builder = $db->table('customer');
        $builder->select('customer.id as customerId,name,phone');
        $builder->join('customer_phone', 'customer_phone.cust_id = customer.id','left');
        $query = $builder->get();
        if($query){
            $data = $query->getResult();
           return $this->respondDeleted($data);
        }else{
            return $this->failNotFound('No Customer found');
        }
    }


    public function get_customer_detail($custId) {

        $custId = (int)$custId;
        $data = $this->customerdetailmongodb->get_customer_detail($custId);
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Customer Detail found from Mongodb');
        }

    }


    public function create_customer_detail() {

        $model = new CustomerModel();
        $data = [
            'name' => $this->request->getPost('name'),
        ];
        $customerId = $this->customermodel->insert($data);


        $data = [
            'cust_id'=>$customerId,
            'name' => $this->request->getPost('phone'),
        ];

        $this->customerphonemodel->insert($data);

        $result = $this->customerdetailmongodb->create_customer_detail($customerId,$this->request->getPost('name'), $this->request->getPost('phone'), $this->request->getPost('address'));

        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Custome Customer created successfully'
          ]
      ];
      return $this->respondCreated($response);
    }

    public function covertMongoDBToMysql(){

        $results = $this->customerdetailmongodb->create_customer_detail_list();
        #print_r($results); exit;
        foreach ($results as $key => $result) {
            $this->customerdetail->insert(array("custid"=>$result->custId,"name"=>$result->name,"phone"=>$result->phone,"address"=>$result->address));

        }

        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Moved in mysql successfully'
          ]
        ];
      return $this->respond($response);
    }


}