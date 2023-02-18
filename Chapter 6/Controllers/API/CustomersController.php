<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;

class CustomersController extends Controller
{

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $credentials = request(['email', 'password']);
        $user = DB::table('customers')->select('id', 'customer_name', 'email', 'address', 'number')->where('email', $credentials['email'])->first();
        $user = DB::table('customers')->where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Email Atau Passwordnya salah!'], 401);
        }

        $token = Str::random(60);
        DB::table('customers')->where('id', $user->id)->update(['remember_token' => $token]);
        DB::table('customers')->where('email', $credentials['email'])->update(['remember_token' => $token]);

        return response()->json([
            'customer_id' => $user->id,
            'customer_name' => $user->customer_name,
            'email' => $user->email,
            'address' => $user->address,
            'number' => $user->number,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::now()->addDays(14)->toDateTimeString()
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required',
            'address' => 'required',
            'number' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = Customers::create($input);
        $success['token'] =  $user->createToken('Personal Access Token')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], 200);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Berhasil Logout!']);
    }

    public function updateProfile(Request $request, $id) {

    $validatedData = $request->validate([
        'customer_name' => 'required|string|max:255',
        'customer_optional' => 'nullable|string|max:255',
        'email' => 'required|string|email|max:255|unique:customers,email,' . $id,
        'password' => 'nullable|string|min:6|confirmed',
        'address' => 'required|string|max:255',
        'number' => 'required|string|max:255',
    ]);

    $data = [
        'customer_name' => $validatedData['customer_name'],
        'customer_optional' => $validatedData['customer_optional'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'address' => $validatedData['address'],
        'number' => $validatedData['number'],
    ];

    DB::table('customers')->where('id', $id)->update($data);

    return response()->json([
        'message' => 'Profile berhasil diperbarui',
    ]);

}

    public function getProfileById($customer_id){
    $user = DB::table('customers')->select('id', 'customer_name', 'email', 'password', 'address', 'number')->where('id', $customer_id)->first();

    return response()->json([
        'customer_id' => $user->id,
        'customer_name' => $user->customer_name,
        'email' => $user->email,
        'password' => $user->password,
        'address' => $user->address,
        'number' => $user->number,
    ]);
    }

}
