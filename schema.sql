CREATE TABLE IF NOT EXISTS `admin`(
    `id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `fullname` VARCHAR(100) NOT NULL,
    `username` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL,
)
INSERT INTO
    `admin` (`id`, `fullname`, `username`, `password`)
VALUES
    (
        1,
        'Prabhat Gurung',
        'prabhatgrg',
        'f3ed11bbdb94fd9ebdefbaf646ab94d3'
    ),
    (
        2,
        'Neer Shrestha',
        'neersth',
        'f3ed11bbdb94fd9ebdefbaf646ab94d3'
    );

CREATE TABLE IF NOT EXISTS `clothes`(
    `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `product_code` INT(255) NOT NULL, 
    `image_name` VARCHAR(255) NOT NULL,
)