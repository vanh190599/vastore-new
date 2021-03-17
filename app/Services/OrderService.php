<?php


namespace App\Services;


use App\Model\MySql\order;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class orderService
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function search($data)
    {
        $query = $this->order;
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
        $order = $this->order;
        foreach ($data as $key => $value) {
            $order->$key = $value;
        }
        $order->save();
        return $order;
    }

    public function edit($order, $data)
    {
        try {
            foreach ($data as $key => $value) {
                $order->$key = $value;
            }
            $order->save();

            DB::commit();
            return $order;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function first($condition)
    {
        $order = $this->order;
        foreach ($condition as $key => $value) {
            $order = $order->where($key, $value);
        }
        $order = $order->first();

        return $order;
    }


    public function delete($condition)
    {
        try {
            DB::beginTransaction();

            $order = $this->order;
            foreach ($condition as $key => $value) {
                $order = $order->where($key, $value);
            }
            $order = $order->delete();

            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function get($data)
    {
        $query = $this->order;
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
