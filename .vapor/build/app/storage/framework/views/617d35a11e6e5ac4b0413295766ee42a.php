<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaykewalk | Register</title>

    <!-- Fav -->
    <link rel="icon" href="<?php echo e(asset('')); ?>assets/images/fav.png" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <!-- Icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="<?php echo e(asset('')); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo e(asset('')); ?>assets/css/app.css" rel="stylesheet">

    <!-- Page Init Js -->
    <script src="<?php echo e(asset('')); ?>assets/js/app.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body>
        
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('register', []);

$__html = app('livewire')->mount($__name, $__params, 'q3Qenr2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>  

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html><?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\auth\register.blade.php ENDPATH**/ ?>