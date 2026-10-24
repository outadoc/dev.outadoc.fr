# dev.outadoc.fr

Static version of the portfolio, built with [Jekyll](https://jekyllrb.com) and deployed to GitHub Pages
by `.github/workflows/pages.yml` on every push to `develop` that touches `static/`.

English pages are served at the root and French pages under `/fr/`.

## Editing projects

Each project is a Markdown file in `_projects/`, named after its URL (`_projects/twistoast.md` → `/projects/twistoast/`):

```yaml
---
name: Twistoast
category: app                 # a key from _data/categories.yml
start_year: 2013
end_year: null                # null means "–Today"
featured: true                # optional: shown at the top of the projects page
thumbnail: <file>.png         # in assets/img/data/thumb/; optional, falls back to the first screenshot
short_description:
  en: Stay informed of the schedule of the Twisto bus network in real time.
  fr: Restez informé en temps réel des horaires sur le réseau Twisto.
screenshots:                  # in assets/img/data/screen/
- <file>.png
downloads:
- platform: Android           # "Web" as the first platform shows a "Go to the website" button instead
  url: https://play.google.com/store/apps/details?id=fr.outadev.twistoast
  source: https://github.com/outadoc/Twistoast-android   # optional, '' if closed source
  price: 0                    # in euros, 0 means free
  version: '2.5'
description_fr: |
  French description, in Markdown.
---
English description, in Markdown.
```

To hide a project without deleting it, add `published: false`.

Interface strings (navigation, home page, category names) are translated in `_data/i18n.yml`.

## Running locally

The tools run in a [distrobox](https://distrobox.it), so nothing is installed on the host. One-time setup:

```sh
distrobox create --name outadev --image registry.fedoraproject.org/fedora-toolbox:44
distrobox enter outadev -- sudo dnf install -y ruby ruby-devel gcc gcc-c++ make redhat-rpm-config \
    nodejs24 nodejs24-bin nodejs24-npm nodejs24-npm-bin
distrobox enter outadev
cd static
npm install
bundle config set --local path vendor/bundle
bundle install
```

Then, inside the distrobox, run each of these in its own terminal:

```sh
npm run watch                          # rebuilds JS and CSS from _assets/ into assets/build/
bundle exec jekyll serve --livereload  # serves the site on http://127.0.0.1:4000
```

To check links and images like the deployment does:

```sh
npm run build && bundle exec jekyll build
bundle exec htmlproofer _site --disable-external --ignore-missing-alt --checks Links,Images,Scripts --no-enforce-https --allow-missing-href
```

## Layout

- `_layouts/`, `_includes/`: page templates.
- `_plugins/localized_project_pages.rb`: generates each project's page in every language.
- `_assets/`: JavaScript and CSS sources, bundled by esbuild into `assets/build/` (not committed).
- `assets/img/data/`: project thumbnails and screenshots.
