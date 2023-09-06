<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Categories</title>
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
                <div class="div_center">
                    <h2 style="margin-bottom: 2rem;">Add Category</h2>

                    <form action="{{ route('admin.categories.store') }}" method="POST" class="m-auto w-50">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control text-white" name="category_name"
                                placeholder="Enter new Category" aria-label="category" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" name="submit"
                                id="button-addon2">Create</button>
                        </div>
                    </form>
                </div>
                <table class="table table-dark table-hover w-75 m-auto rounded">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
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
