#!/bin/bash

# Define variables
DB_NAME="IT"
SQL_SCRIPT="duombaze.sql"
PHP_FILES_DIR="src"
WEB_DIR="/var/www/html/IT"

# Check if the script is being run as root (necessary for copying to /var/www/html)
if [ "$(id -u)" -ne 0 ]; then
  echo "You must run this script as root (use sudo)."
  exit 1
fi

# Create the database and tables using the SQL script
echo "Running SQL script to create database and tables..."
mysql -u stud -pstud < "$SQL_SCRIPT"
if [ $? -ne 0 ]; then
  echo "Error running SQL script."
  exit 1
fi

echo "SQL script executed successfully."

# Ensure the target directory exists
echo "Copying PHP files to $WEB_DIR..."
rm -rf "$WEB_DIR"
mkdir -p "$WEB_DIR"
cp -r "$PHP_FILES_DIR"/* "$WEB_DIR/"
if [ $? -ne 0 ]; then
  echo "Error copying PHP files."
  exit 1
fi

echo "PHP files copied successfully to $WEB_DIR."

# Set proper permissions for the web server to access the files
# echo "Setting file permissions..."
# chown -R www-data:www-data "$WEB_DIR"
# chmod -R 755 "$WEB_DIR"

echo "Setup complete."
