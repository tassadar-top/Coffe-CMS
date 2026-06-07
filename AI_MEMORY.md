# AI Memory

This file is a compact working memory for future AI sessions on this repository.

## Project identity

- Project name: `Coffee CMS`
- Type: custom modular PHP CMS
- Main idea: one shared CMS core with switchable business profiles
- Important rule: do not split the project into separate engines per niche

## Current business profiles

- `coffee_shop`
- `barber_shop`
- `beauty_services`
- `shawarma_shop`

Each profile enables its own module set and allowed themes through:

- [config/business_profiles/coffee_shop.php](C:/Users/admin4F/Documents/Coffe%20CMS/config/business_profiles/coffee_shop.php)
- [config/business_profiles/barber_shop.php](C:/Users/admin4F/Documents/Coffe%20CMS/config/business_profiles/barber_shop.php)
- [config/business_profiles/beauty_services.php](C:/Users/admin4F/Documents/Coffe%20CMS/config/business_profiles/beauty_services.php)
- [config/business_profiles/shawarma_shop.php](C:/Users/admin4F/Documents/Coffe%20CMS/config/business_profiles/shawarma_shop.php)

## Entry points

- Root entry: [index.php](C:/Users/admin4F/Documents/Coffe%20CMS/index.php)
- Public front controller: [public/index.php](C:/Users/admin4F/Documents/Coffe%20CMS/public/index.php)
- Bootstrap: [bootstrap/app.php](C:/Users/admin4F/Documents/Coffe%20CMS/bootstrap/app.php)
- Fake admin honeypot: [public/admin/index.php](C:/Users/admin4F/Documents/Coffe%20CMS/public/admin/index.php)

## Core architecture

- Core classes live in [app/Core](C:/Users/admin4F/Documents/Coffe%20CMS/app/Core)
- Shared controller helpers live in [app/Core/Controller.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Core/Controller.php)
- Router: [app/Core/Router.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Core/Router.php)
- Config loader: [app/Core/Config.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Core/Config.php)
- DB wrapper: [app/Core/Database.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Core/Database.php)
- View layer: [app/Core/View.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Core/View.php)
- Security helpers: [app/Core/Security.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Core/Security.php)

## Important services

- Business profile manager:
  [app/Services/BusinessProfileManager.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Services/BusinessProfileManager.php)
- Theme manager:
  [app/Services/ThemeManager.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Services/ThemeManager.php)
- Module access guard:
  [app/Services/ModuleAccessService.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Services/ModuleAccessService.php)

## Modules

Main CRUD-like modules currently shaped more than placeholders:

- Pages
- Menu / Catalog
- Promotions
- Themes
- Admin auth

Placeholder-level or partial modules still exist:

- Orders
- Account
- Delivery
- Booking
- Forms
- Gallery
- Masters
- Portfolio
- Pricing
- Reviews
- Users
- Security
- Blog
- Contacts

Most module controllers now use the shared base-controller helpers instead of duplicating auth/CSRF/flash/upload logic.

## Theme system

- Theme configs live in [config/themes](C:/Users/admin4F/Documents/Coffe%20CMS/config/themes)
- Theme PHP templates live in [themes](C:/Users/admin4F/Documents/Coffe%20CMS/themes)
- Theme browser assets live in [public/theme-assets](C:/Users/admin4F/Documents/Coffe%20CMS/public/theme-assets)
- Admin theme picker view:
  [app/Modules/Themes/Views/index.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Modules/Themes/Views/index.php)

### Current theme behavior

- Active theme is read from DB table `themes`
- Public layout is resolved through `ThemeManager`
- Theme template lookup order:
  1. `themes/<active-theme>/<module>/<view>.php`
  2. `themes/<active-theme>/<view>.php`
- This is implemented in [app/Core/View.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Core/View.php)

### Filled theme templates

All themes currently have:

- `layout.php`
- `home.php`

Additional themed public templates currently exist for some modules:

- `menu/public-index.php`
- `services/public-index.php`
- `portfolio/public-index.php`
- `reviews/public-index.php`

Coverage is not yet complete for all public modules like `contacts`, `blog`, `account`, `promotions`.

## Catalog rules

Catalog logic is shared and reusable across businesses.

Important flags in `menu_items`:

- `is_showcase`: item is visible on storefront
- `is_purchasable`: item can be bought / used in order flows

Relevant files:

- [app/Modules/Menu/MenuModel.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Modules/Menu/MenuModel.php)
- [app/Modules/Menu/MenuController.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Modules/Menu/MenuController.php)
- [database/install.sql](C:/Users/admin4F/Documents/Coffe%20CMS/database/install.sql)

## Admin and security

- Custom admin path comes from config
- Fake `/admin` is used as honeypot
- Login attempts are stored in `login_attempts`
- Honeypot hits are stored in `security_logs`
- CSRF is enforced on edit forms
- Image uploads are validated by extension, MIME type, and size

Main files:

- [app/Modules/Admin/AdminController.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Modules/Admin/AdminController.php)
- [app/Core/Security.php](C:/Users/admin4F/Documents/Coffe%20CMS/app/Core/Security.php)

## Database

Main SQL files:

- Schema: [database/install.sql](C:/Users/admin4F/Documents/Coffe%20CMS/database/install.sql)
- Seed data: [database/seed.sql](C:/Users/admin4F/Documents/Coffe%20CMS/database/seed.sql)

There is no migrations system yet; schema is still SQL-file driven.

## Known limitations

- No runtime verification was done in this environment because `php` is not installed here
- Several modules are still placeholders rather than fully working business features
- Repository and service layers are only partially introduced; many models still talk directly to PDO
- UI language is now more consistent, but some future pass may still be useful to unify tone across all templates
- Email sending for orders/operator/client is not implemented yet
- Customer account and order history are architectural placeholders, not full flows yet

## Good next tasks

- Introduce real repository classes for Pages/Menu/Promotions
- Add service layer for orders, customer accounts, and email notifications
- Finish themed templates for `contacts`, `promotions`, `blog`, and `account`
- Add install flow that chooses `business_profile` on first setup
- Add actual order form + persistence + operator/customer email notifications

## Editing guidance for future AI

- Preserve the single-core multi-profile architecture
- Prefer reusing shared modules across business profiles
- Keep themes independent from business logic
- Prefer adding shared helper methods over duplicating controller logic
- Use `apply_patch` for edits
- Do not revert user changes unless explicitly requested
