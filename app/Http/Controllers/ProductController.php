<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Response $response, Product $product, Request $request, Storage $storage, User $user)
    {
        //
        $this->response = $response;
        $this->product = $product;
        $this->request = $request;
        $this->storage = $storage;
        $this->user = $user;
    }

    public function all() {
        $response = [];

        $product = $this->product->get();
        $statusCode = '200';
        $response = $product;

        return $this->response->setContent($response, $statusCode);
    }

    public function add(Request $request, Product $product) {
        $response = [];

        $name = $request['name'];
        $description = $request['description'];
        $price = $request['price'];
        $image = $request['image'];

        $this->validate($request, [
            'name' => 'unique:product',
            'description' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpeg,bmp,png',
        ]);

        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->image = $image . '.' . $image->getClientOriginalExtension();

        $disk = Storage::disk('local')->put('photos/' . $image . '.' . $image->getClientOriginalExtension(), file_get_contents($image));
 
        $statusCode = 200;
        $response = $product;

        $product->save();

        return $this->response->setContent($response, $statusCode);
    }

    public function update($id) {
        $updates = array($this->request['name'], $this->request['description'], $this->request['price'], $this->request['image']);

        $product = $this->product->find($id);

        var_dump($product->update([$updates]));
    }

    public function delete($id, Product $product) {
        $response = [];

        $product = $this->product->find($id);
        $user = $this->user->where('key', $this->request->key)->first();

        if ($product) {
            if ($user->id == $product->user_id) {
                Storage::delete('public/' . $product->image);
                $product->delete();
                $statusCode = '200';
                $response = ['Product removed.'];
            } else {
                $statusCode = 401;
                $response = ['User not authorized'];
            }
        } else {
            $statusCode = '404';
            $response = ['Product does not exist.'];
        }

        return $this->response->setContent($response, $statusCode);
    }

    public function get($id, Product $product) {
        $response = [];
        $product = $this->product->find($id);

        if ($product) {
            $statusCode = '200';
            $response = [$product];
        } else {
            $statusCode = '404';
            $response = ['Product does not exist.'];
        }

        return $this->response->setContent($response, $statusCode);

    }   


    //
}
