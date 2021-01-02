<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use App\Utils\Utilities;
use App\Models\Editorial;

class EditorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            Log::info('INFO: metodo '.__FUNCTION__." en ".__CLASS__); 
            $editoriales=Editorial::all();           
            return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_OK,"Editoriales encontradas",false,Utilities::COD_RESPONSE_HTTP_OK,$editoriales);

        } catch (Exception $ex) {
            Log::critical($ex->getMessage());
            return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_OK,$ex->getMessage(),true,Utilities::COD_RESPONSE_HTTP_OK);
        }
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
            Log::info('INFO: metodo '.__FUNCTION__." en ".__CLASS__.' parameters [' . implode(",",$request->all())."]"); 
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|unique:editoriales',
                'sede' => 'required'
            ]);
            if ($validator->fails()) {
                Log::error('Los datos ingresados no son válidos: ' . $validator->errors());
                return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_BAD_REQUEST,"Datos ingresados no son válidos",$validator->errors(),Utilities::COD_RESPONSE_HTTP_OK,$request->all());
            }
            
            $editorial=Editorial::Create([
                "nombre"=>$request->nombre,
                "sede"=>$request->sede                
            ]);
 
            return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_OK,"La editorial #{$editorial->id} {$request->nombre} fue creda exitosamente",false,Utilities::COD_RESPONSE_HTTP_OK,$editorial);

        } catch (Exception $ex) {
            Log::critical($ex->getMessage());
            return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_OK,$ex->getMessage(),true,Utilities::COD_RESPONSE_HTTP_OK);
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
        try {
            Log::info('INFO: metodo '.__FUNCTION__." en ".__CLASS__); 
            $editorial=Editorial::where("id",$id)->get();  
            if(count($editorial) == 0){
                return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_FORBIDDEN,"Editorial no existe",true,Utilities::COD_RESPONSE_HTTP_OK,$editorial);
            }         
            return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_OK,"Editorial encontradas",false,Utilities::COD_RESPONSE_HTTP_OK,$editorial);

        } catch (Exception $ex) {
            Log::critical($ex->getMessage());
            return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_OK,$ex->getMessage(),true,Utilities::COD_RESPONSE_HTTP_OK);
        }
    }

}
