<?php 
namespace App\Models;
use CodeIgniter\Model;
class CustomerPhoneModel extends Model
{
    protected $table = 'customer_phone';
    protected $primaryKey = 'id';
    protected $allowedFields = ['cust_id','phone'];
}