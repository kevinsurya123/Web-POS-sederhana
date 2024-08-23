<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\GroceryCrud;
use App\Models\SupplierModel;

define('_TITLE', 'Supplier');

class Supplier extends BaseController
{
    public function index()
    {
        $supplier_model = new SupplierModel();

        $crud = new GroceryCrud();
        $crud->setLanguage('Indonesian');
        $crud->setRule('name', 'Nama', 'required', [
            'required' => '{field} harus diisi!'
        ]);

        $crud->setTable('supplier');
        //$crud->columns(['name', 'gender', 'no_customer']);
        $crud->unsetColumns(['created_at', 'updated_at', 'deleted_at'])
            ->displayAs([
                'name' => 'Nama Supplier',
                'no_supplier' => 'No Supplier',
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

        $crud->callbackInsert(function ($stateParameters) use ($supplier_model) {
            $supplier_model->save($stateParameters->data);
            return $stateParameters;
        });

        $crud->callbackDelete(function ($stateParameters) use ($supplier_model) {
            $supplier_model->delete($stateParameters->primaryKeyValue);
            return $stateParameters;
        });

        $output = $crud->render();

        $data = [
            'title' => 'Data Supplier',
            'result' => $output
        ];
        return view('supplier/index', $data);
    }
}
