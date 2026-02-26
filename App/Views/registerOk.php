<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Başvuru Başarılı - Restoran Yönetim Paneli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .success-animation {
            animation: successPulse 2s ease-in-out infinite;
        }
        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
<div class="max-w-2xl w-full">
    <!-- Ana Kart -->
    <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12 fade-in">
        <!-- Başarı İkonu -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-100 rounded-full success-animation mb-6">
                <i class="fas fa-check-circle text-5xl text-green-600"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Kayıt İşleminiz Yapıldı!</h1>
            <p class="text-xl text-gray-600">Artık hesabınıza girerek ürünlerini yüklerin.</p>
        </div>

        <!-- Başvuru Bilgileri -->
        <div class="bg-gray-50 rounded-xl p-6 mb-8 d-none" style="display: none">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-info-circle mr-2 text-purple-600"></i>
                Başvuru Detayları
            </h2>
            <div class="space-y-3">
                <div class="flex items-center">
                    <i class="fas fa-hashtag w-5 text-gray-500 mr-3"></i>
                    <span class="text-gray-600">Başvuru No:</span>
                    <span class="font-semibold text-gray-800 ml-2">#REST202500<?= $restoran['id'] ?></span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar w-5 text-gray-500 mr-3"></i>
                    <span class="text-gray-600">Başvuru Tarihi:</span>
                    <span class="font-semibold text-gray-800 ml-2"><?= date('d/m/y H:i') ?></span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock w-5 text-gray-500 mr-3"></i>
                    <span class="text-gray-600">İşlem Süresi:</span>
                    <span class="font-semibold text-gray-800 ml-2">1-3 İş Günü</span>
                </div>
            </div>
        </div>

        <!-- Sonraki Adımlar -->
        <div class="mb-8 d-none" style="display: none">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-tasks mr-2 text-purple-600"></i>
                Sonraki Adımlar
            </h2>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1">
                        <span class="text-purple-600 font-bold text-sm">1</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Değerlendirme Süreci</h3>
                        <p class="text-gray-600 text-sm">Başvurunuz ekibimiz tarafından incelenecektir.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1">
                        <span class="text-purple-600 font-bold text-sm">2</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Onay Bildirimi</h3>
                        <p class="text-gray-600 text-sm">Sonuçlar e-posta adresinize gönderilecektir.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1">
                        <span class="text-purple-600 font-bold text-sm">3</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Hesap Aktivasyonu</h3>
                        <p class="text-gray-600 text-sm">Onay sonrası hesabınız aktif edilecektir.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- İletişim Bilgileri -->
        <div class="bg-blue-50 rounded-xl p-6 mb-8 d-none" style="display: none">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-headset mr-2 text-blue-600"></i>
                Destek İçin
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="flex items-center">
                    <i class="fas fa-envelope w-5 text-blue-600 mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-600">E-posta</p>
                        <p class="font-semibold text-gray-800">destek@otomasyonlar.net</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-phone w-5 text-blue-600 mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-600">Telefon</p>
                        <p class="font-semibold text-gray-800">+90 510 220 75 50</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Butonlar -->
        <div class="flex flex-col sm:flex-row gap-4">
            <button onclick="window.location.href='/'" class="flex-1 bg-purple-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-purple-700 transition duration-300 transform hover:scale-105">
                <i class="fas fa-home mr-2"></i>Ana Sayfaya Dön
            </button>
            <button onclick="window.location.href='auth/login'" class="flex-1 bg-gray-200 text-gray-800 py-3 px-6 rounded-lg font-semibold hover:bg-gray-300 transition duration-300 transform hover:scale-105">
                <i class="fas fa-sign-in-alt mr-2"></i>Giriş Yap
            </button>
        </div>
    </div>

    <!-- Alt Bilgi -->
    <div class="text-center mt-8">
        <p class="text-purple-100">
            <i class="fas fa-heart mr-2"></i>
            Restoran Yönetim Paneli - Lezzetiniz Bizim İçin Önemli
        </p>
    </div>
</div>

<script>
    // Sayfa yüklendiğinde animasyon efekti
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('.fade-in');
        elements.forEach((el, index) => {
            setTimeout(() => {
                el.style.opacity = '1';
            }, index * 100);
        });
    });

    // Başvuru numarasını kopyalama fonksiyonu
    function copyApplicationNumber() {
        const applicationNumber = '#REST2024001';
        navigator.clipboard.writeText(applicationNumber).then(() => {
            // Kopyalama başarılı mesajı
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50';
            toast.innerHTML = '<i class="fas fa-check mr-2"></i>Başvuru numarası kopyalandı!';
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        });
    }

    // Başvuru numarasına tıklandığında kopyala
    document.addEventListener('click', function(e) {
        if (e.target.textContent.includes('#REST2024001')) {
            copyApplicationNumber();
        }
    });
</script>
</body>
</html>