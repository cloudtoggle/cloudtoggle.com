import { defineCollection, z } from 'astro:content';
import { glob } from 'astro/loaders';

const blog = defineCollection({
	loader: glob({ pattern: '**/*.md', base: './src/content/blog' }),
	schema: z.object({
		title: z.string(),
		seoTitle: z.string().optional(),
		description: z.string(),
		pubDate: z.coerce.date(),
		updatedDate: z.coerce.date(),
		image: z.string().optional(),
		imageAlt: z.string().optional(),
		tags: z.array(z.string()).default([]),
		readingTime: z.string().optional(),
		wpId: z.number(),
	}),
});

const pages = defineCollection({
	loader: glob({ pattern: '**/*.md', base: './src/content/pages' }),
	schema: z.object({ title: z.string(), updatedDate: z.coerce.date() }),
});

export const collections = { blog, pages };
