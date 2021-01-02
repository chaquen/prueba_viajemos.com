<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use App\Utils\Utilities;
use App\Models\Libro;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            Log::info('INFO: metodo '.__FUNCTION__." en ".__CLASS__); 
            $libros=Libro::all();         
            foreach($libros as $key => $libro){
                
                $libros[$key]['autor'] = DB::table('autores_has_libros')
                ->join('autores','autores.id','=','autores_id')
                ->where("libros_ISBN",$libro['ISBN'])
                ->select('autores.id','autores.nombre','autores.apellidos')
                ->get()[0];
                
                $libros[$key]['editorial'] = DB::table('editoriales')
                ->where("id",$libro['editoriales_id'])
                ->select('id','nombre','sede')
                ->get()[0];
                
            }
            
            return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_OK,"Libros encontrados",false,Utilities::COD_RESPONSE_HTTP_OK,$libros);

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
        //
        try {
            Log::info('INFO: metodo '.__FUNCTION__." en ".__CLASS__.' parameters [' . implode(",",$request->all())."]"); 
            $validator = Validator::make($request->all(), [
                'ISBN' => 'required|string|unique:libros',
                'editoriales_id' => 'required',
                'titulo' => 'required',
                'sinopsis' => 'required|min:50',
                'n_paginas' => 'required',
                'autores_id' => 'required',
            ]);
            if ($validator->fails()) {
                Log::error('Los datos ingresados no son válidos: ' . $validator->errors());
                return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_BAD_REQUEST,"Datos ingresados no son válidos",$validator->errors(),Utilities::COD_RESPONSE_HTTP_OK,$request->all());
            }
            
            $libro=Libro::create([
                "ISBN"=>$request->ISBN,
                "editoriales_id"=>$request->editoriales_id,
                "titulo"=>$request->titulo,
                "sinopsis"=>$request->sinopsis,
                "n_paginas"=>$request->n_paginas,
            ]);
            if(is_null($libro->id)){
                return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_FORBIDDEN,"EL libro ".$request->titulo.", no fue creado",true,Utilities::COD_RESPONSE_HTTP_OK,$libro);    
            }
            DB::table("autores_has_libros")->insert([
                "autores_id" => $request->autores_id,
                "libros_ISBN" => $request->ISBN
            ]);

            return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_OK,"EL libro ".$request->titulo.", fue creado exitosamente",false,Utilities::COD_RESPONSE_HTTP_OK,$libro);

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
            $libros=Libro::where("ISBN",$id)->get();           
            if(count($libros) == 0){
                return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_FORBIDDEN,"Libro no fue encontrado",true,Utilities::COD_RESPONSE_HTTP_FORBIDDEN,$libros);
            }
            return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_OK,"Libro encontrado",false,Utilities::COD_RESPONSE_HTTP_OK,$libros);

        } catch (Exception $ex) {
            Log::critical($ex->getMessage());
            return Utilities::sendMessage(Utilities::COD_RESPONSE_HTTP_OK,$ex->getMessage(),true,Utilities::COD_RESPONSE_HTTP_OK);
        }
    }
    
}
