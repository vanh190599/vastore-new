<?php


namespace App\Services;

use App\Model\MySql\customer;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class CustomerService
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function search($data)
    {
        $query = $this->customer;
        if (!empty($data['select'])) {
            $query = $query->select($data['select']);
        }
        if (!empty($data['conditions'])) {
            $conditions = $data['conditions'];
            foreach ($conditions as $condition) {
                $operation = isset($condition['operator']) ? $condition['operator'] : '';
                switch ($operation) {
                    case 'like':
                        $query = $query->where($condition['key'], 'like', '%' . $condition['value'] . '%');
                        break;
                    case 'in':
                        $query = $query->whereIn($condition['key'], $condition['value']);
                        break;
                    case '':
                        $query = $query->where($condition['key'], $condition['value']);
                        break;
                    default:
                        $query = $query->where($condition['key'], $operation, $condition['value']);
                }
            }
        }
        if (isset($data['sortBy']) && $data['sortBy'] != '') {
            $query = $query->orderBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        }
        $result = $query->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $result;
    }

    public function create($data)
    {
        $customer = $this->customer;
        foreach ($data as $key => $value) {
            $customer->$key = $value;
        }
        $customer->save();
        return $customer;
    }

    public function edit($customer, $data)
    {
        try {
            foreach ($data as $key => $value) {
                $customer->$key = $value;
            }
            $customer->save();

            DB::commit();
            return $customer;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function first($condition)
    {
        $customer = $this->customer;
        foreach ($condition as $key => $value) {
            $customer = $customer->where($key, $value);
        }
        $customer = $customer->first();

        return $customer;
    }


    public function delete($condition){
        try {
            DB::beginTransaction();

            $customer = $this->customer;
            foreach ($condition as $key => $value) {
                $customer = $customer->where($key, $value);
            }
            $customer = $customer->delete();

            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function get($data)
    {
        $query = $this->customer;
        if (!empty($data['select'])) {
            $query = $query->select($data['select']);
        }
        if (!empty($data['conditions'])) {
            $conditions = $data['conditions'];
            foreach ($conditions as $condition) {
                $operation = isset($condition['operator']) ? $condition['operator'] : '';
                switch ($operation) {
                    case 'like':
                        $query = $query->where($condition['key'], 'like', '%' . $condition['value'] . '%');
                        break;
                    case 'in':
                        $query = $query->whereIn($condition['key'], $condition['value']);
                        break;
                    case '':
                        $query = $query->where($condition['key'], $condition['value']);
                        break;
                    default:
                        $query = $query->where($condition['key'], $operation, $condition['value']);
                }
            }
        }

        $result = $query->get();

        return $result;
    }
}
