
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning">
                <i class="fa-regular fa-circle-exclamation"></i> <?php echo e(trans('labels.only_website')); ?>

            </div>
            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive" id="table-display">
                        <?php echo $__env->make('admin.slider.slidertable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(url('resources/views/admin/slider/slider.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\resturant\resources\views/admin/slider/slider.blade.php ENDPATH**/ ?>