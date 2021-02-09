<?php


namespace App\Services;


use App\Model\MySql\Admin;

class ProductService
{
//    const STATUS_ACTIVE = 1; // hoạt động
//    const STATUS_BLOCK = -1; // khóa
    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function search($data)
    {
        $query = $this->admin;
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
        $admin = $this->admin;
        foreach ($data as $key => $value) {
            $admin->$key = $value;
        }
        $admin->save();
        return $admin;
    }

    public function edit($admin, $data)
    {
        foreach ($data as $key => $value) {
            $admin->$key = $value;
        }
        $admin->save();
        return $admin;
    }

    public function first($condition){
        $admin = $this->admin;
        foreach ($condition as $key => $value) {
            $admin = $admin->where($key, $value);
        }
        $admin = $admin->first();
        return $admin;
    }

    public function delete($condition){
        $admin = $this->admin;
        foreach ($condition as $key => $value) {
            $admin = $admin->where($key, $value);
        }
        $admin = $admin->delete();
    }
}
