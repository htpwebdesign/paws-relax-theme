(() => {
	"use strict";
	var e,
		o = {
			326: () => {
				const e = window.wp.blocks,
					o = window.wp.i18n,
					n = window.wp.blockEditor,
					r = window.wp.coreData,
					s = window.wp.components,
					a = window.ReactJSXRuntime,
					t = JSON.parse('{"UU":"paws-blocks/company-phonenumber"}');
				(0, e.registerBlockType)(t.UU, {
					edit: function ({ attributes: e, setAttributes: t }) {
						const [l, i] = (0, r.useEntityProp)(
								"postType",
								"page",
								"meta",
								324,
							),
							{ company_address: c } = l,
							{ svgIcon: p } = e;
						return (0, a.jsxs)(a.Fragment, {
							children: [
								(0, a.jsxs)("address", {
									...(0, n.useBlockProps)(),
									children: [
										p &&
											(0, a.jsx)("svg", {
												xmlns: "http://www.w3.org/2000/svg",
												width: "24",
												height: "24",
												viewBox: "0 0 24 24",
												role: "img",
												"aria-label": "Phone Icon",
												children: (0, a.jsx)("path", {
													d: "M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.06-.24c1.12.37 2.33.57 3.53.57a1 1 0 011 1v3.54a1 1 0 01-1 1A19.93 19.93 0 012 4a1 1 0 011-1h3.54a1 1 0 011 1c0 1.2.2 2.41.57 3.53a1 1 0 01-.24 1.06l-2.25 2.2z",
												}),
											}),
										(0, a.jsx)(n.RichText, {
											placeholder: (0, o.__)(
												"Enter company phone number here...",
												"paws-blocks",
											),
											tagName: "p",
											value: c,
											onChange: (e) => {
												return (
													(o = "company_phonenumber"),
													(n = e),
													void i({ ...l, [o]: n })
												);
												var o, n;
											},
										}),
									],
								}),
								(0, a.jsx)(n.InspectorControls, {
									children: (0, a.jsx)(s.PanelBody, {
										title: (0, o.__)("Settings", "paws-blocks"),
										children: (0, a.jsx)(s.PanelRow, {
											children: (0, a.jsx)(s.ToggleControl, {
												label: (0, o.__)("Show SVG Icon", "paws-blocks"),
												checked: p,
												onChange: (e) => t({ svgIcon: e }),
												help: (0, o.__)(
													"Display an SVG icon next to the phonenumber.",
													"paws-blocks",
												),
											}),
										}),
									}),
								}),
							],
						});
					},
				});
			},
		},
		n = {};
	function r(e) {
		var s = n[e];
		if (void 0 !== s) return s.exports;
		var a = (n[e] = { exports: {} });
		return o[e](a, a.exports, r), a.exports;
	}
	(r.m = o),
		(e = []),
		(r.O = (o, n, s, a) => {
			if (!n) {
				var t = 1 / 0;
				for (p = 0; p < e.length; p++) {
					for (var [n, s, a] = e[p], l = !0, i = 0; i < n.length; i++)
						(!1 & a || t >= a) && Object.keys(r.O).every((e) => r.O[e](n[i]))
							? n.splice(i--, 1)
							: ((l = !1), a < t && (t = a));
					if (l) {
						e.splice(p--, 1);
						var c = s();
						void 0 !== c && (o = c);
					}
				}
				return o;
			}
			a = a || 0;
			for (var p = e.length; p > 0 && e[p - 1][2] > a; p--) e[p] = e[p - 1];
			e[p] = [n, s, a];
		}),
		(r.o = (e, o) => Object.prototype.hasOwnProperty.call(e, o)),
		(() => {
			var e = { 853: 0, 865: 0 };
			r.O.j = (o) => 0 === e[o];
			var o = (o, n) => {
					var s,
						a,
						[t, l, i] = n,
						c = 0;
					if (t.some((o) => 0 !== e[o])) {
						for (s in l) r.o(l, s) && (r.m[s] = l[s]);
						if (i) var p = i(r);
					}
					for (o && o(n); c < t.length; c++)
						(a = t[c]), r.o(e, a) && e[a] && e[a][0](), (e[a] = 0);
					return r.O(p);
				},
				n = (globalThis.webpackChunkpaws_blocks =
					globalThis.webpackChunkpaws_blocks || []);
			n.forEach(o.bind(null, 0)), (n.push = o.bind(null, n.push.bind(n)));
		})();
	var s = r.O(void 0, [865], () => r(326));
	s = r.O(s);
})();
