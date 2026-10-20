# cloudtoggle.com

Static marketing site and blog for CLOUD TOGGLE, built with [Astro](https://astro.build) and Tailwind CSS v4.

```bash
npm install
npm run dev      # http://localhost:4321
npm run build    # static output in dist/
```

## Structure

| Path | Purpose |
| --- | --- |
| `src/data/site.ts` | Plans, prices, FAQ and conversion links. Edit here to keep copy and links in sync. |
| `src/components/` | Homepage sections (`Hero`, `Calculator`, `Steps`, `Features`, `Pricing`, `Security`, `Faq`, `FinalCta`) and shared UI. |
| `src/content/blog/` | 228 posts migrated from WordPress, served at the same `/blog-en/<slug>/` URLs. |
| `src/content/pages/` | Legal pages and the ParkMyCloud alternative page, at their original URLs. |
| `public/wp-content/uploads/` | Blog images, kept at their original paths. |
| `scripts/` | One-off WordPress migration scripts (`export-wp`, `export-pages`, `fix-links`) and the OG image generator. |

## URL parity with the legacy WordPress site

- Blog posts: `/blog-en/<slug>/`. Blog index: `/category/blog-en/` and `/category/blog-en/page/N/`.
- Trailing slashes are kept (`trailingSlash: 'always'`).
- The product app (`/app/*`), accounts (`/my-account/`), checkout and `?add-to-cart=` links are still served by WordPress. They are linked to absolutely and are **not** part of this site.
- Not rebuilt: tag archives (`/tag/*`), `/features/`, `/faq/`, `/pricing-details/` (placeholders on the old site), `/fr/`. Redirect these when cutting over.
