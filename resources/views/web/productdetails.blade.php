@extends('web.layout.default')
@section('page_title')
    | {{ @$getitemdata->item_name }}
@endsection
@section('content')
    <section class="mt-5">
        <div class="container">
            <div class="item-details">
                @if (!empty($getitemdata))
                    <div class="row mb-4">
                        <div class="col-lg-5 col-md-5 col">
                            <div class="item-img-cover">
                                <div class="item-img show">
                                    @foreach ($getitemdata['item_images'] as $key => $firstimage)
                                        <img data-enlargable src="{{ $firstimage->image_url }}" alt="item-image"
                                            id="show-img">
                                        @php
                                            $image_name = $firstimage->image_name;
                                            if ($key == 0) {
                                                break;
                                            }
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                            @if (count($getitemdata['item_images']) > 1)
                                <div class="row gx-0 justify-content-center" dir="ltr">
                                    <div class="small-img">
                                        <img src="{{ Helper::web_image_path('nexticon.png') }}" class="icon-left"
                                            alt="" id="prev-img">
                                        <div class="small-container">
                                            <div id="small-img-roll">
                                                @foreach ($getitemdata['item_images'] as $key => $itemimage)
                                                    <img src="{{ $itemimage->image_url }}" class="show-small-img"
                                                        alt="">
                                                @endforeach
                                            </div>
                                        </div>
                                        <img src="{{ Helper::web_image_path('nexticon.png') }}" class="icon-right"
                                            alt="" id="next-img">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-7 col-md-7 col">
                            <div class="item-content">
                                <div class="item-heading">
                                    <div class="d-flex align-items-start">
                                        <img class="col-1" @if ($getitemdata->item_type == 1) src="{{ Helper::image_path('veg.svg') }}" @else src="{{ Helper::image_path('nonveg.svg') }}" @endif
                                            alt="">
                                        <span class="item-title col-11 {{ session()->get('direction') == 'rtl' ? 'me-2' : 'ms-2' }}">{{ $getitemdata->item_name }}</span>
                                    </div>
                                </div>
                                <div class="row justify-content-between mb-1">
                                    <div class="col-auto">
                                        <span
                                            class="green_color">{{ $getitemdata['category_info']->category_name }}</span>
                                    </div>
                                    <div class="col-auto">
                                        @if ($getitemdata->tax > 0)
                                            <span class="text-danger float-end">+ {{ $getitemdata->tax }}%
                                                {{ trans('labels.additional_taxes') }}</span>
                                        @else
                                            <span
                                                class="text-danger float-end">{{ trans('labels.inclusive_taxes') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row pb-2 mb-3 border-bottom align-items-center">
                                    @php
                                        if ($getitemdata->has_variation == 1) {
                                            foreach ($getitemdata['variation'] as $key => $value) {
                                                $price = $value->product_price;
                                                if ($key == 0) {
                                                    break;
                                                }
                                            }
                                        } else {
                                            $price = $getitemdata->price;
                                        }
                                    @endphp
                                    <p class="item-price item_price m-0">{{ Helper::currency_format($price) }}</p>
                                </div>
                                @if ($getitemdata->has_variation == 1 || $getitemdata->addons_id != '')
                                    <div class="row pb-3 mb-3 border-bottom">
                                        @if ($getitemdata->has_variation == 1)
                                            <div class="col-md-6 item-detail-wrapper" id="style-3">
                                                <div class="item-variation-list">
                                                    <h5 class="dark_color">{{ $getitemdata->attribute }}</h5>
                                                    @foreach ($getitemdata['variation'] as $key => $value)
                                                        <div class="form-check {{ session()->get('direction') == 'rtl' ? 'd-flex' : '' }}">
                                                            <input class="form-check-input cursor-pointer {{ session()->get('direction') == 'rtl' ? 'ms-0' : '' }}" type="radio"
                                                                data-variation-id="{{ $value->id }}"
                                                                data-variation-name="{{ $value->variation }}"
                                                                data-variation-price="{{ $value->product_price }}"
                                                                name="variation"
                                                                id="variation-{{ $key }}-{{ $value->id }}"
                                                                value="{{ $value->variation }}"
                                                                onchange="getvaraitions(this)"
                                                                {{ $key == 0 ? 'checked' : '' }}>
                                                            <label class="form-check-label cursor-pointer me-3"
                                                                for="variation-{{ $key }}-{{ $value->id }}">{{ $value->variation }}
                                                                :- <span
                                                                    class="text-muted">{{ Helper::currency_format($value->product_price) }}</span></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($getitemdata->addons) && count($getitemdata->addons) > 0)
                                            <div class="col-md-6 item-detail-wrapper" id="style-3">
                                                <div class="item-variation-list">
                                                    <h5 class="dark_color">{{ trans('labels.addons') }}</h5>
                                                    @foreach ($getitemdata->addons as $addonsdata)
                                                        <div class="form-check {{ session()->get('direction') == 'rtl' ? 'd-flex' : '' }}">
                                                            <input class="form-check-input cursor-pointer addons-checkbox {{ session()->get('direction') == 'rtl' ? 'ms-0' : '' }}"
                                                                type="checkbox" value="{{ $addonsdata->id }}'"
                                                                data-addons-id="{{ $addonsdata->id }}"
                                                                data-addons-price="{{ $addonsdata->price }}"
                                                                data-addons-name="{{ $addonsdata->name }}"
                                                                onclick="getaddons(this)"
                                                                id="addons{{ $addonsdata->id }}">
                                                            <label class="form-check-label cursor-pointer me-3"
                                                                for="addons{{ $addonsdata->id }}">{{ $addonsdata->name }}
                                                                : <span
                                                                    class="text-muted">{{ Helper::currency_format($addonsdata->price) }}</span></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <!-- <br> slug -->
                                <input type="hidden" name="slug" id="slug" value="{{ $getitemdata->slug }}">
                                <!-- <br> item_name -->
                                <input type="hidden" name="item_name" id="item_name"
                                    value="{{ $getitemdata->item_name }}">
                                <!-- <br> item_type -->
                                <input type="hidden" name="item_type" id="item_type"
                                    value="{{ $getitemdata->item_type }}">
                                <!-- <br> image_name -->
                                <input type="hidden" name="image_name" id="image_name" value="{{ $image_name }}">
                                <!-- <br> tax -->
                                <input type="hidden" name="tax" id="item_tax" value="{{ $getitemdata->tax }}">
                                <!-- <br> item_price -->
                                <input type="hidden" name="item_price" id="item_price" value="{{ $price }}">
                                <!-- <br> addonstotal -->
                                <input type="hidden" name="addonstotal" id="addonstotal" value="0">
                                <!-- <br> subtotal -->
                                <input type="hidden" name="subtotal" id="subtotal" value="{{ $price }}">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-md-6 col-sm-6 col-auto">
                                        @if (Auth::user() && Auth::user()->type == 2)
                                            <a class="btn btn-success btn-lg w-100 m-0 text-uppercase fs-6"
                                                onclick="addtocart('{{ URL::to('addtocart') }}')">{{ trans('labels.add_to_cart') }}</a>
                                        @else
                                            <a class="btn btn-success btn-lg w-100 m-0 text-uppercase fs-6"
                                                href="{{ URL::to('/login') }}">{{ trans('labels.add_to_cart') }}</a>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-auto">
                                        <div class="wishlist">
                                            @if ($getitemdata->is_favorite == 1)
                                                <a class="btn btn-lg w-100 wishlist-btn heart-red"
                                                    @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $getitemdata->id }}',0)" @else href="{{ URL::to('/login') }}" @endif>{{ trans('labels.remove_wishlist') }}
                                                </a>
                                            @else
                                                <a class="btn btn-lg w-100 wishlist-btn border-success"
                                                    @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $getitemdata->id }}',1)" @else href="{{ URL::to('/login') }}" @endif>{{ trans('labels.add_wishlist') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!empty($getitemdata->item_description))
                        <div class="row mt-2">
                            <div class="col-auto">
                                <div class="item-description">
                                    <h4>{{ trans('labels.description') }}</h4>
                                    <p class="text-justify">{!! $getitemdata->item_description !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    @include('web.nodata')
                @endif
            </div>
        </div>
    </section>
    <!-- RELATED PRODUCTS Section Start Here -->
    @if (count($getrelateditems) > 0)
        <section class="menu mt-3">
            <div class="container">
                <div class="row align-items-center justify-content-between my-2 px-2">
                    <div class="col-auto menu-heading">
                        <h1 class="text-capitalize">{{ trans('labels.related_items') }}</h1>
                    </div>
                    <div class="col-auto"><a
                            href="{{ URL::to('menu?category=' . $getitemdata['category_info']->slug) }}"
                            class="btn btn-sm btn-outline-primary">{{ trans('labels.view_all') }}</a></div>
                </div>
                <div class="row">
                    @foreach ($getrelateditems as $itemdata)
                        @include('web.itemview')
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- RELATED PRODUCTS Section End Here -->
@endsection
@section('scripts')
    <script src="{{ url('/storage/app/public/web-assets/js/item-image-carousel/main.js') }}"></script>
    <script src="{{ url('/storage/app/public/web-assets/js/item-image-carousel/zoom-image.js') }}"></script>
@endsection
