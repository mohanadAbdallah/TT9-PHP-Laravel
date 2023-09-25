<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Subscription;
use Stripe\StripeClient;

class StripePayment
{
    public function createCheckoutSession(Subscription $subscription): \Illuminate\Http\RedirectResponse
    {
        $stripe = app()->make(StripeClient::class);

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $subscription->plan->name,
                    ],
                    'unit_amount' => $subscription->plan->price * 100,
                ],
                'quantity' => $subscription->expires_at->diffInMonths($subscription->created_at),
            ]],
            'mode' => 'payment',
            'client_reference_id' => $subscription->id,
            'metadata' => [
                'subscription_id' => $subscription->id
            ],
            'success_url' => route('payments.success', $subscription->id),
            'cancel_url' => route('payments.error', $subscription->id),
        ]);
        Payment::create([
            'user_id' => request()->user()->id,
            'subscription_id' => $subscription->id,
            'amount' => $subscription->price,
            'currency_code' => 'usd',
            'payment_gateway' => 'stripe',
            'gateway_reference_id' => $checkout_session->payment_intent,
            'data' => $checkout_session
        ]);
        return redirect()->away($checkout_session->url);

    }
}
