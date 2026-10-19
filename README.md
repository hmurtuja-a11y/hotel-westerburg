# Hotel Westerburg – WordPress plugin

Custom code for **Wasserschloss Westerburg** ([hotel-westerburg.de](https://hotel-westerburg.de)).
It's a WordPress plugin, deployed to the live site through the **Deployer for Git** plugin.

## Folder structure – what each file is

```
hotel-westerburg/
├── hotel-westerburg.php      PHP   Main plugin file: name, version, author. Loads everything in /includes.
├── includes/                 PHP   Server-side logic.
│   ├── hooks.php             PHP   General WordPress actions/filters. Add custom behaviour here.
│   ├── assets.php            PHP   Tells WordPress to load the CSS and JS files below.
│   └── index.php             PHP   Empty guard file (stops folder browsing). Don't edit.
├── assets/                         Files sent to the visitor's browser.
│   ├── css/frontend.css      CSS   Custom styles for the site (overrides theme / Elementor).
│   └── js/frontend.js        JS    Custom browser-side scripts.
├── languages/                      Translation files (.po / .mo) for German/English.
├── README.md                 Docs  This file. Not used by WordPress.
├── .gitignore                Git   Files git must never upload (passwords, OS junk, editor files).
└── .gitattributes            Git   Keeps line endings consistent between Windows and the server.
```

Every `index.php` that only says "Silence is golden" is a WordPress security convention; leave them as they are.

## Where do I put new code?

| I want to…                         | Edit this file                 |
|------------------------------------|--------------------------------|
| Change how something looks         | `assets/css/frontend.css`      |
| Add an interactive browser effect  | `assets/js/frontend.js`        |
| Change WordPress behaviour (PHP)   | `includes/hooks.php`           |
| Add a large new feature            | New file in `includes/`, then `require_once` it in `hotel-westerburg.php` |

## Release workflow

1. Edit files locally in this folder.
2. Raise `Version:` **and** `HOTEL_WESTERBURG_VERSION` in `hotel-westerburg.php` (e.g. 1.0.0 → 1.0.1).
3. Commit and push to GitHub:
   ```bash
   git add .
   git commit -m "Describe the change"
   git push
   ```
4. In WordPress: **Deployer for Git → Installed Plugins → Hotel Westerburg → Update / Deploy**
   (or set up Push-to-Deploy so this happens automatically on every push).

### First-time setup in WordPress

Deployer for Git → **Install Plugin** → Provider: GitHub →
Repository URL `https://github.com/hmurtuja-a11y/hotel-westerburg` → Branch `main`.

> Never commit passwords, API keys or `wp-config.php`. This repository is **public**.
