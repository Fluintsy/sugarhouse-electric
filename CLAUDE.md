# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

WordPress website for Sugar House Electric, a local electrician business. The site is modeled after lighthouse-electrical.com with a focus on professional presentation, service showcases, and easy content management.

## Development Setup

### Local WordPress Development (Docker)

```bash
# Start all containers
docker compose up -d

# Stop containers
docker compose down

# View logs
docker compose logs -f wordpress

# Restart containers
docker compose restart
```

**URLs:**
- WordPress: http://localhost:8080
- phpMyAdmin: http://localhost:8081 (user: root, password: rootpassword)

### WP-CLI (run inside container)

```bash
# Execute WP-CLI commands inside the container
docker compose exec wordpress wp --allow-root <command>

# Examples:
docker compose exec wordpress wp --allow-root plugin list
docker compose exec wordpress wp --allow-root theme activate sugarhouse-electric
```

### Theme Development

```bash
# Navigate to theme directory
cd wp-content/themes/sugarhouse-electric/

# If using npm for asset compilation
npm install
npm run dev      # Development with watch
npm run build    # Production build
```

## Architecture

### WordPress Theme Structure

- `/wp-content/themes/sugarhouse-electric/` - Custom theme
  - `style.css` - Theme metadata and base styles
  - `functions.php` - Theme setup, custom post types, enqueues
  - `template-parts/` - Reusable template components
  - `assets/` - CSS, JS, and images

### Custom Post Types

- **Services** - Electrical services offered (residential, commercial, emergency)
- **Projects** - Portfolio of completed work with images
- **Testimonials** - Customer reviews

### Key Pages

- Home (hero slider, services overview, recent projects, testimonials)
- Services (detailed service descriptions)
- Projects/Portfolio (filterable gallery)
- About
- Contact (form with service area map)

## WordPress CLI Reference

```bash
# Plugin management
wp plugin install <plugin-name> --activate
wp plugin list

# Theme management
wp theme activate sugarhouse-electric

# Content management
wp post create --post_type=service --post_title="Residential Electrical"
wp post list --post_type=project

# Database
wp search-replace 'old-domain.com' 'new-domain.com'
```

## Recommended Plugins

- **Contact Form 7** or **WPForms** - Contact forms
- **Yoast SEO** - Search optimization
- **Smush** or **ShortPixel** - Image optimization
- **UpdraftPlus** - Backups
- **Wordfence** - Security

## Design Reference

Target design based on lighthouse-electrical.com:
- Full-width hero with project imagery
- Service categories with icons/images
- Project portfolio grid
- Trust badges/certifications
- Prominent contact information in header/footer
- Mobile-responsive design
