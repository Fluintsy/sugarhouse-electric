# Sugar House Electric Website

WordPress website for Sugar House Electric, a local electrician business serving the Salt Lake City area.

## Overview

Professional electrical contracting website featuring:
- Service showcase (residential, commercial, emergency)
- Project portfolio with case studies
- Customer testimonials
- Contact and service area information
- Mobile-responsive design

## Quick Start

### Development Setup (Docker)

```bash
docker compose up -d
```

**Access URLs:**
- WordPress Admin: http://localhost:8080/wp-admin
- Frontend: http://localhost:8080
- Database: http://localhost:8081 (phpMyAdmin)

### Stop

```bash
docker compose down
```

## Project Structure

```
.
├── CLAUDE.md                          # Claude AI guidance
├── docker-compose.yml                 # Docker configuration
├── seed-content.sql                   # Initial database content
├── wp-content/
│   ├── themes/
│   │   └── sugarhouse-electric/       # Custom theme
│   ├── plugins/                       # Third-party plugins
│   └── uploads/                       # Media library (not tracked)
└── README.md                          # This file
```

## Custom Theme

Located in `/wp-content/themes/sugarhouse-electric/`

### Key Features

- **Custom Post Types:** Services, Projects, Testimonials
- **Responsive Design:** Mobile-first approach
- **SEO-Ready:** Clean structure with Yoast SEO support
- **Performance:** Lazy-loaded images, optimized assets

## Deployment

### Requirements

- PHP 7.4+
- MySQL 5.7+
- WordPress 6.0+

### Production Checklist

- [ ] Update `wp-config.php` with secure keys/salts
- [ ] Configure domain and SSL
- [ ] Set up automated backups
- [ ] Install security plugins (Wordfence, etc.)
- [ ] Enable caching (WP Super Cache, LiteSpeed Cache)
- [ ] Optimize images (Smush, ShortPixel)
- [ ] Test forms and contact functionality
- [ ] Verify mobile responsiveness
- [ ] Set up monitoring and alerts

## Common Tasks

### Add a New Service

```bash
docker compose exec wordpress wp --allow-root post create \
  --post_type=service \
  --post_title="Residential Rewiring" \
  --post_content="Description here" \
  --post_status=publish
```

### Add a Project/Portfolio Entry

```bash
docker compose exec wordpress wp --allow-root post create \
  --post_type=project \
  --post_title="Downtown Office Complex" \
  --post_content="Project details" \
  --post_status=publish
```

### Database Operations

- **Backup:** `docker compose exec db mysqldump -u root -prootpassword wordpress > backup.sql`
- **Restore:** `docker compose exec -T db mysql -u root -prootpassword wordpress < backup.sql`

## Support

For WordPress-specific issues or theme customization, refer to `CLAUDE.md`.

---

**Client:** Sugar House Electric  
**Status:** In Development  
**Last Updated:** March 2026
