<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Http\Response;

    class UserController extends Controller
    {

    /**
     * 
     * @OA\Get (
     *     path="/users",
     *     tags={"user"},
     *     summary="Affiche Tous utilisateurs se trouvant dans la base de données",  
     *     operationId="listUser",
     *  @OA\Response(
     *         response=200,
     *         description="success",
     *        
     *     )
     * )
     */

    public function listUser(){

        return User::all();
    }


  /**
     * 
     * @OA\POST (
     *     path="/user",
     *     tags={"user"},
     *     summary="Affiche Tous user se trouvant dans la base de données",  
     *
     *     operationId="register",
     *     
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         description="le nom de l'utilisateur",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="kofi"
     *         ),
     *     ),
     *  @OA\Parameter(
     *         name="email",
     *         in="path",
     *         description="le nom de l'utilisateur",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="peterkofi74@gmail.com"
     *         ),
     *     ),
     *  @OA\Parameter(
     *         name="password",
     *         in="path",
     *         description="le mot de passe de l'utilisateur",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="peter1234"
     *         ),
     *     ),
     * 
     *     @OA\Response(
     *         response=200,
     *         description="success"   
     *     ),
     * @OA\Response(
     *         response=401,
     *         description="veillez vous authentifiez",
     *     ),
     * )
     */


  
    public function register(Request $request){
        $valide = $request->validate([
            "name"=>"required|string",
            "email"=>"required|string|unique:users,email",
            "password"=>"required|string|confirmed",
        ]);

        $user= User::create([
            "name"=>$valide["name"],
            "email"=>$valide["email"],
            "password"=>bcrypt($valide["password"])
        ]);


        $token = $user->createToken('mallrdc')->plainTextToken;

        $response=[
            "user"=>$user,
            "token"=>$token
        ];

        return response($response,201);
    }

    /**
     * Add a new pet to the store.
     *
     * @OA\Post(
     *     path="/logout",
     *     tags={"user"},
     *     operationId="logout",
     *     @OA\Response(
     *         response=401,
     *         description="erreur lors de l'insertion"
     *     ),
 
     * )
     */

    public function logout(Request $request){
        auth()->user()->tokens()->delete();


        return [
            "message"=>"deconnecté"
        ];
    }

    public function login(Request $request){
        $valide = $request->validate([
            "email"=>"required|string",
            "password"=>"required|string",
        ]);

        $user= User::where("email", $valide["email"])->first();


        if(!$user || !Hash::check($valide["password"], $user->password)){
            return response([
                "message"=>"utilisateur invalid"
            ],401);
        }
        
        $token = $user->createToken('mallrdc')->plainTextToken;

        $response=[
            "user"=>$user,
            "token"=>$token
        ];

        return response($response,201);
    }

    //
}
