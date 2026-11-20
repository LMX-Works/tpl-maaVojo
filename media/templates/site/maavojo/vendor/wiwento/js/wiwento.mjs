// src/js/core/registry.js
var e = [];
function t(t) {
	return typeof t == "function" ? e.includes(t) ? (console.warn("WIWENTO: Komponente bereits registriert:", t.name || "Unbekannt"), !1) : (e.push(t), !0) : (console.error("WIWENTO: Ungültige Komponente. Erwartet wird eine Funktion."), !1);
}
function n() {
	let t = [];
	return e.forEach(function(e) {
		let n = e.name || "Unbekannt";
		try {
			let r = e(), i = typeof r == "object" && r && !Array.isArray(r) ? r : {};
			t.push({
				name: n,
				status: "success",
				result: {
					...i,
					initialized: Number.isFinite(i.initialized) ? i.initialized : 0
				}
			});
		} catch (e) {
			console.error("WIWENTO: Fehler in Komponente " + n, e), t.push({
				name: n,
				status: "error",
				result: { initialized: 0 },
				error: String(e?.message ?? e)
			});
		}
	}), t;
}
// src/js/core/config.js
var r = {
	debug: !1,
	navigation: {
		enabled: !0,
		currentMode: "auto",
		debug: !1
	},
	accordion: {
		enabled: !0,
		debug: !1
	},
	tabs: {
		enabled: !0,
		debug: !1
	},
	dropdown: {
		enabled: !0,
		debug: !1
	},
	modal: {
		enabled: !0,
		debug: !1
	}
}, i = [
	"auto",
	"manual",
	"detect"
];
function a(e = {}) {
	let t = {
		...r,
		...e,
		navigation: {
			...r.navigation,
			...e.navigation
		},
		accordion: {
			...r.accordion,
			...e.accordion
		},
		tabs: {
			...r.tabs,
			...e.tabs
		},
		dropdown: {
			...r.dropdown,
			...e.dropdown
		},
		modal: {
			...r.modal,
			...e.modal
		}
	};
	if (!i.includes(t.navigation.currentMode)) throw Error("WIWENTO: Ungültiger Navigationsmodus: " + t.navigation.currentMode);
	return t;
}
// src/js/content/accordion.js
function o() {
	let e = document.querySelectorAll(".wiw-accordion"), t = 0;
	return e.forEach(function(e) {
		if (e.dataset.initialized === "true") return;
		let n = e.dataset.mode || "single", r = e.querySelectorAll(".wiw-accordion__item"), i = 0;
		r.forEach(function(e) {
			let t = e.querySelector(".wiw-accordion__trigger");
			if (!t) {
				console.warn("WIWENTO: Akkordeon-Button fehlt.", e);
				return;
			}
			let a = e.classList.contains("is-open");
			t.setAttribute("aria-expanded", a ? "true" : "false"), t.addEventListener("click", function() {
				let i = e.classList.contains("is-open");
				n === "single" && r.forEach(function(e) {
					e.classList.remove("is-open");
					let t = e.querySelector(".wiw-accordion__trigger");
					t && t.setAttribute("aria-expanded", "false");
				}), i ? (e.classList.remove("is-open"), t.setAttribute("aria-expanded", "false")) : (e.classList.add("is-open"), t.setAttribute("aria-expanded", "true"));
			}), i++;
		}), i > 0 && (e.dataset.initialized = "true", t++);
	}), t > 0 ? console.log("WIWENTO: " + t + " Akkordeon(e) initialisiert.") : e.length === 0 ? console.log("WIWENTO: Keine Akkordeons auf dieser Seite gefunden.") : console.log("WIWENTO: Keine neuen Akkordeons initialisiert."), { initialized: t };
}
// src/js/content/tabs.js
function s() {
	let e = document.querySelectorAll(".wiw-tabs"), t = 0;
	return e.forEach(function(e) {
		if (e.dataset.initialized === "true") return;
		let n = e.querySelector("[role=\"tablist\"]");
		if (!n) {
			console.warn("WIWENTO: Tab-Navigation fehlt.", e);
			return;
		}
		let r = Array.from(n.querySelectorAll("[role=\"tab\"]")).map(function(t) {
			let n = t.getAttribute("aria-controls"), r = n ? document.getElementById(n) : null;
			return !r || !e.contains(r) ? (console.warn("WIWENTO: Zugehöriger Tab-Inhaltsbereich fehlt.", t), null) : {
				tab: t,
				panel: r
			};
		}).filter(Boolean);
		if (r.length === 0) {
			console.warn("WIWENTO: Keine gültigen Tabs gefunden.", e);
			return;
		}
		let i = r.filter(function(e) {
			return !e.tab.disabled && e.tab.getAttribute("aria-disabled") !== "true";
		});
		if (i.length === 0) {
			console.warn("WIWENTO: Keine aktivierbaren Tabs vorhanden.", e);
			return;
		}
		function a(e) {
			r.forEach(function(t) {
				let n = t.tab === e;
				t.tab.classList.toggle("is-active", n), t.tab.setAttribute("aria-selected", n ? "true" : "false"), t.tab.setAttribute("tabindex", n ? "0" : "-1"), t.panel.classList.toggle("is-active", n), t.panel.hidden = !n;
			});
		}
		a((i.find(function(e) {
			return e.tab.getAttribute("aria-selected") === "true" || e.tab.classList.contains("is-active");
		}) || i[0]).tab), r.forEach(function(e) {
			e.tab.addEventListener("click", function() {
				e.tab.disabled || e.tab.getAttribute("aria-disabled") === "true" || a(e.tab);
			});
		}), n.addEventListener("keydown", function(e) {
			let t = i.findIndex(function(t) {
				return t.tab === e.target;
			});
			if (t === -1) return;
			let n = t;
			switch (e.key) {
				case "ArrowRight":
					n = (t + 1) % i.length;
					break;
				case "ArrowLeft":
					n = (t - 1 + i.length) % i.length;
					break;
				case "Home":
					n = 0;
					break;
				case "End":
					n = i.length - 1;
					break;
				default: return;
			}
			e.preventDefault();
			let r = i[n].tab;
			r.focus(), a(r);
		}), e.dataset.initialized = "true", t++;
	}), t > 0 ? console.log("WIWENTO: " + t + " Tab-Gruppe(n) initialisiert.") : e.length === 0 ? console.log("WIWENTO: Keine Tab-Gruppen auf dieser Seite gefunden.") : console.log("WIWENTO: Keine neuen Tab-Gruppen initialisiert."), { initialized: t };
}
// src/js/interaction/dropdown.js
function c() {
	let e = document.querySelectorAll("[data-wiw-dropdown]"), t = 0, n = null;
	function r(e) {
		let t = e.querySelector(".wiw-dropdown__trigger"), r = e.querySelector(".wiw-dropdown__content");
		t && r && (e.classList.remove("is-open"), t.setAttribute("aria-expanded", "false"), r.hidden = !0, n === e && (n = null));
	}
	function i(e) {
		let t = e.querySelector(".wiw-dropdown__trigger"), i = e.querySelector(".wiw-dropdown__content");
		t && i && (n && n !== e && r(n), e.classList.add("is-open"), t.setAttribute("aria-expanded", "true"), i.hidden = !1, n = e);
	}
	return e.forEach(function(e) {
		if (e.dataset.initialized === "true") return;
		let a = e.querySelector(".wiw-dropdown__trigger"), o = e.querySelector(".wiw-dropdown__content");
		!a || !o ? console.warn("WIWENTO: Dropdown-Trigger oder Inhalt fehlt.", e) : ([
			"top",
			"bottom",
			"left",
			"right"
		].includes(e.dataset.placement) || (e.dataset.placement = "bottom"), r(e), a.addEventListener("click", function() {
			n === e ? r(e) : i(e);
		}), o.addEventListener("click", function(t) {
			t.target.closest("a, button") && r(e);
		}), e.dataset.initialized = "true", t++);
	}), document.addEventListener("click", function(e) {
		n && (n.contains(e.target) || r(n));
	}), document.addEventListener("keydown", function(e) {
		if (e.key !== "Escape" || !n) return;
		let t = n.querySelector(".wiw-dropdown__trigger");
		r(n), t?.focus();
	}), t > 0 ? console.log("WIWENTO: " + t + " Dropdown(s) initialisiert.") : e.length === 0 ? console.log("WIWENTO: Keine Dropdowns auf dieser Seite gefunden.") : console.log("WIWENTO: Keine neuen Dropdowns initialisiert."), { initialized: t };
}
// src/js/interaction/modal.js
function l() {
	let e = document.querySelectorAll("[data-wiw-modal]"), t = document.querySelectorAll("[data-wiw-modal-open]"), n = 0, r = null, i = null;
	function a(e) {
		e && e.open && e.close();
	}
	function o(e, t) {
		e && !e.open && (r && r !== e && a(r), r = e, i = t, e.showModal());
	}
	return e.forEach(function(e) {
		e.dataset.initialized !== "true" && (e instanceof HTMLDialogElement ? (e.querySelectorAll("[data-wiw-modal-close]").forEach(function(t) {
			t.addEventListener("click", function() {
				a(e);
			});
		}), e.addEventListener("click", function(t) {
			e.dataset.closeOnBackdrop === "true" && t.target === e && a(e);
		}), e.addEventListener("close", function() {
			if (r !== e) return;
			r = null;
			let t = i;
			i = null, t?.focus();
		}), e.dataset.initialized = "true", n++) : console.warn("WIWENTO: Modal benötigt ein dialog-Element.", e));
	}), t.forEach(function(e) {
		e.dataset.initialized !== "true" && (e.addEventListener("click", function() {
			let t = e.dataset.wiwModalOpen, n = document.getElementById(t);
			!n || !n.matches("[data-wiw-modal]") ? console.warn("WIWENTO: Zugehöriges Modal nicht gefunden.", t) : o(n, e);
		}), e.dataset.initialized = "true");
	}), n > 0 ? console.log("WIWENTO: " + n + " Modal(s) initialisiert.") : e.length === 0 ? console.log("WIWENTO: Keine Modals auf dieser Seite gefunden.") : console.log("WIWENTO: Keine neuen Modals initialisiert."), { initialized: n };
}
// src/js/navigation/current-page.js
function u(e) {
	let t = e.replace(/\/+$/, "");
	return t = t.replace(/\/index\.html$/i, ""), t || "/";
}
function d(e) {
	if (!e) return null;
	let t = u(window.location.pathname), n = e.querySelectorAll(".wiw-nav__link[href]"), r = [];
	return n.forEach(function(e) {
		let n = e.getAttribute("href");
		if (!n || n.startsWith("#")) return;
		let i;
		try {
			i = new URL(n, window.location.href);
		} catch {
			console.warn("WIWENTO: Ungültiges Navigationsziel:", n);
			return;
		}
		i.origin === window.location.origin && u(i.pathname) === t && r.push(e);
	}), r.length === 0 ? null : (r.length > 1 && console.warn("WIWENTO: Mehrere Navigationslinks passen zur aktuellen URL.", r), r[0]);
}
// src/js/navigation/navigation.js
function f(e = {}) {
	let t = document.querySelectorAll("[data-wiw-nav]"), n = 0;
	function r(t) {
		let n = t.dataset.wiwCurrent, r = e.currentMode || "auto", i = n || r;
		return [
			"auto",
			"manual",
			"detect"
		].includes(i) ? i : (console.warn("WIWENTO: Ungültiger Navigationsmodus:", i), "auto");
	}
	function i(e) {
		let t = e.querySelectorAll("[aria-current=\"page\"]");
		return t.length > 1 && console.warn("WIWENTO: Mehrere aktuelle Navigationslinks markiert.", t), t;
	}
	function a(e, t) {
		let n = i(e)[0] || null, r = d(e);
		return t === "auto" ? r ? (e.querySelectorAll(".wiw-nav__link").forEach(function(e) {
			e.classList.remove("is-current"), e.removeAttribute("aria-current");
		}), r.setAttribute("aria-current", "page"), r.classList.add("is-current"), r) : (console.warn("WIWENTO: Kein passender Navigationslink gefunden."), null) : t === "manual" ? n ? (n.classList.add("is-current"), n) : (console.warn("WIWENTO: Keine manuelle Seitenkennzeichnung gefunden."), null) : t === "detect" ? !n && !r ? (console.warn("WIWENTO: Keine aktuelle Seite erkannt."), null) : n ? r ? n === r ? (console.info("WIWENTO: URL und HTML-Kennzeichnung stimmen überein."), n) : (console.warn("WIWENTO: Abweichung zwischen URL und HTML.", {
			html: n,
			url: r
		}), n) : (console.warn("WIWENTO: HTML-Kennzeichnung vorhanden, aber kein passender URL-Link gefunden.", n), n) : (console.warn("WIWENTO: URL erkannt, aber aria-current fehlt.", r), null) : null;
	}
	function o(e) {
		let t = e.getAttribute("aria-controls"), n = document.getElementById(t);
		n && (e.setAttribute("aria-expanded", "false"), e.classList.remove("is-open"), n.hidden = !0, n.querySelectorAll("[data-wiw-nav-toggle]").forEach(function(e) {
			let t = e.getAttribute("aria-controls"), n = document.getElementById(t);
			e.setAttribute("aria-expanded", "false"), e.classList.remove("is-open"), n && (n.hidden = !0);
		}));
	}
	function s(e) {
		let t = e.getAttribute("aria-controls"), n = document.getElementById(t);
		if (!n) return;
		let r = e.closest("li");
		if (!r) return;
		let i = r.parentElement;
		i && (i.querySelectorAll(":scope > li > .wiw-nav__item-header > [data-wiw-nav-toggle]").forEach(function(t) {
			t !== e && o(t);
		}), n.hidden = !1, e.setAttribute("aria-expanded", "true"), e.classList.add("is-open"), c(n));
	}
	function c(e) {
		let t = e.querySelector(".wiw-nav__item.is-active-path");
		if (!t) return;
		let n = t.querySelector(":scope > .wiw-nav__item-header > [data-wiw-nav-toggle]");
		n && n.getAttribute("aria-expanded") !== "true" && s(n);
	}
	function l(e) {
		if (!e) return;
		e.classList.add("is-current");
		let t = e.closest("li");
		for (; t;) {
			let e = t.parentElement;
			if (!e) break;
			let n = e.closest("li");
			if (!n) break;
			n.classList.add("is-active-path"), t = n;
		}
	}
	return t.forEach(function(e) {
		if (e.dataset.initialized === "true") return;
		let t = r(e), i = e.querySelectorAll("[data-wiw-nav-toggle]");
		i.forEach(function(e) {
			let t = e.getAttribute("aria-controls"), n = document.getElementById(t);
			e.setAttribute("aria-expanded", "false"), e.classList.remove("is-open"), n && (n.hidden = !0);
		});
		let c = a(e, t);
		c && l(c), i.forEach(function(e) {
			e.addEventListener("click", function() {
				e.getAttribute("aria-expanded") === "true" ? o(e) : s(e);
			});
		}), e.dataset.initialized = "true", n++;
	}), n > 0 ? console.log("WIWENTO: " + n + " Navigation(en) initialisiert.") : t.length === 0 ? console.log("WIWENTO: Keine Navigationen auf dieser Seite gefunden.") : console.log("WIWENTO: Keine neuen Navigationen initialisiert."), { initialized: n };
}
// src/js/navigation/offcanvas.js
var p = /* @__PURE__ */ new Set(), m = null, h = /* @__PURE__ */ new WeakMap();
function g(e) {
	p.add(e), document.body.classList.add("wiw-offcanvas-open");
}
function _(e) {
	p.delete(e), p.size === 0 && document.body.classList.remove("wiw-offcanvas-open");
}
function v(e) {
	return Array.from(e.querySelectorAll("a[href],area[href],button:not([disabled]),input:not([disabled]),select:not([disabled]),textarea:not([disabled]),[tabindex]:not([tabindex=\"-1\"]),[contenteditable=\"true\"]")).filter((e) => e.getClientRects().length > 0 && !e.closest("[inert]") && e.getAttribute("aria-hidden") !== "true");
}
function y(e) {
	let t = parseFloat(e);
	return Number.isFinite(t) ? e.trim().endsWith("ms") ? t : t * 1e3 : 0;
}
function b(e) {
	let t = h.get(e);
	t && (e.removeEventListener("transitionend", t.end), e.removeEventListener("transitioncancel", t.cancel), h.delete(e));
}
function x(e) {
	b(e);
	let t = window.getComputedStyle(e), n = t.transitionDuration.split(",").map(y), r = t.transitionDelay.split(",").map(y);
	if (Math.max(0, ...n) + Math.max(0, ...r) === 0) {
		e.hidden = !0;
		return;
	}
	function i(t) {
		t.target === e && t.propertyName === "opacity" && (b(e), e.classList.contains("is-visible") || (e.hidden = !0));
	}
	function a() {
		b(e), e.classList.contains("is-visible") || (e.hidden = !0);
	}
	let o = {
		end: i,
		cancel: a
	};
	h.set(e, o), e.addEventListener("transitionend", o.end), e.addEventListener("transitioncancel", o.cancel);
}
function S() {
	let e = 0, t = document.querySelectorAll("[data-wiw-offcanvas]");
	return t.length ? (t.forEach((t) => {
		if (t.dataset.wiwInitialized === "true") return;
		let n = t.id;
		if (!n) {
			console.warn("WIWENTO Offcanvas: Panel benötigt eine ID.", t);
			return;
		}
		let r = Array.from(document.querySelectorAll("[data-wiw-offcanvas-open]")).filter((e) => e.getAttribute("data-wiw-offcanvas-open") === n), i = t.querySelectorAll("[data-wiw-offcanvas-close]"), a = Array.from(document.querySelectorAll("[data-wiw-offcanvas-backdrop]")).find((e) => e.getAttribute("data-wiw-offcanvas-backdrop") === n);
		if (!a) {
			console.warn("WIWENTO Offcanvas: Zugehöriger Backdrop fehlt.", t);
			return;
		}
		t.classList.remove("is-open"), t.setAttribute("aria-hidden", "true"), t.inert = !0, a.classList.remove("is-visible"), a.hidden = !0, r.forEach((e) => {
			e.setAttribute("aria-expanded", "false");
		}), t.dataset.wiwInitialized = "true", e++;
		let o = null;
		function s(e) {
			if (m?.panel === t) return;
			m && m.close(), o = e, t.classList.add("is-open"), t.setAttribute("aria-hidden", "false"), t.inert = !1, m = {
				panel: t,
				close: c
			}, b(a), a.hidden = !1, requestAnimationFrame(() => {
				m?.panel === t && a.classList.add("is-visible");
			}), g(t);
			let n = v(t);
			n.length > 0 ? n[0].focus() : (t.setAttribute("tabindex", "-1"), t.focus()), r.forEach((e) => {
				e.setAttribute("aria-expanded", "true");
			});
		}
		function c() {
			m?.panel === t && (m = null, t.classList.remove("is-open"), t.setAttribute("aria-hidden", "true"), t.inert = !0, a.classList.remove("is-visible"), x(a), _(t), r.forEach((e) => {
				e.setAttribute("aria-expanded", "false");
			}), o && o.isConnected && o.focus(), o = null);
		}
		r.forEach((e) => {
			e.addEventListener("click", () => {
				s(e);
			});
		}), i.forEach((e) => {
			e.addEventListener("click", c);
		}), a.addEventListener("click", c), document.addEventListener("keydown", (e) => {
			if (m?.panel !== t) return;
			if (e.key === "Escape") {
				e.preventDefault(), c();
				return;
			}
			if (e.key !== "Tab") return;
			let n = v(t);
			if (n.length === 0) {
				e.preventDefault(), t.focus();
				return;
			}
			let r = n[0], i = n[n.length - 1];
			e.shiftKey ? document.activeElement !== r && t.contains(document.activeElement) || (e.preventDefault(), i.focus()) : document.activeElement !== i && t.contains(document.activeElement) || (e.preventDefault(), r.focus());
		});
	}), { initialized: e }) : { initialized: 0 };
}
// src/js/wiwento.js
var C = {
	initialized: !1,
	config: null,
	statistics: null,
	init: function(e = {}) {
		if (this.initialized) return console.info("WIWENTO: Framework wurde bereits initialisiert."), this.statistics;
		console.info("WIWENTO: Framework wird gestartet."), this.config = a(e);
		let r = [];
		this.config.accordion.enabled && r.push(t(function() {
			return o(C.config.accordion);
		})), this.config.tabs.enabled && r.push(t(function() {
			return s(C.config.tabs);
		})), this.config.dropdown.enabled && r.push(t(function() {
			return c(C.config.dropdown);
		})), this.config.modal.enabled && r.push(t(function() {
			return l(C.config.modal);
		})), this.config.navigation.enabled && (r.push(t(function() {
			return f(C.config.navigation);
		})), r.push(t(function() {
			return S();
		})));
		let i = n(), u = {
			registered: r.filter(Boolean).length,
			successful: 0,
			failed: 0,
			initialized: 0
		};
		return i.forEach(function(e) {
			u.initialized += e.result.initialized, e.status === "success" && u.successful++, e.status === "error" && u.failed++;
		}), this.statistics = u, this.initialized = !0, console.info("WIWENTO: Komponentenstatus", i), console.info("WIWENTO: Initialisierungsstatistik", u), this.statistics;
	}
};
export { C as WIWENTO };
