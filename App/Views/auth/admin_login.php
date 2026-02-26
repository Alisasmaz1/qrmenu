<?php
// Kullanıcı giriş sayfası.
// layouts/header.php ve layouts/footer.php arasında çağrılacaktır.
use Core\Security; // CSRF token için Security sınıfını kullanıyoruz
?>
<!DOCTYPE html>
<html lang="tr-TR">
<head>
    <title>Yönetim Paneli Giriş</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="HidemYas">

    <!-- FontAwesome JS-->
    <script defer src="/public/assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="/public/assets/css/portal.css">

</head>

<body class="app app-login p-0">
<div class="row g-0 app-auth-wrapper">
    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
        <div class="d-flex flex-column align-content-end">
            <div class="app-auth-body mx-auto">

                <h2 class="auth-heading text-center mb-5">Panel'e Giriş Yap</h2>

                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="bg-danger text-light px-4 py-3 rounded relative mb-4" role="alert" style="color: #fff">
                        <strong class="font-bold">Hata!</strong>
                        <span class="block sm:inline">
                    <?php foreach ($errors as $errorMsg): ?>
                        <?= htmlspecialchars($errorMsg) ?><br>
                    <?php endforeach; ?>
                </span>
                    </div>
                <?php endif; ?>
                <div class="auth-form-container text-start">
                    <form class="auth-form login-form" action="/auth/handleLogin" method="POST">
                        <input type="hidden" name="_token" value="<?= Security::getCsrfToken() ?>">
                        <div class="email mb-3">
                            <label class="sr-only" for="signin-username">Email</label>
                            <input id="signin-username" name="username" type="text" class="form-control signin-email"
                                   placeholder="Kullanıcı Adınız" required="required">
                        </div><!--//form-group-->
                        <div class="password mb-3">
                            <label class="sr-only" for="signin-password">Şifre</label>
                            <input id="signin-password" name="password" type="password"
                                   class="form-control signin-password" placeholder="Şifreniz" required="required">
                            <div class="extra mt-3 row justify-content-between">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="RememberPassword">
                                        <label class="form-check-label" for="RememberPassword">
                                            Hatırla Beni
                                        </label>
                                    </div>
                                </div><!--//col-6-->

                            </div><!--//extra-->
                        </div><!--//form-group-->
                        <div class="text-center">
                            <button type="submit"  name="adminLogin" class="btn app-btn-primary w-100 theme-btn mx-auto">Giriş Yap</button>
                        </div>
                    </form>


                </div><!--//auth-form-container-->

            </div><!--//auth-body-->

            <footer class="app-auth-footer">
                <div class="container text-center py-3">
                    <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
                    <small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart"
                                                                                               style="color: #fb866a;"></i>
                        by <a class="app-link" href="http://hidemyas.org" target="_blank">HidemYas</a>
                        for developers</small>

                </div>
            </footer><!--//app-auth-footer-->
        </div><!--//flex-column-->
    </div><!--//auth-main-col-->
    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
        <div class="auth-background-holder">
        </div>
        <div class="auth-background-mask"></div>
        <div class="auth-background-overlay p-3 p-lg-5">
            <div class="d-flex flex-column align-content-end h-100">
                <div class="h-100"></div>
                <div class="overlay-content p-3 p-lg-4 rounded">
                    <h5 class="mb-3 overlay-title">Dijital Ürün Marketi için Geliştirilmiş Yönetim Paneli</h5>
                    <div>
                        Yazılımımızı kullandığınız için teşekkür ederiz . Güncel lisanslı ürünler almak için
                        <a
                                href="https://hidemyas.org">tıklayınız</a>.
                    </div>
                </div>
            </div>
        </div><!--//auth-background-overlay-->
    </div><!--//auth-background-col-->

</div><!--//row-->


</body>
</html>

