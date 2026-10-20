/**
 * CLOUD TOGGLE theme behaviour: mobile menu, scroll reveal, video facade and savings calculator.
 * No dependencies. Each feature is a no-op when its markup isn't on the page.
 */
(function () {
	'use strict';

	/* Mobile menu */
	var btn = document.querySelector('[data-menu-toggle]');
	var menu = document.querySelector('[data-menu]');
	if (btn && menu) {
		var setMenu = function (open) {
			menu.classList.toggle('hidden', !open);
			btn.setAttribute('aria-expanded', String(open));
			btn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
			var o = btn.querySelector('[data-icon-open]');
			var c = btn.querySelector('[data-icon-close]');
			if (o) o.classList.toggle('hidden', open);
			if (c) c.classList.toggle('hidden', !open);
		};
		btn.addEventListener('click', function () { setMenu(menu.classList.contains('hidden')); });
		menu.querySelectorAll('a').forEach(function (a) { a.addEventListener('click', function () { setMenu(false); }); });
		document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setMenu(false); });
	}

	/* Scroll reveal */
	var reveal = document.querySelectorAll('[data-reveal]');
	if (reveal.length) {
		if (!('IntersectionObserver' in window)) {
			reveal.forEach(function (el) { el.classList.add('is-visible'); });
		} else {
			var io = new IntersectionObserver(function (entries) {
				entries.forEach(function (e) {
					if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); }
				});
			}, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
			reveal.forEach(function (el) { io.observe(el); });
		}
	}

	/* Video facade: loads YouTube only after the visitor presses play */
	document.querySelectorAll('[data-video]').forEach(function (box) {
		var link = box.querySelector('[data-video-play]');
		if (!link) return;
		link.addEventListener('click', function (e) {
			e.preventDefault();
			var frame = document.createElement('iframe');
			frame.src = 'https://www.youtube-nocookie.com/embed/' + box.getAttribute('data-id') + '?autoplay=1&rel=0';
			frame.title = 'CLOUD TOGGLE overview video';
			frame.allow = 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture; fullscreen';
			frame.allowFullscreen = true;
			frame.className = 'aspect-video w-full';
			link.replaceWith(frame);
			frame.focus();
		});
	});

	/* Savings calculator */
	var form = document.getElementById('calc');
	if (form) {
		var $ = function (id) { return document.getElementById(id); };
		var plans = [];
		try { plans = JSON.parse(form.getAttribute('data-plans') || '[]'); } catch (err) { plans = []; }
		var els = { servers: $('servers'), hours: $('hours'), days: $('days'), rate: $('rate') };
		var grid = $('grid');
		var HOURS_PER_MONTH = 730;
		var HOURS_PER_WEEK = 168;
		var fmt = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 });
		var money = function (n) { return fmt.format(Math.round(n)); };
		var presets = document.querySelectorAll('.preset');
		var cells = [];
		for (var i = 0; i < 168; i++) {
			var c = document.createElement('span');
			c.className = 'aspect-square rounded-[3px] transition-colors duration-300';
			grid.appendChild(c);
			cells.push(c);
		}
		var update = function () {
			var servers = +els.servers.value;
			var hours = +els.hours.value;
			var days = +els.days.value;
			var rate = Math.max(0, parseFloat(els.rate.value) || 0);
			$('servers-out').textContent = servers;
			$('hours-out').textContent = hours;
			$('days-out').textContent = days;
			var onShare = (hours * days) / HOURS_PER_WEEK;
			var before = servers * rate * HOURS_PER_MONTH;
			var after = before * onShare;
			var saving = before - after;
			var plan = plans.filter(function (p) { return servers <= p.servers; })[0];
			$('out-month').textContent = money(saving);
			$('out-year').textContent = money(saving * 12);
			$('out-pct').textContent = Math.round((1 - onShare) * 100) + '%';
			$('out-before').textContent = money(before);
			$('out-after').textContent = money(after);
			$('out-plan').textContent = plan ? plan.name + ' ($' + plan.price + '/mo)' : 'Custom';
			$('out-net').textContent = plan ? money(saving - plan.price) : 'Contact us';
			var start = Math.min(9, 24 - hours);
			cells.forEach(function (cell, idx) {
				var d = Math.floor(idx / 24);
				var h = idx % 24;
				var on = d < days && h >= start && h < start + hours;
				cell.style.backgroundColor = on ? 'var(--color-on)' : 'rgb(255 255 255 / 0.12)';
			});
		};
		Object.keys(els).forEach(function (k) {
			els[k].addEventListener('input', function () {
				presets.forEach(function (b) { b.setAttribute('aria-pressed', 'false'); });
				update();
			});
		});
		presets.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var parts = btn.getAttribute('data-preset').split(',');
				els.hours.value = parts[0];
				els.days.value = parts[1];
				presets.forEach(function (b) { b.setAttribute('aria-pressed', String(b === btn)); });
				update();
			});
		});
		update();
	}
})();
