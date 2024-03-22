<!doctype html>
<html class="no-js" lang="en" ng-app="apps">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign up - srtdash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body ng-controller="registerController">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area login-bg">
        <div class="container">
            <div class="login-box ptb--100">
                <form ng-submit="save()">
                    <div class="login-form-head">
                        <h4>Register</h4>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="nik">NIK</label>
                            <input type="text" id="nik" ng-model="model.nik">
                            <i class="ti-id-badge"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="nama">Nama lengkap</label>
                            <input type="text" id="nama" ng-model="model.nama">
                            <i class="ti-user"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="kontak">Telp/Hp</label>
                            <input type="text" id="kontak" ng-model="model.kontak">
                            <i class="ti-mobile"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="kontak_lain">Telp/Hp Lainnya</label>
                            <input type="text" id="kontak_lain" ng-model="model.kontak_lain">
                            <i class="ti-mobile"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" ng-model="model.alamat">
                            <i class="ti-home"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Registrasi <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Sudah punya akun? <a href="auth">Login</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>


    <script src="<?= base_url() ?>/libs/angular/angular.min.js"></script>
    <script src="<?= base_url() ?>/js/services/helper.services.js"></script>
    <script src="<?= base_url() ?>/js/services/pesan.services.js"></script>
    <script src="<?= base_url() ?>/libs/loading/dist/loadingoverlay.min.js"></script>
    <script src="<?= base_url() ?>/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <script>
        angular.module('apps', ['message.service', 'helper.service'])
            .controller("registerController", registerController);

        function registerController($scope, $http, pesan, helperServices) {
            $scope.model = {};
            $scope.map = false;
            
            $scope.save = () => {
                pesan.dialog("Yakin ingin melanjutkan", "Ya", "Tidak", "info").then(x => {
                    $http({
                        method: "post",
                        url: helperServices.url + "mustahik/post",
                        data: $scope.model,
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }).then(res => {
                        pesan.Success("Akun berhasil dibuat");
                        pesan.dialog("Proses berhasil", 'Ya', false, 'info').then(x => {
                            document.location.href = helperServices.url + "auth";
                        });
                    }, err => {
                        pesan.error(err.data.messages.error);
                    });
                });
            }
        }
    </script>
</body>

</html>