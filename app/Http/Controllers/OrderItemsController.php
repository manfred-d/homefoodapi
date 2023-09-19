<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use App\Http\Resources\OrderItemsResource;

class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $orderItem = OrderItems::all();
        return OrderItemsResource::collection(OrderItems::all());
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
    public function store(Request $request)
    {
        $request->validate([
            'Quantity'=>'required|numeric',
            'SubTotal'=>'required|numeric',
            'Order_Id'=>'required',
            'Meal_id'=>'required'
        ]);

        try {
            $orderItem = OrderItems::create($request->validated());

            return (new OrderItemsResource($orderItem))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception("Error Processing Request", 1);
            
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItems $orderItems,$id)
    {
        $orderItem = $orderItems->find($id);

        if (!$orderItem) {
            return response()->json(['message'=>'Item not found'],404);
        }
        
        return new OrderItemsResource($orderItem);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderItems $orderItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Quantity'=>'required|numeric',
            'SubTotal'=>'required|numeric',
            'Order_Id'=>'required',
            'Meal_id'=>'required'
        ]);

        try {
            $orderItem = OrderItem::findorFail($id);
            $orderItem = OrderItems::update($request->validated());

            return (new OrderItemsResource($orderItem))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception("Error Processing Request", 1);
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $orderItem = OrderItem::findorFail($id);
            $orderItem = OrderItems::delete();

            return response()->setStatusCode(201);
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception("Error Processing Request", 1);
            
        }
    }
}
