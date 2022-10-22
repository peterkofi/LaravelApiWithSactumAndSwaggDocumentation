<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  
     /**
     * 
     * @OA\Get (
     *     path="/Client",
     *     tags={"client"},
     *   summary="Affiche Tous Client se trouvant dans la base de données",  
     * @OA\Response(
     *         response=200,
     *         description="success",
     *         
     *     )
     * )
     */


    public function store(Request $request)
    {
        $request->validate([
            "nom" => 'required',
            "prenom" =>'required',
            "contact" =>'required',
            "Adresse"=> 'required'
        ]);

        return Client::create($request->all());
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return Client::find($id);
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

        $client = Client::find($id);
        $client->update($request->all());

        return $client;
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

       /**
     * @OA\Delete(
     *     path="/client/{client}",
     *     tags={"client"},
     *     summary="supprimes les client ayant Id specifier à l'argument",
     *     operationId="destroy",
     *     
     *     @OA\Parameter(
     *         name="client",
     *         in="path",
     *         description="client est l'Id du client récherché",
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
     *         description="client n'existe pas",
     *     ),
     *     security={
     *         {"petstore_auth": {"write:client", "read:client"}}
     *     },
     * )
     */

    public function destroy($id)
    {
        $client = Client::find($id);
        Client::destroy($client);
        //
    }
}
