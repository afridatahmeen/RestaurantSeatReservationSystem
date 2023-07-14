
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 float-end">
                    <form action="<?php echo e(URL::to('admin/item')); ?>">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control rounded" name="search" <?php if(isset($_GET['search'])): ?> value="<?php echo e($_GET['search']); ?>" <?php endif; ?> placeholder="<?php echo e(trans('labels.type_and_enter')); ?>" aria-label="<?php echo e(trans('labels.type_and_enter')); ?>" aria-describedby="basic-addon2">
                            <div class="input-group-append px-1">
                                <button class="btn btn-outline-secondary rounded" type="submit"><?php echo e(trans('labels.fetch')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="table-responsive" id="table-display">
                            <?php echo $__env->make('admin.item.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('resources/views/admin/item/additem.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\resturant\resources\views/admin/item/item.blade.php ENDPATH**/ ?>