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
    <title>Restoran Başvuru Formu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .step-active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .step-completed {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        }
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
            animation: fadeIn 0.3s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <!-- Başlık -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Restoran Başvurusu</h1>
        <p class="text-gray-600">Restoranınızı sistemimize kaydetmek için bilgilerinizi doldurun</p>
    </div>


    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <div class="step-indicator step-active w-10 h-10 rounded-full flex items-center justify-center text-white font-bold" data-step="1">1</div>
                <div class="w-24 h-1 bg-gray-300 mx-2"></div>
            </div>
            <div class="flex items-center">
                <div class="step-indicator w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold" data-step="2">2</div>
                <div class="w-24 h-1 bg-gray-300 mx-2"></div>
            </div>
            <div class="flex items-center">
                <div class="step-indicator w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold" data-step="3">3</div>
                <div class="w-24 h-1 bg-gray-300 mx-2"></div>
            </div>
            <div class="flex items-center">
                <div class="step-indicator w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold" data-step="4">4</div>
                <div class="w-24 h-1 bg-gray-300 mx-2"></div>
            </div>
            <div class="step-indicator w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold" data-step="5">5</div>
        </div>
        <div class="flex justify-between text-sm text-gray-600">
            <span>Temel Bilgiler</span>
            <span>Adres</span>
            <span>Çalışma Saatleri</span>
            <span>İletişim</span>
            <span>Şifre</span>
        </div>
    </div>

    <!-- Form -->
    <form id="restaurantForm" class="bg-white rounded-2xl shadow-lg p-8" action="/handleRegister" method="POST">
        <input type="hidden" name="_token" value="<?= Security::getCsrfToken() ?>">
        <!-- Step 1: Restoran Adı ve Sloganı -->
        <div class="form-step active" data-step="1">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-store mr-3 text-purple-600"></i>Restoran Bilgileri
            </h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Restoran Adı *</label>
                    <input type="text" name="restoranAdi" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="Örn: Lezzet Dünyası" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Restoran Sloganı</label>
                    <input type="text" name="restoranSlogani" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="Örn: En lezzetli adresiniz">
                </div>
            </div>
        </div>

        <!-- Step 2: Restoran Adresi -->
        <div class="form-step" data-step="2">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-map-marker-alt mr-3 text-purple-600"></i>Adres Bilgileri
            </h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Adres *</label>
                    <textarea name="restoranAdresi" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" rows="3" placeholder="Tam adresinizi girin" required></textarea>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Şehir *</label>
                        <input name="restoranSehir" type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="İstanbul" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">İlçe *</label>
                        <input  name="restoranIlce"  type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="Kadıköy" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Çalışma Saatleri -->
        <div class="form-step" data-step="3">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-clock mr-3 text-purple-600"></i>Çalışma Saatleri
            </h2>
            <div class="space-y-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="flex items-center justify-between cursor-pointer">
                        <span class="font-semibold text-gray-700">Her gün aynı saatlerde çalışıyorum</span>
                        <input  name="restoranHerGun"  type="checkbox" id="sameHours" class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500">
                    </label>
                </div>
                <div id="hoursContainer">
                    <div class="flex items-center space-x-4 mb-4">
                        <label class="font-semibold text-gray-700 w-24">Pazartesi</label>
                        <input name="restoranGunPztStart" type="time" value="10:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                        <span class="text-gray-500">-</span>
                        <input  name="restoranGunPztEnd" type="time" value="23:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                    </div>
                    <div class="flex items-center space-x-4 mb-4">
                        <label class="font-semibold text-gray-700 w-24">Salı</label>
                        <input  name="restoranGunSalStart" type="time" value="10:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                        <span class="text-gray-500">-</span>
                        <input   name="restoranGunSalEnd" type="time" value="23:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                    </div>
                    <div class="flex items-center space-x-4 mb-4">
                        <label class="font-semibold text-gray-700 w-24">Çarşamba</label>
                        <input  name="restoranGunCarStart" type="time" value="10:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                        <span class="text-gray-500">-</span>
                        <input   name="restoranGunCarEnd"  type="time" value="23:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                    </div>
                    <div class="flex items-center space-x-4 mb-4">
                        <label class="font-semibold text-gray-700 w-24">Perşembe</label>
                        <input  name="restoranGunPerStart" type="time" value="10:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                        <span class="text-gray-500">-</span>
                        <input  name="restoranGunPerEnd"  type="time" value="23:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                    </div>
                    <div class="flex items-center space-x-4 mb-4">
                        <label class="font-semibold text-gray-700 w-24">Cuma</label>
                        <input   name="restoranGunCumStart" type="time" value="10:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                        <span class="text-gray-500">-</span>
                        <input  name="restoranGunCumEnd" type="time" value="23:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                    </div>
                    <div class="flex items-center space-x-4 mb-4">
                        <label class="font-semibold text-gray-700 w-24">Cumartesi</label>
                        <input   name="restoranGunCtesiStart" type="time" value="10:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                        <span class="text-gray-500">-</span>
                        <input  name="restoranGunCtesiEnd" type="time" value="23:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                    </div>
                    <div class="flex items-center space-x-4 mb-4">
                        <label class="font-semibold text-gray-700 w-24">Pazar</label>
                        <input   name="restoranGunPazStart" type="time" value="10:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                        <span class="text-gray-500">-</span>
                        <input  name="restoranGunPazEnd" type="time" value="23:00" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4: İletişim Bilgileri -->
        <div class="form-step" data-step="4">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-phone mr-3 text-purple-600"></i>İletişim Bilgileri
            </h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">E-posta Adresi *</label>
                    <input name="RestoranMail" type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="ornek@restoran.com" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Telefon Numarası *</label>
                    <input  name="RestoranTelefon" type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="0555 123 45 67" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Web Sitesi (Sistem Tarafından Atanacaktır)</label>
                    <input  name="RestoranWebsite" disabled type="url" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="https://www.restoranadi.com">
                </div>
            </div>
        </div>

        <!-- Step 5: Şifre Oluşturma -->
        <div class="form-step" data-step="5">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-lock mr-3 text-purple-600"></i>Hesap Güvenliği
            </h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Şifre *</label>
                    <div class="relative">
                        <input  name="RestoranSifre"  type="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="En az 8 karakter" required>
                        <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="mt-2">
                        <div class="flex items-center space-x-2 text-sm">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div id="passwordStrength" class="bg-red-500 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                            </div>
                            <span id="strengthText" class="text-gray-600">Zayıf</span>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Şifre Tekrarı *</label>
                    <div class="relative">
                        <input  name="RestoranSifreTekrar" type="password" id="confirmPassword" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" placeholder="Şifrenizi tekrar girin" required>
                        <button type="button" onclick="togglePassword('confirmPassword')" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p id="passwordMatch" class="mt-2 text-sm hidden"></p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <p class="text-sm text-blue-800">
                        <i class="fas fa-info-circle mr-2"></i>
                        Güçlü bir şifre için: En az 8 karakter, büyük harf, küçük harf, rakam ve özel karakter içermelidir.
                    </p>
                </div>
            </div>
        </div>

        <!-- Butonlar -->
        <div class="flex justify-between mt-8">
            <button type="button" id="prevBtn" onclick="changeStep(-1)" class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-400 transition duration-300 hidden">
                <i class="fas fa-arrow-left mr-2"></i>Geri
            </button>
            <div class="flex-1"></div>
            <button type="button" id="nextBtn" onclick="changeStep(1)" class="px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition duration-300">
                İleri<i class="fas fa-arrow-right ml-2"></i>
            </button>
            <button type="submit" id="submitBtn" class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition duration-300 hidden">
                <i class="fas fa-check mr-2"></i>Başvuruyu Tamamla
            </button>
        </div>
    </form>
</div>

<script>
    let currentStep = 1;
    const totalSteps = 5;

    function changeStep(direction) {
        const currentStepElement = document.querySelector(`.form-step[data-step="${currentStep}"]`);

        if (direction === 1 && !validateStep(currentStep)) {
            return;
        }

        currentStepElement.classList.remove('active');
        currentStep += direction;

        if (currentStep < 1) currentStep = 1;
        if (currentStep > totalSteps) currentStep = totalSteps;

        const newStepElement = document.querySelector(`.form-step[data-step="${currentStep}"]`);
        newStepElement.classList.add('active');

        updateStepIndicators();
        updateButtons();
    }

    function updateStepIndicators() {
        const indicators = document.querySelectorAll('.step-indicator');
        indicators.forEach((indicator, index) => {
            const step = index + 1;
            if (step < currentStep) {
                indicator.className = 'step-indicator step-completed w-10 h-10 rounded-full flex items-center justify-center text-white font-bold';
                indicator.innerHTML = '<i class="fas fa-check"></i>';
            } else if (step === currentStep) {
                indicator.className = 'step-indicator step-active w-10 h-10 rounded-full flex items-center justify-center text-white font-bold';
                indicator.textContent = step;
            } else {
                indicator.className = 'step-indicator w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold';
                indicator.textContent = step;
            }
        });
    }

    function updateButtons() {
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');

        prevBtn.classList.toggle('hidden', currentStep === 1);
        nextBtn.classList.toggle('hidden', currentStep === totalSteps);
        submitBtn.classList.toggle('hidden', currentStep !== totalSteps);
    }

    function validateStep(step) {
        const stepElement = document.querySelector(`.form-step[data-step="${step}"]`);
        const requiredFields = stepElement.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (step === 5) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                document.getElementById('passwordMatch').textContent = 'Şifreler eşleşmiyor!';
                document.getElementById('passwordMatch').className = 'mt-2 text-sm text-red-600';
                document.getElementById('passwordMatch').classList.remove('hidden');
                isValid = false;
            } else if (password === confirmPassword && password) {
                document.getElementById('passwordMatch').textContent = 'Şifreler eşleşiyor!';
                document.getElementById('passwordMatch').className = 'mt-2 text-sm text-green-600';
                document.getElementById('passwordMatch').classList.remove('hidden');
            }
        }

        return isValid;
    }

    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');

        if (field.type === 'password') {
            field.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            field.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }

    // Şifre gücü kontrolü
    document.getElementById('password').addEventListener('input', function(e) {
        const password = e.target.value;
        const strengthBar = document.getElementById('passwordStrength');
        const strengthText = document.getElementById('strengthText');

        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        const strengthPercent = (strength / 5) * 100;
        strengthBar.style.width = strengthPercent + '%';

        if (strength <= 2) {
            strengthBar.className = 'bg-red-500 h-2 rounded-full transition-all duration-300';
            strengthText.textContent = 'Zayıf';
            strengthText.className = 'text-red-600';
        } else if (strength <= 3) {
            strengthBar.className = 'bg-yellow-500 h-2 rounded-full transition-all duration-300';
            strengthText.textContent = 'Orta';
            strengthText.className = 'text-yellow-600';
        } else if (strength <= 4) {
            strengthBar.className = 'bg-blue-500 h-2 rounded-full transition-all duration-300';
            strengthText.textContent = 'İyi';
            strengthText.className = 'text-blue-600';
        } else {
            strengthBar.className = 'bg-green-500 h-2 rounded-full transition-all duration-300';
            strengthText.textContent = 'Güçlü';
            strengthText.className = 'text-green-600';
        }
    });

    // Form gönderimi
    document.getElementById('restaurantForm').addEventListener('submit', function(e) {
        // e.preventDefault();
        // if (validateStep(currentStep)) {
        //     alert('Başvurunuz başarıyla alındı! En kısa sürede size dönüş yapacağız.');
        //     Burada form verilerini gönderme işlemi yapılabilir
        // }
    });

    // Aynı saatler seçeneği
    document.getElementById('sameHours').addEventListener('change', function(e) {
        const hoursContainer = document.getElementById('hoursContainer');
        if (e.target.checked) {
            const firstInputs = hoursContainer.querySelectorAll('input[type="time"]');
            const openTime = firstInputs[0].value;
            const closeTime = firstInputs[1].value;

            hoursContainer.querySelectorAll('.flex').forEach((row, index) => {
                if (index > 0) {
                    row.querySelectorAll('input[type="time"]')[0].value = openTime;
                    row.querySelectorAll('input[type="time"]')[1].value = closeTime;
                }
            });
        }
    });
</script>
</body>
</html>