<?php
namespace Concrete\Package\CommunityStoreEventExample\Event;

use Log;
use Concrete\Package\CommunityStore\Src\CommunityStore\Cart\Cart as StoreCart;

class Cart
{
    public function cartAction($event) {
        Log::addInfo('An action has been preformed on the cart');
    }

    public function cartPreAdd($event) {
        $cartData = $event->getData();
        $product = $event->getProduct();

        // example of POST payload used to add cart item
        Log::addInfo('Before adding to a cart: ' . $product->getName() . ', cart data sent was' . print_r($cartData, true));
    }

    public function cartPostAdd($event) {
        $product = $event->getProduct();

        // example of fetching the number of items in the cart
        Log::addInfo('After adding to a cart: ' . $product->getName() . ', '.  StoreCart::getTotalItemsInCart() . ' in cart');
    }

    public function cartPreUpdate($event) {;
        $product = $event->getProduct();
        Log::addInfo('Before updating a cart: ' . $product->getName() . ' will be updated');
    }

    public function cartPostUpdate($event) {
        $product = $event->getProduct();
        Log::addInfo('After updating a cart: '  . $product->getName() . ' was updated');
    }

    public function cartPreRemove($event) {
        $product = $event->getProduct();
        Log::addInfo('Before removing from a cart: ' . $product->getName() . ' will be removed');
    }

    public function cartPostRemove($event) {
        $product = $event->getProduct();
        Log::addInfo('After removing from a cart: ' . $product->getName() . ' was removed');
    }

    public function cartPreClear($event) {
        $cart = StoreCart::getCart();

        $incart = [];

        // example of looping through cart and finding the names and quantities of products
        foreach ($cart as $k => $cartItem) {
            $incart[] = $cartItem['product']['object']->getName() . ' X ' . $cartItem['product']['qty'];
        }

        Log::addInfo('Before clearing a cart:' . ' cart data is ' . implode(', ', $incart) );
    }

    public function cartPostClear($event) {

        Log::addInfo('After clearing a cart: no items in cart');
    }

}
