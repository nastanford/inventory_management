-- Create the database
CREATE DATABASE IF NOT EXISTS inventory_management;
USE inventory_management;

-- Create the inventory table
CREATE TABLE IF NOT EXISTS inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    supplier VARCHAR(255) NOT NULL,
    expiration_date DATE
);

-- Insert sample data
INSERT INTO inventory (item_name, quantity, unit_price, supplier, expiration_date) VALUES
('Apple', 100, 0.50, 'FreshFruits Inc.', '2024-09-30'),
('Banana', 150, 0.30, 'TropicalHarvest Ltd.', '2024-09-15'),
('Milk', 50, 2.99, 'DairyFarms Co.', '2024-09-10'),
('Bread', 75, 1.99, 'BakeryDelights', '2024-09-05'),
('Chicken', 30, 5.99, 'FarmFresh Meats', '2024-09-20');