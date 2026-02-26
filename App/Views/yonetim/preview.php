
<!-- Preview Page -->
<div id="previewPage" class="page fade-in p-6" style="display: block">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Menü Önizleme</h2>
            <p class="text-gray-600">Müşterilerin göreceği menüyü önizleyin</p>
        </div>
        <button onclick="openInNewTab('<?= $data['previewURL'] ?>')" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
            <i class="fas fa-external-link-alt mr-2"></i>Yeni Sekmede Aç
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="aspect-w-9 aspect-h-16 bg-gray-100 rounded-lg overflow-hidden">
            <iframe src="<?= $data['previewURL'] ?>" class="w-full h-full mx-auto" title="Restoran Önizleme" style="min-height: 500px;width: 50%;height: 50%"></iframe>
        </div>
    </div>
</div>