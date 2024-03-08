CREATE TABLE IF NOT EXISTS `users`(
    `user_id` INT PRIMARY KEY AUTO_INCREMENT,
    `fullname` VARCHAR(100) NOT NULL,
    `username` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS `products`(
    `product_id` INT PRIMARY KEY AUTO_INCREMENT,
    `product_title` VARCHAR(255) NOT NULL,
    `product_price` DECIMAL(10, 2) NOT NULL,
    `product_code` VARCHAR(255) NOT NULL,
    `product_image` VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `user_roles`(
    `role_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT,
    `user_role` VARCHAR(20) DEFAULT 'user',
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS `cart`(
    `cart_id` INT PRIMARY KEY AUTO_INCREMENT,
    `product_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `cart_qty` INT NOT NULL,
    `cart_price` DECIMAL(10, 2) NOT NULL,
    `order_status` VARCHAR(20) DEFAULT 'Pending',
    `total_price` VARCHAR(20) DEFAULT NULL,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS `order_product`(
    `order_id` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `phone` BIGINT NOT NULL,
    `gender` VARCHAR(255) NOT NULL,
    `shipping_method` VARCHAR(255) NOT NULL,
    `total_products` INT NOT NULL DEFAULT '1',
    `total_price` INT NOT NULL DEFAULT '1',
    `user_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `checkout_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `product_quantity` VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY(user_id) REFERENCES users(user_id),
    FOREIGN KEY(product_id) REFERENCES products(product_id)
);

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
    `id` int NOT NULL AUTO_INCREMENT,
    `payer_name` text NOT NULL,
    `payer_email` text NOT NULL,
    `address` text NOT NULL,
    `product_id` text NOT NULL,
    `product_title` text NOT NULL,
    `quantity` text NOT NULL,
    `amount` text NOT NULL,
    `status` text NOT NULL,
    `created_at` text NOT NULL,
    PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `wishlist`(
    `wishlist_id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `product_id` INT NOT NULL, 
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

INSERT INTO `payments` (`id`, `payer_name`, `payer_email`, `address`, `product_id`, `product_title`, `quantity`, `amount`, `status`, `created_at`) VALUES
(1, 'John Doe', 'sb-j47k47e29531484@personal.example.com', '1 Main St, San Jose, CA, US, 95131', '', 'payer', '1', '755.00', '', '2024-02-29T11:20:07Z'),
(2, 'John Doe', 'sb-j47k47e29531484@personal.example.com', '1 Main St, San Jose, CA, US, 95131', '3', 'Adipisicing nemo dol', '1', '1178.00', '', '2024-02-29T13:17:48Z'),
(3, 'John Doe', 'sb-j47k47e29531484@personal.example.com', '1 Main St, San Jose, CA, US, 95131', '3', 'Adipisicing nemo dol', '1', '1178.00', '', '2024-02-29T13:34:25Z'),
(4, 'John Doe', 'sb-j47k47e29531484@personal.example.com', '1 Main St, San Jose, CA, US, 95131', '3', 'Adipisicing nemo dol', '1', '1178.00', '', '2024-02-29T13:37:42Z');

ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);