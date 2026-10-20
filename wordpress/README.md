# CLOUD TOGGLE WordPress theme

A classic PHP theme plus importable page content that reproduce the Astro site's look in WordPress.

```
wordpress/
  cloudtoggle/        The theme (zip this folder, or use wordpress/dist/cloudtoggle-theme.zip)
  page-content/       Importable HTML: one file per homepage section, the whole homepage, and Contact
  src/theme.css       Tailwind source for the theme's stylesheet
  dev/blueprint.json  Throwaway test site (WordPress Playground) with the theme and sample content
```

## Install

1. **Appearance → Themes → Add New → Upload Theme**, upload `wordpress/dist/cloudtoggle-theme.zip`, then **Activate**.
   Keep the folder name `cloudtoggle`: the page content references images at `/wp-content/themes/cloudtoggle/assets/img/`.
2. Set your logo (optional) in **Appearance → Customize → Site Identity**. The bundled logo is used otherwise.
3. Set the header menu in **Appearance → Menus → Primary navigation** (optional; sensible marketing links are used if none is assigned).
4. Check the conversion links in **Appearance → Customize → Conversion links** (Start Free Trial, Book a Demo, Log in).
   Defaults are `/?add-to-cart=285`, the Calendly link and `/app/`, the same links the current site uses.

## Build the homepage

1. **Pages → Add New**, title it "Home".
2. In **Page attributes → Template** choose **Landing page (full width, no title)**.
3. Add a **Custom HTML** block and paste the contents of `page-content/homepage-all-sections.html`. Publish.
4. **Settings → Reading → Your homepage displays → A static page → Home**.

Prefer to assemble it yourself? Paste the numbered files in `page-content/` one at a time
(`01-hero` … `10-final-cta`), each into its own Custom HTML block, or into an HTML widget in a page builder
such as Elementor. Reorder, remove or edit sections freely: copy, prices and links are plain HTML.
Do the same with `contact.html` for a Contact page.

> The calculator, video and FAQ markup contains `<form>`, `<input>` and `<script>` tags. WordPress strips these for users
> without the `unfiltered_html` capability (Administrators have it on a normal single site; on multisite only Super Admins do).
> Paste as an Administrator.

## What the theme provides

- Header and footer in the indigo `#3850A4` from the original site, with the mobile menu.
- Blog index and category archives (the `blog-en` category URL is used for "Blog" links when it exists), single posts with
  reading time, related posts and a call to action, standard pages, search and 404.
- A readable `.prose-ct` style for post and page content (headings, tables, code, images, captions, embeds).
- `Landing page` template for edge-to-edge sections.
- Behaviour in one small `assets/js/theme.js`: mobile menu, scroll reveal, click-to-play video and the savings calculator.
- Basic description and Open Graph tags **only when no SEO plugin is active**. Yoast, Rank Math, AIOSEO and SEOPress are detected, so nothing is duplicated.
- Declares WooCommerce support. Cart, checkout and account pages get a wider, plain container.

## Before switching the live site

- **Test on a staging copy first.** The existing site's product pages (`/app/...`) and login popup come from the current theme
  and its add-on plugin. Check `/app/`, `/my-account/`, `/checkout/` and the login popup after activating this theme.
- Keep your existing permalinks. Posts at `/blog-en/<slug>/` and `/category/blog-en/` are untouched by this theme.

## Rebuilding after design changes

Edit the Astro site, then:

```bash
npm run wp:build   # astro build -> regenerates page-content/, theme CSS and wordpress/dist/cloudtoggle-theme.zip
npm run wp:test    # throwaway WordPress at http://127.0.0.1:9400 with the theme and sample content (admin / password)
```

`wp:build` reuses the Astro markup and Tailwind classes, so the two sites stay visually identical.
