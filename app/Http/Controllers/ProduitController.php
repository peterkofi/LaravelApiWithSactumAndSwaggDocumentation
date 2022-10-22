<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
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
        return Produit::all();
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
     * @OA\get(
     *     path="/produit/{produit}",
     *     tags={"produit"},
     *     summary="affiche un produit spécifique ayant Id specifier à l'argument",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="produit",
     *         in="path",
     *         description="produit est l'Id du produit récherché",
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

      /**
     * @OA\Delete(
     *     path="/produit/{produit}",
     *     tags={"produit"},
     *     summary="supprimes les produit ayant Id specifier à l'argument",
     *     operationId="destroyproduit",
     *     @OA\Parameter(
     *         name="produit",
     *         in="path",
     *         description="produit est l'Id du produit récherché",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     * 
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
     *     security={
     *         {"petstore_auth": {"write:produit", "read:produit"}}
     *     },
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
     *     path="/produit/search/nomProduit",
     *     tags={"produit"},
     *     summary=" Affiche Tous produits contenant le nom rechercher dans sa description ou libellé",
     *     operationId="search",
     *     @OA\Parameter(
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
     *                         type="string b",
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
       
        $produit=Produit::where('libelle','like','%'.$nom.'%')
                        ->orWhere('description','like','%'.$nom.'%')
                        ->get();

        return $produit;

        //
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


      /**
     * @OA\get(
     *     path="/produit/detailProduit/{produit}",
     *     tags={"produit"},
     *     summary="affiches les produits recherché ainsi que le detail de sa categorie",
     *     operationId="detailProduit",
     *     @OA\Parameter(
     *         name="produit",
     *         in="path",
     *         description="produit est l'Id du produit récherché",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
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
     *     security={
     *         {"petstore_auth": {"write:produit", "read:produit"}}
     *     },
     * )
     */
    public function detailProduit($id)
    {
       
        $produit=Produit::find($id);
        
        $categorie=Categorie::find($produit->idCategorie);  

        $produitDetaille=[
            "produit"=>$produit,
            "categorie"=>$categorie
        ];
        //dd($categorie);
        
       /* where('libelle','like','%'.$nom.'%')
                        ->orWhere('description','like','%'.$nom.'%')
                        ->get();*/

        return $produitDetaille;

        //
    }
}
