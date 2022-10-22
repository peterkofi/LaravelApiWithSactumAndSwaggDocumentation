<?php

namespace App\Http\Controllers;


use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

 /**
     * 
     * @OA\Get (
     *     path="/categorie",
     *     tags={"categorie"},
     *   summary="Affiche Toutes les categories se trouvant dans la base de données",  
     * @OA\Response(
     *         response=200,
     *         description="success",
     *        
     *     )
     * )
     */

    public function index()
    {
        return Categorie::all();
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Post(
     *     path="/categorie",
     *     tags={"categorie"},
     *     summary="Enregistrer une categorie",
     *     operationId="saveCategorie",
     *     @OA\Response(
     *         response=201,
     *         description="Enregistremnt avec success",
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     
     * )
     */

    public function store(Request $request)
    {

        $request->validate([
            'libelle'=>'required',
        ]);

       return Categorie::create($request->all());
        //
    }

    
      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     *
     * @OA\Get (
     *     path="/categorie/{idCategorie}",
     *     tags={"categorie"},
     *     summary=" Affiche Toutes les categories ayant l'Id recherché",
     *      @OA\Parameter(
     *         name="idCategorie",
     *         in="path",
     *         description="idCategorie designe l'Id recherché",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example="12"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="visualisation du categorie recherché",
     *     ),
     *      @OA\Response(
     *         response=400,
     *         description="Id Invalide",
     *     ),
     *   @OA\Response(
     *         response=404,
     *         description="le categorie n'existe pas",
     *     ),
     * )
     */


  
    public function show($id)
    {

        return Categorie::find($id);
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
        $ctegorie=Categorie::find($id);
        $categorie->update($request->all());

        return $categorie;

        //
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */

      /**
     * @OA\Delete(
     *     path="/categorie/{categorie}",
     *     tags={"categorie"},
     *     summary="supprimes le categorie ayant Id specifier à l'argument",
     *     operationId="destroyCategorie",
     *     @OA\Parameter(
     *         name="categorie",
     *         in="path",
     *         description="categorie est l'Id du prosui récherché",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example="12"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Id Invalide",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="le produit n'existe pas",
     *     ),
     *     
     * )
     */

    public function destroy($id)
    {

      $produit =  Produit::destroy($id);

        if($produit){
            return response([
                "message" => "suppression avec success",
                "status"=>201
            ]);
        }
        //
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  string   $nom
     * @return \Illuminate\Http\Response
     */

     /**
     *
     * @OA\Get (
     *     path="/categorie/search/libelleCategorie",
     *     tags={"categorie"},
     *     summary=" Affiche Toutes les categorie contenant le nom rechercher dans son libellé",
     *     operationId="searchCategorie",
     *     @OA\Parameter(
     *         name="produit",
     *         in="path",
     *         description="libelleCategorie designe toutes les categories contenant le nom rechercher son libellé",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example="chemise"
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="nom",
     *                         type="string",
     *                         example="ballon"
     *                     )
     *                     
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    
    public function search($nom)
    {
       
        $categorie=Categorie::where('libelle','like','%'.$nom.'%')
                        ->get();

        return $categorie;

        //
    }

     
}
