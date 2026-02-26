<?php

namespace App\Models;

use Core\Database;

class Product
{
    private $db;
    private $currency="TRY";
    private $currency_symbol="₺";


    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Tüm ürünleri getirir (aktif olan/olmayan opsiyonel).
     *
     * @param bool|null $onlyActive
     * @param int $limit : sql sorgusunda limit değerini getirir
     * @return array
     */
    public function getAll(?bool $onlyActive = null,int $limit = 10,int $offset = 1): array
    {
        $sql = "SELECT * FROM products";
        if ($onlyActive === true) {
            $sql .= " WHERE is_active = 1";
        } elseif ($onlyActive === false) {
            $sql .= " WHERE is_active = 0";
        }
        $sql .= " ORDER BY created_at DESC LIMIT $limit OFFSET $offset";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Tüm ürünleri ilişkili item ve attachment verileriyle birlikte getirir.
     *
     * @param bool|null $onlyActive
     * @param int $limit : sql sorgusunda limit değerini getirir
     * @return array
     */
    public function getAllWithRelations(?bool $onlyActive = null,int $limit=10,int $offset=1): array
    {
        $products = $this->getAll($onlyActive,$limit,$offset);
        $result = [];

        foreach ($products as $product) {
            $items = $this->getItems((int)$product['id']);
            $attachments = $this->getAttachments((int)$product['id']);

            // Kategori Ekleme
            $catID = $product['category_id'];
            if ($catID){
                $category = $this->getCategory($catID);
            }else{
                $category = null;
            }

            $result[] = [
                'product' => $product,
                'items' => $items,
                'category' => $category,
                'attachments' => $attachments
            ];
        }

        return $result;
    }


    /**
     * ID’ye göre ürün getirir.
     *
     * @param int $id
     * @return array|false
     */
    public function getById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Slug’a göre ürün getirir.
     *
     * @param string $slug
     * @return array|false
     */
    public function getBySlug(string $slug)
    {
        // slug boş ise sorgu yapılmasın
        if (empty($slug)) {
            return false;
        }

        $stmt = $this->db->prepare("SELECT * FROM products WHERE slug = :slug LIMIT 1");
        $stmt->bindParam(":slug", $slug, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: false;
    }

    /**
     * Ürünün item bilgilerini getirir.
     *
     * @param int $productId
     * @return array
     */
    public function getItems(int $productId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM product_items WHERE product_id = :pid");
        $stmt->bindParam(":pid", $productId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Ürün ile ilişkili attachment’leri getirir.
     * (gallery_ids veya thumbnail_id üzerinden)
     *
     * @param int $productId
     * @return array
     */
    public function getAttachments(int $productId): array
    {
        $stmt = $this->db->prepare("
        SELECT a.*, 
       CASE 
         WHEN a.id = pi.thumbnail_id THEN 'thumbnail' 
         ELSE 'gallery' 
       END AS image_type
FROM product_items pi
JOIN attachments a 
    ON a.id = pi.thumbnail_id 
    OR JSON_CONTAINS(pi.gallery_ids, CAST(a.id AS JSON), '$')
WHERE pi.product_id = :pid

");
        $stmt->bindParam(":pid", $productId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    /**
     * Ürün ile ilişkili kategoriyi getirir.
     * ($catId üzerinden)
     *
     * @param int $catId
     * @return array
     */
    public function getCategory(int $catId): array
    {
        $stmt = $this->db->prepare(" SELECT * FROM  categories WHERE id = :pid ");
        $stmt->bindParam(":pid", $catId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Ürünü ilişkili item ve attachment verileri ile birlikte getirir.
     *
     * @param int $id
     * @return array|null
     */
    public function getWithRelations(int $id): ?array
    {
        // Önce ürün bilgisini al
        $product = $this->getById($id);
        if (!$product) {
            return null;
        }

        // Items çek
        $items = $this->getItems($id);

        // Items üzerinden attachments çek
        $attachments = $this->getAttachments($id);

        // Kategori Ekleme
        $catID = $product['category_id'];
        if ($catID){
            $category = $this->getCategory($catID);
        }else{
            $category = null;
        }


        // Tek array içinde döndür
        return [
            'product' => $product,
            'items' => $items,
            'category' => $category,
            'attachments' => $attachments
        ];
    }

    /**
     * Verilen kategori ID dizisine ait ürünleri getirir.
     *
     * @param array $categoryIds
     * @return array
     */
    public function getProductsByCategories(array $categoryIds, int $perPage,int $offset,string $order = "id DESC"): array
    {
        if (empty($categoryIds)) {
            return $this->getAllWithRelations(true,$perPage,$offset);
        }

        // Sorguda kullanılacak placeholder dizisi oluştur
        $placeholders = [];
        foreach ($categoryIds as $i => $id) {
            $placeholders[] = ":cat$i";
        }
        $placeholders = implode(',', $placeholders);

        $sql = "
    SELECT * 
    FROM products 
    WHERE category_id IN ($placeholders) 
    ORDER BY {$order} LIMIT :limit OFFSET :offset
";

        $stmt = $this->db->prepare($sql);

// Kategori ID'lerini bağla
        foreach ($categoryIds as $i => $id) {
            $stmt->bindValue(":cat$i", (int)$id, \PDO::PARAM_INT);
        }

// Limit ve Offset
        $stmt->bindValue(':limit', (int)$perPage, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);

        $stmt->execute();

        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $result = [];
        foreach ($products as $product) {
            $items = $this->getItems((int)$product['id']);
            $attachments = $this->getAttachments((int)$product['id']);

            $catID = $product['category_id'];
            $category = $catID ? $this->getCategory($catID) : null;

            $result[] = [
                'product' => $product,
                'items' => $items,
                'category' => $category,
                'attachments' => $attachments
            ];
        }

        return $result;

    }


    /**
     * Verilen kategori ID dizisine ait ürün sayısını
     *
     * @param array $categoryIds
     * @return array
     */
    public function getProductsByCategoriesCount(array $categoryIds): int
    {
        if (empty($categoryIds)) {
            return false;
        }

        // Sorguda kullanılacak placeholder dizisi oluştur
        $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));

        $sql = "SELECT COUNT(*) as total FROM  products 
        WHERE category_id IN ($placeholders) 
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($categoryIds);

        return (int)$stmt->fetch(\PDO::FETCH_COLUMN);
    }


    /**
     * Classta tanımlanmış para birimini döndürür
     *
     * @return string
     */
    public function getCurrencySymbol()
    {
        return  $this->currency_symbol;
    }

    /**
     * Gelen Para Tutarını Biçimlendirir ve Para Biriminin Sembolünü Ekler
     * @param $price : ilgili tutar
     * @return string
     */
    public function getCurrencySymbolWithPrice(int $price): string
    {
        // Türkiye formatı: binlik ayırıcı nokta, ondalık ayırıcı virgül
        $formattedPrice = number_format($price, 2, ',', '.');
        return $formattedPrice . ' ' . $this->getCurrencySymbol();
    }



    /**
     * Yeni ürün ekler.
     *
     * @param array $data
     * @return int Yeni ürün ID’si
     */
    public function create(array $data): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO products (name, description, price, category_id, is_active, created_at, updated_at) 
            VALUES (:name, :description, :price, :category_id, :is_active, NOW(), NOW())
        ");

        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":description", $data['description']);
        $stmt->bindParam(":price", $data['price']);
        $stmt->bindParam(":category_id", $data['category_id'], \PDO::PARAM_INT);
        $stmt->bindParam(":is_active", $data['is_active'], \PDO::PARAM_INT);

        $stmt->execute();
        return (int)$this->db->lastInsertId();
    }

    /**
     * Yeni product_item ekler.
     *
     * @param int $productId
     * @param array $data
     * @return int Yeni item ID’si
     */
    public function addItem(int $productId, array $data): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO product_items 
            (product_id, preview_link, gallery_ids, thumbnail_id, version, framework, extra, created_at, updated_at) 
            VALUES 
            (:product_id, :preview_link, :gallery_ids, :thumbnail_id, :version, :framework, :extra, NOW(), NOW())
        ");

        $stmt->bindParam(":product_id", $productId, \PDO::PARAM_INT);
        $stmt->bindParam(":preview_link", $data['preview_link']);
        $stmt->bindParam(":gallery_ids", $data['gallery_ids']);
        $stmt->bindParam(":thumbnail_id", $data['thumbnail_id'], \PDO::PARAM_INT);
        $stmt->bindParam(":version", $data['version']);
        $stmt->bindParam(":framework", $data['framework']);
        $stmt->bindParam(":extra", $data['extra']);

        $stmt->execute();
        return (int)$this->db->lastInsertId();
    }

    /**
     * Ürünü günceller.
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
        $sql = "UPDATE products SET " . implode(", ", $fields) . ", updated_at = NOW() WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Ürün ve bağlı item’lerini siler.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        // Önce product_items sil
        $stmtItems = $this->db->prepare("DELETE FROM product_items WHERE product_id = :pid");
        $stmtItems->bindParam(":pid", $id, \PDO::PARAM_INT);
        $stmtItems->execute();

        // Sonra ürün sil
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
