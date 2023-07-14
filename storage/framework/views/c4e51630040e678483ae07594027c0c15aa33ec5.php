<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.about_us')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.about_us')); ?></h1>
            </div>
        </div>
    </div>
    <section>
        <div class="container  text-justify mb-5">
            <?php if(@$getaboutus->about_content != ''): ?>
                <div class="cms-section">
                    <p>
                        <?php echo $getaboutus->about_content; ?>

                    </p>
                </div>
            <?php else: ?>
                <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Application\laragon\www\restaurant_management_system\resources\views/web/aboutus.blade.php ENDPATH**/ ?>