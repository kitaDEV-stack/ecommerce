<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Products</title>
    @include('backend.layouts.css')
</head>
<style>
    .div_center h2 {
        text-align: center;
        margin-bottom: 2rem;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
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
                <div class="div_center">
                    <h2>Add Products</h2>

                    <form class="m-auto w-50" action="{{ route('admin.products.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Product Title</label>
                            <input type="text" name="title" class="form-control text-white"
                                placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <input type="text" name="description" class="form-control text-white"
                                placeholder="Enter Description">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Product Quantity</label>
                            <input type="number" name="quantity" class="form-control text-white"
                                placeholder="Enter Quantity">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control text-white"
                                placeholder="Enter Price">
                        </div>
                        <div class="form-group">
                            <label for="dis_price">Discount Price</label>
                            <input type="number" name="discount_price" class="form-control text-white"
                                placeholder="Enter Price">
                        </div>
                        <div class="form-group">
                            <label for="categories">Example select</label>
                            <select class="form-control text-white" name="category">
                                <option selected disabled>Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Product Image</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Products</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- container-scroller -->
        @include('backend.layouts.script')
    </div>
</body>

</html>
