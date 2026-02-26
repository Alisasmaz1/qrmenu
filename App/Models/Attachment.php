<?php

namespace App\Models;

use Core\Database;

class Attachment
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Tüm attachment kayıtlarını getirir.
     *
     * @return array
     */
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM attachments ORDER BY upload_date DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * ID’ye göre tek bir attachment kaydı getirir.
     *
     * @param int $id
     * @return array|false
     */
    public function getById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM attachments WHERE id = :id LIMIT 1");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC)?:false;
    }

    /**
     * Yeni bir attachment ekler.
     *
     * @param string $title
     * @param string|null $description
     * @param string $filePath
     * @param string $fileName
     * @param string $fileType
     * @param int $fileSize
     * @return int Yeni eklenen attachment ID'si
     */
    public function create(
        string $title,
        ?string $description,
        string $filePath,
        string $fileName,
        string $fileType,
        int $fileSize
    ): int {
        $stmt = $this->db->prepare("
            INSERT INTO attachments (title, description, file_path, file_name, file_type, file_size, upload_date) 
            VALUES (:title, :description, :file_path, :file_name, :file_type, :file_size, NOW())
        ");

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":file_path", $filePath);
        $stmt->bindParam(":file_name", $fileName);
        $stmt->bindParam(":file_type", $fileType);
        $stmt->bindParam(":file_size", $fileSize);

        $stmt->execute();
        return (int) $this->db->lastInsertId();
    }

    /**
     * Varolan bir attachment kaydını günceller.
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
        $sql = "UPDATE attachments SET " . implode(", ", $fields) . " WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Bir attachment kaydını siler.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM attachments WHERE id = :id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
