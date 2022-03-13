<?php

namespace App\Models;

use App\Libraries\MongoDb;

class CustomerDetailMongoDB {

	private $database = 'roytuts';
	private $collection = 'customer_detail';
	private $conn;

	function __construct() {
		$mongodb = new MongoDb();
		$this->conn = $mongodb->getConn();
	}

	function create_customer_detail_list() {
		try {
			$filter = [];
			$query = new \MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database . '.' . $this->collection, $query);
			
			return $result->toArray();
		} catch(\MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching users: ' . $ex->getMessage(), 500);
		}
	}

	function get_customer_detail($custId) {
		try {
			$filter = ["custId" =>$custId];
			$query = new \MongoDB\Driver\Query($filter);
			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);
			#echo '<pre>'; print_r($result); echo '</pre>'; die();
			foreach($result as $user) {
				return $user;
			}

			return null;
		} catch(\MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching user: ' . $ex->getMessage(), 500);
		}
	}

	function create_customer_detail($custId, $name, $phone, $address) {
		try {
			$user = array(
				'custId' => $custId,
				'name' => $name,
				'phone'=> $phone,
				'address' => $address
			);

			$query = new \MongoDB\Driver\BulkWrite();
			$query->insert($user);

			$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);

			if($result->getInsertedCount() == 1) {
				return true;
			}

		} catch(\MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while saving users: ' . $ex->getMessage(), 500);
		}
	}

	function update_customer_detail($_id, $name, $email) {
		try {
			$query = new \MongoDB\Driver\BulkWrite();
			$query->update(['_id' => new \MongoDB\BSON\ObjectId($_id)], ['$set' => array('name' => $name, 'email' => $email)]);

			$result = $this->conn->executeBulkWrite($this->database . '.' . $this->collection, $query);

			if($result->getModifiedCount()) {
				return true;
			}

			return false;
		} catch(\MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while updating users: ' . $ex->getMessage(), 500);
		}
	}

	function delete_customer_detail($_id) {
		try {
			$query = new \MongoDB\Driver\BulkWrite();
			$query->delete(['_id' => new \MongoDB\BSON\ObjectId($_id)]);

			$result = $this->conn->executeBulkWrite($this->database . '.' . $this->collection, $query);

			if($result->getDeletedCount() == 1) {
				return true;
			}

			return false;
		} catch(\MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while deleting users: ' . $ex->getMessage(), 500);
		}
	}

}