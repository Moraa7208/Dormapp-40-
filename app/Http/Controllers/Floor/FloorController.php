<?php

namespace App\Http\Controllers\Floor;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('floors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $availableManagers = User::AvailableFloorManagers()->get();
        return view('floors.create', compact('availableManagers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $building = Building::where('manager_id', $user->id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'manager_id' => 'required|exists:users,id', // Ensure the selected manager exists
        ]);

        $floor = new Floor([
            'name' => $validated['name'],
            'manager_id' => $validated['manager_id'],
            'building_id' => $building->id,
        ]);

        $floor->save();
        return redirect()->route('floors.index', $building->id)->with('success', 'Floor added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Floor $floor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Floor $floor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Floor $floor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Floor $floor)
    {
        //
    }
}
