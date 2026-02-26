<?php
// Admin paneli ana sayfası - Tüm blog yazılarını listeler ve yönetim seçenekleri sunar.
// Bu dosya layouts/admin_header.php ve layouts/admin_footer.php arasında çağrılacaktır.
use Core\Security;
?>

<div class="container mx-auto p-4">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Blog Yazıları Yönetimi</h2>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= htmlspecialchars($_SESSION['success_message']) ?></span>
            <?php unset($_SESSION['success_message']); // Mesajı kullandıktan sonra temizle ?>
        </div>
    <?php endif; ?>

    <div class="mb-6">
        <a href="/admin/add" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md shadow-lg transition duration-300 ease-in-out">Yeni Yazı Ekle</a>
    </div>

    <?php if (!empty($posts)): ?>
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Başlık</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarih</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($post['id']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($post['title']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?php if ($post['thumbnail']): ?>
                                <img src="/storage/public/uploads/<?= htmlspecialchars($post['thumbnail']) ?>" alt="Thumbnail" class="h-12 w-12 object-cover rounded-full">
                            <?php else: ?>
                                <img src="https://placehold.co/50x50/DDDDDD/666666?text=No+Img" alt="Placeholder" class="h-12 w-12 object-cover rounded-full">
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= date('d M Y', strtotime($post['created_at'])) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="/admin/edit/<?= htmlspecialchars($post['id']) ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Düzenle</a>
                            <form action="/admin/delete/<?= htmlspecialchars($post['id']) ?>" method="POST" class="inline-block" onsubmit="return confirm('Bu yazıyı silmek istediğinizden emin misiniz?');">
                                <input type="hidden" name="_token" value="<?= Security::getCsrfToken() ?>">
                                <button type="submit" class="text-red-600 hover:text-red-900">Sil</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-600 text-lg mt-8">Henüz admin panelinde görüntülenecek blog yazısı bulunmamaktadır.</p>
    <?php endif; ?>
</div>
