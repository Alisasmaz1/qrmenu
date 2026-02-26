<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran Yönetim Paneli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
<div class="max-w-4xl w-full">
    <!-- Logo ve Başlık -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-lg mb-6">
            <i class="fas fa-utensils text-4xl text-purple-600"></i>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Restoran Yönetim Paneli</h1>
        <p class="text-xl text-purple-100">Restoranınızı kolayca yönetin</p>
    </div>

    <!-- Seçenek Kartları -->
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Giriş Yap Kartı -->
        <div class="card-hover bg-white rounded-2xl shadow-xl p-8 cursor-pointer" onclick="window.location.href='auth/login'">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-purple-100 rounded-full mb-6">
                    <i class="fas fa-sign-in-alt text-3xl text-purple-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Giriş Yap</h2>
                <p class="text-gray-600 mb-6">Mevcut restoran hesabınıza giriş yapın</p>
                <button class="bg-purple-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-purple-700 transition duration-300">
                    Giriş Yap <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Yeni Restoran Oluştur Kartı -->
        <div class="card-hover bg-white rounded-2xl shadow-xl p-8 cursor-pointer" onclick="window.location.href='register'">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
                    <i class="fas fa-plus-circle text-3xl text-green-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Yeni Restoran Oluştur</h2>
                <p class="text-gray-600 mb-6">Yeni restoranınız için hesap oluşturun</p>
                <button class="bg-green-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-green-700 transition duration-300">
                    Başvur <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Alt Bilgi -->
    <div class="text-center mt-12">
        <p class="text-purple-100">
            <i class="fas fa-shield-alt mr-2"></i>
            Güvenli ve hızlı kayıt sistemi
        </p>
    </div>
</div>
</body>
</html>