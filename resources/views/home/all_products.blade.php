<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
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
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
</head>
<style>
    .box {
        box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.18);
        margin: 1.5rem
    }

</style>

<body>

    @include('sweetalert::alert')

    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
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

        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <img class="card-img-top" src="{{ asset("products_img/$product->image") }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @if ($product->discount_price != null)
                                <li class="list-group-item text-success">Discount Price: ${{ $product->discount_price }}
                                </li>
                                <li class="list-group-item" style="text-decoration: line-through;color:red;">
                                    Price: ${{ $product->price }}
                                </li>
                            @else
                                <li class="list-group-item">Price: ${{ $product->price }}</li>
                            @endif
                            <li class="list-group-item">Category: {{ $product->category }}</li>
                            <li class="list-group-item">Available Quantity: {{ $product->quantity }}</li>
                        </ul>
                        <div class="card-body">
                            <form action="{{ route('add_product', $product->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" name="quantity" value="1" min="1"
                                            style="width:100px">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="submit" name="submit" value="Add To Cart"
                                            class="btn btn-outline-success">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
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
