<div wire:ignore x-data x-init="document.addEventListener('DOMContentLoaded', function() {

    const pond = FilePond.create($refs.input, {
        allowMultiple: <?php echo e(isset($attributes['multiple']) ? 'true' : 'false'); ?>,
        server: {
            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').upload('<?php echo e($attributes['wire:model']); ?>', file, load, error, progress)
            },
            revert: (filename, load) => {
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').removeUpload('<?php echo e($attributes['wire:model']); ?>', filename, load)
            },
        },
    });
    this.addEventListener('pondReset', e => {
        pond.removeFiles();
    });

});">
    <input type="file" x-ref="input" <?php echo isset($attributes['accept']) ? 'accept="' . $attributes['accept'] . '"' : ''; ?>>
</div><?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\components\livewire-filepond.blade.php ENDPATH**/ ?>