-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 17, 2021 lúc 07:49 AM
-- Phiên bản máy phục vụ: 10.4.6-MariaDB
-- Phiên bản PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_dienthoaiviet`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_customer` int(11) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `date_order` date NOT NULL,
  `total` float NOT NULL COMMENT 'tổng tiền',
  `payment` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'hình thức thanh toán',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `note` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_modified_by_user` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `bills`
--

INSERT INTO `bills` (`id`, `id_customer`, `id_user`, `date_order`, `total`, `payment`, `status`, `note`, `last_modified_by_user`, `created_at`, `updated_at`) VALUES
(27, 23, NULL, '2021-01-16', 83200000, 'COD', 0, NULL, NULL, '2021-01-16 12:23:36', '2021-01-16 12:23:36'),
(28, 24, NULL, '2021-01-16', 20800000, 'COD', 0, NULL, NULL, '2021-01-16 12:27:51', '2021-01-16 12:27:51'),
(29, 25, NULL, '2021-01-16', 20800000, 'COD', 0, NULL, NULL, '2021-01-16 12:36:44', '2021-01-16 12:36:44'),
(30, 23, NULL, '2021-01-17', 20000000, 'COD', 0, NULL, NULL, '2021-01-16 19:48:49', '2021-01-16 19:48:49'),
(31, 22, NULL, '2021-01-17', 20000000, 'COD', 0, '2', NULL, '2021-01-16 19:49:35', '2021-01-16 19:49:35'),
(32, 26, NULL, '2021-01-17', 20800000, 'COD', 0, NULL, NULL, '2021-01-16 19:50:25', '2021-01-16 19:50:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bill` int(10) UNSIGNED NOT NULL,
  `id_product_variant` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  `unit_price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `bill_detail`
--

INSERT INTO `bill_detail` (`id`, `id_bill`, `id_product_variant`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(31, 27, 1, 2, 20000000, '2021-01-16 12:23:36', '2021-01-16 12:23:36'),
(32, 27, 2, 1, 20800000, '2021-01-16 12:23:36', '2021-01-16 12:23:36'),
(33, 27, 4, 1, 22400000, '2021-01-16 12:23:36', '2021-01-16 12:23:36'),
(34, 28, 2, 1, 20800000, '2021-01-16 12:27:51', '2021-01-16 12:27:51'),
(35, 29, 2, 1, 20800000, '2021-01-16 12:36:44', '2021-01-16 12:36:44'),
(36, 30, 1, 1, 20000000, '2021-01-16 19:48:49', '2021-01-16 19:48:49'),
(37, 31, 1, 1, 20000000, '2021-01-16 19:49:35', '2021-01-16 19:49:35'),
(38, 32, 2, 1, 20800000, '2021-01-16 19:50:25', '2021-01-16 19:50:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `companies`
--

INSERT INTO `companies` (`id`, `name`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Oppo'),
(4, 'Xiaomi'),
(5, 'Vivo'),
(6, 'Realme'),
(7, 'Oneplus');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_modified_by_user` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `name`, `gender`, `email`, `address`, `phone_number`, `note`, `last_modified_by_user`, `created_at`, `updated_at`) VALUES
(15, 'ê', 'Nữ', 'huongnguyen@gmail.com', 'e', 'e', 'e', NULL, '2017-03-24 07:14:32', '2021-01-16 09:57:10'),
(14, 'hhh', 'nam', 'huongnguyen@gmail.com', 'Lê thị riêng', '99999999999999999', 'k', 0, '2017-03-23 04:46:05', '2017-03-23 04:46:05'),
(13, 'Hương Hương', 'Nữ', 'huongnguyenak96@gmail.com', 'Lê Thị Riêng, Quận 1', '23456789', 'Vui lòng giao hàng trước 5h', 0, '2017-03-21 07:29:31', '2017-03-21 07:29:31'),
(12, 'Khoa phạm', 'Nam', 'khoapham@gmail.com', 'Lê thị riêng', '1234567890', 'Vui lòng chuyển đúng hạn', 0, '2017-03-21 07:20:07', '2017-03-21 07:20:07'),
(11, 'Hương Hương', 'Nữ', 'huongnguyenak96@gmail.com', 'Lê Thị Riêng, Quận 1', '234567890-', 'không chú', 0, '2017-03-21 07:16:09', '2017-03-21 07:16:09'),
(16, 'trần ca', 'Nam', 'tqcao2910@gmail.com', 'dfgsdfgh', '0905123123', 'chuaw', 0, '2021-01-13 09:59:10', '2021-01-13 09:59:10'),
(17, 'trần ca', 'Nam', 'tqcao2910@gmail.com', 'dfgsdfgh', '0905123123', NULL, 0, '2021-01-13 10:00:52', '2021-01-13 10:00:52'),
(18, 'trần ca', 'Nam', 'tqcao2910@gmail.com', 'dfgsdfgh', '0905123123', NULL, 0, '2021-01-13 10:03:44', '2021-01-13 10:03:44'),
(19, 'trần ca', 'Nam', 'tqcao2910@gmail.com', 'dfgsdfgh', '0905123123', NULL, 0, '2021-01-13 10:06:37', '2021-01-13 10:06:37'),
(20, 'traanf', 'Nam', 'asd@gmail.com', 'dfg', '0905332662', NULL, 0, '2021-01-13 10:11:27', '2021-01-13 10:11:27'),
(21, 'rtgr', 'Nam', 'tgrtg@gmail.com', 'rtgrtg', 'rtg', NULL, 0, '2021-01-13 10:32:45', '2021-01-13 10:32:45'),
(22, 'j,hj,', 'Nam', 'tqcao2910@gmail.com', 'dfg', '0903831922', NULL, 0, '2021-01-13 10:33:52', '2021-01-13 10:33:52'),
(23, 'Trần Quang Cao', 'Nam', 'taller.2910@gmail.com', 'đà nẵng', '0903261253', NULL, NULL, '2021-01-16 12:23:36', '2021-01-16 12:23:36'),
(24, 'Trần Quang Cao', 'Nam', 'tqcao2910@gmail.com', 'dfg', '99999999999', NULL, NULL, '2021-01-16 12:27:51', '2021-01-16 12:27:51'),
(25, 'Trần Quang Cao', 'Nam', 'tqcao2910@gmail.com', 'đà nẵng', '45767458', NULL, NULL, '2021-01-16 12:36:44', '2021-01-16 12:36:44'),
(26, 'Trần Quang Cao', 'Nam', 'taller.2910@gmail.com', 'đà nẵng', '0905226223', NULL, NULL, '2021-01-16 19:50:25', '2021-01-16 19:50:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'tiêu đề',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung',
  `image` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'hình',
  `created_by_user` int(10) UNSIGNED NOT NULL,
  `last_modified_by_user` int(10) UNSIGNED NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `created_by_user`, `last_modified_by_user`, `create_at`, `update_at`) VALUES
(1, 'Mùa trung thu năm nay, Hỷ Lâm Môn muốn gửi đến quý khách hàng sản phẩm mới xuất hiện lần đầu tiên tại Việt nam \"Bánh trung thu Bơ Sữa HongKong\".', 'Những ý tưởng dưới đây sẽ giúp bạn sắp xếp tủ quần áo trong phòng ngủ chật hẹp của mình một cách dễ dàng và hiệu quả nhất. ', 'sample1.jpg', 0, 0, '2017-03-11 06:20:23', '2016-10-20 02:07:14'),
(2, 'Tư vấn cải tạo phòng ngủ nhỏ sao cho thoải mái và thoáng mát', 'Chúng tôi sẽ tư vấn cải tạo và bố trí nội thất để giúp phòng ngủ của chàng trai độc thân thật thoải mái, thoáng mát và sáng sủa nhất. ', 'sample2.jpg', 0, 0, '2016-10-20 02:07:14', '2016-10-20 02:07:14'),
(3, 'Đồ gỗ nội thất và nhu cầu, xu hướng sử dụng của người dùng', 'Đồ gỗ nội thất ngày càng được sử dụng phổ biến nhờ vào hiệu quả mà nó mang lại cho không gian kiến trúc. Xu thế của các gia đình hiện nay là muốn đem thiên nhiên vào nhà ', 'sample3.jpg', 0, 0, '2016-10-20 02:07:14', '2016-10-20 02:07:14'),
(4, 'Hướng dẫn sử dụng bảo quản đồ gỗ, nội thất.', 'Ngày nay, xu hướng chọn vật dụng làm bằng gỗ để trang trí, sử dụng trong văn phòng, gia đình được nhiều người ưa chuộng và quan tâm. Trên thị trường có nhiều sản phẩm mẫu ', 'sample4.jpg', 0, 0, '2016-10-20 02:07:14', '2016-10-20 02:07:14'),
(5, 'Phong cách mới trong sử dụng đồ gỗ nội thất gia đình', 'Đồ gỗ nội thất gia đình ngày càng được sử dụng phổ biến nhờ vào hiệu quả mà nó mang lại cho không gian kiến trúc. Phong cách sử dụng đồ gỗ hiện nay của các gia đình hầu h ', 'sample5.jpg', 0, 0, '2016-10-20 02:07:14', '2016-10-20 02:07:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_type` int(10) UNSIGNED NOT NULL,
  `id_company` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT '\'\\\'\\\'\'',
  `unit_price` float NOT NULL,
  `promotion_price` int(4) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new` tinyint(4) NOT NULL DEFAULT 0,
  `last_modified_by_user` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `id_type`, `id_company`, `description`, `unit_price`, `promotion_price`, `image`, `new`, `last_modified_by_user`, `created_at`, `updated_at`) VALUES
(69, 'Xiaomi Realmi 7 Pro', 8, 4, 'Màn hình:\r\nHệ điều hành:\r\nCamera sau:\r\nCamera trước:\r\nCPU:\r\nRAM:\r\nBộ nhớ trong:\r\nThẻ SIM:\r\nDung lượng pin:', 6600000, 0, 'realme-7-pro.jpg', 0, 7, '2021-01-15 17:50:52', '2021-01-15 18:00:53'),
(70, 'iphone 11 pro max', 8, 1, 'Màn hình:<br>\r\nHệ điều hành:<br>\r\nCamera sau:<br>\r\nCamera trước:<br>\r\nCPU:<br>\r\nRAM:<br>\r\nBộ nhớ trong:<br>\r\nThẻ SIM:<br>\r\nDung lượng pin:<br>', 25000000, 20, 'iphone-11-pro-max-green.jpg', 1, 7, '2021-01-15 17:50:52', '2021-01-16 18:25:11'),
(71, 'Realme 7 pro', 8, 6, 'Điện thoại xiaomi', 7000000, 10, 'realme-7-pro.jpg', 1, 7, '2021-01-15 17:50:52', '2021-01-15 18:00:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `slide`
--

INSERT INTO `slide` (`id`, `link`, `image`) VALUES
(1, '', 'banner1.png'),
(2, '', 'banner2.png'),
(3, '', 'banner3.png'),
(4, '', 'banner4.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type_products`
--

CREATE TABLE `type_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_modified_by_user` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `type_products`
--

INSERT INTO `type_products` (`id`, `name`, `description`, `image`, `last_modified_by_user`, `created_at`, `updated_at`) VALUES
(8, 'Điện Thoại', '', 'iphone-11-pro-max-green.jpg', 7, '2021-01-15 17:48:29', '2021-01-15 18:03:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` tinyint(5) UNSIGNED NOT NULL DEFAULT 0,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_modified_by_user` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `level`, `address`, `remember_token`, `last_modified_by_user`, `created_at`, `updated_at`) VALUES
(6, 'Hương Hương', 'huonghuong08.php@gmail.com', '$2y$10$rGY4KT6ZSMmLnxIbmTXrsu2xdgRxm8x0UTwCyYCAzrJ320kYheSRq', '23456789', 0, 'Hoàng Diệu 2', NULL, NULL, '2017-03-23 07:17:33', '2021-01-16 09:58:45'),
(7, 'trần ca', 'taller.2910@gmail.com', '$2y$10$PuVYBGx0mYylnah7tB7n9OjQgU86oxqDFGpvBxUk7SlhCrG45wOS6', '0903831922', 0, 'đà nẵng', NULL, NULL, '2021-01-10 09:00:26', '2021-01-16 09:58:45'),
(8, 'trần ca', 'tqcao2910@gmail.com', '$2y$10$6A8B3yfmmm32Fm3gu9AWd.mPiI1qIY8NMPpJN8oJviT6QnoLsYB6m', '0905123123', 0, 'dfgsdfgh', NULL, NULL, '2021-01-11 06:48:09', '2021-01-16 09:58:45');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_ibfk_1` (`id_customer`);

--
-- Chỉ mục cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_detail_ibfk_2` (`id_product_variant`);

--
-- Chỉ mục cho bảng `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `last_modified_by_user` (`last_modified_by_user`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_user` (`created_by_user`),
  ADD KEY `created_by_user_2` (`created_by_user`),
  ADD KEY `last_modified_by_user` (`last_modified_by_user`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id_type_foreign` (`id_type`),
  ADD KEY `id_company` (`id_company`),
  ADD KEY `last_modified_by_user` (`last_modified_by_user`);

--
-- Chỉ mục cho bảng `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `type_products`
--
ALTER TABLE `type_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `last_modified_by_user` (`last_modified_by_user`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `last_modified_by_user` (`last_modified_by_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `type_products`
--
ALTER TABLE `type_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`last_modified_by_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_id_type_foreign` FOREIGN KEY (`id_type`) REFERENCES `type_products` (`id`);

--
-- Các ràng buộc cho bảng `type_products`
--
ALTER TABLE `type_products`
  ADD CONSTRAINT `type_products_ibfk_1` FOREIGN KEY (`last_modified_by_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`last_modified_by_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
