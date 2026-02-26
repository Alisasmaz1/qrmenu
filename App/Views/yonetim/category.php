<?php $categories = $data['getRestoranCategories']; ?>



<!-- Categories Management Page -->
<div id="categoriesPage" class="page fade-in p-6 active">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kategori Yönetimi</h2>
            <p class="text-gray-600">Menü kategorilerini düzenleyin</p>
        </div>
        <button onclick="showAddCategoryModal()"
                class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
            <i class="fas fa-plus mr-2"></i>Yeni Kategori
        </button>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">


        <?php

        foreach ($categories as $cat): ?>
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="h-32  to-red-500 flex items-center justify-center relative" style="background: url('<?= $cat['file_url'] ?>');background-size: contain; background-repeat: no-repeat; background-position: center;">
                <div class="absolute top-2 right-2">
                    <?php if ($cat['kategori_durumu']=='aktif'): ?>
                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">Aktif</span>
                    <?php else: ?>
                    <span class="bg-gray-500 text-white text-xs px-2 py-1 rounded-full">Pasif</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-gray-800"><?= $cat['kategori_adi'] ?></h3>
                <p class="text-sm text-gray-500 mt-1"><?= $cat['urun_sayisi'] ?> Ürün</p>
                <div class="flex justify-between items-center mt-4">
                    <button onclick="editCategory(<?= $cat['kategori_id'] ?>)" class="text-blue-600 hover:text-blue-800 text-sm">
                        <i class="fas fa-edit mr-1"></i>Düzenle
                    </button>
                    <button onclick="deleteCategory(<?= $cat['kategori_id'] ?>)" class="text-red-600 hover:text-red-800 text-sm">
                        <i class="fas fa-trash mr-1"></i>Sil
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>