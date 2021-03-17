<?php


namespace App\Services;

use App\Model\MySql\News;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class NewsService
{
    private $news;

    public function __construct(news $news)
    {
        $this->news = $news;
    }

    public function search($data)
    {
        $query = $this->news;
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
        $news = $this->news;
        foreach ($data as $key => $value) {
            $news->$key = $value;
        }
        $news->save();
        return $news;
    }

    public function edit($news, $data)
    {
        try {
            foreach ($data as $key => $value) {
                $news->$key = $value;
            }
            $news->save();

            DB::commit();
            return $news;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function first($condition)
    {
        $news = $this->news;
        foreach ($condition as $key => $value) {
            $news = $news->where($key, $value);
        }
        $news = $news->first();

        return $news;
    }


    public function delete($condition){
        try {
            DB::beginTransaction();

            $news = $this->news;
            foreach ($condition as $key => $value) {
                $news = $news->where($key, $value);
            }
            $news = $news->delete();

            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function get($data)
    {
        $query = $this->news;
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
