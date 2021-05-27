<?php


namespace App\Services;

use App\Model\MySql\product;
use App\Model\MySql\ProductLog;
use DB;
use Exception;

class ProductService
{
    const DB_INSERT = 1;
    const DB_UPDATE = 2;
    const DB_DELETE = 3;
    public static $aryActionDB = [
        self::DB_INSERT => "Thêm",
        self::DB_UPDATE => "Sửa",
        self::DB_DELETE => "Xóa",
    ];

    private $product;
    private $log;

    public function __construct(Product $product, ProductLog $log)
    {
        $this->product = $product;
        $this->log = $log;
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

        $query = $query->where('del_flag', 0);

        //filter by price
        if (isset($data['filter']) && sizeof($data['filter']) > 0) {
            $query = $query->whereBetween('price', $data['filter']);
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

    public function createProduct($params){
        DB::beginTransaction();
        try {
            $user = auth('admin')->user();

            $data["name"] = $params["name"];
            $data["colors"] = $params["colors"];
            $data["brand_id"] = (int) $params["brand_id"];
            $data["price"] = $params["price"];
            $data["price_discount"] = $params["price_discount"];
            $data["unit_num"] = (int) $params["unit_num"];
            $data["unit_label"] = (int) $params["unit_label"];
            $data["release_date"] = $params["release_date"];
            $data["height"] = $params["height"];
            $data["width"] = $params["width"];
            $data["depth"] = $params["depth"];
            $data["tech_screen"] = $params["tech_screen"];
            $data["size"] = $params["size"];
            $data["cpu"] = $params["cpu"];
            $data["ram"] = $params["ram"];
            $data["rom"] = $params["rom"];
            $data["battery_capacity"] = $params["battery_capacity"];
            $data["camera_before"] = $params["camera_before"];
            $data["camera_after"] = $params["camera_after"];
            $data["description"] = $params["description"];
            $data["image"] = $params["image"];
            $data["status"] = 1;
            $data["attach"] = $params["attach"];
            $data["attach_image"] = $params["attach_image"];
            $data["qty"] = (int) $params["qty"];
            $data["sold"] = 0;
            $data["release_date"] = strtotime($data["release_date"]);

            $product = $this->create($data);

            if ($product) {
                $this->createLog($product->id, "Thêm sản phẩm", ProductService::DB_INSERT, [], $product->toArray(), $user);
            }

            DB::commit();
            return $product;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function editProduct($params){
        DB::beginTransaction();
        try {
            $product = $this->first(['id' => $params["id"]]);
            $before = $product->toArray();

            $user = auth('admin')->user();

            $data["name"] = $params["name"];
            $data["colors"] = $params["colors"];
            $data["brand_id"] = (int) $params["brand_id"];
            $data["price"] = $params["price"];
            $data["price_discount"] = $params["price_discount"];
            $data["unit_num"] = (int) $params["unit_num"];
            $data["unit_label"] = (int) $params["unit_label"];
            $data["release_date"] = !empty($data["release_date"]) ? strtotime($data["release_date"]) : 0;
            $data["height"] = $params["height"];
            $data["width"] = $params["width"];
            $data["depth"] = $params["depth"];
            $data["tech_screen"] = $params["tech_screen"];
            $data["size"] = $params["size"];
            $data["cpu"] = $params["cpu"];
            $data["ram"] = $params["ram"];
            $data["rom"] = $params["rom"];
            $data["battery_capacity"] = $params["battery_capacity"];
            $data["camera_before"] = $params["camera_before"];
            $data["camera_after"] = $params["camera_after"];
            $data["description"] = $params["description"];
            $data["image"] = $params["image"];
            $data["status"] = 1;
            $data["attach"] = $params["attach"];
            $data["attach_image"] = $params["attach_image"];
            $data["qty"] = (int) $params["qty"];
            $data["sold"] = isset($params["sold"]) ? (int) $params["sold"] : 0;

            $product = $this->edit($product, $data);

            if ($product) {
                $this->createLog($product->id, "Sửa sản phẩm", ProductService::DB_UPDATE, $before, $product->toArray(), $user);
            }

            DB::commit();
            return $product;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteProduct($params){
        DB::beginTransaction();
        try {
            $product = $this->first(['id' => $params["id"]]);
            $before = $product->toArray();

            $user = auth('admin')->user();

            $data["del_flag"] = 1;

            $product = $this->edit($product, $data);

            if ($product) {
                $this->createLog($product->id, "Xóa sản phẩm", ProductService::DB_UPDATE, $before, $product->toArray(), $user);
            }

            DB::commit();
            return $product;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createLog($product_id, $name, $action, $before, $after, $user) {
        $log = $this->log;

        $log->product_id = $product_id;
        $log->name = $name;
        $log->action = $action;
        $log->content_before = json_encode($before);
        $log->content_after = json_encode($after);
        $log->date_c = time();
        $log->user_id_c = isset($user['id']) ? $user['id'] : "";
        $log->user_name_c = isset($user['name']) ? $user['name'] : "";

        $log->save();
    }
}
