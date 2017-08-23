<?php

namespace App\Http\Controllers;
use App\User;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Product $product, Response $response, Request $request)
    {
        $this->user = $user;
        $this->product = $product;
        $this->response = $response;
        $this->request = $request;
    }

    public function list_users() {

        $response = [];
        $users = $this->user->with('products')->get();

        $statusCode = '200';
        $response = $users;

        return $this->response->setContent($response, $statusCode);
    }

    public function list_user() {
        $response = [];
        $users = $this->user->with('products')->where('key',  $this->request->key)->first();

        $statusCode = '200';
        $response = $users;

        return $this->response->setContent($response, $statusCode);
    }

    public function addproduct($product_id) {
        $response = [];
        $product = $this->product->find($product_id);
        $user = $this->user->where('key', $this->request->key)->first();

        $product->user_id = $user->id;
        $product->save();

        $statusCode = 200;
        $response = $product;

        return $this->response->setContent($response, $statusCode);
    }
    //

    public function deleteproduct($product_id)
    {
        $response = [];
        $product = $this->product->users()->dissociate();
        $user = $this->user->where('key', $this->request->key)->first();

        $product->save();
        
        $statusCode = 200;
        $response = $product;

        return $this->response->setContent($response, $statusCode);
    }
}
