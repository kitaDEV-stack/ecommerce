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

<body>

    @include('sweetalert::alert')

    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <!-- slider section -->
        @include('home.slider')
        <!-- end slider section -->
    </div>
    <!-- why section -->
    @include('home.why')
    <!-- end why section -->

    <!-- arrival section -->
    @include('home.new_arrival')
    <!-- end arrival section -->

    <!-- product section -->
    @include('home.products')
    <!-- end product section -->

    {{-- comment section start --}}
    <section class="gradient-custom">
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="heading_container heading_center mb-5">
                                <h2>
                                    <span>Comments</span>
                                </h2>
                            </div>
                            <div style="text-align: center;padding-bottom: 30px;">
                                <form action="{{ route('add.comment') }}" method="POST">
                                    @csrf

                                    <textarea name="comment" style="height: 150px;width: 600px;text-transform:none;" placeholder="Comment Here"></textarea><br>

                                    <input type="submit" class="btn btn-outline-primary" value="Comment">
                                </form>
                            </div>
                            <div class="row">
                                <div class="col">
                                    @foreach ($comments as $comment)
                                        <div class="d-flex flex-start mb-5">
                                            <div class="flex-grow-1 flex-shrink-1">
                                                <div>
                                                    <p class="mb-2 font-weight-bold text-capitalize">
                                                        {{ $comment->name }} <span class="small">-
                                                            {{ $comment->created_at->diffForHumans() }}</span>
                                                    </p>
                                                    <p class="small mb-0">
                                                        {{ $comment->comment }}
                                                    </p>
                                                    <a href="javascript::void(0);" onclick="reply(this)"
                                                        data-Commentid="{{ $comment->id }}"><span
                                                            class="small text-danger"> Reply</span></a>
                                                </div>
                                                {{-- ?this is reply --}}
                                                @foreach ($replies as $rep)
                                                    @if ($rep->comment_id == $comment->id)
                                                        <div class="d-flex flex-start mt-4" style="padding-left: 50px;">
                                                            <div class="flex-grow-1 flex-shrink-1">
                                                                <div>
                                                                    <p class="mb-1 font-weight-bold">
                                                                        <span
                                                                            class="text-danger font-weight-normal">Replied
                                                                            by</span> {{ $rep->name }} <span
                                                                            class="small">-
                                                                            {{ $rep->created_at->diffForHumans() }}</span>
                                                                    </p>
                                                                    <p class="small mb-0">
                                                                        {{ $rep->reply }}
                                                                    </p>
                                                                    <a href="javascript::void(0);"
                                                                        onclick="reply(this)"><span
                                                                            class="small text-danger"> Reply</span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- ?Reply Box --}}
                            <div class="replyDiv pt-3" style="display:none;">
                                <form action="{{ route('add.reply') }}" method="POST">
                                    @csrf

                                    <input type="text" id="commentId" name="commentId" hidden>

                                    <textarea name="reply" style="height: 100px;width: 500px;text-transform:none;" placeholder="Reply"></textarea>

                                    <br>

                                    <button type="submit" class="btn btn-outline-danger">Reply</button>

                                    <a class="btn btn-outline-secondary" onclick="reply_close(this)">Close</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- comment section end --}}

    <!-- subscribe section -->
    @include('home.subscribe')
    <!-- end subscribe section -->
    <!-- client section -->
    @include('home.client')
    <!-- end client section -->
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>

    <script>
        function reply(caller) {

            document.getElementById('commentId').value = $(caller).attr('data-Commentid');

            $('.replyDiv').insertAfter($(caller));

            $('.replyDiv').show();

        }

        function reply_close(caller) {

            $('.replyDiv').hide();

        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>

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
