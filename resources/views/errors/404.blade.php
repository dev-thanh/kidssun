@extends('errors::minimal')
@section('title', __('404 - Không tìm thấy'))
<main>
    <div class="mn-404-site">
        <div class="main-container">
            <article class="art-404">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="content-404">
                                <div class="box-404">
                                    <h1 class="title">
                                        <img src="{{ url('/') }}/uploads/images/title-404.png">
                                    </h1>
                                    <h3>Sory, page not found!</h3>
                                    <a href="{{ url('/') }}" title="Tìm hiểu thêm" class="btn btn-go-home">
                                        <span>Go home</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article> <!--end banners-->
        </div>
    </div>
</main>
    
