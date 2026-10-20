// Rewrites internal links in migrated content so none 404 on the new site.
//  - product/app/account URLs stay on the live WordPress host (absolute)
//  - placeholder/legacy marketing pages map to homepage sections
//  - tag archives (not rebuilt) map to the blog index
import { readdir, readFile, writeFile } from 'node:fs/promises';

const ORIGIN = 'https://www.cloudtoggle.com';
const rules = [
	[/^\/app(\/.*)?$/, (p) => ORIGIN + p],
	[/^\/(my-account|checkout|basket|subscribe)(\/.*)?$/, (p) => ORIGIN + p],
	[/^\/features\/?$/, () => '/#features'],
	[/^\/faq\/?$/, () => '/#faq'],
	[/^\/pricing-details\/?$/, () => '/#pricing'],
	[/^\/support\/?$/, () => '/contact/'],
	[/^\/tag\/.*$/, () => '/category/blog-en/'],
	[/^\/blog-en\/?$/, () => '/category/blog-en/'],
	[/^(\/blog-en\/[^/]+)$/, (p) => p + '/'],
];
let changed = 0;
for (const dir of ['src/content/blog', 'src/content/pages']) {
	for (const f of await readdir(dir)) {
		const path = `${dir}/${f}`;
		const src = await readFile(path, 'utf8');
		const out = src.replace(/\]\((\/[^)\s#]*)(#[^)\s]*)?\)/g, (m, p, hash = '') => {
			for (const [re, fn] of rules) if (re.test(p)) { changed++; return `](${fn(p)}${hash})`; }
			return m;
		});
		if (out !== src) await writeFile(path, out);
	}
}
console.log('links rewritten:', changed);
