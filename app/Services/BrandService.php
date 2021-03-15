<?php


namespace App\Services;


use App\Model\MySql\Brand;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class BrandService
{
    private $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function search($data)
    {
        $query = $this->brand;
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
        $brand = $this->brand;
        foreach ($data as $key => $value) {
            $brand->$key = $value;
        }
        $brand->save();
        return $brand;
    }

    public function edit($brand, $data)
    {
        try {
            foreach ($data as $key => $value) {
                $brand->$key = $value;
            }
            $brand->save();

            DB::commit();
            return $brand;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function first($condition)
    {
        $brand = $this->brand;
        foreach ($condition as $key => $value) {
            $brand = $brand->where($key, $value);
        }
        $brand = $brand->first();

        return $brand;
    }


    public function delete($condition){
        try {
            DB::beginTransaction();

            $brand = $this->brand;
            foreach ($condition as $key => $value) {
                $brand = $brand->where($key, $value);
            }
            $brand = $brand->delete();

            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function get($data)
    {
        $query = $this->brand;
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
