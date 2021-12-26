<?php

namespace Modules\Auth\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Modules\Auth\Http\Requests\ApiAuth\Login\CreateLoginRequest;
use Modules\Auth\Http\Requests\ApiAuth\Registration\CreateRegistrationRequest;


/**
 * @OA\Info(
 *      version="3.0",
 *      title="CRM system module",
 *      description="Authorization, user registration.Adding an order to the system,viewing the list of orders,viewing an individual order."
 * ),
 *   @OA\SecurityScheme(
 *       scheme="Bearer",
 *       securityScheme="Bearer",
 *       type="http",
 *       in="header",
 *       name="Authorization",
 * ),
 */

/**
 * Registration or authorization of users
 * @package Modules\Auth\Http\Controllers\Api\V1
 * @OA\Tag(name="Auth")
 */

class AuthController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/v1/register",
     *   tags={"Auth"},
     *   summary="Register",
     *   operationId="register",
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad request(something wrong with URL or parameters)"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Logged in but access to requested area is forbidden"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity (validation failed)"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="General server error"
     *      )
     *)
     **/
    /**
     * Register api
     *
     *
     */

    public function register(CreateRegistrationRequest $request)
    {
        $validated = $request->validated();

        try {
            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);
            $token = $user->createToken('authToken')->plainTextToken;

            $response = [
                'user'  => $user,
                'token' => $token,
            ];
            return response($response,201);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            abort(500, 'Failed to register user');
        }

    }

    /**
     * @OA\Post(
     ** path="/api/v1/login",
     *   tags={"Auth"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad request(something wrong with URL or parameters)"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Logged in but access to requested area is forbidden"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity (validation failed)"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="General server error"
     *      )
     *)
     **/
    /**
     * login api
     *
     */
    public function login(CreateLoginRequest $request){

       $validated = $request->validated();

      $user = User::where('email',$validated['email'])->first();

      if(!$user || !Hash::check($validated['password'],$user->password)){
          return  response([ 'message' => 'Unauthenticated.'],401);
      }
      else{
          $token = $user->createToken('authTokenLogin')->plainTextToken;
          $response=[
              'user'=>$user,
              'token'=>$token,
          ];
          return response($response, 200);

      }

    }


    public function logout(){

        auth()->user()->tokens()->delete();

        return response(['message'=>'Logged out successfully!']);
    }
}
