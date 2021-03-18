<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Library\CGlobal;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller {

    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function search(Request $request){
        $conditions = [];
        if (! empty($request->name)) {
            array_push($conditions, [
                'key' => 'name',
                'value' => $request->name,
                'operator' => 'like'
            ]);
        }

        $data = [
            'conditions' => $conditions,
            'limit' => 50,
            'sortBy' => 'created_at',
            'sortOrder' => 'DESC'
        ];

        $aryStatus = CGlobal::$aryStatusActive;
        $customers = $this->customerService->search($data);


        return view('admin.customer.search',
            compact('customers', 'aryStatus')
        );
    }

}
