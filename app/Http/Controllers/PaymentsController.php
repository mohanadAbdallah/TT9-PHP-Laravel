<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\StripePayment;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Stripe\StripeClient;

class PaymentsController extends Controller
{
    public function create(StripePayment $stripePayment, Subscription $subscription): \Illuminate\Http\RedirectResponse
    {
        return $stripePayment->createCheckoutSession($subscription);
    }

    public function store(Request $request, Subscription $subscription)
    {

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $subscription->price * 100,
                'currency' => 'aed',
                // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            return [
                'clientSecret' => $paymentIntent->client_secret,
            ];

        } catch (Error $e) {
            return Response::json(['error' => $e->getMessage()]);
        }

    }

    public function success(): View
    {
        return view('thank-you');
    }

    public function cancel(): View
    {
        return view('payments.cancel');
    }
}
