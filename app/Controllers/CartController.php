<?php

namespace App\Controllers;

class CartController extends Controller {

    public function view() {
        return view("cart");
    }

    public function add() {
        // add cart item
    }

    public function remove() {
        // delete cart item
    }

    public function increment() {
        // increase qty of cart item
    }

    public function decrement() {
        // reduce qty of cart item
    }

    public function content() {
        // cart items
    }

    public function total() {
        // shipping, subtotal, total
    }

}