<?php

namespace App\Http\Controllers;

use App\Models\Chefs;
use Illuminate\Http\Request;
use App\Http\Requests\ChefsRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ChefsResource;

class ChefsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chef = Chefs::all();

        return ChefsResource::collection($chef);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showAverageRatings(ChefsRequest $request,$cook_id)
    {
        $averageRating = DB::table('reviews')->where('cook_id',$cook_id)->avg('Rating');

        $cook = Chefs::findorFail($cook_id);

        $cookData = DB::table('chefs')->where('id',$cook_id)->first();

        // $cook->update(['Ratings'=>$averageRatings]);

        return $averageRating;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChefsRequest $request)
    {
        try {
            // $request['User_Id'] = Auth::user()->$id;
            $cook = Chefs::create($request->toArray());

            return (new ChefsResource($cook))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cook = Chefs::find($id);
        if (!$cook) {
            return response()->json(['message'=>'Cook not found'], 404);
        }
        return new ChefsResource($cook);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chefs $chefs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChefsRequest $request, $id)
    {
        
        try {
            $cook = Chefs::find($id);
            if (!$cook) {
                return response()->json(['message'=>'Cook not found'], 404);
            }
            $cook->update($request->validated());

            return (new ChefsResource($cook))->response()->setStatusCode(201);
            
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cook = Chefs::find($id);
            if (!$cook) {
                return response()->json(['message'=>'Cook not found'], 404);
            }
            $cook->delete();

            return (new ChefsResource($cook))->response()->setStatusCode(201);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
