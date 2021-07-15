@extends('frontend.layouts.app')
@push('styles')

@endpush
@section('content')

<div class="site-wrap">
    <!--? Hero Start -->
    <div class="slider-area2 overlay">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container align-self-end">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 pt-70">
                            <h2>Merchandises</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div
                    class="
                        col-lg-3 col-md-6 col-sm-8
                        order-2 order-lg-1
                        produts-sidebar-filter
                    "
                >
                    <div class="filter-widget">
                        <h4 class="fw-title">Categories</h4>
                        <ul class="filter-catagories">
                            <li><a href="#">Men</a></li>
                            <li><a href="#">Women</a></li>
                            <li><a href="#">Kids</a></li>
                        </ul>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Brand</h4>
                        <div class="fw-brand-check">
                            <div class="bc-item">
                                <label for="bc-calvin">
                                    Jersey
                                    <input type="checkbox" id="bc-calvin" />
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="bc-item">
                                <label for="bc-diesel">
                                    Trousers
                                    <input type="checkbox" id="bc-diesel" />
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="bc-item">
                                <label for="bc-polo">
                                    Shoes
                                    <input type="checkbox" id="bc-polo" />
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="bc-item">
                                <label for="bc-tommy">
                                    Accessories
                                    <input type="checkbox" id="bc-tommy" />
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="filter-widget">
                        <h4 class="fw-title">Tags</h4>
                        <div class="fw-tags">
                            <a href="#">Jersey</a>
                            <a href="#">Accessories</a>
                            <a href="#">Trousers</a>
                            <a href="#">Men's hats</a>
                            <a href="#">Backpack</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="select-option">
                                    <select class="sorting">
                                        <option value="">
                                            Default Sorting
                                        </option>
                                    </select>
                                    <select class="p-show">
                                        <option value="">Show:</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 text-right">
                                <p>Show 01- 09 Of 36 Product</p>
                            </div>
                        </div>
                    </div>
                    <div class="product-list">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img
                                            src="{{asset('frontend/images/football_player_PNG122.png')}}"
                                            alt=""
                                        />
                                        <!-- <div class="sale pp-sale">Sale</div> -->
                                        <div class="icon">
                                            <i class="icon_heart_alt"></i>
                                        </div>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">Jersey</div>
                                        <a href="#">
                                            <h5>Home Kit</h5>
                                        </a>
                                        <div class="product-price">$14.00</div>
                                        <button
                                            class="
                                                button
                                                rounded-3
                                                primary-bg
                                                text-white
                                                btn_1
                                                boxed-btn
                                                p-1
                                            "
                                            type="submit"
                                        >
                                            <i class="fas fa-shopping-cart"></i
                                            >Buy
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img
                                            src="{{asset('frontend/images/football_player_PNG122.png')}}"
                                            alt=""
                                        />
                                        <div class="icon">
                                            <i class="icon_heart_alt"></i>
                                        </div>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">Shoes</div>
                                        <a href="#">
                                            <h5>Red Boot</h5>
                                        </a>
                                        <div class="product-price">$13.00</div>
                                        <button
                                            class="
                                                button
                                                rounded-3
                                                primary-bg
                                                text-white
                                                btn_1
                                                boxed-btn
                                                p-1
                                            "
                                            type="submit"
                                        >
                                            <i class="fas fa-shopping-cart"></i
                                            >Buy
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img
                                            src="{{asset('frontend/images/football_player_PNG122.png')}}"
                                            alt=""
                                        />
                                        <div class="icon">
                                            <i class="icon_heart_alt"></i>
                                        </div>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">Shoes</div>
                                        <a href="#">
                                            <h5>Blue Boot</h5>
                                        </a>
                                        <div class="product-price">$34.00</div>
                                        <button
                                            class="
                                                button
                                                rounded-3
                                                primary-bg
                                                text-white
                                                btn_1
                                                boxed-btn
                                                p-1
                                            "
                                            type="submit"
                                        >
                                            <i class="fas fa-shopping-cart"></i
                                            >Buy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="loading-more">
                        <i class="icon_loading"></i>
                        <a href="#"> Loading More </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
</div>

@endsection
@push('scripts')

@endpush
