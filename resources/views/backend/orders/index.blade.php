<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Orders</title>
    @include('backend.layouts.css')
</head>
<style>
    .div_center {
        text-align: center;
        margin-bottom: 2rem;
    }

    .image .s-cale {
        object-fit: contain;
        transition: transform 1s ease 0s;
    }

    .image .s-cale:hover {
        transform: scale(5);
    }

    .no_res{
        color: #F7444E;
        text-align: center;
    }
</style>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('backend.layouts.side_bar')
        <!-- partial -->
        @include('backend.layouts.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper px-0">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <h2 style="margin-bottom: 2rem;text-align:center;">Order Table</h2>
                <form action="{{route('admin.search_order')}}" class="p-3" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input type="search" class="form-control text-white" name="search" placeholder="Search Order" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit"><span class="mdi mdi-magnify"></span></button>
                    </div>
                  </div>
                </form>
                <table class="table table-dark table-hover rounded">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Product title</th>
                            <th scope="col">Payment status</th>
                            <th scope="col">Delivery status</th>
                            <th scope="col">Delivered</th>
                            <th scope="col">PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="text-center">
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td class="image"><img src="{{ asset("products_img/$order->image") }}"
                                        class="rounded w-100 h-100 s-cale"></td>
                                <td>{{ $order->product_title }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->delivery_status }}</td>

                                @if ($order->delivery_status == 'processing')
                                    <td><a href="{{ route('admin.delivered', $order->id) }}"
                                            onclick="confirm('Are you sure this product is delivered?')"
                                            class="btn btn-outline-success">Delivered</a></td>
                                @else
                                    <td style="color:#16de16;">Delivered<span class="mdi mdi-check"></span></td>
                                @endif

                                <td><a href="{{route('admin.print_pdf',$order->id)}}"
                                    class="btn btn-outline-secondary">Print</a></td>
                            </tr>

                            @empty
                                <tr>
                                    <td colspan="16" class="no_res">No Result Found!</td>
                                </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- container-scroller -->
        @include('backend.layouts.script')
    </div>
</body>

</html>
