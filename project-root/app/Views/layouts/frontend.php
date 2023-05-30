<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />


    <title> Hillas Developer - Code Ignitter</title>
</head>

<body>
    <div class="app">
        <?= $this->include('layouts/inc/navbar.php') ?>
        <?= $this->renderSection('content') ?>
    </div>


    <script src="<?= base_url('assets/js/jquery-3.7.0.js'); ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>

    <!-- Alertify -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php if (session()->getFlashdata('status')) { ?>
                alertify.set('notifier', 'position', 'top-right');
                alertify.success("<?= session()->getFlashdata('status') ?>");
            <?php } ?>
        });
    </script>



    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>