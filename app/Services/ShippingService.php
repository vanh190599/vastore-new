<?php


namespace App\Services;

use App\Model\MySql\shipping;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class ShippingService
{
    private $shipping;

    public function __construct(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }

    public function search($data)
    {
        $query = $this->shipping;
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
            $query = $query->shippingBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        }
        $result = $query->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $result;
    }

    public function create($data)
    {
        $shipping = $this->shipping;
        foreach ($data as $key => $value) {
            $shipping->$key = $value;
        }
        $shipping->save();
        return $shipping;
    }

    public function edit($shipping, $data)
    {
        try {
            foreach ($data as $key => $value) {
                $shipping->$key = $value;
            }
            $shipping->save();

            DB::commit();
            return $shipping;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function first($condition)
    {
        $shipping = $this->shipping;
        foreach ($condition as $key => $value) {
            $shipping = $shipping->where($key, $value);
        }
        $shipping = $shipping->first();

        return $shipping;
    }


    public function delete($condition)
    {
        try {
            DB::beginTransaction();

            $shipping = $this->shipping;
            foreach ($condition as $key => $value) {
                $shipping = $shipping->where($key, $value);
            }
            $shipping = $shipping->delete();

            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function get($data)
    {
        $query = $this->shipping;
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
