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
