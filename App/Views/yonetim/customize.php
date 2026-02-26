<!-- Theme Customization Page -->
<div id="themePage" class="page fade-in p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tema Özelleştirme</h2>
        <p class="text-gray-600">Menünüzün görünümünü kişiselleştirin</p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Renkler</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ana Renk</label>
                <div class="flex items-center space-x-3">
                    <input type="color" id="primaryColor" value="#667eea" class="color-picker">
                    <input type="text" value="#667eea" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg" onchange="document.getElementById('primaryColor').value = this.value">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">İkincil Renk</label>
                <div class="flex items-center space-x-3">
                    <input type="color" id="secondaryColor" value="#764ba2" class="color-picker">
                    <input type="text" value="#764ba2" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg" onchange="document.getElementById('secondaryColor').value = this.value">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Metin Rengi</label>
                <div class="flex items-center space-x-3">
                    <input type="color" id="textColor" value="#1f2937" class="color-picker">
                    <input type="text" value="#1f2937" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg" onchange="document.getElementById('textColor').value = this.value">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Arka Plan Rengi</label>
                <div class="flex items-center space-x-3">
                    <input type="color" id="bgColor" value="#f9fafb" class="color-picker">
                    <input type="text" value="#f9fafb" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg" onchange="document.getElementById('bgColor').value = this.value">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Yazı Tipleri</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Başlık Yazı Tipi</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option>Poppins</option>
                    <option>Roboto</option>
                    <option>Open Sans</option>
                    <option>Montserrat</option>
                    <option>Playfair Display</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">İçerik Yazı Tipi</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option>Poppins</option>
                    <option>Roboto</option>
                    <option>Open Sans</option>
                    <option>Montserrat</option>
                    <option>Playfair Display</option>
                </select>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Logo</h3>
        <div class="flex items-center space-x-6">
            <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden">
                <img src="/public/assets/img/qr-menu.png" alt="Logo" class="w-full h-full object-cover">
            </div>
            <div>
                <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition mb-2">
                    <i class="fas fa-upload mr-2"></i>Logo Yükle
                </button>
                <p class="text-sm text-gray-500">Önerilen boyut: 200x200px, PNG veya JPG formatı</p>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button onclick="saveTheme()" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
            <i class="fas fa-save mr-2"></i>Değişiklikleri Kaydet
        </button>
    </div>
</div>