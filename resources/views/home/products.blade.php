<section class="product_section layout_padding" id="products">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
          @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
       </div>
       <form action="{{route('search.product')}}" class="p-3" method="GET">
         @csrf
         <div class="input-group mb-3">
             <input type="search" class="form-control text-lowercase" name="search" placeholder="Search Order" aria-describedby="basic-addon2">
             <div class="input-group-append">
               <button class="btn btn-outline-danger" type="submit">Search</button>
             </div>
           </div>
         </form>
       <div class="row">
         @foreach ($products as $product)
         <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box">
               <div class="option_container">
                  <div class="options">
                     <a href="{{route('product.show',$product->id)}}" class="option1">
                     Product's Details
                     </a>
                    <form action="{{route('add_product',$product->id)}}" method="POST">
                     @csrf
                     <div class="row">
                        <div class="col-md-4">
                           <input type="number" name="quantity" value="1" min="1" style="width:100px">
                        </div>
                        <div class="col-md-4">
                           <input type="submit" name="submit" value="Add To Cart" class="option2">
                        </div>
                     </div>
                  </form>
                  </div>
               </div>
               <div class="img-box">
                  <img src="{{asset("products_img/$product->image")}}" alt="">
               </div>
               <div class="detail-box">
                  <h5>
                     {{$product->title}}
                  </h5>
                  @if ($product->discount_price!=null)     
                  <h6>
                    ${{$product->discount_price}}
                  </h6>
                  <h6 style="text-decoration: line-through;color:red;">
                    ${{$product->price}}
                  </h6>
                  @else
                  <h6>
                    ${{$product->price}}
                  </h6>
                  @endif
               </div>
            </div>
         </div>
         @endforeach
         <nav aria-label="Page navigation example">
            <ul class="pagination pt-3">
             
              <li class="page-item">{{$products->withQueryString()->links('pagination::bootstrap-4')}}</li>
             
            </ul>
          </nav>
       </div>
    </div>
 </section>