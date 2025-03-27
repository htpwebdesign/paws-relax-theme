(() => {
	"use strict";
	var e,
		o = [
			,
			() => {
				const e = window.wp.blocks,
					o = window.wp.i18n,
					r = window.wp.blockEditor,
					n = window.wp.coreData,
					s = window.wp.components,
					t = window.ReactJSXRuntime,
					a = JSON.parse('{"UU":"paws-blocks/company-email"}');
				(0, e.registerBlockType)(a.UU, {
					edit: function ({ attributes: e, setAttributes: a }) {
						const [l, i] = (0, n.useEntityProp)(
								"postType",
								"page",
								"meta",
								324,
							),
							{ company_email: c } = l,
							{ svgIcon: p } = e;
						return (0, t.jsxs)(t.Fragment, {
							children: [
								(0, t.jsxs)("address", {
									...(0, r.useBlockProps)(),
									children: [
										p &&
											(0, t.jsx)("svg", {
												xmlns: "http://www.w3.org/2000/svg",
												width: "24",
												height: "24",
												viewBox: "0 0 24 24",
												role: "img",
												"aria-label": "Email Icon",
												children: (0, t.jsx)("path", {
													d: "M0 4c0-1.104.896-2 2-2h20c1.104 0 2 .896 2 2v16c0 1.104-.896 2-2 2H2c-1.104 0-2-.896-2-2V4zm22 0H2v1.586l10 6.414 10-6.414V4zm-10 9L2 7v11h20V7l-10 6z",
												}),
											}),
										(0, t.jsx)(r.RichText, {
											placeholder: (0, o.__)(
												"Enter email here...",
												"paws-blocks",
											),
											tagName: "p",
											value: c,
											onChange: (e) => {
												return (
													(o = "company_email"),
													(r = e),
													void i({ ...l, [o]: r })
												);
												var o, r;
											},
										}),
									],
								}),
								(0, t.jsx)(r.InspectorControls, {
									children: (0, t.jsx)(s.PanelBody, {
										title: (0, o.__)("Settings", "paws-blocks"),
										children: (0, t.jsx)(s.PanelRow, {
											children: (0, t.jsx)(s.ToggleControl, {
												label: (0, o.__)("Show SVG Icon", "paws-blocks"),
												checked: p,
												onChange: (e) => a({ svgIcon: e }),
												help: (0, o.__)(
													"Display an SVG icon next to the email.",
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
		],
		r = {};
	function n(e) {
		var s = r[e];
		if (void 0 !== s) return s.exports;
		var t = (r[e] = { exports: {} });
		return o[e](t, t.exports, n), t.exports;
	}
	(n.m = o),
		(e = []),
		(n.O = (o, r, s, t) => {
			if (!r) {
				var a = 1 / 0;
				for (p = 0; p < e.length; p++) {
					for (var [r, s, t] = e[p], l = !0, i = 0; i < r.length; i++)
						(!1 & t || a >= t) && Object.keys(n.O).every((e) => n.O[e](r[i]))
							? r.splice(i--, 1)
							: ((l = !1), t < a && (a = t));
					if (l) {
						e.splice(p--, 1);
						var c = s();
						void 0 !== c && (o = c);
					}
				}
				return o;
			}
			t = t || 0;
			for (var p = e.length; p > 0 && e[p - 1][2] > t; p--) e[p] = e[p - 1];
			e[p] = [r, s, t];
		}),
		(n.o = (e, o) => Object.prototype.hasOwnProperty.call(e, o)),
		(() => {
			var e = { 226: 0, 942: 0 };
			n.O.j = (o) => 0 === e[o];
			var o = (o, r) => {
					var s,
						t,
						[a, l, i] = r,
						c = 0;
					if (a.some((o) => 0 !== e[o])) {
						for (s in l) n.o(l, s) && (n.m[s] = l[s]);
						if (i) var p = i(n);
					}
					for (o && o(r); c < a.length; c++)
						(t = a[c]), n.o(e, t) && e[t] && e[t][0](), (e[t] = 0);
					return n.O(p);
				},
				r = (globalThis.webpackChunkpaws_blocks =
					globalThis.webpackChunkpaws_blocks || []);
			r.forEach(o.bind(null, 0)), (r.push = o.bind(null, r.push.bind(r)));
		})();
	var s = n.O(void 0, [942], () => n(1));
	s = n.O(s);
})();
