# Phase 2 — Design system and component architecture

Status: ready for review; homepage implementation awaits Phase 3 approval.
Target: http://localhost/pradeep/
Baseline: Phase 1 audit and local PHP source. Production is not the implementation target.
Scope: specification only. No runtime styles, templates, routes, models, database changes, packages, or admin changes are introduced.

## 1. Final visual direction

**People + Nature + Service + Culture + Impact.** An editorial personal portfolio documenting Pradeep Sarang's service through real people, places, photographs, campaigns, literature, and verified recognition.

Use warm cream canvases, forest-green anchors, restrained saffron accents, generous whitespace, strong bilingual headings, and documentary photography. Establish identity through the person and their work; emphasize Green Gang / Green Morning as the signature environmental story. Alternate large campaign photographs, editorial rows, compact impact areas, quotes, and a service timeline. Avoid repeated identical card grids, decorative badges on every heading, artificial counters, continuous effects, and oversized pill buttons.

Visual hierarchy: person and purpose → signature environmental work → wider service → documented journey and recognition → literature/community participation. This is a direction, not an implemented homepage sequence.

Existing factual copy may be reused. New headlines below are draft interface copy, not new biographical claims. Do not infer impact numbers, awarding bodies, dates, or testimonials from decorative assets.

## 2. Semantic color system

Continue native CSS custom properties. Future tokens use `--ps-` names and are scoped to `.ps-site` on the public shell, avoiding collisions with legacy `--primary`, Bootstrap, and admin styles. Do not redefine legacy root tokens during migration.

| Token suffix | Value | Role |
| --- | --- | --- |
| primary | #15803D | Main actions, links, environmental identity |
| primary-dark / hover | #14532D | Primary hover, strong green text |
| primary-light | #22C55E | Decorative accents on dark surfaces |
| secondary / forest | #0F3D24 | Footer, signature sections, dark action |
| accent | #F59E0B | Small warm highlights; pair with dark text |
| terracotta | #C65D32 | Cultural accents and decorative rules |
| background | #FFFDF7 | Main warm canvas |
| surface | #FFFFFF | Cards and fields |
| surface-alt | #F3F8F3 | Quiet section variation |
| text-primary | #17221B | Main text |
| text-secondary | #647067 | Supporting text on light surfaces |
| text-muted | #8A948D | Disabled/decorative text only; not meaningful body copy |
| text-inverse | #FFFFFF | Dark-surface text |
| border | #E4EAE5 | Decorative card boundaries |
| border-soft | #EEF2EE | Separators |
| border-control | #647067 | Identifiable input boundaries |
| focus | #14532D | Light-background focus outline |
| focus-inverse | #F59E0B | Dark-background focus outline |
| overlay | rgba(15,61,36,.72) | Initial image overlay; verify per image |
| success | #16A34A | Status accent, not small text on white |
| success-text | #14532D | Readable success message |
| warning | #D97706 | Status accent |
| warning-text | #92400E | Readable warning message |
| error | #DC2626 | Error state and text on white |

Normal text requires at least 4.5:1 contrast; large text and essential UI boundaries require 3:1. Use white on primary, dark text on saffron, and inverse text on forest. Do not use white small text on saffron, bright green, or terracotta. Weak decorative borders must not be the sole indication of interactive controls. Recheck combinations with opacity, imagery, hover, and disabled states during implementation.

## 3. Typography

Retain **Manrope** for English UI and add **Noto Sans Devanagari** for Hindi UI. Preserve **Noto Serif Devanagari** for literary reading and selected quotes. Retire decorative Latin families from the new public shell only after existing reader dependencies are checked. Load only needed weights (400, 500, 600, 700), with swap behavior; no new package is needed. Self-host only if suitable licensed font files are available; otherwise use the existing font delivery mechanism.

Proposed stacks: UI `Manrope, Noto Sans Devanagari, system-ui, sans-serif`; Hindi UI `Noto Sans Devanagari, Manrope, sans-serif`; literary text `Noto Serif Devanagari, serif`. Mark known Hindi content with `lang="hi"` even when the interface language is English. Do not pretend untranslated content is English.

All sizes below are rem-based endpoints at a 16px root. Use fluid interpolation between 360px and 1440px; e.g. H1 `clamp(2rem, 1.5rem + 2.22vw, 3.5rem)`. Preserve browser text scaling.

| Token | Mobile → desktop | Weight | Line height |
| --- | --- | --- | --- |
| Display XL | 40 → 68px | 700 | 1.25; Hindi 1.4 |
| Display | 36 → 60px | 700 | 1.3; Hindi 1.4 |
| H1 | 32 → 56px | 700 | 1.3; Hindi 1.4 |
| H2 | 28 → 44px | 700 | 1.35; Hindi 1.45 |
| H3 | 24 → 32px | 700 | 1.4 |
| H4 | 21 → 26px | 600 | 1.45 |
| H5 | 18 → 20px | 600 | 1.5 |
| Body large | 18 → 20px | 400 | 1.75; Hindi 1.85 |
| Body | 16 → 18px | 400 | 1.75; Hindi 1.85 |
| Body small | 14 → 16px | 400 | 1.7 |
| Caption | 13 → 14px | 400 | 1.6 |
| Label | 14 → 16px | 600 | 1.5 |
| Button | 14 → 16px | 600 | 1.5 |
| Quote | 24 → 36px | 500 | 1.6; Hindi 1.8 |

Use normal letter spacing for Devanagari; never inherit the current negative heading spacing. English display text may use -0.02em. Avoid justified interface paragraphs, uppercase Hindi, clipping accents, and fixed-height headings. Body reading measure is approximately 60–70 Latin characters; test Hindi visually rather than relying solely on `ch` units.

## 4. Spacing

Tokens `--ps-space-1` through `--ps-space-13`: 4, 8, 12, 16, 20, 24, 32, 40, 48, 64, 80, 96, 120px, expressed in rem.

Semantic aliases: section padding 48px mobile / 64px tablet / 96px desktop; feature section maximum 120px; card padding 20 / 24 / 32px; grid gap 16 / 24 / 32px; text stack 16–24px; eyebrow-to-title 12px; title-to-description 16px; title group-to-content 32 / 40 / 48px. Form field stack 20–24px. Apply these aliases consistently rather than adding arbitrary offsets.

## 5. Containers and grids

Main container: maximum 1280px usable content, centered, bounded by viewport gutters. Editorial container: maximum 780px. Wide media: maximum 1440px or intentionally full bleed. Gutters: 16px below 768px, 24px at 768–1199px, 32px from 1200px.

Retain Bootstrap 5.3 layout breakpoints and grid machinery. Future `.ps-container` must not globally change `.container`. Standard cards: one column on phones, two from 768px, three from 1200px. Compact impact areas: two from 390px if labels fit, three from 768px, four from 1200px. All grid/flex children use shrinkable tracks (`min-width: 0`); text wraps naturally.

## 6. Radii

`--ps-radius-sm` 8px, `md` 12px, `lg` 16px, `xl` 24px, `pill` 999px. Buttons/fields: 8px; cards: 12px; feature photography: 16–24px. Pills reserved for compact status/category chips. Certificates retain their original rectangular framing.

## 7. Shadows

`--ps-shadow-sm`: 0 2px 8px rgba(15,61,36,.04).
`--ps-shadow-md`: 0 8px 24px rgba(15,61,36,.07).
`--ps-shadow-lg`: 0 16px 40px rgba(15,61,36,.10).

Use a thin border plus the small shadow for cards; medium for hover and menus; large for modal surfaces only. No glows or heavy dark drop shadows.

## 8. Buttons

| Variant | Default | Hover / active |
| --- | --- | --- |
| Primary | Primary green, white text | Dark green / forest |
| Secondary | Transparent or white, green text and border | Soft green / decorative green inset |
| Tertiary | Underlined-on-hover text link and small arrow | Darker green; arrow moves at most 3px |
| Dark | Forest fill, white text on light surface | Primary-dark fill / forest inset |
| Inverse (dark-section companion) | Cream fill, forest text | White fill / soft-green fill |

Small: minimum 44px touch height, 16px horizontal padding. Medium: 48px / 20px. Large: 56px / 24px. Allow multi-line labels with vertical padding and no fixed height. Icons 16–20px with 8px gap. Keep visible wording specific to destination.

Focus: visible 3px outline with 3px offset; inverse ring on forest. Disabled native buttons use `disabled` and no hover; non-action links should not masquerade as disabled controls. Loading preserves width, prevents repeated submission, exposes `aria-busy`, and announces a text status; an icon alone is insufficient. Keep focus and labels when loading. Do not wire unimplemented actions.

## 9. Icons

Retain Font Awesome 6.5.2. Use one solid icon style for interface categories and brand icons only for social networks. Mappings: leaf/environment, droplet/blood donation, dove/bird conservation, people-group/community, check-to-slot/voter awareness, book-open/literature, masks-theater/culture, award/recognition, newspaper/media, calendar-days/events, location-dot/location, arrow-right/directional action. Icons generally 20–24px; category icons at most 28px. Decorative icons use `aria-hidden`; icon-only buttons need explicit accessible names.

## 10. Images

Use existing project photography before sourcing new assets. Preserve originals and CMS paths. Select images based on visible subject matter; a filename alone is not proof of a campaign or award. No generated documentary images or invented certificates.

| Context | Ratio / fitting |
| --- | --- |
| Hero | 16:9 landscape when documentary image supports crop |
| Portrait-led hero alternative | 4:5, focal point on face |
| Campaign feature | 3:2 or 4:3 |
| Campaign card | 4:3 |
| Article card | 16:10 |
| Certificate/media clipping | Natural ratio, contain, never crop text |
| Gallery | Natural mixed ratios; preserve source order |

Provide width/height or aspect-ratio to reserve space. Hero/LCP image loads eagerly; non-critical images lazy-load. Only emit `srcset` for derivatives that actually exist; suggested widths 480, 768, 1200, 1600px. AVIF/WebP may be additive derivatives with original fallback, never renamed CMS originals. `sizes` must match the actual column layout.

Future presentation resolver must distinguish absolute HTTP(S) URLs from relative project paths, because the current `base_url()` mishandles external image URLs. Keep this logic out of shared backend helpers unless separately approved. Missing imagery uses a neutral ratio-preserving panel with a readable “Image unavailable” label and optional title; do not substitute an unrelated photograph. Hide an unavailable certificate action; never generate fallback payment QR or bank details. Only one error fallback attempt, avoiding recursive load failures.

## 11. Header

Solid cream/light sticky header, approximately 80px desktop and 64px mobile, with height allowed to grow for text. Left: existing logo/Pradeep Sarang identity. Optional subtitle: existing verified role wording. Center/right: navigation, HI/EN, one volunteer CTA. A subtle separator/shadow appears on scroll; no initial transparency is required because contrast must work on every page.

Avoid ten simultaneous desktop links. Primary row: Home, About, Campaigns, Events, Explore, Contact. Explore is a keyboard-operable disclosure containing Gallery and Blog initially; additional items appear only when valid destinations exist. At less than 1200px, use a menu drawer to accommodate Hindi labels; this intentionally collapses earlier than the current `lg` header.

| Desired destination | Supported URL / activation rule |
| --- | --- |
| Home | `/` |
| About | `/about` |
| Campaigns | `/campaigns` |
| Events | `/events` |
| Gallery | `/portfolio`; accurately describe its portfolio source |
| Blog | `/blog` |
| Contact | `/contact` |
| Volunteer CTA | `/volunteer` |
| Donate, secondary navigation | `/donation` |
| Impact | Omit until an approved rendered section has a stable anchor |
| Media | Omit until newspaper section is rendered with a stable anchor |
| Awards | Omit until verified award/timeline section has a stable anchor |

Generate links through existing URL helpers; the local prefix must resolve to `/pradeep/`. Do not create `/impact`, `/gallery`, `/media`, `/awards`, legal routes, or links to absent fragment IDs. Detail routes should mark their parent menu active in presentation logic.

Mobile: identity, language control, menu button; drawer with labeled navigation, close button, Escape handling, focus containment while open, restored trigger focus, and scroll lock. Reuse Bootstrap's offcanvas behavior where suitable. Trigger exposes `aria-expanded` and `aria-controls`. Avoid hover-only submenus. Language links preserve the path and relevant existing query parameters, changing only `lang`; session language behavior stays unchanged.

## 12. Footer

Deep forest background with four desktop columns: identity/verified short mission; important navigation; campaigns/content; contact/social. Two columns on tablet, one on small phones. Source contact, social URLs, logo, and footer copy from existing settings. Campaign links appear only when records are supplied; otherwise use `/campaigns` and `/blog`.

Bottom row: dynamic copyright. Privacy/Terms appear only if working existing routes are verified; none were found in the audit. Admin access remains unchanged at its current endpoint and may remain a subdued utility link rather than a prominent action. Preserve the existing newsletter form and fields if its markup is migrated; do not promise durable subscription until its known session-only backend is addressed separately.

## 13. Hero and section headings

Hero: authentic service photograph plus a concise editorial statement, two actions, optional sourced quote. Desktop can use a 7/5 text/media split or landscape media with a solid text panel; do not obscure faces with text. Mobile stacks text then image and omits decorative statistics/badges. Avoid full-screen fixed heights and typewriter effects.

Draft eyebrow: “समाजसेवी • पर्यावरण प्रेमी • साहित्यकार”. Draft headline: “समाज, संस्कृति और प्रकृति के लिए समर्पित एक जीवन”. Supporting copy must derive from existing biography and fit approximately two or three sentences. Actions: “मेरी यात्रा जानें” → `/about`; “प्रमुख अभियान देखें” → `/campaigns`. English interface equivalents must be supplied before enabling English rendering of this component. No final hero content is implemented here.

Section heading contract: optional eyebrow, heading, short description, optional valid CTA. Default left-aligned, maximum 780px text; CTA aligns opposite on wide screens and below on phones. Center only short standalone quotes/CTA moments. Heading level is an explicit argument, preserving a single page H1.

## 14. Campaign components

Standard card: 4:3 image, title, excerpt, detail link; optional genuine funding progress. Featured campaign: large 3:2 image with category/year only when verified, title, short story, CTA. Editorial row: image/text split with alternate visual placement on desktop; keep consistent logical DOM order and image-before-text mobile flow. Hover adds subtle border/shadow, not a dramatic scale.

Existing input fields: title, slug, excerpt, content, image, goal_amount, raised_amount, status. `created_at` is a record timestamp, not proof of campaign founding year. Category/year are optional, not invented or schema additions. Detail URLs stay `/campaigns/{slug}`. Donation links do not imply campaign attribution, since the existing general donation route does not establish that workflow.

## 15. Green Gang / Green Morning feature

Signature forest section with one large environmental photograph, contrasting editorial title, concise sourced story, and four small non-interactive concepts: Green Morning, Green Afternoon, Green Evening, Green Night. Use the existing campaign content where verified; never select a record by a guessed slug. CTA links to the actual supplied campaign slug or the campaign listing. On mobile, story precedes image and concepts wrap into two columns. No floating leaves, parallax, or fabricated metrics. If no suitable record is available, retain the pattern in the library without rendering invented content.

## 16. Impact components

Impact stats: value, suffix, label, optional icon/supporting note and source. Support strings such as 35+, 500+, 10K+ without converting them into claims. Existing homepage hardcoded values are not automatically verified CMS metrics. Hide this section until approved evidence/data is supplied. Light and forest variants share layout; numerals remain visible if JavaScript is unavailable. Animate only trustworthy numeric values, once, and retain full accessible labels.

Impact areas: compact icon/label/one-sentence items covering environment, rural development, blood donation, voter awareness, bird conservation, youth, Awadhi, culture, literature, community welfare. Two to four columns where space allows, one at the narrowest width. Only link items with real destinations; others remain informative text.

Impact story: documentary image, category/location/date if supplied, title, and labeled Problem / Action / Impact sections. These structured fields have no dedicated local model. Render only from explicitly curated existing content; otherwise show an ordinary campaign/article excerpt without inventing outcomes. Optional CTA links to the corresponding existing campaign/article.

## 17. Timeline

Prefer editorial vertical timeline on desktop and single-column vertical on mobile for long Hindi text. Existing fields: year, title, description, sort_order. Optional category/image only if real data is supplied; do not add database columns.

Support groups 1987–1999, 2000–2009, 2010–2018, 2019–2022, 2023–Present when verified entries fit. Keep ambiguous textual years in an “Other milestones” group, retaining stored sort order; do not invent exact dates. First populated group expanded, others use native `details/summary`; all records remain in the DOM and keyboard accessible. Print expands all groups. No forced horizontal timeline scroll. A group without records is omitted.

## 18. Awards

Featured award: natural-ratio certificate/photo beside title, year, awarding body, description. Standard award: compact editorial card with the same optional metadata. Existing timeline entries can populate title/year/description only where they actually describe recognition. There is no dedicated awards table or verified certificate relationship; do not treat every milestone as an award or attach arbitrary gallery images.

Certificate opens an accessible lightbox using contain sizing and a full-size image link. Missing certificate means no lightbox button. No fake awarding-body logos or empty metadata labels.

## 19. Media coverage

Editorial clipping card: natural image, headline/title, optional publication/date/type. The current `newspaper_cuttings` model supports title, image, created_at only. Do not label upload time as publication date. Print/Digital/TV/Interview variants are supported design states, not asserted metadata. With current records, render clipping plus known title and hide unsupported fields.

Use source-order-preserving grid with natural-height images; an enhanced masonry layout must preserve meaningful keyboard/reading order. Click opens a readable full-size clipping with caption. Local homepage currently fetches these records but does not render them; integration belongs to an approved later phase.

## 20. Events

Card: date badge, optional image, title, location, excerpt, status, detail CTA. Existing fields map directly except category and end date, which are absent and must be hidden. CTA remains `/events/{slug}`; participation uses existing `/volunteer` or `/contact` without claiming an event booking.

Design variants: Upcoming, Ongoing, Completed. Current storage has upcoming/past and a single event date. Preserve current stored status until display rules are approved. A future date-aware presentation may show Upcoming for a future day, Today for the event day, and Completed for an elapsed day, using Asia/Kolkata. “Ongoing” requires credible start/end times or an explicit approved status; do not infer it from a date-only record. Do not change enum values or write computed status to the database.

## 21. Gallery

Photo-story collection with image, optional title/category/location/date and non-obstructive hover/focus caption. `gallery` supplies image/title/created_at; `portfolio` additionally supplies category/description. Keep those sources distinct. An upload timestamp is not a documented event date. Build filter choices from actual available categories rather than the current hardcoded incompatible category list.

One column at 360px, two at 390px+ for suitable images, three on tablet, four on wide screens. Keep text-heavy images full width when needed. Lightbox supports close/Escape, focus return, descriptive caption, next/previous when a real collection exists, and a visible original-image link. Core image links work without JavaScript. Do not depend on experimental CSS masonry; use an ordered grid fallback.

## 22. Articles

Featured article: large title/excerpt and optional 16:10 image. Standard card: category, title, short excerpt, actual publication date/author, optional image and reading time. Missing images use a deliberate text-led layout. Keep URLs `/blog/{slug}` and existing published-content rules.

List-page hardcoded “3–5 minutes” is not accepted as data. Hide reading time unless explicitly supplied or computed consistently from content with a documented Hindi-aware approximation. Preserve full rich-text content, author attribution, reader themes/font controls, sharing, and print behavior when that page is migrated. Search/category/pagination fixes are separate functional work; do not introduce nonfunctional controls in the design system.

## 23. Quotes, CTA, and forms

Quote: semantic blockquote/cite, sourced quote, author, optional genuine signature. Cream editorial block is default; photograph variant requires a tested overlay. Hindi quote line-height 1.8, max-width 780px. Omit fabricated quotations or attribution.

CTA: draft title “बदलाव का हिस्सा बनें”. Default primary Volunteer → `/volunteer`; secondary Contact → `/contact`. Collaborate/Invite may link to Contact with accurate wording but no invented form prefill or event workflow. Explore campaign → existing campaign detail/list, not a fake join action. Donation → `/donation` remains a secondary supported action. Use at most two dominant actions per section.

Fields: text, email, telephone, textarea, select, checkbox, radio, submit. All have visible associated labels, optional helper text, and consistent spacing. Text controls have at least 48px height; multiline controls grow naturally; checkbox/radio labels provide 44px touch areas. Use suitable autocomplete/inputmode without changing server field names.

States: default identifiable boundary; focus ring; filled value without label movement; error border/icon/text with `aria-invalid` and `aria-describedby`; success text only after actual server confirmation; disabled native state. Errors must not rely on color. Fieldsets/legends group radios. Submission summary receives focus after validation failure where supported; retain entered values. Use polite live regions for submission status.

Preserve `_csrf`, `form_type`, names, multipart encoding, methods/actions, response fields, receipt IDs, and volunteer state/city IDs. Do not simulate success, change backend validation, or submit forms during Phase 2 verification. Donation parse-success bug and session-only contact/newsletter persistence remain separate known issues.

## 24. Responsive and bilingual rules

| Test width | Layout targets |
| --- | --- |
| 1440+ | 1280px content cap, 96px sections, three cards/four compact areas, split hero |
| 1280 | 32px gutters, full header if both languages fit, same grids |
| 1024 | 24px gutters, drawer navigation, two cards, split hero only if copy fits |
| 768 | 24px gutters, 64px sections, stacked hero, two cards, vertical timeline |
| 430 | 16px gutters, 48px sections, one main card, two compact/gallery columns if readable |
| 390 | Same; wrap CTAs and labels; avoid truncated Hindi captions |
| 360 | One compact/gallery column as needed; full-width stacked primary actions |

These are test targets; implementation uses Bootstrap breakpoints plus minimal component-specific adjustments. Typography is fluid, not seven independent size overrides. No fixed text widths/heights; `overflow-wrap` handles long URLs, without splitting normal Hindi words unnecessarily. Preserve logical DOM order when alternating editorial rows. Do not use `overflow-x:hidden` as an overflow fix. Rich tables get labeled local scrolling rather than overflowing the viewport.

Every component supports Hindi/English label arrays and unknown text lengths. Future dictionary additions are additive and retain current keys/session selection. Provide correct `lang` on untranslated Hindi content; use logical padding/margin properties. Test long campaign names, menu labels, multi-line buttons, empty data, and 200% text zoom. Also verify reflow at 320 CSS px for accessibility even though the requested device matrix starts at 360px.

## 25. Motion

Tokens: fast 150ms, base 220ms, reveal 360ms; easing cubic-bezier(.2,.7,.2,1); stagger 40ms capped at 160ms total. Fade-up at most 8px, image reveal without obscuring initial content, hover lift at most 2px, arrow movement at most 3px. Counters optional and once-only; timeline relies on user disclosure rather than auto-scrolling.

Respect `prefers-reduced-motion`: no reveal movement, count animation, smooth-scroll, scale, or arrow translation; immediate state change remains. Visible content is the default before JS enhancement. Avoid parallax, continuous typing, floating objects, tilt, and scroll listeners doing layout work every frame.

## 26. Accessibility acceptance

Target WCAG AA; this specification is not a conformance certification. Require semantic header/nav/main/footer, skip link, single page H1, logical heading levels, visible keyboard focus, keyboard-operable drawer/disclosures/lightbox, Escape and focus restoration, meaningful alt text, associated form labels, correctly announced errors, 44px touch targets, 4.5:1 normal text, and 3:1 essential UI contrast. Check zoom, reduced motion, keyboard-only interaction, and screen-reader names on actual rendered components. Hover must never be the only way to discover an action. Decorative images have empty alt; clipped documents have meaningful labels and readable originals.

## 27. Reusable PHP component architecture

Proposed future structure only; none of these runtime files are created in Phase 2:

```text
views/layouts/main.php                 existing shell, retained
views/partials/site/{head,header,navigation,footer,flash}.php
views/components/{hero,section-header,impact-stats,impact-area}.php
views/components/{campaign-card,campaign-feature,campaign-row,green-gang}.php
views/components/{impact-story,timeline,timeline-item,award-card,media-card}.php
views/components/{event-card,gallery,gallery-item,article-card,quote,cta}.php
views/components/{form-field,empty-state,lightbox}.php
views/pages/*                         existing names retained
assets/css/site/{tokens,base,layout,components}.css
assets/css/site/pages/*               only as pages are approved
assets/js/site/{navigation,lightbox,timeline}.js
lang/{en,hi}.php                       additive UI keys in a later phase
```

Plain PHP partials accept an explicit component data array; they do not query the database, alter sessions, or mutate model records. Common contract: variant, heading level, language, class hooks, required content, optional metadata, valid destination. Use fixed trusted include paths, escaped plain text, existing trusted rich-text boundaries, and unique IDs for repeated components. No new framework, dynamic user-controlled include paths, or anonymous global variable conventions.

Keep optional fields absent rather than rendering empty labels. An existing record is not extended merely because a design component supports a field. Core components are renderable without JavaScript; interactions progressively enhance real links and controls. Bootstrap modal/offcanvas machinery can remain; no additional icon/carousel/masonry package is needed.

## 28. CSS migration plan

1. Preserve current public/admin styles. Add future `--ps-*` tokens and `ps-*` component classes in isolated files; do not load them yet.
2. Reuse Bootstrap grid, collapse/offcanvas/modal behavior, semantic helper functions, and existing Font Awesome delivery. Scope new public base rules under `.ps-site`; never globally override `.btn`, `.card`, `.container`, `body`, or headings during partial migration.
3. Audit inheritance before opting a page into the new shell. A prefix alone does not prevent legacy `p`, heading, link, `.form-control`, or `!important` rules from affecting new markup; explicitly resolve those conflicts within the scope.
4. Migrate shared shell and approved page components one at a time, preserving JS hooks or updating markup/handlers atomically. Keep admin CSS and volunteer admin JS untouched.
5. Move the 37 public inline style attributes into scoped component rules when those pages are approved; preserve data-dependent widths via validated component variables. Extract article-reader embedded CSS/JS only with its own regression pass.
6. Deprecation candidates: gradient/glow buttons, 3D tilt, typing cursor, floating glass badges, ornate generic typography, duplicate campaign cards and filter scripts. Unreferenced candidates include `.hero-slide`, `.hero-content`, `.stat-box`, `.stat-label`, `.section-gradient`, and gradient-text utilities. Check CMS HTML and actual rendered usage before deletion.
7. Current public stylesheet contains no media queries; there is no duplicate public breakpoint set to remove. Reader mobile/print and admin breakpoints serve separate scopes and must be preserved until reviewed.
8. Remove legacy selectors only after every consuming public page is migrated and verified. Never delete uploads or duplicate-looking images merely because byte hashes match: database references may differ.
9. Maintain a file-level rollback boundary per approved page; do not combine backend corrections or schema changes with visual migration.

## 29. Files and verification

Created: `docs/phase-2-design-system.md` (this document).
Modified runtime files: none. No theme files, components, font requests, packages, or page redesigns activated.

Local homepage returned HTTP 200 during preparation. Browser discovery returned no available browser, so visual checks at the requested widths have not been performed. Runtime preservation is established by the documentation-only diff, not by claiming an authenticated admin or form end-to-end test. No forms were submitted, database schema commands run, admin data changed, routes altered, language dictionaries changed, or existing content removed.

Read-only local checks: homepage, `?lang=hi`, `?lang=en`, and `/admin/` each returned HTTP 200. Hindi/English document language attributes were checked; the admin entry exposed its login form, not an authenticated dashboard. No fatal/parse-error markers appeared in the inspected responses. Source-control diff confirms only this new document. All 30 specification sections are present.

Calculated opaque-color contrast: white/primary green 5.02:1; secondary text/cream 5.09:1; dark text/saffron 7.63:1; white/forest 12.26:1; error red/white 4.83:1. These checks validate the named pairs only, not complete components or photography overlays.

## 30. Risks and Phase 3 gate

- Local/production drift remains known, but localhost is now the explicit implementation target. Do not overwrite local assumptions with live-site output.
- Gallery/portfolio separation, absent awards model, and minimal clipping metadata restrict what components can truthfully display.
- No event end date supports a reliable Ongoing state; no dedicated impact data supports new counters or case-study outcomes.
- Existing database fallbacks, schema drift, absolute-image URL bug, missing QR asset, soft 404s, and incomplete contact/newsletter/comment/search workflows are not fixed here.
- Long Hindi labels can overflow the current desktop navigation; collapse earlier and validate real content.
- Font loading and large originals affect layout/performance; derivative images and font delivery need later measured verification.
- Shared/global Bootstrap overrides can leak into new components; opt-in scopes and page-by-page verification are required.
- Existing admin/shared model dependencies remain protected. Do not access authenticated actions or run migrations to make a design preview work.

Phase 2 stops at this specification. Approval is required before Phase 3 homepage implementation. First Phase 3 deliverable should be a local homepage using approved components and existing content contracts, with other inner pages and backend functionality preserved.
