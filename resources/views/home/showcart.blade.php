<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <base href="/public">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />

    <style>
        .total_deg{
            text-align: center;
            padding: 1.5rem;
            margin-top: 1.5rem;
            background:#343A40;
            color: #16de16;
            width: 50%;
        }
        .flex{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2;
        }
         .btn-gp a{
            display: block;
            margin: 1.5rem 0;
         }
    </style>
</head>

<body>

    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <div class="p-5">
            <div class="heading_container heading_center mb-5">
                <h2>
                   Your <span>Cart</span>
                </h2>
                @if (session('success'))
                      <div class="alert alert-success" role="alert">
                          {{ session('success') }}
                      </div>
                  @endif
             </div>
            <table class="table table-dark table-hover m-auto rounded">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Product Title</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $totalprice = 0; ?>

                    @foreach ($carts as $cart)
                        <tr class="text-center">
                            <td class="col-2">{{ $cart->product_title }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td style="color: #16de16;">${{ $cart->price }}</td>
                            <td><img src="{{ asset("products_img/$cart->image") }}" class="rounded w-25 h-25"></td>
                            <td>
                                <form action="{{ route('cart_remove', $cart->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php $totalprice += $cart->price; ?>
                    @endforeach
                </tbody>
            </table>
            <div class="flex">
                <h3 class="total_deg">Total Price : ${{ $totalprice }}</h3>
                <h3 style="color: #F7444E;">Proceed to Order</h3>
                <div class="btn-gp">
                    <a href="{{route('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>
                    <a href="{{route('stripe',$totalprice)}}"  class="btn btn-danger">Pay With Card</a>
                </div>
            </div>

        </div>



        <!-- jQery -->
        <script src="home/js/jquery-3.4.1.min.js"></script>
        <!-- popper js -->
        <script src="home/js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="home/js/bootstrap.js"></script>
        <!-- custom js -->
        <script src="home/js/custom.js"></script>
</body>

</html>
