<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubscriptionPlanRequest;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptionPlans = SubscriptionPlan::all();
        return view('admin.subscription_plan', compact('subscriptionPlans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSubscriptionPlanRequest $request)
    {
        $data = $request->validated();

        $newPlan = new SubscriptionPlan();
        $newPlan->name = $data['name'];
        $newPlan->price = $data['price'];
        $newPlan->validity = $data['validity'];
        $newPlan->save();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription Plan  Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateSubscriptionPlanRequest $request, string $id)
    {

        $data = $request->validated();

        $subscriptionPlan = SubscriptionPlan::findOrFail($id);
        $subscriptionPlan->name = $data['name'];
        $subscriptionPlan->price = $data['price'];
        $subscriptionPlan->validity = $data['validity'];
        $subscriptionPlan->save();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription Plan Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscriptionPlan = SubscriptionPlan::findOrFail($id);
        $subscriptionPlan->delete();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription Plan Deleted successfully!');
    }
}
