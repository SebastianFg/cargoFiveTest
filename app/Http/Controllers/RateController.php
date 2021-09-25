<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  \App\rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rate $rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function getRateByContract($contract_id,Request $request)
    {
        ;
        if ($contract_id == null) {
            return response()
                ->json([
                    'success' => false,
                    'status' => 404,
                    'message' => "Debe enviar el id contrato",
                ], 404);
        } else {

            if (!$request->get('pageSize')) {

                $request->merge(['pageSize' => '10']);
            }
            if (!$request->get('sort')) {

                $request->merge(['sort' => 'desc']);
            }

            if (!$request->get('order')) {

                $request->merge(['order' => 'id']);
            }



            try {
                $rates = Rate::where('contract_id', $contract_id )
                    ->orderBy($request->get('order'), $request->get('sort'))
                    ->paginate($request->get('pageSize'));
            } catch (\Throwable $th) {
                return $th;
                return response()
                    ->json([
                        'success' => false,
                        'status' => 404,
                        'message' => "Error al buscar la lista de tarifas.",
                    ], 404);
            }

            return response()
                ->json([
                    'success' => true,
                    'status' => 200,
                    'records' => $rates,
                ], 200);
        }
    }
}
