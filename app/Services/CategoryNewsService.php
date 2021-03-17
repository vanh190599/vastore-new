<?php


namespace App\Services;


use App\Model\MySql\categoryNew;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class CategoryNewsService
{
    private $categoryNew;

    public function __construct(CategoryNew $categoryNew)
    {
        $this->categoryNew = $categoryNew;
    }

    public function search($data)
    {
        $query = $this->categoryNew;
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
        $categoryNew = $this->categoryNew;
        foreach ($data as $key => $value) {
            $categoryNew->$key = $value;
        }
        $categoryNew->save();
        return $categoryNew;
    }

    public function edit($categoryNew, $data)
    {
        try {
            foreach ($data as $key => $value) {
                $categoryNew->$key = $value;
            }
            $categoryNew->save();

            DB::commit();
            return $categoryNew;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function first($condition)
    {
        $categoryNew = $this->categoryNew;
        foreach ($condition as $key => $value) {
            $categoryNew = $categoryNew->where($key, $value);
        }
        $categoryNew = $categoryNew->first();

        return $categoryNew;
    }


    public function delete($condition){
        try {
            DB::beginTransaction();

            $categoryNew = $this->categoryNew;
            foreach ($condition as $key => $value) {
                $categoryNew = $categoryNew->where($key, $value);
            }
            $categoryNew = $categoryNew->delete();

            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function get($data)
    {
        $query = $this->categoryNew;
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
