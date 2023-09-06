<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Products</title>
    @include('backend.layouts.css')
</head>
<style>
    .div_center {
        text-align: center;
        margin-bottom: 2rem;
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
            <div class="content-wrapper">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                    <h2 style="margin-bottom: 2rem;text-align:center;">Products Table</h2>
                <table class="table table-dark table-hover m-auto rounded">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Discount Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="text-center">
                                <td>{{ $product->title }}</td>
                                <td class="col-2">{{ $product->description }}</td>
                                <td>{{ $product->category }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td class="">{{ $product->discount_price }}</td>
                                <td><img src="{{ asset("products_img/$product->image") }}" class="rounded w-50 h-50"></td>
                                <td>
                                    <a href="{{route('admin.products.edit',$product->id)}}"><button type="button" class="btn btn-success">Edit</button></a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" onclick="return confirm('Are you sure want to delete this?')"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- container-scroller -->
        @include('backend.layouts.script')
    </div>
</body>

</html>
