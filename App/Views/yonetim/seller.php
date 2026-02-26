<?php $restoran = $data['getRestoranInfo']['data']; ?>
<!-- Store Information Page -->
<div id="storePage" class="page fade-in p-6" style="display: block">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Mağaza Bilgileri</h2>
        <p class="text-gray-600">Restoranınızın bilgilerini düzenleyin</p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6">
        <form onsubmit="saveStoreInfo(event)">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Restoran Adı</label>
                    <input type="text" id="restaurantName" value="<?= $restoran['name'] ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Slogan</label>
                    <input type="text" id="restaurantSlogan" value="<?= $restoran['slogan'] ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tam Adres</label>
                    <input type="text" id="restaurantAddress" value="<?= $restoran['adres'] ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">İlçe</label>
                    <input type="text" id="restaurantAddressIlce" value="<?= $restoran['ilce'] ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">İl</label>
                    <input type="text" id="restaurantAddressIl" value="<?= $restoran['sehir'] ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
                    <input type="text" id="restaurantPhone" value="<?= $restoran['phone'] ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
                    <input type="email" id="restaurantEmail" disabled value="<?= $restoran['mail'] ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                    <i class="fas fa-save mr-2"></i>Güncelle
                </button>
            </div>
        </form>
    </div>
</div>