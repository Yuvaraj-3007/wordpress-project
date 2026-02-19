# ============================================
# Dockerfile - WordPress Project
# Author: Yuvaraj Pandian
# ============================================

# Step 1: Use official WordPress image
FROM wordpress:6.4-apache

# Step 2: Install WP-CLI (WordPress command line tool)
RUN curl -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x /usr/local/bin/wp

# Step 3: Copy custom theme and plugins
COPY wp-content/ /var/www/html/wp-content/

# Step 4: Set correct permissions
RUN chown -R www-data:www-data /var/www/html/wp-content

# Step 5: Expose port 80
EXPOSE 80
