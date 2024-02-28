CREATE TABLE IF NOT EXISTS `users`(
    `user_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `fullname` VARCHAR(100) NOT NULL,
    `username` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL,
)
INSERT INTO
    `user` (`id`, `fullname`, `username`, `password`)
VALUES
    (
        1,
        'Prabhat Gurung',
        'prabhatgrg',
        '123'
    ),
    (
        2,
        'Neer Shrestha',
        'neersth',
        '123'
    );

CREATE TABLE IF NOT EXISTS `products`(
    `product_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `product_title` VARCHAR(255) NOT NULL,
    `product_price` DECIMAL(10, 2) NOT NULL,
    `product_code` INT(255) NOT NULL, 
    `product_image` VARCHAR(255) NOT NULL,
)

CREATE TABLE IF NOT EXISTS `user_roles`(
    `role_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id` INT DEFAULT NULL,
    `user_role` VARCHAR(20) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO `user_roles`(
    `role_id`,
    `user_id`,
    `user_role`
)VALUES(
    1,
    1,
    'admin'
),
(
    2,
    2,
    'user'
)

CREATE TABLE IF NOT EXITS `cart`(
    `cart_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `product_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `cart_qty` INT NOT NULL,
    `cart_price` DEMICAL(10, 2) NOT NULL,
    `product_image` VARCHAR(255) NOT NULL,
    `order_status` VARCHAR(20) DEFAULT 'Pending',
    `total_price` VARCHAR(20) DEFAULT NULL,
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    FOREIGN KEY (user_id) REFERENCES products(user_id),
    FOREIGN KEY (product_image) REFERENCES products(product_image),
)

CREATE TABLE IF NOT EXISTS `order_product`(
    `order_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
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
    `product_quantity` VARCHAR(255) DEFAULT NULL
);