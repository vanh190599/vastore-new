<?php


namespace App\Services;
use App\Model\MySql\order;
use App\Model\MySql\OrderDetail;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Carbon\Carbon;

class OrderDetailService
{
    private $orderDetail;

    public function __construct(OrderDetail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    public function search($data)
    {
        $query = $this->orderDetail;
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
        $orderDetail = $this->orderDetail;
        foreach ($data as $key => $value) {
            $orderDetail->$key = $value;
        }
        $orderDetail->save();
        return $orderDetail;
    }

    public function edit($orderDetail, $data)
    {
        try {
            foreach ($data as $key => $value) {
                $orderDetail->$key = $value;
            }
            $orderDetail->save();

            DB::commit();
            return $orderDetail;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function first($condition)
    {
        $orderDetail = $this->orderDetail;
        foreach ($condition as $key => $value) {
            $orderDetail = $orderDetail->where($key, $value);
        }
        $orderDetail = $orderDetail->first();

        return $orderDetail;
    }


    public function delete($condition)
    {
        try {
            DB::beginTransaction();

            $orderDetail = $this->orderDetail;
            foreach ($condition as $key => $value) {
                $orderDetail = $orderDetail->where($key, $value);
            }
            $orderDetail = $orderDetail->delete();

            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function get($data)
    {
        $query = $this->orderDetail;
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


    /**
     * @return array [key: data(int) ; value:category (date d-m-Y)]
     */
    public function chartByDay(){
        $detail = $this->orderDetail;
        $start =  strtotime(Carbon::now()->startOfMonth());
        $end   = strtotime(Carbon::now()->endOfMonth());
        $numberDayOfCurrentMonth = date('t');

        $period = [];
        $time = $start;
        for ($i = 0; $i <= $numberDayOfCurrentMonth; $i++ ) {
            $period[] = $time;
            $time = $time + 86400;
        }

        $result = [];
        $cate = [];
        foreach ($period as $key => $value) {
            if ($key < $numberDayOfCurrentMonth) {
                $qty = $detail->whereBetween('date', [$period[$key], $period[$key+1] - 1])->sum('qty');
                $result[] = (int) $qty;
                $cate[]   = date('d-m-Y' ,$value);
            }
        }

        $data = [];
        $data['data'] = $result;
        $data['cate'] = $cate;

        return $data;
    }

    public function chartByMonth(){
        $detail = $this->orderDetail;
        $start = "1-1-2021";
        $start = strtotime($start);
        $start = Carbon::parse($start);

        $period = [];
        $time = $start;
        $test = [];
        for ($i = 0; $i <= 12; $i++ ) {
            $period[] = strtotime($time);
            $test[] = date('d-m-Y', strtotime($time));
            $time = $time->addMonth(1);
        }
        //dd($test);

        $result = [];
        $cate = [];
        foreach ($period as $key => $value) {
            if ($key < 12) {
                $qty = $detail->whereBetween('date', [$period[$key], $period[$key+1] - 1])->sum('qty');
                $result[] = (int) $qty;
                $cate[]   = date('d-m-Y' ,$value);
            }
        }

        $data = [];
        $data['data'] = $result;
        $data['cate'] = $cate;

        return $data;
    }
}
