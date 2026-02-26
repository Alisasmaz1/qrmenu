<?php

namespace App\Models;

use Core\Database;

class Feedback
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }


    /**
     * Müşteri geri bildirimini veritabanına kaydeder.
     *
     * @return array Sonuç durumu ve mesaj
     */
    public function setCustomerFeedback(): array
    {
        // Form tipi kontrolü
        if (!isset($_POST['form_type']) || $_POST['form_type'] !== 'setCustomerFeedback') {
            return ['success' => 0, 'message' => 'Geçersiz form isteği'];
        }

        // Zorunlu alan kontrolü
        $requiredFields = [
            'restoranID',
            'customerName',
            'customerComment',
            'customerMenuRating',
            'customerServiceRating',
            'customerVenueRating'
        ];

        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field])) {
                return [
                    'success' => 0,
                    'message' => "Eksik parametre: {$field}"
                ];
            }
        }

        // Verilerin alınması
        $restoranID           = (int) $_POST['restoranID'];
        $customerName         = trim($_POST['customerName']);
        $customerComment      = trim($_POST['customerComment']);
        $menuRating           = (int) $_POST['customerMenuRating'];
        $serviceRating        = (int) $_POST['customerServiceRating'];
        $venueRating          = (int) $_POST['customerVenueRating'];

        try {
            // SQL
            $stmt = $this->db->prepare("
            INSERT INTO geri_bildirim 
            (restoran_id, customer_name, customer_comment, menu_rating, service_rating, venue_rating)
            VALUES
            (:restoran_id, :customer_name, :customer_comment, :menu_rating, :service_rating, :venue_rating)
        ");

            $stmt->bindParam(':restoran_id', $restoranID, \PDO::PARAM_INT);
            $stmt->bindParam(':customer_name', $customerName, \PDO::PARAM_STR);
            $stmt->bindParam(':customer_comment', $customerComment, \PDO::PARAM_STR);
            $stmt->bindParam(':menu_rating', $menuRating, \PDO::PARAM_INT);
            $stmt->bindParam(':service_rating', $serviceRating, \PDO::PARAM_INT);
            $stmt->bindParam(':venue_rating', $venueRating, \PDO::PARAM_INT);

            $stmt->execute();

            return [
                'success' => 1,
                'message' => 'Geri bildirim başarıyla kaydedildi.',
                'insert_id' => $this->db->lastInsertId()
            ];
        } catch (\PDOException $e) {
            return [
                'success' => 0,
                'message' => 'Veritabanı hatası: ' . $e->getMessage()
            ];
        }
    }

    public function getCustomerFeedbacks(){
        $restoranID = (int) $_SESSION['user_id'];
        $sql = "SELECT * FROM `geri_bildirim` WHERE restoran_id = ? ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $query->execute([$restoranID]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }


}