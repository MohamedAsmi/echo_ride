# EcoRide Car Rental System

## Project Overview
EcoRide is a PHP-based car rental system that allows users to register, book cars, and manage reservations.

## Features
- Customer (add)
- Car management (add/update cars, check availability, Book)
- Invoice (Read)
- Category (add)
- Model (add)
- Car (add)



## Database Setup

1. Open your preferred database management tool (e.g., phpMyAdmin, MySQL Workbench).  
2. Create a new database, e.g., `ecoride`.  
3. Import the SQL file located at `database/ecoride.sql`.  

```bash
# Using MySQL CLI
mysql -u username -p
CREATE DATABASE ecoride;
USE ecoride;
SOURCE path/to/database/ecoride.sql;
