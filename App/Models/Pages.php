<?php

namespace App\Models;

use Core\Database;

class Pages
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Tüm sayfaları getirir.
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getAll(int $limit = 10, int $offset = 0): array
    {
        $sql = "SELECT * FROM pages ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * ID’ye göre sayfa getirir.
     *
     * @param int $id
     * @return array|null
     */
    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM pages WHERE id = :id LIMIT 1");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Slug’a göre sayfa getirir.
     *
     * @param string $slug
     * @return array|null
     */
    public function getBySlug(string $slug)
    {
        if (empty($slug)) {
            return false;
        }

        $stmt = $this->db->prepare("SELECT * FROM pages WHERE slug = :slug LIMIT 1");
        $stmt->bindParam(":slug", $slug, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: false;
    }

    /**
     * Thumbnail bilgisini getirir.
     *
     * @param int $thumbnailId
     * @return array|null
     */
    public function getThumbnail(int $thumbnailId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM attachments WHERE id = :id LIMIT 1");
        $stmt->bindParam(":id", $thumbnailId, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * ID’ye göre sayfayı ilişkili thumbnail ve component verileriyle getirir.
     *
     * @param int $id
     * @return array|null
     */
    public function getWithRelations(int $id): ?array
    {
        $page = $this->getById($id);
        if (!$page) {
            return null;
        }

        // Thumbnail
        $thumbnail = null;
        if (!empty($page['thumbnail_id'])) {
            $thumbnail = $this->getThumbnail((int)$page['thumbnail_id']);
        }

        // Components (json decode)
        $components = [];
        if (!empty($page['components'])) {
            $components = json_decode($page['components'], true) ?: [];
        }

        return [
            'page' => $page,
            'thumbnail' => $thumbnail,
            'components' => $components,
        ];
    }

    /**
     * Yeni sayfa oluşturur.
     *
     * @param array $data
     * @return int Yeni ID
     */
    public function create(array $data): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO pages (title, slug, content, thumbnail_id, components)
            VALUES (:title, :slug, :content, :thumbnail_id, :components)
        ");

        $stmt->bindParam(":title", $data['title']);
        $stmt->bindParam(":slug", $data['slug']);
        $stmt->bindParam(":content", $data['content']);
        $stmt->bindParam(":thumbnail_id", $data['thumbnail_id'], \PDO::PARAM_INT);
        $stmt->bindParam(":components", $data['components']); // JSON string bekliyor

        $stmt->execute();
        return (int)$this->db->lastInsertId();
    }

    /**
     * Sayfa günceller.
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
        $sql = "UPDATE pages SET " . implode(", ", $fields) . " WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Sayfayı siler.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM pages WHERE id = :id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
