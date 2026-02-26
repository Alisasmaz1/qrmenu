<?php

namespace App\Models;

use Core\Database;

class Pagination
{
    private $db;
    private $table;

    public $page;
    public $per_page;
    public $offset;
    public $validation_page=true;
    public $total_page_count;

    public function __construct(string $table,$request)
    {
        $this->db = Database::getConnection();
        $this->table = $table;

        if ($request->find('page')){
            $page = $request->request('page');
        }else{
             $page= 1;
        }

        $this->page = $page;

        if (filter_var($page, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]) !== false) {
            $this->page = $page;
        }else{
            $this->page = 1;
            $this->validation_page = false;
        }

        $this->per_page = getPerPage();

        $this->offset   = ($this->page - 1) * $this->per_page;

    }

    /**
     * Toplam get ile sayfayı kontrol eder
     *
     * @param $total_products_count : sayfa sayısı
     */
    public function checkPage(int $total_products_count,string $pagination_url="",string $req_data=""){
        $total_page = ceil($total_products_count/$this->per_page);

        if ($this->page>$total_page || !$this->validation_page){
            $href = $pagination_url.$req_data."&page=".$total_page;
            header("Location: $href");
            exit();
        }
        $this->total_page_count = $total_page;
    }

    /**
     * Toplam kayıt sayısını döndürür
     *
     * @return int
     */
    public function getTotalRecords(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return (int)$stmt->fetch(\PDO::FETCH_COLUMN);
    }

    /**
     * Belirtilen sayfaya göre kayıtları getirir
     *
     * @param int $page     Aktif sayfa
     * @param int $perPage  Sayfa başına kayıt sayısı
     * @param string $order Sıralama (örn: "id DESC")
     * @return array
     */
    public function getRecords(int $page, int $perPage, string $order = "id DESC"): array
    {
        $offset = ($page - 1) * $perPage;

        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY {$order} LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $perPage, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Sayfalama HTML çıktısı üretir
     *
     * @param int $totalRecords Toplam kayıt sayısı
     * @param int $perPage      Sayfa başına kayıt sayısı
     * @param int $currentPage  Aktif sayfa
     * @param string $baseUrl   URL prefix (örn: getSiteUrl()."/products?page=")
     * @return string
     */
    public function render(int $totalRecords, string $baseUrl, $perPage=null, $currentPage=null): string
    {
        $perPage = $perPage??$this->per_page;
        $currentPage = $currentPage??$this->page;


        if (strpos($baseUrl, "token") !== false) {
            $baseUrl = $baseUrl."&page=";
        } else {
            $baseUrl = $baseUrl."page=";
        }

        $totalPages = ceil($totalRecords / $perPage);
        if ($totalPages <= 1) {
            return '';
        }

        $html = '<div class="basic-pagination wow fadeInUp text-center mt-20" data-wow-delay=".2s">';
        $html .= '<ul>';

        // Sol ok
        if ($currentPage > 1) {
            $html .= '<li><a href="'.$baseUrl.($currentPage - 1).'"><i class="arrow_left"></i></a></li>';
        }

        // İlk sayfa
        if ($currentPage > 2) {
            $html .= '<li><a href="'.$baseUrl.'1"><span>1</span></a></li>';
        }

        // "..." kısmı
        if ($currentPage > 3) {
            $html .= '<li><a href="#"><i class="fal fa-ellipsis-h"></i></a></li>';
        }

        // Orta sayfalar
        for ($i = max(1, $currentPage - 1); $i <= min($totalPages, $currentPage + 1); $i++) {
            $active = $i == $currentPage ? ' class="active"' : '';
            $html .= '<li'.$active.'><a href="'.$baseUrl.$i.'"><span>'.$i.'</span></a></li>';
        }

        // "..." kısmı
        if ($currentPage < $totalPages - 2) {
            $html .= '<li><a href="#"><i class="fal fa-ellipsis-h"></i></a></li>';
        }

        // Son sayfa
        if ($currentPage < $totalPages - 1) {
            $html .= '<li><a href="'.$baseUrl.$totalPages.'"><span>'.$totalPages.'</span></a></li>';
        }

        // Sağ ok
        if ($currentPage < $totalPages) {
            $html .= '<li><a href="'.$baseUrl.($currentPage + 1).'"><i class="arrow_right"></i></a></li>';
        }

        $html .= '</ul></div>';

        return $html;
    }
}
