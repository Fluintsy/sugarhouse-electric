# Sugar House Electric Website

Website for Sugar House Electric, a local electrician serving the Salt Lake City area.

## Status

Live as a static site on GitHub Pages: https://fluintsy.github.io/sugarhouse-electric/

- Source: static HTML/CSS/JS in `docs/`, served from the `master` branch (`/docs`).
- Deploy: push to `master`; GitHub Pages rebuilds automatically.
- Contact form: posts to Formspree (configured in `docs/contact.html`).
- Domain: owned by the client; no custom domain is configured on the Pages side.

## Local preview

```bash
python3 -m http.server 8000 --directory docs
# open http://localhost:8000
```

## Structure

```
.
├── docs/                  # The live site (index, about, services, projects, contact)
│   └── assets/            # css, js, images
├── wp-content/            # Legacy WordPress theme (not deployed)
├── docker-compose.yml     # Legacy local WordPress environment (not deployed)
├── CLAUDE.md              # Guidance for Claude Code
└── README.md
```

The WordPress theme and Docker setup are from an earlier approach and are kept for reference only. Changes to the live site go in `docs/`.

---

**Client:** Sugar House Electric
