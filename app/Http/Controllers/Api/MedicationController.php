<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use App\Models\Medication;
use App\Models\User;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medications = Medication::all();
        return response()->json([
        'status' => true,
        'medications' => $medications
        ], 200);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Medication $medication
     * @return \Illuminate\Http\Response
     */
    public function show(Medication $medication)
    {
        // $medication = Medication::find($id);
        if (!$medication) {
            return response()->json([
            'error' => 'Medication not found'
            ], 404);
        }
        return response()->json([
        'method' => 'medication.show',
        'medication' => $medication
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('is-owner');

        $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'quantity' => 'required|integer',
        ]);

        $medication = Medication::create([
        'name' => $request->name,
        'generic_name' => $request->generic_name,
        'brand_name' => $request->brand_name,
        'description' => $request->description,
        'quantity' => $request->quantity,
        'expiry' => $request->expiry,
        ]);

        return response()->json([
        'message' => 'Medication created successfully', 
        'medication' => $medication
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medication $medication)
    {
        $this->authorize('update-medications');
        /**
         * do not use "form-data". 
         * please use "x-www-form-urlencoded" for sending data
         * */    
        $medication->update([
        'name' => ($request->name) ? $request->name : $medication->name,
        'description' => ($request->description) ? $request->description : $medication->description,
        'quantity' => ($request->quantity)? $request->quantity : $medication->quantity,
        'updated_at' => now(),
        ]);

        return response()->json([
        'message' => "Medication Updated successfully!",
        'request' => $request->post(),
        'medication' => $medication
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medication $medication)
    {
        $this->authorize('unpublish-medication');

        $medication->delete();
        return response()->json([
            'message' => "Medication Deleted successfully!",
        ], 200);
    }

    /**
     * Restore specified resource
     * @return \Illuminate\Http\Response
     */
    public function restore($medicationid) 
    {
        $this->authorize('restore-medication');

        Medication::where('id', $medicationid)->withTrashed()->restore();
        return response()->json([
        'status' => $medicationid,
        'message' => "Medication ID -s".$medicationid." restored.",
        ], 200);
    }

    /**
     * Permanantly delete specified resource
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($medicationid) 
    {
        $this->authorize('is-owner');
        Medication::where('id', $medicationid)->withTrashed()->forceDelete();
        return response()->json([
        'status' => $medicationid,
        'message' => "Medication ID -s".$medicationid." Deleted permanently!",
        ], 200);
    }
}
