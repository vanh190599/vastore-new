<?php


namespace App\Services;

use App\Model\MySql\Product;

class ProductService
{
//    const STATUS_ACTIVE = 1; // hoạt động
//    const STATUS_BLOCK = -1; // khóa
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function search($data)
    {
        $query = $this->product;
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
        $product = $this->product;
        foreach ($data as $key => $value) {
            $product->$key = $value;
        }
        $product->save();
        return $product;
    }

    public function edit($product, $data)
    {
        foreach ($data as $key => $value) {
            $product->$key = $value;
        }
        $product->save();
        return $product;
    }

    public function first($condition){
        $product = $this->product;
        foreach ($condition as $key => $value) {
            $product = $product->where($key, $value);
        }
        $product = $product->first();
        return $product;
    }

    public function delete($condition){
        $product = $this->product;
        foreach ($condition as $key => $value) {
            $product = $product->where($key, $value);
        }
        $product = $product->delete();
    }

    public function get($data){
        $query = $this->product;
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
