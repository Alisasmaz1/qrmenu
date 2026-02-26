<?php

use Core\Config;

$slug = $data['restoranSlug']['slug'];

$qr_url = Config::SITE_URL."/restoran/view/".$slug."?qrcode=true";
?>
<!-- Settings Page -->
<div id="qrCode" class="page fade-in p-6" style="display: block">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">QR Code</h2>
        <p class="text-gray-600">Karekod oluşturun ve indirin</p>
    </div>


    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">QR Kod Bilgileri</h3>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mağaza URL Değeri</label>
                <input type="text" value="<?= $slug ?>" disabled class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">QR Kod Analiz Parametresi</label>
                <input type="text" value="qrkod=true" disabled class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tam Oluşturulan QR URL</label>
                <input type="text" value="<?= $qr_url; ?>" disabled class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <div>
                <?php echo "<img id='qrcodeImage' src='https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={$qr_url}' />"; ?>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="saveSettings('<?= $qr_url ?>')" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                <i class="fas fa-qrcode mr-2"></i>QR Kodu Oluştur ve İndir
            </button>
        </div>
    </div>
</div>