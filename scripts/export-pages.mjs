// One-off: export legal pages from WordPress to src/content/pages/*.md
import { writeFile, mkdir } from 'node:fs/promises';
import TurndownService from 'turndown';
import { gfm } from 'turndown-plugin-gfm';

const td = new TurndownService({ headingStyle: 'atx', bulletListMarker: '-' });
td.use(gfm);
await mkdir('src/content/pages', { recursive: true });
for (const slug of ['terms-and-conditions', 'privacy-policy', 'the-best-affordable-parkmycloud-alternative-for-agile-teams']) {
	const [p] = await (await fetch(`https://www.cloudtoggle.com/wp-json/wp/v2/pages?slug=${slug}`)).json();
	const html = p.content.rendered.replace(/https?:\/\/(www\.)?cloudtoggle\.com\//g, '/');
	const title = p.title.rendered.replace(/&amp;/g, '&');
	const md = td.turndown(html).replace(/\n{3,}/g, '\n\n').trim();
	await writeFile(`src/content/pages/${slug}.md`, `---\ntitle: ${JSON.stringify(title)}\nupdatedDate: ${p.modified_gmt}Z\n---\n${md}\n`);
	console.log(slug, md.length);
}
