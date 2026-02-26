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
    <title><?= $restoranData['name']; ?></title>
    <link rel="icon" href="/public/assets/img/qr-menu.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .page { display: none; }
        .page.active { display: block; }
        .fade-in { animation: fadeIn 0.3s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .category-card { transition: all 0.3s ease; }
        .category-card:hover { transform: translateY(-5px); }
        .product-card { transition: all 0.3s ease; }
        .product-card:hover { transform: scale(1.02); }
        .notification-badge { animation: pulse 2s infinite; }
        @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .gradient-text { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="bg-gray-50">
<!-- Header -->
<header class="gradient-bg text-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <i class="fas fa-utensils text-2xl"></i>
                <h1 class="text-xl font-bold"><?= $restoranData['name']; ?></h1>
            </div>
            <div class="flex items-center space-x-4">
                <button onclick="toggleStoreInfo()" class="relative">
                    <i class="fas fa-info-circle text-xl"></i>
                    <span id="notificationBadge" class="notification-badge absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">!</span>
                </button>
                <button onclick="showPage('home')" class="text-white hover:text-gray-200 transition">
                    <i class="fas fa-home text-xl"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Store Info Modal -->
<div id="storeInfoModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 fade-in">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold gradient-text">Restoran Bilgileri</h2>
                <button onclick="toggleStoreInfo()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-store text-purple-600"></i>
                    <div>
                        <p class="font-semibold"><?= $restoranData['name']; ?></p>
                        <p class="text-sm text-gray-600"><?= $restoranData['slogan']; ?></p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-map-marker-alt text-purple-600"></i>
                    <p class="text-sm"><?= $restoranData['adres']; ?> <?= $restoranData['ilce']; ?>/<?= $restoranData['sehir']; ?></p>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-phone text-purple-600"></i>
                    <p class="text-sm"><?= $restoranData['phone']; ?></p>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="container mx-auto px-4 py-6">
    <!-- Home Page -->
    <div id="homePage" class="page active fade-in">
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Menü Kategorileri</h2>
            <p class="text-gray-600">Lezzetli seçeneklerimizi keşfedin</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Categories with real food images -->
            <?php foreach ($restoranCategories as $cat): ?>
                <div onclick="showCategory('cat<?=$cat['kategori_id']?>')" class="category-card bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer">
                <div class="h-40 relative">
                    <img src="<?=$cat['file_url']?>" alt="<?=$cat['kategori_adi']?>" class="w-full h-full object-contain">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-3 left-3 text-white">
                        <h3 class="font-bold text-lg"><?=$cat['kategori_adi']?></h3>
                        <p class="text-xs opacity-90"><?=$cat['urun_sayisi']?> Ürün</p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 flex justify-center space-x-4">
            <button onclick="showPage('feedback')" class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition transform hover:scale-105">
                <i class="fas fa-comment-dots mr-2"></i>Geri Bildirim
            </button>
        </div>
    </div>

    <!-- Category Detail Page -->
    <div id="categoryPage" class="page fade-in">
        <button onclick="showPage('home')" class="mb-4 text-purple-600 hover:text-purple-800 transition">
            <i class="fas fa-arrow-left mr-2"></i>Geri
        </button>
        <h2 id="categoryTitle" class="text-3xl font-bold text-gray-800 mb-6"></h2>
        <div id="categoryProducts" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Products will be loaded here -->
        </div>
    </div>

    <!-- Product Detail Page -->
    <div id="productPage" class="page fade-in">
        <button onclick="showCategory(currentCategory)" class="mb-4 text-purple-600 hover:text-purple-800 transition">
            <i class="fas fa-arrow-left mr-2"></i>Geri
        </button>
        <div id="productDetail" class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Product details will be loaded here -->
        </div>
    </div>

    <!-- Feedback Page -->
    <div id="feedbackPage" class="page fade-in">
        <button onclick="showPage('home')" class="mb-4 text-purple-600 hover:text-purple-800 transition">
            <i class="fas fa-arrow-left mr-2"></i>Geri
        </button>
        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Geri Bildirim</h2>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <form onsubmit="submitFeedback(event)">
                    <!-- Menu Rating -->
                    <div class="mb-6" id="menu-rating">
                        <label class="block text-gray-700 font-semibold mb-3">
                            <i class="fas fa-utensils mr-2 text-purple-600"></i>Menü Değerlendirmesi
                        </label>
                        <div class="flex space-x-2">
                            <button type="button" onclick="setRating('menu', 1)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('menu', 2)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('menu', 3)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('menu', 4)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('menu', 5)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Service Rating -->
                    <div class="mb-6" id="service-rating">
                        <label class="block text-gray-700 font-semibold mb-3">
                            <i class="fas fa-concierge-bell mr-2 text-purple-600"></i>Hizmet Değerlendirmesi
                        </label>
                        <div class="flex space-x-2">
                            <button type="button" onclick="setRating('service', 1)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('service', 2)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('service', 3)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('service', 4)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('service', 5)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Venue Rating -->
                    <div class="mb-6" id="venue-rating">
                        <label class="block text-gray-700 font-semibold mb-3">
                            <i class="fas fa-store mr-2 text-purple-600"></i>Mekan Değerlendirmesi
                        </label>
                        <div class="flex space-x-2">
                            <button type="button" onclick="setRating('venue', 1)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('venue', 2)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('venue', 3)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('venue', 4)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                            <button type="button" onclick="setRating('venue', 5)" class="rating-btn text-3xl text-gray-300 hover:text-yellow-400 transition">
                                <i class="fas fa-star"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Comment -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3">
                            <i class="fas fa-comment mr-2 text-purple-600"></i>Yorumunuz
                        </label>
                        <textarea id="feedbackComment" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Deneyiminizi bizimle paylaşın..."></textarea>
                    </div>

                    <!-- Name -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3">
                            <i class="fas fa-user mr-2 text-purple-600"></i>Adınız
                        </label>
                        <input type="text" id="feedbackName" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Adınız Soyadınız">
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition transform hover:scale-105">
                        <i class="fas fa-paper-plane mr-2"></i>Geri Bildirim Gönder
                    </button>
                </form>
            </div>

            <!-- Success Message -->
            <div id="successMessage" class="hidden mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i>Geri bildiriminiz için teşekkür ederiz!
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white mt-12 py-6">
    <div class="container mx-auto px-4 text-center">
        <p class="text-sm">© <?= date('Y') ?> <?= $restoranData['name']; ?> - Tüm hakları saklıdır</p>
        <p class="text-xs mt-2 text-gray-400">QR Menü Sistemi v1.0</p>
    </div>
</footer>

<script>
    const restoranID = <?= $restoranData['id']; ?>;
    // Sample data
    const menuData = <?= json_encode($restoranMenu); ?>;

    let currentCategory = '';
    let ratings = {
        menu: 0,
        service: 0,
        venue: 0
    };

    // Page navigation
    function showPage(pageId) {
        document.querySelectorAll('.page').forEach(page => {
            page.classList.remove('active');
        });
        document.getElementById(pageId + 'Page').classList.add('active');
    }

    // Show category
    function showCategory(categoryId) {
        currentCategory = categoryId;
        const category = menuData[categoryId];
        document.getElementById('categoryTitle').textContent = category.title;

        const productsHtml = category.products.map(product => `
                <div onclick="showProduct(${product.id})" class="product-card bg-white rounded-xl shadow-lg overflow-hidden cursor-pointer">
                    <img src="${product.image}" alt="${product.name}" class="w-full h-48 object-contain">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800">${product.name}</h3>
                        <p class="text-sm text-gray-600 mt-2">${product.description}</p>
                        <div class="mt-4">
                            <span class="text-2xl font-bold text-purple-600">₺${product.price}</span>
                        </div>
                    </div>
                </div>
            `).join('');

        document.getElementById('categoryProducts').innerHTML = productsHtml;
        showPage('category');
    }

    // Show product detail
    function showProduct(productId) {
        let product = null;
        for (let category in menuData) {
            product = menuData[category].products.find(p => p.id === productId);
            if (product) break;
        }

        if (product) {
            const productHtml = `
                    <img src="${product.image}" alt="${product.name}" class="w-full h-64 object-contain">
                    <div class="p-6">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">${product.name}</h2>
                        <p class="text-gray-600 mb-6 text-lg">${product.description}</p>
                        <div class="bg-purple-50 rounded-lg p-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-purple-600">₺${product.price}</span>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Fiyat bilgisi sadece bilgilendirme amaçlıdır
                                </span>
                            </div>
                        </div>
                        <div class="border-t pt-4">
                            <h3 class="font-semibold text-gray-700 mb-2">Ürün Hakkında</h3>
                            <p class="text-gray-600">Bu ürünümüz özel tarifimizle hazırlanmaktadır. Taze ve kaliteli malzemeler kullanılarak özenle pişirilir. Alerjen bilgisi için lütfen garsonumuzla görüşün.</p>
                        </div>
                    </div>
                `;
            document.getElementById('productDetail').innerHTML = productHtml;
            showPage('product');
        }
    }

    // Toggle store info modal
    function toggleStoreInfo() {
        const modal = document.getElementById('storeInfoModal');
        modal.classList.toggle('hidden');
    }

    // Set rating
    function setRating(type, value) {
        ratings[type] = value;
        const buttons = document.querySelectorAll(`#feedbackPage #${type}-rating .rating-btn`);
        buttons.forEach((btn, index) => {
            const btnType = btn.onclick.toString().match(/setRating\('(\w+)', (\d+)\)/);
            if (btnType && btnType[1] === type) {
                if (index < value) {
                    btn.classList.remove('text-gray-300');
                    btn.classList.add('text-yellow-400');
                } else {
                    btn.classList.remove('text-yellow-400');
                    btn.classList.add('text-gray-300');
                }
            }
        });
    }

    // Submit feedback
    function submitFeedback(event) {
        event.preventDefault();
        const comment = document.getElementById('feedbackComment').value;
        const name = document.getElementById('feedbackName').value;

        if (ratings.menu === 0 || ratings.service === 0 || ratings.venue === 0) {
            alert('Lütfen tüm alanları değerlendirin');
            return;
        }

        console.log(ratings,comment,name,restoranID);

        const formData = new FormData();
        formData.append('restoranID', restoranID);
        formData.append('customerName', name);
        formData.append('customerComment', comment);
        formData.append('customerMenuRating', ratings.menu);
        formData.append('customerServiceRating', ratings.service);
        formData.append('customerVenueRating', ratings.venue);
        formData.append('form_type', 'setCustomerFeedback');
        formData.append('_token', "<?= Security::getCsrfToken() ?>");

        // API isteği
        fetch('/restoran/api', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // Show success message
                document.getElementById('successMessage').classList.remove('hidden');

                // Reset form
                setTimeout(() => {
                    document.getElementById('feedbackComment').value = '';
                    document.getElementById('feedbackName').value = '';
                    ratings = { menu: 0, service: 0, venue: 0 };
                    document.querySelectorAll('.rating-btn').forEach(btn => {
                        btn.classList.remove('text-yellow-400');
                        btn.classList.add('text-gray-300');
                    });
                    document.getElementById('successMessage').classList.add('hidden');
                    showPage('home');
                }, 2000);
            })
            .catch(err => {
                console.error('Upload error:', err);
                console.log('Sunucuya bağlanırken hata oluştu!');
            });




    }

    // Check store status
    function checkStoreStatus() {
        const now = new Date();
        const hours = now.getHours();
        const statusElement = document.getElementById('storeStatus');

        if (hours >= 10 && hours < 23) {
            statusElement.textContent = 'Açık';
            statusElement.className = 'text-green-500 font-semibold mt-1';
        } else {
            statusElement.textContent = 'Kapalı';
            statusElement.className = 'text-red-500 font-semibold mt-1';
        }
    }

    // Initialize
    checkStoreStatus();
    setInterval(checkStoreStatus, 60000); // Check every minute
</script>
</body>
</html>