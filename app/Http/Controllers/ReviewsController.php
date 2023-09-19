<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewsRequest;
use App\Http\Resources\ReviewsResource;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review = Reviews::all();

        return ReviewsResource::collection($review);
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
    public function store(ReviewsRequest $request)
    {
        try {
            $review = Reviews::create($request->validated());

            return (new ReviewsResponse($review))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $review = Reviews::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }
        return new MealsResource($review);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reviews $reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewsRequest $request,$id)
    {
        $review = Reviews::find($id);

        if (!$review) {
            return response()->json(['message'=>'No review found'],404);
        }
        $review->update($request->validated());

        return (new ReviewsResource($review))->response()->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review = Reviews::find($id);

        if (!$review) {
            return response()->json(['message'=>'No review was found'],404);
        }
        $review->delete();

        return response()->setStatusCode(200);
    }
}
