<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Http\Requests\ContractRequest;
use Illuminate\Http\Request;
use App\Imports\RatesImport;

//excel library
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        return Contract::orderBy('id', 'desc')->paginate($request->get('per_page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request)
    {


        $file_extension = array('xls', 'xlsx', 'xlsm', 'csv');

        if (!in_array($request->file('file')->getClientOriginalExtension(), $file_extension)) {
            return response()
                ->json([
                    'success' => false,
                    'status' => 203,
                    'message' => "Solo se aceptar archivos excel (xls,xlsx,xlsm).",
                ], 203);
        }

        DB::beginTransaction();

        try {
            $contract = Contract::create([
                'nombre' => $request->get('name'),
                'fecha' => $request->get('date')
            ]);

            Excel::import(new RatesImport($contract->id), $request->file('file'));
        } catch (\Throwable $th) {

            DB::rollBack();
            return response()
                ->json([
                    'success' => false,
                    'status' => 404,
                    'message' => "Error al crear el contrato.",
                ], 404);
        }

        DB::commit();

        return response()
            ->json([
                'success' => true,
                'status' => 201,
                'message' => "Contrato y sus tarifas cargadas con éxito!.",
            ], 201);
    }
}
