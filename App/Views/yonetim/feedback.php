<?php $feedbacks = $data['feedbacks'] ; ?>
<!-- Feedback Management Page -->
<div id="feedbackPage" class="page fade-in p-6" style="display: block">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Geri Bildirimler</h2>
        <p class="text-gray-600">Müşteri geri bildirimlerini görüntüleyin</p>
    </div>




    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Müşteri</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarih</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menü</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hizmet</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mekan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($feedbacks as $feedback): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900"><?= $feedback['customer_name'] ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $feedback['created_at'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex text-yellow-400">
                                <?php for ($i=0;$i<5;$i++): ?>
                                    <?php if ($feedback['menu_rating']<=$i): ?>
                                        <i class="far fa-star"></i>
                                    <?php else: ?>
                                        <i class="fas fa-star"></i>
                                <?php endif; endfor; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex text-yellow-400">
                                <?php for ($i=0;$i<5;$i++): ?>
                                    <?php if ($feedback['service_rating']<=$i): ?>
                                        <i class="far fa-star"></i>
                                    <?php else: ?>
                                        <i class="fas fa-star"></i>
                                    <?php endif; endfor; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex text-yellow-400">

                                <?php for ($i=0;$i<5;$i++): ?>
                                    <?php if ($feedback['venue_rating']<=$i): ?>
                                        <i class="far fa-star"></i>
                                    <?php else: ?>
                                        <i class="fas fa-star"></i>
                                    <?php endif; endfor; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick='viewFeedback(<?= json_encode($feedback); ?>)' class="text-indigo-600 hover:text-indigo-900">Görüntüle</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>