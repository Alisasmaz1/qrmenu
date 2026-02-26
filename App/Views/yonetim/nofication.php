<!-- Notifications Page -->
<div id="notificationsPage" class="page fade-in p-6">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Bilgilendirmeler</h2>
            <p class="text-gray-600">Müşterilerinize duyurular yapın</p>
        </div>
        <button onclick="showAddNotificationModal()" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
            <i class="fas fa-plus mr-2"></i>Yeni Duyuru
        </button>
    </div>

    <!-- Active Notifications -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktif Duyurular</h3>
        <div class="space-y-4">
            <div class="border-l-4 border-yellow-500 bg-yellow-50 p-4 rounded">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-semibold text-gray-800">Özel Gün Duyurusu</h4>
                        <p class="text-gray-600 mt-1">Restoranımız 25 Aralık tarihinde kapalı olacaktır. Anlayışınız için teşekkür ederiz.</p>
                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                            <span><i class="fas fa-calendar mr-1"></i>25.12.2024</span>
                            <span><i class="fas fa-clock mr-1"></i>10:00</span>
                            <span class="text-yellow-600 font-medium">Aktif</span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="editNotification(1)" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteNotification(1)" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="border-l-4 border-green-500 bg-green-50 p-4 rounded">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-semibold text-gray-800">Yeni Menü Eklendi</h4>
                        <p class="text-gray-600 mt-1">Menümüze yeni kış özel ürünler ekledik! Detaylar için menüyü inceleyebilirsiniz.</p>
                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                            <span><i class="fas fa-calendar mr-1"></i>20.12.2024</span>
                            <span><i class="fas fa-clock mr-1"></i>14:00</span>
                            <span class="text-green-600 font-medium">Aktif</span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="editNotification(2)" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteNotification(2)" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Past Notifications -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Geçmiş Duyurular</h3>
        <div class="space-y-4">
            <div class="border-l-4 border-gray-300 bg-gray-50 p-4 rounded opacity-75">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-semibold text-gray-800">Bayram Tatili</h4>
                        <p class="text-gray-600 mt-1">Kurban Bayramı tatili nedeniyle belirtilen tarihlerde kapalıyız.</p>
                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                            <span><i class="fas fa-calendar mr-1"></i>10.12.2024</span>
                            <span><i class="fas fa-clock mr-1"></i>09:00</span>
                            <span class="text-gray-600 font-medium">Sona Erdi</span>
                        </div>
                    </div>
                    <button onclick="viewNotification(3)" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>