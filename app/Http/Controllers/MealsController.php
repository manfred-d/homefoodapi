<?php

namespace App\Http\Controllers;

use App\Models\Meals;
use Illuminate\Http\Request;
use App\Http\Requests\MealsRequest;
use App\Http\Resources\MealsResource;


class MealsController extends Controller
{
    //get all meals
    public function index(){
        $meals = Meals::all();

        return MealsResource::collection($meals);
    }
    // GET
    // get a single meal
    public function getMeal(request $request, $id){
        $meal = Meals::find($id);

        if (!$meal) {
            return response()->json(['message'=>'Meal not found'],404);
        }
        return new MealsResource($meal);

    }

    // @POST
    // create a meal
    public function store(MealsRequest $request){
        $meals = Meals::create($request->all());
        
        return $meals;
    }
    // PUT
    // Edit a meal
    public function update(request $MealsRequest){

    }
    
    // POST
    // delete a meal
    public function destroy(MealsRequest $meals){
        return $meals::delete();
    }

}
