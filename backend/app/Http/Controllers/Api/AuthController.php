<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Login
     */
    public function login(Request $request) {
        $phone = $request['phone'];
        $password = $request['password'];

        $credentials = ['phone' => $phone, 'password' => $password];

        if (!$token = auth()->attempt($credentials)) {

            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function respondWithToken($token) {
        return response()->json([
            'id' => auth()->id(),
            'name' => auth()->user()->name,
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 6000,
        ]);
    }

    /**
     * Logout
     */
    public function logout() {

        if (Auth::check()) {
            Auth::logout();
        }

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function changePassword(Request $request) {
        $id = $request->id;
        $user = User::where('id', '=', $id)->first();
        $user->password = $request->newPassword;
        $user->save();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json($user, 200);
    }

    /**
     * Display the specified resource.
     */
    public function getInfoUser(Request $request)
    {
        $user = User::where('id', '=', $request->id)->first();
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::where('id', '=', $request->id)->first();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        // $user->status = $request->status;
        $user->email = $request->email;
        $user->image = $request->image;
        $user->save();
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
