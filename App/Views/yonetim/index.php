<?php $metrik = $data['restoranMetrikler'];
$statics = $data['restoranStatics'][0];
?>
<!-- Dashboard Page -->
<div id="dashboardPage" class="page active fade-in p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Panel</h2>
        <p class="text-gray-600">Restoranınızın genel durumu</p>
    </div>


    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                    <i class="fas fa-layer-group text-xl"></i>
                </div>
                <span class="text-sm text-gray-500">Toplam</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= $metrik['toplam_kategori'] ?></h3>
            <p class="text-gray-600 text-sm">Kategori</p>
        </div>

        <div class="card bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-green-100 text-green-600 p-3 rounded-lg">
                    <i class="fas fa-hamburger text-xl"></i>
                </div>
                <span class="text-sm text-gray-500">Toplam</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= $metrik['toplam_urun'] ?></h3>
            <p class="text-gray-600 text-sm">Ürün</p>
        </div>

        <div class="card bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-purple-100 text-purple-600 p-3 rounded-lg">
                    <i class="fas fa-comment-dots text-xl"></i>
                </div>
                <span class="text-sm text-gray-500">Bu Hafta</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= $metrik['haftalik_geri_bildirim'] ?></h3>
            <p class="text-gray-600 text-sm">Geri Bildirim</p>
        </div>

        <div class="card bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-orange-100 text-orange-600 p-3 rounded-lg">
                    <i class="fas fa-qrcode text-xl"></i>
                </div>
                <span class="text-sm text-gray-500">Bugün</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-800"><?= $metrik['bugun_qr'] ?></h3>
            <p class="text-gray-600 text-sm">QR Tarama</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class=" ">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Hızlı İşlemler</h3>
                <div class="space-y-2">
                    <button onclick="showAddCategoryModal()" class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-50 text-gray-700">
                        <i class="fas fa-plus mr-2 text-purple-600"></i>Yeni Kategori Ekle
                    </button>
                    <button onclick="showAddProductModal()" class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-50 text-gray-700">
                        <i class="fas fa-plus mr-2 text-green-600"></i>Yeni Ürün Ekle
                    </button>
                </div>
            </div>

        </div>

        <div class=" ">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Ortalam Restoran Puanı</h3>
                <div class="space-y-2">
                <h2 class="bg-yellow-100 text-yellow-600 p-3 rounded-lg"><?= $statics['ortalama_puan'] ?></h2>

                </div>
            </div>

        </div>

        <div class=" ">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Toplam Okutulan QR</h3>
                <div class="space-y-2">
                <h2 class="bg-gray-100 text-gray-600 p-3 rounded-lg"><?= $statics['toplam_qr'] ?></h2>

                </div>
            </div>

        </div>
    </div>
</div>
