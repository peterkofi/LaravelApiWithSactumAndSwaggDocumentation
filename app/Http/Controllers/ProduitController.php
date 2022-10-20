<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     /**
     * 
     * @OA\Get (
     *     path="/produit",
     *     tags={"produit"},
     *   summary="Affiche Tous produits se trouvant dans la base de données",  
     * @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="_id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example="example title"
     *                     ),
     *                     @OA\Property(
     *                         property="content",
     *                         type="string",
     *                         example="example content"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function index()
    {
        return Produit::all();
    }


    /**
     * Enregistre les information du produit dans la base de données
     * @OA\Get (
     *     path="/produit",
     *     tags={"produit"},
     *     @OA\Response(
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
     *                     ),
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="ballon pou enfant"
     *                     )
     *                     
     *                 )
     *             )
     *         )
     *     )
     * )
     */



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $request->validate([
            'libelle'=>'required',
            'description'=>'required',
            'prix'=>'required'
        ]);

       return Produit::create($request->all());
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
     *     path="/produit/search/nomProduit",
     *     tags={"produit"},
     *     summary=" Affiche Tous produits contenant le nom rechercher dans sa description ou libellé",
     *      @OA\Parameter(
     *         name="produit",
     *         in="path",
     *         description="produit designe tous les produits contenant le nom rechercher dans sa description ou libellé",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
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


  
    public function show($id)
    {

        return Produit::find($id);
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
        $produit=Produit::find($id);
        $produit->update($request->all());

        return $produit;

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */

    public function destroy($id)
    {

        Produit::destroy($id);
        //
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  string   $nom
     * @return \Illuminate\Http\Response
     */
    
    public function search($nom)
    {
       
        $produit=Produit::where('libelle','like','%'.$nom.'%')
                        ->orWhere('description','like','%'.$nom.'%')
                        ->get();

        return $produit;

        //
    }
}
