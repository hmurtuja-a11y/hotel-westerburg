# Content changes made in Elementor

Elementor content (pages, header, footer) lives in the WordPress database, not in this repository.
This file is the record of every Elementor change, so git stays the single history of what was changed on
hotel-westerburg.de. Every change below can be undone with Elementor > History > Revisions on the named page or template.

This folder is excluded from the plugin deployment (see `.gitattributes`), so it never reaches the server.

| Date | Page / template (ID) | Element ID | Before | After | Why |
|---|---|---|---|---|---|
| 2026-10-27 | Header Section (8), icon list "Zimmer" | 703f3b2, item 1 "Themenzimmer" | `/themenzimmer/` (301) | `/themenzimmer-wasserschloss-westerburg/` | Internal link went through a redirect on every page (26 SEO issues) |
| 2026-10-27 | Header Section (8), icon list "Events" | eae85d0, item 5 "Eventgalerie" | `/unsere-events-2/` (404) | `/eventgalerie/` | Broken link on every page |
| 2026-10-27 | Home (11), room card container | 77aee93 | `/themenzimmer/` (301) | `/themenzimmer-wasserschloss-westerburg/` | Internal link went through a redirect |
| 2026-10-27 | Direkt buchen (590), text editor | df72359 | `href="/unsere-packages"` (301) | `href="/unsere-packages/"` | Internal link went through a redirect |
| 2026-10-27 | Karriere (44), hidden icon list | f621396 | 6 job links, hidden on all devices (3 dead: 404/410) | Widget deleted | Dead and outdated HotelCareer links read by crawlers; visitors see the live HotelCareer widget |
| 2026-10-27 | Header Section (8), Site Logo | 559703e | Link "Site URL" (`https://hotel-westerburg.de`) | Custom link `https://hotel-westerburg.de/` | Homepage counted as a separate URL without "/" |
| 2026-10-27 | Hochzeiten und Festlichkeiten (32), button "zu den Räumlichkeiten" | e25fa3c | `/Raeumlichkeiten` | `/raeumlichkeiten/` | Upper-case duplicate URL with redirect |
| 2026-10-26 | Burg Package (3739), second "JETZT BUCHEN" button | 69940ef | `/Burg-Package` (itself) | Booking engine, 5 nights, rate 5077445 | Button linked to its own page |
| 2026-10-26 | Unsere Packages (30), package headings and images | 3601a0f, 7a6e90a, df73430, 158c5e7, 95f316c, 12100d4, f04005b, e5259ec, c50606d, 77a13e6 | No link | Link to each package page | Orphan pages |
| 2026-10-26 | Home (11), package images | b1e7a4e, aed190b | `/unsere-packages/#spapackage`, `#burgpackage` | `/spa-package/`, `/burg-package/` | Orphan pages |

Settings changed outside Elementor:

| Date | Where | Change | Why |
|---|---|---|---|
| 2026-10-26 | Rank Math (Pages list, bulk action) | `/feedback/`, `/neujahrspackage/`, `/sommerspas-abkuhlung-package/` set to noindex | Same pages as `includes/seo.php`; removes them from the Rank Math sitemap |
| 2026-10-28 | WordPress Pages (REST, block editor) | New pages `/danke-kontakt/` (4263), `/danke-arrangement/` (4264), `/danke-blaue-lagune/` (4265): heading + one line, published | Thank-you pages for the enquiry forms; they count conversions for the new Google Ads campaigns. Hidden from Google by `includes/seo.php` (v1.3.0) |
| 2026-10-28 | Google Tag Manager GTM-N9PDK9SM | Version 40 "WBG NEW 1 - new campaign conversions" published: 8 variables, 5 triggers, 9 tags, all named `WBG NEW`; no existing item changed | Own conversions for the new campaigns. Undo: publish version 39 |
| 2026-10-29 | WordPress Settings > General | Site Language: English (United States) → Deutsch. Before that, admin profile language (H. Murtuja) set from "Site Default" to English so wp-admin stays English | German pages declared themselves English (`lang="en"`, `og:locale en_US`, schema `inLanguage en`, feed `en`); now `de` / `de_DE`. 25 pages all 200, no other change; booking bar, GTM, GTranslate, 360° tours, no console errors checked. Complianz banner text unchanged (still English, stored in Complianz). Backup taken by the user before. Undo: set Site Language back to English (United States) |
| 2026-10-29 | Deployer for Git | Plugin v1.5.0 deployed (commit 6959cc8): Gutenberg global styles removed | Unused inline CSS, −11.1 KB per page. 25 pages all 200, only global styles changed; page heights and booking-button positions on Home, Unsere Packages, Wellness, Galerie, Restaurant identical to before; no console errors. Undo: revert the commit and deploy |
| 2026-10-29 | Deployer for Git | Plugin v1.4.0 deployed (commit 0ac568e): WordPress emoji script/styles removed | Loaded twice on every page; −7.1 KB per page. Checked 25 pages before/after: all 200, only the emoji script changed, no console errors. Undo: revert the commit and deploy |
| 2026-10-28 | Google Ads 705-425-4472 | 5 conversion actions `WBG NEW \| ...` (Secondary) and custom goal "WBG NEW - Buchungen & Anfragen" (6459683625), not assigned to any campaign | Primary goal for the new campaigns only |
