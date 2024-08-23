<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\GroceryCrud;
use App\Models\CustomerModel;

define('_TITLE', 'Customer');

class Customer extends BaseController
{
    public function index()
    {
        $customer_model = new CustomerModel();

        $crud = new GroceryCrud();
        $crud->setLanguage('Indonesian');
        $crud->setRule('name', 'Nama', 'required', [
            'required' => '{field} harus diisi!'
        ]);

        $crud->setTable('customer');
        //$crud->columns(['name', 'gender', 'no_customer']);
        $crud->unsetColumns(['created_at', 'updated_at', 'deleted_at'])
            ->displayAs([
                'name' => 'Nama Customer',
                'no_customer' => 'No Customer',
                'gender' => 'L/P',
                'address' => 'Alamat',
                'phone' => 'No Telp',
            ]);
        // ->unsetAdd()
        // ->unsetEdit()
        // ->unsetDelete()
        // ->unsetExport()
        // ->unsetPrint();

        $crud->setTheme('datatables');
        $crud->unsetAddFields(['created_at', 'updated_at', 'deleted_at']);
        $crud->unsetEditFields(['created_at', 'updated_at', 'deleted_at']);
        //$crud->unsetFields(['created_at', 'updated_at', 'deleted_at']);

        $crud->callbackInsert(function ($stateParameters) use ($customer_model) {
            $customer_model->save($stateParameters->data);
            return $stateParameters;
        });

        $crud->callbackDelete(function ($stateParameters) use ($customer_model) {
            $customer_model->delete($stateParameters->primaryKeyValue);
            return $stateParameters;
        });

        $output = $crud->render();

        $data = [
            'title' => 'Data Customer',
            'result' => $output
        ];
        return view('customer/index', $data);
    }
}
