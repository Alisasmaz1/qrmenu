<?php
// Kullanıcı giriş sayfası.
// layouts/header.php ve layouts/footer.php arasında çağrılacaktır.
use Core\Security; // CSRF token için Security sınıfını kullanıyoruz
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran Giriş</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .input-focus {
            transition: all 0.3s ease;
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
<div class="max-w-md w-full">
    <!-- Logo -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4">
            <i class="fas fa-utensils text-3xl text-purple-600"></i>
        </div>
        <h1 class="text-3xl font-bold text-white">Restoran Girişi</h1>
        <p class="text-purple-100 mt-2">Hesabınıza giriş yapın</p>
    </div>

    <!-- Giriş Formu -->
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <?php
        if (isset( $_SESSION['form_errors'] )){
            $errors =  $_SESSION['form_errors'] ;
        }
        if (isset($errors) && !empty($errors)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Hata!</strong>
                <span class="block sm:inline">
                    <?php foreach ($errors as $errorMsg): ?>
                        <?= htmlspecialchars($errorMsg) ?><br>
                    <?php endforeach; ?>
                </span>
            </div>
        <?php endif; ?>

        <form action="/auth/handleLogin" method="POST" class="space-y-6" name="restoranLogin" id="loginForm">
            <input type="hidden" name="_token" value="<?= Security::getCsrfToken() ?>">
            <!-- Email/Telefon Alanı -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">E-posta veya Telefon</label>
                <div class="relative">
                    <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                    <input name="username" type="text" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:border-purple-500" placeholder="ornek@restoran.com veya 0555 123 45 67" required>
                </div>
            </div>

            <!-- Şifre Alanı -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Şifre</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    <input name="password" type="password" id="password" class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:border-purple-500" placeholder="••••••••" required>
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Beni Hatırla ve Şifremi Unuttum -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input type="checkbox" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
                    <span class="ml-2 text-sm text-gray-600">Beni hatırla</span>
                </label>
<!--                <a href="#" class="text-sm text-purple-600 hover:text-purple-700 font-semibold">Şifremi unuttum?</a>-->
            </div>

            <!-- Giriş Butonu -->
            <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300 transform hover:scale-105">
                <i class="fas fa-sign-in-alt mr-2"></i>Giriş Yap
            </button>

            <!-- Veya Ayırıcı -->
<!--            <div class="flex items-center my-6">-->
<!--                <div class="flex-1 border-t border-gray-300"></div>-->
<!--                <span class="px-4 text-sm text-gray-500">veya</span>-->
<!--                <div class="flex-1 border-t border-gray-300"></div>-->
<!--            </div>-->
<!---->
<!--            <div class="space-y-3">-->
<!--                <button type="button" class="w-full bg-gray-100 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-200 transition duration-300">-->
<!--                    <i class="fab fa-google mr-2"></i>Google ile giriş yap-->
<!--                </button>-->
<!--                <button type="button" class="w-full bg-gray-100 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-200 transition duration-300">-->
<!--                    <i class="fab fa-facebook mr-2"></i>Facebook ile giriş yap-->
<!--                </button>-->
<!--            </div>-->
        </form>

        <!-- Kayıt Ol Linki -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Hesabınız yok mu?
                <a href="/register" class="text-purple-600 hover:text-purple-700 font-semibold">Yeni restoran oluşturun</a>
            </p>
        </div>
    </div>

    <!-- Alt Bilgi -->
    <div class="text-center mt-6">
        <p class="text-purple-100 text-sm">
            <i class="fas fa-shield-alt mr-1"></i>
            Güvenli bağlantı
        </p>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const icon = passwordField.nextElementSibling.querySelector('i');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            passwordField.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }

    document.getElementById('loginForm').addEventListener('submit', function(e) {
        // e.preventDefault();
        // Burada giriş işlemi yapılacak
        // alert('Giriş başarılı! Yönlendiriliyorsunuz...');
        // window.location.href = 'dashboard.html';
    });
</script>
</body>
</html>