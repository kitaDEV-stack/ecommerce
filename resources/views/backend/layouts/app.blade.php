<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    @include('backend.layouts.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('backend.layouts.side_bar')
      <!-- partial -->
      @include('backend.layouts.header')
        <!-- partial -->
        @include('backend.layouts.body')
    <!-- container-scroller -->
    @include('backend.layouts.script')
    </div>
  </body>
</html>