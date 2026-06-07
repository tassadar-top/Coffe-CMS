INSERT INTO users (username, email, password_hash, role)
VALUES ('admin', 'admin@example.com', '$2y$10$e0NRf8sQIC8Pz8tP9mQ9qOh7C2x6oJq9z1x1fR8x7E6Lq8l0v7x0e', 'admin');

INSERT INTO pages (title, slug, content, image_path, image_alt, status, template) VALUES
('Кавʼярня з характером', 'home', 'Свіжообсмажена кава, десерти та тепла атмосфера в центрі міста.', NULL, NULL, 'published', 'home'),
('Про кавʼярню', 'about', 'Опишіть вашу історію, зерно, обсмаження, команду та атмосферу.', NULL, NULL, 'published', 'default'),
('Контакти', 'contacts', 'Додайте адресу, карту, телефон, графік роботи та соцмережі.', NULL, NULL, 'published', 'default');

INSERT INTO menu_categories (title, slug, sort_order, status) VALUES
('Coffee', 'coffee', 1, 'active'),
('Tea', 'tea', 2, 'active'),
('Desserts', 'desserts', 3, 'active');

INSERT INTO menu_items (category_id, title, description, price, image, image_alt, is_popular, is_new, is_showcase, is_purchasable, status, sort_order) VALUES
(1, 'Flat White', 'Мʼякий еспресо з оксамитовим молоком.', '95 грн', NULL, NULL, 1, 0, 1, 1, 'active', 1),
(1, 'Filter Coffee', 'Чиста чашка дня з сезонного зерна.', '80 грн', NULL, NULL, 0, 1, 1, 1, 'active', 2),
(3, 'Croissant', 'Свіжий круасан до ранкової кави.', '75 грн', NULL, NULL, 1, 0, 1, 0, 'active', 1);

INSERT INTO promotions (title, description, image, image_alt, starts_at, ends_at, status) VALUES
('Кава дня', 'Щоденна спеціальна ціна на вибрану позицію меню.', NULL, NULL, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 'active');

INSERT INTO themes (name, folder, is_active) VALUES
('Coffee Modern', 'coffee-modern', 1),
('Coffee Dark', 'coffee-dark', 0),
('Barber Classic', 'barber-classic', 0),
('Barber Premium', 'barber-premium', 0),
('Beauty Soft', 'beauty-soft', 0),
('Beauty Lux', 'beauty-lux', 0),
('Shawarma Flame', 'shawarma-flame', 0),
('Shawarma Night', 'shawarma-night', 0);

INSERT INTO seo_meta (entity_type, entity_id, meta_title, meta_description, canonical_url, robots) VALUES
('page', 1, 'Кавʼярня з характером', 'Сайт локальної кавʼярні з меню та акціями.', '/', 'index,follow'),
('page', 2, 'Про кавʼярню', 'Історія бренду та атмосфера.', '/about', 'index,follow'),
('page', 3, 'Контакти', 'Адреса, телефон і графік роботи.', '/contacts', 'index,follow');

INSERT INTO settings (setting_key, setting_value) VALUES
('business_profile', 'coffee_shop'),
('default_theme', 'coffee-modern'),
('operator_email', 'orders@example.com'),
('business_name', 'Coffee CMS'),
('tagline', 'One modular CMS for many business profiles'),
('logo_path', ''),
('logo_alt', 'Coffee CMS logo'),
('contact_phone', ''),
('contact_email', 'hello@example.com'),
('address', '');
