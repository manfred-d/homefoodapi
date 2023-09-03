<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Meals;
use Illuminate\Http\Request;
use App\Http\Requests\MealsRequest;
use App\Http\Resources\MealsResource;

class MealsController extends Controller
{
    //get all meals
    public function index()
    {
        $meals = Meals::all();

        return MealsResource::collection($meals);
    }
    // GET
    // get a single meal
    public function show(request $request, $id)
    {
        $meal = Meals::find($id);

        if (!$meal) {
            return response()->json(['message' => 'Meal not found'], 404);
        }
        return new MealsResource($meal);
    }

    // @POST
    // create a meal
    public function store(MealsRequest $request)
    {
        try {
            //code...
            $meal = Meals::create($request->validated());
            return (new MealsResource($meal))->response()->setStatusCode(201);
        } catch (\Throwable $error) {
            throw $error;
            // throw new Exception("Error Processing Request", 1);
            
        }

        
    }
    // PUT
    // Edit a meal
    public function update( MealsRequest $request,$id)
    {
         $meal = Meals::find($id);

        if (!$meal) {
            return response()->json(['message' => 'Meal not found'], 404);
        }

        $meal->update($request->validated());
        return (new MealsResource($meal))->response()->setStatusCode(201);
    }

    // POST
    // delete a meal
    public function destroy($id)
    {
        $meal = Meals::find($id);

        if (!$meal) {
            return response()->json(['message' => 'Meal not found'], 404);
        }
        $meal->delete();
        return response()->json(['message'=>'Meal deleted'],200);
    }
}
