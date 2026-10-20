// One-off migration: exports all WordPress posts to src/content/blog/*.md
// and downloads referenced media into public/ at the same /wp-content/uploads paths,
// so image URLs stay identical to the legacy site.
//   node scripts/export-wp.mjs
import { mkdir, writeFile, access } from 'node:fs/promises';
import { dirname, join } from 'node:path';
import TurndownService from 'turndown';
import { gfm } from 'turndown-plugin-gfm';

const ORIGIN = 'https://www.cloudtoggle.com';
const API = `${ORIGIN}/wp-json/wp/v2`;
const OUT_DIR = 'src/content/blog';
const PUBLIC_DIR = 'public';

const td = new TurndownService({ headingStyle: 'atx', codeBlockStyle: 'fenced', bulletListMarker: '-' });
td.use(gfm);
td.addRule('figure', {
	filter: 'figure',
	replacement: (_c, node) => {
		const img = node.querySelector('img');
		const cap = node.querySelector('figcaption')?.textContent?.trim();
		if (!img) return '\n\n' + node.textContent + '\n\n';
		const alt = (img.getAttribute('alt') ?? '').replace(/\n/g, ' ');
		return `\n\n![${alt}](${img.getAttribute('src')})${cap ? `\n\n*${cap}*` : ''}\n\n`;
	},
});

const decode = (s = '') =>
	s.replace(/&#8211;/g, '–').replace(/&#8212;/g, '—').replace(/&#8217;/g, '’').replace(/&#8216;/g, '‘')
		.replace(/&#8220;/g, '“').replace(/&#8221;/g, '”').replace(/&amp;/g, '&').replace(/&#038;/g, '&')
		.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&nbsp;/g, ' ').replace(/&hellip;/g, '…')
		.replace(/&#(\d+);/g, (_, n) => String.fromCharCode(+n));
const strip = (h = '') => decode(h.replace(/<[^>]+>/g, '')).replace(/\s+/g, ' ').trim();

async function getJson(url) {
	for (let i = 0; i < 4; i++) {
		const r = await fetch(url);
		if (r.ok) return { json: await r.json(), total: +r.headers.get('x-wp-totalpages') };
		await new Promise((r) => setTimeout(r, 1000 * (i + 1)));
	}
	throw new Error('Failed ' + url);
}

const exists = (p) => access(p).then(() => true, () => false);
const media = new Set();
const toLocal = (url) => {
	if (!url) return url;
	try {
		const u = new URL(url, ORIGIN);
		if (u.hostname.endsWith('cloudtoggle.com') && u.pathname.startsWith('/wp-content/uploads/')) {
			media.add(u.pathname);
			return u.pathname;
		}
	} catch {}
	return url;
};

const posts = [];
for (let page = 1, pages = 1; page <= pages; page++) {
	const { json, total } = await getJson(`${API}/posts?per_page=50&page=${page}&_embed=wp:featuredmedia,wp:term`);
	pages = total;
	posts.push(...json);
	console.log(`page ${page}/${pages}: ${posts.length} posts`);
}

await mkdir(OUT_DIR, { recursive: true });
const q = (s) => JSON.stringify(s ?? '');
for (const p of posts) {
	let html = p.content.rendered;
	// absolute internal links -> relative, media -> local paths
	html = html.replace(/(src|href)="(https?:\/\/(?:www\.)?cloudtoggle\.com)(\/[^"]*)"/g, (_m, attr, _o, path) => {
		if (path.startsWith('/wp-content/uploads/')) media.add(path.split('?')[0]);
		return `${attr}="${path}"`;
	});
	html = html.replace(/ srcset="[^"]*"/g, '').replace(/ sizes="[^"]*"/g, '');
	let md = td.turndown(html).replace(/\n{3,}/g, '\n\n').trim();

	const y = p.yoast_head_json ?? {};
	const fm = p._embedded?.['wp:featuredmedia']?.[0];
	const image = toLocal(fm?.source_url ?? y.og_image?.[0]?.url);
	const terms = (p._embedded?.['wp:term'] ?? []).flat();
	const tags = terms.filter((t) => t.taxonomy === 'post_tag').map((t) => decode(t.name));
	const title = strip(p.title.rendered);
	const description = y.description ? decode(y.description) : strip(p.excerpt.rendered).slice(0, 160);
	const reading = y.twitter_misc?.['Estimated reading time'] ?? '';

	const front = [
		'---',
		`title: ${q(title)}`,
		`seoTitle: ${q(decode(y.title ?? title))}`,
		`description: ${q(description)}`,
		`pubDate: ${p.date_gmt}Z`,
		`updatedDate: ${p.modified_gmt}Z`,
		image ? `image: ${q(image)}` : null,
		fm?.alt_text ? `imageAlt: ${q(fm.alt_text)}` : null,
		`tags: ${JSON.stringify(tags)}`,
		reading ? `readingTime: ${q(reading)}` : null,
		`wpId: ${p.id}`,
		'---',
		'',
	].filter((l) => l !== null).join('\n');
	await writeFile(join(OUT_DIR, `${p.slug}.md`), front + md + '\n');
}
console.log(`wrote ${posts.length} posts; downloading ${media.size} media files`);

let done = 0, failed = [];
const queue = [...media];
async function worker() {
	while (queue.length) {
		const path = queue.pop();
		const dest = join(PUBLIC_DIR, decodeURIComponent(path));
		if (await exists(dest)) { done++; continue; }
		try {
			const r = await fetch(ORIGIN + path);
			if (!r.ok) throw new Error(r.status);
			await mkdir(dirname(dest), { recursive: true });
			await writeFile(dest, Buffer.from(await r.arrayBuffer()));
			done++;
		} catch (e) { failed.push(path + ' ' + e.message); }
	}
}
await Promise.all(Array.from({ length: 8 }, worker));
console.log(`media ok: ${done}, failed: ${failed.length}`);
if (failed.length) await writeFile('scripts/media-failed.txt', failed.join('\n'));
