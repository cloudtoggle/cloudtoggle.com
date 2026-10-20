import type { APIRoute } from 'astro';
import { getCollection } from 'astro:content';
import { LINKS, PLANS, SITE } from '../data/site';

// Served at /llms.txt (https://llmstxt.org). Built from site data and the blog collection,
// so it never drifts from the pages it describes.
export const GET: APIRoute = async () => {
	const posts = (await getCollection('blog')).sort((a, b) => b.data.pubDate.getTime() - a.data.pubDate.getTime());
	const clean = (s: string) => s.replace(/\s+/g, ' ').trim();

	const lines = [
		`# ${SITE.name}`,
		'',
		'> CLOUD TOGGLE is a cloud cost optimisation SaaS product that helps businesses reduce AWS and Azure infrastructure costs by automatically scheduling servers to switch off when they are not needed and back on when they are.',
		'',
		'Key facts:',
		'- Supports Amazon Web Services (AWS) and Microsoft Azure.',
		'- Daily and weekly schedules, manual overrides, role-based access control, and user and team management.',
		'- Lets people turn servers on and off without access to the whole cloud account.',
		`- Plans: ${PLANS.map((p) => `${p.name} $${p.price}/month (up to ${p.servers} servers)`).join('; ')}. Basic includes a 30-day free trial. Custom plans on request.`,
		'',
		'## Product',
		'',
		`- [Home](${SITE.url}/): Overview, savings calculator, how it works, features, pricing, security and FAQ`,
		`- [Pricing](${SITE.url}/#pricing): Basic, Plus and Pro plan limits and prices`,
		`- [Features](${SITE.url}/#features): Scheduling, manual overrides, access control and team management`,
		`- [Start a free trial](${LINKS.trial}): 30-day free trial on the Basic plan`,
		`- [Book a demo](${LINKS.demo}): 30-minute demo call`,
		`- [Contact](${SITE.url}/contact/): Talk to the team`,
		'',
		'## Documentation',
		'',
		`- [Help centre](${LINKS.help}): Setup and technical guides`,
		`- [Creating an AWS cloud connection](${LINKS.helpAws}): IAM role or account keys setup`,
		`- [Creating an Azure cloud connection](${LINKS.helpAzure}): App registration and role assignments`,
		'',
		'## Blog',
		'',
		...posts.map((p) => `- [${clean(p.data.title)}](${SITE.url}/blog-en/${p.id}/): ${clean(p.data.description)}`),
		'',
		'## Optional',
		'',
		`- [Blog index](${SITE.url}/category/blog-en/)`,
		`- [Terms and Conditions](${SITE.url}/terms-and-conditions/)`,
		`- [Privacy Policy](${SITE.url}/privacy-policy/)`,
		`- [X (Twitter)](${LINKS.x})`,
		`- [YouTube](${LINKS.youtube})`,
		'',
	];

	return new Response(lines.join('\n'), { headers: { 'Content-Type': 'text/plain; charset=utf-8' } });
};
