
<?php $__env->startSection('page_title'); ?>
    | <?php echo e(@$getitemdata->item_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="mt-5">
        <div class="container">
            <div class="item-details">
                <?php if(!empty($getitemdata)): ?>
                    <div class="row mb-4">
                        <div class="col-lg-5 col-md-5 col">
                            <div class="item-img-cover">
                                <div class="item-img show">
                                    <?php $__currentLoopData = $getitemdata['item_images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $firstimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img data-enlargable src="<?php echo e($firstimage->image_url); ?>" alt="item-image"
                                            id="show-img">
                                        <?php
                                            $image_name = $firstimage->image_name;
                                            if ($key == 0) {
                                                break;
                                            }
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <?php if(count($getitemdata['item_images']) > 1): ?>
                                <div class="row gx-0 justify-content-center" dir="ltr">
                                    <div class="small-img">
                                        <img src="<?php echo e(Helper::web_image_path('nexticon.png')); ?>" class="icon-left"
                                            alt="" id="prev-img">
                                        <div class="small-container">
                                            <div id="small-img-roll">
                                                <?php $__currentLoopData = $getitemdata['item_images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $itemimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <img src="<?php echo e($itemimage->image_url); ?>" class="show-small-img"
                                                        alt="">
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <img src="<?php echo e(Helper::web_image_path('nexticon.png')); ?>" class="icon-right"
                                            alt="" id="next-img">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-7 col-md-7 col">
                            <div class="item-content">
                                <div class="item-heading">
                                    <div class="d-flex align-items-start">
                                        <img class="col-1" <?php if($getitemdata->item_type == 1): ?> src="<?php echo e(Helper::image_path('veg.svg')); ?>" <?php else: ?> src="<?php echo e(Helper::image_path('nonveg.svg')); ?>" <?php endif; ?>
                                            alt="">
                                        <span class="item-title col-11 <?php echo e(session()->get('direction') == 'rtl' ? 'me-2' : 'ms-2'); ?>"><?php echo e($getitemdata->item_name); ?></span>
                                    </div>
                                </div>
                                <div class="row justify-content-between mb-1">
                                    <div class="col-auto">
                                        <span
                                            class="green_color"><?php echo e($getitemdata['category_info']->category_name); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <?php if($getitemdata->tax > 0): ?>
                                            <span class="text-danger float-end">+ <?php echo e($getitemdata->tax); ?>%
                                                <?php echo e(trans('labels.additional_taxes')); ?></span>
                                        <?php else: ?>
                                            <span
                                                class="text-danger float-end"><?php echo e(trans('labels.inclusive_taxes')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row pb-2 mb-3 border-bottom align-items-center">
                                    <?php
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
                                    ?>
                                    <p class="item-price item_price m-0"><?php echo e(Helper::currency_format($price)); ?></p>
                                </div>
                                <?php if($getitemdata->has_variation == 1 || $getitemdata->addons_id != ''): ?>
                                    <div class="row pb-3 mb-3 border-bottom">
                                        <?php if($getitemdata->has_variation == 1): ?>
                                            <div class="col-md-6 item-detail-wrapper" id="style-3">
                                                <div class="item-variation-list">
                                                    <h5 class="dark_color"><?php echo e($getitemdata->attribute); ?></h5>
                                                    <?php $__currentLoopData = $getitemdata['variation']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="form-check <?php echo e(session()->get('direction') == 'rtl' ? 'd-flex' : ''); ?>">
                                                            <input class="form-check-input cursor-pointer <?php echo e(session()->get('direction') == 'rtl' ? 'ms-0' : ''); ?>" type="radio"
                                                                data-variation-id="<?php echo e($value->id); ?>"
                                                                data-variation-name="<?php echo e($value->variation); ?>"
                                                                data-variation-price="<?php echo e($value->product_price); ?>"
                                                                name="variation"
                                                                id="variation-<?php echo e($key); ?>-<?php echo e($value->id); ?>"
                                                                value="<?php echo e($value->variation); ?>"
                                                                onchange="getvaraitions(this)"
                                                                <?php echo e($key == 0 ? 'checked' : ''); ?>>
                                                            <label class="form-check-label cursor-pointer me-3"
                                                                for="variation-<?php echo e($key); ?>-<?php echo e($value->id); ?>"><?php echo e($value->variation); ?>

                                                                :- <span
                                                                    class="text-muted"><?php echo e(Helper::currency_format($value->product_price)); ?></span></label>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(!empty($getitemdata->addons) && count($getitemdata->addons) > 0): ?>
                                            <div class="col-md-6 item-detail-wrapper" id="style-3">
                                                <div class="item-variation-list">
                                                    <h5 class="dark_color"><?php echo e(trans('labels.addons')); ?></h5>
                                                    <?php $__currentLoopData = $getitemdata->addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addonsdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="form-check <?php echo e(session()->get('direction') == 'rtl' ? 'd-flex' : ''); ?>">
                                                            <input class="form-check-input cursor-pointer addons-checkbox <?php echo e(session()->get('direction') == 'rtl' ? 'ms-0' : ''); ?>"
                                                                type="checkbox" value="<?php echo e($addonsdata->id); ?>'"
                                                                data-addons-id="<?php echo e($addonsdata->id); ?>"
                                                                data-addons-price="<?php echo e($addonsdata->price); ?>"
                                                                data-addons-name="<?php echo e($addonsdata->name); ?>"
                                                                onclick="getaddons(this)"
                                                                id="addons<?php echo e($addonsdata->id); ?>">
                                                            <label class="form-check-label cursor-pointer me-3"
                                                                for="addons<?php echo e($addonsdata->id); ?>"><?php echo e($addonsdata->name); ?>

                                                                : <span
                                                                    class="text-muted"><?php echo e(Helper::currency_format($addonsdata->price)); ?></span></label>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <!-- <br> slug -->
                                <input type="hidden" name="slug" id="slug" value="<?php echo e($getitemdata->slug); ?>">
                                <!-- <br> item_name -->
                                <input type="hidden" name="item_name" id="item_name"
                                    value="<?php echo e($getitemdata->item_name); ?>">
                                <!-- <br> item_type -->
                                <input type="hidden" name="item_type" id="item_type"
                                    value="<?php echo e($getitemdata->item_type); ?>">
                                <!-- <br> image_name -->
                                <input type="hidden" name="image_name" id="image_name" value="<?php echo e($image_name); ?>">
                                <!-- <br> tax -->
                                <input type="hidden" name="tax" id="item_tax" value="<?php echo e($getitemdata->tax); ?>">
                                <!-- <br> item_price -->
                                <input type="hidden" name="item_price" id="item_price" value="<?php echo e($price); ?>">
                                <!-- <br> addonstotal -->
                                <input type="hidden" name="addonstotal" id="addonstotal" value="0">
                                <!-- <br> subtotal -->
                                <input type="hidden" name="subtotal" id="subtotal" value="<?php echo e($price); ?>">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-md-6 col-sm-6 col-auto">
                                        <?php if(Auth::user() && Auth::user()->type == 2): ?>
                                            <a class="btn btn-success btn-lg w-100 m-0 text-uppercase fs-6"
                                                onclick="addtocart('<?php echo e(URL::to('addtocart')); ?>')"><?php echo e(trans('labels.add_to_cart')); ?></a>
                                        <?php else: ?>
                                            <a class="btn btn-success btn-lg w-100 m-0 text-uppercase fs-6"
                                                href="<?php echo e(URL::to('/login')); ?>"><?php echo e(trans('labels.add_to_cart')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-auto">
                                        <div class="wishlist">
                                            <?php if($getitemdata->is_favorite == 1): ?>
                                                <a class="btn btn-lg w-100 wishlist-btn heart-red"
                                                    <?php if(Auth::user() && Auth::user()->type == 2): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($getitemdata->id); ?>',0)" <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>><?php echo e(trans('labels.remove_wishlist')); ?>

                                                </a>
                                            <?php else: ?>
                                                <a class="btn btn-lg w-100 wishlist-btn border-success"
                                                    <?php if(Auth::user() && Auth::user()->type == 2): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($getitemdata->id); ?>',1)" <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>><?php echo e(trans('labels.add_wishlist')); ?>

                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($getitemdata->item_description)): ?>
                        <div class="row mt-2">
                            <div class="col-auto">
                                <div class="item-description">
                                    <h4><?php echo e(trans('labels.description')); ?></h4>
                                    <p class="text-justify"><?php echo $getitemdata->item_description; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- RELATED PRODUCTS Section Start Here -->
    <?php if(count($getrelateditems) > 0): ?>
        <section class="menu mt-3">
            <div class="container">
                <div class="row align-items-center justify-content-between my-2 px-2">
                    <div class="col-auto menu-heading">
                        <h1 class="text-capitalize"><?php echo e(trans('labels.related_items')); ?></h1>
                    </div>
                    <div class="col-auto"><a
                            href="<?php echo e(URL::to('menu?category=' . $getitemdata['category_info']->slug)); ?>"
                            class="btn btn-sm btn-outline-primary"><?php echo e(trans('labels.view_all')); ?></a></div>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $getrelateditems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- RELATED PRODUCTS Section End Here -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url('/storage/app/public/web-assets/js/item-image-carousel/main.js')); ?>"></script>
    <script src="<?php echo e(url('/storage/app/public/web-assets/js/item-image-carousel/zoom-image.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\resturant\resources\views/web/productdetails.blade.php ENDPATH**/ ?>