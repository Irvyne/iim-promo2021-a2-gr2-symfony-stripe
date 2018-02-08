<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class StripeController extends Controller
{
    /**
     * @Route("/", name="stripe")
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('stripe.html.twig');
    }

    /**
     * @Route("/charge", name="stripe_charge")
     */
    public function charge()
    {
        \Stripe\Stripe::setApiKey($this->getParameter('stripe_sk'));

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        // Charge the user's card:
        $charge = \Stripe\Charge::create([
            "amount"      => 999,
            "currency"    => "eur",
            "description" => "Example charge",
            "source"      => $token,
        ]);

        // replace this line with your own code!
        return $this->render('stripe_charge.html.twig', [
            'charge' => $charge,
        ]);
    }
}
