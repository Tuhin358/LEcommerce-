@extends('user_template.layouts.template')
@section('main-content')

<div class="fashion_section">
    <div id="main_slider">
             <div class="container">
                <h1 class="fashion_taital">{{$category->category_name}} - ({{$category->product_count}})</h1>
                <div class="fashion_section_2">
                   <div class="row">

                     @foreach ($categories as $category)


                      <div class="col-lg-4 col-sm-4">
                         <div class="box_main">
                            <h4 class="shirt_text">{{$category->product_name  }}</h4>
                            <p class="price_text">Price: <span style="color: #262626;">&#2547;{{$category->price  }}</span></p>
                            <div class="tshirt_img"><img src="{{ asset($category->product_img) }}"></div>
                            <div class="btn_main">
                               <div class="buy_bt"><a href="#">Buy Now</a></div>
                               <div class="seemore_bt"><a href="{{ route('singleproduct',[$category->id,$category->slug]) }}">See More</a></div>
                            </div>
                         </div>
                      </div>
                      @endforeach


                   </div>
                </div>
             </div>
          </div>


@endsection
