<?php

namespace App\Drivers;

use \Stripe\Stripe;

class StripePay
{

    private $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    public function createUpdateProduct($name = "", $description = "", $product_id = "")
    {
        $param = [
            'name' => $name,
            'description' => $description,
            'active' => true,
        ];

        if (!empty($product_id)) {
            $product = $this->stripe->products->update($product_id, $param);
        } else {
            $product = $this->stripe->products->create($param);
        }

        return $product;
    }

    public function createUpdatePlan($name = "", $amount = 0.00, $interval, $currency = 'usd', $description = "", $plan_id = "", $product_id = "")
    {
        $product = $this->createUpdateProduct($name, $description, $product_id);
        if (!empty($product)) {
            $params = [
                'amount' => ($amount * 100),
                'currency' => $currency,
                'interval' => $interval,
                'product' => $product->id,
            ];

            if (!empty($plan_id)) {
                $plan = $this->stripe->plans->update($plan_id, $params);
            } else {
                $plan = $this->stripe->plans->create($params);
            }

            return $plan;
        }

        return false;
    }

    public function deleteProductPlan($plan_id = "", $product_id = "")
    {
        if (!empty($plan_id)) {
            $plan = $this->stripe->plans->delete($plan_id, []);
            if (!empty($plan->deleted) && $plan->deleted == true) {
                if (!empty($product_id)) {
                    $product = $this->stripe->products->delete($product_id, []);
                    if (!empty($product_id->deleted) && $product_id->deleted == true) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
