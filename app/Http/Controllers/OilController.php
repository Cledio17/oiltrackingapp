<?php

namespace App\Http\Controllers;

use App\Models\Oil;
use App\Models\User;
use App\Http\Requests\OilRequest;
use Illuminate\Support\Facades\Auth;

class OilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Retrieve oils belonging to the authenticated user, with their associated user information
        $oils = $user->oils()->with('user')->latest()->get();

        // Return a JSON response containing the oils
        return response([
            'oils' => $oils
        ], 200);
    }

    public function store(OilRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('oil_receipt')) {
            $file = $request->file('oil_receipt');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $filename);

            $user = Auth::user();

            $oil = new Oil([
                'oil_receipt' => $filename,
                'car_plate' => $validatedData['car_plate'],
                'location' => $validatedData['location'],
            ]);

            $user->oils()->save($oil);
        }

        return response()->json(['message' => 'success'], 201);
    }

    public function users()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    public function getOilReceiptsByUser($userId)
    {
        // Fetch oil receipts for the specified user ID
        $oilReceipts = Oil::where('user_id', $userId)->get();
        
        return response()->json(['oil_receipts' => $oilReceipts], 200);
    }
}
