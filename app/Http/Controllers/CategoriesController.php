<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use App\Http\Resources\CategoriesResource;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cat = Categories::all();

        return CategoriesResource::collection($cat);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesRequest $request)
    {
        try {
            //code...
            $categories = Categories::create($request->validated());
            $categoryResource = new CategoriesResource($categories);

            return new JsonResponse([
                'category'=>$categoryResource
            ],201);

        } catch (Throwable $error) {
            throw $error;
            // throw new Exception("Error Processing Request", 1);
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriesRequest $request, Categories $categories,$id)
    {
        $cat = $categories::find($id);

        if (!$cat) {
            return response()->json(['message'=>'No category found'],404);
        }
        $cat->update($request->validated());

        return (new CategoriesResource($cat))->response()->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories,$id)
    {
        $cat = $categories::find($id);

        if (!$cat) {
            return response()->json(['message'=>'No category found'],404);
        }
        $cat->delete();

        return response()->json(['message'=>'Category deleted success'],200);
    }
}
