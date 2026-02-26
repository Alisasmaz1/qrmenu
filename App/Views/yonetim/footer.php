
<?php
// Kullanıcı giriş sayfası.
// layouts/header.php ve layouts/footer.php arasında çağrılacaktır.
use Core\Security; // CSRF token için Security sınıfını kullanıyoruz
?>

</main>
</div>
<!-- Modals -->
<!-- Add Category Modal -->
<div id="addCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Kategori Ekle</h3>
            <button onclick="closeModal('addCategoryModal')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form onsubmit="addCategory(event)">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Adı</label>
                <input type="text" id="cat_name" placeholder="Kategori adını yazınız" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Kategori Resmi Ekleme Alanı -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Resmi</label>
                <div class="flex items-center space-x-4">
                    <div class="w-24 h-24 bg-gray-200 rounded-lg overflow-hidden">
                        <img id="categoryImagePreview" src="/public/assets/img/qr-menu.png" alt="Kategori Resmi" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <input type="hidden" id="categoryImageId" name="imageId" value="">
                        <button type="button" onclick="openImageSelectionModal()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-image mr-2"></i>Resim Seç
                        </button>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                <select id="categoryStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="aktif" selected>Aktif</option>
                    <option value="pasif">Pasif</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('addCategoryModal')" class="mr-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">İptal</button>
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Ekle</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<!-- Edit Category Modal -->
<div id="editCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Kategori Düzenle</h3>
            <button onclick="closeModal('editCategoryModal')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form onsubmit="updateCategory(event)">
            <input type="hidden" name="cat_id" id="cat_id">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Adı</label>
                <input type="text" value="Başlangıçlar" id="kategoryEditName" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Kategori Resmi Ekleme Alanı -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Resmi</label>
                <div class="flex items-center space-x-4">
                    <div class="w-24 h-24 bg-gray-200 rounded-lg overflow-hidden">
                        <img id="categoryEditImagePreview" src="/public/assets/img/qr-menu.png" alt="Kategori Resmi" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <input type="hidden" id="categoryEditImageId" name="imageId" value="">
                        <button type="button" onclick="openImageSelectionModal('categoryEditImageId','categoryEditImagePreview')" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-image mr-2"></i>Resim Seç
                        </button>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                <select  id="statusSelect"  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="aktif"  >Aktif</option>
                    <option value="pasif"  >Pasif</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('editCategoryModal')" class="mr-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">İptal</button>
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Güncelle</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Product Modal -->
<div id="addProductModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-2xl w-full p-6 max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Yeni Ürün Ekle</h3>
            <button onclick="closeModal('addProductModal')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form onsubmit="addProduct(event)">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ürün Adı</label>
                    <input type="text" id="productName"  required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select required id="productCategory" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="" disabled>Kategori Seçin</option>
                        <?php
                        if (isset($data['getRestoranCategories'])):
                            $cats = $data['getRestoranCategories'];
                            foreach ($cats as $cat): ?>
                                <option value="<?= $cat['kategori_id'] ?>"><?= $cat['kategori_adi'] ?></option>
                            <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fiyat</label>
                    <input type="number" id="productPrice" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                    <select id="productStatus"  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="aktif">Aktif</option>
                        <option value="pasif">Pasif</option>
                    </select>
                </div>
                <div class="md:col-span-2 mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Açıklama</label>
                    <textarea rows="3" id="productDesc" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
                </div>

                <div class="md:col-span-2 mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Resmi</label>
                    <div class="flex items-center space-x-4">
                        <div class="w-24 h-24 bg-gray-200 rounded-lg overflow-hidden">
                            <img id="menuAddImagePreview" src="/public/assets/img/qr-menu.png" alt="Kategori Resmi" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <input type="hidden" id="menuAddImageId" name="imageId" value="">
                            <button type="button" onclick="openImageSelectionModal('menuAddImageId','menuAddImagePreview')" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                                <i class="fas fa-image mr-2"></i>Resim Seç
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('addProductModal')" class="mr-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">İptal</button>
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Ekle</button>
            </div>
        </form>
    </div>
</div>

<!-- Image Selection Modal -->
<div id="imageSelectionModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-4xl w-full p-6 max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Resim Seç</h3>
            <button onclick="closeModal('imageSelectionModal')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mb-6">
            <h4 class="text-md font-medium text-gray-700 mb-2">Yeni Resim Yükle</h4>
            <div class="flex items-center space-x-4">
                <input type="file" id="newImageUpload" class="hidden" onchange="uploadNewImage(event)">
                <button onclick="document.getElementById('newImageUpload').click()" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                    <i class="fas fa-upload mr-2"></i>Yeni Resim Yükle
                </button>
            </div>
        </div>
        <div class="mb-4">
            <?php  $images = $data['uploadedImages']; ?>
            <h4 class="text-md font-medium text-gray-700 mb-2">Önceden Yüklediğiniz Resimler (<?= count($images) ?>)</h4>
            <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4" id="imagesArea">
                <!-- Sample images -->
                <?php
                foreach ($images as $img):
                ?>
                <div class="border rounded-lg overflow-hidden cursor-pointer hover:shadow-md" onclick="selectImage(<?= $img['id'] ?>, '<?= $img['file_url'] ?>')">
                    <img src="<?= $img['file_url'] ?>" alt="Kategori Resimi" class="w-full h-24 object-cover">
                </div>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="flex justify-end">
            <button onclick="closeModal('imageSelectionModal')" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">İptal</button>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div id="editProductModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4" style="z-index: 30">
    <div class="bg-white rounded-xl max-w-2xl w-full p-6 max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Ürün Düzenle</h3>
            <button onclick="closeModal('editProductModal')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form onsubmit="updateProduct(event)">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ürün Adı</label>
                    <input type="hidden" id="menuID" value="">
                    <input type="text" id="productEditName" value="" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select id="productEditCategory" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <?php
                        if (isset($data['getRestoranCategories'])):
                            $cats = $data['getRestoranCategories'];
                            foreach ($cats as $cat): ?>
                                <option value="<?= $cat['kategori_id'] ?>" id="productEditCategory_<?= $cat['kategori_id'] ?>"><?= $cat['kategori_adi'] ?></option>
                            <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fiyat</label>
                    <input type="number" id="productEditPrice" value="" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                    <select id="productEditStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="aktif" id="productEditStatusAktif" >Aktif</option>
                        <option value="pasif" id="productEditStatusPasif">Pasif</option>
                    </select>
                </div>
                <div class="md:col-span-2 mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Açıklama</label>
                    <textarea id="productEditDescription" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
                </div>
                <div class="md:col-span-2 mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ürün Görseli</label>
                    <div class="flex items-center space-x-4">
                        <div class="w-24 h-24 bg-gray-200 rounded-lg overflow-hidden">
                            <img id="menuEditImagePreview" src="/public/assets/img/qr-menu.png" alt="Ürün Resmi" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <input type="hidden" id="menuEditImageId" name="imageId" value="">
                            <button type="button" onclick="openImageSelectionModal('menuEditImageId','menuEditImagePreview')" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                                <i class="fas fa-image mr-2"></i>Resim Seç
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('editProductModal')" class="mr-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">İptal</button>
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Güncelle</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Notification Modal -->
<div id="addNotificationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-2xl w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Yeni Duyuru Ekle</h3>
            <button onclick="closeModal('addNotificationModal')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form onsubmit="addNotification(event)">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Duyuru Başlığı</label>
                <input type="text" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Duyuru Metni</label>
                <textarea rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Başlangıç Tarihi</label>
                    <input type="datetime-local" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bitiş Tarihi</label>
                    <input type="datetime-local" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Öncelik</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="low">Düşük</option>
                    <option value="medium">Orta</option>
                    <option value="high">Yüksek</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="aktif">Aktif</option>
                    <option value="pasif">Pasif</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('addNotificationModal')" class="mr-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">İptal</button>
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Ekle</button>
            </div>
        </form>
    </div>
</div>

<!-- View Feedback Modal -->
<div id="viewFeedbackModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-2xl w-full p-6 max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Geri Bildirim Detayları</h3>
            <button onclick="closeModal('viewFeedbackModal')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="space-y-4">
            <div class="flex items-center space-x-3">
                <div>
                    <h4 class="font-medium text-gray-900" id="customerName">-</h4>
                    <p class="text-sm text-gray-500" id="customerCommentDate">-</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Menü</p>
                    <div class="flex text-yellow-400" id="customerMenuRating">
                    </div>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Hizmet</p>
                    <div class="flex text-yellow-400"  id="customerServiceRating">
                    </div>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Mekan</p>
                    <div class="flex text-yellow-400"  id="customerVenueRating">
                    </div>
                </div>
            </div>
            <div>
                <h4 class="font-medium text-gray-900 mb-2">Yorum</h4>
                <p class="text-gray-700" id="customerComment">-.</p>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="closeModal('viewFeedbackModal')" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Kapat</button>
        </div>
    </div>
</div>

<!-- Success Notification -->
<div id="successNotification" class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-full transition-transform duration-300 z-50">
    <div class="flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <span id="successMessage">İşlem başarıyla tamamlandı!</span>
    </div>
</div>

<script>

    var preview_selector="";
    var image_id_selector="";

    // Page navigation
    function showPage(pageId) {
        document.querySelectorAll('.page').forEach(page => {
            page.classList.remove('active');
        });
        document.getElementById(pageId + 'Page').classList.add('active');
    }

    // Toggle sidebar
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }

    // Alert banner functions
    function showAlertBanner() {
        document.getElementById('alertBanner').classList.remove('hidden');
    }

    function closeAlertBanner() {
        document.getElementById('alertBanner').classList.add('hidden');
    }

    // Show notifications
    function showNotifications() {
        showSuccessNotification('Bildirimler özelliği yakında eklenecek!');
    }

    // Category management functions
    function showAddCategoryModal() {
        document.getElementById('addCategoryModal').classList.remove('hidden');
    }

    function editCategory(id) {
        document.getElementById('editCategoryModal').classList.remove('hidden');
        preview_selector="categoryEditImagePreview";
        image_id_selector="categoryEditImageId";

        showSuccessNotification('Kategori Bilgileri Getiriliyor ...');
        let cat_id = id;

        // FormData oluştur
        const formData = new FormData();
        formData.append('catId', cat_id);
        formData.append('form_type', 'getCategoryInfo');
        formData.append('_token', "<?= Security::getCsrfToken() ?>");

        // API isteği
        fetch('/yonetim/api', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {

                    document.querySelector('#kategoryEditName').value=data.data.kategori_adi;
                    document.querySelector('#categoryEditImagePreview').src=data.data.file_url;
                    document.querySelector('#categoryEditImageId').value=data.data.image_id;
                    document.querySelector('#cat_id').value=id;

                    // Select elementini seç
                    let selectElement = document.getElementById('statusSelect');

                    // Value özelliğini ayarlayarak seçili yap
                    selectElement.value = data.data.kategori_durumu;


                    // Modalı kapat
                    showSuccessNotification(data.message);

                } else {
                    console.log(data.message || 'kategori getirilemedi!');
                }
            })
            .catch(err => {
                console.error('Upload error:', err);
                console.log('Sunucuya bağlanırken hata oluştu!');
            });

    }

    function deleteCategory(id) {
        // console.log(id);
        if (confirm('Bu kategoriyi silmek istediğinizden emin misiniz?')) {
            // showSuccessNotification('Kategori başarıyla silindi!');
            const formData = new FormData();
            formData.append('catId', id);
            formData.append('form_type', 'deleteCategory');
            formData.append('_token', "<?= Security::getCsrfToken() ?>");

            // API isteği
            fetch('/yonetim/api', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {

                        showSuccessNotification(data.message+" Sayfa Yenileniyor , bekleyiniz ...");
                        setTimeout(()=>{
                            window.location.reload()
                        },2000)

                    } else {
                        console.log(data.message || 'Resim yüklenirken bir hata oluştu!');
                    }
                })
                .catch(err => {
                    console.error('Upload error:', err);
                    console.log('Sunucuya bağlanırken hata oluştu!');
                });

        }
    }

    function addCategory(event) {
        event.preventDefault();
        // closeModal('addCategoryModal');
        // showSuccessNotification('Kategori başarıyla eklendi!');

        // Yükleme bildirimi
        showSuccessNotification('Kategori Oluşturuluyor ...');
        let cat_name = document.querySelector('#cat_name').value;
        let cat_img = document.querySelector('#categoryImageId').value;
        let cat_status = document.querySelector('#categoryStatus').value;

        // FormData oluştur
        const formData = new FormData();
        formData.append('catName', cat_name);
        formData.append('catImageId', cat_img);
        formData.append('catStatus', cat_status);
        formData.append('form_type', 'addCategory');
        formData.append('_token', "<?= Security::getCsrfToken() ?>");

        // API isteği
        fetch('/yonetim/api', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {

                    // Modalı kapat
                    closeModal('addCategoryModal');
                    showSuccessNotification(data.message);

                    setTimeout(()=>{
                        window.location.reload();
                    },2000);

                } else {
                    console.log(data.message || 'Resim yüklenirken bir hata oluştu!');
                }
            })
            .catch(err => {
                console.error('Upload error:', err);
                console.log('Sunucuya bağlanırken hata oluştu!');
            });

    }

    function updateCategory(event) {
        event.preventDefault();

        // closeModal('editCategoryModal');
        // showSuccessNotification('Kategori başarıyla güncellendi!');

        showSuccessNotification('Kategori Güncelleniyor Bekleyiniz ...');
        let cat_name = document.querySelector('#kategoryEditName').value;
        let cat_id = document.querySelector('#cat_id').value;
        let cat_img = document.querySelector('#categoryEditImageId').value;
        let cat_status = document.querySelector('#statusSelect').value;

        // FormData oluştur
        const formData = new FormData();
        formData.append('catId', cat_id);
        formData.append('catName', cat_name);
        formData.append('catImageId', cat_img);
        formData.append('catStatus', cat_status);
        formData.append('form_type', 'updateCategory');
        formData.append('_token', "<?= Security::getCsrfToken() ?>");

        // API isteği
        fetch('/yonetim/api', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {

                    // Modalı kapat
                    closeModal('editCategoryModal');
                    // showSuccessNotification(data.message);

                    preview_selector="";
                    image_id_selector="";

                    showSuccessNotification(data.message + " Sayfa Yenileniyor , bekleyiniz...");

                    setTimeout(()=>{
                        window.location.reload();
                    },2000)

                } else {
                    console.log(data.message || 'güncelleme işleminde bir hata oluştu!');
                }
            })
            .catch(err => {
                console.error('Upload error:', err);
                console.log('Sunucuya bağlanırken hata oluştu!');
            });

    }

    // Product management functions
    function showAddProductModal() {
        document.getElementById('addProductModal').classList.remove('hidden');
        preview_selector="menuAddImagePreview";
        image_id_selector="menuAddImageId";
    }

    /*
    * Helper Functiom
    * */
    function selectByText(selectId, text) {
        const select = document.getElementById(selectId);
        const options = Array.from(select.options);

        const option = options.find(opt => opt.text.trim().toLowerCase() === text.trim().toLowerCase());

        if (option) {
            option.selected = true;
        }
    }




    function editProduct(id) {
        preview_selector="menuEditImagePreview";
        image_id_selector="menuEditImageId";

        console.log("Düzenlenecek ürün id :",id);
        document.getElementById('editProductModal').classList.remove('hidden');

        showSuccessNotification('Ürün Bilgilerinin Getirilmesini Bekleyiniz ...');

        // FormData oluştur
        const formData = new FormData();
        formData.append('productId', id);
        formData.append('form_type', 'getProductInfo');
        formData.append('_token', "<?= Security::getCsrfToken() ?>");

        // API isteği
        fetch('/yonetim/api', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data)

                    document.querySelector('#menuID').value=id;
                    document.querySelector('#productEditName').value=data.data.productName;
                    document.querySelector('#productEditPrice').value=data.data.prodctPrice;
                    document.querySelector('#productEditDescription').value=data.data.prodctDescription;
                    document.querySelector('#menuEditImageId').value=data.data.urun_image_id;
                    document.querySelector('#menuEditImagePreview').src=data.data.urun_file_url;
                    selectByText("productEditCategory", data.data.kategori_adi);
                    selectByText("productEditStatus", data.data.prodctStatus);


                    // Modalı kapat
                    // closeModal('editCategoryModal');
                    // showSuccessNotification(data.message);

                    // preview_selector="";
                    // image_id_selector="";

                    showSuccessNotification(data.message);



                } else {
                    console.log(data.message || 'ürün getirme işleminde bir hata oluştu!');
                }
            })
            .catch(err => {
                console.error('Upload error:', err);
                console.log('Sunucuya bağlanırken hata oluştu!');
            });

    }

    function deleteProduct(id) {
        if (confirm('Bu ürünü silmek istediğinizden emin misiniz?')) {
            const formData = new FormData();
            formData.append('productID', id);
            formData.append('form_type', 'deleteMenu');
            formData.append('_token', "<?= Security::getCsrfToken() ?>");

            // API isteği
            fetch('/yonetim/api', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {

                        showSuccessNotification(data.message+" Sayfa Yenileniyor , bekleyiniz ...");
                        setTimeout(()=>{
                            window.location.reload()
                        },2000)

                    } else {
                        console.log(data.message || 'Resim yüklenirken bir hata oluştu!');
                    }
                })
                .catch(err => {
                    console.error('Upload error:', err);
                    console.log('Sunucuya bağlanırken hata oluştu!');
                });
        }
    }

    function addProduct(event) {
        event.preventDefault();
        // closeModal('addProductModal');
        // showSuccessNotification('Ürün başarıyla eklendi!');


        // Yükleme bildirimi
        showSuccessNotification('Ürün Oluşturuluyor ...');
        let product_name = document.querySelector('#productName').value;
        let product_cat_id = document.querySelector('#productCategory').value;
        let product_price = document.querySelector('#productPrice').value;
        let product_status = document.querySelector('#productStatus').value;
        let product_description = document.querySelector('#productDesc').value;
        let product_image_id = document.querySelector('#menuAddImageId').value;

        // FormData oluştur
        const formData = new FormData();
        formData.append('productName', product_name);
        formData.append('productCategoryId', product_cat_id);
        formData.append('prodctPrice', product_price);
        formData.append('prodctStatus', product_status);
        formData.append('prodctDescription', product_description);
        formData.append('prodctImageId', product_image_id);
        formData.append('form_type', 'addProduct');
        formData.append('_token', "<?= Security::getCsrfToken() ?>");

        // API isteği
        fetch('/yonetim/api', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {

                    // Modalı kapat
                    closeModal('addProductModal');
                    showSuccessNotification(data.message);

                    setTimeout(()=>{
                        window.location.reload();
                    },2000);

                } else {
                    console.log(data.message || 'Menü yüklenirken bir hata oluştu!');
                }
            })
            .catch(err => {
                console.error('Upload error:', err);
                console.log('Sunucuya bağlanırken hata oluştu!');
            });

    }

    function updateProduct(event) {
        event.preventDefault();

        let menuID = document.querySelector('#menuID').value;
        let menuName = document.querySelector('#productEditName').value;
        let menuCatID = document.querySelector('#productEditCategory').value;
        let menuPrice = document.querySelector('#productEditPrice').value;
        let menuStatus = document.querySelector('#productEditStatus').value;
        let menuDescription = document.querySelector('#productEditDescription').value;
        let menuImageID = document.querySelector('#menuEditImageId').value;

        // console.log(menuName,menuCatID,menuPrice,menuStatus,menuDescription,menuImageID);

        // FormData oluştur
        const formData = new FormData();
        formData.append('menuID', menuID);
        formData.append('menuName', menuName);
        formData.append('menuCatID', menuCatID);
        formData.append('menuPrice', menuPrice);
        formData.append('menuStatus', menuStatus);
        formData.append('menuDescription', menuDescription);
        formData.append('menuImageID', menuImageID);
        formData.append('form_type', 'updateMenu');
        formData.append('_token', "<?= Security::getCsrfToken() ?>");

        // API isteği
        fetch('/yonetim/api', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {

                closeModal('editProductModal');

                showSuccessNotification(data.message + " Sayfa Yenileniyor , bekleyiniz...");

                setTimeout(()=>{
                    window.location.reload();
                },2000)
            })
            .catch(err => {
                console.error('Upload error:', err);
                console.log('Sunucuya bağlanırken hata oluştu!');
            });


    }

    function toggleProductStatus(checkbox,product_id) {
        const status = checkbox.checked ? 'aktif' : 'pasif';

        // FormData oluştur
        const formData = new FormData();
        formData.append('productId', product_id);
        formData.append('productStatus', status);
        formData.append('form_type', 'toggleProductStatus');
        formData.append('_token', "<?= Security::getCsrfToken() ?>");

        // API isteği
        fetch('/yonetim/api', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                showSuccessNotification(data.message);
            })
            .catch(err => {
                console.error('Upload error:', err);
                console.log('Sunucuya bağlanırken hata oluştu!');
            });



    }

    function filterProducts() {
        const filter = document.getElementById('categoryFilter').value;
        showSuccessNotification(`${filter} kategorisi filtrelendi!`);
    }

    // Notification management functions
    function showAddNotificationModal() {
        document.getElementById('addNotificationModal').classList.remove('hidden');
    }

    function addNotification(event) {
        event.preventDefault();
        closeModal('addNotificationModal');
        showSuccessNotification('Duyuru başarıyla eklendi!');
        // showAlertBanner();
    }

    function editNotification(id) {
        showSuccessNotification('Duyuru düzenleme özelliği yakında eklenecek!');
    }

    function deleteNotification(id) {
        if (confirm('Bu duyuruyu silmek istediğinizden emin misiniz?')) {
            showSuccessNotification('Duyuru başarıyla silindi!');
        }
    }

    function viewNotification(id) {
        showSuccessNotification('Duyuru detayı görüntülendi!');
    }

    // Store info functions
    function saveStoreInfo(event) {
        event.preventDefault();

        let restoran_name = document.querySelector('#restaurantName').value;
        let restoran_slogan = document.querySelector('#restaurantSlogan').value;
        let restoran_address = document.querySelector('#restaurantAddress').value;
        let restoran_address_ilce = document.querySelector('#restaurantAddressIlce').value;
        let restoran_address_il = document.querySelector('#restaurantAddressIl').value;
        let restoran_address_phone = document.querySelector('#restaurantPhone').value;

        const formData = new FormData();
        formData.append('restoranName', restoran_name);
        formData.append('restoranSlogan', restoran_slogan);
        formData.append('restoranAddress', restoran_address);
        formData.append('restoranAddressIlce', restoran_address_ilce);
        formData.append('restoranAddressIl', restoran_address_il);
        formData.append('restoranAddressPhone', restoran_address_phone);
        formData.append('form_type', 'updateRestoranInfo');
        formData.append('_token', "<?= Security::getCsrfToken() ?>");

        // API isteği
        fetch('/yonetim/api', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                showSuccessNotification(data.message);
            })
            .catch(err => {
                console.error('Upload error:', err);
                console.log('Sunucuya bağlanırken hata oluştu!');
            });


    }

    // Theme functions
    function saveTheme() {
        showSuccessNotification('Tema ayarları başarıyla kaydedildi!');
    }

    // Settings functions
    function saveSettings() {
        const img = document.getElementById("qrcodeImage");
        const imageUrl = img.src;

        fetch(imageUrl)
            .then(response => response.blob())
            .then(blob => {
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = "qrcode.png";
                document.body.appendChild(a);
                a.click();
                a.remove();
                URL.revokeObjectURL(url);
                showSuccessNotification('QR Kod İndirildi!');
            })
            .catch(err => console.error("QR kod indirilemedi:", err));

    }


    // Feedback functions
    function viewFeedback(data) {
        // console.log(data);
        document.getElementById("customerName").textContent = data.customer_name;
        document.getElementById("customerCommentDate").textContent = data.created_at;
        document.querySelector("#customerComment").textContent = data.customer_comment;

// Yıldız render fonksiyonu
        function renderStars(elementId, rating) {
            const el = document.getElementById(elementId);
            el.innerHTML = ""; // önce temizle

            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    el.innerHTML += `<i class="fas fa-star"></i>`;   // dolu yıldız
                } else {
                    el.innerHTML += `<i class="far fa-star"></i>`;   // boş yıldız
                }
            }
        }

// 3 rating alanını doldur
        renderStars("customerMenuRating", data.menu_rating);
        renderStars("customerServiceRating", data.service_rating);
        renderStars("customerVenueRating", data.venue_rating);
        document.getElementById('viewFeedbackModal').classList.remove('hidden');
    }

    // Modal functions
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Success notification
    function showSuccessNotification(message) {
        const notification = document.getElementById('successNotification');
        document.getElementById('successMessage').textContent = message;
        notification.classList.remove('translate-y-full');

        setTimeout(() => {
            notification.classList.add('translate-y-full');
        }, 3000);
    }

    // Open preview in new tab
    function openInNewTab(url) {
        showSuccessNotification('Menü yeni sekmede açıldı!');
        setTimeout(()=>{
            window.open(url);
        },3000)
    }

    // Logout
    function logout() {
        if (confirm('Çıkış yapmak istediğinizden emin misiniz?')) {
            showSuccessNotification('Başarıyla çıkış yapıldı!');
        }
    }

    // Color picker sync
    // document.getElementById('primaryColor').addEventListener('input', function() {
    //     this.nextElementSibling.value = this.value;
    // });
    //
    // document.getElementById('secondaryColor').addEventListener('input', function() {
    //     this.nextElementSibling.value = this.value;
    // });
    //
    // document.getElementById('textColor').addEventListener('input', function() {
    //     this.nextElementSibling.value = this.value;
    // });
    //
    // document.getElementById('bgColor').addEventListener('input', function() {
    //     this.nextElementSibling.value = this.value;
    // });

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // Show alert banner on load
        setTimeout(() => {
            showAlertBanner();
        }, 1000);
    });

    // Resim seçme modalını aç
    function openImageSelectionModal() {
        document.getElementById('imageSelectionModal').classList.remove('hidden');
    }

    // Resim seçildiğinde
    function selectImage(imageId, imageUrl,imageid_selector="categoryImageId",preview_id_selector="categoryImagePreview") {
        if (preview_selector.length>0){
            preview_id_selector=preview_selector;
        }
        if (image_id_selector.length>0){
            imageid_selector = image_id_selector;
        }
        console.log('Seçme İşlemi Gerçekleşti',imageid_selector);
        // Resim ID'sini hidden input'a set et
        document.getElementById(imageid_selector).value = imageId;
        // Resim önizlemesini güncelle
        document.getElementById(preview_id_selector).src = imageUrl;
        // Modalı kapat
        closeModal('imageSelectionModal');
        showSuccessNotification('Resim başarıyla seçildi!');
    }

    // Yeni resim yükleme (gerçek API bağlantılı versiyon)
    function uploadNewImage(event) {
        const file = event.target.files[0];
        if (!file) return;

        // Yükleme bildirimi
        showSuccessNotification('Resim yükleniyor...');

        // FormData oluştur
        const formData = new FormData();
        formData.append('image', file);
        formData.append('form_type', 'uploadImage');
        formData.append('_token', "<?= Security::getCsrfToken() ?>");
        formData.append('restoranId', <?=$_SESSION['user_id']?>); // Buraya dinamik olarak restoran ID'ni yaz veya değişkenden al

        // API isteği
        fetch('/yonetim/api', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Sunucudan gelen yanıtı kullan
                    let preview_id_selector = "categoryImagePreview";
                    let imageid_selector = "categoryImageId";
                    if (preview_selector.length>0){
                        preview_id_selector=preview_selector;
                    }
                    if (image_id_selector.length>0){
                        imageid_selector = image_id_selector;
                    }

                    console.log(imageid_selector,preview_id_selector);
                    document.getElementById(imageid_selector).value = data.data.imageId;
                    document.getElementById(preview_id_selector).src = data.data.url;

                    // Modalı kapat
                    closeModal('imageSelectionModal');
                    showSuccessNotification('Resim başarıyla yüklendi!');
                } else {
                    showErrorNotification(data.message || 'Resim yüklenirken bir hata oluştu!');
                }
            })
            .catch(err => {
                console.error('Upload error:', err);
                showErrorNotification('Sunucuya bağlanırken hata oluştu!');
            });
    }


    // Kategori güncelleme fonksiyonunu güncelle
    // function updateCategory(event) {
    //     event.preventDefault();
    //
    //     // Form verilerini al
    //     const formData = new FormData(event.target);
    //     const categoryName = formData.get('categoryName');
    //     const categoryStatus = formData.get('status');
    //     const imageId = document.getElementById('categoryImageId').value;
    //
    //     // Gerçek uygulamada burada API isteği atılacak
    //     console.log('Kategori güncelleme verileri:', {
    //         name: categoryName,
    //         status: categoryStatus,
    //         imageId: imageId
    //     });
    //
    //     closeModal('editCategoryModal');
    //     showSuccessNotification('Kategori başarıyla güncellendi!');
    // }
</script>
</body>
</html>