<?php
$title = $data['pageInfo']['title'] ??'Restoran QR Yazılımı';
$route = $data['pageInfo']['route'] ??'';



?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?> - Yönetim Paneli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="icon" href="/public/assets/img/qr-menu.png" type="image/png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .page { display: none; }
        .page.active { display: block; }
        .fade-in { animation: fadeIn 0.3s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .sidebar-item { transition: all 0.3s ease; }
        .sidebar-item:hover { transform: translateX(5px); }
        .card { transition: all 0.3s ease; }
        .card:hover { transform: translateY(-5px); }
        .color-picker { width: 50px; height: 50px; border: none; border-radius: 8px; cursor: pointer; }
        .notification-badge { animation: pulse 2s infinite; }
        @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .gradient-text { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .category-icon { font-size: 2rem; }
        .drag-over { background-color: #f3f4f6; border: 2px dashed #9ca3af; }
        .alert-banner { animation: slideDown 0.5s ease-out; }
        @keyframes slideDown { from { transform: translateY(-100%); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        #sidebar .active{
            -webkit-text-size-adjust: 100%; tab-size: 4; font-feature-settings: normal; font-variation-settings: normal; -webkit-tap-highlight-color: transparent; --fa-style-family-brands: "Font Awesome 6 Brands"; --fa-font-brands: normal 400 1em/1 "Font Awesome 6 Brands"; --fa-font-regular: normal 400 1em/1 "Font Awesome 6 Free"; --fa-style-family-classic: "Font Awesome 6 Free"; --fa-font-solid: normal 900 1em/1 "Font Awesome 6 Free"; font-family: 'Poppins', sans-serif; line-height: inherit; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; box-sizing: border-box; border-width: 0; border-style: solid; border-color: #e5e7eb; text-decoration: inherit; transition: all 0.3s ease; display: flex; align-items: center; border-radius: 0.5rem; padding: 0.75rem; transform: translateX(5px); --tw-bg-opacity: 1; background-color: rgb(250 245 255 / var(--tw-bg-opacity, 1)); --tw-text-opacity: 1; color: rgb(147 51 234 / var(--tw-text-opacity, 1));
        }
    </style>
</head>
<body class="bg-gray-100">
<!-- Alert Banner -->
<!--<div id="alertBanner" class="hidden fixed top-0 left-0 right-0 z-50 alert-banner">-->
<!--    <div class="bg-yellow-500 text-white px-4 py-3">-->
<!--        <div class="container mx-auto flex items-center justify-between">-->
<!--            <div class="flex items-center">-->
<!--                <i class="fas fa-exclamation-triangle mr-2"></i>-->
<!--                <span id="alertMessage">Önemli duyuru: Restoranımız 25 Aralık'ta kapalı olacaktır.</span>-->
<!--            </div>-->
<!--            <button onclick="closeAlertBanner()" class="text-white hover:text-gray-200">-->
<!--                <i class="fas fa-times"></i>-->
<!--            </button>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!-- Admin Header -->
<header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
    <div class="flex justify-between items-center px-4 py-3">
        <div class="flex items-center space-x-3">
            <button onclick="toggleSidebar()" class="text-gray-600 hover:text-gray-900 lg:hidden">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-xl font-bold text-gray-800">QR MENU Yönetimi</h1>
        </div>
        <div class="flex items-center space-x-4">
<!--            <button onclick="showNotifications()" class="relative text-gray-600 hover:text-gray-900">-->
<!--                <i class="fas fa-bell text-xl"></i>-->
<!--                <span class="notification-badge absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>-->
<!--            </button>-->
            <div class="flex items-center space-x-2">
                <img src="/public/assets/img/qr-menu.png" alt="Admin" class="w-8 h-8 rounded-full">
                <span class="text-sm font-medium text-gray-700 hidden sm:block">Yonetici</span>
            </div>
        </div>
    </div>
</header>

<div class="flex h-screen">
    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-white shadow-md fixed lg:relative h-full z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <nav class="p-4 space-y-2">
            <a href="/yonetim/dashboard" onclick="showPage('dashboard')" class="<?= $route == 'yonetim/dashboard' ? 'active':'' ?> sidebar-item flex items-center space-x-3 p-3 rounded-lg hover:bg-purple-50 text-gray-700 hover:text-purple-600">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span>Panel</span>
            </a>
            <a href="/yonetim/category" onclick="showPage('categories')" class="<?= $route == 'yonetim/category' ? 'active':'' ?> sidebar-item flex items-center space-x-3 p-3 rounded-lg hover:bg-purple-50 text-gray-700 hover:text-purple-600">
                <i class="fas fa-layer-group w-5"></i>
                <span>Kategoriler</span>
            </a>
            <a  href="/yonetim/menus" onclick="showPage('menu')" class="<?= $route == 'yonetim/menus' ? 'active':'' ?>  sidebar-item flex items-center space-x-3 p-3 rounded-lg hover:bg-purple-50 text-gray-700 hover:text-purple-600">
                <i class="fas fa-utensils w-5"></i>
                <span>Menü Yönetimi</span>
            </a>
            <a href="/yonetim/seller" onclick="showPage('store')" class="<?= $route == 'yonetim/seller' ? 'active':'' ?>   sidebar-item flex items-center space-x-3 p-3 rounded-lg hover:bg-purple-50 text-gray-700 hover:text-purple-600">
                <i class="fas fa-store w-5"></i>
                <span>Restoran Bilgileri</span>
            </a>

            <a href="/yonetim/feedback" onclick="showPage('feedback')" class="<?= $route == 'yonetim/feedback' ? 'active':'' ?> sidebar-item flex items-center space-x-3 p-3 rounded-lg hover:bg-purple-50 text-gray-700 hover:text-purple-600">
                <i class="fas fa-comment-dots w-5"></i>
                <span>Geri Bildirimler</span>
            </a>
            <a href="/yonetim/qrCode" onclick="showPage('qrCode')" class="<?= $route == 'yonetim/qrCode' ? 'active':'' ?> sidebar-item flex items-center space-x-3 p-3 rounded-lg hover:bg-purple-50 text-gray-700 hover:text-purple-600">
                <i class="fas fa-qrcode w-5"></i>
                <span>QR Kod Oluştur</span>
            </a>
            <a href="/yonetim/preview" onclick="showPage('preview')" class="<?= $route == 'yonetim/preview' ? 'active':'' ?> sidebar-item flex items-center space-x-3 p-3 rounded-lg hover:bg-purple-50 text-gray-700 hover:text-purple-600">
                <i class="fas fa-eye w-5"></i>
                <span>Restoranı Önizle</span>
            </a>
            <div class="pt-4 mt-4 border-t border-gray-200">
                <a href="/auth/logout" onclick="logout()" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg hover:bg-red-50 text-gray-700 hover:text-red-600">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Çıkış Yap</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto pb-10">











