 <style>

        .sidebar .nav-link {
            color: #252930;
        }
        .sidebar .nav-link:hover {
            color: #15a362;
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #15a362;
        }
        .content-section {
            display: none;
        }
        .content-section.active {
            display: block;
        }
        .form-part {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }
        .preview-container {
            border: 1px dashed #ced4da;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }
        .dynamic-item {
            position: relative;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .dynamic-item .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            color: #dc3545;
            cursor: pointer;
        }
        .tab-pane {
            padding: 20px 0;
        }
        .color-input {
            width: 50px;
            height: 35px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>


<div class="container">
    <div class="d-grid">
        <!-- Sidebar -->
        <nav class="  d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav  bg-white rounded text-dark">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-section="hero">
                            <i class="fas fa-home me-2"></i> Hero Alanı
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="categories">
                            <i class="fas fa-th-large me-2"></i> Kategoriler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="products">
                            <i class="fas fa-shopping-bag me-2"></i> Ürünler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="services">
                            <i class="fas fa-concierge-bell me-2"></i> Hizmetler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="pricing">
                            <i class="fas fa-tags me-2"></i> Fiyatlandırma
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="testimonials">
                            <i class="fas fa-quote-right me-2"></i> Yorumlar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="subscribe">
                            <i class="fas fa-envelope me-2"></i> Abonelik
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="blog">
                            <i class="fas fa-blog me-2"></i> Blog
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class=" px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h5">Anasayfa İçerik Yönetimi</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="saveAll">
                            <i class="fas fa-save me-1"></i> Tümünü Kaydet
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hero Section Form -->
            <div class="content-section active" id="hero-content">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">General</h3>
                        <div class="section-intro">Settings section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="help.html">Learn more</a></div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="app-card-body">
                                <form class="settings-form">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Business Name<span class="ms-2" data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
  <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"></path>
  <circle cx="8" cy="4.5" r="1"></circle>
</svg></span></label>
                                        <input type="text" class="form-control" id="setting-input-1" value="Lorem Ipsum Ltd." required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Contact Name</label>
                                        <input type="text" class="form-control" id="setting-input-2" value="Steve Doe" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Business Email Address</label>
                                        <input type="email" class="form-control" id="setting-input-3" value="hello@companywebsite.com">
                                    </div>
                                    <button type="submit" class="btn app-btn-primary">Save Changes</button>
                                </form>
                            </div><!--//app-card-body-->

                        </div><!--//app-card-->
                    </div>
                </div>
                <h3 class="mb-4">Hero Alanı Ayarları</h3>

                <div class="form-part">
                    <h5>Arka Plan Ayarları</h5>
                    <div class="mb-3">
                        <label for="hero-bg" class="form-label">Arka Plan Görseli</label>
                        <input type="file" class="form-control" id="hero-bg">
                        <div class="form-text">Mevcut: assets/img/hero/sl-bg.jpg</div>
                    </div>
                    <div class="mb-3">
                        <label for="hero-bg-color" class="form-label">Arka Plan Rengi</label>
                        <input type="color" class="form-control color-input" id="hero-bg-color" value="#f8f9fa">
                    </div>
                </div>

                <div class="form-part">
                    <h5>İçerik Ayarları</h5>
                    <div class="mb-3">
                        <label for="hero-title" class="form-label">Başlık</label>
                        <textarea class="form-control" id="hero-title" rows="2">The Best Digital WooCommerce Markteplace.</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="hero-description" class="form-label">Açıklama</label>
                        <textarea class="form-control" id="hero-description" rows="2">The bee's knees pardon you plastered it's all gone to pot cheeky bugger wind up down.</textarea>
                    </div>
                </div>

                <div class="form-part">
                    <h5>Arama Formu</h5>
                    <div class="mb-3">
                        <label for="search-placeholder" class="form-label">Arama Yer Tutucu Metin</label>
                        <input type="text" class="form-control" id="search-placeholder" value="Search for templates">
                    </div>
                    <div class="mb-3">
                        <label for="search-button-text" class="form-label">Buton Metni</label>
                        <input type="text" class="form-control" id="search-button-text" value="search">
                    </div>
                </div>

                <div class="preview-container">
                    <h5>Önizleme</h5>
                    <div class="hero__area hero__height hero__height-2 grey-bg-3 d-flex align-items-center" style="background-image: url('https://via.placeholder.com/1200x400');">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xxl-9 col-xl-10 col-lg-11 col-md-12 col-sm-12">
                                    <div class="hero__content hero__content-white text-center">
                                        <h2 class="hero__title">The Best Digital WooCommerce Markteplace.</h2>
                                        <p>The bee's knees pardon you plastered it's all gone to pot cheeky bugger wind up down.</p>
                                        <div class="hero__search">
                                            <form action="#">
                                                <div class="hero__search-inner hero__search-3 d-md-flex align-items-center">
                                                    <div class="hero__search-input">
                                                        <span><i class="far fa-search"></i></span>
                                                        <input type="text" placeholder="Search for templates">
                                                    </div>
                                                    <button type="submit" class="m-btn ml-20"> <span></span> search</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Section Form -->
            <div class="content-section" id="categories-content">
                <h3 class="mb-4">Kategori Ayarları</h3>

                <div class="mb-4">
                    <button type="button" class="btn btn-primary" id="addCategory">
                        <i class="fas fa-plus me-1"></i> Yeni Kategori Ekle
                    </button>
                </div>

                <div id="categories-container">
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Kategori 1</h5>
                        <div class="mb-3">
                            <label class="form-label">İkon</label>
                            <input type="file" class="form-control category-icon">
                            <div class="form-text">Mevcut: assets/img/icon/magento.svg</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control category-title" value="Magento">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Öğe Sayısı</label>
                            <input type="text" class="form-control category-count" value="200k Items">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link</label>
                            <input type="text" class="form-control category-link" value="product.html">
                        </div>
                    </div>

                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Kategori 2</h5>
                        <div class="mb-3">
                            <label class="form-label">İkon</label>
                            <input type="file" class="form-control category-icon">
                            <div class="form-text">Mevcut: assets/img/icon/prestashop.png</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control category-title" value="Prestashop">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Öğe Sayısı</label>
                            <input type="text" class="form-control category-count" value="12k Items">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link</label>
                            <input type="text" class="form-control category-link" value="product.html">
                        </div>
                    </div>

                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Kategori 3</h5>
                        <div class="mb-3">
                            <label class="form-label">İkon</label>
                            <input type="file" class="form-control category-icon">
                            <div class="form-text">Mevcut: assets/img/icon/wordpress.svg</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control category-title" value="WordPress Themes">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Öğe Sayısı</label>
                            <input type="text" class="form-control category-count" value="500k Items">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link</label>
                            <input type="text" class="form-control category-link" value="product.html">
                        </div>
                    </div>

                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Kategori 4</h5>
                        <div class="mb-3">
                            <label class="form-label">İkon</label>
                            <input type="file" class="form-control category-icon">
                            <div class="form-text">Mevcut: assets/img/icon/shopify.svg</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control category-title" value="shopify">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Öğe Sayısı</label>
                            <input type="text" class="form-control category-count" value="10k Items">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link</label>
                            <input type="text" class="form-control category-link" value="product.html">
                        </div>
                    </div>
                </div>

                <div class="preview-container">
                    <h5>Önizleme</h5>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="mt_cat shadow">
                                <div class="mt_cat_avater">
                                    <img src="https://via.placeholder.com/60x60" class="img-fluid" alt="">
                                </div>
                                <div class="mt_cat_caps">
                                    <h3 class="mt_cat_title"><a href="#">Magento</a></h3>
                                    <span>200k Items</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="mt_cat shadow">
                                <div class="mt_cat_avater">
                                    <img src="https://via.placeholder.com/60x60" class="img-fluid" alt="">
                                </div>
                                <div class="mt_cat_caps">
                                    <h3 class="mt_cat_title"><a href="#">Prestashop</a></h3>
                                    <span>12k Items</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="mt_cat shadow">
                                <div class="mt_cat_avater">
                                    <img src="https://via.placeholder.com/60x60" class="img-fluid" alt="">
                                </div>
                                <div class="mt_cat_caps">
                                    <h3 class="mt_cat_title"><a href="#">WordPress Themes</a></h3>
                                    <span>500k Items</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="mt_cat shadow">
                                <div class="mt_cat_avater">
                                    <img src="https://via.placeholder.com/60x60" class="img-fluid" alt="">
                                </div>
                                <div class="mt_cat_caps">
                                    <h3 class="mt_cat_title"><a href="#">shopify</a></h3>
                                    <span>10k Items</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Section Form -->
            <div class="content-section" id="products-content">
                <h3 class="mb-4">Ürün Ayarları</h3>

                <div class="form-part">
                    <h5>Başlık Ayarları</h5>
                    <div class="mb-3">
                        <label for="products-title" class="form-label">Ana Başlık</label>
                        <input type="text" class="form-control" id="products-title" value="Check Out Our Newest Item">
                    </div>
                    <div class="mb-3">
                        <label for="products-subtitle" class="form-label">Alt Başlık</label>
                        <input type="text" class="form-control" id="products-subtitle" value="Find over 7000 website templates and themes.">
                    </div>
                </div>

                <div class="form-part">
                    <h5>Sekme Ayarları</h5>
                    <div id="tabs-container">
                        <div class="dynamic-item">
                            <span class="remove-btn"><i class="fas fa-times"></i></span>
                            <div class="mb-3">
                                <label class="form-label">Sekme Adı</label>
                                <input type="text" class="form-control tab-name" value="All">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sekme ID</label>
                                <input type="text" class="form-control tab-id" value="nav-all">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input tab-active" type="radio" name="tab-active" checked>
                                <label class="form-check-label">Aktif Sekme</label>
                            </div>
                        </div>

                        <div class="dynamic-item">
                            <span class="remove-btn"><i class="fas fa-times"></i></span>
                            <div class="mb-3">
                                <label class="form-label">Sekme Adı</label>
                                <input type="text" class="form-control tab-name" value="Template">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sekme ID</label>
                                <input type="text" class="form-control tab-id" value="nav-template">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input tab-active" type="radio" name="tab-active">
                                <label class="form-check-label">Aktif Sekme</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="button" class="btn btn-primary" id="addTab">
                            <i class="fas fa-plus me-1"></i> Yeni Sekme Ekle
                        </button>
                    </div>
                </div>

                <div class="form-part">
                    <h5>Ürünler</h5>
                    <div class="mb-3">
                        <label for="product-tab-select" class="form-label">Sekme Seç</label>
                        <select class="form-select" id="product-tab-select">
                            <option value="nav-all">All</option>
                            <option value="nav-template">Template</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="addProduct">
                            <i class="fas fa-plus me-1"></i> Yeni Ürün Ekle
                        </button>
                    </div>

                    <div id="products-container">
                        <div class="dynamic-item">
                            <span class="remove-btn"><i class="fas fa-times"></i></span>
                            <h5>Ürün 1</h5>
                            <div class="mb-3">
                                <label class="form-label">Ürün Görseli</label>
                                <input type="file" class="form-control product-image">
                                <div class="form-text">Mevcut: assets/img/icon/thumb/icon/th-20.png</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Önizleme Görseli</label>
                                <input type="file" class="form-control product-preview">
                                <div class="form-text">Mevcut: assets/img/icon/thumb/preview/preview-1.png</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fiyat</label>
                                <input type="text" class="form-control product-price" value="39.00">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <input type="text" class="form-control product-category" value="WordPress">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Yazar</label>
                                <input type="text" class="form-control product-author" value="Theme_Pure">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alt Metin</label>
                                <input type="text" class="form-control product-alt" value="Markite - Digital Marketplace WordPress Theme">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="preview-container">
                    <h5>Önizleme</h5>
                    <div class="section__title-wrapper text-center mb-60">
                        <h2 class="section__title">Check Out Our Newest Item</h2>
                        <p>Find over 7000 website templates and themes.</p>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="template-tab" data-bs-toggle="tab" data-bs-target="#template" type="button" role="tab" aria-controls="template" aria-selected="false">Template</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            <div class="row justify-content-center g-0">
                                <div class="col-auto">
                                    <div class="product_new_item">
                                        <a href="#">
                                            <div class="site-preview"></div>
                                            <img src="https://via.placeholder.com/150x150" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="product_new_item">
                                        <a href="#">
                                            <div class="site-preview"></div>
                                            <img src="https://via.placeholder.com/150x150" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="template" role="tabpanel" aria-labelledby="template-tab">
                            <div class="row justify-content-center g-0">
                                <div class="col-auto">
                                    <div class="product_new_item">
                                        <a href="#">
                                            <div class="site-preview"></div>
                                            <img src="https://via.placeholder.com/150x150" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Section Form -->
            <div class="content-section" id="services-content">
                <h3 class="mb-4">Hizmetler Ayarları</h3>

                <div class="form-part">
                    <h5>Başlık Ayarları</h5>
                    <div class="mb-3">
                        <label for="services-title" class="form-label">Ana Başlık</label>
                        <input type="text" class="form-control" id="services-title" value="The only one Template you need">
                    </div>
                    <div class="mb-3">
                        <label for="services-subtitle" class="form-label">Alt Başlık</label>
                        <input type="text" class="form-control" id="services-subtitle" value="From multipurpose themes to niche templates">
                    </div>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-primary" id="addService">
                        <i class="fas fa-plus me-1"></i> Yeni Hizmet Ekle
                    </button>
                </div>

                <div id="services-container">
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Hizmet 1</h5>
                        <div class="mb-3">
                            <label class="form-label">İkon</label>
                            <input type="file" class="form-control service-icon">
                            <div class="form-text">Mevcut: assets/img/icon/services/services-1.svg</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">İkon Arka Plan Rengi</label>
                            <input type="color" class="form-control color-input service-bg-color" value="#007bff">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control service-title" value="No Risk, Double Guarantee">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Açıklama</label>
                            <textarea class="form-control service-description" rows="2">Haggle down the pub off his nut arse bog bits and bobs bugger.</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Metni</label>
                            <input type="text" class="form-control service-link-text" value="Learn More">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link URL</label>
                            <input type="text" class="form-control service-link-url" value="#">
                        </div>
                    </div>

                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Hizmet 2</h5>
                        <div class="mb-3">
                            <label class="form-label">İkon</label>
                            <input type="file" class="form-control service-icon">
                            <div class="form-text">Mevcut: assets/img/icon/services/services-2.svg</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">İkon Arka Plan Rengi</label>
                            <input type="color" class="form-control color-input service-bg-color" value="#e83e8c">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control service-title" value="Flexible Prices no Surprises">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Açıklama</label>
                            <textarea class="form-control service-description" rows="2">Haggle down the pub off his nut arse bog bits and bobs bugger.</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Metni</label>
                            <input type="text" class="form-control service-link-text" value="Learn More">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link URL</label>
                            <input type="text" class="form-control service-link-url" value="about.html">
                        </div>
                    </div>
                </div>

                <div class="preview-container">
                    <h5>Önizleme</h5>
                    <div class="section__title-wrapper mb-50 text-center">
                        <h2 class="section__title">The only one Template you need</h2>
                        <p>From multipurpose themes to niche templates</p>
                    </div>

                    <div class="row">
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                            <div class="services__item white-bg mb-30">
                                <div class="services__icon mb-45">
                                        <span style="background-color: #007bff;">
                                            <img src="https://via.placeholder.com/60x60" alt="">
                                        </span>
                                </div>
                                <div class="services__content">
                                    <h3 class="services__title"><a href="#">No Risk, Double Guarantee</a></h3>
                                    <p>Haggle down the pub off his nut arse bog bits and bobs bugger.</p>
                                    <a href="#" class="link-btn"><i class="arrow_right"></i>Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                            <div class="services__item white-bg mb-30">
                                <div class="services__icon mb-45">
                                        <span style="background-color: #e83e8c;">
                                            <img src="https://via.placeholder.com/60x60" alt="">
                                        </span>
                                </div>
                                <div class="services__content">
                                    <h3 class="services__title"><a href="about.html">Flexible Prices no Surprises</a></h3>
                                    <p>Haggle down the pub off his nut arse bog bits and bobs bugger.</p>
                                    <a href="about.html" class="link-btn"><i class="far fa-long-arrow-right"></i>Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing Section Form -->
            <div class="content-section" id="pricing-content">
                <h3 class="mb-4">Fiyatlandırma Ayarları</h3>

                <div class="form-part">
                    <h5>Başlık Ayarları</h5>
                    <div class="mb-3">
                        <label for="pricing-title" class="form-label">Ana Başlık</label>
                        <input type="text" class="form-control" id="pricing-title" value="Our Pricing We provide flexible plan">
                    </div>
                    <div class="mb-3">
                        <label for="pricing-subtitle" class="form-label">Alt Başlık</label>
                        <input type="text" class="form-control" id="pricing-subtitle" value="Thousands of Markit Brands have made the swich.">
                    </div>
                </div>

                <div class="form-part">
                    <h5>Sekme Ayarları</h5>
                    <div class="mb-3">
                        <label for="pricing-tab-1" class="form-label">Sekme 1 Adı</label>
                        <input type="text" class="form-control" id="pricing-tab-1" value="monthly">
                    </div>
                    <div class="mb-3">
                        <label for="pricing-tab-2" class="form-label">Sekme 2 Adı</label>
                        <input type="text" class="form-control" id="pricing-tab-2" value="yearly">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pricing-default-tab" checked>
                        <label class="form-check-label" for="pricing-default-tab">
                            Sekme 1'i Varsayılan Yap
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-primary" id="addPricingPlan">
                        <i class="fas fa-plus me-1"></i> Yeni Plan Ekle
                    </button>
                </div>

                <div id="pricing-container">
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Plan 1</h5>
                        <div class="mb-3">
                            <label class="form-label">Plan Adı</label>
                            <input type="text" class="form-control pricing-plan-name" value="Personal">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Plan Açıklaması</label>
                            <input type="text" class="form-control pricing-plan-desc" value="What You Are Looking For!">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fiyat</label>
                            <input type="text" class="form-control pricing-plan-price" value="26">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Buton Metni</label>
                            <input type="text" class="form-control pricing-plan-button" value="Buy Now">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Özellikler (Her özelliği yeni satıra yazın)</label>
                            <textarea class="form-control pricing-plan-features" rows="5">Powerful Admin Panel
1 Native Android App
Multi-Language Support
Free SSL Certificate
1X Allocated Resources</textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input pricing-plan-featured" type="checkbox">
                            <label class="form-check-label">Öne Çıkan Plan</label>
                        </div>
                    </div>

                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Plan 2</h5>
                        <div class="mb-3">
                            <label class="form-label">Plan Adı</label>
                            <input type="text" class="form-control pricing-plan-name" value="Professional">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Plan Açıklaması</label>
                            <input type="text" class="form-control pricing-plan-desc" value="What You Are Looking For!">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fiyat</label>
                            <input type="text" class="form-control pricing-plan-price" value="44">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Buton Metni</label>
                            <input type="text" class="form-control pricing-plan-button" value="Buy Now">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Özellikler (Her özelliği yeni satıra yazın)</label>
                            <textarea class="form-control pricing-plan-features" rows="5">Powerful Admin Panel
1 Native Android App
Multi-Language Support
Free SSL Certificate
1X Allocated Resources</textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input pricing-plan-featured" type="checkbox">
                            <label class="form-check-label">Öne Çıkan Plan</label>
                        </div>
                    </div>
                </div>

                <div class="preview-container">
                    <h5>Önizleme</h5>
                    <div class="page__title-wrapper text-center mb-50">
                        <h2 class="page__title-2">Our Pricing We provide flexible plan</h2>
                        <p>Thousands of Markit Brands have made the swich.</p>
                    </div>

                    <ul class="nav nav-tabs justify-content-center" id="priceTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly" type="button" role="tab" aria-controls="monthly" aria-selected="true">monthly</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="yearly-tab" data-bs-toggle="tab" data-bs-target="#yearly" type="button" role="tab" aria-controls="yearly" aria-selected="false">yearly</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="priceTabContent">
                        <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                            <div class="row">
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="pricing__item text-center white-bg transition-3 mb-30">
                                        <div class="pricing__header mb-25">
                                            <h3>Personal</h3>
                                            <p>What You Are Looking For!</p>
                                        </div>
                                        <div class="pricing__tag d-flex align-items-start justify-content-center mb-30">
                                            <span>$</span>
                                            <h4>26</h4>
                                        </div>
                                        <div class="pricing__buy mb-20">
                                            <a href="#" class="m-btn m-btn-border m-btn-border-5 w-100">Buy Now</a>
                                        </div>
                                        <div class="pricing__features text-start">
                                            <ul>
                                                <li>Powerful Admin Panel</li>
                                                <li>1 Native Android App</li>
                                                <li>Multi-Language Support</li>
                                                <li>Free SSL Certificate</li>
                                                <li>1X Allocated Resources</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="pricing__item text-center white-bg transition-3 mb-30">
                                        <div class="pricing__header mb-25">
                                            <h3>Professional</h3>
                                            <p>What You Are Looking For!</p>
                                        </div>
                                        <div class="pricing__tag d-flex align-items-start justify-content-center mb-30">
                                            <span>$</span>
                                            <h4>44</h4>
                                        </div>
                                        <div class="pricing__buy mb-20">
                                            <a href="#" class="m-btn m-btn-border m-btn-border-5 w-100">Buy Now</a>
                                        </div>
                                        <div class="pricing__features text-start">
                                            <ul>
                                                <li>Powerful Admin Panel</li>
                                                <li>1 Native Android App</li>
                                                <li>Multi-Language Support</li>
                                                <li>Free SSL Certificate</li>
                                                <li>1X Allocated Resources</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonials Section Form -->
            <div class="content-section" id="testimonials-content">
                <h3 class="mb-4">Müşteri Yorumları Ayarları</h3>

                <div class="form-part">
                    <h5>Başlık Ayarları</h5>
                    <div class="mb-3">
                        <label for="testimonials-title" class="form-label">Ana Başlık</label>
                        <input type="text" class="form-control" id="testimonials-title" value="What our Customers have to say">
                    </div>
                    <div class="mb-3">
                        <label for="testimonials-subtitle" class="form-label">Alt Başlık</label>
                        <input type="text" class="form-control" id="testimonials-subtitle" value="Curabitur lacus arcu, sodales in quam sed, commodo efficitur ligula.">
                    </div>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-primary" id="addTestimonial">
                        <i class="fas fa-plus me-1"></i> Yeni Yorum Ekle
                    </button>
                </div>

                <div id="testimonials-container">
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Yorum 1</h5>
                        <div class="mb-3">
                            <label class="form-label">Müşteri Fotoğrafı</label>
                            <input type="file" class="form-control testimonial-avatar">
                            <div class="form-text">Mevcut: assets/img/testimonial/testi-1.jpg</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Müşteri Adı</label>
                            <input type="text" class="form-control testimonial-name" value="Justin Case">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Müşteri Kullanıcı Adı</label>
                            <input type="text" class="form-control testimonial-username" value="@justin">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yorum Metni</label>
                            <textarea class="form-control testimonial-text" rows="3">Up the duff crikey argy-bargy in my flat is faff about victoria sponge brolly the lurgy bubble and squeak bogstandard you mug bloke pardon you mush.</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Puan (1-5)</label>
                            <input type="number" class="form-control testimonial-rating" min="1" max="5" value="5">
                        </div>
                    </div>

                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Yorum 2</h5>
                        <div class="mb-3">
                            <label class="form-label">Müşteri Fotoğrafı</label>
                            <input type="file" class="form-control testimonial-avatar">
                            <div class="form-text">Mevcut: assets/img/testimonial/testi-2.jpg</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Müşteri Adı</label>
                            <input type="text" class="form-control testimonial-name" value="Gunther Beard">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Müşteri Kullanıcı Adı</label>
                            <input type="text" class="form-control testimonial-username" value="@beard">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yorum Metni</label>
                            <textarea class="form-control testimonial-text" rows="3">Up the duff crikey argy-bargy in my flat is faff about victoria sponge brolly the lurgy bubble and squeak bogstandard you mug bloke pardon you mush.</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Puan (1-5)</label>
                            <input type="number" class="form-control testimonial-rating" min="1" max="5" value="5">
                        </div>
                    </div>
                </div>

                <div class="preview-container">
                    <h5>Önizleme</h5>
                    <div class="section__title-wrapper mb-115 text-center">
                        <h2 class="section__title">What our Customers have to say</h2>
                        <p>Curabitur lacus arcu, sodales in quam sed, commodo efficitur ligula.</p>
                    </div>

                    <div class="testimonial__slider-2">
                        <div class="testimonial__item-2">
                            <div class="testimonial__person-wrapper">
                                <div class="testimonial__person d-flex">
                                    <div class="testimonial__avater">
                                        <img src="https://via.placeholder.com/80x80" alt="">
                                    </div>
                                    <div class="testimonial__info ml-15">
                                        <h5>Justin Case</h5>
                                        <span>@justin</span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial__text testimonial__text-2 white-bg mt--40">
                                <div class="rating mb-5">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <p>Up the duff crikey argy-bargy in my flat is faff about victoria sponge brolly the lurgy bubble and squeak bogstandard you mug bloke pardon you mush.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subscribe Section Form -->
            <div class="content-section" id="subscribe-content">
                <h3 class="mb-4">Abonelik Ayarları</h3>

                <div class="form-part">
                    <h5>Arka Plan Ayarları</h5>
                    <div class="mb-3">
                        <label for="subscribe-bg" class="form-label">Arka Plan Görseli</label>
                        <input type="file" class="form-control" id="subscribe-bg">
                        <div class="form-text">Mevcut: assets/img/bg/subscribe-bg.jpg</div>
                    </div>
                </div>

                <div class="form-part">
                    <h5>İçerik Ayarları</h5>
                    <div class="mb-3">
                        <label for="subscribe-title" class="form-label">Başlık</label>
                        <input type="text" class="form-control" id="subscribe-title" value="Have a project? Create your website now.">
                    </div>
                    <div class="mb-3">
                        <label for="subscribe-description" class="form-label">Açıklama</label>
                        <input type="text" class="form-control" id="subscribe-description" value="Try our any product for FREE!">
                    </div>
                    <div class="mb-3">
                        <label for="subscribe-placeholder" class="form-label">E-posta Yer Tutucu Metin</label>
                        <input type="text" class="form-control" id="subscribe-placeholder" value="Email Address">
                    </div>
                    <div class="mb-3">
                        <label for="subscribe-button" class="form-label">Buton Metni</label>
                        <input type="text" class="form-control" id="subscribe-button" value="subscribe">
                    </div>
                    <div class="mb-3">
                        <label for="subscribe-footer" class="form-label">Alt Bilgi Metni</label>
                        <input type="text" class="form-control" id="subscribe-footer" value="Join 20,000+ other creators in our Markit community.">
                    </div>
                </div>

                <div class="form-part">
                    <h5>Dekoratif İkonlar</h5>
                    <div class="mb-3">
                        <label class="form-label">PS İkonu</label>
                        <input type="file" class="form-control" id="subscribe-icon-ps">
                        <div class="form-text">Mevcut: assets/img/icon/subscribe/ps.png</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">WP İkonu</label>
                        <input type="file" class="form-control" id="subscribe-icon-wp">
                        <div class="form-text">Mevcut: assets/img/icon/subscribe/wp.png</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">HTML İkonu</label>
                        <input type="file" class="form-control" id="subscribe-icon-html">
                        <div class="form-text">Mevcut: assets/img/icon/subscribe/html.png</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">F İkonu</label>
                        <input type="file" class="form-control" id="subscribe-icon-f">
                        <div class="form-text">Mevcut: assets/img/icon/subscribe/f.png</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Man İkonu</label>
                        <input type="file" class="form-control" id="subscribe-icon-man">
                        <div class="form-text">Mevcut: assets/img/icon/subscribe/man.png</div>
                    </div>
                </div>

                <div class="preview-container">
                    <h5>Önizleme</h5>
                    <div class="subscribe__area p-relative pt-100 pb-110" style="background-image: url('https://via.placeholder.com/1200x400');">
                        <div class="subscribe__content text-center">
                            <h3 class="subscribe__title">Have a project? Create your website now.</h3>
                            <p>Try our any product for FREE!</p>
                            <div class="subscribe__form">
                                <form action="#">
                                    <input type="email" placeholder="Email Address">
                                    <button type="submit" class="m-btn m-btn-black">subscribe</button>
                                </form>
                                <p>Join 20,000+ other creators in our Markit community.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog Section Form -->
            <div class="content-section" id="blog-content">
                <h3 class="mb-4">Blog Ayarları</h3>

                <div class="form-part">
                    <h5>Başlık Ayarları</h5>
                    <div class="mb-3">
                        <label for="blog-title" class="form-label">Ana Başlık</label>
                        <input type="text" class="form-control" id="blog-title" value="Latest from Blog">
                    </div>
                    <div class="mb-3">
                        <label for="blog-subtitle" class="form-label">Alt Başlık</label>
                        <input type="text" class="form-control" id="blog-subtitle" value="From multipurpose themes to niche templates">
                    </div>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-primary" id="addBlogPost">
                        <i class="fas fa-plus me-1"></i> Yeni Blog Yazısı Ekle
                    </button>
                </div>

                <div id="blog-container">
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Blog Yazısı 1</h5>
                        <div class="mb-3">
                            <label class="form-label">Görsel</label>
                            <input type="file" class="form-control blog-image">
                            <div class="form-text">Mevcut: assets/img/blog/sm1.jpg</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tarih</label>
                            <input type="text" class="form-control blog-date" value="15 March 21">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yazar</label>
                            <input type="text" class="form-control blog-author" value="Diboli">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yorum Sayısı</label>
                            <input type="text" class="form-control blog-comments" value="23">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control blog-title" value="Time is money but its not full demand.">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Özet</label>
                            <textarea class="form-control blog-excerpt" rows="2">Haggle down the pub off his nut arse bog bits and bobs bugger.</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">"Devamını Oku" Metni</label>
                            <input type="text" class="form-control blog-readmore" value="Read More">
                        </div>
                    </div>

                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Blog Yazısı 2</h5>
                        <div class="mb-3">
                            <label class="form-label">Görsel</label>
                            <input type="file" class="form-control blog-image">
                            <div class="form-text">Mevcut: assets/img/blog/sm2.jpg</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tarih</label>
                            <input type="text" class="form-control blog-date" value="22 March 21">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yazar</label>
                            <input type="text" class="form-control blog-author" value="Diboli">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yorum Sayısı</label>
                            <input type="text" class="form-control blog-comments" value="23">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control blog-title" value="We Are Trying To Do Best Work.">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Özet</label>
                            <textarea class="form-control blog-excerpt" rows="2">Haggle down the pub off his nut arse bog bits and bobs bugger.</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">"Devamını Oku" Metni</label>
                            <input type="text" class="form-control blog-readmore" value="Read More">
                        </div>
                    </div>
                </div>

                <div class="preview-container">
                    <h5>Önizleme</h5>
                    <div class="section__title-wrapper text-center mb-60">
                        <h2 class="section__title">Latest from Blog</h2>
                        <p>From multipurpose themes to niche templates</p>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="latest-blog mb-30">
                                <div class="latest-blog-img pos-rel">
                                    <img src="https://via.placeholder.com/400x250" alt="">
                                    <div class="top-date">
                                        <a href="#">15 March 21</a>
                                    </div>
                                </div>
                                <div class="latest-blog-content">
                                    <div class="latest-post-meta mb-15">
                                        <span><a href="#"><i class="far fa-user"></i> Diboli </a></span>
                                        <span><a href="#"><i class="far fa-comments"></i> 23 Comments</a></span>
                                    </div>
                                    <h3 class="latest-blog-title">
                                        <a href="#">Time is money but its not full demand.</a>
                                    </h3>
                                    <p>Haggle down the pub off his nut arse bog bits and bobs bugger.</p>
                                    <div class="blog-arrow">
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="latest-blog mb-30">
                                <div class="latest-blog-img pos-rel">
                                    <img src="https://via.placeholder.com/400x250" alt="">
                                    <div class="top-date">
                                        <a href="#">22 March 21</a>
                                    </div>
                                </div>
                                <div class="latest-blog-content">
                                    <div class="latest-post-meta mb-15">
                                        <span><a href="#"><i class="far fa-user"></i> Diboli </a></span>
                                        <span><a href="#"><i class="far fa-comments"></i> 23 Comments</a></span>
                                    </div>
                                    <h3 class="latest-blog-title">
                                        <a href="#">We Are Trying To Do Best Work.</a>
                                    </h3>
                                    <p>Haggle down the pub off his nut arse bog bits and bobs bugger.</p>
                                    <div class="blog-arrow">
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Sidebar navigation
        $('.sidebar .nav-link').on('click', function(e) {
            e.preventDefault();

            // Remove active class from all links and sections
            $('.sidebar .nav-link').removeClass('active');
            $('.content-section').removeClass('active');

            // Add active class to clicked link
            $(this).addClass('active');

            // Show corresponding section
            const sectionId = $(this).data('section') + '-content';
            $('#' + sectionId).addClass('active');
            console.log(sectionId);
        });

        // Add category
        $('#addCategory').on('click', function() {
            const categoryCount = $('#categories-container .dynamic-item').length + 1;
            const newCategory = `
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Kategori ${categoryCount}</h5>
                        <div class="mb-3">
                            <label class="form-label">İkon</label>
                            <input type="file" class="form-control category-icon">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control category-title" value="Yeni Kategori">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Öğe Sayısı</label>
                            <input type="text" class="form-control category-count" value="0 Items">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link</label>
                            <input type="text" class="form-control category-link" value="product.html">
                        </div>
                    </div>
                `;
            $('#categories-container').append(newCategory);
        });

        // Add tab
        $('#addTab').on('click', function() {
            const tabCount = $('#tabs-container .dynamic-item').length + 1;
            const newTab = `
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <div class="mb-3">
                            <label class="form-label">Sekme Adı</label>
                            <input type="text" class="form-control tab-name" value="Yeni Sekme ${tabCount}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sekme ID</label>
                            <input type="text" class="form-control tab-id" value="nav-new-${tabCount}">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input tab-active" type="radio" name="tab-active">
                            <label class="form-check-label">Aktif Sekme</label>
                        </div>
                    </div>
                `;
            $('#tabs-container').append(newTab);

            // Update select dropdown
            $('#product-tab-select').append(`<option value="nav-new-${tabCount}">Yeni Sekme ${tabCount}</option>`);
        });

        // Add product
        $('#addProduct').on('click', function() {
            const productCount = $('#products-container .dynamic-item').length + 1;
            const newProduct = `
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Ürün ${productCount}</h5>
                        <div class="mb-3">
                            <label class="form-label">Ürün Görseli</label>
                            <input type="file" class="form-control product-image">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Önizleme Görseli</label>
                            <input type="file" class="form-control product-preview">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fiyat</label>
                            <input type="text" class="form-control product-price" value="0.00">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <input type="text" class="form-control product-category" value="Kategori">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yazar</label>
                            <input type="text" class="form-control product-author" value="Yazar">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alt Metin</label>
                            <input type="text" class="form-control product-alt" value="Ürün Açıklaması">
                        </div>
                    </div>
                `;
            $('#products-container').append(newProduct);
        });

        // Add service
        $('#addService').on('click', function() {
            const serviceCount = $('#services-container .dynamic-item').length + 1;
            const newService = `
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Hizmet ${serviceCount}</h5>
                        <div class="mb-3">
                            <label class="form-label">İkon</label>
                            <input type="file" class="form-control service-icon">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">İkon Arka Plan Rengi</label>
                            <input type="color" class="form-control color-input service-bg-color" value="#007bff">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control service-title" value="Yeni Hizmet">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Açıklama</label>
                            <textarea class="form-control service-description" rows="2">Hizmet açıklaması</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Metni</label>
                            <input type="text" class="form-control service-link-text" value="Learn More">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link URL</label>
                            <input type="text" class="form-control service-link-url" value="#">
                        </div>
                    </div>
                `;
            $('#services-container').append(newService);
        });

        // Add pricing plan
        $('#addPricingPlan').on('click', function() {
            const planCount = $('#pricing-container .dynamic-item').length + 1;
            const newPlan = `
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Plan ${planCount}</h5>
                        <div class="mb-3">
                            <label class="form-label">Plan Adı</label>
                            <input type="text" class="form-control pricing-plan-name" value="Yeni Plan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Plan Açıklaması</label>
                            <input type="text" class="form-control pricing-plan-desc" value="Plan açıklaması">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fiyat</label>
                            <input type="text" class="form-control pricing-plan-price" value="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Buton Metni</label>
                            <input type="text" class="form-control pricing-plan-button" value="Buy Now">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Özellikler (Her özelliği yeni satıra yazın)</label>
                            <textarea class="form-control pricing-plan-features" rows="5">Özellik 1
Özellik 2
Özellik 3</textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input pricing-plan-featured" type="checkbox">
                            <label class="form-check-label">Öne Çıkan Plan</label>
                        </div>
                    </div>
                `;
            $('#pricing-container').append(newPlan);
        });

        // Add testimonial
        $('#addTestimonial').on('click', function() {
            const testimonialCount = $('#testimonials-container .dynamic-item').length + 1;
            const newTestimonial = `
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Yorum ${testimonialCount}</h5>
                        <div class="mb-3">
                            <label class="form-label">Müşteri Fotoğrafı</label>
                            <input type="file" class="form-control testimonial-avatar">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Müşteri Adı</label>
                            <input type="text" class="form-control testimonial-name" value="Müşteri Adı">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Müşteri Kullanıcı Adı</label>
                            <input type="text" class="form-control testimonial-username" value="@kullanici">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yorum Metni</label>
                            <textarea class="form-control testimonial-text" rows="3">Yorum metni</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Puan (1-5)</label>
                            <input type="number" class="form-control testimonial-rating" min="1" max="5" value="5">
                        </div>
                    </div>
                `;
            $('#testimonials-container').append(newTestimonial);
        });

        // Add blog post
        $('#addBlogPost').on('click', function() {
            const postCount = $('#blog-container .dynamic-item').length + 1;
            const newPost = `
                    <div class="dynamic-item">
                        <span class="remove-btn"><i class="fas fa-times"></i></span>
                        <h5>Blog Yazısı ${postCount}</h5>
                        <div class="mb-3">
                            <label class="form-label">Görsel</label>
                            <input type="file" class="form-control blog-image">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tarih</label>
                            <input type="text" class="form-control blog-date" value="01 January 2023">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yazar</label>
                            <input type="text" class="form-control blog-author" value="Yazar">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Yorum Sayısı</label>
                            <input type="text" class="form-control blog-comments" value="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" class="form-control blog-title" value="Blog Başlığı">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Özet</label>
                            <textarea class="form-control blog-excerpt" rows="2">Blog özeti</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">"Devamını Oku" Metni</label>
                            <input type="text" class="form-control blog-readmore" value="Read More">
                        </div>
                    </div>
                `;
            $('#blog-container').append(newPost);
        });

        // Remove dynamic item
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.dynamic-item').remove();
        });

        // Save all
        $('#saveAll').on('click', function() {
            alert('Tüm değişiklikler kaydedildi!');
            // In a real application, this would send the data to the server
        });


    });
</script>
