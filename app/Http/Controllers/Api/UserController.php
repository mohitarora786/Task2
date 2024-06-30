<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
            'pincode' => ['required', 'digits:6'],
            'contact' => ['required', 'numeric'],
            'address' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'pincode' => $request->pincode,
                'contact' => $request->contact,
                'address' => $request->address
            ];

            DB::beginTransaction();

            try {
                User::create($data);
                DB::commit();
                return response()->json(['message' => 'User created successfully'], 201);
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error($e->getMessage());
                return response()->json(['error' => 'Internal Server Error'], 500);
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json(['message' => 'Login successful', 'user' => $user]);
    }

    public function index()
    {
        // Implement index logic here
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implement create logic here
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implement show logic here
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Implement edit logic here
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Implement update logic here
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Implement destroy logic here
    }
}
