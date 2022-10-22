<?php

namespace App\Http\Controllers;

use App\Models\Marchand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MarchandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     /**
     * 
     * @OA\Get (
     *     path="/marchands",
     *     tags={"marchand"},
     *   summary="Affiche Tous les marchands se trouvant dans la base de données",  
     *   
     * @OA\Response(
     *         response=200,
     *         description="success",
     *        
     *     )
     * )
     */


    public function index()
    {
        return Marchand::all();
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
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'contact'=>'required',
            'Adresse'=>'required'
        ]);

        return Marchand::create($request->all());
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\get(
     *     path="/marchands/{marchand}",
     *     tags={"marchand"},
     *     summary="affiche un marchand spécifique ayant Id specifier à l'argument",
     *     operationId="showMarchand",
     *     @OA\Parameter(
     *         name="marchand",
     *         in="path",
     *         description="marchand est l'Id du marchand récherché",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *           
     *         ),
     *     ),
     * @OA\Response(
     *         response=200,
     *         description="visualisation du produit recherché",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Id Invalide",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="le produit n'existe pas",
     *     ),
     *     security={
     *         {"petstore_auth": {"write:produit", "read:produit"}}
     *     },
     * )
     */


    public function show($id)
    {
        return Marchand::find($id);
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
        $marchand = Marchand::find($id);
        $marchand->update($request->all());

        return $marchand;

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
        $marchand = Marchand::destroy($id);

            if($marchand){
                return response([
                    "message"=>"suppression avec success",
                    "status"=>201
                ]);
            }

        //
    }

    public function search($nom)
    {
       
        $marchand=Marchand::where('nom','like','%'.$nom.'%')
                        ->orWhere('prenom','like','%'.$nom.'%')
                        ->get();

        return $marchand;

        //
    }


}
