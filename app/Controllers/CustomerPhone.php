<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CustomerModel;

class CustomerPhone extends ResourceController
{

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


    public function morethantwophoneno(){

		$db      = \Config\Database::connect();
        $query = $db->query("SELECT name from customer JOIN customer_phone on customer_phone.cust_id = customer.id WHERE customer.id in ( SELECT cust_id from customer_phone GROUP BY cust_id having count(*) >1) group by name");
        //$query = $builder->get();
        if($query){
           $data = $query->getResult();
           return $this->respondDeleted($data);
        }else{
            return $this->failNotFound('No Customer found');
        }
    }

}