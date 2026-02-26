<?php
// Yeni blog yazısı ekleme formu.
// Bu dosya layouts/admin_header.php ve layouts/admin_footer.php arasında çağrılacaktır.
use Core\Security;

// Hataları ve eski input değerlerini session'dan al
$errors = $_SESSION['form_errors'] ?? [];
$oldInput = $_SESSION['old_input'] ?? [];
unset($_SESSION['form_errors'], $_SESSION['old_input']);

?>

<div class="container mx-auto p-4">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Yeni Blog Yazısı Ekle</h2>

    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Hata!</strong>
            <span class="block sm:inline">Lütfen aşağıdaki hataları düzeltin:</span>
            <ul class="mt-2 list-disc list-inside">
                <?php foreach ($errors as $fieldErrors): ?>
                    <?php // $fieldErrors'ın bir dizi olduğundan emin olun ?>
                    <?php if (is_array($fieldErrors)): ?>
                        <?php foreach ($fieldErrors as $errorMsg): ?>
                            <li><?= htmlspecialchars($errorMsg) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><?= htmlspecialchars($fieldErrors) ?></li> <!-- Tek bir hata mesajıysa -->
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/admin/add" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        <input type="hidden" name="_token" value="<?= Security::getCsrfToken() ?>">

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Blog Yazısı Başlığı:</label>
            <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required value="<?= htmlspecialchars($oldInput['title'] ?? '') ?>">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Açıklama (Kısa Tanıtım):</label>
            <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" maxlength="255" required><?= htmlspecialchars($oldInput['description'] ?? '') ?></textarea>
            <p class="text-xs text-gray-500 mt-1">Maksimum 255 karakter.</p>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Yazı İçeriği:</label>
            <textarea name="content" id="content" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required><?= htmlspecialchars($oldInput['content'] ?? '') ?></textarea>
        </div>

        <div class="mb-4">
            <label for="thumbnail" class="block text-gray-700 text-sm font-bold mb-2">Yazı Resmi (Thumbnail):</label>
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <p class="text-xs text-gray-500 mt-1">Desteklenen formatlar: JPEG, PNG, GIF, WebP, SVG, BMP. Max 1MB.</p>
        </div>

        <div class="mb-4">
            <label for="tags" class="block text-gray-700 text-sm font-bold mb-2">Etiketler (Virgülle Ayırın):</label>
            <input type="text" name="tags" id="tags" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="ör: teknoloji, yazılım, php" required value="<?= htmlspecialchars($oldInput['tags'] ?? '') ?>">
        </div>

        <div class="mb-6">
            <label for="seo_title" class="block text-gray-700 text-sm font-bold mb-2">SEO Başlığı:</label>
            <input type="text" name="seo_title" id="seo_title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required value="<?= htmlspecialchars($oldInput['seo_title'] ?? '') ?>">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
                Yazıyı Kaydet
            </button>
        </div>
    </form>
</div>
