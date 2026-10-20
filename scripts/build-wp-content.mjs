// Builds the importable WordPress page content from the Astro build output.
//   npm run build && node scripts/build-wp-content.mjs
// Reads dist/index.html + dist/contact/index.html, splits <main> into sections, rewrites asset URLs to the
// theme's assets folder and writes wordpress/page-content/*.html. Keeps the WordPress version
// pixel-identical to the Astro site because it reuses the exact same markup and Tailwind classes.
import { readFile, writeFile, mkdir, copyFile, rm } from 'node:fs/promises';
import { basename } from 'node:path';

const THEME_IMG = '/wp-content/themes/cloudtoggle/assets/img';
const OUT = 'wordpress/page-content';
const IMG_OUT = 'wordpress/cloudtoggle/assets/img';

const main = (html) => html.match(/<main id="main">([\s\S]*)<\/main>/)[1];
const assets = new Set();

function clean(html) {
	return html
		.replace(/<script\b[\s\S]*?<\/script>/g, '')
		.replace(/<style\b[\s\S]*?<\/style>/g, '')
		.replace(/ data-astro-cid-[a-z0-9]+(="[^"]*")?/g, '')
		.replace(/\/_astro\/([^"\s,)]+)/g, (_m, f) => { assets.add(f); return `${THEME_IMG}/${f}`; })
		.replace(/href="https:\/\/www\.cloudtoggle\.com(\/[^"]*)"/g, 'href="$1"')
		.replace(/<!--[\s\S]*?-->/g, '')
		.replace(/\n\s*\n+/g, '\n')
		.trim();
}

function sections(body) {
	const out = [];
	let i = 0;
	while ((i = body.indexOf('<section', i)) !== -1) {
		const end = body.indexOf('</section>', i) + '</section>'.length;
		out.push(body.slice(i, end));
		i = end;
	}
	return out;
}

const home = await readFile('dist/index.html', 'utf8');
const names = ['hero', 'providers', 'video', 'calculator', 'steps', 'features', 'pricing', 'security', 'faq', 'final-cta'];
const parts = sections(main(home));
if (parts.length !== names.length) throw new Error(`Expected ${names.length} sections, got ${parts.length}`);

// Calculator reads plan data from the form so the section is self-contained when pasted into a page.
const plans = JSON.parse(
	(await readFile('src/data/site.ts', 'utf8')).match(/PLANS: Plan\[\] = (\[[\s\S]*?\n\]);/)?.[1]
		?.replace(/href: `[^`]*`,/g, '').replace(/(\w+):/g, '"$1":').replace(/'/g, '"').replace(/,(\s*[}\]])/g, '$1') ?? '[]',
).map((p) => ({ name: p.name, price: p.price, servers: p.servers }));

// FAQPage JSON-LD (the SEO plugin already outputs Organization/WebSite for the site)
const faqLd = [...home.matchAll(/<script type="application\/ld\+json">([\s\S]*?)<\/script>/g)]
	.map((m) => m[1]).find((j) => j.includes('"FAQPage"'));

await mkdir(OUT, { recursive: true });
await mkdir(IMG_OUT, { recursive: true });
const written = [];
for (const [i, name] of names.entries()) {
	let html = clean(parts[i]);
	if (name === 'calculator') html = html.replace('<form id="calc"', `<form id="calc" data-plans='${JSON.stringify(plans)}'`);
	if (name === 'faq' && faqLd) html += `\n<script type="application/ld+json">${faqLd}</script>`;
	const file = `${String(i + 1).padStart(2, '0')}-${name}.html`;
	await writeFile(`${OUT}/${file}`, html + '\n');
	written.push(html);
}
await writeFile(`${OUT}/homepage-all-sections.html`, written.join('\n\n') + '\n');

// Contact page
const contact = await readFile('dist/contact/index.html', 'utf8');
await writeFile(`${OUT}/contact.html`, clean(main(contact)) + '\n');

for (const f of assets) await copyFile(`dist/_astro/${f}`, `${IMG_OUT}/${basename(f)}`);
console.log(`sections: ${names.length}, images copied: ${assets.size}`);
