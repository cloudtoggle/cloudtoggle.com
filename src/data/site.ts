// Single source of truth for links, plans and copy that must stay factually in sync
// with the live Cloud Toggle product. Source: cloudtoggle.com (checked 2026-10-19).

export const SITE = {
	name: 'CLOUD TOGGLE',
	url: 'https://www.cloudtoggle.com',
	tagline: 'Power off idle AWS and Azure servers on a schedule and stop paying for them.',
	twitter: '@cloudtoggle',
};

export const LINKS = {
	// Existing, working conversion links (WooCommerce / Calendly) preserved as-is.
	demo: 'https://calendly.com/cloudtoggle/30min',
	trial: `${SITE.url}/?add-to-cart=285`,
	login: `${SITE.url}/app/`,
	contact: `${SITE.url}/contact/`,
	help: 'https://cloudtoggle.featurebase.app/help',
	helpAws: 'https://cloudtoggle.featurebase.app/help/articles/13695884123036-creating-a-new-aws-cloud-connection',
	helpAzure: 'https://cloudtoggle.featurebase.app/help/articles/13673200443932-creating-a-new-azure-cloud-connection',
	x: 'https://x.com/cloudtoggle',
	youtube: 'https://www.youtube.com/@cloudtoggle',
	terms: `${SITE.url}/terms-and-conditions/`,
	privacy: `${SITE.url}/privacy-policy/`,
};

export interface Plan {
	id: string;
	name: string;
	price: number;
	blurb: string;
	servers: number;
	teams: number;
	users: number;
	connections: number;
	href: string;
	trial?: boolean;
	featured?: boolean;
}

export const PLANS: Plan[] = [
	{
		id: 'basic',
		name: 'Basic',
		price: 49,
		blurb: 'A basic service so you can trial CLOUD TOGGLE.',
		servers: 15,
		teams: 1,
		users: 5,
		connections: 1,
		href: `${SITE.url}/?add-to-cart=285`,
		trial: true,
	},
	{
		id: 'plus',
		name: 'Plus',
		price: 99,
		blurb: 'For companies with a small number of servers and users.',
		servers: 50,
		teams: 5,
		users: 25,
		connections: 2,
		href: `${SITE.url}/?add-to-cart=286`,
		featured: true,
	},
	{
		id: 'pro',
		name: 'Pro',
		price: 249,
		blurb: 'For businesses with a significant number of servers.',
		servers: 200,
		teams: 10,
		users: 100,
		connections: 5,
		href: `${SITE.url}/?add-to-cart=287`,
	},
];

export const FAQS = [
	{
		q: 'Which cloud platforms does Cloud Toggle support?',
		a: 'Amazon Web Services (AWS) and Microsoft Azure. Each plan includes a set number of cloud connections, so you can connect more than one account or subscription on Plus and Pro.',
	},
	{
		q: 'How long does setup take?',
		a: 'Most teams are up and running in minutes. You add a cloud connection, your servers are imported automatically, and you assign them a schedule. Step-by-step guides for AWS and Azure are in the help centre.',
	},
	{
		q: 'What permissions does Cloud Toggle need in my cloud account?',
		a: 'On AWS you create an IAM policy from the JSON shown in the setup wizard, then connect with an IAM role (recommended, with an external ID) or with account keys. On Azure you register an app and assign it the Virtual Machine Contributor and Monitoring Contributor roles on the subscription you want to manage. You can review exactly what is requested before you grant it.',
	},
	{
		q: 'Is it safe to switch servers off automatically?',
		a: 'Schedules only apply to the servers you choose to add to them, and any schedule can be overridden in seconds, so someone who needs a server out of hours can turn it on without waiting. Start with a development or test environment and widen from there.',
	},
	{
		q: 'Do my team members need access to our AWS or Azure account?',
		a: 'No. Cloud Toggle lets you share access to specific features, such as turning a server on or off, without giving people access to the entire cloud account. Admins create individual users and role-based teams.',
	},
	{
		q: 'How does the free trial work?',
		a: 'The Basic plan ($49/month) includes a 30-day free trial, with up to 15 servers, 1 team, 5 users and 1 cloud connection, so you can try Cloud Toggle on real infrastructure before you pay.',
	},
	{
		q: 'What if I need more than 200 servers or something custom?',
		a: 'Get in touch and we will put a custom plan together. You can also book a demo and walk through your setup with us first.',
	},
];
