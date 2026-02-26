
<!-- Menu Management Page -->
<div id="menuPage" class="active page fade-in p-6">
    <?php
        $cats = $data['getRestoranCategories'];
        if (count($cats)>0):
    ?>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Menü Yönetimi</h2>
            <p class="text-gray-600">Ürünleri düzenleyin</p>
        </div>

        <div class="flex space-x-2">
<!--            <select id="categoryFilter" onchange="filterProducts()" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">-->
<!--                <option value="all">Tüm Kategoriler</option>-->
<!--                --><?php //foreach ($cats as $cat): ?>
<!--                <option value="--><?php //= $cat['kategori_id'] ?><!--">--><?php //= $cat['kategori_adi'] ?><!--</option>-->
<!--                --><?php //endforeach; ?>
<!--            </select>-->
            <button onclick="showAddProductModal()" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                <i class="fas fa-plus mr-2"></i>Yeni Ürün
            </button>
        </div>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ürün</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fiyat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="productsTableBody">
<!--                <pre>-->
                    <?php
                        $menus = $data['getRestoranMenus'];
//                        print_r($menus);
                    ?>
<!--                </pre>-->
                <?php

                // Kullanılacak Tailwind renk class’larını belirle
                $renkler = [
                    'bg-orange-100 text-orange-800',
                    'bg-green-100 text-green-800',
                    'bg-pink-100 text-pink-800',
                    'bg-blue-100 text-blue-800',
                    'bg-purple-100 text-purple-800',
                    'bg-yellow-100 text-yellow-800',
                    'bg-teal-100 text-teal-800',
                    'bg-red-100 text-red-800',
                    'bg-indigo-100 text-indigo-800',
                ];

                // Kategori-renk eşleştirmesini saklamak için dizi
                $kategoriRenkMap = [];
                $index = 0;
                foreach ($menus as $menu):

                    $kategori = $menu['kategori_adi'];

                    // Eğer bu kategoriye henüz renk atanmadıysa sıradakini ata
                    if (!isset($kategoriRenkMap[$kategori])) {
                        $kategoriRenkMap[$kategori] = $renkler[$index % count($renkler)];
                        $index++;
                    }

                    $kategoriClass = $kategoriRenkMap[$kategori];
                    ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-10 w-10 rounded-full object-cover" src="<?= $menu['urun_file_url']; ?>" alt="">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900"><?= $menu['productName']; ?></div>
                                <div class="text-sm text-gray-500"><?= $menu['prodctDescription']; ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $kategoriClass ?>">
                                            <?= $menu['kategori_adi'] ?>
                                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $menu['prodctPrice'] ?> ₺</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <label class="relative inline-flex items-center cursor-pointer">
<!--                            --><?php //= $menu['prodctStatus'] ?>
                            <?php $checked = $menu['prodctStatus'] == 'aktif' ? 'checked' : ''; ?>

                            <input
                                    type="checkbox"
                                    class="sr-only peer"
                                <?= $checked ?>
                                    onchange="toggleProductStatus(this, <?= $menu['urun_id'] ?>)"
                            >

                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button onclick="editProduct(<?= $menu['urun_id'] ?>)" class="text-indigo-600 hover:text-indigo-900 mr-3">Düzenle</button>
                        <button onclick="deleteProduct(<?= $menu['urun_id'] ?>)" class="text-red-600 hover:text-red-900">Sil</button>
                    </td>
                </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

    <?php else: ?>
        <div class="bg-red-500 text-white px-4 py-3">
            <div class="container mx-auto flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <span id="alertMessage">Menü oluşturmanız için öncelikle kategori oluşturun.</span>
                </div>
                <a href="/yonetim/category" class="text-white hover:text-gray-200">
                    Kategori Yönetim Sayfasına burdan ulaşın
                    <i class="fas fa-link"></i>
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

