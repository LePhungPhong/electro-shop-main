USE electroshop;

SET FOREIGN_KEY_CHECKS =0 ;
INSERT IGNORE INTO users (
    id,
    name,
    email,
    email_verified_at,
    password,
    remember_token,
    created_at,
    updated_at
) VALUES
    (1, 'Admin', 'admin@example.com', NOW(),
     '$2y$12$YyzGIs2LHtnmw7vv9PqFbuSEkTJwZBJ8LDiF5oNHY8DUbCV6iPIna',
     NULL, NOW(), NOW()
    ),
    (2, 'Content Writer', 'writer@example.com', NOW(),
     '$2y$12$YyzGIs2LHtnmw7vv9PqFbuSEkTJwZBJ8LDiF5oNHY8DUbCV6iPIna',
     NULL, NOW(), NOW()
    ),
    (3, 'Editor', 'editor@example.com', NOW(),
     '$2y$12$YyzGIs2LHtnmw7vv9PqFbuSEkTJwZBJ8LDiF5oNHY8DUbCV6iPIna',
     NULL, NOW(), NOW()
    );


-- ======================================================
-- 1. CATEGORIES
-- ======================================================
INSERT INTO categories (id, name, slug, parent_id, description, image, is_active, sort_order) VALUES
  (1,  'Computers & Laptops', 'computers-laptops', NULL, 'Máy tính để bàn, máy tính xách tay và linh kiện liên quan', NULL, 1, 1),
  (2,  'Mobile Phones',        'mobile-phones',        NULL, 'Điện thoại thông minh, điện thoại cơ bản và phụ kiện',          NULL, 1, 2),
  (3,  'Televisions',          'televisions',          NULL, 'TV LED, TV OLED, Smart TV và phụ kiện',                        NULL, 1, 3),
  (4,  'Accessories',          'accessories',          NULL, 'Phụ kiện điện tử: sạc, tai nghe, cáp, ốp lưng…',              NULL, 1, 4),

  (5,  'Laptops',              'laptops',               1,   'Máy tính xách tay: ultrabook, gaming, doanh nhân',             NULL, 1, 1),
  (6,  'Desktops',             'desktops',              1,   'Máy tính để bàn: PC gaming, PC văn phòng',                     NULL, 1, 2),
  (7,  'Components',           'components',            1,   'Linh kiện: CPU, RAM, ổ cứng, mainboard, VGA',                  NULL, 1, 3),

  (8,  'Smartphones',          'smartphones',           2,   'Điện thoại thông minh từ các thương hiệu lớn',                NULL, 1, 1),
  (9,  'Feature Phones',       'feature-phones',        2,   'Điện thoại cơ bản, pin bền, giá rẻ',                           NULL, 1, 2),

  (10, 'LED TVs',              'led-tvs',               3,   'TV LED các kích thước: 32", 40", 50", 55", 65"',               NULL, 1, 1),
  (11, 'Smart TVs',            'smart-tvs',             3,   'Smart TV tích hợp hệ điều hành Android, Tizen, WebOS',         NULL, 1, 2),

  (12, 'Chargers & Cables',    'chargers-cables',       4,   'Sạc nhanh, cáp Type-C, Lightning, Micro USB…',                NULL, 1, 1),
  (13, 'Headphones & Earbuds', 'headphones-earbuds',    4,   'Tai nghe không dây, tai nghe có dây, in-ear, over-ear',       NULL, 1, 2),
  (14, 'Cases & Covers',       'cases-covers',          4,   'Ốp lưng, bao da, bảo vệ màn hình cho điện thoại và laptop',    NULL, 1, 3);

-- ======================================================
-- 2. BRANDS
--  Thêm Anker (id=13) để tránh NULL brand_id trong products
-- ======================================================
INSERT INTO brands (name, slug, logo, description, is_active, created_at, updated_at) VALUES
  ('Apple',      'apple',      'apple.png',      'Thương hiệu công nghệ Mỹ, sản xuất iPhone, MacBook, iPad',                              1, NOW(), NOW()),
  ('Samsung',    'samsung',    'samsung.png',    'Tập đoàn Hàn Quốc, điện thoại Galaxy, TV, thiết bị gia dụng thông minh',               1, NOW(), NOW()),
  ('Sony',       'sony',       'sony.png',       'Hãng Nhật Bản, nổi tiếng với TV Bravia, máy ảnh α, PlayStation',                        1, NOW(), NOW()),
  ('LG',         'lg',         'lg.png',         'Tập đoàn Hàn Quốc, TV OLED, điện thoại, thiết bị gia dụng',                            1, NOW(), NOW()),
  ('Dell',       'dell',       'dell.png',       'Thương hiệu Mỹ, laptop XPS, máy tính để bàn, giải pháp doanh nghiệp',                  1, NOW(), NOW()),
  ('HP',         'hp',         'hp.png',         'Hãng Mỹ, laptop EliteBook, máy in, máy chủ doanh nghiệp',                               1, NOW(), NOW()),
  ('Lenovo',     'lenovo',     'lenovo.png',     'Hãng Trung Quốc, laptop ThinkPad, Yoga, máy chủ doanh nghiệp',                          1, NOW(), NOW()),
  ('Asus',       'asus',       'asus.png',       'Thương hiệu Đài Loan, laptop gaming ROG, ultrabook ZenBook',                           1, NOW(), NOW()),
  ('Acer',       'acer',       'acer.png',       'Hãng Đài Loan, laptop giá phải chăng, màn hình, máy tính để bàn',                      1, NOW(), NOW()),
  ('Microsoft',  'microsoft',  'microsoft.png',  'Tập đoàn Mỹ, Surface, Windows, phụ kiện máy tính',                                     1, NOW(), NOW()),
  ('Xiaomi',     'xiaomi',     'xiaomi.png',     'Hãng Trung Quốc, điện thoại Redmi/Mi, thiết bị smarthome',                             1, NOW(), NOW()),
  ('Huawei',     'huawei',     'huawei.png',     'Hãng Trung Quốc, điện thoại P/Mate series, thiết bị mạng',                             1, NOW(), NOW()),
  ('Anker',      'anker',      'anker.png',      'Hãng phụ kiện sạc nhanh, cáp, pin dự phòng, củ sạc GaN',                               1, NOW(), NOW());

-- Ghi nhớ:
-- Apple      -> id = 1
-- Samsung    -> id = 2
-- ...
-- Huawei     -> id = 12
-- Anker      -> id = 13

-- ======================================================
-- 3. PRODUCTS (điện thoại)
-- ======================================================
INSERT INTO products (
  name, slug, sku, short_description, description,
  regular_price, sale_price,
  stock_quantity, manage_stock, stock_status,
  category_id, brand_id,
  is_featured, is_active,
  views_count, published_at,
  meta_title, meta_description, meta_keywords,
  created_at, updated_at
) VALUES
  (
    'iPhone 14',
    'iphone-14',
    'APL-IPH14',
    'Apple iPhone 14, màn hình 6.1″ Super Retina XDR, chip A15 Bionic',
    'iPhone 14 chính hãng: Chip A15 Bionic, camera kép 12 MP, hỗ trợ 5G, pin cải tiến, iOS 16 với nhiều tính năng mới.',
    27990000.00, 25990000.00,
    50, 1, 'in_stock',
    8, 1,
    0, 1,
    0, NOW(),
    'iPhone 14 – Apple Chính Hãng',
    'Mua iPhone 14 chính hãng, bảo hành 12 tháng, giá tốt nhất.',
    'iphone,apple,smartphone,iphone-14',
    NOW(), NOW()
  ),
  (
    'Samsung Galaxy S23',
    'samsung-galaxy-s23',
    'SMS-S23',
    'Samsung Galaxy S23, màn hình 6.1″ Dynamic AMOLED, Exynos 2200/Snapdragon 8 Gen 2',
    'Galaxy S23 chính hãng: Camera chính 50 MP, quay 8K, pin 3.900 mAh, chống nước IP68, One UI 5.1 trên Android 13.',
    21990000.00, 19990000.00,
    40, 1, 'in_stock',
    8, 2,
    0, 1,
    0, NOW(),
    'Samsung Galaxy S23 – Chính Hãng',
    'Mua Galaxy S23 chính hãng, giá tốt, miễn phí vận chuyển.',
    'galaxy-s23,samsung,smartphone',
    NOW(), NOW()
  );

-- ======================================================
-- 4. PRODUCTS (laptop, desktop, tv, phụ kiện...)
-- ======================================================
INSERT INTO products (
  name, slug, sku, short_description, description,
  regular_price, sale_price,
  stock_quantity, manage_stock, stock_status,
  category_id, brand_id,
  is_featured, is_active,
  views_count, published_at,
  meta_title, meta_description, meta_keywords,
  created_at, updated_at
) VALUES
  (
    'MacBook Pro 14\" (2023)',
    'macbook-pro-14-2023',
    'APL-MBP14-23',
    'Apple MacBook Pro 14\", chip M2 Pro, màn hình Liquid Retina XDR',
    'MacBook Pro 14-inch (2023) chính hãng: chip M2 Pro, RAM 16GB, SSD 512GB, màn hình Liquid Retina XDR, Touch Bar, macOS Ventura.',
    57990000.00, 54990000.00,
    20, 1, 'in_stock',
    5, 1,
    1, 1,
    0, NOW(),
    'MacBook Pro 14-inch (2023) Chính Hãng',
    'Mua MacBook Pro 14\" 2023 chính hãng, bảo hành 12 tháng, giá tốt.',
    'macbook,macbook-pro,apple,laptop',
    NOW(), NOW()
  ),
  (
    'Dell XPS 13 (9315)',
    'dell-xps-13-9315',
    'DELL-XPS13',
    'Dell XPS 13, Intel Core i7, RAM 16GB, SSD 512GB',
    'Laptop Dell XPS 13 9315: CPU Intel Core i7-1250U, 16GB RAM, 512GB SSD, màn hình 13.4\" FHD+, Windows 11.',
    39990000.00, NULL,
    15, 1, 'in_stock',
    5, 5,
    0, 1,
    0, NOW(),
    'Dell XPS 13 (9315) Chính Hãng',
    'Dell XPS 13 9315 chính hãng, bảo hành 12 tháng.',
    'dell,xps-13,laptop',
    NOW(), NOW()
  ),
  (
    'HP Spectre x360 14\"',
    'hp-spectre-x360-14',
    'HP-SPX360-14',
    'HP Spectre x360 14\", Core i7, 16GB RAM, SSD 512GB',
    'HP Spectre x360: Màn hình cảm ứng 14\" OLED, Intel Core i7, 16GB RAM, 512GB SSD, thiết kế 2-in-1, Windows 11.',
    42990000.00, 40990000.00,
    10, 1, 'in_stock',
    5, 6,
    0, 1,
    0, NOW(),
    'HP Spectre x360 14\" Chính Hãng',
    'Mua HP Spectre x360, bảo hành 12 tháng.',
    'hp,spectre-x360,laptop',
    NOW(), NOW()
  ),
  (
    'Dell Inspiron 3880',
    'dell-inspiron-3880',
    'DELL-D3880',
    'Dell Inspiron 3880, Core i5, RAM 8GB, SSD 256GB + HDD 1TB',
    'Máy tính để bàn Dell Inspiron 3880: Intel Core i5-10400, 8GB RAM, 256GB SSD + 1TB HDD, Windows 11.',
    17990000.00, 16990000.00,
    8, 1, 'in_stock',
    6, 5,
    0, 1,
    0, NOW(),
    'Dell Inspiron 3880 Chính Hãng',
    'Dell Inspiron Desktop 3880, bảo hành 12 tháng.',
    'dell,inspiron,desktop',
    NOW(), NOW()
  ),
  (
    'Samsung Galaxy S23 Ultra',
    'samsung-galaxy-s23-ultra',
    'SMS-S23U',
    'Galaxy S23 Ultra, màn hình 6.8\" AMOLED, camera 200MP',
    'Samsung Galaxy S23 Ultra chính hãng: Chip Snapdragon 8 Gen 2, RAM 12GB, pin 5.000 mAh, camera 200MP, chống nước IP68.',
    31990000.00, 29990000.00,
    30, 1, 'in_stock',
    8, 2,
    1, 1,
    0, NOW(),
    'Samsung Galaxy S23 Ultra – Chính Hãng',
    'Mua Galaxy S23 Ultra chính hãng, giá tốt, miễn phí vận chuyển.',
    'galaxy-s23-ultra,samsung,smartphone',
    NOW(), NOW()
  ),
  (
    'Xiaomi Mi 11',
    'xiaomi-mi-11',
    'XIA-MI11',
    'Xiaomi Mi 11, màn hình 6.81\" AMOLED, Snapdragon 888',
    'Xiaomi Mi 11 chính hãng: Snapdragon 888, RAM 8GB, pin 4.600 mAh, camera 108MP, sạc nhanh 55W.',
    11990000.00, 10990000.00,
    25, 1, 'in_stock',
    8, 11,
    0, 1,
    0, NOW(),
    'Xiaomi Mi 11 – Chính Hãng',
    'Mua Xiaomi Mi 11 chính hãng, bảo hành 12 tháng.',
    'xiaomi,mi-11,smartphone',
    NOW(), NOW()
  ),
  (
    'Huawei P50 Pro',
    'huawei-p50-pro',
    'HUA-P50P',
    'Huawei P50 Pro, màn hình 6.6\" OLED, camera 50MP + 40MP',
    'Huawei P50 Pro chính hãng: Kirin 9000, RAM 8GB, pin 4.360 mAh, camera kép 50MP + 40MP, sạc nhanh 66W.',
    20990000.00, 19990000.00,
    18, 1, 'in_stock',
    8, 12,
    0, 1,
    0, NOW(),
    'Huawei P50 Pro – Chính Hãng',
    'Mua Huawei P50 Pro chính hãng, bảo hành 12 tháng.',
    'huawei,p50-pro,smartphone',
    NOW(), NOW()
  ),
  (
    'LG OLED55C1PTA 55\"',
    'lg-oled55c1pta-55',
    'LG-OLED55C1',
    'TV LG OLED55C1PTA 55\", 4K, webOS 6.0',
    'TV LG OLED55C1PTA 55\": Panel OLED, 4K UHD, HDR10, Dolby Vision, webOS 6.0, Magic Remote.',
    27990000.00, 25990000.00,
    12, 1, 'in_stock',
    11, 4,
    0, 1,
    0, NOW(),
    'LG OLED55C1PTA 55\" Chính Hãng',
    'Mua TV LG OLED55C1PTA 55\", bảo hành 24 tháng.',
    'lg,oled55,smart-tv',
    NOW(), NOW()
  ),
  (
    'Sony Bravia XR-65A80J 65\"',
    'sony-bravia-xr-65a80j-65',
    'SNY-BR65A80J',
    'TV Sony Bravia XR-65A80J 65\", OLED, Cognitive Processor XR',
    'Sony Bravia XR-65A80J 65\": OLED 4K, Cognitive Processor XR, Acoustic Surface Audio+, Google TV.',
    34990000.00, 32990000.00,
    7, 1, 'in_stock',
    11, 3,
    0, 1,
    0, NOW(),
    'Sony Bravia XR-65A80J 65\" Chính Hãng',
    'Mua TV Sony Bravia 65\" chính hãng, bảo hành 24 tháng.',
    'sony,bravia,smart-tv',
    NOW(), NOW()
  ),
  (
    'Apple AirPods Pro (2nd Gen)',
    'apple-airpods-pro-2',
    'APL-AP2',
    'AirPods Pro thế hệ 2, khử ồn chủ động, Spatial Audio',
    'AirPods Pro (2nd Gen) chính hãng: ANC, Spatial Audio, case sạc MagSafe, chip H2.',
    6990000.00, 6490000.00,
    35, 1, 'in_stock',
    13, 1,
    1, 1,
    0, NOW(),
    'Apple AirPods Pro (2nd Gen) Chính Hãng',
    'Mua AirPods Pro thế hệ 2 chính hãng, bảo hành 12 tháng.',
    'airpods-pro,apple,headphones',
    NOW(), NOW()
  ),
  (
    'Anker PowerPort III 65W',
    'anker-powerport-iii-65w',
    'ANK-PP65',
    'Củ sạc Anker PowerPort III 65W, USB-C PD',
    'Anker PowerPort III 65W chính hãng: USB-C PD 65W, siêu nhỏ gọn, tương thích MacBook, iPad, smartphone.',
    450000.00, NULL,
    60, 1, 'in_stock',
    12, 13,
    0, 1,
    0, NOW(),
    'Anker PowerPort III 65W Chính Hãng',
    'Mua Anker PowerPort III 65W chính hãng, bảo hành 18 tháng.',
    'anker,charger,usb-c',
    NOW(), NOW()
  );

-- ======================================================
-- 5. PROVINCES
-- ======================================================
INSERT INTO provinces (name, code, country_code) VALUES
  ('Lai Châu',              '01', 'VN'),
  ('Lào Cai',               '02', 'VN'),
  ('Hà Giang',              '03', 'VN'),
  ('Cao Bằng',              '04', 'VN'),
  ('Sơn La',                '05', 'VN'),
  ('Yên Bái',               '06', 'VN'),
  ('Tuyên Quang',           '07', 'VN'),
  ('Lạng Sơn',              '09', 'VN'),
  ('Quảng Ninh',            '13', 'VN'),
  ('Hòa Bình',              '14', 'VN'),
  ('Ninh Bình',             '18', 'VN'),
  ('Thái Bình',             '20', 'VN'),
  ('Thanh Hóa',             '21', 'VN'),
  ('Nghệ An',               '22', 'VN'),
  ('Hà Tĩnh',               '23', 'VN'),
  ('Quảng Bình',            '24', 'VN'),
  ('Quảng Trị',             '25', 'VN'),
  ('Thừa Thiên-Huế',        '26', 'VN'),
  ('Quảng Nam',             '27', 'VN'),
  ('Kon Tum',               '28', 'VN'),
  ('Quảng Ngãi',            '29', 'VN'),
  ('Gia Lai',               '30', 'VN'),
  ('Bình Định',             '31', 'VN'),
  ('Phú Yên',               '32', 'VN'),
  ('Đắk Lắk',               '33', 'VN'),
  ('Khánh Hòa',             '34', 'VN'),
  ('Lâm Đồng',              '35', 'VN'),
  ('Ninh Thuận',            '36', 'VN'),
  ('Tây Ninh',              '37', 'VN'),
  ('Đồng Nai',              '39', 'VN'),
  ('Bình Thuận',            '40', 'VN'),
  ('Long An',               '41', 'VN'),
  ('Bà Rịa – Vũng Tàu',     '43', 'VN'),
  ('An Giang',              '44', 'VN'),
  ('Đồng Tháp',             '45', 'VN'),
  ('Tiền Giang',            '46', 'VN'),
  ('Kiên Giang',            '47', 'VN'),
  ('Vĩnh Long',             '49', 'VN'),
  ('Bến Tre',               '50', 'VN'),
  ('Trà Vinh',              '51', 'VN'),
  ('Sóc Trăng',             '52', 'VN'),
  ('Bắc Kạn',               '53', 'VN'),
  ('Bắc Giang',             '54', 'VN'),
  ('Bạc Liêu',              '55', 'VN'),
  ('Bắc Ninh',              '56', 'VN'),
  ('Bình Dương',            '57', 'VN'),
  ('Bình Phước',            '58', 'VN'),
  ('Cà Mau',                '59', 'VN'),

  ('Cần Thơ',               'CT', 'VN'),
  ('Đà Nẵng',               'DN', 'VN'),
  ('Hà Nội',                'HN', 'VN'),
  ('Hải Phòng',             'HP', 'VN'),
  ('Hồ Chí Minh',           'SG', 'VN');

-- ======================================================
-- 6. DISTRICTS - Hà Nội
-- ======================================================
INSERT INTO districts (province_id, name, code) VALUES
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Ba Đình',      'HN-01'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Hoàn Kiếm',    'HN-02'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Tây Hồ',       'HN-03'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Long Biên',    'HN-04'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Cầu Giấy',     'HN-05'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Đống Đa',      'HN-06'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Hai Bà Trưng', 'HN-07'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Hoàng Mai',    'HN-08'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Thanh Xuân',   'HN-09'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Hà Đông',      'HN-10'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Bắc Từ Liêm',  'HN-11'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Nam Từ Liêm',  'HN-12'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Sóc Sơn',      'HN-13'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Đông Anh',     'HN-14'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Gia Lâm',      'HN-15'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Thanh Trì',    'HN-16'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Mê Linh',      'HN-17'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Sơn Tây',      'HN-18'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Ba Vì',        'HN-19'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Phúc Thọ',     'HN-20'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Thạch Thất',   'HN-21'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Chương Mỹ',    'HN-22'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Thanh Oai',    'HN-23'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Thường Tín',   'HN-24'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Phú Xuyên',    'HN-25'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Ứng Hòa',      'HN-26'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Mỹ Đức',       'HN-27'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Đan Phượng',   'HN-28'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Hoài Đức',     'HN-29'),
  ((SELECT id FROM provinces WHERE code = 'HN'), 'Quốc Oai',     'HN-30');

-- ======================================================
-- 7. DISTRICTS - TP.HCM
-- ======================================================
INSERT INTO districts (province_id, name, code) VALUES
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Thành phố Thủ Đức', 'SG-TD'),

  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 1',        'SG-01'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 2',        'SG-02'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 3',        'SG-03'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 4',        'SG-04'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 5',        'SG-05'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 6',        'SG-06'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 7',        'SG-07'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 8',        'SG-08'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 9',        'SG-09'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 10',       'SG-10'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 11',       'SG-11'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận 12',       'SG-12'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận Bình Thạnh','SG-BTH'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận Gò Vấp',   'SG-GV'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận Phú Nhuận','SG-PN'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận Tân Bình', 'SG-TB'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận Tân Phú',  'SG-TP'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Quận Bình Tân', 'SG-BTN'),

  ((SELECT id FROM provinces WHERE code = 'SG'), 'Huyện Bình Chánh', 'SG-BCH'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Huyện Củ Chi',    'SG-CC'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Huyện Hóc Môn',   'SG-HM'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Huyện Nhà Bè',    'SG-NB'),
  ((SELECT id FROM provinces WHERE code = 'SG'), 'Huyện Cần Giờ',   'SG-CGIO');

-- ======================================================
-- 8. WARDS (TP.HCM - mẫu)
-- ======================================================
INSERT INTO wards (district_id, name, code) VALUES
  -- Quận 1
  ((SELECT id FROM districts WHERE code = 'SG-01'), 'Phường Bến Nghé',        'SG-01-01'),
  ((SELECT id FROM districts WHERE code = 'SG-01'), 'Phường Cô Giang',        'SG-01-02'),
  ((SELECT id FROM districts WHERE code = 'SG-01'), 'Phường Cầu Ông Lãnh',    'SG-01-03'),
  ((SELECT id FROM districts WHERE code = 'SG-01'), 'Phường Cầu Kho',         'SG-01-04'),
  ((SELECT id FROM districts WHERE code = 'SG-01'), 'Phường Đa Kao',          'SG-01-05'),
  ((SELECT id FROM districts WHERE code = 'SG-01'), 'Phường Nguyễn Cư Trinh', 'SG-01-06'),
  ((SELECT id FROM districts WHERE code = 'SG-01'), 'Phường Bến Thành',       'SG-01-07'),
  ((SELECT id FROM districts WHERE code = 'SG-01'), 'Phường Phạm Ngũ Lão',    'SG-01-08'),
  ((SELECT id FROM districts WHERE code = 'SG-01'), 'Phường Nguyễn Thái Bình','SG-01-09'),
  ((SELECT id FROM districts WHERE code = 'SG-01'), 'Phường Tân Định',        'SG-01-10'),

  -- Quận 3
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường 1',               'SG-03-01'),
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường 2',               'SG-03-02'),
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường 3',               'SG-03-03'),
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường 4',               'SG-03-04'),
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường 5',               'SG-03-05'),
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường 9',               'SG-03-09'),
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường 10',              'SG-03-10'),
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường 11',              'SG-03-11'),
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường 12',              'SG-03-12'),
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường 13',              'SG-03-13'),
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường 14',              'SG-03-14'),
  ((SELECT id FROM districts WHERE code = 'SG-03'), 'Phường Võ Thị Sáu',      'SG-03-VTS'),

  -- Quận Bình Thạnh
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 1',   'SG-BTH-01'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 2',   'SG-BTH-02'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 3',   'SG-BTH-03'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 5',   'SG-BTH-05'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 6',   'SG-BTH-06'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 7',   'SG-BTH-07'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 11',  'SG-BTH-11'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 12',  'SG-BTH-12'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 13',  'SG-BTH-13'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 14',  'SG-BTH-14'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 15',  'SG-BTH-15'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 17',  'SG-BTH-17'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 19',  'SG-BTH-19'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 21',  'SG-BTH-21'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 22',  'SG-BTH-22'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 24',  'SG-BTH-24'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 25',  'SG-BTH-25'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 26',  'SG-BTH-26'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 27',  'SG-BTH-27'),
  ((SELECT id FROM districts WHERE code = 'SG-BTH'), 'Phường 28',  'SG-BTH-28'),

  -- Quận Tân Bình
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 1',   'SG-TB-01'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 2',   'SG-TB-02'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 3',   'SG-TB-03'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 4',   'SG-TB-04'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 5',   'SG-TB-05'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 6',   'SG-TB-06'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 7',   'SG-TB-07'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 8',   'SG-TB-08'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 9',   'SG-TB-09'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 10',  'SG-TB-10'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 11',  'SG-TB-11'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 12',  'SG-TB-12'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 13',  'SG-TB-13'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 14',  'SG-TB-14'),
  ((SELECT id FROM districts WHERE code = 'SG-TB'), 'Phường 15',  'SG-TB-15'),

  -- Quận Gò Vấp
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 1',   'SG-GV-01'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 3',   'SG-GV-03'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 4',   'SG-GV-04'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 5',   'SG-GV-05'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 6',   'SG-GV-06'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 7',   'SG-GV-07'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 8',   'SG-GV-08'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 9',   'SG-GV-09'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 10',  'SG-GV-10'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 11',  'SG-GV-11'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 12',  'SG-GV-12'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 13',  'SG-GV-13'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 14',  'SG-GV-14'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 15',  'SG-GV-15'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 16',  'SG-GV-16'),
  ((SELECT id FROM districts WHERE code = 'SG-GV'), 'Phường 17',  'SG-GV-17');

-- ======================================================
-- 9. PAYMENT METHODS
-- ======================================================
INSERT INTO payment_methods (
  name, code, description, is_active,
  instructions, logo, sort_order,
  created_at, updated_at
) VALUES
  ('Thanh toán khi nhận hàng (COD)', 'cod', 'Khách hàng thanh toán trực tiếp cho nhân viên giao hàng.', 1,
   'Chuẩn bị đúng số tiền & xác nhận lại địa chỉ trước khi giao.',
   'cod.png', 1, NOW(), NOW()),
  ('Chuyển khoản ngân hàng', 'bank_transfer', 'Chuyển tiền qua tài khoản ngân hàng nội địa.', 1,
   'Chuyển vào STK: 123456789 – Ngân hàng ACB – Chủ TK: Công Ty XYZ. Ghi rõ mã đơn hàng.',
   'bank_transfer.png', 2, NOW(), NOW()),
  ('Ví điện tử VNPay', 'vnpay', 'Thanh toán qua QR code VNPay.', 1,
   'Quét QR trên trang thanh toán, nhập số tiền & xác nhận.',
   'vnpay.png', 3, NOW(), NOW()),
  ('Ví MoMo', 'momo', 'Thanh toán qua ứng dụng MoMo.', 1,
   'Mở app MoMo, chọn "Quét mã" & quét QR code trên trang web để thanh toán.',
   'momo.png', 4, NOW(), NOW()),
  ('PayPal', 'paypal', 'Thanh toán quốc tế qua PayPal.', 1,
   'Đăng nhập PayPal & xác nhận thanh toán qua email liên kết.',
   'paypal.png', 5, NOW(), NOW());

-- ======================================================
-- 10. FAQ
-- ======================================================
INSERT INTO faqs (question, answer, is_active, sort_order, created_at, updated_at) VALUES
  ('Làm sao để đặt hàng trên website?',
   'Bạn chỉ cần chọn sản phẩm, thêm vào giỏ, điền thông tin và thanh toán. Sau đó bạn sẽ nhận email xác nhận đơn.',
   1, 1, NOW(), NOW()),
  ('Những phương thức thanh toán nào được chấp nhận?',
   'Chúng tôi hỗ trợ COD, chuyển khoản ngân hàng, ví điện tử VNPay và MoMo, PayPal.',
   1, 2, NOW(), NOW()),
  ('Chi phí và thời gian giao hàng là bao lâu?',
   'Giao tiêu chuẩn 3–5 ngày (30.000₫), giao nhanh 1–2 ngày (50.000₫), hỏa tốc trong ngày (70.000₫), hoặc nhận tại cửa hàng miễn phí.',
   1, 3, NOW(), NOW()),
  ('Chính sách đổi trả và hoàn tiền?',
   'Bạn có thể đổi/trả trong vòng 7 ngày kể từ khi nhận hàng, sản phẩm phải chưa qua sử dụng và còn nguyên tem mác. Liên hệ support để được hướng dẫn chi tiết.',
   1, 4, NOW(), NOW()),
  ('Sản phẩm được bảo hành bao lâu?',
   'Tất cả sản phẩm chính hãng được bảo hành tối thiểu 12 tháng theo chính sách của nhà sản xuất.',
   1, 5, NOW(), NOW()),
  ('Làm thế nào để theo dõi đơn hàng?',
   'Bạn có thể đăng nhập tài khoản, vào mục “Đơn hàng của tôi” để kiểm tra trạng thái hoặc dùng mã vận đơn nhận qua email/SMS.',
   1, 6, NOW(), NOW()),
  ('Liên hệ hỗ trợ như thế nào?',
   'Mọi thắc mắc vui lòng gọi hotline 1900-1234 hoặc chat trực tuyến ngay trên website để được hỗ trợ nhanh nhất.',
   1, 7, NOW(), NOW());

-- ======================================================
-- 11. POST CATEGORIES
-- ======================================================
INSERT INTO post_categories (name, slug, created_at, updated_at) VALUES
  ('Tin Tức',       'tin-tuc',       NOW(), NOW()),
  ('Khuyến Mãi',    'khuyen-mai',    NOW(), NOW()),
  ('Hướng Dẫn',     'huong-dan',     NOW(), NOW()),
  ('Đánh Giá',      'danh-gia',      NOW(), NOW()),
  ('Thông Báo',     'thong-bao',     NOW(), NOW()),
  ('Blog',          'blog',          NOW(), NOW());

-- ======================================================
-- 12. POSTS
-- ======================================================
INSERT INTO posts (
  user_id, title, slug, excerpt, content,
  featured_image, status,
  published_at, created_at, updated_at
) VALUES
  (1,
   '10 mẹo mua sắm thông minh trên website',
   '10-meo-mua-sam-thong-minh',
   'Tổng hợp 10 mẹo giúp bạn mua sắm nhanh, tiết kiệm và an toàn.',
   'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non risus in orci vehicula vehicula. Phasellus auctor, nisl a mollis hendrerit, lacus augue fermentum mi, quis aliquet purus odio non purus...',
   NULL, 'published',
   NOW(), NOW(), NOW()),
  (2,
   'Hướng dẫn thanh toán qua VNPay',
   'huong-dan-thanh-toan-vnpay',
   'Chi tiết các bước thanh toán bằng ví điện tử VNPay trên website.',
   'Để thanh toán qua VNPay, bạn thực hiện theo các bước sau: 1. Chọn phương thức VNPay... 2. Quét QR code... 3. Xác nhận thanh toán trên ứng dụng...',
   NULL, 'published',
   NOW(), NOW(), NOW()),
  (1,
   'So sánh các gói vận chuyển hiện có',
   'so-sanh-cac-goi-van-chuyen',
   'Phân tích ưu nhược điểm của các phương thức giao hàng.',
   'Giao hàng tiêu chuẩn: thời gian 3–5 ngày, phí 30.000₫... Giao nhanh: 1–2 ngày, phí 50.000₫... Miễn phí giao: áp dụng đơn trên 500.000₫...',
   NULL, 'published',
   NOW(), NOW(), NOW()),
  (3,
   'Chính sách đổi trả hoàn tiền 2025',
   'chinh-sach-doi-tra-hoan-tien-2025',
   'Cập nhật mới nhất về điều kiện và quy trình đổi trả.',
   'Theo chính sách cập nhật năm 2025, khách hàng được đổi trả trong vòng 7 ngày... Điều kiện: còn nguyên tem, hóa đơn mua hàng...',
   NULL, 'published',
   NOW(), NOW(), NOW()),
  (2,
   'Tại sao nên tạo tài khoản trên website?',
   'tai-sao-nen-tao-tai-khoan',
   'Lợi ích khi đăng ký để nhận ưu đãi và theo dõi đơn hàng.',
   'Khi tạo tài khoản, bạn sẽ: 1. Theo dõi lịch sử đơn hàng... 2. Nhận mã giảm giá độc quyền... 3. Quản lý địa chỉ giao hàng dễ dàng...',
   NULL, 'published',
   NOW(), NOW(), NOW()),
  (1,
   'Xu hướng công nghệ 2025 trong thương mại điện tử',
   'xu-huong-cong-nghe-2025',
   'Những công nghệ nổi bật sẽ định hình trải nghiệm mua sắm.',
   'AI cá nhân hóa gợi ý sản phẩm, AR/VR trải nghiệm thử đồ, thanh toán không tiếp xúc... Những xu hướng này mang lại lợi ích...',
   NULL, 'draft',
   NULL, NOW(), NOW());

-- ======================================================
-- 13. ATTRIBUTES
-- ======================================================
INSERT INTO attributes (name, slug, created_at, updated_at) VALUES
  ('Kích thước màn hình',  'kich-thuoc-man-hinh',    NOW(), NOW()),
  ('Dung lượng bộ nhớ',    'dung-luong-bo-nho',      NOW(), NOW()),
  ('Pin',                  'pin',                    NOW(), NOW()),
  ('Chế độ bảo hành',      'che-do-bao-hanh',        NOW(), NOW()),
  ('Màu sắc',              'mau-sac',                NOW(), NOW()),
  ('Cổng kết nối',         'cong-ket-noi',           NOW(), NOW()),
  ('Hệ điều hành',         'he-dieu-hanh',           NOW(), NOW()),
  ('CPU',                  'cpu',                    NOW(), NOW()),
  ('RAM',                  'ram',                    NOW(), NOW()),
  ('Thương hiệu',          'thuong-hieu',            NOW(), NOW());

SET FOREIGN_KEY_CHECKS = 1;
