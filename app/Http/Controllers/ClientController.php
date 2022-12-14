<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function CategoryPage($id){
        $category=Category::findOrFail($id);
        $categories=Product::where('product_category_id',$id)->latest()->get();
        return view('user_template.category',compact('category','categories'));
    }

    public function SingleProduct($id){
        $product=Product::findOrFail($id);
        $subcat_id=Product::where('id',$id)->value('product_subcategory_id');
        $related_products=Product::where('product_subcategory_id',$subcat_id)->latest()->get();

        return view('user_template.product',compact('product','related_products'));
    }

    public function AddToCart(){
        return view('user_template.addtocart');
    }

    public function Checkeout(){
        return view('user_template.checkout');
    }



    public function UserProfile(){
        return view('user_template.userprofile');
    }

    public function History(){
        return view('user_template.history');

    }
    public function PendingOrders(){
        return view('user_template.pendingorders');

    }



    public function NewRelease(){
        return view('user_template.newrelease');
    }

    public function TodaysDeal(){
        return view('user_template.todaysdeal');
    }

    public function CustomerService(){
        return view('user_template.customerservice');
    }


}
