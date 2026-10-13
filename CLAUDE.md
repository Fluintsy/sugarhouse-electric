# CLAUDE.md

Guidance for Claude Code when working in this repository.

## Project Overview

Website for Sugar House Electric, a local electrician (Salt Lake City area). Client site: the content is ours, the domain belongs to the client.

## What is live

A static site in `docs/`, served by GitHub Pages from `master` `/docs` at https://fluintsy.github.io/sugarhouse-electric/. Pushing to `master` deploys it. Edit `docs/` for any site change; there is no build step.

- Pages: `index.html`, `about.html`, `services.html`, `projects.html`, `contact.html`
- Assets: `docs/assets/{css,js,images}`
- Contact form: Formspree, configured in `docs/contact.html`. Do not commit account credentials.

## Local preview

```bash
python3 -m http.server 8000 --directory docs
```

## Legacy (not deployed)

`wp-content/` (WordPress theme) and `docker-compose.yml` are from an earlier WordPress approach. Do not assume the site runs on WordPress. Do not extend the theme unless the project moves back to WordPress. Compose contains local-dev placeholder database passwords for that legacy setup only.

## Conventions

- Keep changes to `docs/` small and reviewable; the site is public as soon as `master` updates.
- No secrets, keys, or client-private information in this repo (it is public).
