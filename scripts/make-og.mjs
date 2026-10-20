// Generates public/og-default.png (1200x630) from an inline SVG using sharp (bundled with Astro).
import sharp from 'sharp';
const svg = `
<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="630" viewBox="0 0 1200 630">
  <defs>
    <radialGradient id="g" cx="85%" cy="0%" r="80%"><stop offset="0" stop-color="#2495fe" stop-opacity=".55"/><stop offset="1" stop-color="#2495fe" stop-opacity="0"/></radialGradient>
  </defs>
  <rect width="1200" height="630" fill="#080d19"/>
  <rect width="1200" height="630" fill="url(#g)"/>
  <g transform="translate(72 72)">
    <rect width="112" height="56" rx="28" fill="#2495fe"/><circle cx="84" cy="28" r="20" fill="#fff"/>
    <text x="136" y="40" font-family="Helvetica, Arial, sans-serif" font-size="30" font-weight="700" letter-spacing="2" fill="#fff">CLOUD TOGGLE</text>
  </g>
  <text x="72" y="320" font-family="Helvetica, Arial, sans-serif" font-size="76" font-weight="700" letter-spacing="-2" fill="#fff">Stop paying for cloud</text>
  <text x="72" y="408" font-family="Helvetica, Arial, sans-serif" font-size="76" font-weight="700" letter-spacing="-2" fill="#fff">servers nobody is using.</text>
  <text x="72" y="494" font-family="Helvetica, Arial, sans-serif" font-size="32" fill="#9fb0cf">Schedule AWS and Azure servers to run only when needed.</text>
  <g transform="translate(72 548)">
    ${Array.from({ length: 24 }, (_, i) => `<rect x="${i * 30}" width="24" height="24" rx="6" fill="${i >= 9 && i < 18 ? '#03d908' : '#1d2a47'}"/>`).join('')}
  </g>
</svg>`;
await sharp(Buffer.from(svg)).png().toFile('public/og-default.png');
console.log('og-default.png written');
