<?php

namespace App\Models;

use Core\Database;

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Tüm kategorileri getirir.
     *
     * @return array
     */
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM categories ORDER BY id DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * ID’ye göre tek bir kategori getirir.
     *
     * @param int $id
     * @return array|false
     */
    public function getById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id LIMIT 1");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: false;
    }

    /**
     * Slug’a göre kategori getirir.
     *
     * @param string $slug
     * @return array|false
     */
    public function getBySlug(string $slug)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE slug = :slug LIMIT 1");
        $stmt->bindParam(":slug", $slug, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: false;
    }

    /**
     * Kategorileri ve her kategorideki toplam ürün sayısını getirir.
     *
     * @return array
     */
    public function getAllWithProductCount(): array
    {
        $sql = "
        SELECT c.*, COUNT(p.id) AS product_count
        FROM categories c
        LEFT JOIN products p ON p.category_id = c.id
        GROUP BY c.id
        ORDER BY c.id DESC
    ";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Verilen kategori ID dizisinden sadece var olanları geri döndürür.
     *
     * @param array $categoryIds
     * @return array
     */
    public function filterExistingCategories(array $categoryIds): array
    {
        if (empty($categoryIds)) {
            return [];
        }

        // Sorguda kullanılacak placeholder dizisi oluştur
        $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));

        $stmt = $this->db->prepare("
        SELECT id 
        FROM categories 
        WHERE id IN ($placeholders)
    ");

        // PDO bindParam yerine execute ile array gönderiyoruz
        $stmt->execute($categoryIds);

        // Sonuçları sadece ID olarak al
        $existingIds = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        return $existingIds;
    }


    /**
     * Yeni bir kategori ekler.
     *
     * @param string $name
     * @param string $slug
     * @param int|null $thumbnailId
     * @param int|null $parentId
     * @return int Yeni eklenen kategori ID'si
     */
    public function create(string $name, string $slug, ?int $thumbnailId = null, ?int $parentId = null): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO categories (name, slug, thumbnail_id, parent_id) 
            VALUES (:name, :slug, :thumbnail_id, :parent_id)
        ");

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":slug", $slug);
        $stmt->bindParam(":thumbnail_id", $thumbnailId, \PDO::PARAM_INT);
        $stmt->bindParam(":parent_id", $parentId, \PDO::PARAM_INT);

        $stmt->execute();
        return (int) $this->db->lastInsertId();
    }

    /**
     * Varolan bir kategoriyi günceller.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $sql = "UPDATE categories SET " . implode(", ", $fields) . " WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Bir kategoriyi siler.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
