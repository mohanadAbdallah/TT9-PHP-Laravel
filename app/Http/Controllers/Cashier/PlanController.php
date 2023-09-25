<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::get();

        return view("plans", compact("plans"));
    }

    public function show(Plan $plan)
    {
        $intent = auth()->user()->createSetupIntent();

        return view("subscription", compact("plan", "intent"));

    }

    public function subscriptions(Request $request): View
    {
        $plan = Plan::find($request->plan);

        $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)
            ->create($request->token);

        return view("subscription_success");
    }
}
