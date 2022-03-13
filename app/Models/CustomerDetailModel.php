<?php 
namespace App\Models;
use CodeIgniter\Model;
class CustomerDetailModel extends Model
{
    protected $table = 'customer_details';
    protected $primaryKey = 'id';
    protected $allowedFields = ['custid','name','phone','address'];
}