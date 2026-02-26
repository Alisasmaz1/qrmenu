<?php

namespace App\Models;

use Core\Database;

class Faq
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /* ==========================
       KATEGORİ İŞLEMLERİ
       ========================== */

    /**
     * Tüm kategorileri getirir.
     *
     * @return array
     */
    public function getAllCategories(): array
    {
        $stmt = $this->db->query("SELECT * FROM faq_categories ORDER BY name ASC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * ID’ye göre kategori getirir.
     *
     * @param int $id
     * @return array|false
     */
    public function getCategoryById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM faq_categories WHERE id = :id LIMIT 1");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: false;
    }

    /**
     * Bir veya birden fazla kategori slug'ına ait SSS'leri getirir.
     *
     * @param string|array $slugs Tek bir slug (string) veya slug dizisi (array)
     * @return array
     */
    public function getFaqsByCategorySlugs($slugs): array
    {
        // Tek string gelirse diziye çevir
        if (is_string($slugs)) {
            $slugs = [$slugs];
        }

        // Dinamik placeholder üret
        $placeholders = implode(',', array_fill(0, count($slugs), '?'));

        $sql = "
            SELECT f.id, f.question, f.answer, f.is_active, f.created_at, f.updated_at, 
                   c.name AS category_name, c.slug AS category_slug
            FROM faqs f
            JOIN faq_categories c ON f.category_id = c.id
            WHERE c.slug IN ($placeholders) AND f.is_active = 1
            ORDER BY f.created_at DESC
        ";

        $stmt = $this->db->prepare($sql);

        // Dizideki slug’ları sırayla bağla
        foreach ($slugs as $index => $slug) {
            $stmt->bindValue($index + 1, $slug, \PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Belirtilen kategori ID'lerine ait FAQ sorularını getirir.
     *
     * @param array|int $categoryIds Tek bir kategori ID'si veya kategori ID'leri dizisi
     * @return array
     */
    public function getByCategoryIds($categoryIds): array
    {
        if (is_array($categoryIds)) {
            // Virgüllü stringe dönüştür
            $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));
            $sql = "SELECT f.id, f.question, f.answer, c.name as category_name
                    FROM faqs f
                    JOIN faq_categories c ON f.category_id = c.id
                    WHERE f.category_id IN ($placeholders)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($categoryIds);
        } else {
            // Tek kategori ID
            $sql = "SELECT f.id, f.question, f.answer, c.name as category_name
                    FROM faqs f
                    JOIN faq_categories c ON f.category_id = c.id
                    WHERE f.category_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$categoryIds]);
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }



    /**
     * Yeni kategori ekler.
     *
     * @param string $name
     * @param string $slug
     * @return int Yeni kategori ID'si
     */
    public function createCategory(string $name, string $slug): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO faq_categories (name, slug, created_at) 
            VALUES (:name, :slug, NOW())
        ");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":slug", $slug);
        $stmt->execute();
        return (int)$this->db->lastInsertId();
    }

    /**
     * Kategori günceller.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateCategory(int $id, array $data): bool
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $sql = "UPDATE faq_categories SET " . implode(", ", $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Kategori siler.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM faq_categories WHERE id = :id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    /* ==========================
       SORU İŞLEMLERİ
       ========================== */

    /**
     * Tüm soruları getirir (kategori ile birlikte).
     *
     * @return array
     */
    public function getAllFaqs(): array
    {
        $stmt = $this->db->query("
            SELECT f.*, c.name AS category_name 
            FROM faqs f
            JOIN faq_categories c ON f.category_id = c.id
            ORDER BY f.created_at DESC
        ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * ID’ye göre tek soru getirir.
     *
     * @param int $id
     * @return array|false
     */
    public function getFaqById(int $id)
    {
        $stmt = $this->db->prepare("
            SELECT f.*, c.name AS category_name 
            FROM faqs f
            JOIN faq_categories c ON f.category_id = c.id
            WHERE f.id = :id LIMIT 1
        ");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: false;
    }

    /**
     * Yeni S.S.S sorusu ekler.
     *
     * @param int $category_id
     * @param string $question
     * @param string $answer
     * @param int $is_active
     * @return int Yeni S.S.S ID'si
     */
    public function createFaq(int $category_id, string $question, string $answer, int $is_active = 1): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO faqs (category_id, question, answer, is_active, created_at, updated_at) 
            VALUES (:category_id, :question, :answer, :is_active, NOW(), NOW())
        ");
        $stmt->bindParam(":category_id", $category_id, \PDO::PARAM_INT);
        $stmt->bindParam(":question", $question);
        $stmt->bindParam(":answer", $answer);
        $stmt->bindParam(":is_active", $is_active, \PDO::PARAM_INT);

        $stmt->execute();
        return (int)$this->db->lastInsertId();
    }

    /**
     * Soru günceller.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateFaq(int $id, array $data): bool
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $sql = "UPDATE faqs SET " . implode(", ", $fields) . ", updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Soru siler.
     *
     * @param int $id
     * @return bool
     */
    public function deleteFaq(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM faqs WHERE id = :id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
