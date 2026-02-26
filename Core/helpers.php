<?php
/**
 * MIT License
 * Copyright (c) 2020 Vaibhav Kubre
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

use Core\Skeleton;
use Core\ResponseFactory;
use Core\Config;
use App\Models\Product;
use App\Models\Attachment;
use App\Models\Faq;

if (!function_exists('view')) {
    function view($views, $data = [])
    {
        return ResponseFactory::view($views, app()->getConfig(), $data);
    }

}

if (!function_exists('json')) {
    function json($data, $options = 0, $depth = 512)
    {
        return ResponseFactory::json($data, $options, $depth);
    }
}

if (!function_exists('session_on_demand')) {
    function session_on_demand()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}

if (!function_exists('session')) {
    function session($key, ...$value)
    {
        session_on_demand();
        if (1 == count($value)) {
            $_SESSION[$key] = $value[0];
        }
        return $_SESSION[$key] ?? null;
    }
}

if (!function_exists('auth')) {
    /**
     * Get or Set user object in session
     *
     * @param \App\Models\User ...$user
     * @return \App\Models\User
     */
    function auth(...$user)
    {
        if (1 == count($user)) {
            session('user_auth', $user[0]) ;
        }
        $model = 'App\\Models\\'.app()->getConfig()['user_model'];
        return session('user_auth') ?? new $model;
    }
}


if (!function_exists('getPrice')) {
    /**
     * ücreti para birimi ile geri döndürür
     * @param int $price : ürün tuarı
     * @return \App\Models\Product ...$currency_symbol
     */
    function getPrice(int $price):string
    {
        $productModel = new Product();
        return $productModel->getCurrencySymbolWithPrice($price);
    }
}


if (!function_exists('getAttachment')) {
    /**
     * id değerine göre dosya döndürür
     * @param int $id : belge id
     * @return \App\Models\Attachment ... getById
     */
    function getAttachment(int $id)
    {
        $attachmentModel = new Attachment();
        return $attachmentModel->getById($id);
    }
}


if (!function_exists('getFaqsByCategoryIds')) {
    /**
     * Belirtilen kategori ID'lerine ait FAQ sorularını getirir.
     * Sadece question ve answer keylerini içeren bir dizi döndürür.
     *
     * @param array|int $categoryIds Tek bir ID veya ID dizisi
     * @return array
     */
    function getFaqsByCategoryIds($categoryIds): array
    {
        // Faq modelini çağır
        $faqModel = new Faq();

        //string to array dönüşümü
        $categoryIds = explode(',', $categoryIds);


        // Modelden veriyi al
        $faqs = $faqModel->getByCategoryIds($categoryIds);

        // Sadece question ve answer keylerini al
        $result = [];
        foreach ($faqs as $faq) {
            $result[] = [
                'question' => $faq['question'],
                'answer'   => $faq['answer']
            ];
        }

        return $result;
    }
}


if (!function_exists('paginate')) {
    /**
     * Sayfalama linklerini üretir
     *
     * @param int $totalRecords Toplam kayıt sayısı
     * @param int $perPage      Sayfa başına kayıt
     * @param int $currentPage  Şu anki sayfa
     * @param string $baseUrl   Sayfa url (örn: getSiteUrl()."/products?page=")
     * @return string
     */
    function paginate(int $totalRecords, int $perPage, int $currentPage, string $baseUrl): string
    {
        $totalPages = ceil($totalRecords / $perPage);
        if ($totalPages <= 1) return '';

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

        // Orta sayfalar (mevcut sayfanın yakınları)
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


if (!function_exists('getPerPage')) {
    /**
     * Web Sitede gösterilecek kayıt saysısı / sayfa başına
     * @return int : kayıt saysısı
     */
    function getPerPage():int
    {
        $config = new Config();
        return $config::PER_PAGE;
    }
}

if (!function_exists('getSiteUrl')) {
    /**
     * Web Site URL döndürür
     * @return string : url
     */
    function getSiteUrl():string
    {
        $config = new Config();
        return $config::SITE_URL;
    }
}

if (!function_exists('getFormattedDate')) {
    /**
     * Verilen datetime değerini Türkçe formatta döndürür.
     * Örn: 2025-08-26 19:42:16 -> 26 Ağustos 2025
     *
     * @param string $datetime
     * @return string
     */
    function getFormattedDate(string $datetime): string
    {
        // Türkçe ay isimleri
        $months = [
            "01" => "Ocak",
            "02" => "Şubat",
            "03" => "Mart",
            "04" => "Nisan",
            "05" => "Mayıs",
            "06" => "Haziran",
            "07" => "Temmuz",
            "08" => "Ağustos",
            "09" => "Eylül",
            "10" => "Ekim",
            "11" => "Kasım",
            "12" => "Aralık"
        ];

        $date = date_create($datetime);
        if (!$date) {
            return '';
        }

        $day   = $date->format("d");
        $month = $months[$date->format("m")];
        $year  = $date->format("Y");

        return "{$day} {$month} {$year}";
    }
}

if (!function_exists('renderSafeHtml')) {
    /**
     * Güvenli HTML render etme fonksiyonu
     *
     * @param string $html
     * @return string
     */
    function renderSafeHtml(string $html): string
    {
        // İzin verilen HTML tagları
        $allowed_tags = '<p><h2><h3><ul><ol><li><table><thead><tbody><tr><th><td><strong><em><div>';

        // Zararlı etiketleri temizleyerek güvenli şekilde döndür
        return strip_tags($html, $allowed_tags);
    }
}

if (!function_exists('getPostThumbnail')) {
    /**
     * Thumbnail Resmini Build eder
     *
     * @param array $thumbnail
     * @param int $width
     * @param int $height
     * @return string
     */
    function getPostThumbnail(array $thumbnail,?int $width=null,?int $height=null): string
    {
        if (!isset($thumbnail['id'])){
            return '';
        }

        $img_tag = "<img src='".$thumbnail["file_path"]."' alt='".$thumbnail["description"]."' title='".$thumbnail["title"]."' ";

        if (!empty($width)){
            $img_tag.=" width='$width' ";
        }

        if (!empty($height)){
            $img_tag.=" height='$height' ";
        }

        $img_tag.=">";

        // Zararlı etiketleri temizleyerek güvenli şekilde döndür
        return $img_tag;
    }
}
if (!function_exists('getDefaultThumbnail')) {
    /**
     * Thumbnail Resmini Build eder
     *
     * @param string $text : Resim Üçerisindeki Yazı
     * @param int $width
     * @param int $height
     * @return string
     */
    function getDefaultThumbnail(string $text,?int $width,?int $height): string
    {

        $duzenlenmis = str_replace(" ", "+", $text);
        $img_tag='<img src="https://placehold.co/'.$width.'x'.$height.'/CCCCCC/333333?text='.$duzenlenmis.'" alt="product-details-placeholder">';

        // Zararlı etiketleri temizleyerek güvenli şekilde döndür
        return $img_tag;
    }
}




if (!function_exists('getPermalink')) {
    /**
     * slug'a göre link oluşturur
     * @param string $slug : ürün , yazı , post ait slug
     * @return string : url
     */
    function getPermalink(string $slug,string $method="/"):string
    {
        $site_url = getSiteUrl();

        $permalinks = [
          'HomePage'=>'',
          'ProductPage'=>'/products/view/',
          'ProductsPage'=>'/products/',
          'CategoryPage'=>'/products/cat/',
        ];

        if (isset($permalinks[$method])){
            $method=$permalinks[$method];
        }


        return $site_url.$method.$slug;
    }
}

if (!function_exists('app')) {
    function app()
    {
        return Skeleton::getInstance();
    }
}
