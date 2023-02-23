<?php

namespace App\Http\Controllers;

use App\Models\StrengtheningSupervisionManagers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StrengtheningSupervisionManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, StrengtheningSupervisionManagers $model)
    {

        $query = $model->query();

        $query->when($request->has('s'), function($query) use($request){
            $search = trim($request->s);
            $query->whereHas('nac', function ($query) use ($search) {
                $query->where('name',
                    'like',
                    "%{$search}%"
                );
            })->orWhereHas('rol', function ($query) use ($search) {
                $query->where('name',
                    'like',
                    "%{$search}%"
                );
            });
        })
        ->with(['nac','rol']);

        return $request->has('per_page')
        ? $query->paginate($request->per_page)
        : $query->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();


            StrengtheningSupervisionManagers::create([
                'revision_date'=>$request->revision_date,
                'nac_id'=>$request->nac['id'],
                'role_id'=>$request->rol['id'],
                'start_time'=>$request->start_time,
                'final_time'=>$request->final_time,
                'development_activity_image'=>$request->development_activity_image,
                'evidence_participation_image'=>$request->evidence_participation_image,
            ]);


            DB::commit();

            return response()->json(['status' => 'exito', 'msg' => 'Datos guardados'], 200);

        } catch (\Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage().PHP_EOL.$ex->getTraceAsString());
            return response()->json(['status' => 'fail', 'msg' => 'Ha ocurrido un error al procesar la solicitud'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supervision=StrengtheningSupervisionManagers::where('id', $id)->with(['nac.roles','rol'])->first();
        return response()->json($supervision);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
