# Phase 3 — Homepage implementation

Target: http://localhost/pradeep/
Scope: homepage only. Phase 4 has not started.

## 1. Redesign summary

Implemented the Phase 2 forest-green/cream editorial direction with real local photographs, bilingual interface copy, compact section spacing, clear typography, restrained interactions, and a homepage-specific shell. The header and footer change only on the homepage; existing inner-page layouts are retained.

## 2. Sections implemented

The requested order is preserved: header; photographic hero; non-numeric impact strip; introduction; flagship campaigns; Green Gang spotlight; social impact areas; campaign-sourced impact stories; service timeline; field-work gallery; recognition; newspaper collection; events; literature/culture; latest articles; sourced quote; volunteer/contact CTA; contact preview; footer. This is 17 main sections plus header/footer.

Data-dependent sections adapt to actual availability rather than inventing entries. The timeline currently has one campaign-sourced Green Gang milestone because the local timeline query returns no entries. The recognition section uses an existing ceremony photograph; named award cards render only when real qualifying timeline records exist.

## 3–4. Components reused and created

Reused: existing PHP MVC conventions, URL/escaping/date/session/CSRF helpers, ContentModel and Blog read methods, existing form contracts, Font Awesome, existing photographic assets, and the Phase 2 design/component specifications.

Created: homepage shell, header/navigation, footer/newsletter, section heading renderer, responsive image renderer, reusable campaign/article card, grouped page-section partials, native-dialog lightbox, disclosure navigation, native-details timeline and media disclosure. The Phase 2 components were specifications, so their runtime PHP implementations are new in this phase.

## 5. Data sources

| Section | Source |
| --- | --- |
| Hero/introduction | Existing real project photographs and existing biography themes |
| Impact strip | Non-numeric descriptions of established work areas |
| Campaigns / stories | Existing campaigns table via ContentModel |
| Green Gang | Actual Hariyali campaign record, excerpt, slug; introductory summary of its existing content |
| Timeline | Existing timeline method; current fallback uses the 2019 milestone documented in the Green Gang campaign |
| Gallery | Existing gallery records whose image files are available locally |
| Recognition | Existing ceremony photograph; optional qualifying timeline records |
| Media | Existing newspaper_cuttings records with available local images |
| Events | Existing event dates, titles, locations and slugs; presentation sorted by actual date in Asia/Kolkata |
| Literature | Existing Awadhi campaign and article route |
| Articles | Blog::allPublished(4), currently two published records |
| Quote | Existing website quote recorded during Phase 1 and supplied in the Phase 3 brief |
| Contact | Existing settings, with known demo defaults suppressed |
| Footer newsletter | Existing POST /, form_type=newsletter, email and CSRF contract |

No CMS-managed title/excerpt is replaced with hardcoded promotional content. Hindi/Awadhi content remains in its original language even under the English interface and receives a language attribute. No fabricated English translations of authored articles, dates, counts, awards, or locations.

## 6. Existing files modified

- `controllers/PageController.php`: only home() data assembly, using existing read methods for published articles, campaigns, events, gallery, newspaper records and timeline. Avoids the previous homepage's unused demo slider/team/stat queries and provides sufficient records to choose existing local images and sort events.
- `views/layouts/main.php`: early homepage-only delegation; existing inner-page shell remains intact.
- `views/pages/home.php`: small composition template including four section partials.

No models, admin files, shared helpers, route definitions, configuration, schema, uploads, or inner-page templates changed.

## 7. Files created

- `views/layouts/home.php`
- `views/partials/home/presentation.php`
- `views/partials/home/header.php`
- `views/partials/home/footer.php`
- `views/partials/home/introduction.php`
- `views/partials/home/initiatives.php`
- `views/partials/home/journey.php`
- `views/partials/home/journal.php`
- `views/components/home/content-card.php`
- `assets/css/site/home.css`
- `assets/css/site/no-script.css`
- `assets/js/site/home.js`
- `assets/images/home/manifest.json`
- `assets/images/home/icon.svg`
- 47 content-hashed WebP derivatives in `assets/images/home/`
- `docs/phase-3-implementation.md`

Phase 2's existing documentation remains unchanged. The image manifest maps every derivative to its source. Original images/uploads remain intact.

## 8–9. CSS and JavaScript

Homepage CSS is approximately 23 KB, scoped to the new public shell/classes, with explicit mobile layouts and reduced-motion rules. It does not load or modify the legacy public stylesheet, Bootstrap overrides, or the large embedded article-reader stylesheet. No inline styles are introduced.

Homepage JavaScript is approximately 3.5 KB and deferred. It provides mobile disclosure behavior, sticky-header state, safe text-based lightbox captions, native dialog close/Escape/focus restoration, image failure handling, and respects modifier-click navigation. No jQuery/Bootstrap bundle is needed on this homepage. Existing inner pages retain their original dependencies. No added packages.

The mobile menu is an inline disclosure, not a modal drawer, so keyboard focus is intentionally not trapped. Lightbox is modal and uses the browser's native focus containment. No-JavaScript navigation has a separate fallback stylesheet; image links and timeline disclosures remain functional without JS.

## 10. Image optimization

Created additive WebP sizes up to 480/960/1440px, capped at original dimensions, with width/height attributes, srcset, sizes, eager high-priority hero and lazy secondary images. Originals are not overwritten or renamed. Duplicate byte-identical sources reuse content-hashed derivatives.

Hero original: 465,973 bytes; variants: 30,232 / 77,822 / 130,484 bytes. The largest hero variant is approximately 72% smaller than its original. All generated responsive derivatives total approximately 3.41 MB on disk, compared with 13.07 MB across their mapped original source paths; this is not a page-transfer measurement.

Missing local uploads are not requested, so homepage images do not inherit their existing 404s. Unrelated photographs are not substituted into campaign records. Media/certificate images retain readable natural proportions and link to originals.

## 11–13. Verification

See the final verification record below. Requests were read-only; no signup, donation, newsletter, or contact submission was sent. Admin verification covers the unauthenticated entry page and source isolation, not authenticated CMS end-to-end testing.

## 14. Remaining performance considerations

- Font Awesome and Google Fonts remain external CDN dependencies. No new icon or animation library was introduced.
- Image dimensions reserve layout space, but no laboratory CLS/LCP score or slow-device Lighthouse benchmark is claimed.
- Gallery/media read up to 100 metadata records to locate available local assets; thumbnails are bounded on initial display and extra media sits in a disclosure.
- Derivatives are generated only for current local files. Future uploads render safely at original size until new derivatives are produced.
- Some archived photographs depict the same ceremony. A curated homepage-feature flag would improve selection but would require separately approved CMS work.

## 15–16. Known limitations and missing content

- Environmental campaign photographs referenced by the local database are missing. Green Gang uses its real campaign story and an editorial greeting panel, without a substitute environmental image.
- Many gallery and clipping uploads are missing locally; only available images appear.
- Local timeline returns no entries. Named awards, awarding bodies and certificate relationships are not available; no fake award list is generated.
- Local contact settings resolve to known demo defaults. Those values are suppressed on the homepage; the real contact page remains linked and unchanged.
- Only two published articles are available, so no three additional placeholder articles are created.
- Existing event records say upcoming even for elapsed dates. Only homepage display derives Upcoming/Today/Completed from dates; stored values and inner-page behavior remain unchanged.
- There is no separate media or awards route. Media expands in place; recognition links to the existing biography. Gallery links are labeled Portfolio to avoid pretending portfolio and gallery tables are one collection.
- Existing contact/newsletter session-only persistence, donation behavior, missing inner-page images, and other Phase 1 issues remain outside this phase.
- There is no inferred environmental impact count or measurable outcome; the impact strip uses meaningful words instead of numbers.

## 17. Manual review recommendations

Review the homepage in both languages on a real mobile device, especially the hero photo selection, cropped gallery previews, press-clipping legibility, editorial Hindi typography, and sparse timeline/award content. Approve real contact settings and provide missing campaign photographs through the existing CMS workflow when available. Inner pages deliberately retain their older design until Phase 4 approval.

Stop after Phase 3. No Phase 4 redesign is authorized by this implementation.

## Final verification record

- PHP syntax: all 24 public templates/presentation files plus controller files included in the check passed (24 files total).
- Browser: installed headless Chrome, using an isolated temporary profile after the connected Browser surface was unavailable.
- Both Hindi and English tested at 360, 390, 430, 768, 1024, 1366 and 1440px. All 14 combinations had one H1, no horizontal overflow, and no broken loaded homepage images.
- Mobile menu open/close, Escape, and focus return passed in both languages.
- Gallery lightbox open/close, Escape, and return to the activating image passed in both languages.
- 62 local homepage navigation/image URLs returned HTTP 200; no missing homepage anchor targets or PHP fatal/parse-error markers were found. This includes representative campaign/event/blog pages, contact, donation, volunteer, portfolio, and the admin entry.
- A missing favicon request was caught and fixed. Subsequent browser checks reported no JavaScript exceptions or browser resource errors.
- Full-page desktop captures and 390px mobile captures were inspected in both languages. Real devices, assistive-technology user testing, authenticated CMS workflows, and submission persistence are not claimed as verified.
- Only three pre-existing files changed: homepage controller data assembly, main-layout delegation, and the homepage composition template. Original assets, database/configuration/routing files, admin files, language dictionaries and all inner-page templates match their pre-implementation hashes.
- Key opaque color pairs retain the Phase 2 contrast checks. No formal WCAG certification or measured Core Web Vitals score is claimed.

Screenshots and detailed automated logs were generated under `/tmp/pradeep-*`; they are review artifacts, not production dependencies.
