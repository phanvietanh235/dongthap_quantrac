! function(a, b) {
    "object" == typeof module && "object" == typeof module.exports ? module.exports = a.document ? b(a, !0) : function(a) {
        if (!a.document) throw new Error("jQuery requires a window with a document");
        return b(a)
    } : b(a)
}("undefined" != typeof window ? window : this, function(a, b) {
    function s(a) {
        var b = !!a && "length" in a && a.length,
            c = n.type(a);
        return "function" !== c && !n.isWindow(a) && ("array" === c || 0 === b || "number" == typeof b && b > 0 && b - 1 in a)
    }

    function z(a, b, c) {
        if (n.isFunction(b)) return n.grep(a, function(a, d) {
            return !!b.call(a, d, a) !== c
        });
        if (b.nodeType) return n.grep(a, function(a) {
            return a === b !== c
        });
        if ("string" == typeof b) {
            if (y.test(b)) return n.filter(b, a, c);
            b = n.filter(b, a)
        }
        return n.grep(a, function(a) {
            return h.call(b, a) > -1 !== c
        })
    }

    function F(a, b) {
        for (;
            (a = a[b]) && 1 !== a.nodeType;);
        return a
    }

    function H(a) {
        var b = {};
        return n.each(a.match(G) || [], function(a, c) {
            b[c] = !0
        }), b
    }

    function J() {
        d.removeEventListener("DOMContentLoaded", J), a.removeEventListener("load", J), n.ready()
    }

    function M() {
        this.expando = n.expando + M.uid++
    }

    function R(a, b, c) {
        var d;
        if (void 0 === c && 1 === a.nodeType)
            if (d = "data-" + b.replace(Q, "-$&").toLowerCase(), "string" == typeof(c = a.getAttribute(d))) {
                try {
                    c = "true" === c || "false" !== c && ("null" === c ? null : +c + "" === c ? +c : P.test(c) ? n.parseJSON(c) : c)
                } catch (e) {}
                O.set(a, b, c)
            } else c = void 0;
        return c
    }

    function W(a, b, c, d) {
        var e, f = 1,
            g = 20,
            h = d ? function() {
                return d.cur()
            } : function() {
                return n.css(a, b, "")
            },
            i = h(),
            j = c && c[3] || (n.cssNumber[b] ? "" : "px"),
            k = (n.cssNumber[b] || "px" !== j && +i) && T.exec(n.css(a, b));
        if (k && k[3] !== j) {
            j = j || k[3], c = c || [], k = +i || 1;
            do {
                f = f || ".5", k /= f, n.style(a, b, k + j)
            } while (f !== (f = h() / i) && 1 !== f && --g)
        }
        return c && (k = +k || +i || 0, e = c[1] ? k + (c[1] + 1) * c[2] : +c[2], d && (d.unit = j, d.start = k, d.end = e)), e
    }

    function _(a, b) {
        var c = void 0 !== a.getElementsByTagName ? a.getElementsByTagName(b || "*") : void 0 !== a.querySelectorAll ? a.querySelectorAll(b || "*") : [];
        return void 0 === b || b && n.nodeName(a, b) ? n.merge([a], c) : c
    }

    function aa(a, b) {
        for (var c = 0, d = a.length; d > c; c++) N.set(a[c], "globalEval", !b || N.get(b[c], "globalEval"))
    }

    function ca(a, b, c, d, e) {
        for (var f, g, h, i, j, k, l = b.createDocumentFragment(), m = [], o = 0, p = a.length; p > o; o++)
            if ((f = a[o]) || 0 === f)
                if ("object" === n.type(f)) n.merge(m, f.nodeType ? [f] : f);
                else if (ba.test(f)) {
            for (g = g || l.appendChild(b.createElement("div")), h = (Y.exec(f) || ["", ""])[1].toLowerCase(), i = $[h] || $._default, g.innerHTML = i[1] + n.htmlPrefilter(f) + i[2], k = i[0]; k--;) g = g.lastChild;
            n.merge(m, g.childNodes), g = l.firstChild, g.textContent = ""
        } else m.push(b.createTextNode(f));
        for (l.textContent = "", o = 0; f = m[o++];)
            if (d && n.inArray(f, d) > -1) e && e.push(f);
            else if (j = n.contains(f.ownerDocument, f), g = _(l.appendChild(f), "script"), j && aa(g), c)
            for (k = 0; f = g[k++];) Z.test(f.type || "") && c.push(f);
        return l
    }

    function ga() {
        return !0
    }

    function ha() {
        return !1
    }

    function ia() {
        try {
            return d.activeElement
        } catch (a) {}
    }

    function ja(a, b, c, d, e, f) {
        var g, h;
        if ("object" == typeof b) {
            "string" != typeof c && (d = d || c, c = void 0);
            for (h in b) ja(a, h, c, d, b[h], f);
            return a
        }
        if (null == d && null == e ? (e = c, d = c = void 0) : null == e && ("string" == typeof c ? (e = d, d = void 0) : (e = d, d = c, c = void 0)), !1 === e) e = ha;
        else if (!e) return a;
        return 1 === f && (g = e, e = function(a) {
            return n().off(a), g.apply(this, arguments)
        }, e.guid = g.guid || (g.guid = n.guid++)), a.each(function() {
            n.event.add(this, b, e, d, c)
        })
    }

    function pa(a, b) {
        return n.nodeName(a, "table") && n.nodeName(11 !== b.nodeType ? b : b.firstChild, "tr") ? a.getElementsByTagName("tbody")[0] || a.appendChild(a.ownerDocument.createElement("tbody")) : a
    }

    function qa(a) {
        return a.type = (null !== a.getAttribute("type")) + "/" + a.type, a
    }

    function ra(a) {
        var b = na.exec(a.type);
        return b ? a.type = b[1] : a.removeAttribute("type"), a
    }

    function sa(a, b) {
        var c, d, e, f, g, h, i, j;
        if (1 === b.nodeType) {
            if (N.hasData(a) && (f = N.access(a), g = N.set(b, f), j = f.events)) {
                delete g.handle, g.events = {};
                for (e in j)
                    for (c = 0, d = j[e].length; d > c; c++) n.event.add(b, e, j[e][c])
            }
            O.hasData(a) && (h = O.access(a), i = n.extend({}, h), O.set(b, i))
        }
    }

    function ta(a, b) {
        var c = b.nodeName.toLowerCase();
        "input" === c && X.test(a.type) ? b.checked = a.checked : "input" !== c && "textarea" !== c || (b.defaultValue = a.defaultValue)
    }

    function ua(a, b, c, d) {
        b = f.apply([], b);
        var e, g, h, i, j, k, m = 0,
            o = a.length,
            p = o - 1,
            q = b[0],
            r = n.isFunction(q);
        if (r || o > 1 && "string" == typeof q && !l.checkClone && ma.test(q)) return a.each(function(e) {
            var f = a.eq(e);
            r && (b[0] = q.call(this, e, f.html())), ua(f, b, c, d)
        });
        if (o && (e = ca(b, a[0].ownerDocument, !1, a, d), g = e.firstChild, 1 === e.childNodes.length && (e = g), g || d)) {
            for (h = n.map(_(e, "script"), qa), i = h.length; o > m; m++) j = e, m !== p && (j = n.clone(j, !0, !0), i && n.merge(h, _(j, "script"))), c.call(a[m], j, m);
            if (i)
                for (k = h[h.length - 1].ownerDocument, n.map(h, ra), m = 0; i > m; m++) j = h[m], Z.test(j.type || "") && !N.access(j, "globalEval") && n.contains(k, j) && (j.src ? n._evalUrl && n._evalUrl(j.src) : n.globalEval(j.textContent.replace(oa, "")))
        }
        return a
    }

    function va(a, b, c) {
        for (var d, e = b ? n.filter(b, a) : a, f = 0; null != (d = e[f]); f++) c || 1 !== d.nodeType || n.cleanData(_(d)), d.parentNode && (c && n.contains(d.ownerDocument, d) && aa(_(d, "script")), d.parentNode.removeChild(d));
        return a
    }

    function ya(a, b) {
        var c = n(b.createElement(a)).appendTo(b.body),
            d = n.css(c[0], "display");
        return c.detach(), d
    }

    function za(a) {
        var b = d,
            c = xa[a];
        return c || (c = ya(a, b), "none" !== c && c || (wa = (wa || n("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement), b = wa[0].contentDocument, b.write(), b.close(), c = ya(a, b), wa.detach()), xa[a] = c), c
    }

    function Fa(a, b, c) {
        var d, e, f, g, h = a.style;
        return c = c || Ca(a), g = c ? c.getPropertyValue(b) || c[b] : void 0, "" !== g && void 0 !== g || n.contains(a.ownerDocument, a) || (g = n.style(a, b)), c && !l.pixelMarginRight() && Ba.test(g) && Aa.test(b) && (d = h.width, e = h.minWidth, f = h.maxWidth, h.minWidth = h.maxWidth = h.width = g, g = c.width, h.width = d, h.minWidth = e, h.maxWidth = f), void 0 !== g ? g + "" : g
    }

    function Ga(a, b) {
        return {
            get: function() {
                return a() ? void delete this.get : (this.get = b).apply(this, arguments)
            }
        }
    }

    function Ma(a) {
        if (a in La) return a;
        for (var b = a[0].toUpperCase() + a.slice(1), c = Ka.length; c--;)
            if ((a = Ka[c] + b) in La) return a
    }

    function Na(a, b, c) {
        var d = T.exec(b);
        return d ? Math.max(0, d[2] - (c || 0)) + (d[3] || "px") : b
    }

    function Oa(a, b, c, d, e) {
        for (var f = c === (d ? "border" : "content") ? 4 : "width" === b ? 1 : 0, g = 0; 4 > f; f += 2) "margin" === c && (g += n.css(a, c + U[f], !0, e)), d ? ("content" === c && (g -= n.css(a, "padding" + U[f], !0, e)), "margin" !== c && (g -= n.css(a, "border" + U[f] + "Width", !0, e))) : (g += n.css(a, "padding" + U[f], !0, e), "padding" !== c && (g += n.css(a, "border" + U[f] + "Width", !0, e)));
        return g
    }

    function Pa(a, b, c) {
        var d = !0,
            e = "width" === b ? a.offsetWidth : a.offsetHeight,
            f = Ca(a),
            g = "border-box" === n.css(a, "boxSizing", !1, f);
        if (0 >= e || null == e) {
            if (e = Fa(a, b, f), (0 > e || null == e) && (e = a.style[b]), Ba.test(e)) return e;
            d = g && (l.boxSizingReliable() || e === a.style[b]), e = parseFloat(e) || 0
        }
        return e + Oa(a, b, c || (g ? "border" : "content"), d, f) + "px"
    }

    function Qa(a, b) {
        for (var c, d, e, f = [], g = 0, h = a.length; h > g; g++) d = a[g], d.style && (f[g] = N.get(d, "olddisplay"), c = d.style.display, b ? (f[g] || "none" !== c || (d.style.display = ""), "" === d.style.display && V(d) && (f[g] = N.access(d, "olddisplay", za(d.nodeName)))) : (e = V(d), "none" === c && e || N.set(d, "olddisplay", e ? c : n.css(d, "display"))));
        for (g = 0; h > g; g++) d = a[g], d.style && (b && "none" !== d.style.display && "" !== d.style.display || (d.style.display = b ? f[g] || "" : "none"));
        return a
    }

    function Ra(a, b, c, d, e) {
        return new Ra.prototype.init(a, b, c, d, e)
    }

    function Wa() {
        return a.setTimeout(function() {
            Sa = void 0
        }), Sa = n.now()
    }

    function Xa(a, b) {
        var c, d = 0,
            e = { height: a };
        for (b = b ? 1 : 0; 4 > d; d += 2 - b) c = U[d], e["margin" + c] = e["padding" + c] = a;
        return b && (e.opacity = e.width = a), e
    }

    function Ya(a, b, c) {
        for (var d, e = (_a.tweeners[b] || []).concat(_a.tweeners["*"]), f = 0, g = e.length; g > f; f++)
            if (d = e[f].call(c, b, a)) return d
    }

    function Za(a, b, c) {
        var d, e, f, g, h, i, j, l = this,
            m = {},
            o = a.style,
            p = a.nodeType && V(a),
            q = N.get(a, "fxshow");
        c.queue || (h = n._queueHooks(a, "fx"), null == h.unqueued && (h.unqueued = 0, i = h.empty.fire, h.empty.fire = function() {
            h.unqueued || i()
        }), h.unqueued++, l.always(function() {
            l.always(function() {
                h.unqueued--, n.queue(a, "fx").length || h.empty.fire()
            })
        })), 1 === a.nodeType && ("height" in b || "width" in b) && (c.overflow = [o.overflow, o.overflowX, o.overflowY], j = n.css(a, "display"), "inline" === ("none" === j ? N.get(a, "olddisplay") || za(a.nodeName) : j) && "none" === n.css(a, "float") && (o.display = "inline-block")), c.overflow && (o.overflow = "hidden", l.always(function() {
            o.overflow = c.overflow[0], o.overflowX = c.overflow[1], o.overflowY = c.overflow[2]
        }));
        for (d in b)
            if (e = b[d], Ua.exec(e)) {
                if (delete b[d], f = f || "toggle" === e, e === (p ? "hide" : "show")) {
                    if ("show" !== e || !q || void 0 === q[d]) continue;
                    p = !0
                }
                m[d] = q && q[d] || n.style(a, d)
            } else j = void 0;
        if (n.isEmptyObject(m)) "inline" === ("none" === j ? za(a.nodeName) : j) && (o.display = j);
        else {
            q ? "hidden" in q && (p = q.hidden) : q = N.access(a, "fxshow", {}), f && (q.hidden = !p), p ? n(a).show() : l.done(function() {
                n(a).hide()
            }), l.done(function() {
                var b;
                N.remove(a, "fxshow");
                for (b in m) n.style(a, b, m[b])
            });
            for (d in m) g = Ya(p ? q[d] : 0, d, l), d in q || (q[d] = g.start, p && (g.end = g.start, g.start = "width" === d || "height" === d ? 1 : 0))
        }
    }

    function $a(a, b) {
        var c, d, e, f, g;
        for (c in a)
            if (d = n.camelCase(c), e = b[d], f = a[c], n.isArray(f) && (e = f[1], f = a[c] = f[0]), c !== d && (a[d] = f, delete a[c]), (g = n.cssHooks[d]) && "expand" in g) {
                f = g.expand(f), delete a[d];
                for (c in f) c in a || (a[c] = f[c], b[c] = e)
            } else b[d] = e
    }

    function _a(a, b, c) {
        var d, e, f = 0,
            g = _a.prefilters.length,
            h = n.Deferred().always(function() {
                delete i.elem
            }),
            i = function() {
                if (e) return !1;
                for (var b = Sa || Wa(), c = Math.max(0, j.startTime + j.duration - b), d = c / j.duration || 0, f = 1 - d, g = 0, i = j.tweens.length; i > g; g++) j.tweens[g].run(f);
                return h.notifyWith(a, [j, f, c]), 1 > f && i ? c : (h.resolveWith(a, [j]), !1)
            },
            j = h.promise({
                elem: a,
                props: n.extend({}, b),
                opts: n.extend(!0, { specialEasing: {}, easing: n.easing._default }, c),
                originalProperties: b,
                originalOptions: c,
                startTime: Sa || Wa(),
                duration: c.duration,
                tweens: [],
                createTween: function(b, c) {
                    var d = n.Tween(a, j.opts, b, c, j.opts.specialEasing[b] || j.opts.easing);
                    return j.tweens.push(d), d
                },
                stop: function(b) {
                    var c = 0,
                        d = b ? j.tweens.length : 0;
                    if (e) return this;
                    for (e = !0; d > c; c++) j.tweens[c].run(1);
                    return b ? (h.notifyWith(a, [j, 1, 0]), h.resolveWith(a, [j, b])) : h.rejectWith(a, [j, b]), this
                }
            }),
            k = j.props;
        for ($a(k, j.opts.specialEasing); g > f; f++)
            if (d = _a.prefilters[f].call(j, a, k, j.opts)) return n.isFunction(d.stop) && (n._queueHooks(j.elem, j.opts.queue).stop = n.proxy(d.stop, d)), d;
        return n.map(k, Ya, j), n.isFunction(j.opts.start) && j.opts.start.call(a, j), n.fx.timer(n.extend(i, {
            elem: a,
            anim: j,
            queue: j.opts.queue
        })), j.progress(j.opts.progress).done(j.opts.done, j.opts.complete).fail(j.opts.fail).always(j.opts.always)
    }

    function fb(a) {
        return a.getAttribute && a.getAttribute("class") || ""
    }

    function wb(a) {
        return function(b, c) {
            "string" != typeof b && (c = b, b = "*");
            var d, e = 0,
                f = b.toLowerCase().match(G) || [];
            if (n.isFunction(c))
                for (; d = f[e++];) "+" === d[0] ? (d = d.slice(1) || "*", (a[d] = a[d] || []).unshift(c)) : (a[d] = a[d] || []).push(c)
        }
    }

    function xb(a, b, c, d) {
        function g(h) {
            var i;
            return e[h] = !0, n.each(a[h] || [], function(a, h) {
                var j = h(b, c, d);
                return "string" != typeof j || f || e[j] ? f ? !(i = j) : void 0 : (b.dataTypes.unshift(j), g(j), !1)
            }), i
        }

        var e = {},
            f = a === tb;
        return g(b.dataTypes[0]) || !e["*"] && g("*")
    }

    function yb(a, b) {
        var c, d, e = n.ajaxSettings.flatOptions || {};
        for (c in b) void 0 !== b[c] && ((e[c] ? a : d || (d = {}))[c] = b[c]);
        return d && n.extend(!0, a, d), a
    }

    function zb(a, b, c) {
        for (var d, e, f, g, h = a.contents, i = a.dataTypes;
            "*" === i[0];) i.shift(), void 0 === d && (d = a.mimeType || b.getResponseHeader("Content-Type"));
        if (d)
            for (e in h)
                if (h[e] && h[e].test(d)) {
                    i.unshift(e);
                    break
                }
        if (i[0] in c) f = i[0];
        else {
            for (e in c) {
                if (!i[0] || a.converters[e + " " + i[0]]) {
                    f = e;
                    break
                }
                g || (g = e)
            }
            f = f || g
        }
        return f ? (f !== i[0] && i.unshift(f), c[f]) : void 0
    }

    function Ab(a, b, c, d) {
        var e, f, g, h, i, j = {},
            k = a.dataTypes.slice();
        if (k[1])
            for (g in a.converters) j[g.toLowerCase()] = a.converters[g];
        for (f = k.shift(); f;)
            if (a.responseFields[f] && (c[a.responseFields[f]] = b), !i && d && a.dataFilter && (b = a.dataFilter(b, a.dataType)), i = f, f = k.shift())
                if ("*" === f) f = i;
                else if ("*" !== i && i !== f) {
            if (!(g = j[i + " " + f] || j["* " + f]))
                for (e in j)
                    if (h = e.split(" "), h[1] === f && (g = j[i + " " + h[0]] || j["* " + h[0]])) {
                        !0 === g ? g = j[e] : !0 !== j[e] && (f = h[0], k.unshift(h[1]));
                        break
                    }
            if (!0 !== g)
                if (g && a.throws) b = g(b);
                else try {
                    b = g(b)
                } catch (l) {
                    return { state: "parsererror", error: g ? l : "No conversion from " + i + " to " + f }
                }
        }
        return { state: "success", data: b }
    }

    function Gb(a, b, c, d) {
        var e;
        if (n.isArray(b)) n.each(b, function(b, e) {
            c || Cb.test(a) ? d(a, e) : Gb(a + "[" + ("object" == typeof e && null != e ? b : "") + "]", e, c, d)
        });
        else if (c || "object" !== n.type(b)) d(a, b);
        else
            for (e in b) Gb(a + "[" + e + "]", b[e], c, d)
    }

    function Mb(a) {
        return n.isWindow(a) ? a : 9 === a.nodeType && a.defaultView
    }

    var c = [],
        d = a.document,
        e = c.slice,
        f = c.concat,
        g = c.push,
        h = c.indexOf,
        i = {},
        j = i.toString,
        k = i.hasOwnProperty,
        l = {},
        m = "2.2.4",
        n = function(a, b) {
            return new n.fn.init(a, b)
        },
        o = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        p = /^-ms-/,
        q = /-([\da-z])/gi,
        r = function(a, b) {
            return b.toUpperCase()
        };
    n.fn = n.prototype = {
        jquery: m,
        constructor: n,
        selector: "",
        length: 0,
        toArray: function() {
            return e.call(this)
        },
        get: function(a) {
            return null != a ? 0 > a ? this[a + this.length] : this[a] : e.call(this)
        },
        pushStack: function(a) {
            var b = n.merge(this.constructor(), a);
            return b.prevObject = this, b.context = this.context, b
        },
        each: function(a) {
            return n.each(this, a)
        },
        map: function(a) {
            return this.pushStack(n.map(this, function(b, c) {
                return a.call(b, c, b)
            }))
        },
        slice: function() {
            return this.pushStack(e.apply(this, arguments))
        },
        first: function() {
            return this.eq(0)
        },
        last: function() {
            return this.eq(-1)
        },
        eq: function(a) {
            var b = this.length,
                c = +a + (0 > a ? b : 0);
            return this.pushStack(c >= 0 && b > c ? [this[c]] : [])
        },
        end: function() {
            return this.prevObject || this.constructor()
        },
        push: g,
        sort: c.sort,
        splice: c.splice
    }, n.extend = n.fn.extend = function() {
        var a, b, c, d, e, f, g = arguments[0] || {},
            h = 1,
            i = arguments.length,
            j = !1;
        for ("boolean" == typeof g && (j = g, g = arguments[h] || {}, h++), "object" == typeof g || n.isFunction(g) || (g = {}), h === i && (g = this, h--); i > h; h++)
            if (null != (a = arguments[h]))
                for (b in a) c = g[b], d = a[b], g !== d && (j && d && (n.isPlainObject(d) || (e = n.isArray(d))) ? (e ? (e = !1, f = c && n.isArray(c) ? c : []) : f = c && n.isPlainObject(c) ? c : {}, g[b] = n.extend(j, f, d)) : void 0 !== d && (g[b] = d));
        return g
    }, n.extend({
        expando: "jQuery" + (m + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(a) {
            throw new Error(a)
        },
        noop: function() {},
        isFunction: function(a) {
            return "function" === n.type(a)
        },
        isArray: Array.isArray,
        isWindow: function(a) {
            return null != a && a === a.window
        },
        isNumeric: function(a) {
            var b = a && a.toString();
            return !n.isArray(a) && b - parseFloat(b) + 1 >= 0
        },
        isPlainObject: function(a) {
            var b;
            if ("object" !== n.type(a) || a.nodeType || n.isWindow(a)) return !1;
            if (a.constructor && !k.call(a, "constructor") && !k.call(a.constructor.prototype || {}, "isPrototypeOf")) return !1;
            for (b in a);
            return void 0 === b || k.call(a, b)
        },
        isEmptyObject: function(a) {
            var b;
            for (b in a) return !1;
            return !0
        },
        type: function(a) {
            return null == a ? a + "" : "object" == typeof a || "function" == typeof a ? i[j.call(a)] || "object" : typeof a
        },
        globalEval: function(a) {
            var b, c = eval;
            (a = n.trim(a)) && (1 === a.indexOf("use strict") ? (b = d.createElement("script"), b.text = a, d.head.appendChild(b).parentNode.removeChild(b)) : c(a))
        },
        camelCase: function(a) {
            return a.replace(p, "ms-").replace(q, r)
        },
        nodeName: function(a, b) {
            return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase()
        },
        each: function(a, b) {
            var c, d = 0;
            if (s(a))
                for (c = a.length; c > d && !1 !== b.call(a[d], d, a[d]); d++);
            else
                for (d in a)
                    if (!1 === b.call(a[d], d, a[d])) break;
            return a
        },
        trim: function(a) {
            return null == a ? "" : (a + "").replace(o, "")
        },
        makeArray: function(a, b) {
            var c = b || [];
            return null != a && (s(Object(a)) ? n.merge(c, "string" == typeof a ? [a] : a) : g.call(c, a)), c
        },
        inArray: function(a, b, c) {
            return null == b ? -1 : h.call(b, a, c)
        },
        merge: function(a, b) {
            for (var c = +b.length, d = 0, e = a.length; c > d; d++) a[e++] = b[d];
            return a.length = e, a
        },
        grep: function(a, b, c) {
            for (var e = [], f = 0, g = a.length, h = !c; g > f; f++) !b(a[f], f) !== h && e.push(a[f]);
            return e
        },
        map: function(a, b, c) {
            var d, e, g = 0,
                h = [];
            if (s(a))
                for (d = a.length; d > g; g++) null != (e = b(a[g], g, c)) && h.push(e);
            else
                for (g in a) null != (e = b(a[g], g, c)) && h.push(e);
            return f.apply([], h)
        },
        guid: 1,
        proxy: function(a, b) {
            var c, d, f;
            return "string" == typeof b && (c = a[b], b = a, a = c), n.isFunction(a) ? (d = e.call(arguments, 2), f = function() {
                return a.apply(b || this, d.concat(e.call(arguments)))
            }, f.guid = a.guid = a.guid || n.guid++, f) : void 0
        },
        now: Date.now,
        support: l
    }), "function" == typeof Symbol && (n.fn[Symbol.iterator] = c[Symbol.iterator]), n.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function(a, b) {
        i["[object " + b + "]"] = b.toLowerCase()
    });
    var t = function(a) {
        function fa(a, b, d, e) {
            var f, h, j, k, l, o, r, s, w = b && b.ownerDocument,
                x = b ? b.nodeType : 9;
            if (d = d || [], "string" != typeof a || !a || 1 !== x && 9 !== x && 11 !== x) return d;
            if (!e && ((b ? b.ownerDocument || b : v) !== n && m(b), b = b || n, p)) {
                if (11 !== x && (o = $.exec(a)))
                    if (f = o[1]) {
                        if (9 === x) {
                            if (!(j = b.getElementById(f))) return d;
                            if (j.id === f) return d.push(j), d
                        } else if (w && (j = w.getElementById(f)) && t(b, j) && j.id === f) return d.push(j), d
                    } else {
                        if (o[2]) return H.apply(d, b.getElementsByTagName(a)), d;
                        if ((f = o[3]) && c.getElementsByClassName && b.getElementsByClassName) return H.apply(d, b.getElementsByClassName(f)), d
                    }
                if (c.qsa && !A[a + " "] && (!q || !q.test(a))) {
                    if (1 !== x) w = b, s = a;
                    else if ("object" !== b.nodeName.toLowerCase()) {
                        for ((k = b.getAttribute("id")) ? k = k.replace(aa, "\\$&") : b.setAttribute("id", k = u), r = g(a), h = r.length, l = V.test(k) ? "#" + k : "[id='" + k + "']"; h--;) r[h] = l + " " + qa(r[h]);
                        s = r.join(","), w = _.test(a) && oa(b.parentNode) || b
                    }
                    if (s) try {
                        return H.apply(d, w.querySelectorAll(s)), d
                    } catch (y) {} finally {
                        k === u && b.removeAttribute("id")
                    }
                }
            }
            return i(a.replace(Q, "$1"), b, d, e)
        }

        function ga() {
            function b(c, e) {
                return a.push(c + " ") > d.cacheLength && delete b[a.shift()], b[c + " "] = e
            }

            var a = [];
            return b
        }

        function ha(a) {
            return a[u] = !0, a
        }

        function ia(a) {
            var b = n.createElement("div");
            try {
                return !!a(b)
            } catch (c) {
                return !1
            } finally {
                b.parentNode && b.parentNode.removeChild(b), b = null
            }
        }

        function ja(a, b) {
            for (var c = a.split("|"), e = c.length; e--;) d.attrHandle[c[e]] = b
        }

        function ka(a, b) {
            var c = b && a,
                d = c && 1 === a.nodeType && 1 === b.nodeType && (~b.sourceIndex || C) - (~a.sourceIndex || C);
            if (d) return d;
            if (c)
                for (; c = c.nextSibling;)
                    if (c === b) return -1;
            return a ? 1 : -1
        }

        function na(a) {
            return ha(function(b) {
                return b = +b, ha(function(c, d) {
                    for (var e, f = a([], c.length, b), g = f.length; g--;) c[e = f[g]] && (c[e] = !(d[e] = c[e]))
                })
            })
        }

        function oa(a) {
            return a && void 0 !== a.getElementsByTagName && a
        }

        function pa() {}

        function qa(a) {
            for (var b = 0, c = a.length, d = ""; c > b; b++) d += a[b].value;
            return d
        }

        function ra(a, b, c) {
            var d = b.dir,
                e = c && "parentNode" === d,
                f = x++;
            return b.first ? function(b, c, f) {
                for (; b = b[d];)
                    if (1 === b.nodeType || e) return a(b, c, f)
            } : function(b, c, g) {
                var h, i, j, k = [w, f];
                if (g) {
                    for (; b = b[d];)
                        if ((1 === b.nodeType || e) && a(b, c, g)) return !0
                } else
                    for (; b = b[d];)
                        if (1 === b.nodeType || e) {
                            if (j = b[u] || (b[u] = {}), i = j[b.uniqueID] || (j[b.uniqueID] = {}), (h = i[d]) && h[0] === w && h[1] === f) return k[2] = h[2];
                            if (i[d] = k, k[2] = a(b, c, g)) return !0
                        }
            }
        }

        function sa(a) {
            return a.length > 1 ? function(b, c, d) {
                for (var e = a.length; e--;)
                    if (!a[e](b, c, d)) return !1;
                return !0
            } : a[0]
        }

        function ta(a, b, c) {
            for (var d = 0, e = b.length; e > d; d++) fa(a, b[d], c);
            return c
        }

        function ua(a, b, c, d, e) {
            for (var f, g = [], h = 0, i = a.length, j = null != b; i > h; h++)(f = a[h]) && (c && !c(f, d, e) || (g.push(f), j && b.push(h)));
            return g
        }

        function va(a, b, c, d, e, f) {
            return d && !d[u] && (d = va(d)), e && !e[u] && (e = va(e, f)), ha(function(f, g, h, i) {
                var j, k, l, m = [],
                    n = [],
                    o = g.length,
                    p = f || ta(b || "*", h.nodeType ? [h] : h, []),
                    q = !a || !f && b ? p : ua(p, m, a, h, i),
                    r = c ? e || (f ? a : o || d) ? [] : g : q;
                if (c && c(q, r, h, i), d)
                    for (j = ua(r, n), d(j, [], h, i), k = j.length; k--;)(l = j[k]) && (r[n[k]] = !(q[n[k]] = l));
                if (f) {
                    if (e || a) {
                        if (e) {
                            for (j = [], k = r.length; k--;)(l = r[k]) && j.push(q[k] = l);
                            e(null, r = [], j, i)
                        }
                        for (k = r.length; k--;)(l = r[k]) && (j = e ? J(f, l) : m[k]) > -1 && (f[j] = !(g[j] = l))
                    }
                } else r = ua(r === g ? r.splice(o, r.length) : r), e ? e(null, g, r, i) : H.apply(g, r)
            })
        }

        function wa(a) {
            for (var b, c, e, f = a.length, g = d.relative[a[0].type], h = g || d.relative[" "], i = g ? 1 : 0, k = ra(function(a) {
                    return a === b
                }, h, !0), l = ra(function(a) {
                    return J(b, a) > -1
                }, h, !0), m = [function(a, c, d) {
                    var e = !g && (d || c !== j) || ((b = c).nodeType ? k(a, c, d) : l(a, c, d));
                    return b = null, e
                }]; f > i; i++)
                if (c = d.relative[a[i].type]) m = [ra(sa(m), c)];
                else {
                    if (c = d.filter[a[i].type].apply(null, a[i].matches), c[u]) {
                        for (e = ++i; f > e && !d.relative[a[e].type]; e++);
                        return va(i > 1 && sa(m), i > 1 && qa(a.slice(0, i - 1).concat({ value: " " === a[i - 2].type ? "*" : "" })).replace(Q, "$1"), c, e > i && wa(a.slice(i, e)), f > e && wa(a = a.slice(e)), f > e && qa(a))
                    }
                    m.push(c)
                }
            return sa(m)
        }

        function xa(a, b) {
            var c = b.length > 0,
                e = a.length > 0,
                f = function(f, g, h, i, k) {
                    var l, o, q, r = 0,
                        s = "0",
                        t = f && [],
                        u = [],
                        v = j,
                        x = f || e && d.find.TAG("*", k),
                        y = w += null == v ? 1 : Math.random() || .1,
                        z = x.length;
                    for (k && (j = g === n || g || k); s !== z && null != (l = x[s]); s++) {
                        if (e && l) {
                            for (o = 0, g || l.ownerDocument === n || (m(l), h = !p); q = a[o++];)
                                if (q(l, g || n, h)) {
                                    i.push(l);
                                    break
                                }
                            k && (w = y)
                        }
                        c && ((l = !q && l) && r--, f && t.push(l))
                    }
                    if (r += s, c && s !== r) {
                        for (o = 0; q = b[o++];) q(t, u, g, h);
                        if (f) {
                            if (r > 0)
                                for (; s--;) t[s] || u[s] || (u[s] = F.call(i));
                            u = ua(u)
                        }
                        H.apply(i, u), k && !f && u.length > 0 && r + b.length > 1 && fa.uniqueSort(i)
                    }
                    return k && (w = y, j = v), t
                };
            return c ? ha(f) : f
        }

        var b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u = "sizzle" + 1 * new Date,
            v = a.document,
            w = 0,
            x = 0,
            y = ga(),
            z = ga(),
            A = ga(),
            B = function(a, b) {
                return a === b && (l = !0), 0
            },
            C = 1 << 31,
            D = {}.hasOwnProperty,
            E = [],
            F = E.pop,
            G = E.push,
            H = E.push,
            I = E.slice,
            J = function(a, b) {
                for (var c = 0, d = a.length; d > c; c++)
                    if (a[c] === b) return c;
                return -1
            },
            K = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            L = "[\\x20\\t\\r\\n\\f]",
            M = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
            N = "\\[" + L + "*(" + M + ")(?:" + L + "*([*^$|!~]?=)" + L + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + M + "))|)" + L + "*\\]",
            O = ":(" + M + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + N + ")*)|.*)\\)|)",
            P = new RegExp(L + "+", "g"),
            Q = new RegExp("^" + L + "+|((?:^|[^\\\\])(?:\\\\.)*)" + L + "+$", "g"),
            R = new RegExp("^" + L + "*," + L + "*"),
            S = new RegExp("^" + L + "*([>+~]|" + L + ")" + L + "*"),
            T = new RegExp("=" + L + "*([^\\]'\"]*?)" + L + "*\\]", "g"),
            U = new RegExp(O),
            V = new RegExp("^" + M + "$"),
            W = {
                ID: new RegExp("^#(" + M + ")"),
                CLASS: new RegExp("^\\.(" + M + ")"),
                TAG: new RegExp("^(" + M + "|[*])"),
                ATTR: new RegExp("^" + N),
                PSEUDO: new RegExp("^" + O),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + L + "*(even|odd|(([+-]|)(\\d*)n|)" + L + "*(?:([+-]|)" + L + "*(\\d+)|))" + L + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + K + ")$", "i"),
                needsContext: new RegExp("^" + L + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + L + "*((?:-\\d)?\\d*)" + L + "*\\)|)(?=[^-]|$)", "i")
            },
            X = /^(?:input|select|textarea|button)$/i,
            Y = /^h\d$/i,
            Z = /^[^{]+\{\s*\[native \w/,
            $ = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            _ = /[+~]/,
            aa = /'|\\/g,
            ba = new RegExp("\\\\([\\da-f]{1,6}" + L + "?|(" + L + ")|.)", "ig"),
            ca = function(a, b, c) {
                var d = "0x" + b - 65536;
                return d !== d || c ? b : 0 > d ? String.fromCharCode(d + 65536) : String.fromCharCode(d >> 10 | 55296, 1023 & d | 56320)
            },
            da = function() {
                m()
            };
        try {
            H.apply(E = I.call(v.childNodes), v.childNodes), E[v.childNodes.length].nodeType
        } catch (ea) {
            H = {
                apply: E.length ? function(a, b) {
                    G.apply(a, I.call(b))
                } : function(a, b) {
                    for (var c = a.length, d = 0; a[c++] = b[d++];);
                    a.length = c - 1
                }
            }
        }
        c = fa.support = {}, f = fa.isXML = function(a) {
            var b = a && (a.ownerDocument || a).documentElement;
            return !!b && "HTML" !== b.nodeName
        }, m = fa.setDocument = function(a) {
            var b, e, g = a ? a.ownerDocument || a : v;
            return g !== n && 9 === g.nodeType && g.documentElement ? (n = g, o = n.documentElement, p = !f(n), (e = n.defaultView) && e.top !== e && (e.addEventListener ? e.addEventListener("unload", da, !1) : e.attachEvent && e.attachEvent("onunload", da)), c.attributes = ia(function(a) {
                return a.className = "i", !a.getAttribute("className")
            }), c.getElementsByTagName = ia(function(a) {
                return a.appendChild(n.createComment("")), !a.getElementsByTagName("*").length
            }), c.getElementsByClassName = Z.test(n.getElementsByClassName), c.getById = ia(function(a) {
                return o.appendChild(a).id = u, !n.getElementsByName || !n.getElementsByName(u).length
            }), c.getById ? (d.find.ID = function(a, b) {
                if (void 0 !== b.getElementById && p) {
                    var c = b.getElementById(a);
                    return c ? [c] : []
                }
            }, d.filter.ID = function(a) {
                var b = a.replace(ba, ca);
                return function(a) {
                    return a.getAttribute("id") === b
                }
            }) : (delete d.find.ID, d.filter.ID = function(a) {
                var b = a.replace(ba, ca);
                return function(a) {
                    var c = void 0 !== a.getAttributeNode && a.getAttributeNode("id");
                    return c && c.value === b
                }
            }), d.find.TAG = c.getElementsByTagName ? function(a, b) {
                return void 0 !== b.getElementsByTagName ? b.getElementsByTagName(a) : c.qsa ? b.querySelectorAll(a) : void 0
            } : function(a, b) {
                var c, d = [],
                    e = 0,
                    f = b.getElementsByTagName(a);
                if ("*" === a) {
                    for (; c = f[e++];) 1 === c.nodeType && d.push(c);
                    return d
                }
                return f
            }, d.find.CLASS = c.getElementsByClassName && function(a, b) {
                return void 0 !== b.getElementsByClassName && p ? b.getElementsByClassName(a) : void 0
            }, r = [], q = [], (c.qsa = Z.test(n.querySelectorAll)) && (ia(function(a) {
                o.appendChild(a).innerHTML = "<a id='" + u + "'></a><select id='" + u + "-\r\\' msallowcapture=''><option selected=''></option></select>", a.querySelectorAll("[msallowcapture^='']").length && q.push("[*^$]=" + L + "*(?:''|\"\")"), a.querySelectorAll("[selected]").length || q.push("\\[" + L + "*(?:value|" + K + ")"), a.querySelectorAll("[id~=" + u + "-]").length || q.push("~="), a.querySelectorAll(":checked").length || q.push(":checked"), a.querySelectorAll("a#" + u + "+*").length || q.push(".#.+[+~]")
            }), ia(function(a) {
                var b = n.createElement("input");
                b.setAttribute("type", "hidden"), a.appendChild(b).setAttribute("name", "D"), a.querySelectorAll("[name=d]").length && q.push("name" + L + "*[*^$|!~]?="), a.querySelectorAll(":enabled").length || q.push(":enabled", ":disabled"), a.querySelectorAll("*,:x"), q.push(",.*:")
            })), (c.matchesSelector = Z.test(s = o.matches || o.webkitMatchesSelector || o.mozMatchesSelector || o.oMatchesSelector || o.msMatchesSelector)) && ia(function(a) {
                c.disconnectedMatch = s.call(a, "div"), s.call(a, "[s!='']:x"), r.push("!=", O)
            }), q = q.length && new RegExp(q.join("|")), r = r.length && new RegExp(r.join("|")), b = Z.test(o.compareDocumentPosition), t = b || Z.test(o.contains) ? function(a, b) {
                var c = 9 === a.nodeType ? a.documentElement : a,
                    d = b && b.parentNode;
                return a === d || !(!d || 1 !== d.nodeType || !(c.contains ? c.contains(d) : a.compareDocumentPosition && 16 & a.compareDocumentPosition(d)))
            } : function(a, b) {
                if (b)
                    for (; b = b.parentNode;)
                        if (b === a) return !0;
                return !1
            }, B = b ? function(a, b) {
                if (a === b) return l = !0, 0;
                var d = !a.compareDocumentPosition - !b.compareDocumentPosition;
                return d || (d = (a.ownerDocument || a) === (b.ownerDocument || b) ? a.compareDocumentPosition(b) : 1, 1 & d || !c.sortDetached && b.compareDocumentPosition(a) === d ? a === n || a.ownerDocument === v && t(v, a) ? -1 : b === n || b.ownerDocument === v && t(v, b) ? 1 : k ? J(k, a) - J(k, b) : 0 : 4 & d ? -1 : 1)
            } : function(a, b) {
                if (a === b) return l = !0, 0;
                var c, d = 0,
                    e = a.parentNode,
                    f = b.parentNode,
                    g = [a],
                    h = [b];
                if (!e || !f) return a === n ? -1 : b === n ? 1 : e ? -1 : f ? 1 : k ? J(k, a) - J(k, b) : 0;
                if (e === f) return ka(a, b);
                for (c = a; c = c.parentNode;) g.unshift(c);
                for (c = b; c = c.parentNode;) h.unshift(c);
                for (; g[d] === h[d];) d++;
                return d ? ka(g[d], h[d]) : g[d] === v ? -1 : h[d] === v ? 1 : 0
            }, n) : n
        }, fa.matches = function(a, b) {
            return fa(a, null, null, b)
        }, fa.matchesSelector = function(a, b) {
            if ((a.ownerDocument || a) !== n && m(a), b = b.replace(T, "='$1']"), c.matchesSelector && p && !A[b + " "] && (!r || !r.test(b)) && (!q || !q.test(b))) try {
                var d = s.call(a, b);
                if (d || c.disconnectedMatch || a.document && 11 !== a.document.nodeType) return d
            } catch (e) {}
            return fa(b, n, null, [a]).length > 0
        }, fa.contains = function(a, b) {
            return (a.ownerDocument || a) !== n && m(a), t(a, b)
        }, fa.attr = function(a, b) {
            (a.ownerDocument || a) !== n && m(a);
            var e = d.attrHandle[b.toLowerCase()],
                f = e && D.call(d.attrHandle, b.toLowerCase()) ? e(a, b, !p) : void 0;
            return void 0 !== f ? f : c.attributes || !p ? a.getAttribute(b) : (f = a.getAttributeNode(b)) && f.specified ? f.value : null
        }, fa.error = function(a) {
            throw new Error("Syntax error, unrecognized expression: " + a)
        }, fa.uniqueSort = function(a) {
            var b, d = [],
                e = 0,
                f = 0;
            if (l = !c.detectDuplicates, k = !c.sortStable && a.slice(0), a.sort(B), l) {
                for (; b = a[f++];) b === a[f] && (e = d.push(f));
                for (; e--;) a.splice(d[e], 1)
            }
            return k = null, a
        }, e = fa.getText = function(a) {
            var b, c = "",
                d = 0,
                f = a.nodeType;
            if (f) {
                if (1 === f || 9 === f || 11 === f) {
                    if ("string" == typeof a.textContent) return a.textContent;
                    for (a = a.firstChild; a; a = a.nextSibling) c += e(a)
                } else if (3 === f || 4 === f) return a.nodeValue
            } else
                for (; b = a[d++];) c += e(b);
            return c
        }, d = fa.selectors = {
            cacheLength: 50,
            createPseudo: ha,
            match: W,
            attrHandle: {},
            find: {},
            relative: {
                ">": { dir: "parentNode", first: !0 },
                " ": { dir: "parentNode" },
                "+": { dir: "previousSibling", first: !0 },
                "~": { dir: "previousSibling" }
            },
            preFilter: {
                ATTR: function(a) {
                    return a[1] = a[1].replace(ba, ca), a[3] = (a[3] || a[4] || a[5] || "").replace(ba, ca), "~=" === a[2] && (a[3] = " " + a[3] + " "), a.slice(0, 4)
                },
                CHILD: function(a) {
                    return a[1] = a[1].toLowerCase(), "nth" === a[1].slice(0, 3) ? (a[3] || fa.error(a[0]), a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && fa.error(a[0]), a
                },
                PSEUDO: function(a) {
                    var b, c = !a[6] && a[2];
                    return W.CHILD.test(a[0]) ? null : (a[3] ? a[2] = a[4] || a[5] || "" : c && U.test(c) && (b = g(c, !0)) && (b = c.indexOf(")", c.length - b) - c.length) && (a[0] = a[0].slice(0, b), a[2] = c.slice(0, b)), a.slice(0, 3))
                }
            },
            filter: {
                TAG: function(a) {
                    var b = a.replace(ba, ca).toLowerCase();
                    return "*" === a ? function() {
                        return !0
                    } : function(a) {
                        return a.nodeName && a.nodeName.toLowerCase() === b
                    }
                },
                CLASS: function(a) {
                    var b = y[a + " "];
                    return b || (b = new RegExp("(^|" + L + ")" + a + "(" + L + "|$)")) && y(a, function(a) {
                        return b.test("string" == typeof a.className && a.className || void 0 !== a.getAttribute && a.getAttribute("class") || "")
                    })
                },
                ATTR: function(a, b, c) {
                    return function(d) {
                        var e = fa.attr(d, a);
                        return null == e ? "!=" === b : !b || (e += "", "=" === b ? e === c : "!=" === b ? e !== c : "^=" === b ? c && 0 === e.indexOf(c) : "*=" === b ? c && e.indexOf(c) > -1 : "$=" === b ? c && e.slice(-c.length) === c : "~=" === b ? (" " + e.replace(P, " ") + " ").indexOf(c) > -1 : "|=" === b && (e === c || e.slice(0, c.length + 1) === c + "-"))
                    }
                },
                CHILD: function(a, b, c, d, e) {
                    var f = "nth" !== a.slice(0, 3),
                        g = "last" !== a.slice(-4),
                        h = "of-type" === b;
                    return 1 === d && 0 === e ? function(a) {
                        return !!a.parentNode
                    } : function(b, c, i) {
                        var j, k, l, m, n, o, p = f !== g ? "nextSibling" : "previousSibling",
                            q = b.parentNode,
                            r = h && b.nodeName.toLowerCase(),
                            s = !i && !h,
                            t = !1;
                        if (q) {
                            if (f) {
                                for (; p;) {
                                    for (m = b; m = m[p];)
                                        if (h ? m.nodeName.toLowerCase() === r : 1 === m.nodeType) return !1;
                                    o = p = "only" === a && !o && "nextSibling"
                                }
                                return !0
                            }
                            if (o = [g ? q.firstChild : q.lastChild], g && s) {
                                for (m = q, l = m[u] || (m[u] = {}), k = l[m.uniqueID] || (l[m.uniqueID] = {}), j = k[a] || [], n = j[0] === w && j[1], t = n && j[2], m = n && q.childNodes[n]; m = ++n && m && m[p] || (t = n = 0) || o.pop();)
                                    if (1 === m.nodeType && ++t && m === b) {
                                        k[a] = [w, n, t];
                                        break
                                    }
                            } else if (s && (m = b, l = m[u] || (m[u] = {}), k = l[m.uniqueID] || (l[m.uniqueID] = {}), j = k[a] || [], n = j[0] === w && j[1], t = n), !1 === t)
                                for (;
                                    (m = ++n && m && m[p] || (t = n = 0) || o.pop()) && ((h ? m.nodeName.toLowerCase() !== r : 1 !== m.nodeType) || !++t || (s && (l = m[u] || (m[u] = {}), k = l[m.uniqueID] || (l[m.uniqueID] = {}), k[a] = [w, t]), m !== b)););
                            return (t -= e) === d || t % d == 0 && t / d >= 0
                        }
                    }
                },
                PSEUDO: function(a, b) {
                    var c, e = d.pseudos[a] || d.setFilters[a.toLowerCase()] || fa.error("unsupported pseudo: " + a);
                    return e[u] ? e(b) : e.length > 1 ? (c = [a, a, "", b], d.setFilters.hasOwnProperty(a.toLowerCase()) ? ha(function(a, c) {
                        for (var d, f = e(a, b), g = f.length; g--;) d = J(a, f[g]), a[d] = !(c[d] = f[g])
                    }) : function(a) {
                        return e(a, 0, c)
                    }) : e
                }
            },
            pseudos: {
                not: ha(function(a) {
                    var b = [],
                        c = [],
                        d = h(a.replace(Q, "$1"));
                    return d[u] ? ha(function(a, b, c, e) {
                        for (var f, g = d(a, null, e, []), h = a.length; h--;)(f = g[h]) && (a[h] = !(b[h] = f))
                    }) : function(a, e, f) {
                        return b[0] = a, d(b, null, f, c), b[0] = null, !c.pop()
                    }
                }),
                has: ha(function(a) {
                    return function(b) {
                        return fa(a, b).length > 0
                    }
                }),
                contains: ha(function(a) {
                    return a = a.replace(ba, ca),
                        function(b) {
                            return (b.textContent || b.innerText || e(b)).indexOf(a) > -1
                        }
                }),
                lang: ha(function(a) {
                    return V.test(a || "") || fa.error("unsupported lang: " + a), a = a.replace(ba, ca).toLowerCase(),
                        function(b) {
                            var c;
                            do {
                                if (c = p ? b.lang : b.getAttribute("xml:lang") || b.getAttribute("lang")) return (c = c.toLowerCase()) === a || 0 === c.indexOf(a + "-")
                            } while ((b = b.parentNode) && 1 === b.nodeType);
                            return !1
                        }
                }),
                target: function(b) {
                    var c = a.location && a.location.hash;
                    return c && c.slice(1) === b.id
                },
                root: function(a) {
                    return a === o
                },
                focus: function(a) {
                    return a === n.activeElement && (!n.hasFocus || n.hasFocus()) && !!(a.type || a.href || ~a.tabIndex)
                },
                enabled: function(a) {
                    return !1 === a.disabled
                },
                disabled: function(a) {
                    return !0 === a.disabled
                },
                checked: function(a) {
                    var b = a.nodeName.toLowerCase();
                    return "input" === b && !!a.checked || "option" === b && !!a.selected
                },
                selected: function(a) {
                    return a.parentNode && a.parentNode.selectedIndex, !0 === a.selected
                },
                empty: function(a) {
                    for (a = a.firstChild; a; a = a.nextSibling)
                        if (a.nodeType < 6) return !1;
                    return !0
                },
                parent: function(a) {
                    return !d.pseudos.empty(a)
                },
                header: function(a) {
                    return Y.test(a.nodeName)
                },
                input: function(a) {
                    return X.test(a.nodeName)
                },
                button: function(a) {
                    var b = a.nodeName.toLowerCase();
                    return "input" === b && "button" === a.type || "button" === b
                },
                text: function(a) {
                    var b;
                    return "input" === a.nodeName.toLowerCase() && "text" === a.type && (null == (b = a.getAttribute("type")) || "text" === b.toLowerCase())
                },
                first: na(function() {
                    return [0]
                }),
                last: na(function(a, b) {
                    return [b - 1]
                }),
                eq: na(function(a, b, c) {
                    return [0 > c ? c + b : c]
                }),
                even: na(function(a, b) {
                    for (var c = 0; b > c; c += 2) a.push(c);
                    return a
                }),
                odd: na(function(a, b) {
                    for (var c = 1; b > c; c += 2) a.push(c);
                    return a
                }),
                lt: na(function(a, b, c) {
                    for (var d = 0 > c ? c + b : c; --d >= 0;) a.push(d);
                    return a
                }),
                gt: na(function(a, b, c) {
                    for (var d = 0 > c ? c + b : c; ++d < b;) a.push(d);
                    return a
                })
            }
        }, d.pseudos.nth = d.pseudos.eq;
        for (b in { radio: !0, checkbox: !0, file: !0, password: !0, image: !0 }) d.pseudos[b] = function(a) {
            return function(b) {
                return "input" === b.nodeName.toLowerCase() && b.type === a
            }
        }(b);
        for (b in {
                submit: !0,
                reset: !0
            }) d.pseudos[b] = function(a) {
            return function(b) {
                var c = b.nodeName.toLowerCase();
                return ("input" === c || "button" === c) && b.type === a
            }
        }(b);
        return pa.prototype = d.filters = d.pseudos, d.setFilters = new pa, g = fa.tokenize = function(a, b) {
            var c, e, f, g, h, i, j, k = z[a + " "];
            if (k) return b ? 0 : k.slice(0);
            for (h = a, i = [], j = d.preFilter; h;) {
                c && !(e = R.exec(h)) || (e && (h = h.slice(e[0].length) || h), i.push(f = [])), c = !1, (e = S.exec(h)) && (c = e.shift(), f.push({
                    value: c,
                    type: e[0].replace(Q, " ")
                }), h = h.slice(c.length));
                for (g in d.filter) !(e = W[g].exec(h)) || j[g] && !(e = j[g](e)) || (c = e.shift(), f.push({
                    value: c,
                    type: g,
                    matches: e
                }), h = h.slice(c.length));
                if (!c) break
            }
            return b ? h.length : h ? fa.error(a) : z(a, i).slice(0)
        }, h = fa.compile = function(a, b) {
            var c, d = [],
                e = [],
                f = A[a + " "];
            if (!f) {
                for (b || (b = g(a)), c = b.length; c--;) f = wa(b[c]), f[u] ? d.push(f) : e.push(f);
                f = A(a, xa(e, d)), f.selector = a
            }
            return f
        }, i = fa.select = function(a, b, e, f) {
            var i, j, k, l, m, n = "function" == typeof a && a,
                o = !f && g(a = n.selector || a);
            if (e = e || [], 1 === o.length) {
                if (j = o[0] = o[0].slice(0), j.length > 2 && "ID" === (k = j[0]).type && c.getById && 9 === b.nodeType && p && d.relative[j[1].type]) {
                    if (!(b = (d.find.ID(k.matches[0].replace(ba, ca), b) || [])[0])) return e;
                    n && (b = b.parentNode), a = a.slice(j.shift().value.length)
                }
                for (i = W.needsContext.test(a) ? 0 : j.length; i-- && (k = j[i], !d.relative[l = k.type]);)
                    if ((m = d.find[l]) && (f = m(k.matches[0].replace(ba, ca), _.test(j[0].type) && oa(b.parentNode) || b))) {
                        if (j.splice(i, 1), !(a = f.length && qa(j))) return H.apply(e, f), e;
                        break
                    }
            }
            return (n || h(a, o))(f, b, !p, e, !b || _.test(a) && oa(b.parentNode) || b), e
        }, c.sortStable = u.split("").sort(B).join("") === u, c.detectDuplicates = !!l, m(), c.sortDetached = ia(function(a) {
            return 1 & a.compareDocumentPosition(n.createElement("div"))
        }), ia(function(a) {
            return a.innerHTML = "<a href='#'></a>", "#" === a.firstChild.getAttribute("href")
        }) || ja("type|href|height|width", function(a, b, c) {
            return c ? void 0 : a.getAttribute(b, "type" === b.toLowerCase() ? 1 : 2)
        }), c.attributes && ia(function(a) {
            return a.innerHTML = "<input/>", a.firstChild.setAttribute("value", ""), "" === a.firstChild.getAttribute("value")
        }) || ja("value", function(a, b, c) {
            return c || "input" !== a.nodeName.toLowerCase() ? void 0 : a.defaultValue
        }), ia(function(a) {
            return null == a.getAttribute("disabled")
        }) || ja(K, function(a, b, c) {
            var d;
            return c ? void 0 : !0 === a[b] ? b.toLowerCase() : (d = a.getAttributeNode(b)) && d.specified ? d.value : null
        }), fa
    }(a);
    n.find = t, n.expr = t.selectors, n.expr[":"] = n.expr.pseudos, n.uniqueSort = n.unique = t.uniqueSort, n.text = t.getText, n.isXMLDoc = t.isXML, n.contains = t.contains;
    var u = function(a, b, c) {
            for (var d = [], e = void 0 !== c;
                (a = a[b]) && 9 !== a.nodeType;)
                if (1 === a.nodeType) {
                    if (e && n(a).is(c)) break;
                    d.push(a)
                }
            return d
        },
        v = function(a, b) {
            for (var c = []; a; a = a.nextSibling) 1 === a.nodeType && a !== b && c.push(a);
            return c
        },
        w = n.expr.match.needsContext,
        x = /^<([\w-]+)\s*\/?>(?:<\/\1>|)$/,
        y = /^.[^:#\[\.,]*$/;
    n.filter = function(a, b, c) {
        var d = b[0];
        return c && (a = ":not(" + a + ")"), 1 === b.length && 1 === d.nodeType ? n.find.matchesSelector(d, a) ? [d] : [] : n.find.matches(a, n.grep(b, function(a) {
            return 1 === a.nodeType
        }))
    }, n.fn.extend({
        find: function(a) {
            var b, c = this.length,
                d = [],
                e = this;
            if ("string" != typeof a) return this.pushStack(n(a).filter(function() {
                for (b = 0; c > b; b++)
                    if (n.contains(e[b], this)) return !0
            }));
            for (b = 0; c > b; b++) n.find(a, e[b], d);
            return d = this.pushStack(c > 1 ? n.unique(d) : d), d.selector = this.selector ? this.selector + " " + a : a, d
        },
        filter: function(a) {
            return this.pushStack(z(this, a || [], !1))
        },
        not: function(a) {
            return this.pushStack(z(this, a || [], !0))
        },
        is: function(a) {
            return !!z(this, "string" == typeof a && w.test(a) ? n(a) : a || [], !1).length
        }
    });
    var A, B = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/;
    (n.fn.init = function(a, b, c) {
        var e, f;
        if (!a) return this;
        if (c = c || A, "string" == typeof a) {
            if (!(e = "<" === a[0] && ">" === a[a.length - 1] && a.length >= 3 ? [null, a, null] : B.exec(a)) || !e[1] && b) return !b || b.jquery ? (b || c).find(a) : this.constructor(b).find(a);
            if (e[1]) {
                if (b = b instanceof n ? b[0] : b, n.merge(this, n.parseHTML(e[1], b && b.nodeType ? b.ownerDocument || b : d, !0)), x.test(e[1]) && n.isPlainObject(b))
                    for (e in b) n.isFunction(this[e]) ? this[e](b[e]) : this.attr(e, b[e]);
                return this
            }
            return f = d.getElementById(e[2]), f && f.parentNode && (this.length = 1, this[0] = f), this.context = d, this.selector = a, this
        }
        return a.nodeType ? (this.context = this[0] = a, this.length = 1, this) : n.isFunction(a) ? void 0 !== c.ready ? c.ready(a) : a(n) : (void 0 !== a.selector && (this.selector = a.selector, this.context = a.context), n.makeArray(a, this))
    }).prototype = n.fn, A = n(d);
    var D = /^(?:parents|prev(?:Until|All))/,
        E = { children: !0, contents: !0, next: !0, prev: !0 };
    n.fn.extend({
        has: function(a) {
            var b = n(a, this),
                c = b.length;
            return this.filter(function() {
                for (var a = 0; c > a; a++)
                    if (n.contains(this, b[a])) return !0
            })
        },
        closest: function(a, b) {
            for (var c, d = 0, e = this.length, f = [], g = w.test(a) || "string" != typeof a ? n(a, b || this.context) : 0; e > d; d++)
                for (c = this[d]; c && c !== b; c = c.parentNode)
                    if (c.nodeType < 11 && (g ? g.index(c) > -1 : 1 === c.nodeType && n.find.matchesSelector(c, a))) {
                        f.push(c);
                        break
                    }
            return this.pushStack(f.length > 1 ? n.uniqueSort(f) : f)
        },
        index: function(a) {
            return a ? "string" == typeof a ? h.call(n(a), this[0]) : h.call(this, a.jquery ? a[0] : a) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function(a, b) {
            return this.pushStack(n.uniqueSort(n.merge(this.get(), n(a, b))))
        },
        addBack: function(a) {
            return this.add(null == a ? this.prevObject : this.prevObject.filter(a))
        }
    }), n.each({
        parent: function(a) {
            var b = a.parentNode;
            return b && 11 !== b.nodeType ? b : null
        },
        parents: function(a) {
            return u(a, "parentNode")
        },
        parentsUntil: function(a, b, c) {
            return u(a, "parentNode", c)
        },
        next: function(a) {
            return F(a, "nextSibling")
        },
        prev: function(a) {
            return F(a, "previousSibling")
        },
        nextAll: function(a) {
            return u(a, "nextSibling")
        },
        prevAll: function(a) {
            return u(a, "previousSibling")
        },
        nextUntil: function(a, b, c) {
            return u(a, "nextSibling", c)
        },
        prevUntil: function(a, b, c) {
            return u(a, "previousSibling", c)
        },
        siblings: function(a) {
            return v((a.parentNode || {}).firstChild, a)
        },
        children: function(a) {
            return v(a.firstChild)
        },
        contents: function(a) {
            return a.contentDocument || n.merge([], a.childNodes)
        }
    }, function(a, b) {
        n.fn[a] = function(c, d) {
            var e = n.map(this, b, c);
            return "Until" !== a.slice(-5) && (d = c), d && "string" == typeof d && (e = n.filter(d, e)), this.length > 1 && (E[a] || n.uniqueSort(e), D.test(a) && e.reverse()), this.pushStack(e)
        }
    });
    var G = /\S+/g;
    n.Callbacks = function(a) {
        a = "string" == typeof a ? H(a) : n.extend({}, a);
        var b, c, d, e, f = [],
            g = [],
            h = -1,
            i = function() {
                for (e = a.once, d = b = !0; g.length; h = -1)
                    for (c = g.shift(); ++h < f.length;) !1 === f[h].apply(c[0], c[1]) && a.stopOnFalse && (h = f.length, c = !1);
                a.memory || (c = !1), b = !1, e && (f = c ? [] : "")
            },
            j = {
                add: function() {
                    return f && (c && !b && (h = f.length - 1, g.push(c)), function d(b) {
                        n.each(b, function(b, c) {
                            n.isFunction(c) ? a.unique && j.has(c) || f.push(c) : c && c.length && "string" !== n.type(c) && d(c)
                        })
                    }(arguments), c && !b && i()), this
                },
                remove: function() {
                    return n.each(arguments, function(a, b) {
                        for (var c;
                            (c = n.inArray(b, f, c)) > -1;) f.splice(c, 1), h >= c && h--
                    }), this
                },
                has: function(a) {
                    return a ? n.inArray(a, f) > -1 : f.length > 0
                },
                empty: function() {
                    return f && (f = []), this
                },
                disable: function() {
                    return e = g = [], f = c = "", this
                },
                disabled: function() {
                    return !f
                },
                lock: function() {
                    return e = g = [], c || (f = c = ""), this
                },
                locked: function() {
                    return !!e
                },
                fireWith: function(a, c) {
                    return e || (c = c || [], c = [a, c.slice ? c.slice() : c], g.push(c), b || i()), this
                },
                fire: function() {
                    return j.fireWith(this, arguments), this
                },
                fired: function() {
                    return !!d
                }
            };
        return j
    }, n.extend({
        Deferred: function(a) {
            var b = [
                    ["resolve", "done", n.Callbacks("once memory"), "resolved"],
                    ["reject", "fail", n.Callbacks("once memory"), "rejected"],
                    ["notify", "progress", n.Callbacks("memory")]
                ],
                c = "pending",
                d = {
                    state: function() {
                        return c
                    },
                    always: function() {
                        return e.done(arguments).fail(arguments), this
                    },
                    then: function() {
                        var a = arguments;
                        return n.Deferred(function(c) {
                            n.each(b, function(b, f) {
                                var g = n.isFunction(a[b]) && a[b];
                                e[f[1]](function() {
                                    var a = g && g.apply(this, arguments);
                                    a && n.isFunction(a.promise) ? a.promise().progress(c.notify).done(c.resolve).fail(c.reject) : c[f[0] + "With"](this === d ? c.promise() : this, g ? [a] : arguments)
                                })
                            }), a = null
                        }).promise()
                    },
                    promise: function(a) {
                        return null != a ? n.extend(a, d) : d
                    }
                },
                e = {};
            return d.pipe = d.then, n.each(b, function(a, f) {
                var g = f[2],
                    h = f[3];
                d[f[1]] = g.add, h && g.add(function() {
                    c = h
                }, b[1 ^ a][2].disable, b[2][2].lock), e[f[0]] = function() {
                    return e[f[0] + "With"](this === e ? d : this, arguments), this
                }, e[f[0] + "With"] = g.fireWith
            }), d.promise(e), a && a.call(e, e), e
        },
        when: function(a) {
            var i, j, k, b = 0,
                c = e.call(arguments),
                d = c.length,
                f = 1 !== d || a && n.isFunction(a.promise) ? d : 0,
                g = 1 === f ? a : n.Deferred(),
                h = function(a, b, c) {
                    return function(d) {
                        b[a] = this, c[a] = arguments.length > 1 ? e.call(arguments) : d, c === i ? g.notifyWith(b, c) : --f || g.resolveWith(b, c)
                    }
                };
            if (d > 1)
                for (i = new Array(d), j = new Array(d), k = new Array(d); d > b; b++) c[b] && n.isFunction(c[b].promise) ? c[b].promise().progress(h(b, j, i)).done(h(b, k, c)).fail(g.reject) : --f;
            return f || g.resolveWith(k, c), g.promise()
        }
    });
    var I;
    n.fn.ready = function(a) {
        return n.ready.promise().done(a), this
    }, n.extend({
        isReady: !1,
        readyWait: 1,
        holdReady: function(a) {
            a ? n.readyWait++ : n.ready(!0)
        },
        ready: function(a) {
            (!0 === a ? --n.readyWait : n.isReady) || (n.isReady = !0, !0 !== a && --n.readyWait > 0 || (I.resolveWith(d, [n]), n.fn.triggerHandler && (n(d).triggerHandler("ready"), n(d).off("ready"))))
        }
    }), n.ready.promise = function(b) {
        return I || (I = n.Deferred(), "complete" === d.readyState || "loading" !== d.readyState && !d.documentElement.doScroll ? a.setTimeout(n.ready) : (d.addEventListener("DOMContentLoaded", J), a.addEventListener("load", J))), I.promise(b)
    }, n.ready.promise();
    var K = function(a, b, c, d, e, f, g) {
            var h = 0,
                i = a.length,
                j = null == c;
            if ("object" === n.type(c)) {
                e = !0;
                for (h in c) K(a, b, h, c[h], !0, f, g)
            } else if (void 0 !== d && (e = !0, n.isFunction(d) || (g = !0), j && (g ? (b.call(a, d), b = null) : (j = b, b = function(a, b, c) {
                    return j.call(n(a), c)
                })), b))
                for (; i > h; h++) b(a[h], c, g ? d : d.call(a[h], h, b(a[h], c)));
            return e ? a : j ? b.call(a) : i ? b(a[0], c) : f
        },
        L = function(a) {
            return 1 === a.nodeType || 9 === a.nodeType || !+a.nodeType
        };
    M.uid = 1, M.prototype = {
        register: function(a, b) {
            var c = b || {};
            return a.nodeType ? a[this.expando] = c : Object.defineProperty(a, this.expando, {
                value: c,
                writable: !0,
                configurable: !0
            }), a[this.expando]
        },
        cache: function(a) {
            if (!L(a)) return {};
            var b = a[this.expando];
            return b || (b = {}, L(a) && (a.nodeType ? a[this.expando] = b : Object.defineProperty(a, this.expando, {
                value: b,
                configurable: !0
            }))), b
        },
        set: function(a, b, c) {
            var d, e = this.cache(a);
            if ("string" == typeof b) e[b] = c;
            else
                for (d in b) e[d] = b[d];
            return e
        },
        get: function(a, b) {
            return void 0 === b ? this.cache(a) : a[this.expando] && a[this.expando][b]
        },
        access: function(a, b, c) {
            var d;
            return void 0 === b || b && "string" == typeof b && void 0 === c ? (d = this.get(a, b), void 0 !== d ? d : this.get(a, n.camelCase(b))) : (this.set(a, b, c), void 0 !== c ? c : b)
        },
        remove: function(a, b) {
            var c, d, e, f = a[this.expando];
            if (void 0 !== f) {
                if (void 0 === b) this.register(a);
                else {
                    n.isArray(b) ? d = b.concat(b.map(n.camelCase)) : (e = n.camelCase(b), b in f ? d = [b, e] : (d = e, d = d in f ? [d] : d.match(G) || [])), c = d.length;
                    for (; c--;) delete f[d[c]]
                }
                (void 0 === b || n.isEmptyObject(f)) && (a.nodeType ? a[this.expando] = void 0 : delete a[this.expando])
            }
        },
        hasData: function(a) {
            var b = a[this.expando];
            return void 0 !== b && !n.isEmptyObject(b)
        }
    };
    var N = new M,
        O = new M,
        P = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        Q = /[A-Z]/g;
    n.extend({
        hasData: function(a) {
            return O.hasData(a) || N.hasData(a)
        },
        data: function(a, b, c) {
            return O.access(a, b, c)
        },
        removeData: function(a, b) {
            O.remove(a, b)
        },
        _data: function(a, b, c) {
            return N.access(a, b, c)
        },
        _removeData: function(a, b) {
            N.remove(a, b)
        }
    }), n.fn.extend({
        data: function(a, b) {
            var c, d, e, f = this[0],
                g = f && f.attributes;
            if (void 0 === a) {
                if (this.length && (e = O.get(f), 1 === f.nodeType && !N.get(f, "hasDataAttrs"))) {
                    for (c = g.length; c--;) g[c] && (d = g[c].name, 0 === d.indexOf("data-") && (d = n.camelCase(d.slice(5)), R(f, d, e[d])));
                    N.set(f, "hasDataAttrs", !0)
                }
                return e
            }
            return "object" == typeof a ? this.each(function() {
                O.set(this, a)
            }) : K(this, function(b) {
                var c, d;
                if (f && void 0 === b) {
                    if (void 0 !== (c = O.get(f, a) || O.get(f, a.replace(Q, "-$&").toLowerCase()))) return c;
                    if (d = n.camelCase(a), void 0 !== (c = O.get(f, d))) return c;
                    if (void 0 !== (c = R(f, d, void 0))) return c
                } else d = n.camelCase(a), this.each(function() {
                    var c = O.get(this, d);
                    O.set(this, d, b), a.indexOf("-") > -1 && void 0 !== c && O.set(this, a, b)
                })
            }, null, b, arguments.length > 1, null, !0)
        },
        removeData: function(a) {
            return this.each(function() {
                O.remove(this, a)
            })
        }
    }), n.extend({
        queue: function(a, b, c) {
            var d;
            return a ? (b = (b || "fx") + "queue", d = N.get(a, b), c && (!d || n.isArray(c) ? d = N.access(a, b, n.makeArray(c)) : d.push(c)), d || []) : void 0
        },
        dequeue: function(a, b) {
            b = b || "fx";
            var c = n.queue(a, b),
                d = c.length,
                e = c.shift(),
                f = n._queueHooks(a, b),
                g = function() {
                    n.dequeue(a, b)
                };
            "inprogress" === e && (e = c.shift(), d--), e && ("fx" === b && c.unshift("inprogress"), delete f.stop, e.call(a, g, f)), !d && f && f.empty.fire()
        },
        _queueHooks: function(a, b) {
            var c = b + "queueHooks";
            return N.get(a, c) || N.access(a, c, {
                empty: n.Callbacks("once memory").add(function() {
                    N.remove(a, [b + "queue", c])
                })
            })
        }
    }), n.fn.extend({
        queue: function(a, b) {
            var c = 2;
            return "string" != typeof a && (b = a, a = "fx", c--), arguments.length < c ? n.queue(this[0], a) : void 0 === b ? this : this.each(function() {
                var c = n.queue(this, a, b);
                n._queueHooks(this, a), "fx" === a && "inprogress" !== c[0] && n.dequeue(this, a)
            })
        },
        dequeue: function(a) {
            return this.each(function() {
                n.dequeue(this, a)
            })
        },
        clearQueue: function(a) {
            return this.queue(a || "fx", [])
        },
        promise: function(a, b) {
            var c, d = 1,
                e = n.Deferred(),
                f = this,
                g = this.length,
                h = function() {
                    --d || e.resolveWith(f, [f])
                };
            for ("string" != typeof a && (b = a, a = void 0), a = a || "fx"; g--;)(c = N.get(f[g], a + "queueHooks")) && c.empty && (d++, c.empty.add(h));
            return h(), e.promise(b)
        }
    });
    var S = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        T = new RegExp("^(?:([+-])=|)(" + S + ")([a-z%]*)$", "i"),
        U = ["Top", "Right", "Bottom", "Left"],
        V = function(a, b) {
            return a = b || a, "none" === n.css(a, "display") || !n.contains(a.ownerDocument, a)
        },
        X = /^(?:checkbox|radio)$/i,
        Y = /<([\w:-]+)/,
        Z = /^$|\/(?:java|ecma)script/i,
        $ = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            thead: [1, "<table>", "</table>"],
            col: [2, "<table><colgroup>", "</colgroup></table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: [0, "", ""]
        };
    $.optgroup = $.option, $.tbody = $.tfoot = $.colgroup = $.caption = $.thead, $.th = $.td;
    var ba = /<|&#?\w+;/;
    ! function() {
        var a = d.createDocumentFragment(),
            b = a.appendChild(d.createElement("div")),
            c = d.createElement("input");
        c.setAttribute("type", "radio"), c.setAttribute("checked", "checked"), c.setAttribute("name", "t"), b.appendChild(c), l.checkClone = b.cloneNode(!0).cloneNode(!0).lastChild.checked, b.innerHTML = "<textarea>x</textarea>", l.noCloneChecked = !!b.cloneNode(!0).lastChild.defaultValue
    }();
    var da = /^key/,
        ea = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
        fa = /^([^.]*)(?:\.(.+)|)/;
    n.event = {
        global: {},
        add: function(a, b, c, d, e) {
            var f, g, h, i, j, k, l, m, o, p, q, r = N.get(a);
            if (r)
                for (c.handler && (f = c, c = f.handler, e = f.selector), c.guid || (c.guid = n.guid++), (i = r.events) || (i = r.events = {}), (g = r.handle) || (g = r.handle = function(b) {
                        return void 0 !== n && n.event.triggered !== b.type ? n.event.dispatch.apply(a, arguments) : void 0
                    }), b = (b || "").match(G) || [""], j = b.length; j--;) h = fa.exec(b[j]) || [], o = q = h[1], p = (h[2] || "").split(".").sort(), o && (l = n.event.special[o] || {}, o = (e ? l.delegateType : l.bindType) || o, l = n.event.special[o] || {}, k = n.extend({
                    type: o,
                    origType: q,
                    data: d,
                    handler: c,
                    guid: c.guid,
                    selector: e,
                    needsContext: e && n.expr.match.needsContext.test(e),
                    namespace: p.join(".")
                }, f), (m = i[o]) || (m = i[o] = [], m.delegateCount = 0, l.setup && !1 !== l.setup.call(a, d, p, g) || a.addEventListener && a.addEventListener(o, g)), l.add && (l.add.call(a, k), k.handler.guid || (k.handler.guid = c.guid)), e ? m.splice(m.delegateCount++, 0, k) : m.push(k), n.event.global[o] = !0)
        },
        remove: function(a, b, c, d, e) {
            var f, g, h, i, j, k, l, m, o, p, q, r = N.hasData(a) && N.get(a);
            if (r && (i = r.events)) {
                for (b = (b || "").match(G) || [""], j = b.length; j--;)
                    if (h = fa.exec(b[j]) || [], o = q = h[1], p = (h[2] || "").split(".").sort(), o) {
                        for (l = n.event.special[o] || {}, o = (d ? l.delegateType : l.bindType) || o, m = i[o] || [], h = h[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"), g = f = m.length; f--;) k = m[f], !e && q !== k.origType || c && c.guid !== k.guid || h && !h.test(k.namespace) || d && d !== k.selector && ("**" !== d || !k.selector) || (m.splice(f, 1), k.selector && m.delegateCount--, l.remove && l.remove.call(a, k));
                        g && !m.length && (l.teardown && !1 !== l.teardown.call(a, p, r.handle) || n.removeEvent(a, o, r.handle), delete i[o])
                    } else
                        for (o in i) n.event.remove(a, o + b[j], c, d, !0);
                n.isEmptyObject(i) && N.remove(a, "handle events")
            }
        },
        dispatch: function(a) {
            a = n.event.fix(a);
            var b, c, d, f, g, h = [],
                i = e.call(arguments),
                j = (N.get(this, "events") || {})[a.type] || [],
                k = n.event.special[a.type] || {};
            if (i[0] = a, a.delegateTarget = this, !k.preDispatch || !1 !== k.preDispatch.call(this, a)) {
                for (h = n.event.handlers.call(this, a, j), b = 0;
                    (f = h[b++]) && !a.isPropagationStopped();)
                    for (a.currentTarget = f.elem, c = 0;
                        (g = f.handlers[c++]) && !a.isImmediatePropagationStopped();) a.rnamespace && !a.rnamespace.test(g.namespace) || (a.handleObj = g, a.data = g.data, void 0 !== (d = ((n.event.special[g.origType] || {}).handle || g.handler).apply(f.elem, i)) && !1 === (a.result = d) && (a.preventDefault(), a.stopPropagation()));
                return k.postDispatch && k.postDispatch.call(this, a), a.result
            }
        },
        handlers: function(a, b) {
            var c, d, e, f, g = [],
                h = b.delegateCount,
                i = a.target;
            if (h && i.nodeType && ("click" !== a.type || isNaN(a.button) || a.button < 1))
                for (; i !== this; i = i.parentNode || this)
                    if (1 === i.nodeType && (!0 !== i.disabled || "click" !== a.type)) {
                        for (d = [], c = 0; h > c; c++) f = b[c], e = f.selector + " ", void 0 === d[e] && (d[e] = f.needsContext ? n(e, this).index(i) > -1 : n.find(e, this, null, [i]).length), d[e] && d.push(f);
                        d.length && g.push({ elem: i, handlers: d })
                    }
            return h < b.length && g.push({ elem: this, handlers: b.slice(h) }), g
        },
        props: "altKey bubbles cancelable ctrlKey currentTarget detail eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "),
            filter: function(a, b) {
                return null == a.which && (a.which = null != b.charCode ? b.charCode : b.keyCode), a
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
            filter: function(a, b) {
                var c, e, f, g = b.button;
                return null == a.pageX && null != b.clientX && (c = a.target.ownerDocument || d, e = c.documentElement, f = c.body, a.pageX = b.clientX + (e && e.scrollLeft || f && f.scrollLeft || 0) - (e && e.clientLeft || f && f.clientLeft || 0), a.pageY = b.clientY + (e && e.scrollTop || f && f.scrollTop || 0) - (e && e.clientTop || f && f.clientTop || 0)), a.which || void 0 === g || (a.which = 1 & g ? 1 : 2 & g ? 3 : 4 & g ? 2 : 0), a
            }
        },
        fix: function(a) {
            if (a[n.expando]) return a;
            var b, c, e, f = a.type,
                g = a,
                h = this.fixHooks[f];
            for (h || (this.fixHooks[f] = h = ea.test(f) ? this.mouseHooks : da.test(f) ? this.keyHooks : {}), e = h.props ? this.props.concat(h.props) : this.props, a = new n.Event(g), b = e.length; b--;) c = e[b], a[c] = g[c];
            return a.target || (a.target = d), 3 === a.target.nodeType && (a.target = a.target.parentNode), h.filter ? h.filter(a, g) : a
        },
        special: {
            load: { noBubble: !0 },
            focus: {
                trigger: function() {
                    return this !== ia() && this.focus ? (this.focus(), !1) : void 0
                },
                delegateType: "focusin"
            },
            blur: {
                trigger: function() {
                    return this === ia() && this.blur ? (this.blur(), !1) : void 0
                },
                delegateType: "focusout"
            },
            click: {
                trigger: function() {
                    return "checkbox" === this.type && this.click && n.nodeName(this, "input") ? (this.click(), !1) : void 0
                },
                _default: function(a) {
                    return n.nodeName(a.target, "a")
                }
            },
            beforeunload: {
                postDispatch: function(a) {
                    void 0 !== a.result && a.originalEvent && (a.originalEvent.returnValue = a.result)
                }
            }
        }
    }, n.removeEvent = function(a, b, c) {
        a.removeEventListener && a.removeEventListener(b, c)
    }, n.Event = function(a, b) {
        return this instanceof n.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || void 0 === a.defaultPrevented && !1 === a.returnValue ? ga : ha) : this.type = a, b && n.extend(this, b), this.timeStamp = a && a.timeStamp || n.now(), void(this[n.expando] = !0)) : new n.Event(a, b)
    }, n.Event.prototype = {
        constructor: n.Event,
        isDefaultPrevented: ha,
        isPropagationStopped: ha,
        isImmediatePropagationStopped: ha,
        isSimulated: !1,
        preventDefault: function() {
            var a = this.originalEvent;
            this.isDefaultPrevented = ga, a && !this.isSimulated && a.preventDefault()
        },
        stopPropagation: function() {
            var a = this.originalEvent;
            this.isPropagationStopped = ga, a && !this.isSimulated && a.stopPropagation()
        },
        stopImmediatePropagation: function() {
            var a = this.originalEvent;
            this.isImmediatePropagationStopped = ga, a && !this.isSimulated && a.stopImmediatePropagation(), this.stopPropagation()
        }
    }, n.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function(a, b) {
        n.event.special[a] = {
            delegateType: b,
            bindType: b,
            handle: function(a) {
                var c, d = this,
                    e = a.relatedTarget,
                    f = a.handleObj;
                return e && (e === d || n.contains(d, e)) || (a.type = f.origType, c = f.handler.apply(this, arguments), a.type = b), c
            }
        }
    }), n.fn.extend({
        on: function(a, b, c, d) {
            return ja(this, a, b, c, d)
        },
        one: function(a, b, c, d) {
            return ja(this, a, b, c, d, 1)
        },
        off: function(a, b, c) {
            var d, e;
            if (a && a.preventDefault && a.handleObj) return d = a.handleObj, n(a.delegateTarget).off(d.namespace ? d.origType + "." + d.namespace : d.origType, d.selector, d.handler), this;
            if ("object" == typeof a) {
                for (e in a) this.off(e, b, a[e]);
                return this
            }
            return !1 !== b && "function" != typeof b || (c = b, b = void 0), !1 === c && (c = ha), this.each(function() {
                n.event.remove(this, a, c, b)
            })
        }
    });
    var ka = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:-]+)[^>]*)\/>/gi,
        la = /<script|<style|<link/i,
        ma = /checked\s*(?:[^=]|=\s*.checked.)/i,
        na = /^true\/(.*)/,
        oa = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
    n.extend({
        htmlPrefilter: function(a) {
            return a.replace(ka, "<$1></$2>")
        },
        clone: function(a, b, c) {
            var d, e, f, g, h = a.cloneNode(!0),
                i = n.contains(a.ownerDocument, a);
            if (!(l.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || n.isXMLDoc(a)))
                for (g = _(h), f = _(a), d = 0, e = f.length; e > d; d++) ta(f[d], g[d]);
            if (b)
                if (c)
                    for (f = f || _(a), g = g || _(h), d = 0, e = f.length; e > d; d++) sa(f[d], g[d]);
                else sa(a, h);
            return g = _(h, "script"), g.length > 0 && aa(g, !i && _(a, "script")), h
        },
        cleanData: function(a) {
            for (var b, c, d, e = n.event.special, f = 0; void 0 !== (c = a[f]); f++)
                if (L(c)) {
                    if (b = c[N.expando]) {
                        if (b.events)
                            for (d in b.events) e[d] ? n.event.remove(c, d) : n.removeEvent(c, d, b.handle);
                        c[N.expando] = void 0
                    }
                    c[O.expando] && (c[O.expando] = void 0)
                }
        }
    }), n.fn.extend({
        domManip: ua,
        detach: function(a) {
            return va(this, a, !0)
        },
        remove: function(a) {
            return va(this, a)
        },
        text: function(a) {
            return K(this, function(a) {
                return void 0 === a ? n.text(this) : this.empty().each(function() {
                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = a)
                })
            }, null, a, arguments.length)
        },
        append: function() {
            return ua(this, arguments, function(a) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    pa(this, a).appendChild(a)
                }
            })
        },
        prepend: function() {
            return ua(this, arguments, function(a) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var b = pa(this, a);
                    b.insertBefore(a, b.firstChild)
                }
            })
        },
        before: function() {
            return ua(this, arguments, function(a) {
                this.parentNode && this.parentNode.insertBefore(a, this)
            })
        },
        after: function() {
            return ua(this, arguments, function(a) {
                this.parentNode && this.parentNode.insertBefore(a, this.nextSibling)
            })
        },
        empty: function() {
            for (var a, b = 0; null != (a = this[b]); b++) 1 === a.nodeType && (n.cleanData(_(a, !1)), a.textContent = "");
            return this
        },
        clone: function(a, b) {
            return a = null != a && a, b = null == b ? a : b, this.map(function() {
                return n.clone(this, a, b)
            })
        },
        html: function(a) {
            return K(this, function(a) {
                var b = this[0] || {},
                    c = 0,
                    d = this.length;
                if (void 0 === a && 1 === b.nodeType) return b.innerHTML;
                if ("string" == typeof a && !la.test(a) && !$[(Y.exec(a) || ["", ""])[1].toLowerCase()]) {
                    a = n.htmlPrefilter(a);
                    try {
                        for (; d > c; c++) b = this[c] || {}, 1 === b.nodeType && (n.cleanData(_(b, !1)), b.innerHTML = a);
                        b = 0
                    } catch (e) {}
                }
                b && this.empty().append(a)
            }, null, a, arguments.length)
        },
        replaceWith: function() {
            var a = [];
            return ua(this, arguments, function(b) {
                var c = this.parentNode;
                n.inArray(this, a) < 0 && (n.cleanData(_(this)), c && c.replaceChild(b, this))
            }, a)
        }
    }), n.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(a, b) {
        n.fn[a] = function(a) {
            for (var c, d = [], e = n(a), f = e.length - 1, h = 0; f >= h; h++) c = h === f ? this : this.clone(!0), n(e[h])[b](c), g.apply(d, c.get());
            return this.pushStack(d)
        }
    });
    var wa, xa = { HTML: "block", BODY: "block" },
        Aa = /^margin/,
        Ba = new RegExp("^(" + S + ")(?!px)[a-z%]+$", "i"),
        Ca = function(b) {
            var c = b.ownerDocument.defaultView;
            return c && c.opener || (c = a), c.getComputedStyle(b)
        },
        Da = function(a, b, c, d) {
            var e, f, g = {};
            for (f in b) g[f] = a.style[f], a.style[f] = b[f];
            e = c.apply(a, d || []);
            for (f in b) a.style[f] = g[f];
            return e
        },
        Ea = d.documentElement;
    ! function() {
        function i() {
            h.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%", h.innerHTML = "", Ea.appendChild(g);
            var d = a.getComputedStyle(h);
            b = "1%" !== d.top, f = "2px" === d.marginLeft, c = "4px" === d.width, h.style.marginRight = "50%", e = "4px" === d.marginRight, Ea.removeChild(g)
        }

        var b, c, e, f, g = d.createElement("div"),
            h = d.createElement("div");
        h.style && (h.style.backgroundClip = "content-box", h.cloneNode(!0).style.backgroundClip = "", l.clearCloneStyle = "content-box" === h.style.backgroundClip, g.style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute", g.appendChild(h), n.extend(l, {
            pixelPosition: function() {
                return i(), b
            },
            boxSizingReliable: function() {
                return null == c && i(), c
            },
            pixelMarginRight: function() {
                return null == c && i(), e
            },
            reliableMarginLeft: function() {
                return null == c && i(), f
            },
            reliableMarginRight: function() {
                var b, c = h.appendChild(d.createElement("div"));
                return c.style.cssText = h.style.cssText = "-webkit-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", c.style.marginRight = c.style.width = "0", h.style.width = "1px", Ea.appendChild(g), b = !parseFloat(a.getComputedStyle(c).marginRight), Ea.removeChild(g), h.removeChild(c), b
            }
        }))
    }();
    var Ha = /^(none|table(?!-c[ea]).+)/,
        Ia = { position: "absolute", visibility: "hidden", display: "block" },
        Ja = { letterSpacing: "0", fontWeight: "400" },
        Ka = ["Webkit", "O", "Moz", "ms"],
        La = d.createElement("div").style;
    n.extend({
        cssHooks: {
            opacity: {
                get: function(a, b) {
                    if (b) {
                        var c = Fa(a, "opacity");
                        return "" === c ? "1" : c
                    }
                }
            }
        },
        cssNumber: {
            animationIterationCount: !0,
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: { float: "cssFloat" },
        style: function(a, b, c, d) {
            if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
                var e, f, g, h = n.camelCase(b),
                    i = a.style;
                return b = n.cssProps[h] || (n.cssProps[h] = Ma(h) || h), g = n.cssHooks[b] || n.cssHooks[h], void 0 === c ? g && "get" in g && void 0 !== (e = g.get(a, !1, d)) ? e : i[b] : (f = typeof c, "string" === f && (e = T.exec(c)) && e[1] && (c = W(a, b, e), f = "number"), void(null != c && c === c && ("number" === f && (c += e && e[3] || (n.cssNumber[h] ? "" : "px")), l.clearCloneStyle || "" !== c || 0 !== b.indexOf("background") || (i[b] = "inherit"), g && "set" in g && void 0 === (c = g.set(a, c, d)) || (i[b] = c))))
            }
        },
        css: function(a, b, c, d) {
            var e, f, g, h = n.camelCase(b);
            return b = n.cssProps[h] || (n.cssProps[h] = Ma(h) || h), g = n.cssHooks[b] || n.cssHooks[h], g && "get" in g && (e = g.get(a, !0, c)), void 0 === e && (e = Fa(a, b, d)), "normal" === e && b in Ja && (e = Ja[b]), "" === c || c ? (f = parseFloat(e), !0 === c || isFinite(f) ? f || 0 : e) : e
        }
    }), n.each(["height", "width"], function(a, b) {
        n.cssHooks[b] = {
            get: function(a, c, d) {
                return c ? Ha.test(n.css(a, "display")) && 0 === a.offsetWidth ? Da(a, Ia, function() {
                    return Pa(a, b, d)
                }) : Pa(a, b, d) : void 0
            },
            set: function(a, c, d) {
                var e, f = d && Ca(a),
                    g = d && Oa(a, b, d, "border-box" === n.css(a, "boxSizing", !1, f), f);
                return g && (e = T.exec(c)) && "px" !== (e[3] || "px") && (a.style[b] = c, c = n.css(a, b)), Na(a, c, g)
            }
        }
    }), n.cssHooks.marginLeft = Ga(l.reliableMarginLeft, function(a, b) {
        return b ? (parseFloat(Fa(a, "marginLeft")) || a.getBoundingClientRect().left - Da(a, { marginLeft: 0 }, function() {
            return a.getBoundingClientRect().left
        })) + "px" : void 0
    }), n.cssHooks.marginRight = Ga(l.reliableMarginRight, function(a, b) {
        return b ? Da(a, { display: "inline-block" }, Fa, [a, "marginRight"]) : void 0
    }), n.each({ margin: "", padding: "", border: "Width" }, function(a, b) {
        n.cssHooks[a + b] = {
            expand: function(c) {
                for (var d = 0, e = {}, f = "string" == typeof c ? c.split(" ") : [c]; 4 > d; d++) e[a + U[d] + b] = f[d] || f[d - 2] || f[0];
                return e
            }
        }, Aa.test(a) || (n.cssHooks[a + b].set = Na)
    }), n.fn.extend({
        css: function(a, b) {
            return K(this, function(a, b, c) {
                var d, e, f = {},
                    g = 0;
                if (n.isArray(b)) {
                    for (d = Ca(a), e = b.length; e > g; g++) f[b[g]] = n.css(a, b[g], !1, d);
                    return f
                }
                return void 0 !== c ? n.style(a, b, c) : n.css(a, b)
            }, a, b, arguments.length > 1)
        },
        show: function() {
            return Qa(this, !0)
        },
        hide: function() {
            return Qa(this)
        },
        toggle: function(a) {
            return "boolean" == typeof a ? a ? this.show() : this.hide() : this.each(function() {
                V(this) ? n(this).show() : n(this).hide()
            })
        }
    }), n.Tween = Ra, Ra.prototype = {
        constructor: Ra,
        init: function(a, b, c, d, e, f) {
            this.elem = a, this.prop = c, this.easing = e || n.easing._default, this.options = b, this.start = this.now = this.cur(), this.end = d, this.unit = f || (n.cssNumber[c] ? "" : "px")
        },
        cur: function() {
            var a = Ra.propHooks[this.prop];
            return a && a.get ? a.get(this) : Ra.propHooks._default.get(this)
        },
        run: function(a) {
            var b, c = Ra.propHooks[this.prop];
            return this.options.duration ? this.pos = b = n.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : this.pos = b = a, this.now = (this.end - this.start) * b + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), c && c.set ? c.set(this) : Ra.propHooks._default.set(this), this
        }
    }, Ra.prototype.init.prototype = Ra.prototype, Ra.propHooks = {
        _default: {
            get: function(a) {
                var b;
                return 1 !== a.elem.nodeType || null != a.elem[a.prop] && null == a.elem.style[a.prop] ? a.elem[a.prop] : (b = n.css(a.elem, a.prop, ""), b && "auto" !== b ? b : 0)
            },
            set: function(a) {
                n.fx.step[a.prop] ? n.fx.step[a.prop](a) : 1 !== a.elem.nodeType || null == a.elem.style[n.cssProps[a.prop]] && !n.cssHooks[a.prop] ? a.elem[a.prop] = a.now : n.style(a.elem, a.prop, a.now + a.unit)
            }
        }
    }, Ra.propHooks.scrollTop = Ra.propHooks.scrollLeft = {
        set: function(a) {
            a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now)
        }
    }, n.easing = {
        linear: function(a) {
            return a
        },
        swing: function(a) {
            return .5 - Math.cos(a * Math.PI) / 2
        },
        _default: "swing"
    }, n.fx = Ra.prototype.init, n.fx.step = {};
    var Sa, Ta, Ua = /^(?:toggle|show|hide)$/,
        Va = /queueHooks$/;
    n.Animation = n.extend(_a, {
            tweeners: {
                "*": [function(a, b) {
                    var c = this.createTween(a, b);
                    return W(c.elem, a, T.exec(b), c), c
                }]
            },
            tweener: function(a, b) {
                n.isFunction(a) ? (b = a, a = ["*"]) : a = a.match(G);
                for (var c, d = 0, e = a.length; e > d; d++) c = a[d], _a.tweeners[c] = _a.tweeners[c] || [], _a.tweeners[c].unshift(b)
            },
            prefilters: [Za],
            prefilter: function(a, b) {
                b ? _a.prefilters.unshift(a) : _a.prefilters.push(a)
            }
        }), n.speed = function(a, b, c) {
            var d = a && "object" == typeof a ? n.extend({}, a) : {
                complete: c || !c && b || n.isFunction(a) && a,
                duration: a,
                easing: c && b || b && !n.isFunction(b) && b
            };
            return d.duration = n.fx.off ? 0 : "number" == typeof d.duration ? d.duration : d.duration in n.fx.speeds ? n.fx.speeds[d.duration] : n.fx.speeds._default, null != d.queue && !0 !== d.queue || (d.queue = "fx"), d.old = d.complete, d.complete = function() {
                n.isFunction(d.old) && d.old.call(this), d.queue && n.dequeue(this, d.queue)
            }, d
        }, n.fn.extend({
            fadeTo: function(a, b, c, d) {
                return this.filter(V).css("opacity", 0).show().end().animate({ opacity: b }, a, c, d)
            },
            animate: function(a, b, c, d) {
                var e = n.isEmptyObject(a),
                    f = n.speed(b, c, d),
                    g = function() {
                        var b = _a(this, n.extend({}, a), f);
                        (e || N.get(this, "finish")) && b.stop(!0)
                    };
                return g.finish = g, e || !1 === f.queue ? this.each(g) : this.queue(f.queue, g)
            },
            stop: function(a, b, c) {
                var d = function(a) {
                    var b = a.stop;
                    delete a.stop, b(c)
                };
                return "string" != typeof a && (c = b, b = a, a = void 0), b && !1 !== a && this.queue(a || "fx", []), this.each(function() {
                    var b = !0,
                        e = null != a && a + "queueHooks",
                        f = n.timers,
                        g = N.get(this);
                    if (e) g[e] && g[e].stop && d(g[e]);
                    else
                        for (e in g) g[e] && g[e].stop && Va.test(e) && d(g[e]);
                    for (e = f.length; e--;) f[e].elem !== this || null != a && f[e].queue !== a || (f[e].anim.stop(c), b = !1, f.splice(e, 1));
                    !b && c || n.dequeue(this, a)
                })
            },
            finish: function(a) {
                return !1 !== a && (a = a || "fx"), this.each(function() {
                    var b, c = N.get(this),
                        d = c[a + "queue"],
                        e = c[a + "queueHooks"],
                        f = n.timers,
                        g = d ? d.length : 0;
                    for (c.finish = !0, n.queue(this, a, []), e && e.stop && e.stop.call(this, !0), b = f.length; b--;) f[b].elem === this && f[b].queue === a && (f[b].anim.stop(!0), f.splice(b, 1));
                    for (b = 0; g > b; b++) d[b] && d[b].finish && d[b].finish.call(this);
                    delete c.finish
                })
            }
        }), n.each(["toggle", "show", "hide"], function(a, b) {
            var c = n.fn[b];
            n.fn[b] = function(a, d, e) {
                return null == a || "boolean" == typeof a ? c.apply(this, arguments) : this.animate(Xa(b, !0), a, d, e)
            }
        }), n.each({
            slideDown: Xa("show"),
            slideUp: Xa("hide"),
            slideToggle: Xa("toggle"),
            fadeIn: { opacity: "show" },
            fadeOut: { opacity: "hide" },
            fadeToggle: { opacity: "toggle" }
        }, function(a, b) {
            n.fn[a] = function(a, c, d) {
                return this.animate(b, a, c, d)
            }
        }), n.timers = [], n.fx.tick = function() {
            var a, b = 0,
                c = n.timers;
            for (Sa = n.now(); b < c.length; b++)(a = c[b])() || c[b] !== a || c.splice(b--, 1);
            c.length || n.fx.stop(), Sa = void 0
        }, n.fx.timer = function(a) {
            n.timers.push(a), a() ? n.fx.start() : n.timers.pop()
        }, n.fx.interval = 13, n.fx.start = function() {
            Ta || (Ta = a.setInterval(n.fx.tick, n.fx.interval))
        }, n.fx.stop = function() {
            a.clearInterval(Ta), Ta = null
        }, n.fx.speeds = { slow: 600, fast: 200, _default: 400 }, n.fn.delay = function(b, c) {
            return b = n.fx ? n.fx.speeds[b] || b : b, c = c || "fx", this.queue(c, function(c, d) {
                var e = a.setTimeout(c, b);
                d.stop = function() {
                    a.clearTimeout(e)
                }
            })
        },
        function() {
            var a = d.createElement("input"),
                b = d.createElement("select"),
                c = b.appendChild(d.createElement("option"));
            a.type = "checkbox", l.checkOn = "" !== a.value, l.optSelected = c.selected, b.disabled = !0, l.optDisabled = !c.disabled, a = d.createElement("input"), a.value = "t", a.type = "radio", l.radioValue = "t" === a.value
        }();
    var ab, bb = n.expr.attrHandle;
    n.fn.extend({
        attr: function(a, b) {
            return K(this, n.attr, a, b, arguments.length > 1)
        },
        removeAttr: function(a) {
            return this.each(function() {
                n.removeAttr(this, a)
            })
        }
    }), n.extend({
        attr: function(a, b, c) {
            var d, e, f = a.nodeType;
            if (3 !== f && 8 !== f && 2 !== f) return void 0 === a.getAttribute ? n.prop(a, b, c) : (1 === f && n.isXMLDoc(a) || (b = b.toLowerCase(), e = n.attrHooks[b] || (n.expr.match.bool.test(b) ? ab : void 0)), void 0 !== c ? null === c ? void n.removeAttr(a, b) : e && "set" in e && void 0 !== (d = e.set(a, c, b)) ? d : (a.setAttribute(b, c + ""), c) : e && "get" in e && null !== (d = e.get(a, b)) ? d : (d = n.find.attr(a, b), null == d ? void 0 : d))
        },
        attrHooks: {
            type: {
                set: function(a, b) {
                    if (!l.radioValue && "radio" === b && n.nodeName(a, "input")) {
                        var c = a.value;
                        return a.setAttribute("type", b), c && (a.value = c), b
                    }
                }
            }
        },
        removeAttr: function(a, b) {
            var c, d, e = 0,
                f = b && b.match(G);
            if (f && 1 === a.nodeType)
                for (; c = f[e++];) d = n.propFix[c] || c, n.expr.match.bool.test(c) && (a[d] = !1), a.removeAttribute(c)
        }
    }), ab = {
        set: function(a, b, c) {
            return !1 === b ? n.removeAttr(a, c) : a.setAttribute(c, c), c
        }
    }, n.each(n.expr.match.bool.source.match(/\w+/g), function(a, b) {
        var c = bb[b] || n.find.attr;
        bb[b] = function(a, b, d) {
            var e, f;
            return d || (f = bb[b], bb[b] = e, e = null != c(a, b, d) ? b.toLowerCase() : null, bb[b] = f), e
        }
    });
    var cb = /^(?:input|select|textarea|button)$/i,
        db = /^(?:a|area)$/i;
    n.fn.extend({
        prop: function(a, b) {
            return K(this, n.prop, a, b, arguments.length > 1)
        },
        removeProp: function(a) {
            return this.each(function() {
                delete this[n.propFix[a] || a]
            })
        }
    }), n.extend({
        prop: function(a, b, c) {
            var d, e, f = a.nodeType;
            if (3 !== f && 8 !== f && 2 !== f) return 1 === f && n.isXMLDoc(a) || (b = n.propFix[b] || b, e = n.propHooks[b]), void 0 !== c ? e && "set" in e && void 0 !== (d = e.set(a, c, b)) ? d : a[b] = c : e && "get" in e && null !== (d = e.get(a, b)) ? d : a[b]
        },
        propHooks: {
            tabIndex: {
                get: function(a) {
                    var b = n.find.attr(a, "tabindex");
                    return b ? parseInt(b, 10) : cb.test(a.nodeName) || db.test(a.nodeName) && a.href ? 0 : -1
                }
            }
        },
        propFix: { for: "htmlFor", class: "className" }
    }), l.optSelected || (n.propHooks.selected = {
        get: function(a) {
            var b = a.parentNode;
            return b && b.parentNode && b.parentNode.selectedIndex, null
        },
        set: function(a) {
            var b = a.parentNode;
            b && (b.selectedIndex, b.parentNode && b.parentNode.selectedIndex)
        }
    }), n.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
        n.propFix[this.toLowerCase()] = this
    });
    var eb = /[\t\r\n\f]/g;
    n.fn.extend({
        addClass: function(a) {
            var b, c, d, e, f, g, h, i = 0;
            if (n.isFunction(a)) return this.each(function(b) {
                n(this).addClass(a.call(this, b, fb(this)))
            });
            if ("string" == typeof a && a)
                for (b = a.match(G) || []; c = this[i++];)
                    if (e = fb(c), d = 1 === c.nodeType && (" " + e + " ").replace(eb, " ")) {
                        for (g = 0; f = b[g++];) d.indexOf(" " + f + " ") < 0 && (d += f + " ");
                        h = n.trim(d), e !== h && c.setAttribute("class", h)
                    }
            return this
        },
        removeClass: function(a) {
            var b, c, d, e, f, g, h, i = 0;
            if (n.isFunction(a)) return this.each(function(b) {
                n(this).removeClass(a.call(this, b, fb(this)))
            });
            if (!arguments.length) return this.attr("class", "");
            if ("string" == typeof a && a)
                for (b = a.match(G) || []; c = this[i++];)
                    if (e = fb(c), d = 1 === c.nodeType && (" " + e + " ").replace(eb, " ")) {
                        for (g = 0; f = b[g++];)
                            for (; d.indexOf(" " + f + " ") > -1;) d = d.replace(" " + f + " ", " ");
                        h = n.trim(d), e !== h && c.setAttribute("class", h)
                    }
            return this
        },
        toggleClass: function(a, b) {
            var c = typeof a;
            return "boolean" == typeof b && "string" === c ? b ? this.addClass(a) : this.removeClass(a) : n.isFunction(a) ? this.each(function(c) {
                n(this).toggleClass(a.call(this, c, fb(this), b), b)
            }) : this.each(function() {
                var b, d, e, f;
                if ("string" === c)
                    for (d = 0, e = n(this), f = a.match(G) || []; b = f[d++];) e.hasClass(b) ? e.removeClass(b) : e.addClass(b);
                else void 0 !== a && "boolean" !== c || (b = fb(this), b && N.set(this, "__className__", b), this.setAttribute && this.setAttribute("class", b || !1 === a ? "" : N.get(this, "__className__") || ""))
            })
        },
        hasClass: function(a) {
            var b, c, d = 0;
            for (b = " " + a + " "; c = this[d++];)
                if (1 === c.nodeType && (" " + fb(c) + " ").replace(eb, " ").indexOf(b) > -1) return !0;
            return !1
        }
    });
    var gb = /\r/g,
        hb = /[\x20\t\r\n\f]+/g;
    n.fn.extend({
        val: function(a) {
            var b, c, d, e = this[0];
            return arguments.length ? (d = n.isFunction(a), this.each(function(c) {
                var e;
                1 === this.nodeType && (e = d ? a.call(this, c, n(this).val()) : a, null == e ? e = "" : "number" == typeof e ? e += "" : n.isArray(e) && (e = n.map(e, function(a) {
                    return null == a ? "" : a + ""
                })), (b = n.valHooks[this.type] || n.valHooks[this.nodeName.toLowerCase()]) && "set" in b && void 0 !== b.set(this, e, "value") || (this.value = e))
            })) : e ? (b = n.valHooks[e.type] || n.valHooks[e.nodeName.toLowerCase()], b && "get" in b && void 0 !== (c = b.get(e, "value")) ? c : (c = e.value, "string" == typeof c ? c.replace(gb, "") : null == c ? "" : c)) : void 0
        }
    }), n.extend({
        valHooks: {
            option: {
                get: function(a) {
                    var b = n.find.attr(a, "value");
                    return null != b ? b : n.trim(n.text(a)).replace(hb, " ")
                }
            },
            select: {
                get: function(a) {
                    for (var b, c, d = a.options, e = a.selectedIndex, f = "select-one" === a.type || 0 > e, g = f ? null : [], h = f ? e + 1 : d.length, i = 0 > e ? h : f ? e : 0; h > i; i++)
                        if (c = d[i], (c.selected || i === e) && (l.optDisabled ? !c.disabled : null === c.getAttribute("disabled")) && (!c.parentNode.disabled || !n.nodeName(c.parentNode, "optgroup"))) {
                            if (b = n(c).val(), f) return b;
                            g.push(b)
                        }
                    return g
                },
                set: function(a, b) {
                    for (var c, d, e = a.options, f = n.makeArray(b), g = e.length; g--;) d = e[g], (d.selected = n.inArray(n.valHooks.option.get(d), f) > -1) && (c = !0);
                    return c || (a.selectedIndex = -1), f
                }
            }
        }
    }), n.each(["radio", "checkbox"], function() {
        n.valHooks[this] = {
            set: function(a, b) {
                return n.isArray(b) ? a.checked = n.inArray(n(a).val(), b) > -1 : void 0
            }
        }, l.checkOn || (n.valHooks[this].get = function(a) {
            return null === a.getAttribute("value") ? "on" : a.value
        })
    });
    var ib = /^(?:focusinfocus|focusoutblur)$/;
    n.extend(n.event, {
        trigger: function(b, c, e, f) {
            var g, h, i, j, l, m, o, p = [e || d],
                q = k.call(b, "type") ? b.type : b,
                r = k.call(b, "namespace") ? b.namespace.split(".") : [];
            if (h = i = e = e || d, 3 !== e.nodeType && 8 !== e.nodeType && !ib.test(q + n.event.triggered) && (q.indexOf(".") > -1 && (r = q.split("."), q = r.shift(), r.sort()), l = q.indexOf(":") < 0 && "on" + q, b = b[n.expando] ? b : new n.Event(q, "object" == typeof b && b), b.isTrigger = f ? 2 : 3, b.namespace = r.join("."), b.rnamespace = b.namespace ? new RegExp("(^|\\.)" + r.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, b.result = void 0, b.target || (b.target = e), c = null == c ? [b] : n.makeArray(c, [b]), o = n.event.special[q] || {}, f || !o.trigger || !1 !== o.trigger.apply(e, c))) {
                if (!f && !o.noBubble && !n.isWindow(e)) {
                    for (j = o.delegateType || q, ib.test(j + q) || (h = h.parentNode); h; h = h.parentNode) p.push(h), i = h;
                    i === (e.ownerDocument || d) && p.push(i.defaultView || i.parentWindow || a)
                }
                for (g = 0;
                    (h = p[g++]) && !b.isPropagationStopped();) b.type = g > 1 ? j : o.bindType || q, m = (N.get(h, "events") || {})[b.type] && N.get(h, "handle"), m && m.apply(h, c), (m = l && h[l]) && m.apply && L(h) && (b.result = m.apply(h, c), !1 === b.result && b.preventDefault());
                return b.type = q, f || b.isDefaultPrevented() || o._default && !1 !== o._default.apply(p.pop(), c) || !L(e) || l && n.isFunction(e[q]) && !n.isWindow(e) && (i = e[l], i && (e[l] = null), n.event.triggered = q, e[q](), n.event.triggered = void 0, i && (e[l] = i)), b.result
            }
        },
        simulate: function(a, b, c) {
            var d = n.extend(new n.Event, c, { type: a, isSimulated: !0 });
            n.event.trigger(d, null, b)
        }
    }), n.fn.extend({
        trigger: function(a, b) {
            return this.each(function() {
                n.event.trigger(a, b, this)
            })
        },
        triggerHandler: function(a, b) {
            var c = this[0];
            return c ? n.event.trigger(a, b, c, !0) : void 0
        }
    }), n.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(a, b) {
        n.fn[b] = function(a, c) {
            return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b)
        }
    }), n.fn.extend({
        hover: function(a, b) {
            return this.mouseenter(a).mouseleave(b || a)
        }
    }), l.focusin = "onfocusin" in a, l.focusin || n.each({ focus: "focusin", blur: "focusout" }, function(a, b) {
        var c = function(a) {
            n.event.simulate(b, a.target, n.event.fix(a))
        };
        n.event.special[b] = {
            setup: function() {
                var d = this.ownerDocument || this,
                    e = N.access(d, b);
                e || d.addEventListener(a, c, !0), N.access(d, b, (e || 0) + 1)
            },
            teardown: function() {
                var d = this.ownerDocument || this,
                    e = N.access(d, b) - 1;
                e ? N.access(d, b, e) : (d.removeEventListener(a, c, !0), N.remove(d, b))
            }
        }
    });
    var jb = a.location,
        kb = n.now(),
        lb = /\?/;
    n.parseJSON = function(a) {
        return JSON.parse(a + "")
    }, n.parseXML = function(b) {
        var c;
        if (!b || "string" != typeof b) return null;
        try {
            c = (new a.DOMParser).parseFromString(b, "text/xml")
        } catch (d) {
            c = void 0
        }
        return c && !c.getElementsByTagName("parsererror").length || n.error("Invalid XML: " + b), c
    };
    var mb = /#.*$/,
        nb = /([?&])_=[^&]*/,
        ob = /^(.*?):[ \t]*([^\r\n]*)$/gm,
        pb = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
        qb = /^(?:GET|HEAD)$/,
        rb = /^\/\//,
        sb = {},
        tb = {},
        ub = "*/".concat("*"),
        vb = d.createElement("a");
    vb.href = jb.href, n.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: jb.href,
            type: "GET",
            isLocal: pb.test(jb.protocol),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": ub,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: { xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/ },
            responseFields: { xml: "responseXML", text: "responseText", json: "responseJSON" },
            converters: { "* text": String, "text html": !0, "text json": n.parseJSON, "text xml": n.parseXML },
            flatOptions: { url: !0, context: !0 }
        },
        ajaxSetup: function(a, b) {
            return b ? yb(yb(a, n.ajaxSettings), b) : yb(n.ajaxSettings, a)
        },
        ajaxPrefilter: wb(sb),
        ajaxTransport: wb(tb),
        ajax: function(b, c) {
            function z(b, c, d, h) {
                var j, l, t, u, w, y = c;
                2 !== v && (v = 2, i && a.clearTimeout(i), e = void 0, g = h || "", x.readyState = b > 0 ? 4 : 0, j = b >= 200 && 300 > b || 304 === b, d && (u = zb(m, x, d)), u = Ab(m, u, x, j), j ? (m.ifModified && (w = x.getResponseHeader("Last-Modified"), w && (n.lastModified[f] = w), (w = x.getResponseHeader("etag")) && (n.etag[f] = w)), 204 === b || "HEAD" === m.type ? y = "nocontent" : 304 === b ? y = "notmodified" : (y = u.state, l = u.data, t = u.error, j = !t)) : (t = y, !b && y || (y = "error", 0 > b && (b = 0))), x.status = b, x.statusText = (c || y) + "", j ? q.resolveWith(o, [l, y, x]) : q.rejectWith(o, [x, y, t]), x.statusCode(s), s = void 0, k && p.trigger(j ? "ajaxSuccess" : "ajaxError", [x, m, j ? l : t]), r.fireWith(o, [x, y]), k && (p.trigger("ajaxComplete", [x, m]), --n.active || n.event.trigger("ajaxStop")))
            }

            "object" == typeof b && (c = b, b = void 0), c = c || {};
            var e, f, g, h, i, j, k, l, m = n.ajaxSetup({}, c),
                o = m.context || m,
                p = m.context && (o.nodeType || o.jquery) ? n(o) : n.event,
                q = n.Deferred(),
                r = n.Callbacks("once memory"),
                s = m.statusCode || {},
                t = {},
                u = {},
                v = 0,
                w = "canceled",
                x = {
                    readyState: 0,
                    getResponseHeader: function(a) {
                        var b;
                        if (2 === v) {
                            if (!h)
                                for (h = {}; b = ob.exec(g);) h[b[1].toLowerCase()] = b[2];
                            b = h[a.toLowerCase()]
                        }
                        return null == b ? null : b
                    },
                    getAllResponseHeaders: function() {
                        return 2 === v ? g : null
                    },
                    setRequestHeader: function(a, b) {
                        var c = a.toLowerCase();
                        return v || (a = u[c] = u[c] || a, t[a] = b), this
                    },
                    overrideMimeType: function(a) {
                        return v || (m.mimeType = a), this
                    },
                    statusCode: function(a) {
                        var b;
                        if (a)
                            if (2 > v)
                                for (b in a) s[b] = [s[b], a[b]];
                            else x.always(a[x.status]);
                        return this
                    },
                    abort: function(a) {
                        var b = a || w;
                        return e && e.abort(b), z(0, b), this
                    }
                };
            if (q.promise(x).complete = r.add, x.success = x.done, x.error = x.fail, m.url = ((b || m.url || jb.href) + "").replace(mb, "").replace(rb, jb.protocol + "//"), m.type = c.method || c.type || m.method || m.type, m.dataTypes = n.trim(m.dataType || "*").toLowerCase().match(G) || [""], null == m.crossDomain) {
                j = d.createElement("a");
                try {
                    j.href = m.url, j.href = j.href, m.crossDomain = vb.protocol + "//" + vb.host != j.protocol + "//" + j.host
                } catch (y) {
                    m.crossDomain = !0
                }
            }
            if (m.data && m.processData && "string" != typeof m.data && (m.data = n.param(m.data, m.traditional)), xb(sb, m, c, x), 2 === v) return x;
            k = n.event && m.global, k && 0 == n.active++ && n.event.trigger("ajaxStart"), m.type = m.type.toUpperCase(), m.hasContent = !qb.test(m.type), f = m.url, m.hasContent || (m.data && (f = m.url += (lb.test(f) ? "&" : "?") + m.data, delete m.data), !1 === m.cache && (m.url = nb.test(f) ? f.replace(nb, "$1_=" + kb++) : f + (lb.test(f) ? "&" : "?") + "_=" + kb++)), m.ifModified && (n.lastModified[f] && x.setRequestHeader("If-Modified-Since", n.lastModified[f]), n.etag[f] && x.setRequestHeader("If-None-Match", n.etag[f])), (m.data && m.hasContent && !1 !== m.contentType || c.contentType) && x.setRequestHeader("Content-Type", m.contentType), x.setRequestHeader("Accept", m.dataTypes[0] && m.accepts[m.dataTypes[0]] ? m.accepts[m.dataTypes[0]] + ("*" !== m.dataTypes[0] ? ", " + ub + "; q=0.01" : "") : m.accepts["*"]);
            for (l in m.headers) x.setRequestHeader(l, m.headers[l]);
            if (m.beforeSend && (!1 === m.beforeSend.call(o, x, m) || 2 === v)) return x.abort();
            w = "abort";
            for (l in { success: 1, error: 1, complete: 1 }) x[l](m[l]);
            if (e = xb(tb, m, c, x)) {
                if (x.readyState = 1, k && p.trigger("ajaxSend", [x, m]), 2 === v) return x;
                m.async && m.timeout > 0 && (i = a.setTimeout(function() {
                    x.abort("timeout")
                }, m.timeout));
                try {
                    v = 1, e.send(t, z)
                } catch (y) {
                    if (!(2 > v)) throw y;
                    z(-1, y)
                }
            } else z(-1, "No Transport");
            return x
        },
        getJSON: function(a, b, c) {
            return n.get(a, b, c, "json")
        },
        getScript: function(a, b) {
            return n.get(a, void 0, b, "script")
        }
    }), n.each(["get", "post"], function(a, b) {
        n[b] = function(a, c, d, e) {
            return n.isFunction(c) && (e = e || d, d = c, c = void 0), n.ajax(n.extend({
                url: a,
                type: b,
                dataType: e,
                data: c,
                success: d
            }, n.isPlainObject(a) && a))
        }
    }), n._evalUrl = function(a) {
        return n.ajax({ url: a, type: "GET", dataType: "script", async: !1, global: !1, throws: !0 })
    }, n.fn.extend({
        wrapAll: function(a) {
            var b;
            return n.isFunction(a) ? this.each(function(b) {
                n(this).wrapAll(a.call(this, b))
            }) : (this[0] && (b = n(a, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && b.insertBefore(this[0]), b.map(function() {
                for (var a = this; a.firstElementChild;) a = a.firstElementChild;
                return a
            }).append(this)), this)
        },
        wrapInner: function(a) {
            return n.isFunction(a) ? this.each(function(b) {
                n(this).wrapInner(a.call(this, b))
            }) : this.each(function() {
                var b = n(this),
                    c = b.contents();
                c.length ? c.wrapAll(a) : b.append(a)
            })
        },
        wrap: function(a) {
            var b = n.isFunction(a);
            return this.each(function(c) {
                n(this).wrapAll(b ? a.call(this, c) : a)
            })
        },
        unwrap: function() {
            return this.parent().each(function() {
                n.nodeName(this, "body") || n(this).replaceWith(this.childNodes)
            }).end()
        }
    }), n.expr.filters.hidden = function(a) {
        return !n.expr.filters.visible(a)
    }, n.expr.filters.visible = function(a) {
        return a.offsetWidth > 0 || a.offsetHeight > 0 || a.getClientRects().length > 0
    };
    var Bb = /%20/g,
        Cb = /\[\]$/,
        Db = /\r?\n/g,
        Eb = /^(?:submit|button|image|reset|file)$/i,
        Fb = /^(?:input|select|textarea|keygen)/i;
    n.param = function(a, b) {
        var c, d = [],
            e = function(a, b) {
                b = n.isFunction(b) ? b() : null == b ? "" : b, d[d.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b)
            };
        if (void 0 === b && (b = n.ajaxSettings && n.ajaxSettings.traditional), n.isArray(a) || a.jquery && !n.isPlainObject(a)) n.each(a, function() {
            e(this.name, this.value)
        });
        else
            for (c in a) Gb(c, a[c], b, e);
        return d.join("&").replace(Bb, "+")
    }, n.fn.extend({
        serialize: function() {
            return n.param(this.serializeArray())
        },
        serializeArray: function() {
            return this.map(function() {
                var a = n.prop(this, "elements");
                return a ? n.makeArray(a) : this
            }).filter(function() {
                var a = this.type;
                return this.name && !n(this).is(":disabled") && Fb.test(this.nodeName) && !Eb.test(a) && (this.checked || !X.test(a))
            }).map(function(a, b) {
                var c = n(this).val();
                return null == c ? null : n.isArray(c) ? n.map(c, function(a) {
                    return { name: b.name, value: a.replace(Db, "\r\n") }
                }) : { name: b.name, value: c.replace(Db, "\r\n") }
            }).get()
        }
    }), n.ajaxSettings.xhr = function() {
        try {
            return new a.XMLHttpRequest
        } catch (b) {}
    };
    var Hb = { 0: 200, 1223: 204 },
        Ib = n.ajaxSettings.xhr();
    l.cors = !!Ib && "withCredentials" in Ib, l.ajax = Ib = !!Ib, n.ajaxTransport(function(b) {
        var c, d;
        return l.cors || Ib && !b.crossDomain ? {
            send: function(e, f) {
                var g, h = b.xhr();
                if (h.open(b.type, b.url, b.async, b.username, b.password), b.xhrFields)
                    for (g in b.xhrFields) h[g] = b.xhrFields[g];
                b.mimeType && h.overrideMimeType && h.overrideMimeType(b.mimeType), b.crossDomain || e["X-Requested-With"] || (e["X-Requested-With"] = "XMLHttpRequest");
                for (g in e) h.setRequestHeader(g, e[g]);
                c = function(a) {
                    return function() {
                        c && (c = d = h.onload = h.onerror = h.onabort = h.onreadystatechange = null, "abort" === a ? h.abort() : "error" === a ? "number" != typeof h.status ? f(0, "error") : f(h.status, h.statusText) : f(Hb[h.status] || h.status, h.statusText, "text" !== (h.responseType || "text") || "string" != typeof h.responseText ? { binary: h.response } : { text: h.responseText }, h.getAllResponseHeaders()))
                    }
                }, h.onload = c(), d = h.onerror = c("error"), void 0 !== h.onabort ? h.onabort = d : h.onreadystatechange = function() {
                    4 === h.readyState && a.setTimeout(function() {
                        c && d()
                    })
                }, c = c("abort");
                try {
                    h.send(b.hasContent && b.data || null)
                } catch (i) {
                    if (c) throw i
                }
            },
            abort: function() {
                c && c()
            }
        } : void 0
    }), n.ajaxSetup({
        accepts: { script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript" },
        contents: { script: /\b(?:java|ecma)script\b/ },
        converters: {
            "text script": function(a) {
                return n.globalEval(a), a
            }
        }
    }), n.ajaxPrefilter("script", function(a) {
        void 0 === a.cache && (a.cache = !1), a.crossDomain && (a.type = "GET")
    }), n.ajaxTransport("script", function(a) {
        if (a.crossDomain) {
            var b, c;
            return {
                send: function(e, f) {
                    b = n("<script>").prop({ charset: a.scriptCharset, src: a.url }).on("load error", c = function(a) {
                        b.remove(), c = null, a && f("error" === a.type ? 404 : 200, a.type)
                    }), d.head.appendChild(b[0])
                },
                abort: function() {
                    c && c()
                }
            }
        }
    });
    var Jb = [],
        Kb = /(=)\?(?=&|$)|\?\?/;
    n.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var a = Jb.pop() || n.expando + "_" + kb++;
            return this[a] = !0, a
        }
    }), n.ajaxPrefilter("json jsonp", function(b, c, d) {
        var e, f, g,
            h = !1 !== b.jsonp && (Kb.test(b.url) ? "url" : "string" == typeof b.data && 0 === (b.contentType || "").indexOf("application/x-www-form-urlencoded") && Kb.test(b.data) && "data");
        return h || "jsonp" === b.dataTypes[0] ? (e = b.jsonpCallback = n.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, h ? b[h] = b[h].replace(Kb, "$1" + e) : !1 !== b.jsonp && (b.url += (lb.test(b.url) ? "&" : "?") + b.jsonp + "=" + e), b.converters["script json"] = function() {
            return g || n.error(e + " was not called"), g[0]
        }, b.dataTypes[0] = "json", f = a[e], a[e] = function() {
            g = arguments
        }, d.always(function() {
            void 0 === f ? n(a).removeProp(e) : a[e] = f, b[e] && (b.jsonpCallback = c.jsonpCallback, Jb.push(e)), g && n.isFunction(f) && f(g[0]), g = f = void 0
        }), "script") : void 0
    }), n.parseHTML = function(a, b, c) {
        if (!a || "string" != typeof a) return null;
        "boolean" == typeof b && (c = b, b = !1), b = b || d;
        var e = x.exec(a),
            f = !c && [];
        return e ? [b.createElement(e[1])] : (e = ca([a], b, f), f && f.length && n(f).remove(), n.merge([], e.childNodes))
    };
    var Lb = n.fn.load;
    n.fn.load = function(a, b, c) {
        if ("string" != typeof a && Lb) return Lb.apply(this, arguments);
        var d, e, f, g = this,
            h = a.indexOf(" ");
        return h > -1 && (d = n.trim(a.slice(h)), a = a.slice(0, h)), n.isFunction(b) ? (c = b, b = void 0) : b && "object" == typeof b && (e = "POST"), g.length > 0 && n.ajax({
            url: a,
            type: e || "GET",
            dataType: "html",
            data: b
        }).done(function(a) {
            f = arguments, g.html(d ? n("<div>").append(n.parseHTML(a)).find(d) : a)
        }).always(c && function(a, b) {
            g.each(function() {
                c.apply(this, f || [a.responseText, b, a])
            })
        }), this
    }, n.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(a, b) {
        n.fn[b] = function(a) {
            return this.on(b, a)
        }
    }), n.expr.filters.animated = function(a) {
        return n.grep(n.timers, function(b) {
            return a === b.elem
        }).length
    }, n.offset = {
        setOffset: function(a, b, c) {
            var d, e, f, g, h, i, j, k = n.css(a, "position"),
                l = n(a),
                m = {};
            "static" === k && (a.style.position = "relative"), h = l.offset(), f = n.css(a, "top"), i = n.css(a, "left"), j = ("absolute" === k || "fixed" === k) && (f + i).indexOf("auto") > -1, j ? (d = l.position(), g = d.top, e = d.left) : (g = parseFloat(f) || 0, e = parseFloat(i) || 0), n.isFunction(b) && (b = b.call(a, c, n.extend({}, h))), null != b.top && (m.top = b.top - h.top + g), null != b.left && (m.left = b.left - h.left + e), "using" in b ? b.using.call(a, m) : l.css(m)
        }
    }, n.fn.extend({
        offset: function(a) {
            if (arguments.length) return void 0 === a ? this : this.each(function(b) {
                n.offset.setOffset(this, a, b)
            });
            var b, c, d = this[0],
                e = { top: 0, left: 0 },
                f = d && d.ownerDocument;
            return f ? (b = f.documentElement, n.contains(b, d) ? (e = d.getBoundingClientRect(), c = Mb(f), {
                top: e.top + c.pageYOffset - b.clientTop,
                left: e.left + c.pageXOffset - b.clientLeft
            }) : e) : void 0
        },
        position: function() {
            if (this[0]) {
                var a, b, c = this[0],
                    d = { top: 0, left: 0 };
                return "fixed" === n.css(c, "position") ? b = c.getBoundingClientRect() : (a = this.offsetParent(), b = this.offset(), n.nodeName(a[0], "html") || (d = a.offset()), d.top += n.css(a[0], "borderTopWidth", !0), d.left += n.css(a[0], "borderLeftWidth", !0)), {
                    top: b.top - d.top - n.css(c, "marginTop", !0),
                    left: b.left - d.left - n.css(c, "marginLeft", !0)
                }
            }
        },
        offsetParent: function() {
            return this.map(function() {
                for (var a = this.offsetParent; a && "static" === n.css(a, "position");) a = a.offsetParent;
                return a || Ea
            })
        }
    }), n.each({ scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function(a, b) {
        var c = "pageYOffset" === b;
        n.fn[a] = function(d) {
            return K(this, function(a, d, e) {
                var f = Mb(a);
                return void 0 === e ? f ? f[b] : a[d] : void(f ? f.scrollTo(c ? f.pageXOffset : e, c ? e : f.pageYOffset) : a[d] = e)
            }, a, d, arguments.length)
        }
    }), n.each(["top", "left"], function(a, b) {
        n.cssHooks[b] = Ga(l.pixelPosition, function(a, c) {
            return c ? (c = Fa(a, b), Ba.test(c) ? n(a).position()[b] + "px" : c) : void 0
        })
    }), n.each({ Height: "height", Width: "width" }, function(a, b) {
        n.each({ padding: "inner" + a, content: b, "": "outer" + a }, function(c, d) {
            n.fn[d] = function(d, e) {
                var f = arguments.length && (c || "boolean" != typeof d),
                    g = c || (!0 === d || !0 === e ? "margin" : "border");
                return K(this, function(b, c, d) {
                    var e;
                    return n.isWindow(b) ? b.document.documentElement["client" + a] : 9 === b.nodeType ? (e = b.documentElement, Math.max(b.body["scroll" + a], e["scroll" + a], b.body["offset" + a], e["offset" + a], e["client" + a])) : void 0 === d ? n.css(b, c, g) : n.style(b, c, d, g)
                }, b, f ? d : void 0, f, null)
            }
        })
    }), n.fn.extend({
        bind: function(a, b, c) {
            return this.on(a, null, b, c)
        },
        unbind: function(a, b) {
            return this.off(a, null, b)
        },
        delegate: function(a, b, c, d) {
            return this.on(b, a, c, d)
        },
        undelegate: function(a, b, c) {
            return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c)
        },
        size: function() {
            return this.length
        }
    }), n.fn.andSelf = n.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function() {
        return n
    });
    var Nb = a.jQuery,
        Ob = a.$;
    return n.noConflict = function(b) {
        return a.$ === n && (a.$ = Ob), b && a.jQuery === n && (a.jQuery = Nb), n
    }, b || (a.jQuery = a.$ = n), n
}),
function(e, t) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : e.Popper = t()
}(this, function() {
    "use strict";

    function e(e) {
        return e && "[object Function]" === {}.toString.call(e)
    }

    function t(e, t) {
        if (1 !== e.nodeType) return [];
        var o = getComputedStyle(e, null);
        return t ? o[t] : o
    }

    function o(e) {
        return "HTML" === e.nodeName ? e : e.parentNode || e.host
    }

    function n(e) {
        if (!e) return document.body;
        switch (e.nodeName) {
            case "HTML":
            case "BODY":
                return e.ownerDocument.body;
            case "#document":
                return e.body
        }
        var i = t(e),
            r = i.overflow,
            p = i.overflowX;
        return /(auto|scroll)/.test(r + i.overflowY + p) ? e : n(o(e))
    }

    function r(e) {
        var o = e && e.offsetParent,
            i = o && o.nodeName;
        return i && "BODY" !== i && "HTML" !== i ? -1 !== ["TD", "TABLE"].indexOf(o.nodeName) && "static" === t(o, "position") ? r(o) : o : e ? e.ownerDocument.documentElement : document.documentElement
    }

    function p(e) {
        var t = e.nodeName;
        return "BODY" !== t && ("HTML" === t || r(e.firstElementChild) === e)
    }

    function s(e) {
        return null === e.parentNode ? e : s(e.parentNode)
    }

    function d(e, t) {
        if (!(e && e.nodeType && t && t.nodeType)) return document.documentElement;
        var o = e.compareDocumentPosition(t) & Node.DOCUMENT_POSITION_FOLLOWING,
            i = o ? e : t,
            n = o ? t : e,
            a = document.createRange();
        a.setStart(i, 0), a.setEnd(n, 0);
        var l = a.commonAncestorContainer;
        if (e !== l && t !== l || i.contains(n)) return p(l) ? l : r(l);
        var f = s(e);
        return f.host ? d(f.host, t) : d(e, s(t).host)
    }

    function a(e) {
        var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "top",
            o = "top" === t ? "scrollTop" : "scrollLeft",
            i = e.nodeName;
        if ("BODY" === i || "HTML" === i) {
            var n = e.ownerDocument.documentElement;
            return (e.ownerDocument.scrollingElement || n)[o]
        }
        return e[o]
    }

    function l(e, t) {
        var o = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
            i = a(t, "top"),
            n = a(t, "left"),
            r = o ? -1 : 1;
        return e.top += i * r, e.bottom += i * r, e.left += n * r, e.right += n * r, e
    }

    function f(e, t) {
        var o = "x" === t ? "Left" : "Top",
            i = "Left" == o ? "Right" : "Bottom";
        return parseFloat(e["border" + o + "Width"], 10) + parseFloat(e["border" + i + "Width"], 10)
    }

    function m(e, t, o, i) {
        return J(t["offset" + e], t["scroll" + e], o["client" + e], o["offset" + e], o["scroll" + e], ie() ? o["offset" + e] + i["margin" + ("Height" === e ? "Top" : "Left")] + i["margin" + ("Height" === e ? "Bottom" : "Right")] : 0)
    }

    function h() {
        var e = document.body,
            t = document.documentElement,
            o = ie() && getComputedStyle(t);
        return { height: m("Height", e, t, o), width: m("Width", e, t, o) }
    }

    function c(e) {
        return se({}, e, { right: e.left + e.width, bottom: e.top + e.height })
    }

    function g(e) {
        var o = {};
        if (ie()) try {
            o = e.getBoundingClientRect();
            var i = a(e, "top"),
                n = a(e, "left");
            o.top += i, o.left += n, o.bottom += i, o.right += n
        } catch (e) {} else o = e.getBoundingClientRect();
        var r = { left: o.left, top: o.top, width: o.right - o.left, height: o.bottom - o.top },
            p = "HTML" === e.nodeName ? h() : {},
            s = p.width || e.clientWidth || r.right - r.left,
            d = p.height || e.clientHeight || r.bottom - r.top,
            l = e.offsetWidth - s,
            m = e.offsetHeight - d;
        if (l || m) {
            var g = t(e);
            l -= f(g, "x"), m -= f(g, "y"), r.width -= l, r.height -= m
        }
        return c(r)
    }

    function u(e, o) {
        var i = ie(),
            r = "HTML" === o.nodeName,
            p = g(e),
            s = g(o),
            d = n(e),
            a = t(o),
            f = parseFloat(a.borderTopWidth, 10),
            m = parseFloat(a.borderLeftWidth, 10),
            h = c({ top: p.top - s.top - f, left: p.left - s.left - m, width: p.width, height: p.height });
        if (h.marginTop = 0, h.marginLeft = 0, !i && r) {
            var u = parseFloat(a.marginTop, 10),
                b = parseFloat(a.marginLeft, 10);
            h.top -= f - u, h.bottom -= f - u, h.left -= m - b, h.right -= m - b, h.marginTop = u, h.marginLeft = b
        }
        return (i ? o.contains(d) : o === d && "BODY" !== d.nodeName) && (h = l(h, o)), h
    }

    function b(e) {
        var t = e.ownerDocument.documentElement,
            o = u(e, t),
            i = J(t.clientWidth, window.innerWidth || 0),
            n = J(t.clientHeight, window.innerHeight || 0),
            r = a(t),
            p = a(t, "left");
        return c({ top: r - o.top + o.marginTop, left: p - o.left + o.marginLeft, width: i, height: n })
    }

    function w(e) {
        var i = e.nodeName;
        return "BODY" !== i && "HTML" !== i && ("fixed" === t(e, "position") || w(o(e)))
    }

    function y(e, t, i, r) {
        var p = { top: 0, left: 0 },
            s = d(e, t);
        if ("viewport" === r) p = b(s);
        else {
            var a;
            "scrollParent" === r ? (a = n(o(t)), "BODY" === a.nodeName && (a = e.ownerDocument.documentElement)) : a = "window" === r ? e.ownerDocument.documentElement : r;
            var l = u(a, s);
            if ("HTML" !== a.nodeName || w(s)) p = l;
            else {
                var f = h(),
                    m = f.height,
                    c = f.width;
                p.top += l.top - l.marginTop, p.bottom = m + l.top, p.left += l.left - l.marginLeft, p.right = c + l.left
            }
        }
        return p.left += i, p.top += i, p.right -= i, p.bottom -= i, p
    }

    function E(e) {
        return e.width * e.height
    }

    function v(e, t, o, i, n) {
        var r = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 0;
        if (-1 === e.indexOf("auto")) return e;
        var p = y(o, i, r, n),
            s = {
                top: { width: p.width, height: t.top - p.top },
                right: { width: p.right - t.right, height: p.height },
                bottom: { width: p.width, height: p.bottom - t.bottom },
                left: { width: t.left - p.left, height: p.height }
            },
            d = Object.keys(s).map(function(e) {
                return se({ key: e }, s[e], { area: E(s[e]) })
            }).sort(function(e, t) {
                return t.area - e.area
            }),
            a = d.filter(function(e) {
                var t = e.width,
                    i = e.height;
                return t >= o.clientWidth && i >= o.clientHeight
            }),
            l = 0 < a.length ? a[0].key : d[0].key,
            f = e.split("-")[1];
        return l + (f ? "-" + f : "")
    }

    function O(e, t, o) {
        return u(o, d(t, o))
    }

    function L(e) {
        var t = getComputedStyle(e),
            o = parseFloat(t.marginTop) + parseFloat(t.marginBottom),
            i = parseFloat(t.marginLeft) + parseFloat(t.marginRight);
        return { width: e.offsetWidth + i, height: e.offsetHeight + o }
    }

    function x(e) {
        var t = { left: "right", right: "left", bottom: "top", top: "bottom" };
        return e.replace(/left|right|bottom|top/g, function(e) {
            return t[e]
        })
    }

    function S(e, t, o) {
        o = o.split("-")[0];
        var i = L(e),
            n = { width: i.width, height: i.height },
            r = -1 !== ["right", "left"].indexOf(o),
            p = r ? "top" : "left",
            s = r ? "left" : "top",
            d = r ? "height" : "width",
            a = r ? "width" : "height";
        return n[p] = t[p] + t[d] / 2 - i[d] / 2, n[s] = o === s ? t[s] - i[a] : t[x(s)], n
    }

    function T(e, t) {
        return Array.prototype.find ? e.find(t) : e.filter(t)[0]
    }

    function D(e, t, o) {
        if (Array.prototype.findIndex) return e.findIndex(function(e) {
            return e[t] === o
        });
        var i = T(e, function(e) {
            return e[t] === o
        });
        return e.indexOf(i)
    }

    function C(t, o, i) {
        return (void 0 === i ? t : t.slice(0, D(t, "name", i))).forEach(function(t) {
            t.function && console.warn("`modifier.function` is deprecated, use `modifier.fn`!");
            var i = t.function || t.fn;
            t.enabled && e(i) && (o.offsets.popper = c(o.offsets.popper), o.offsets.reference = c(o.offsets.reference), o = i(o, t))
        }), o
    }

    function N() {
        if (!this.state.isDestroyed) {
            var e = { instance: this, styles: {}, arrowStyles: {}, attributes: {}, flipped: !1, offsets: {} };
            e.offsets.reference = O(this.state, this.popper, this.reference), e.placement = v(this.options.placement, e.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding), e.originalPlacement = e.placement, e.offsets.popper = S(this.popper, e.offsets.reference, e.placement), e.offsets.popper.position = "absolute", e = C(this.modifiers, e), this.state.isCreated ? this.options.onUpdate(e) : (this.state.isCreated = !0, this.options.onCreate(e))
        }
    }

    function k(e, t) {
        return e.some(function(e) {
            var o = e.name;
            return e.enabled && o === t
        })
    }

    function W(e) {
        for (var t = [!1, "ms", "Webkit", "Moz", "O"], o = e.charAt(0).toUpperCase() + e.slice(1), n = 0; n < t.length - 1; n++) {
            var i = t[n],
                r = i ? "" + i + o : e;
            if (void 0 !== document.body.style[r]) return r
        }
        return null
    }

    function P() {
        return this.state.isDestroyed = !0, k(this.modifiers, "applyStyle") && (this.popper.removeAttribute("x-placement"), this.popper.style.left = "", this.popper.style.position = "", this.popper.style.top = "", this.popper.style[W("transform")] = ""), this.disableEventListeners(), this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper), this
    }

    function B(e) {
        var t = e.ownerDocument;
        return t ? t.defaultView : window
    }

    function H(e, t, o, i) {
        var r = "BODY" === e.nodeName,
            p = r ? e.ownerDocument.defaultView : e;
        p.addEventListener(t, o, { passive: !0 }), r || H(n(p.parentNode), t, o, i), i.push(p)
    }

    function A(e, t, o, i) {
        o.updateBound = i, B(e).addEventListener("resize", o.updateBound, { passive: !0 });
        var r = n(e);
        return H(r, "scroll", o.updateBound, o.scrollParents), o.scrollElement = r, o.eventsEnabled = !0, o
    }

    function I() {
        this.state.eventsEnabled || (this.state = A(this.reference, this.options, this.state, this.scheduleUpdate))
    }

    function M(e, t) {
        return B(e).removeEventListener("resize", t.updateBound), t.scrollParents.forEach(function(e) {
            e.removeEventListener("scroll", t.updateBound)
        }), t.updateBound = null, t.scrollParents = [], t.scrollElement = null, t.eventsEnabled = !1, t
    }

    function R() {
        this.state.eventsEnabled && (cancelAnimationFrame(this.scheduleUpdate), this.state = M(this.reference, this.state))
    }

    function U(e) {
        return "" !== e && !isNaN(parseFloat(e)) && isFinite(e)
    }

    function Y(e, t) {
        Object.keys(t).forEach(function(o) {
            var i = ""; -
            1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(o) && U(t[o]) && (i = "px"), e.style[o] = t[o] + i
        })
    }

    function j(e, t) {
        Object.keys(t).forEach(function(o) {
            !1 === t[o] ? e.removeAttribute(o) : e.setAttribute(o, t[o])
        })
    }

    function F(e, t, o) {
        var i = T(e, function(e) {
                return e.name === t
            }),
            n = !!i && e.some(function(e) {
                return e.name === o && e.enabled && e.order < i.order
            });
        if (!n) {
            var r = "`" + t + "`";
            console.warn("`" + o + "` modifier is required by " + r + " modifier in order to work, be sure to include it before " + r + "!")
        }
        return n
    }

    function K(e) {
        return "end" === e ? "start" : "start" === e ? "end" : e
    }

    function q(e) {
        var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
            o = ae.indexOf(e),
            i = ae.slice(o + 1).concat(ae.slice(0, o));
        return t ? i.reverse() : i
    }

    function V(e, t, o, i) {
        var n = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
            r = +n[1],
            p = n[2];
        if (!r) return e;
        if (0 === p.indexOf("%")) {
            var s;
            switch (p) {
                case "%p":
                    s = o;
                    break;
                case "%":
                case "%r":
                default:
                    s = i
            }
            return c(s)[t] / 100 * r
        }
        if ("vh" === p || "vw" === p) {
            return ("vh" === p ? J(document.documentElement.clientHeight, window.innerHeight || 0) : J(document.documentElement.clientWidth, window.innerWidth || 0)) / 100 * r
        }
        return r
    }

    function z(e, t, o, i) {
        var n = [0, 0],
            r = -1 !== ["right", "left"].indexOf(i),
            p = e.split(/(\+|\-)/).map(function(e) {
                return e.trim()
            }),
            s = p.indexOf(T(p, function(e) {
                return -1 !== e.search(/,|\s/)
            }));
        p[s] && -1 === p[s].indexOf(",") && console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");
        var d = /\s*,\s*|\s+/,
            a = -1 === s ? [p] : [p.slice(0, s).concat([p[s].split(d)[0]]), [p[s].split(d)[1]].concat(p.slice(s + 1))];
        return a = a.map(function(e, i) {
            var n = (1 === i ? !r : r) ? "height" : "width",
                p = !1;
            return e.reduce(function(e, t) {
                return "" === e[e.length - 1] && -1 !== ["+", "-"].indexOf(t) ? (e[e.length - 1] = t, p = !0, e) : p ? (e[e.length - 1] += t, p = !1, e) : e.concat(t)
            }, []).map(function(e) {
                return V(e, n, t, o)
            })
        }), a.forEach(function(e, t) {
            e.forEach(function(o, i) {
                U(o) && (n[t] += o * ("-" === e[i - 1] ? -1 : 1))
            })
        }), n
    }

    function G(e, t) {
        var o, i = t.offset,
            n = e.placement,
            r = e.offsets,
            p = r.popper,
            s = r.reference,
            d = n.split("-")[0];
        return o = U(+i) ? [+i, 0] : z(i, p, s, d), "left" === d ? (p.top += o[0], p.left -= o[1]) : "right" === d ? (p.top += o[0], p.left += o[1]) : "top" === d ? (p.left += o[0], p.top -= o[1]) : "bottom" === d && (p.left += o[0], p.top += o[1]), e.popper = p, e
    }

    for (var _ = Math.min, X = Math.floor, J = Math.max, Q = "undefined" != typeof window && "undefined" != typeof document, Z = ["Edge", "Trident", "Firefox"], $ = 0, ee = 0; ee < Z.length; ee += 1)
        if (Q && 0 <= navigator.userAgent.indexOf(Z[ee])) {
            $ = 1;
            break
        }
    var i, te = Q && window.Promise,
        oe = te ? function(e) {
            var t = !1;
            return function() {
                t || (t = !0, window.Promise.resolve().then(function() {
                    t = !1, e()
                }))
            }
        } : function(e) {
            var t = !1;
            return function() {
                t || (t = !0,
                    setTimeout(function() {
                        t = !1, e()
                    }, $))
            }
        },
        ie = function() {
            return void 0 == i && (i = -1 !== navigator.appVersion.indexOf("MSIE 10")), i
        },
        ne = function(e, t) {
            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
        },
        re = function() {
            function e(e, t) {
                for (var o, n = 0; n < t.length; n++) o = t[n], o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
            }

            return function(t, o, i) {
                return o && e(t.prototype, o), i && e(t, i), t
            }
        }(),
        pe = function(e, t, o) {
            return t in e ? Object.defineProperty(e, t, {
                value: o,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = o, e
        },
        se = Object.assign || function(e) {
            for (var t, o = 1; o < arguments.length; o++)
                for (var i in t = arguments[o]) Object.prototype.hasOwnProperty.call(t, i) && (e[i] = t[i]);
            return e
        },
        de = ["auto-start", "auto", "auto-end", "top-start", "top", "top-end", "right-start", "right", "right-end", "bottom-end", "bottom", "bottom-start", "left-end", "left", "left-start"],
        ae = de.slice(3),
        le = { FLIP: "flip", CLOCKWISE: "clockwise", COUNTERCLOCKWISE: "counterclockwise" },
        fe = function() {
            function t(o, i) {
                var n = this,
                    r = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {};
                ne(this, t), this.scheduleUpdate = function() {
                    return requestAnimationFrame(n.update)
                }, this.update = oe(this.update.bind(this)), this.options = se({}, t.Defaults, r), this.state = {
                    isDestroyed: !1,
                    isCreated: !1,
                    scrollParents: []
                }, this.reference = o && o.jquery ? o[0] : o, this.popper = i && i.jquery ? i[0] : i, this.options.modifiers = {}, Object.keys(se({}, t.Defaults.modifiers, r.modifiers)).forEach(function(e) {
                    n.options.modifiers[e] = se({}, t.Defaults.modifiers[e] || {}, r.modifiers ? r.modifiers[e] : {})
                }), this.modifiers = Object.keys(this.options.modifiers).map(function(e) {
                    return se({ name: e }, n.options.modifiers[e])
                }).sort(function(e, t) {
                    return e.order - t.order
                }), this.modifiers.forEach(function(t) {
                    t.enabled && e(t.onLoad) && t.onLoad(n.reference, n.popper, n.options, t, n.state)
                }), this.update();
                var p = this.options.eventsEnabled;
                p && this.enableEventListeners(), this.state.eventsEnabled = p
            }

            return re(t, [{
                key: "update",
                value: function() {
                    return N.call(this)
                }
            }, {
                key: "destroy",
                value: function() {
                    return P.call(this)
                }
            }, {
                key: "enableEventListeners",
                value: function() {
                    return I.call(this)
                }
            }, {
                key: "disableEventListeners",
                value: function() {
                    return R.call(this)
                }
            }]), t
        }();
    return fe.Utils = ("undefined" == typeof window ? global : window).PopperUtils, fe.placements = de, fe.Defaults = {
        placement: "bottom",
        eventsEnabled: !0,
        removeOnDestroy: !1,
        onCreate: function() {},
        onUpdate: function() {},
        modifiers: {
            shift: {
                order: 100,
                enabled: !0,
                fn: function(e) {
                    var t = e.placement,
                        o = t.split("-")[0],
                        i = t.split("-")[1];
                    if (i) {
                        var n = e.offsets,
                            r = n.reference,
                            p = n.popper,
                            s = -1 !== ["bottom", "top"].indexOf(o),
                            d = s ? "left" : "top",
                            a = s ? "width" : "height",
                            l = { start: pe({}, d, r[d]), end: pe({}, d, r[d] + r[a] - p[a]) };
                        e.offsets.popper = se({}, p, l[i])
                    }
                    return e
                }
            },
            offset: { order: 200, enabled: !0, fn: G, offset: 0 },
            preventOverflow: {
                order: 300,
                enabled: !0,
                fn: function(e, t) {
                    var o = t.boundariesElement || r(e.instance.popper);
                    e.instance.reference === o && (o = r(o));
                    var i = y(e.instance.popper, e.instance.reference, t.padding, o);
                    t.boundaries = i;
                    var n = t.priority,
                        p = e.offsets.popper,
                        s = {
                            primary: function(e) {
                                var o = p[e];
                                return p[e] < i[e] && !t.escapeWithReference && (o = J(p[e], i[e])), pe({}, e, o)
                            },
                            secondary: function(e) {
                                var o = "right" === e ? "left" : "top",
                                    n = p[o];
                                return p[e] > i[e] && !t.escapeWithReference && (n = _(p[o], i[e] - ("right" === e ? p.width : p.height))), pe({}, o, n)
                            }
                        };
                    return n.forEach(function(e) {
                        var t = -1 === ["left", "top"].indexOf(e) ? "secondary" : "primary";
                        p = se({}, p, s[t](e))
                    }), e.offsets.popper = p, e
                },
                priority: ["left", "right", "top", "bottom"],
                padding: 5,
                boundariesElement: "scrollParent"
            },
            keepTogether: {
                order: 400,
                enabled: !0,
                fn: function(e) {
                    var t = e.offsets,
                        o = t.popper,
                        i = t.reference,
                        n = e.placement.split("-")[0],
                        r = X,
                        p = -1 !== ["top", "bottom"].indexOf(n),
                        s = p ? "right" : "bottom",
                        d = p ? "left" : "top",
                        a = p ? "width" : "height";
                    return o[s] < r(i[d]) && (e.offsets.popper[d] = r(i[d]) - o[a]), o[d] > r(i[s]) && (e.offsets.popper[d] = r(i[s])), e
                }
            },
            arrow: {
                order: 500,
                enabled: !0,
                fn: function(e, o) {
                    var i;
                    if (!F(e.instance.modifiers, "arrow", "keepTogether")) return e;
                    var n = o.element;
                    if ("string" == typeof n) {
                        if (!(n = e.instance.popper.querySelector(n))) return e
                    } else if (!e.instance.popper.contains(n)) return console.warn("WARNING: `arrow.element` must be child of its popper element!"), e;
                    var r = e.placement.split("-")[0],
                        p = e.offsets,
                        s = p.popper,
                        d = p.reference,
                        a = -1 !== ["left", "right"].indexOf(r),
                        l = a ? "height" : "width",
                        f = a ? "Top" : "Left",
                        m = f.toLowerCase(),
                        h = a ? "left" : "top",
                        g = a ? "bottom" : "right",
                        u = L(n)[l];
                    d[g] - u < s[m] && (e.offsets.popper[m] -= s[m] - (d[g] - u)), d[m] + u > s[g] && (e.offsets.popper[m] += d[m] + u - s[g]), e.offsets.popper = c(e.offsets.popper);
                    var b = d[m] + d[l] / 2 - u / 2,
                        w = t(e.instance.popper),
                        y = parseFloat(w["margin" + f], 10),
                        E = parseFloat(w["border" + f + "Width"], 10),
                        v = b - e.offsets.popper[m] - y - E;
                    return v = J(_(s[l] - u, v), 0), e.arrowElement = n, e.offsets.arrow = (i = {}, pe(i, m, Math.round(v)), pe(i, h, ""), i), e
                },
                element: "[x-arrow]"
            },
            flip: {
                order: 600,
                enabled: !0,
                fn: function(e, t) {
                    if (k(e.instance.modifiers, "inner")) return e;
                    if (e.flipped && e.placement === e.originalPlacement) return e;
                    var o = y(e.instance.popper, e.instance.reference, t.padding, t.boundariesElement),
                        i = e.placement.split("-")[0],
                        n = x(i),
                        r = e.placement.split("-")[1] || "",
                        p = [];
                    switch (t.behavior) {
                        case le.FLIP:
                            p = [i, n];
                            break;
                        case le.CLOCKWISE:
                            p = q(i);
                            break;
                        case le.COUNTERCLOCKWISE:
                            p = q(i, !0);
                            break;
                        default:
                            p = t.behavior
                    }
                    return p.forEach(function(s, d) {
                        if (i !== s || p.length === d + 1) return e;
                        i = e.placement.split("-")[0], n = x(i);
                        var a = e.offsets.popper,
                            l = e.offsets.reference,
                            f = X,
                            m = "left" === i && f(a.right) > f(l.left) || "right" === i && f(a.left) < f(l.right) || "top" === i && f(a.bottom) > f(l.top) || "bottom" === i && f(a.top) < f(l.bottom),
                            h = f(a.left) < f(o.left),
                            c = f(a.right) > f(o.right),
                            g = f(a.top) < f(o.top),
                            u = f(a.bottom) > f(o.bottom),
                            b = "left" === i && h || "right" === i && c || "top" === i && g || "bottom" === i && u,
                            w = -1 !== ["top", "bottom"].indexOf(i),
                            y = !!t.flipVariations && (w && "start" === r && h || w && "end" === r && c || !w && "start" === r && g || !w && "end" === r && u);
                        (m || b || y) && (e.flipped = !0, (m || b) && (i = p[d + 1]), y && (r = K(r)), e.placement = i + (r ? "-" + r : ""), e.offsets.popper = se({}, e.offsets.popper, S(e.instance.popper, e.offsets.reference, e.placement)), e = C(e.instance.modifiers, e, "flip"))
                    }), e
                },
                behavior: "flip",
                padding: 5,
                boundariesElement: "viewport"
            },
            inner: {
                order: 700,
                enabled: !1,
                fn: function(e) {
                    var t = e.placement,
                        o = t.split("-")[0],
                        i = e.offsets,
                        n = i.popper,
                        r = i.reference,
                        p = -1 !== ["left", "right"].indexOf(o),
                        s = -1 === ["top", "left"].indexOf(o);
                    return n[p ? "left" : "top"] = r[o] - (s ? n[p ? "width" : "height"] : 0), e.placement = x(t), e.offsets.popper = c(n), e
                }
            },
            hide: {
                order: 800,
                enabled: !0,
                fn: function(e) {
                    if (!F(e.instance.modifiers, "hide", "preventOverflow")) return e;
                    var t = e.offsets.reference,
                        o = T(e.instance.modifiers, function(e) {
                            return "preventOverflow" === e.name
                        }).boundaries;
                    if (t.bottom < o.top || t.left > o.right || t.top > o.bottom || t.right < o.left) {
                        if (!0 === e.hide) return e;
                        e.hide = !0, e.attributes["x-out-of-boundaries"] = ""
                    } else {
                        if (!1 === e.hide) return e;
                        e.hide = !1, e.attributes["x-out-of-boundaries"] = !1
                    }
                    return e
                }
            },
            computeStyle: {
                order: 850,
                enabled: !0,
                fn: function(e, t) {
                    var o = t.x,
                        i = t.y,
                        n = e.offsets.popper,
                        p = T(e.instance.modifiers, function(e) {
                            return "applyStyle" === e.name
                        }).gpuAcceleration;
                    void 0 !== p && console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");
                    var s, d, a = void 0 === p ? t.gpuAcceleration : p,
                        l = r(e.instance.popper),
                        f = g(l),
                        m = { position: n.position },
                        h = { left: X(n.left), top: X(n.top), bottom: X(n.bottom), right: X(n.right) },
                        c = "bottom" === o ? "top" : "bottom",
                        u = "right" === i ? "left" : "right",
                        b = W("transform");
                    if (d = "bottom" == c ? -f.height + h.bottom : h.top, s = "right" == u ? -f.width + h.right : h.left, a && b) m[b] = "translate3d(" + s + "px, " + d + "px, 0)", m[c] = 0, m[u] = 0, m.willChange = "transform";
                    else {
                        var w = "bottom" == c ? -1 : 1,
                            y = "right" == u ? -1 : 1;
                        m[c] = d * w, m[u] = s * y, m.willChange = c + ", " + u
                    }
                    var E = { "x-placement": e.placement };
                    return e.attributes = se({}, E, e.attributes), e.styles = se({}, m, e.styles), e.arrowStyles = se({}, e.offsets.arrow, e.arrowStyles), e
                },
                gpuAcceleration: !0,
                x: "bottom",
                y: "right"
            },
            applyStyle: {
                order: 900,
                enabled: !0,
                fn: function(e) {
                    return Y(e.instance.popper, e.styles), j(e.instance.popper, e.attributes), e.arrowElement && Object.keys(e.arrowStyles).length && Y(e.arrowElement, e.arrowStyles), e
                },
                onLoad: function(e, t, o, i, n) {
                    var r = O(n, t, e),
                        p = v(o.placement, r, t, e, o.modifiers.flip.boundariesElement, o.modifiers.flip.padding);
                    return t.setAttribute("x-placement", p), Y(t, { position: "absolute" }), o
                },
                gpuAcceleration: void 0
            }
        }
    }, fe
}),
function(global, factory) {
    "object" == typeof exports && "undefined" != typeof module ? factory(exports, require("jquery"), require("popper.js")) : "function" == typeof define && define.amd ? define(["exports", "jquery", "popper.js"], factory) : factory(global.bootstrap = {}, global.jQuery, global.Popper)
}(this, function(exports, $, Popper) {
    "use strict";

    function _defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || !1, descriptor.configurable = !0, "value" in descriptor && (descriptor.writable = !0), Object.defineProperty(target, descriptor.key, descriptor)
        }
    }

    function _createClass(Constructor, protoProps, staticProps) {
        return protoProps && _defineProperties(Constructor.prototype, protoProps), staticProps && _defineProperties(Constructor, staticProps), Constructor
    }

    function _extends() {
        return _extends = Object.assign || function(target) {
            for (var i = 1; i < arguments.length; i++) {
                var source = arguments[i];
                for (var key in source) Object.prototype.hasOwnProperty.call(source, key) && (target[key] = source[key])
            }
            return target
        }, _extends.apply(this, arguments)
    }

    function _inheritsLoose(subClass, superClass) {
        subClass.prototype = Object.create(superClass.prototype), subClass.prototype.constructor = subClass, subClass.__proto__ = superClass
    }

    $ = $ && $.hasOwnProperty("default") ? $.default : $, Popper = Popper && Popper.hasOwnProperty("default") ? Popper.default : Popper;
    var Util = function($$$1) {
            function toType(obj) {
                return {}.toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase()
            }

            function getSpecialTransitionEndEvent() {
                return {
                    bindType: transition.end,
                    delegateType: transition.end,
                    handle: function(event) {
                        if ($$$1(event.target).is(this)) return event.handleObj.handler.apply(this, arguments)
                    }
                }
            }

            function transitionEndTest() {
                return ("undefined" == typeof window || !window.QUnit) && { end: "transitionend" }
            }

            function transitionEndEmulator(duration) {
                var _this = this,
                    called = !1;
                return $$$1(this).one(Util.TRANSITION_END, function() {
                    called = !0
                }), setTimeout(function() {
                    called || Util.triggerTransitionEnd(_this)
                }, duration), this
            }

            function escapeId(selector) {
                return selector = "function" == typeof $$$1.escapeSelector ? $$$1.escapeSelector(selector).substr(1) : selector.replace(/(:|\.|\[|\]|,|=|@)/g, "\\$1")
            }

            var transition = !1,
                Util = {
                    TRANSITION_END: "bsTransitionEnd",
                    getUID: function(prefix) {
                        do {
                            prefix += ~~(1e6 * Math.random())
                        } while (document.getElementById(prefix));
                        return prefix
                    },
                    getSelectorFromElement: function(element) {
                        var selector = element.getAttribute("data-target");
                        selector && "#" !== selector || (selector = element.getAttribute("href") || ""), "#" === selector.charAt(0) && (selector = escapeId(selector));
                        try {
                            return $$$1(document).find(selector).length > 0 ? selector : null
                        } catch (err) {
                            return null
                        }
                    },
                    reflow: function(element) {
                        return element.offsetHeight
                    },
                    triggerTransitionEnd: function(element) {
                        $$$1(element).trigger(transition.end)
                    },
                    supportsTransitionEnd: function() {
                        return Boolean(transition)
                    },
                    isElement: function(obj) {
                        return (obj[0] || obj).nodeType
                    },
                    typeCheckConfig: function(componentName, config, configTypes) {
                        for (var property in configTypes)
                            if (Object.prototype.hasOwnProperty.call(configTypes, property)) {
                                var expectedTypes = configTypes[property],
                                    value = config[property],
                                    valueType = value && Util.isElement(value) ? "element" : toType(value);
                                if (!new RegExp(expectedTypes).test(valueType)) throw new Error(componentName.toUpperCase() + ': Option "' + property + '" provided type "' + valueType + '" but expected type "' + expectedTypes + '".')
                            }
                    }
                };
            return function() {
                transition = transitionEndTest(), $$$1.fn.emulateTransitionEnd = transitionEndEmulator, Util.supportsTransitionEnd() && ($$$1.event.special[Util.TRANSITION_END] = getSpecialTransitionEndEvent())
            }(), Util
        }($),
        Alert = function($$$1) {
            var NAME = "alert",
                JQUERY_NO_CONFLICT = $$$1.fn[NAME],
                Selector = { DISMISS: '[data-dismiss="alert"]' },
                Event = { CLOSE: "close.bs.alert", CLOSED: "closed.bs.alert", CLICK_DATA_API: "click.bs.alert.data-api" },
                ClassName = { ALERT: "alert", FADE: "fade", SHOW: "show" },
                Alert = function() {
                    function Alert(element) {
                        this._element = element
                    }

                    var _proto = Alert.prototype;
                    return _proto.close = function(element) {
                        element = element || this._element;
                        var rootElement = this._getRootElement(element);
                        this._triggerCloseEvent(rootElement).isDefaultPrevented() || this._removeElement(rootElement)
                    }, _proto.dispose = function() {
                        $$$1.removeData(this._element, "bs.alert"), this._element = null
                    }, _proto._getRootElement = function(element) {
                        var selector = Util.getSelectorFromElement(element),
                            parent = !1;
                        return selector && (parent = $$$1(selector)[0]), parent || (parent = $$$1(element).closest("." + ClassName.ALERT)[0]), parent
                    }, _proto._triggerCloseEvent = function(element) {
                        var closeEvent = $$$1.Event(Event.CLOSE);
                        return $$$1(element).trigger(closeEvent), closeEvent
                    }, _proto._removeElement = function(element) {
                        var _this = this;
                        if ($$$1(element).removeClass(ClassName.SHOW), !Util.supportsTransitionEnd() || !$$$1(element).hasClass(ClassName.FADE)) return void this._destroyElement(element);
                        $$$1(element).one(Util.TRANSITION_END, function(event) {
                            return _this._destroyElement(element, event)
                        }).emulateTransitionEnd(150)
                    }, _proto._destroyElement = function(element) {
                        $$$1(element).detach().trigger(Event.CLOSED).remove()
                    }, Alert._jQueryInterface = function(config) {
                        return this.each(function() {
                            var $element = $$$1(this),
                                data = $element.data("bs.alert");
                            data || (data = new Alert(this), $element.data("bs.alert", data)), "close" === config && data[config](this)
                        })
                    }, Alert._handleDismiss = function(alertInstance) {
                        return function(event) {
                            event && event.preventDefault(), alertInstance.close(this)
                        }
                    }, _createClass(Alert, null, [{
                        key: "VERSION",
                        get: function() {
                            return "4.0.0"
                        }
                    }]), Alert
                }();
            return $$$1(document).on(Event.CLICK_DATA_API, Selector.DISMISS, Alert._handleDismiss(new Alert)), $$$1.fn[NAME] = Alert._jQueryInterface, $$$1.fn[NAME].Constructor = Alert, $$$1.fn[NAME].noConflict = function() {
                return $$$1.fn[NAME] = JQUERY_NO_CONFLICT, Alert._jQueryInterface
            }, Alert
        }($),
        Button = function($$$1) {
            var NAME = "button",
                JQUERY_NO_CONFLICT = $$$1.fn[NAME],
                ClassName = { ACTIVE: "active", BUTTON: "btn", FOCUS: "focus" },
                Selector = {
                    DATA_TOGGLE_CARROT: '[data-toggle^="button"]',
                    DATA_TOGGLE: '[data-toggle="buttons"]',
                    INPUT: "input",
                    ACTIVE: ".active",
                    BUTTON: ".btn"
                },
                Event = {
                    CLICK_DATA_API: "click.bs.button.data-api",
                    FOCUS_BLUR_DATA_API: "focus.bs.button.data-api blur.bs.button.data-api"
                },
                Button = function() {
                    function Button(element) {
                        this._element = element
                    }

                    var _proto = Button.prototype;
                    return _proto.toggle = function() {
                        var triggerChangeEvent = !0,
                            addAriaPressed = !0,
                            rootElement = $$$1(this._element).closest(Selector.DATA_TOGGLE)[0];
                        if (rootElement) {
                            var input = $$$1(this._element).find(Selector.INPUT)[0];
                            if (input) {
                                if ("radio" === input.type)
                                    if (input.checked && $$$1(this._element).hasClass(ClassName.ACTIVE)) triggerChangeEvent = !1;
                                    else {
                                        var activeElement = $$$1(rootElement).find(Selector.ACTIVE)[0];
                                        activeElement && $$$1(activeElement).removeClass(ClassName.ACTIVE)
                                    }
                                if (triggerChangeEvent) {
                                    if (input.hasAttribute("disabled") || rootElement.hasAttribute("disabled") || input.classList.contains("disabled") || rootElement.classList.contains("disabled")) return;
                                    input.checked = !$$$1(this._element).hasClass(ClassName.ACTIVE), $$$1(input).trigger("change")
                                }
                                input.focus(), addAriaPressed = !1
                            }
                        }
                        addAriaPressed && this._element.setAttribute("aria-pressed", !$$$1(this._element).hasClass(ClassName.ACTIVE)), triggerChangeEvent && $$$1(this._element).toggleClass(ClassName.ACTIVE)
                    }, _proto.dispose = function() {
                        $$$1.removeData(this._element, "bs.button"), this._element = null
                    }, Button._jQueryInterface = function(config) {
                        return this.each(function() {
                            var data = $$$1(this).data("bs.button");
                            data || (data = new Button(this), $$$1(this).data("bs.button", data)), "toggle" === config && data[config]()
                        })
                    }, _createClass(Button, null, [{
                        key: "VERSION",
                        get: function() {
                            return "4.0.0"
                        }
                    }]), Button
                }();
            return $$$1(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE_CARROT, function(event) {
                event.preventDefault();
                var button = event.target;
                $$$1(button).hasClass(ClassName.BUTTON) || (button = $$$1(button).closest(Selector.BUTTON)), Button._jQueryInterface.call($$$1(button), "toggle")
            }).on(Event.FOCUS_BLUR_DATA_API, Selector.DATA_TOGGLE_CARROT, function(event) {
                var button = $$$1(event.target).closest(Selector.BUTTON)[0];
                $$$1(button).toggleClass(ClassName.FOCUS, /^focus(in)?$/.test(event.type))
            }), $$$1.fn[NAME] = Button._jQueryInterface, $$$1.fn[NAME].Constructor = Button, $$$1.fn[NAME].noConflict = function() {
                return $$$1.fn[NAME] = JQUERY_NO_CONFLICT, Button._jQueryInterface
            }, Button
        }($),
        Carousel = function($$$1) {
            var NAME = "carousel",
                DATA_KEY = "bs.carousel",
                EVENT_KEY = "." + DATA_KEY,
                JQUERY_NO_CONFLICT = $$$1.fn[NAME],
                Default = { interval: 5e3, keyboard: !0, slide: !1, pause: "hover", wrap: !0 },
                DefaultType = {
                    interval: "(number|boolean)",
                    keyboard: "boolean",
                    slide: "(boolean|string)",
                    pause: "(string|boolean)",
                    wrap: "boolean"
                },
                Direction = { NEXT: "next", PREV: "prev", LEFT: "left", RIGHT: "right" },
                Event = {
                    SLIDE: "slide" + EVENT_KEY,
                    SLID: "slid" + EVENT_KEY,
                    KEYDOWN: "keydown" + EVENT_KEY,
                    MOUSEENTER: "mouseenter" + EVENT_KEY,
                    MOUSELEAVE: "mouseleave" + EVENT_KEY,
                    TOUCHEND: "touchend" + EVENT_KEY,
                    LOAD_DATA_API: "load.bs.carousel.data-api",
                    CLICK_DATA_API: "click.bs.carousel.data-api"
                },
                ClassName = {
                    CAROUSEL: "carousel",
                    ACTIVE: "active",
                    SLIDE: "slide",
                    RIGHT: "carousel-item-right",
                    LEFT: "carousel-item-left",
                    NEXT: "carousel-item-next",
                    PREV: "carousel-item-prev",
                    ITEM: "carousel-item"
                },
                Selector = {
                    ACTIVE: ".active",
                    ACTIVE_ITEM: ".active.carousel-item",
                    ITEM: ".carousel-item",
                    NEXT_PREV: ".carousel-item-next, .carousel-item-prev",
                    INDICATORS: ".carousel-indicators",
                    DATA_SLIDE: "[data-slide], [data-slide-to]",
                    DATA_RIDE: '[data-ride="carousel"]'
                },
                Carousel = function() {
                    function Carousel(element, config) {
                        this._items = null, this._interval = null, this._activeElement = null, this._isPaused = !1, this._isSliding = !1, this.touchTimeout = null, this._config = this._getConfig(config), this._element = $$$1(element)[0], this._indicatorsElement = $$$1(this._element).find(Selector.INDICATORS)[0], this._addEventListeners()
                    }

                    var _proto = Carousel.prototype;
                    return _proto.next = function() {
                        this._isSliding || this._slide(Direction.NEXT)
                    }, _proto.nextWhenVisible = function() {
                        !document.hidden && $$$1(this._element).is(":visible") && "hidden" !== $$$1(this._element).css("visibility") && this.next()
                    }, _proto.prev = function() {
                        this._isSliding || this._slide(Direction.PREV)
                    }, _proto.pause = function(event) {
                        event || (this._isPaused = !0), $$$1(this._element).find(Selector.NEXT_PREV)[0] && Util.supportsTransitionEnd() && (Util.triggerTransitionEnd(this._element), this.cycle(!0)), clearInterval(this._interval), this._interval = null
                    }, _proto.cycle = function(event) {
                        event || (this._isPaused = !1), this._interval && (clearInterval(this._interval), this._interval = null), this._config.interval && !this._isPaused && (this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval))
                    }, _proto.to = function(index) {
                        var _this = this;
                        this._activeElement = $$$1(this._element).find(Selector.ACTIVE_ITEM)[0];
                        var activeIndex = this._getItemIndex(this._activeElement);
                        if (!(index > this._items.length - 1 || index < 0)) {
                            if (this._isSliding) return void $$$1(this._element).one(Event.SLID, function() {
                                return _this.to(index)
                            });
                            if (activeIndex === index) return this.pause(), void this.cycle();
                            var direction = index > activeIndex ? Direction.NEXT : Direction.PREV;
                            this._slide(direction, this._items[index])
                        }
                    }, _proto.dispose = function() {
                        $$$1(this._element).off(EVENT_KEY), $$$1.removeData(this._element, DATA_KEY), this._items = null, this._config = null, this._element = null, this._interval = null, this._isPaused = null, this._isSliding = null, this._activeElement = null, this._indicatorsElement = null
                    }, _proto._getConfig = function(config) {
                        return config = _extends({}, Default, config), Util.typeCheckConfig(NAME, config, DefaultType), config
                    }, _proto._addEventListeners = function() {
                        var _this2 = this;
                        this._config.keyboard && $$$1(this._element).on(Event.KEYDOWN, function(event) {
                            return _this2._keydown(event)
                        }), "hover" === this._config.pause && ($$$1(this._element).on(Event.MOUSEENTER, function(event) {
                            return _this2.pause(event)
                        }).on(Event.MOUSELEAVE, function(event) {
                            return _this2.cycle(event)
                        }), "ontouchstart" in document.documentElement && $$$1(this._element).on(Event.TOUCHEND, function() {
                            _this2.pause(), _this2.touchTimeout && clearTimeout(_this2.touchTimeout), _this2.touchTimeout = setTimeout(function(event) {
                                return _this2.cycle(event)
                            }, 500 + _this2._config.interval)
                        }))
                    }, _proto._keydown = function(event) {
                        if (!/input|textarea/i.test(event.target.tagName)) switch (event.which) {
                            case 37:
                                event.preventDefault(), this.prev();
                                break;
                            case 39:
                                event.preventDefault(), this.next()
                        }
                    }, _proto._getItemIndex = function(element) {
                        return this._items = $$$1.makeArray($$$1(element).parent().find(Selector.ITEM)), this._items.indexOf(element)
                    }, _proto._getItemByDirection = function(direction, activeElement) {
                        var isNextDirection = direction === Direction.NEXT,
                            isPrevDirection = direction === Direction.PREV,
                            activeIndex = this._getItemIndex(activeElement),
                            lastItemIndex = this._items.length - 1;
                        if ((isPrevDirection && 0 === activeIndex || isNextDirection && activeIndex === lastItemIndex) && !this._config.wrap) return activeElement;
                        var delta = direction === Direction.PREV ? -1 : 1,
                            itemIndex = (activeIndex + delta) % this._items.length;
                        return -1 === itemIndex ? this._items[this._items.length - 1] : this._items[itemIndex]
                    }, _proto._triggerSlideEvent = function(relatedTarget, eventDirectionName) {
                        var targetIndex = this._getItemIndex(relatedTarget),
                            fromIndex = this._getItemIndex($$$1(this._element).find(Selector.ACTIVE_ITEM)[0]),
                            slideEvent = $$$1.Event(Event.SLIDE, {
                                relatedTarget: relatedTarget,
                                direction: eventDirectionName,
                                from: fromIndex,
                                to: targetIndex
                            });
                        return $$$1(this._element).trigger(slideEvent), slideEvent
                    }, _proto._setActiveIndicatorElement = function(element) {
                        if (this._indicatorsElement) {
                            $$$1(this._indicatorsElement).find(Selector.ACTIVE).removeClass(ClassName.ACTIVE);
                            var nextIndicator = this._indicatorsElement.children[this._getItemIndex(element)];
                            nextIndicator && $$$1(nextIndicator).addClass(ClassName.ACTIVE)
                        }
                    }, _proto._slide = function(direction, element) {
                        var directionalClassName, orderClassName, eventDirectionName, _this3 = this,
                            activeElement = $$$1(this._element).find(Selector.ACTIVE_ITEM)[0],
                            activeElementIndex = this._getItemIndex(activeElement),
                            nextElement = element || activeElement && this._getItemByDirection(direction, activeElement),
                            nextElementIndex = this._getItemIndex(nextElement),
                            isCycling = Boolean(this._interval);
                        if (direction === Direction.NEXT ? (directionalClassName = ClassName.LEFT, orderClassName = ClassName.NEXT, eventDirectionName = Direction.LEFT) : (directionalClassName = ClassName.RIGHT, orderClassName = ClassName.PREV, eventDirectionName = Direction.RIGHT), nextElement && $$$1(nextElement).hasClass(ClassName.ACTIVE)) return void(this._isSliding = !1);
                        if (!this._triggerSlideEvent(nextElement, eventDirectionName).isDefaultPrevented() && activeElement && nextElement) {
                            this._isSliding = !0, isCycling && this.pause(), this._setActiveIndicatorElement(nextElement);
                            var slidEvent = $$$1.Event(Event.SLID, {
                                relatedTarget: nextElement,
                                direction: eventDirectionName,
                                from: activeElementIndex,
                                to: nextElementIndex
                            });
                            Util.supportsTransitionEnd() && $$$1(this._element).hasClass(ClassName.SLIDE) ? ($$$1(nextElement).addClass(orderClassName), Util.reflow(nextElement), $$$1(activeElement).addClass(directionalClassName), $$$1(nextElement).addClass(directionalClassName), $$$1(activeElement).one(Util.TRANSITION_END, function() {
                                $$$1(nextElement).removeClass(directionalClassName + " " + orderClassName).addClass(ClassName.ACTIVE), $$$1(activeElement).removeClass(ClassName.ACTIVE + " " + orderClassName + " " + directionalClassName), _this3._isSliding = !1, setTimeout(function() {
                                    return $$$1(_this3._element).trigger(slidEvent)
                                }, 0)
                            }).emulateTransitionEnd(600)) : ($$$1(activeElement).removeClass(ClassName.ACTIVE), $$$1(nextElement).addClass(ClassName.ACTIVE), this._isSliding = !1, $$$1(this._element).trigger(slidEvent)), isCycling && this.cycle()
                        }
                    }, Carousel._jQueryInterface = function(config) {
                        return this.each(function() {
                            var data = $$$1(this).data(DATA_KEY),
                                _config = _extends({}, Default, $$$1(this).data());
                            "object" == typeof config && (_config = _extends({}, _config, config));
                            var action = "string" == typeof config ? config : _config.slide;
                            if (data || (data = new Carousel(this, _config), $$$1(this).data(DATA_KEY, data)), "number" == typeof config) data.to(config);
                            else if ("string" == typeof action) {
                                if (void 0 === data[action]) throw new TypeError('No method named "' + action + '"');
                                data[action]()
                            } else _config.interval && (data.pause(), data.cycle())
                        })
                    }, Carousel._dataApiClickHandler = function(event) {
                        var selector = Util.getSelectorFromElement(this);
                        if (selector) {
                            var target = $$$1(selector)[0];
                            if (target && $$$1(target).hasClass(ClassName.CAROUSEL)) {
                                var config = _extends({}, $$$1(target).data(), $$$1(this).data()),
                                    slideIndex = this.getAttribute("data-slide-to");
                                slideIndex && (config.interval = !1), Carousel._jQueryInterface.call($$$1(target), config), slideIndex && $$$1(target).data(DATA_KEY).to(slideIndex), event.preventDefault()
                            }
                        }
                    }, _createClass(Carousel, null, [{
                        key: "VERSION",
                        get: function() {
                            return "4.0.0"
                        }
                    }, {
                        key: "Default",
                        get: function() {
                            return Default
                        }
                    }]), Carousel
                }();
            return $$$1(document).on(Event.CLICK_DATA_API, Selector.DATA_SLIDE, Carousel._dataApiClickHandler), $$$1(window).on(Event.LOAD_DATA_API, function() {
                $$$1(Selector.DATA_RIDE).each(function() {
                    var $carousel = $$$1(this);
                    Carousel._jQueryInterface.call($carousel, $carousel.data())
                })
            }), $$$1.fn[NAME] = Carousel._jQueryInterface, $$$1.fn[NAME].Constructor = Carousel, $$$1.fn[NAME].noConflict = function() {
                return $$$1.fn[NAME] = JQUERY_NO_CONFLICT, Carousel._jQueryInterface
            }, Carousel
        }($),
        Collapse = function($$$1) {
            var NAME = "collapse",
                DATA_KEY = "bs.collapse",
                JQUERY_NO_CONFLICT = $$$1.fn[NAME],
                Default = { toggle: !0, parent: "" },
                DefaultType = { toggle: "boolean", parent: "(string|element)" },
                Event = {
                    SHOW: "show.bs.collapse",
                    SHOWN: "shown.bs.collapse",
                    HIDE: "hide.bs.collapse",
                    HIDDEN: "hidden.bs.collapse",
                    CLICK_DATA_API: "click.bs.collapse.data-api"
                },
                ClassName = { SHOW: "show", COLLAPSE: "collapse", COLLAPSING: "collapsing", COLLAPSED: "collapsed" },
                Dimension = { WIDTH: "width", HEIGHT: "height" },
                Selector = { ACTIVES: ".show, .collapsing", DATA_TOGGLE: '[data-toggle="collapse"]' },
                Collapse = function() {
                    function Collapse(element, config) {
                        this._isTransitioning = !1, this._element = element, this._config = this._getConfig(config), this._triggerArray = $$$1.makeArray($$$1('[data-toggle="collapse"][href="#' + element.id + '"],[data-toggle="collapse"][data-target="#' + element.id + '"]'));
                        for (var tabToggles = $$$1(Selector.DATA_TOGGLE), i = 0; i < tabToggles.length; i++) {
                            var elem = tabToggles[i],
                                selector = Util.getSelectorFromElement(elem);
                            null !== selector && $$$1(selector).filter(element).length > 0 && (this._selector = selector, this._triggerArray.push(elem))
                        }
                        this._parent = this._config.parent ? this._getParent() : null, this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle()
                    }

                    var _proto = Collapse.prototype;
                    return _proto.toggle = function() {
                        $$$1(this._element).hasClass(ClassName.SHOW) ? this.hide() : this.show()
                    }, _proto.show = function() {
                        var _this = this;
                        if (!this._isTransitioning && !$$$1(this._element).hasClass(ClassName.SHOW)) {
                            var actives, activesData;
                            if (this._parent && (actives = $$$1.makeArray($$$1(this._parent).find(Selector.ACTIVES).filter('[data-parent="' + this._config.parent + '"]')), 0 === actives.length && (actives = null)), !(actives && (activesData = $$$1(actives).not(this._selector).data(DATA_KEY)) && activesData._isTransitioning)) {
                                var startEvent = $$$1.Event(Event.SHOW);
                                if ($$$1(this._element).trigger(startEvent), !startEvent.isDefaultPrevented()) {
                                    actives && (Collapse._jQueryInterface.call($$$1(actives).not(this._selector), "hide"), activesData || $$$1(actives).data(DATA_KEY, null));
                                    var dimension = this._getDimension();
                                    $$$1(this._element).removeClass(ClassName.COLLAPSE).addClass(ClassName.COLLAPSING), this._element.style[dimension] = 0, this._triggerArray.length > 0 && $$$1(this._triggerArray).removeClass(ClassName.COLLAPSED).attr("aria-expanded", !0), this.setTransitioning(!0);
                                    var complete = function() {
                                        $$$1(_this._element).removeClass(ClassName.COLLAPSING).addClass(ClassName.COLLAPSE).addClass(ClassName.SHOW), _this._element.style[dimension] = "", _this.setTransitioning(!1), $$$1(_this._element).trigger(Event.SHOWN)
                                    };
                                    if (!Util.supportsTransitionEnd()) return void complete();
                                    var capitalizedDimension = dimension[0].toUpperCase() + dimension.slice(1),
                                        scrollSize = "scroll" + capitalizedDimension;
                                    $$$1(this._element).one(Util.TRANSITION_END, complete).emulateTransitionEnd(600), this._element.style[dimension] = this._element[scrollSize] + "px"
                                }
                            }
                        }
                    }, _proto.hide = function() {
                        var _this2 = this;
                        if (!this._isTransitioning && $$$1(this._element).hasClass(ClassName.SHOW)) {
                            var startEvent = $$$1.Event(Event.HIDE);
                            if ($$$1(this._element).trigger(startEvent), !startEvent.isDefaultPrevented()) {
                                var dimension = this._getDimension();
                                if (this._element.style[dimension] = this._element.getBoundingClientRect()[dimension] + "px", Util.reflow(this._element), $$$1(this._element).addClass(ClassName.COLLAPSING).removeClass(ClassName.COLLAPSE).removeClass(ClassName.SHOW), this._triggerArray.length > 0)
                                    for (var i = 0; i < this._triggerArray.length; i++) {
                                        var trigger = this._triggerArray[i],
                                            selector = Util.getSelectorFromElement(trigger);
                                        if (null !== selector) {
                                            var $elem = $$$1(selector);
                                            $elem.hasClass(ClassName.SHOW) || $$$1(trigger).addClass(ClassName.COLLAPSED).attr("aria-expanded", !1)
                                        }
                                    }
                                this.setTransitioning(!0);
                                var complete = function() {
                                    _this2.setTransitioning(!1), $$$1(_this2._element).removeClass(ClassName.COLLAPSING).addClass(ClassName.COLLAPSE).trigger(Event.HIDDEN)
                                };
                                if (this._element.style[dimension] = "", !Util.supportsTransitionEnd()) return void complete();
                                $$$1(this._element).one(Util.TRANSITION_END, complete).emulateTransitionEnd(600)
                            }
                        }
                    }, _proto.setTransitioning = function(isTransitioning) {
                        this._isTransitioning = isTransitioning
                    }, _proto.dispose = function() {
                        $$$1.removeData(this._element, DATA_KEY), this._config = null, this._parent = null, this._element = null, this._triggerArray = null, this._isTransitioning = null
                    }, _proto._getConfig = function(config) {
                        return config = _extends({}, Default, config), config.toggle = Boolean(config.toggle), Util.typeCheckConfig(NAME, config, DefaultType), config
                    }, _proto._getDimension = function() {
                        return $$$1(this._element).hasClass(Dimension.WIDTH) ? Dimension.WIDTH : Dimension.HEIGHT
                    }, _proto._getParent = function() {
                        var _this3 = this,
                            parent = null;
                        Util.isElement(this._config.parent) ? (parent = this._config.parent, void 0 !== this._config.parent.jquery && (parent = this._config.parent[0])) : parent = $$$1(this._config.parent)[0];
                        var selector = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]';
                        return $$$1(parent).find(selector).each(function(i, element) {
                            _this3._addAriaAndCollapsedClass(Collapse._getTargetFromElement(element), [element])
                        }), parent
                    }, _proto._addAriaAndCollapsedClass = function(element, triggerArray) {
                        if (element) {
                            var isOpen = $$$1(element).hasClass(ClassName.SHOW);
                            triggerArray.length > 0 && $$$1(triggerArray).toggleClass(ClassName.COLLAPSED, !isOpen).attr("aria-expanded", isOpen)
                        }
                    }, Collapse._getTargetFromElement = function(element) {
                        var selector = Util.getSelectorFromElement(element);
                        return selector ? $$$1(selector)[0] : null
                    }, Collapse._jQueryInterface = function(config) {
                        return this.each(function() {
                            var $this = $$$1(this),
                                data = $this.data(DATA_KEY),
                                _config = _extends({}, Default, $this.data(), "object" == typeof config && config);
                            if (!data && _config.toggle && /show|hide/.test(config) && (_config.toggle = !1), data || (data = new Collapse(this, _config), $this.data(DATA_KEY, data)), "string" == typeof config) {
                                if (void 0 === data[config]) throw new TypeError('No method named "' + config + '"');
                                data[config]()
                            }
                        })
                    }, _createClass(Collapse, null, [{
                        key: "VERSION",
                        get: function() {
                            return "4.0.0"
                        }
                    }, {
                        key: "Default",
                        get: function() {
                            return Default
                        }
                    }]), Collapse
                }();
            return $$$1(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function(event) {
                "A" === event.currentTarget.tagName && event.preventDefault();
                var $trigger = $$$1(this),
                    selector = Util.getSelectorFromElement(this);
                $$$1(selector).each(function() {
                    var $target = $$$1(this),
                        data = $target.data(DATA_KEY),
                        config = data ? "toggle" : $trigger.data();
                    Collapse._jQueryInterface.call($target, config)
                })
            }), $$$1.fn[NAME] = Collapse._jQueryInterface, $$$1.fn[NAME].Constructor = Collapse, $$$1.fn[NAME].noConflict = function() {
                return $$$1.fn[NAME] = JQUERY_NO_CONFLICT, Collapse._jQueryInterface
            }, Collapse
        }($),
        Dropdown = function($$$1) {
            var NAME = "dropdown",
                DATA_KEY = "bs.dropdown",
                EVENT_KEY = "." + DATA_KEY,
                JQUERY_NO_CONFLICT = $$$1.fn[NAME],
                REGEXP_KEYDOWN = new RegExp("38|40|27"),
                Event = {
                    HIDE: "hide" + EVENT_KEY,
                    HIDDEN: "hidden" + EVENT_KEY,
                    SHOW: "show" + EVENT_KEY,
                    SHOWN: "shown" + EVENT_KEY,
                    CLICK: "click" + EVENT_KEY,
                    CLICK_DATA_API: "click.bs.dropdown.data-api",
                    KEYDOWN_DATA_API: "keydown.bs.dropdown.data-api",
                    KEYUP_DATA_API: "keyup.bs.dropdown.data-api"
                },
                ClassName = {
                    DISABLED: "disabled",
                    SHOW: "show",
                    DROPUP: "dropup",
                    DROPRIGHT: "dropright",
                    DROPLEFT: "dropleft",
                    MENURIGHT: "dropdown-menu-right",
                    MENULEFT: "dropdown-menu-left",
                    POSITION_STATIC: "position-static"
                },
                Selector = {
                    DATA_TOGGLE: '[data-toggle="dropdown"]',
                    FORM_CHILD: ".dropdown form",
                    MENU: ".dropdown-menu",
                    NAVBAR_NAV: ".navbar-nav",
                    VISIBLE_ITEMS: ".dropdown-menu .dropdown-item:not(.disabled)"
                },
                AttachmentMap = {
                    TOP: "top-start",
                    TOPEND: "top-end",
                    BOTTOM: "bottom-start",
                    BOTTOMEND: "bottom-end",
                    RIGHT: "right-start",
                    RIGHTEND: "right-end",
                    LEFT: "left-start",
                    LEFTEND: "left-end"
                },
                Default = { offset: 0, flip: !0, boundary: "scrollParent" },
                DefaultType = { offset: "(number|string|function)", flip: "boolean", boundary: "(string|element)" },
                Dropdown = function() {
                    function Dropdown(element, config) {
                        this._element = element, this._popper = null, this._config = this._getConfig(config), this._menu = this._getMenuElement(), this._inNavbar = this._detectNavbar(), this._addEventListeners()
                    }

                    var _proto = Dropdown.prototype;
                    return _proto.toggle = function() {
                        if (!this._element.disabled && !$$$1(this._element).hasClass(ClassName.DISABLED)) {
                            var parent = Dropdown._getParentFromElement(this._element),
                                isActive = $$$1(this._menu).hasClass(ClassName.SHOW);
                            if (Dropdown._clearMenus(), !isActive) {
                                var relatedTarget = { relatedTarget: this._element },
                                    showEvent = $$$1.Event(Event.SHOW, relatedTarget);
                                if ($$$1(parent).trigger(showEvent), !showEvent.isDefaultPrevented()) {
                                    if (!this._inNavbar) {
                                        if (void 0 === Popper) throw new TypeError("Bootstrap dropdown require Popper.js (https://popper.js.org)");
                                        var element = this._element;
                                        $$$1(parent).hasClass(ClassName.DROPUP) && ($$$1(this._menu).hasClass(ClassName.MENULEFT) || $$$1(this._menu).hasClass(ClassName.MENURIGHT)) && (element = parent), "scrollParent" !== this._config.boundary && $$$1(parent).addClass(ClassName.POSITION_STATIC), this._popper = new Popper(element, this._menu, this._getPopperConfig())
                                    }
                                    "ontouchstart" in document.documentElement && 0 === $$$1(parent).closest(Selector.NAVBAR_NAV).length && $$$1("body").children().on("mouseover", null, $$$1.noop), this._element.focus(), this._element.setAttribute("aria-expanded", !0), $$$1(this._menu).toggleClass(ClassName.SHOW), $$$1(parent).toggleClass(ClassName.SHOW).trigger($$$1.Event(Event.SHOWN, relatedTarget))
                                }
                            }
                        }
                    }, _proto.dispose = function() {
                        $$$1.removeData(this._element, DATA_KEY), $$$1(this._element).off(EVENT_KEY), this._element = null, this._menu = null, null !== this._popper && (this._popper.destroy(), this._popper = null)
                    }, _proto.update = function() {
                        this._inNavbar = this._detectNavbar(), null !== this._popper && this._popper.scheduleUpdate()
                    }, _proto._addEventListeners = function() {
                        var _this = this;
                        $$$1(this._element).on(Event.CLICK, function(event) {
                            event.preventDefault(), event.stopPropagation(), _this.toggle()
                        })
                    }, _proto._getConfig = function(config) {
                        return config = _extends({}, this.constructor.Default, $$$1(this._element).data(), config), Util.typeCheckConfig(NAME, config, this.constructor.DefaultType), config
                    }, _proto._getMenuElement = function() {
                        if (!this._menu) {
                            var parent = Dropdown._getParentFromElement(this._element);
                            this._menu = $$$1(parent).find(Selector.MENU)[0]
                        }
                        return this._menu
                    }, _proto._getPlacement = function() {
                        var $parentDropdown = $$$1(this._element).parent(),
                            placement = AttachmentMap.BOTTOM;
                        return $parentDropdown.hasClass(ClassName.DROPUP) ? (placement = AttachmentMap.TOP, $$$1(this._menu).hasClass(ClassName.MENURIGHT) && (placement = AttachmentMap.TOPEND)) : $parentDropdown.hasClass(ClassName.DROPRIGHT) ? placement = AttachmentMap.RIGHT : $parentDropdown.hasClass(ClassName.DROPLEFT) ? placement = AttachmentMap.LEFT : $$$1(this._menu).hasClass(ClassName.MENURIGHT) && (placement = AttachmentMap.BOTTOMEND), placement
                    }, _proto._detectNavbar = function() {
                        return $$$1(this._element).closest(".navbar").length > 0
                    }, _proto._getPopperConfig = function() {
                        var _this2 = this,
                            offsetConf = {};
                        return "function" == typeof this._config.offset ? offsetConf.fn = function(data) {
                            return data.offsets = _extends({}, data.offsets, _this2._config.offset(data.offsets) || {}), data
                        } : offsetConf.offset = this._config.offset, {
                            placement: this._getPlacement(),
                            modifiers: {
                                offset: offsetConf,
                                flip: { enabled: this._config.flip },
                                preventOverflow: { boundariesElement: this._config.boundary }
                            }
                        }
                    }, Dropdown._jQueryInterface = function(config) {
                        return this.each(function() {
                            var data = $$$1(this).data(DATA_KEY),
                                _config = "object" == typeof config ? config : null;
                            if (data || (data = new Dropdown(this, _config), $$$1(this).data(DATA_KEY, data)), "string" == typeof config) {
                                if (void 0 === data[config]) throw new TypeError('No method named "' + config + '"');
                                data[config]()
                            }
                        })
                    }, Dropdown._clearMenus = function(event) {
                        if (!event || 3 !== event.which && ("keyup" !== event.type || 9 === event.which))
                            for (var toggles = $$$1.makeArray($$$1(Selector.DATA_TOGGLE)), i = 0; i < toggles.length; i++) {
                                var parent = Dropdown._getParentFromElement(toggles[i]),
                                    context = $$$1(toggles[i]).data(DATA_KEY),
                                    relatedTarget = { relatedTarget: toggles[i] };
                                if (context) {
                                    var dropdownMenu = context._menu;
                                    if ($$$1(parent).hasClass(ClassName.SHOW) && !(event && ("click" === event.type && /input|textarea/i.test(event.target.tagName) || "keyup" === event.type && 9 === event.which) && $$$1.contains(parent, event.target))) {
                                        var hideEvent = $$$1.Event(Event.HIDE, relatedTarget);
                                        $$$1(parent).trigger(hideEvent), hideEvent.isDefaultPrevented() || ("ontouchstart" in document.documentElement && $$$1("body").children().off("mouseover", null, $$$1.noop), toggles[i].setAttribute("aria-expanded", "false"), $$$1(dropdownMenu).removeClass(ClassName.SHOW), $$$1(parent).removeClass(ClassName.SHOW).trigger($$$1.Event(Event.HIDDEN, relatedTarget)))
                                    }
                                }
                            }
                    }, Dropdown._getParentFromElement = function(element) {
                        var parent, selector = Util.getSelectorFromElement(element);
                        return selector && (parent = $$$1(selector)[0]), parent || element.parentNode
                    }, Dropdown._dataApiKeydownHandler = function(event) {
                        if ((/input|textarea/i.test(event.target.tagName) ? !(32 === event.which || 27 !== event.which && (40 !== event.which && 38 !== event.which || $$$1(event.target).closest(Selector.MENU).length)) : REGEXP_KEYDOWN.test(event.which)) && (event.preventDefault(), event.stopPropagation(), !this.disabled && !$$$1(this).hasClass(ClassName.DISABLED))) {
                            var parent = Dropdown._getParentFromElement(this),
                                isActive = $$$1(parent).hasClass(ClassName.SHOW);
                            if (!isActive && (27 !== event.which || 32 !== event.which) || isActive && (27 === event.which || 32 === event.which)) {
                                if (27 === event.which) {
                                    var toggle = $$$1(parent).find(Selector.DATA_TOGGLE)[0];
                                    $$$1(toggle).trigger("focus")
                                }
                                return void $$$1(this).trigger("click")
                            }
                            var items = $$$1(parent).find(Selector.VISIBLE_ITEMS).get();
                            if (0 !== items.length) {
                                var index = items.indexOf(event.target);
                                38 === event.which && index > 0 && index--, 40 === event.which && index < items.length - 1 && index++, index < 0 && (index = 0), items[index].focus()
                            }
                        }
                    }, _createClass(Dropdown, null, [{
                        key: "VERSION",
                        get: function() {
                            return "4.0.0"
                        }
                    }, {
                        key: "Default",
                        get: function() {
                            return Default
                        }
                    }, {
                        key: "DefaultType",
                        get: function() {
                            return DefaultType
                        }
                    }]), Dropdown
                }();
            return $$$1(document).on(Event.KEYDOWN_DATA_API, Selector.DATA_TOGGLE, Dropdown._dataApiKeydownHandler).on(Event.KEYDOWN_DATA_API, Selector.MENU, Dropdown._dataApiKeydownHandler).on(Event.CLICK_DATA_API + " " + Event.KEYUP_DATA_API, Dropdown._clearMenus).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function(event) {
                event.preventDefault(), event.stopPropagation(), Dropdown._jQueryInterface.call($$$1(this), "toggle")
            }).on(Event.CLICK_DATA_API, Selector.FORM_CHILD, function(e) {
                e.stopPropagation()
            }), $$$1.fn[NAME] = Dropdown._jQueryInterface, $$$1.fn[NAME].Constructor = Dropdown, $$$1.fn[NAME].noConflict = function() {
                return $$$1.fn[NAME] = JQUERY_NO_CONFLICT, Dropdown._jQueryInterface
            }, Dropdown
        }($),
        Modal = function($$$1) {
            var NAME = "modal",
                EVENT_KEY = ".bs.modal",
                JQUERY_NO_CONFLICT = $$$1.fn[NAME],
                Default = { backdrop: !0, keyboard: !0, focus: !0, show: !0 },
                DefaultType = { backdrop: "(boolean|string)", keyboard: "boolean", focus: "boolean", show: "boolean" },
                Event = {
                    HIDE: "hide.bs.modal",
                    HIDDEN: "hidden.bs.modal",
                    SHOW: "show.bs.modal",
                    SHOWN: "shown.bs.modal",
                    FOCUSIN: "focusin.bs.modal",
                    RESIZE: "resize.bs.modal",
                    CLICK_DISMISS: "click.dismiss.bs.modal",
                    KEYDOWN_DISMISS: "keydown.dismiss.bs.modal",
                    MOUSEUP_DISMISS: "mouseup.dismiss.bs.modal",
                    MOUSEDOWN_DISMISS: "mousedown.dismiss.bs.modal",
                    CLICK_DATA_API: "click.bs.modal.data-api"
                },
                ClassName = {
                    SCROLLBAR_MEASURER: "modal-scrollbar-measure",
                    BACKDROP: "modal-backdrop",
                    OPEN: "modal-open",
                    FADE: "fade",
                    SHOW: "show"
                },
                Selector = {
                    DIALOG: ".modal-dialog",
                    DATA_TOGGLE: '[data-toggle="modal"]',
                    DATA_DISMISS: '[data-dismiss="modal"]',
                    FIXED_CONTENT: ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
                    STICKY_CONTENT: ".sticky-top",
                    NAVBAR_TOGGLER: ".navbar-toggler"
                },
                Modal = function() {
                    function Modal(element, config) {
                        this._config = this._getConfig(config), this._element = element, this._dialog = $$$1(element).find(Selector.DIALOG)[0], this._backdrop = null, this._isShown = !1, this._isBodyOverflowing = !1, this._ignoreBackdropClick = !1, this._originalBodyPadding = 0, this._scrollbarWidth = 0
                    }

                    var _proto = Modal.prototype;
                    return _proto.toggle = function(relatedTarget) {
                        return this._isShown ? this.hide() : this.show(relatedTarget)
                    }, _proto.show = function(relatedTarget) {
                        var _this = this;
                        if (!this._isTransitioning && !this._isShown) {
                            Util.supportsTransitionEnd() && $$$1(this._element).hasClass(ClassName.FADE) && (this._isTransitioning = !0);
                            var showEvent = $$$1.Event(Event.SHOW, { relatedTarget: relatedTarget });
                            $$$1(this._element).trigger(showEvent), this._isShown || showEvent.isDefaultPrevented() || (this._isShown = !0, this._checkScrollbar(), this._setScrollbar(), this._adjustDialog(), $$$1(document.body).addClass(ClassName.OPEN), this._setEscapeEvent(), this._setResizeEvent(), $$$1(this._element).on(Event.CLICK_DISMISS, Selector.DATA_DISMISS, function(event) {
                                return _this.hide(event)
                            }), $$$1(this._dialog).on(Event.MOUSEDOWN_DISMISS, function() {
                                $$$1(_this._element).one(Event.MOUSEUP_DISMISS, function(event) {
                                    $$$1(event.target).is(_this._element) && (_this._ignoreBackdropClick = !0)
                                })
                            }), this._showBackdrop(function() {
                                return _this._showElement(relatedTarget)
                            }))
                        }
                    }, _proto.hide = function(event) {
                        var _this2 = this;
                        if (event && event.preventDefault(), !this._isTransitioning && this._isShown) {
                            var hideEvent = $$$1.Event(Event.HIDE);
                            if ($$$1(this._element).trigger(hideEvent), this._isShown && !hideEvent.isDefaultPrevented()) {
                                this._isShown = !1;
                                var transition = Util.supportsTransitionEnd() && $$$1(this._element).hasClass(ClassName.FADE);
                                transition && (this._isTransitioning = !0), this._setEscapeEvent(), this._setResizeEvent(), $$$1(document).off(Event.FOCUSIN), $$$1(this._element).removeClass(ClassName.SHOW), $$$1(this._element).off(Event.CLICK_DISMISS), $$$1(this._dialog).off(Event.MOUSEDOWN_DISMISS), transition ? $$$1(this._element).one(Util.TRANSITION_END, function(event) {
                                    return _this2._hideModal(event)
                                }).emulateTransitionEnd(300) : this._hideModal()
                            }
                        }
                    }, _proto.dispose = function() {
                        $$$1.removeData(this._element, "bs.modal"), $$$1(window, document, this._element, this._backdrop).off(EVENT_KEY), this._config = null, this._element = null, this._dialog = null, this._backdrop = null, this._isShown = null, this._isBodyOverflowing = null, this._ignoreBackdropClick = null, this._scrollbarWidth = null
                    }, _proto.handleUpdate = function() {
                        this._adjustDialog()
                    }, _proto._getConfig = function(config) {
                        return config = _extends({}, Default, config), Util.typeCheckConfig(NAME, config, DefaultType), config
                    }, _proto._showElement = function(relatedTarget) {
                        var _this3 = this,
                            transition = Util.supportsTransitionEnd() && $$$1(this._element).hasClass(ClassName.FADE);
                        this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE || document.body.appendChild(this._element), this._element.style.display = "block", this._element.removeAttribute("aria-hidden"), this._element.scrollTop = 0, transition && Util.reflow(this._element), $$$1(this._element).addClass(ClassName.SHOW), this._config.focus && this._enforceFocus();
                        var shownEvent = $$$1.Event(Event.SHOWN, { relatedTarget: relatedTarget }),
                            transitionComplete = function() {
                                _this3._config.focus && _this3._element.focus(), _this3._isTransitioning = !1, $$$1(_this3._element).trigger(shownEvent)
                            };
                        transition ? $$$1(this._dialog).one(Util.TRANSITION_END, transitionComplete).emulateTransitionEnd(300) : transitionComplete()
                    }, _proto._enforceFocus = function() {
                        var _this4 = this;
                        $$$1(document).off(Event.FOCUSIN).on(Event.FOCUSIN, function(event) {
                            document !== event.target && _this4._element !== event.target && 0 === $$$1(_this4._element).has(event.target).length && _this4._element.focus()
                        })
                    }, _proto._setEscapeEvent = function() {
                        var _this5 = this;
                        this._isShown && this._config.keyboard ? $$$1(this._element).on(Event.KEYDOWN_DISMISS, function(event) {
                            27 === event.which && (event.preventDefault(), _this5.hide())
                        }) : this._isShown || $$$1(this._element).off(Event.KEYDOWN_DISMISS)
                    }, _proto._setResizeEvent = function() {
                        var _this6 = this;
                        this._isShown ? $$$1(window).on(Event.RESIZE, function(event) {
                            return _this6.handleUpdate(event)
                        }) : $$$1(window).off(Event.RESIZE)
                    }, _proto._hideModal = function() {
                        var _this7 = this;
                        this._element.style.display = "none", this._element.setAttribute("aria-hidden", !0), this._isTransitioning = !1, this._showBackdrop(function() {
                            $$$1(document.body).removeClass(ClassName.OPEN), _this7._resetAdjustments(), _this7._resetScrollbar(), $$$1(_this7._element).trigger(Event.HIDDEN)
                        })
                    }, _proto._removeBackdrop = function() {
                        this._backdrop && ($$$1(this._backdrop).remove(), this._backdrop = null)
                    }, _proto._showBackdrop = function(callback) {
                        var _this8 = this,
                            animate = $$$1(this._element).hasClass(ClassName.FADE) ? ClassName.FADE : "";
                        if (this._isShown && this._config.backdrop) {
                            var doAnimate = Util.supportsTransitionEnd() && animate;
                            if (this._backdrop = document.createElement("div"), this._backdrop.className = ClassName.BACKDROP, animate && $$$1(this._backdrop).addClass(animate), $$$1(this._backdrop).appendTo(document.body), $$$1(this._element).on(Event.CLICK_DISMISS, function(event) {
                                    if (_this8._ignoreBackdropClick) return void(_this8._ignoreBackdropClick = !1);
                                    event.target === event.currentTarget && ("static" === _this8._config.backdrop ? _this8._element.focus() : _this8.hide())
                                }), doAnimate && Util.reflow(this._backdrop), $$$1(this._backdrop).addClass(ClassName.SHOW), !callback) return;
                            if (!doAnimate) return void callback();
                            $$$1(this._backdrop).one(Util.TRANSITION_END, callback).emulateTransitionEnd(150)
                        } else if (!this._isShown && this._backdrop) {
                            $$$1(this._backdrop).removeClass(ClassName.SHOW);
                            var callbackRemove = function() {
                                _this8._removeBackdrop(), callback && callback()
                            };
                            Util.supportsTransitionEnd() && $$$1(this._element).hasClass(ClassName.FADE) ? $$$1(this._backdrop).one(Util.TRANSITION_END, callbackRemove).emulateTransitionEnd(150) : callbackRemove()
                        } else callback && callback()
                    }, _proto._adjustDialog = function() {
                        var isModalOverflowing = this._element.scrollHeight > document.documentElement.clientHeight;
                        !this._isBodyOverflowing && isModalOverflowing && (this._element.style.paddingLeft = this._scrollbarWidth + "px"), this._isBodyOverflowing && !isModalOverflowing && (this._element.style.paddingRight = this._scrollbarWidth + "px")
                    }, _proto._resetAdjustments = function() {
                        this._element.style.paddingLeft = "", this._element.style.paddingRight = ""
                    }, _proto._checkScrollbar = function() {
                        var rect = document.body.getBoundingClientRect();
                        this._isBodyOverflowing = rect.left + rect.right < window.innerWidth, this._scrollbarWidth = this._getScrollbarWidth()
                    }, _proto._setScrollbar = function() {
                        var _this9 = this;
                        if (this._isBodyOverflowing) {
                            $$$1(Selector.FIXED_CONTENT).each(function(index, element) {
                                var actualPadding = $$$1(element)[0].style.paddingRight,
                                    calculatedPadding = $$$1(element).css("padding-right");
                                $$$1(element).data("padding-right", actualPadding).css("padding-right", parseFloat(calculatedPadding) + _this9._scrollbarWidth + "px")
                            }), $$$1(Selector.STICKY_CONTENT).each(function(index, element) {
                                var actualMargin = $$$1(element)[0].style.marginRight,
                                    calculatedMargin = $$$1(element).css("margin-right");
                                $$$1(element).data("margin-right", actualMargin).css("margin-right", parseFloat(calculatedMargin) - _this9._scrollbarWidth + "px")
                            }), $$$1(Selector.NAVBAR_TOGGLER).each(function(index, element) {
                                var actualMargin = $$$1(element)[0].style.marginRight,
                                    calculatedMargin = $$$1(element).css("margin-right");
                                $$$1(element).data("margin-right", actualMargin).css("margin-right", parseFloat(calculatedMargin) + _this9._scrollbarWidth + "px")
                            });
                            var actualPadding = document.body.style.paddingRight,
                                calculatedPadding = $$$1("body").css("padding-right");
                            $$$1("body").data("padding-right", actualPadding).css("padding-right", parseFloat(calculatedPadding) + this._scrollbarWidth + "px")
                        }
                    }, _proto._resetScrollbar = function() {
                        $$$1(Selector.FIXED_CONTENT).each(function(index, element) {
                            var padding = $$$1(element).data("padding-right");
                            void 0 !== padding && $$$1(element).css("padding-right", padding).removeData("padding-right")
                        }), $$$1(Selector.STICKY_CONTENT + ", " + Selector.NAVBAR_TOGGLER).each(function(index, element) {
                            var margin = $$$1(element).data("margin-right");
                            void 0 !== margin && $$$1(element).css("margin-right", margin).removeData("margin-right")
                        });
                        var padding = $$$1("body").data("padding-right");
                        void 0 !== padding && $$$1("body").css("padding-right", padding).removeData("padding-right")
                    }, _proto._getScrollbarWidth = function() {
                        var scrollDiv = document.createElement("div");
                        scrollDiv.className = ClassName.SCROLLBAR_MEASURER, document.body.appendChild(scrollDiv);
                        var scrollbarWidth = scrollDiv.getBoundingClientRect().width - scrollDiv.clientWidth;
                        return document.body.removeChild(scrollDiv), scrollbarWidth
                    }, Modal._jQueryInterface = function(config, relatedTarget) {
                        return this.each(function() {
                            var data = $$$1(this).data("bs.modal"),
                                _config = _extends({}, Modal.Default, $$$1(this).data(), "object" == typeof config && config);
                            if (data || (data = new Modal(this, _config), $$$1(this).data("bs.modal", data)), "string" == typeof config) {
                                if (void 0 === data[config]) throw new TypeError('No method named "' + config + '"');
                                data[config](relatedTarget)
                            } else _config.show && data.show(relatedTarget)
                        })
                    }, _createClass(Modal, null, [{
                        key: "VERSION",
                        get: function() {
                            return "4.0.0"
                        }
                    }, {
                        key: "Default",
                        get: function() {
                            return Default
                        }
                    }]), Modal
                }();
            return $$$1(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function(event) {
                var target, _this10 = this,
                    selector = Util.getSelectorFromElement(this);
                selector && (target = $$$1(selector)[0]);
                var config = $$$1(target).data("bs.modal") ? "toggle" : _extends({}, $$$1(target).data(), $$$1(this).data());
                "A" !== this.tagName && "AREA" !== this.tagName || event.preventDefault();
                var $target = $$$1(target).one(Event.SHOW, function(showEvent) {
                    showEvent.isDefaultPrevented() || $target.one(Event.HIDDEN, function() {
                        $$$1(_this10).is(":visible") && _this10.focus()
                    })
                });
                Modal._jQueryInterface.call($$$1(target), config, this)
            }), $$$1.fn[NAME] = Modal._jQueryInterface, $$$1.fn[NAME].Constructor = Modal, $$$1.fn[NAME].noConflict = function() {
                return $$$1.fn[NAME] = JQUERY_NO_CONFLICT, Modal._jQueryInterface
            }, Modal
        }($),
        Tooltip = function($$$1) {
            var NAME = "tooltip",
                EVENT_KEY = ".bs.tooltip",
                JQUERY_NO_CONFLICT = $$$1.fn[NAME],
                BSCLS_PREFIX_REGEX = new RegExp("(^|\\s)bs-tooltip\\S+", "g"),
                DefaultType = {
                    animation: "boolean",
                    template: "string",
                    title: "(string|element|function)",
                    trigger: "string",
                    delay: "(number|object)",
                    html: "boolean",
                    selector: "(string|boolean)",
                    placement: "(string|function)",
                    offset: "(number|string)",
                    container: "(string|element|boolean)",
                    fallbackPlacement: "(string|array)",
                    boundary: "(string|element)"
                },
                AttachmentMap = { AUTO: "auto", TOP: "top", RIGHT: "right", BOTTOM: "bottom", LEFT: "left" },
                Default = {
                    animation: !0,
                    template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
                    trigger: "hover focus",
                    title: "",
                    delay: 0,
                    html: !1,
                    selector: !1,
                    placement: "top",
                    offset: 0,
                    container: !1,
                    fallbackPlacement: "flip",
                    boundary: "scrollParent"
                },
                HoverState = { SHOW: "show", OUT: "out" },
                Event = {
                    HIDE: "hide" + EVENT_KEY,
                    HIDDEN: "hidden" + EVENT_KEY,
                    SHOW: "show" + EVENT_KEY,
                    SHOWN: "shown" + EVENT_KEY,
                    INSERTED: "inserted" + EVENT_KEY,
                    CLICK: "click" + EVENT_KEY,
                    FOCUSIN: "focusin" + EVENT_KEY,
                    FOCUSOUT: "focusout" + EVENT_KEY,
                    MOUSEENTER: "mouseenter" + EVENT_KEY,
                    MOUSELEAVE: "mouseleave" + EVENT_KEY
                },
                ClassName = { FADE: "fade", SHOW: "show" },
                Selector = { TOOLTIP: ".tooltip", TOOLTIP_INNER: ".tooltip-inner", ARROW: ".arrow" },
                Trigger = { HOVER: "hover", FOCUS: "focus", CLICK: "click", MANUAL: "manual" },
                Tooltip = function() {
                    function Tooltip(element, config) {
                        if (void 0 === Popper) throw new TypeError("Bootstrap tooltips require Popper.js (https://popper.js.org)");
                        this._isEnabled = !0, this._timeout = 0, this._hoverState = "", this._activeTrigger = {}, this._popper = null, this.element = element, this.config = this._getConfig(config), this.tip = null, this._setListeners()
                    }

                    var _proto = Tooltip.prototype;
                    return _proto.enable = function() {
                        this._isEnabled = !0
                    }, _proto.disable = function() {
                        this._isEnabled = !1
                    }, _proto.toggleEnabled = function() {
                        this._isEnabled = !this._isEnabled
                    }, _proto.toggle = function(event) {
                        if (this._isEnabled)
                            if (event) {
                                var dataKey = this.constructor.DATA_KEY,
                                    context = $$$1(event.currentTarget).data(dataKey);
                                context || (context = new this.constructor(event.currentTarget, this._getDelegateConfig()), $$$1(event.currentTarget).data(dataKey, context)), context._activeTrigger.click = !context._activeTrigger.click, context._isWithActiveTrigger() ? context._enter(null, context) : context._leave(null, context)
                            } else {
                                if ($$$1(this.getTipElement()).hasClass(ClassName.SHOW)) return void this._leave(null, this);
                                this._enter(null, this)
                            }
                    }, _proto.dispose = function() {
                        clearTimeout(this._timeout), $$$1.removeData(this.element, this.constructor.DATA_KEY), $$$1(this.element).off(this.constructor.EVENT_KEY), $$$1(this.element).closest(".modal").off("hide.bs.modal"), this.tip && $$$1(this.tip).remove(), this._isEnabled = null, this._timeout = null, this._hoverState = null, this._activeTrigger = null, null !== this._popper && this._popper.destroy(), this._popper = null, this.element = null, this.config = null, this.tip = null
                    }, _proto.show = function() {
                        var _this = this;
                        if ("none" === $$$1(this.element).css("display")) throw new Error("Please use show on visible elements");
                        var showEvent = $$$1.Event(this.constructor.Event.SHOW);
                        if (this.isWithContent() && this._isEnabled) {
                            $$$1(this.element).trigger(showEvent);
                            var isInTheDom = $$$1.contains(this.element.ownerDocument.documentElement, this.element);
                            if (showEvent.isDefaultPrevented() || !isInTheDom) return;
                            var tip = this.getTipElement(),
                                tipId = Util.getUID(this.constructor.NAME);
                            tip.setAttribute("id", tipId), this.element.setAttribute("aria-describedby", tipId), this.setContent(), this.config.animation && $$$1(tip).addClass(ClassName.FADE);
                            var placement = "function" == typeof this.config.placement ? this.config.placement.call(this, tip, this.element) : this.config.placement,
                                attachment = this._getAttachment(placement);
                            this.addAttachmentClass(attachment);
                            var container = !1 === this.config.container ? document.body : $$$1(this.config.container);
                            $$$1(tip).data(this.constructor.DATA_KEY, this), $$$1.contains(this.element.ownerDocument.documentElement, this.tip) || $$$1(tip).appendTo(container), $$$1(this.element).trigger(this.constructor.Event.INSERTED), this._popper = new Popper(this.element, tip, {
                                placement: attachment,
                                modifiers: {
                                    offset: { offset: this.config.offset },
                                    flip: { behavior: this.config.fallbackPlacement },
                                    arrow: { element: Selector.ARROW },
                                    preventOverflow: { boundariesElement: this.config.boundary }
                                },
                                onCreate: function(data) {
                                    data.originalPlacement !== data.placement && _this._handlePopperPlacementChange(data)
                                },
                                onUpdate: function(data) {
                                    _this._handlePopperPlacementChange(data)
                                }
                            }), $$$1(tip).addClass(ClassName.SHOW), "ontouchstart" in document.documentElement && $$$1("body").children().on("mouseover", null, $$$1.noop);
                            var complete = function() {
                                _this.config.animation && _this._fixTransition();
                                var prevHoverState = _this._hoverState;
                                _this._hoverState = null, $$$1(_this.element).trigger(_this.constructor.Event.SHOWN), prevHoverState === HoverState.OUT && _this._leave(null, _this)
                            };
                            Util.supportsTransitionEnd() && $$$1(this.tip).hasClass(ClassName.FADE) ? $$$1(this.tip).one(Util.TRANSITION_END, complete).emulateTransitionEnd(Tooltip._TRANSITION_DURATION) : complete()
                        }
                    }, _proto.hide = function(callback) {
                        var _this2 = this,
                            tip = this.getTipElement(),
                            hideEvent = $$$1.Event(this.constructor.Event.HIDE),
                            complete = function() {
                                _this2._hoverState !== HoverState.SHOW && tip.parentNode && tip.parentNode.removeChild(tip), _this2._cleanTipClass(), _this2.element.removeAttribute("aria-describedby"), $$$1(_this2.element).trigger(_this2.constructor.Event.HIDDEN), null !== _this2._popper && _this2._popper.destroy(), callback && callback()
                            };
                        $$$1(this.element).trigger(hideEvent), hideEvent.isDefaultPrevented() || ($$$1(tip).removeClass(ClassName.SHOW), "ontouchstart" in document.documentElement && $$$1("body").children().off("mouseover", null, $$$1.noop), this._activeTrigger[Trigger.CLICK] = !1, this._activeTrigger[Trigger.FOCUS] = !1, this._activeTrigger[Trigger.HOVER] = !1, Util.supportsTransitionEnd() && $$$1(this.tip).hasClass(ClassName.FADE) ? $$$1(tip).one(Util.TRANSITION_END, complete).emulateTransitionEnd(150) : complete(), this._hoverState = "")
                    }, _proto.update = function() {
                        null !== this._popper && this._popper.scheduleUpdate()
                    }, _proto.isWithContent = function() {
                        return Boolean(this.getTitle())
                    }, _proto.addAttachmentClass = function(attachment) {
                        $$$1(this.getTipElement()).addClass("bs-tooltip-" + attachment)
                    }, _proto.getTipElement = function() {
                        return this.tip = this.tip || $$$1(this.config.template)[0], this.tip
                    }, _proto.setContent = function() {
                        var $tip = $$$1(this.getTipElement());
                        this.setElementContent($tip.find(Selector.TOOLTIP_INNER), this.getTitle()), $tip.removeClass(ClassName.FADE + " " + ClassName.SHOW)
                    }, _proto.setElementContent = function($element, content) {
                        var html = this.config.html;
                        "object" == typeof content && (content.nodeType || content.jquery) ? html ? $$$1(content).parent().is($element) || $element.empty().append(content) : $element.text($$$1(content).text()) : $element[html ? "html" : "text"](content)
                    }, _proto.getTitle = function() {
                        var title = this.element.getAttribute("data-original-title");
                        return title || (title = "function" == typeof this.config.title ? this.config.title.call(this.element) : this.config.title), title
                    }, _proto._getAttachment = function(placement) {
                        return AttachmentMap[placement.toUpperCase()]
                    }, _proto._setListeners = function() {
                        var _this3 = this;
                        this.config.trigger.split(" ").forEach(function(trigger) {
                            if ("click" === trigger) $$$1(_this3.element).on(_this3.constructor.Event.CLICK, _this3.config.selector, function(event) {
                                return _this3.toggle(event)
                            });
                            else if (trigger !== Trigger.MANUAL) {
                                var eventIn = trigger === Trigger.HOVER ? _this3.constructor.Event.MOUSEENTER : _this3.constructor.Event.FOCUSIN,
                                    eventOut = trigger === Trigger.HOVER ? _this3.constructor.Event.MOUSELEAVE : _this3.constructor.Event.FOCUSOUT;
                                $$$1(_this3.element).on(eventIn, _this3.config.selector, function(event) {
                                    return _this3._enter(event)
                                }).on(eventOut, _this3.config.selector, function(event) {
                                    return _this3._leave(event)
                                })
                            }
                            $$$1(_this3.element).closest(".modal").on("hide.bs.modal", function() {
                                return _this3.hide()
                            })
                        }), this.config.selector ? this.config = _extends({}, this.config, {
                            trigger: "manual",
                            selector: ""
                        }) : this._fixTitle()
                    }, _proto._fixTitle = function() {
                        var titleType = typeof this.element.getAttribute("data-original-title");
                        (this.element.getAttribute("title") || "string" !== titleType) && (this.element.setAttribute("data-original-title", this.element.getAttribute("title") || ""), this.element.setAttribute("title", ""))
                    }, _proto._enter = function(event, context) {
                        var dataKey = this.constructor.DATA_KEY;
                        return context = context || $$$1(event.currentTarget).data(dataKey), context || (context = new this.constructor(event.currentTarget, this._getDelegateConfig()), $$$1(event.currentTarget).data(dataKey, context)), event && (context._activeTrigger["focusin" === event.type ? Trigger.FOCUS : Trigger.HOVER] = !0), $$$1(context.getTipElement()).hasClass(ClassName.SHOW) || context._hoverState === HoverState.SHOW ? void(context._hoverState = HoverState.SHOW) : (clearTimeout(context._timeout), context._hoverState = HoverState.SHOW, context.config.delay && context.config.delay.show ? void(context._timeout = setTimeout(function() {
                            context._hoverState === HoverState.SHOW && context.show()
                        }, context.config.delay.show)) : void context.show())
                    }, _proto._leave = function(event, context) {
                        var dataKey = this.constructor.DATA_KEY;
                        if (context = context || $$$1(event.currentTarget).data(dataKey), context || (context = new this.constructor(event.currentTarget, this._getDelegateConfig()), $$$1(event.currentTarget).data(dataKey, context)), event && (context._activeTrigger["focusout" === event.type ? Trigger.FOCUS : Trigger.HOVER] = !1), !context._isWithActiveTrigger()) {
                            if (clearTimeout(context._timeout), context._hoverState = HoverState.OUT, !context.config.delay || !context.config.delay.hide) return void context.hide();
                            context._timeout = setTimeout(function() {
                                context._hoverState === HoverState.OUT && context.hide()
                            }, context.config.delay.hide)
                        }
                    }, _proto._isWithActiveTrigger = function() {
                        for (var trigger in this._activeTrigger)
                            if (this._activeTrigger[trigger]) return !0;
                        return !1
                    }, _proto._getConfig = function(config) {
                        return config = _extends({}, this.constructor.Default, $$$1(this.element).data(), config), "number" == typeof config.delay && (config.delay = {
                            show: config.delay,
                            hide: config.delay
                        }), "number" == typeof config.title && (config.title = config.title.toString()), "number" == typeof config.content && (config.content = config.content.toString()), Util.typeCheckConfig(NAME, config, this.constructor.DefaultType), config
                    }, _proto._getDelegateConfig = function() {
                        var config = {};
                        if (this.config)
                            for (var key in this.config) this.constructor.Default[key] !== this.config[key] && (config[key] = this.config[key]);
                        return config
                    }, _proto._cleanTipClass = function() {
                        var $tip = $$$1(this.getTipElement()),
                            tabClass = $tip.attr("class").match(BSCLS_PREFIX_REGEX);
                        null !== tabClass && tabClass.length > 0 && $tip.removeClass(tabClass.join(""))
                    }, _proto._handlePopperPlacementChange = function(data) {
                        this._cleanTipClass(), this.addAttachmentClass(this._getAttachment(data.placement))
                    }, _proto._fixTransition = function() {
                        var tip = this.getTipElement(),
                            initConfigAnimation = this.config.animation;
                        null === tip.getAttribute("x-placement") && ($$$1(tip).removeClass(ClassName.FADE), this.config.animation = !1, this.hide(), this.show(), this.config.animation = initConfigAnimation)
                    }, Tooltip._jQueryInterface = function(config) {
                        return this.each(function() {
                            var data = $$$1(this).data("bs.tooltip"),
                                _config = "object" == typeof config && config;
                            if ((data || !/dispose|hide/.test(config)) && (data || (data = new Tooltip(this, _config), $$$1(this).data("bs.tooltip", data)), "string" == typeof config)) {
                                if (void 0 === data[config]) throw new TypeError('No method named "' + config + '"');
                                data[config]()
                            }
                        })
                    }, _createClass(Tooltip, null, [{
                        key: "VERSION",
                        get: function() {
                            return "4.0.0"
                        }
                    }, {
                        key: "Default",
                        get: function() {
                            return Default
                        }
                    }, {
                        key: "NAME",
                        get: function() {
                            return NAME
                        }
                    }, {
                        key: "DATA_KEY",
                        get: function() {
                            return "bs.tooltip"
                        }
                    }, {
                        key: "Event",
                        get: function() {
                            return Event
                        }
                    }, {
                        key: "EVENT_KEY",
                        get: function() {
                            return EVENT_KEY
                        }
                    }, {
                        key: "DefaultType",
                        get: function() {
                            return DefaultType
                        }
                    }]), Tooltip
                }();
            return $$$1.fn[NAME] = Tooltip._jQueryInterface, $$$1.fn[NAME].Constructor = Tooltip, $$$1.fn[NAME].noConflict = function() {
                return $$$1.fn[NAME] = JQUERY_NO_CONFLICT, Tooltip._jQueryInterface
            }, Tooltip
        }($),
        Popover = function($$$1) {
            var NAME = "popover",
                EVENT_KEY = ".bs.popover",
                JQUERY_NO_CONFLICT = $$$1.fn[NAME],
                BSCLS_PREFIX_REGEX = new RegExp("(^|\\s)bs-popover\\S+", "g"),
                Default = _extends({}, Tooltip.Default, {
                    placement: "right",
                    trigger: "click",
                    content: "",
                    template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
                }),
                DefaultType = _extends({}, Tooltip.DefaultType, { content: "(string|element|function)" }),
                ClassName = { FADE: "fade", SHOW: "show" },
                Selector = { TITLE: ".popover-header", CONTENT: ".popover-body" },
                Event = {
                    HIDE: "hide" + EVENT_KEY,
                    HIDDEN: "hidden" + EVENT_KEY,
                    SHOW: "show" + EVENT_KEY,
                    SHOWN: "shown" + EVENT_KEY,
                    INSERTED: "inserted" + EVENT_KEY,
                    CLICK: "click" + EVENT_KEY,
                    FOCUSIN: "focusin" + EVENT_KEY,
                    FOCUSOUT: "focusout" + EVENT_KEY,
                    MOUSEENTER: "mouseenter" + EVENT_KEY,
                    MOUSELEAVE: "mouseleave" + EVENT_KEY
                },
                Popover = function(_Tooltip) {
                    function Popover() {
                        return _Tooltip.apply(this, arguments) || this
                    }

                    _inheritsLoose(Popover, _Tooltip);
                    var _proto = Popover.prototype;
                    return _proto.isWithContent = function() {
                        return this.getTitle() || this._getContent()
                    }, _proto.addAttachmentClass = function(attachment) {
                        $$$1(this.getTipElement()).addClass("bs-popover-" + attachment)
                    }, _proto.getTipElement = function() {
                        return this.tip = this.tip || $$$1(this.config.template)[0], this.tip
                    }, _proto.setContent = function() {
                        var $tip = $$$1(this.getTipElement());
                        this.setElementContent($tip.find(Selector.TITLE), this.getTitle());
                        var content = this._getContent();
                        "function" == typeof content && (content = content.call(this.element)), this.setElementContent($tip.find(Selector.CONTENT), content),
                            $tip.removeClass(ClassName.FADE + " " + ClassName.SHOW)
                    }, _proto._getContent = function() {
                        return this.element.getAttribute("data-content") || this.config.content
                    }, _proto._cleanTipClass = function() {
                        var $tip = $$$1(this.getTipElement()),
                            tabClass = $tip.attr("class").match(BSCLS_PREFIX_REGEX);
                        null !== tabClass && tabClass.length > 0 && $tip.removeClass(tabClass.join(""))
                    }, Popover._jQueryInterface = function(config) {
                        return this.each(function() {
                            var data = $$$1(this).data("bs.popover"),
                                _config = "object" == typeof config ? config : null;
                            if ((data || !/destroy|hide/.test(config)) && (data || (data = new Popover(this, _config), $$$1(this).data("bs.popover", data)), "string" == typeof config)) {
                                if (void 0 === data[config]) throw new TypeError('No method named "' + config + '"');
                                data[config]()
                            }
                        })
                    }, _createClass(Popover, null, [{
                        key: "VERSION",
                        get: function() {
                            return "4.0.0"
                        }
                    }, {
                        key: "Default",
                        get: function() {
                            return Default
                        }
                    }, {
                        key: "NAME",
                        get: function() {
                            return NAME
                        }
                    }, {
                        key: "DATA_KEY",
                        get: function() {
                            return "bs.popover"
                        }
                    }, {
                        key: "Event",
                        get: function() {
                            return Event
                        }
                    }, {
                        key: "EVENT_KEY",
                        get: function() {
                            return EVENT_KEY
                        }
                    }, {
                        key: "DefaultType",
                        get: function() {
                            return DefaultType
                        }
                    }]), Popover
                }(Tooltip);
            return $$$1.fn[NAME] = Popover._jQueryInterface, $$$1.fn[NAME].Constructor = Popover, $$$1.fn[NAME].noConflict = function() {
                return $$$1.fn[NAME] = JQUERY_NO_CONFLICT, Popover._jQueryInterface
            }, Popover
        }($),
        ScrollSpy = function($$$1) {
            var NAME = "scrollspy",
                JQUERY_NO_CONFLICT = $$$1.fn[NAME],
                Default = { offset: 10, method: "auto", target: "" },
                DefaultType = { offset: "number", method: "string", target: "(string|element)" },
                Event = {
                    ACTIVATE: "activate.bs.scrollspy",
                    SCROLL: "scroll.bs.scrollspy",
                    LOAD_DATA_API: "load.bs.scrollspy.data-api"
                },
                ClassName = { DROPDOWN_ITEM: "dropdown-item", DROPDOWN_MENU: "dropdown-menu", ACTIVE: "active" },
                Selector = {
                    DATA_SPY: '[data-spy="scroll"]',
                    ACTIVE: ".active",
                    NAV_LIST_GROUP: ".nav, .list-group",
                    NAV_LINKS: ".nav-link",
                    NAV_ITEMS: ".nav-item",
                    LIST_ITEMS: ".list-group-item",
                    DROPDOWN: ".dropdown",
                    DROPDOWN_ITEMS: ".dropdown-item",
                    DROPDOWN_TOGGLE: ".dropdown-toggle"
                },
                OffsetMethod = { OFFSET: "offset", POSITION: "position" },
                ScrollSpy = function() {
                    function ScrollSpy(element, config) {
                        var _this = this;
                        this._element = element, this._scrollElement = "BODY" === element.tagName ? window : element, this._config = this._getConfig(config), this._selector = this._config.target + " " + Selector.NAV_LINKS + "," + this._config.target + " " + Selector.LIST_ITEMS + "," + this._config.target + " " + Selector.DROPDOWN_ITEMS, this._offsets = [], this._targets = [], this._activeTarget = null, this._scrollHeight = 0, $$$1(this._scrollElement).on(Event.SCROLL, function(event) {
                            return _this._process(event)
                        }), this.refresh(), this._process()
                    }

                    var _proto = ScrollSpy.prototype;
                    return _proto.refresh = function() {
                        var _this2 = this,
                            autoMethod = this._scrollElement === this._scrollElement.window ? OffsetMethod.OFFSET : OffsetMethod.POSITION,
                            offsetMethod = "auto" === this._config.method ? autoMethod : this._config.method,
                            offsetBase = offsetMethod === OffsetMethod.POSITION ? this._getScrollTop() : 0;
                        this._offsets = [], this._targets = [], this._scrollHeight = this._getScrollHeight(), $$$1.makeArray($$$1(this._selector)).map(function(element) {
                            var target, targetSelector = Util.getSelectorFromElement(element);
                            if (targetSelector && (target = $$$1(targetSelector)[0]), target) {
                                var targetBCR = target.getBoundingClientRect();
                                if (targetBCR.width || targetBCR.height) return [$$$1(target)[offsetMethod]().top + offsetBase, targetSelector]
                            }
                            return null
                        }).filter(function(item) {
                            return item
                        }).sort(function(a, b) {
                            return a[0] - b[0]
                        }).forEach(function(item) {
                            _this2._offsets.push(item[0]), _this2._targets.push(item[1])
                        })
                    }, _proto.dispose = function() {
                        $$$1.removeData(this._element, "bs.scrollspy"), $$$1(this._scrollElement).off(".bs.scrollspy"), this._element = null, this._scrollElement = null, this._config = null, this._selector = null, this._offsets = null, this._targets = null, this._activeTarget = null, this._scrollHeight = null
                    }, _proto._getConfig = function(config) {
                        if (config = _extends({}, Default, config), "string" != typeof config.target) {
                            var id = $$$1(config.target).attr("id");
                            id || (id = Util.getUID(NAME), $$$1(config.target).attr("id", id)), config.target = "#" + id
                        }
                        return Util.typeCheckConfig(NAME, config, DefaultType), config
                    }, _proto._getScrollTop = function() {
                        return this._scrollElement === window ? this._scrollElement.pageYOffset : this._scrollElement.scrollTop
                    }, _proto._getScrollHeight = function() {
                        return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight)
                    }, _proto._getOffsetHeight = function() {
                        return this._scrollElement === window ? window.innerHeight : this._scrollElement.getBoundingClientRect().height
                    }, _proto._process = function() {
                        var scrollTop = this._getScrollTop() + this._config.offset,
                            scrollHeight = this._getScrollHeight(),
                            maxScroll = this._config.offset + scrollHeight - this._getOffsetHeight();
                        if (this._scrollHeight !== scrollHeight && this.refresh(), scrollTop >= maxScroll) {
                            var target = this._targets[this._targets.length - 1];
                            return void(this._activeTarget !== target && this._activate(target))
                        }
                        if (this._activeTarget && scrollTop < this._offsets[0] && this._offsets[0] > 0) return this._activeTarget = null, void this._clear();
                        for (var i = this._offsets.length; i--;) {
                            this._activeTarget !== this._targets[i] && scrollTop >= this._offsets[i] && (void 0 === this._offsets[i + 1] || scrollTop < this._offsets[i + 1]) && this._activate(this._targets[i])
                        }
                    }, _proto._activate = function(target) {
                        this._activeTarget = target, this._clear();
                        var queries = this._selector.split(",");
                        queries = queries.map(function(selector) {
                            return selector + '[data-target="' + target + '"],' + selector + '[href="' + target + '"]'
                        });
                        var $link = $$$1(queries.join(","));
                        $link.hasClass(ClassName.DROPDOWN_ITEM) ? ($link.closest(Selector.DROPDOWN).find(Selector.DROPDOWN_TOGGLE).addClass(ClassName.ACTIVE), $link.addClass(ClassName.ACTIVE)) : ($link.addClass(ClassName.ACTIVE), $link.parents(Selector.NAV_LIST_GROUP).prev(Selector.NAV_LINKS + ", " + Selector.LIST_ITEMS).addClass(ClassName.ACTIVE), $link.parents(Selector.NAV_LIST_GROUP).prev(Selector.NAV_ITEMS).children(Selector.NAV_LINKS).addClass(ClassName.ACTIVE)), $$$1(this._scrollElement).trigger(Event.ACTIVATE, { relatedTarget: target })
                    }, _proto._clear = function() {
                        $$$1(this._selector).filter(Selector.ACTIVE).removeClass(ClassName.ACTIVE)
                    }, ScrollSpy._jQueryInterface = function(config) {
                        return this.each(function() {
                            var data = $$$1(this).data("bs.scrollspy"),
                                _config = "object" == typeof config && config;
                            if (data || (data = new ScrollSpy(this, _config), $$$1(this).data("bs.scrollspy", data)), "string" == typeof config) {
                                if (void 0 === data[config]) throw new TypeError('No method named "' + config + '"');
                                data[config]()
                            }
                        })
                    }, _createClass(ScrollSpy, null, [{
                        key: "VERSION",
                        get: function() {
                            return "4.0.0"
                        }
                    }, {
                        key: "Default",
                        get: function() {
                            return Default
                        }
                    }]), ScrollSpy
                }();
            return $$$1(window).on(Event.LOAD_DATA_API, function() {
                for (var scrollSpys = $$$1.makeArray($$$1(Selector.DATA_SPY)), i = scrollSpys.length; i--;) {
                    var $spy = $$$1(scrollSpys[i]);
                    ScrollSpy._jQueryInterface.call($spy, $spy.data())
                }
            }), $$$1.fn[NAME] = ScrollSpy._jQueryInterface, $$$1.fn[NAME].Constructor = ScrollSpy, $$$1.fn[NAME].noConflict = function() {
                return $$$1.fn[NAME] = JQUERY_NO_CONFLICT, ScrollSpy._jQueryInterface
            }, ScrollSpy
        }($),
        Tab = function($$$1) {
            var JQUERY_NO_CONFLICT = $$$1.fn.tab,
                Event = {
                    HIDE: "hide.bs.tab",
                    HIDDEN: "hidden.bs.tab",
                    SHOW: "show.bs.tab",
                    SHOWN: "shown.bs.tab",
                    CLICK_DATA_API: "click.bs.tab.data-api"
                },
                ClassName = {
                    DROPDOWN_MENU: "dropdown-menu",
                    ACTIVE: "active",
                    DISABLED: "disabled",
                    FADE: "fade",
                    SHOW: "show"
                },
                Selector = {
                    DROPDOWN: ".dropdown",
                    NAV_LIST_GROUP: ".nav, .list-group",
                    ACTIVE: ".active",
                    ACTIVE_UL: "> li > .active",
                    DATA_TOGGLE: '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',
                    DROPDOWN_TOGGLE: ".dropdown-toggle",
                    DROPDOWN_ACTIVE_CHILD: "> .dropdown-menu .active"
                },
                Tab = function() {
                    function Tab(element) {
                        this._element = element
                    }

                    var _proto = Tab.prototype;
                    return _proto.show = function() {
                        var _this = this;
                        if (!(this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && $$$1(this._element).hasClass(ClassName.ACTIVE) || $$$1(this._element).hasClass(ClassName.DISABLED))) {
                            var target, previous, listElement = $$$1(this._element).closest(Selector.NAV_LIST_GROUP)[0],
                                selector = Util.getSelectorFromElement(this._element);
                            if (listElement) {
                                var itemSelector = "UL" === listElement.nodeName ? Selector.ACTIVE_UL : Selector.ACTIVE;
                                previous = $$$1.makeArray($$$1(listElement).find(itemSelector)), previous = previous[previous.length - 1]
                            }
                            var hideEvent = $$$1.Event(Event.HIDE, { relatedTarget: this._element }),
                                showEvent = $$$1.Event(Event.SHOW, { relatedTarget: previous });
                            if (previous && $$$1(previous).trigger(hideEvent), $$$1(this._element).trigger(showEvent), !showEvent.isDefaultPrevented() && !hideEvent.isDefaultPrevented()) {
                                selector && (target = $$$1(selector)[0]), this._activate(this._element, listElement);
                                var complete = function() {
                                    var hiddenEvent = $$$1.Event(Event.HIDDEN, { relatedTarget: _this._element }),
                                        shownEvent = $$$1.Event(Event.SHOWN, { relatedTarget: previous });
                                    $$$1(previous).trigger(hiddenEvent), $$$1(_this._element).trigger(shownEvent)
                                };
                                target ? this._activate(target, target.parentNode, complete) : complete()
                            }
                        }
                    }, _proto.dispose = function() {
                        $$$1.removeData(this._element, "bs.tab"), this._element = null
                    }, _proto._activate = function(element, container, callback) {
                        var activeElements, _this2 = this;
                        activeElements = "UL" === container.nodeName ? $$$1(container).find(Selector.ACTIVE_UL) : $$$1(container).children(Selector.ACTIVE);
                        var active = activeElements[0],
                            isTransitioning = callback && Util.supportsTransitionEnd() && active && $$$1(active).hasClass(ClassName.FADE),
                            complete = function() {
                                return _this2._transitionComplete(element, active, callback)
                            };
                        active && isTransitioning ? $$$1(active).one(Util.TRANSITION_END, complete).emulateTransitionEnd(150) : complete()
                    }, _proto._transitionComplete = function(element, active, callback) {
                        if (active) {
                            $$$1(active).removeClass(ClassName.SHOW + " " + ClassName.ACTIVE);
                            var dropdownChild = $$$1(active.parentNode).find(Selector.DROPDOWN_ACTIVE_CHILD)[0];
                            dropdownChild && $$$1(dropdownChild).removeClass(ClassName.ACTIVE), "tab" === active.getAttribute("role") && active.setAttribute("aria-selected", !1)
                        }
                        if ($$$1(element).addClass(ClassName.ACTIVE), "tab" === element.getAttribute("role") && element.setAttribute("aria-selected", !0), Util.reflow(element), $$$1(element).addClass(ClassName.SHOW), element.parentNode && $$$1(element.parentNode).hasClass(ClassName.DROPDOWN_MENU)) {
                            var dropdownElement = $$$1(element).closest(Selector.DROPDOWN)[0];
                            dropdownElement && $$$1(dropdownElement).find(Selector.DROPDOWN_TOGGLE).addClass(ClassName.ACTIVE), element.setAttribute("aria-expanded", !0)
                        }
                        callback && callback()
                    }, Tab._jQueryInterface = function(config) {
                        return this.each(function() {
                            var $this = $$$1(this),
                                data = $this.data("bs.tab");
                            if (data || (data = new Tab(this), $this.data("bs.tab", data)), "string" == typeof config) {
                                if (void 0 === data[config]) throw new TypeError('No method named "' + config + '"');
                                data[config]()
                            }
                        })
                    }, _createClass(Tab, null, [{
                        key: "VERSION",
                        get: function() {
                            return "4.0.0"
                        }
                    }]), Tab
                }();
            return $$$1(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function(event) {
                event.preventDefault(), Tab._jQueryInterface.call($$$1(this), "show")
            }), $$$1.fn.tab = Tab._jQueryInterface, $$$1.fn.tab.Constructor = Tab, $$$1.fn.tab.noConflict = function() {
                return $$$1.fn.tab = JQUERY_NO_CONFLICT, Tab._jQueryInterface
            }, Tab
        }($);
    ! function($$$1) {
        if (void 0 === $$$1) throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");
        var version = $$$1.fn.jquery.split(" ")[0].split(".");
        if (version[0] < 2 && version[1] < 9 || 1 === version[0] && 9 === version[1] && version[2] < 1 || version[0] >= 4) throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")
    }($), exports.Util = Util, exports.Alert = Alert, exports.Button = Button, exports.Carousel = Carousel, exports.Collapse = Collapse, exports.Dropdown = Dropdown, exports.Modal = Modal, exports.Popover = Popover, exports.Scrollspy = ScrollSpy, exports.Tab = Tab, exports.Tooltip = Tooltip, Object.defineProperty(exports, "__esModule", { value: !0 })
}),
function() {
    var a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H, I, J, K,
        L, M, N, O, P, Q, R, S, T, U, V, W, X = [].slice,
        Y = {}.hasOwnProperty,
        Z = function(a, b) {
            function c() {
                this.constructor = a
            }

            for (var d in b) Y.call(b, d) && (a[d] = b[d]);
            return c.prototype = b.prototype, a.prototype = new c, a.__super__ = b.prototype, a
        },
        $ = [].indexOf || function(a) {
            for (var b = 0, c = this.length; c > b; b++)
                if (b in this && this[b] === a) return b;
            return -1
        };
    for (u = {
            catchupTime: 100,
            initialRate: .03,
            minTime: 250,
            ghostTime: 100,
            maxProgressPerFrame: 20,
            easeFactor: 1.25,
            startOnPageLoad: !0,
            restartOnPushState: !0,
            restartOnRequestAfter: 500,
            target: "body",
            elements: { checkInterval: 100, selectors: ["body"] },
            eventLag: { minSamples: 10, sampleCount: 3, lagThreshold: 3 },
            ajax: { trackMethods: ["GET"], trackWebSockets: !0, ignoreURLs: [] }
        }, C = function() {
            var a;
            return null != (a = "undefined" != typeof performance && null !== performance && "function" == typeof performance.now ? performance.now() : void 0) ? a : +new Date
        }, E = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame, t = window.cancelAnimationFrame || window.mozCancelAnimationFrame, null == E && (E = function(a) {
            return setTimeout(a, 50)
        }, t = function(a) {
            return clearTimeout(a)
        }), G = function(a) {
            var b, c;
            return b = C(), (c = function() {
                var d;
                return d = C() - b, d >= 33 ? (b = C(), a(d, function() {
                    return E(c)
                })) : setTimeout(c, 33 - d)
            })()
        }, F = function() {
            var a, b, c;
            return c = arguments[0], b = arguments[1], a = 3 <= arguments.length ? X.call(arguments, 2) : [], "function" == typeof c[b] ? c[b].apply(c, a) : c[b]
        }, v = function() {
            var a, b, c, d, e, f, g;
            for (b = arguments[0], d = 2 <= arguments.length ? X.call(arguments, 1) : [], f = 0, g = d.length; g > f; f++)
                if (c = d[f])
                    for (a in c) Y.call(c, a) && (e = c[a], null != b[a] && "object" == typeof b[a] && null != e && "object" == typeof e ? v(b[a], e) : b[a] = e);
            return b
        }, q = function(a) {
            var b, c, d, e, f;
            for (c = b = 0, e = 0, f = a.length; f > e; e++) d = a[e], c += Math.abs(d), b++;
            return c / b
        }, x = function(a, b) {
            var c, d, e;
            if (null == a && (a = "options"), null == b && (b = !0), e = document.querySelector("[data-pace-" + a + "]")) {
                if (c = e.getAttribute("data-pace-" + a), !b) return c;
                try {
                    return JSON.parse(c)
                } catch (f) {
                    return d = f, "undefined" != typeof console && null !== console ? console.error("Error parsing inline pace options", d) : void 0
                }
            }
        }, g = function() {
            function a() {}

            return a.prototype.on = function(a, b, c, d) {
                var e;
                return null == d && (d = !1), null == this.bindings && (this.bindings = {}), null == (e = this.bindings)[a] && (e[a] = []), this.bindings[a].push({
                    handler: b,
                    ctx: c,
                    once: d
                })
            }, a.prototype.once = function(a, b, c) {
                return this.on(a, b, c, !0)
            }, a.prototype.off = function(a, b) {
                var c, d, e;
                if (null != (null != (d = this.bindings) ? d[a] : void 0)) {
                    if (null == b) return delete this.bindings[a];
                    for (c = 0, e = []; c < this.bindings[a].length;) e.push(this.bindings[a][c].handler === b ? this.bindings[a].splice(c, 1) : c++);
                    return e
                }
            }, a.prototype.trigger = function() {
                var a, b, c, d, e, f, g, h, i;
                if (c = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], null != (g = this.bindings) ? g[c] : void 0) {
                    for (e = 0, i = []; e < this.bindings[c].length;) h = this.bindings[c][e], d = h.handler, b = h.ctx, f = h.once, d.apply(null != b ? b : this, a), i.push(f ? this.bindings[c].splice(e, 1) : e++);
                    return i
                }
            }, a
        }(), j = window.Pace || {}, window.Pace = j, v(j, g.prototype), D = j.options = v({}, u, window.paceOptions, x()), U = ["ajax", "document", "eventLag", "elements"], Q = 0, S = U.length; S > Q; Q++) K = U[Q], !0 === D[K] && (D[K] = u[K]);
    i = function(a) {
        function b() {
            return V = b.__super__.constructor.apply(this, arguments)
        }

        return Z(b, a), b
    }(Error), b = function() {
        function a() {
            this.progress = 0
        }

        return a.prototype.getElement = function() {
            var a;
            if (null == this.el) {
                if (!(a = document.querySelector(D.target))) throw new i;
                this.el = document.createElement("div"), this.el.className = "pace pace-active", document.body.className = document.body.className.replace(/pace-done/g, ""), document.body.className += " pace-running", this.el.innerHTML = '<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>', null != a.firstChild ? a.insertBefore(this.el, a.firstChild) : a.appendChild(this.el)
            }
            return this.el
        }, a.prototype.finish = function() {
            var a;
            return a = this.getElement(), a.className = a.className.replace("pace-active", ""), a.className += " pace-inactive", document.body.className = document.body.className.replace("pace-running", ""), document.body.className += " pace-done"
        }, a.prototype.update = function(a) {
            return this.progress = a, this.render()
        }, a.prototype.destroy = function() {
            try {
                this.getElement().parentNode.removeChild(this.getElement())
            } catch (a) {
                i = a
            }
            return this.el = void 0
        }, a.prototype.render = function() {
            var a, b, c, d, e, f, g;
            if (null == document.querySelector(D.target)) return !1;
            for (a = this.getElement(), d = "translate3d(" + this.progress + "%, 0, 0)", g = ["webkitTransform", "msTransform", "transform"], e = 0, f = g.length; f > e; e++) b = g[e], a.children[0].style[b] = d;
            return (!this.lastRenderedProgress || this.lastRenderedProgress | 0 !== this.progress | 0) && (a.children[0].setAttribute("data-progress-text", (0 | this.progress) + "%"), this.progress >= 100 ? c = "99" : (c = this.progress < 10 ? "0" : "", c += 0 | this.progress), a.children[0].setAttribute("data-progress", "" + c)), this.lastRenderedProgress = this.progress
        }, a.prototype.done = function() {
            return this.progress >= 100
        }, a
    }(), h = function() {
        function a() {
            this.bindings = {}
        }

        return a.prototype.trigger = function(a, b) {
            var c, d, e, f, g;
            if (null != this.bindings[a]) {
                for (f = this.bindings[a], g = [], d = 0, e = f.length; e > d; d++) c = f[d], g.push(c.call(this, b));
                return g
            }
        }, a.prototype.on = function(a, b) {
            var c;
            return null == (c = this.bindings)[a] && (c[a] = []), this.bindings[a].push(b)
        }, a
    }(), P = window.XMLHttpRequest, O = window.XDomainRequest, N = window.WebSocket, w = function(a, b) {
        var d, e;
        e = [];
        for (d in b.prototype) try {
            e.push(null == a[d] && "function" != typeof b[d] ? "function" == typeof Object.defineProperty ? Object.defineProperty(a, d, {
                get: function() {
                    return b.prototype[d]
                },
                configurable: !0,
                enumerable: !0
            }) : a[d] = b.prototype[d] : void 0)
        } catch (f) {
            f
        }
        return e
    }, A = [], j.ignore = function() {
        var a, b, c;
        return b = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], A.unshift("ignore"), c = b.apply(null, a), A.shift(), c
    }, j.track = function() {
        var a, b, c;
        return b = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], A.unshift("track"), c = b.apply(null, a), A.shift(), c
    }, J = function(a) {
        var b;
        if (null == a && (a = "GET"), "track" === A[0]) return "force";
        if (!A.length && D.ajax) {
            if ("socket" === a && D.ajax.trackWebSockets) return !0;
            if (b = a.toUpperCase(), $.call(D.ajax.trackMethods, b) >= 0) return !0
        }
        return !1
    }, k = function(a) {
        function b() {
            var a, c = this;
            b.__super__.constructor.apply(this, arguments), a = function(a) {
                var b;
                return b = a.open, a.open = function(d, e) {
                    return J(d) && c.trigger("request", { type: d, url: e, request: a }), b.apply(a, arguments)
                }
            }, window.XMLHttpRequest = function(b) {
                var c;
                return c = new P(b), a(c), c
            };
            try {
                w(window.XMLHttpRequest, P)
            } catch (d) {}
            if (null != O) {
                window.XDomainRequest = function() {
                    var b;
                    return b = new O, a(b), b
                };
                try {
                    w(window.XDomainRequest, O)
                } catch (d) {}
            }
            if (null != N && D.ajax.trackWebSockets) {
                window.WebSocket = function(a, b) {
                    var d;
                    return d = null != b ? new N(a, b) : new N(a), J("socket") && c.trigger("request", {
                        type: "socket",
                        url: a,
                        protocols: b,
                        request: d
                    }), d
                };
                try {
                    w(window.WebSocket, N)
                } catch (d) {}
            }
        }

        return Z(b, a), b
    }(h), R = null, y = function() {
        return null == R && (R = new k), R
    }, I = function(a) {
        var b, c, d, e;
        for (e = D.ajax.ignoreURLs, c = 0, d = e.length; d > c; c++)
            if ("string" == typeof(b = e[c])) {
                if (-1 !== a.indexOf(b)) return !0
            } else if (b.test(a)) return !0;
        return !1
    }, y().on("request", function(b) {
        var c, d, e, f, g;
        return f = b.type, e = b.request, g = b.url, I(g) ? void 0 : j.running || !1 === D.restartOnRequestAfter && "force" !== J(f) ? void 0 : (d = arguments, c = D.restartOnRequestAfter || 0, "boolean" == typeof c && (c = 0), setTimeout(function() {
            var c, g, h, i, k;
            if ("socket" === f ? e.readyState < 2 : 0 < (h = e.readyState) && 4 > h) {
                for (j.restart(), i = j.sources, k = [], c = 0, g = i.length; g > c; c++) {
                    if ((K = i[c]) instanceof a) {
                        K.watch.apply(K, d);
                        break
                    }
                    k.push(void 0)
                }
                return k
            }
        }, c))
    }), a = function() {
        function a() {
            var a = this;
            this.elements = [], y().on("request", function() {
                return a.watch.apply(a, arguments)
            })
        }

        return a.prototype.watch = function(a) {
            var b, c, d, e;
            return d = a.type, b = a.request, e = a.url, I(e) ? void 0 : (c = "socket" === d ? new n(b) : new o(b), this.elements.push(c))
        }, a
    }(), o = function() {
        function a(a) {
            var b, d, e, f, g, h = this;
            if (this.progress = 0, null != window.ProgressEvent)
                for (null, a.addEventListener("progress", function(a) {
                        return h.progress = a.lengthComputable ? 100 * a.loaded / a.total : h.progress + (100 - h.progress) / 2
                    }, !1), g = ["load", "abort", "timeout", "error"], d = 0, e = g.length; e > d; d++) b = g[d], a.addEventListener(b, function() {
                    return h.progress = 100
                }, !1);
            else f = a.onreadystatechange, a.onreadystatechange = function() {
                var b;
                return 0 === (b = a.readyState) || 4 === b ? h.progress = 100 : 3 === a.readyState && (h.progress = 50), "function" == typeof f ? f.apply(null, arguments) : void 0
            }
        }

        return a
    }(), n = function() {
        function a(a) {
            var b, c, d, e, f = this;
            for (this.progress = 0, e = ["error", "open"], c = 0, d = e.length; d > c; c++) b = e[c], a.addEventListener(b, function() {
                return f.progress = 100
            }, !1)
        }

        return a
    }(), d = function() {
        function a(a) {
            var b, c, d, f;
            for (null == a && (a = {}), this.elements = [], null == a.selectors && (a.selectors = []), f = a.selectors, c = 0, d = f.length; d > c; c++) b = f[c], this.elements.push(new e(b))
        }

        return a
    }(), e = function() {
        function a(a) {
            this.selector = a, this.progress = 0, this.check()
        }

        return a.prototype.check = function() {
            var a = this;
            return document.querySelector(this.selector) ? this.done() : setTimeout(function() {
                return a.check()
            }, D.elements.checkInterval)
        }, a.prototype.done = function() {
            return this.progress = 100
        }, a
    }(), c = function() {
        function a() {
            var a, b, c = this;
            this.progress = null != (b = this.states[document.readyState]) ? b : 100, a = document.onreadystatechange, document.onreadystatechange = function() {
                return null != c.states[document.readyState] && (c.progress = c.states[document.readyState]), "function" == typeof a ? a.apply(null, arguments) : void 0
            }
        }

        return a.prototype.states = { loading: 0, interactive: 50, complete: 100 }, a
    }(), f = function() {
        function a() {
            var a, b, c, d, e, f = this;
            this.progress = 0, a = 0, e = [], d = 0, c = C(), b = setInterval(function() {
                var g;
                return g = C() - c - 50, c = C(), e.push(g), e.length > D.eventLag.sampleCount && e.shift(), a = q(e), ++d >= D.eventLag.minSamples && a < D.eventLag.lagThreshold ? (f.progress = 100, clearInterval(b)) : f.progress = 3 / (a + 3) * 100
            }, 50)
        }

        return a
    }(), m = function() {
        function a(a) {
            this.source = a, this.last = this.sinceLastUpdate = 0, this.rate = D.initialRate, this.catchup = 0, this.progress = this.lastProgress = 0, null != this.source && (this.progress = F(this.source, "progress"))
        }

        return a.prototype.tick = function(a, b) {
            var c;
            return null == b && (b = F(this.source, "progress")), b >= 100 && (this.done = !0), b === this.last ? this.sinceLastUpdate += a : (this.sinceLastUpdate && (this.rate = (b - this.last) / this.sinceLastUpdate), this.catchup = (b - this.progress) / D.catchupTime, this.sinceLastUpdate = 0, this.last = b), b > this.progress && (this.progress += this.catchup * a), c = 1 - Math.pow(this.progress / 100, D.easeFactor), this.progress += c * this.rate * a, this.progress = Math.min(this.lastProgress + D.maxProgressPerFrame, this.progress), this.progress = Math.max(0, this.progress), this.progress = Math.min(100, this.progress), this.lastProgress = this.progress, this.progress
        }, a
    }(), L = null, H = null, r = null, M = null, p = null, s = null, j.running = !1, z = function() {
        return D.restartOnPushState ? j.restart() : void 0
    }, null != window.history.pushState && (T = window.history.pushState, window.history.pushState = function() {
        return z(), T.apply(window.history, arguments)
    }), null != window.history.replaceState && (W = window.history.replaceState, window.history.replaceState = function() {
        return z(), W.apply(window.history, arguments)
    }), l = { ajax: a, elements: d, document: c, eventLag: f }, (B = function() {
        var a, c, d, e, f, g, h, i;
        for (j.sources = L = [], g = ["ajax", "elements", "document", "eventLag"], c = 0, e = g.length; e > c; c++) a = g[c], !1 !== D[a] && L.push(new l[a](D[a]));
        for (i = null != (h = D.extraSources) ? h : [], d = 0, f = i.length; f > d; d++) K = i[d], L.push(new K(D));
        return j.bar = r = new b, H = [], M = new m
    })(), j.stop = function() {
        return j.trigger("stop"), j.running = !1, r.destroy(), s = !0, null != p && ("function" == typeof t && t(p), p = null), B()
    }, j.restart = function() {
        return j.trigger("restart"), j.stop(), j.start()
    }, j.go = function() {
        var a;
        return j.running = !0, r.render(), a = C(), s = !1, p = G(function(b, c) {
            var d, e, f, g, h, i, k, n, o, p, q, t, u, v, w;
            for (100 - r.progress, e = p = 0, f = !0, i = q = 0, u = L.length; u > q; i = ++q)
                for (K = L[i], o = null != H[i] ? H[i] : H[i] = [], h = null != (w = K.elements) ? w : [K], k = t = 0, v = h.length; v > t; k = ++t) g = h[k], n = null != o[k] ? o[k] : o[k] = new m(g), f &= n.done, n.done || (e++, p += n.tick(b));
            return d = p / e, r.update(M.tick(b, d)), r.done() || f || s ? (r.update(100), j.trigger("done"), setTimeout(function() {
                return r.finish(), j.running = !1, j.trigger("hide")
            }, Math.max(D.ghostTime, Math.max(D.minTime - (C() - a), 0)))) : c()
        })
    }, j.start = function(a) {
        v(D, a), j.running = !0;
        try {
            r.render()
        } catch (b) {
            i = b
        }
        return document.querySelector(".pace") ? (j.trigger("start"), j.go()) : setTimeout(j.start, 50)
    }, "function" == typeof define && define.amd ? define(["pace"], function() {
        return j
    }) : "object" == typeof exports ? module.exports = j : D.startOnPageLoad && j.start()
}.call(this),
    function e(t, n, r) {
        function s(o, u) {
            if (!n[o]) {
                if (!t[o]) {
                    var a = "function" == typeof require && require;
                    if (!u && a) return a(o, !0);
                    if (i) return i(o, !0);
                    var f = new Error("Cannot find module '" + o + "'");
                    throw f.code = "MODULE_NOT_FOUND", f
                }
                var l = n[o] = { exports: {} };
                t[o][0].call(l.exports, function(e) {
                    var n = t[o][1][e];
                    return s(n || e)
                }, l, l.exports, e, t, n, r)
            }
            return n[o].exports
        }

        for (var i = "function" == typeof require && require, o = 0; o < r.length; o++) s(r[o]);
        return s
    }({
        1: [function(require, module, exports) {
            "use strict";

            function mountJQuery(jQuery) {
                jQuery.fn.perfectScrollbar = function(settingOrCommand) {
                    return this.each(function() {
                        if ("object" == typeof settingOrCommand || void 0 === settingOrCommand) {
                            var settings = settingOrCommand;
                            psInstances.get(this) || ps.initialize(this, settings)
                        } else {
                            var command = settingOrCommand;
                            "update" === command ? ps.update(this) : "destroy" === command && ps.destroy(this)
                        }
                    })
                }
            }

            var ps = require("../main"),
                psInstances = require("../plugin/instances");
            if ("function" == typeof define && define.amd) define(["jquery"], mountJQuery);
            else {
                var jq = window.jQuery ? window.jQuery : window.$;
                void 0 !== jq && mountJQuery(jq)
            }
            module.exports = mountJQuery
        }, { "../main": 7, "../plugin/instances": 18 }],
        2: [function(require, module, exports) {
            "use strict";

            function oldAdd(element, className) {
                var classes = element.className.split(" ");
                classes.indexOf(className) < 0 && classes.push(className), element.className = classes.join(" ")
            }

            function oldRemove(element, className) {
                var classes = element.className.split(" "),
                    idx = classes.indexOf(className);
                idx >= 0 && classes.splice(idx, 1), element.className = classes.join(" ")
            }

            exports.add = function(element, className) {
                element.classList ? element.classList.add(className) : oldAdd(element, className)
            }, exports.remove = function(element, className) {
                element.classList ? element.classList.remove(className) : oldRemove(element, className)
            }, exports.list = function(element) {
                return element.classList ? Array.prototype.slice.apply(element.classList) : element.className.split(" ")
            }
        }, {}],
        3: [function(require, module, exports) {
            "use strict";

            function cssGet(element, styleName) {
                return window.getComputedStyle(element)[styleName]
            }

            function cssSet(element, styleName, styleValue) {
                return "number" == typeof styleValue && (styleValue = styleValue.toString() + "px"), element.style[styleName] = styleValue, element
            }

            function cssMultiSet(element, obj) {
                for (var key in obj) {
                    var val = obj[key];
                    "number" == typeof val && (val = val.toString() + "px"), element.style[key] = val
                }
                return element
            }

            var DOM = {};
            DOM.e = function(tagName, className) {
                var element = document.createElement(tagName);
                return element.className = className, element
            }, DOM.appendTo = function(child, parent) {
                return parent.appendChild(child), child
            }, DOM.css = function(element, styleNameOrObject, styleValue) {
                return "object" == typeof styleNameOrObject ? cssMultiSet(element, styleNameOrObject) : void 0 === styleValue ? cssGet(element, styleNameOrObject) : cssSet(element, styleNameOrObject, styleValue)
            }, DOM.matches = function(element, query) {
                return void 0 !== element.matches ? element.matches(query) : void 0 !== element.matchesSelector ? element.matchesSelector(query) : void 0 !== element.webkitMatchesSelector ? element.webkitMatchesSelector(query) : void 0 !== element.mozMatchesSelector ? element.mozMatchesSelector(query) : void 0 !== element.msMatchesSelector ? element.msMatchesSelector(query) : void 0
            }, DOM.remove = function(element) {
                void 0 !== element.remove ? element.remove() : element.parentNode && element.parentNode.removeChild(element)
            }, DOM.queryChildren = function(element, selector) {
                return Array.prototype.filter.call(element.childNodes, function(child) {
                    return DOM.matches(child, selector)
                })
            }, module.exports = DOM
        }, {}],
        4: [function(require, module, exports) {
            "use strict";
            var EventElement = function(element) {
                this.element = element, this.events = {}
            };
            EventElement.prototype.bind = function(eventName, handler) {
                void 0 === this.events[eventName] && (this.events[eventName] = []), this.events[eventName].push(handler), this.element.addEventListener(eventName, handler, !1)
            }, EventElement.prototype.unbind = function(eventName, handler) {
                var isHandlerProvided = void 0 !== handler;
                this.events[eventName] = this.events[eventName].filter(function(hdlr) {
                    return !(!isHandlerProvided || hdlr === handler) || (this.element.removeEventListener(eventName, hdlr, !1), !1)
                }, this)
            }, EventElement.prototype.unbindAll = function() {
                for (var name in this.events) this.unbind(name)
            };
            var EventManager = function() {
                this.eventElements = []
            };
            EventManager.prototype.eventElement = function(element) {
                var ee = this.eventElements.filter(function(eventElement) {
                    return eventElement.element === element
                })[0];
                return void 0 === ee && (ee = new EventElement(element), this.eventElements.push(ee)), ee
            }, EventManager.prototype.bind = function(element, eventName, handler) {
                this.eventElement(element).bind(eventName, handler)
            }, EventManager.prototype.unbind = function(element, eventName, handler) {
                this.eventElement(element).unbind(eventName, handler)
            }, EventManager.prototype.unbindAll = function() {
                for (var i = 0; i < this.eventElements.length; i++) this.eventElements[i].unbindAll()
            }, EventManager.prototype.once = function(element, eventName, handler) {
                var ee = this.eventElement(element),
                    onceHandler = function(e) {
                        ee.unbind(eventName, onceHandler), handler(e)
                    };
                ee.bind(eventName, onceHandler)
            }, module.exports = EventManager
        }, {}],
        5: [function(require, module, exports) {
            "use strict";
            module.exports = function() {
                function s4() {
                    return Math.floor(65536 * (1 + Math.random())).toString(16).substring(1)
                }

                return function() {
                    return s4() + s4() + "-" + s4() + "-" + s4() + "-" + s4() + "-" + s4() + s4() + s4()
                }
            }()
        }, {}],
        6: [function(require, module, exports) {
            "use strict";
            var cls = require("./class"),
                dom = require("./dom"),
                toInt = exports.toInt = function(x) {
                    return parseInt(x, 10) || 0
                },
                clone = exports.clone = function(obj) {
                    if (obj) {
                        if (obj.constructor === Array) return obj.map(clone);
                        if ("object" == typeof obj) {
                            var result = {};
                            for (var key in obj) result[key] = clone(obj[key]);
                            return result
                        }
                        return obj
                    }
                    return null
                };
            exports.extend = function(original, source) {
                var result = clone(original);
                for (var key in source) result[key] = clone(source[key]);
                return result
            }, exports.isEditable = function(el) {
                return dom.matches(el, "input,[contenteditable]") || dom.matches(el, "select,[contenteditable]") || dom.matches(el, "textarea,[contenteditable]") || dom.matches(el, "button,[contenteditable]")
            }, exports.removePsClasses = function(element) {
                for (var clsList = cls.list(element), i = 0; i < clsList.length; i++) {
                    var className = clsList[i];
                    0 === className.indexOf("ps-") && cls.remove(element, className)
                }
            }, exports.outerWidth = function(element) {
                return toInt(dom.css(element, "width")) + toInt(dom.css(element, "paddingLeft")) + toInt(dom.css(element, "paddingRight")) + toInt(dom.css(element, "borderLeftWidth")) + toInt(dom.css(element, "borderRightWidth"))
            }, exports.startScrolling = function(element, axis) {
                cls.add(element, "ps-in-scrolling"), void 0 !== axis ? cls.add(element, "ps-" + axis) : (cls.add(element, "ps-x"), cls.add(element, "ps-y"))
            }, exports.stopScrolling = function(element, axis) {
                cls.remove(element, "ps-in-scrolling"), void 0 !== axis ? cls.remove(element, "ps-" + axis) : (cls.remove(element, "ps-x"), cls.remove(element, "ps-y"))
            }, exports.env = {
                isWebKit: "WebkitAppearance" in document.documentElement.style,
                supportsTouch: "ontouchstart" in window || window.DocumentTouch && document instanceof window.DocumentTouch,
                supportsIePointer: null !== window.navigator.msMaxTouchPoints
            }
        }, { "./class": 2, "./dom": 3 }],
        7: [function(require, module, exports) {
            "use strict";
            var destroy = require("./plugin/destroy"),
                initialize = require("./plugin/initialize"),
                update = require("./plugin/update");
            module.exports = { initialize: initialize, update: update, destroy: destroy }
        }, { "./plugin/destroy": 9, "./plugin/initialize": 17, "./plugin/update": 21 }],
        8: [function(require, module, exports) {
            "use strict";
            module.exports = {
                handlers: ["click-rail", "drag-scrollbar", "keyboard", "wheel", "touch"],
                maxScrollbarLength: null,
                minScrollbarLength: null,
                scrollXMarginOffset: 0,
                scrollYMarginOffset: 0,
                suppressScrollX: !1,
                suppressScrollY: !1,
                swipePropagation: !0,
                useBothWheelAxes: !1,
                wheelPropagation: !1,
                wheelSpeed: 1,
                theme: "default"
            }
        }, {}],
        9: [function(require, module, exports) {
            "use strict";
            var _ = require("../lib/helper"),
                dom = require("../lib/dom"),
                instances = require("./instances");
            module.exports = function(element) {
                var i = instances.get(element);
                i && (i.event.unbindAll(), dom.remove(i.scrollbarX), dom.remove(i.scrollbarY), dom.remove(i.scrollbarXRail), dom.remove(i.scrollbarYRail), _.removePsClasses(element), instances.remove(element))
            }
        }, { "../lib/dom": 3, "../lib/helper": 6, "./instances": 18 }],
        10: [function(require, module, exports) {
            "use strict";

            function bindClickRailHandler(element, i) {
                function pageOffset(el) {
                    return el.getBoundingClientRect()
                }

                var stopPropagation = function(e) {
                    e.stopPropagation()
                };
                i.event.bind(i.scrollbarY, "click", stopPropagation), i.event.bind(i.scrollbarYRail, "click", function(e) {
                    var positionTop = e.pageY - window.pageYOffset - pageOffset(i.scrollbarYRail).top,
                        direction = positionTop > i.scrollbarYTop ? 1 : -1;
                    updateScroll(element, "top", element.scrollTop + direction * i.containerHeight), updateGeometry(element), e.stopPropagation()
                }), i.event.bind(i.scrollbarX, "click", stopPropagation), i.event.bind(i.scrollbarXRail, "click", function(e) {
                    var positionLeft = e.pageX - window.pageXOffset - pageOffset(i.scrollbarXRail).left,
                        direction = positionLeft > i.scrollbarXLeft ? 1 : -1;
                    updateScroll(element, "left", element.scrollLeft + direction * i.containerWidth), updateGeometry(element), e.stopPropagation()
                })
            }

            var instances = require("../instances"),
                updateGeometry = require("../update-geometry"),
                updateScroll = require("../update-scroll");
            module.exports = function(element) {
                bindClickRailHandler(element, instances.get(element))
            }
        }, { "../instances": 18, "../update-geometry": 19, "../update-scroll": 20 }],
        11: [function(require, module, exports) {
            "use strict";

            function bindMouseScrollXHandler(element, i) {
                function updateScrollLeft(deltaX) {
                    var newLeft = currentLeft + deltaX * i.railXRatio,
                        maxLeft = Math.max(0, i.scrollbarXRail.getBoundingClientRect().left) + i.railXRatio * (i.railXWidth - i.scrollbarXWidth);
                    i.scrollbarXLeft = newLeft < 0 ? 0 : newLeft > maxLeft ? maxLeft : newLeft;
                    var scrollLeft = _.toInt(i.scrollbarXLeft * (i.contentWidth - i.containerWidth) / (i.containerWidth - i.railXRatio * i.scrollbarXWidth)) - i.negativeScrollAdjustment;
                    updateScroll(element, "left", scrollLeft)
                }

                var currentLeft = null,
                    currentPageX = null,
                    mouseMoveHandler = function(e) {
                        updateScrollLeft(e.pageX - currentPageX), updateGeometry(element), e.stopPropagation(), e.preventDefault()
                    },
                    mouseUpHandler = function() {
                        _.stopScrolling(element, "x"), i.event.unbind(i.ownerDocument, "mousemove", mouseMoveHandler)
                    };
                i.event.bind(i.scrollbarX, "mousedown", function(e) {
                    currentPageX = e.pageX, currentLeft = _.toInt(dom.css(i.scrollbarX, "left")) * i.railXRatio, _.startScrolling(element, "x"), i.event.bind(i.ownerDocument, "mousemove", mouseMoveHandler), i.event.once(i.ownerDocument, "mouseup", mouseUpHandler), e.stopPropagation(), e.preventDefault()
                })
            }

            function bindMouseScrollYHandler(element, i) {
                function updateScrollTop(deltaY) {
                    var newTop = currentTop + deltaY * i.railYRatio,
                        maxTop = Math.max(0, i.scrollbarYRail.getBoundingClientRect().top) + i.railYRatio * (i.railYHeight - i.scrollbarYHeight);
                    i.scrollbarYTop = newTop < 0 ? 0 : newTop > maxTop ? maxTop : newTop;
                    var scrollTop = _.toInt(i.scrollbarYTop * (i.contentHeight - i.containerHeight) / (i.containerHeight - i.railYRatio * i.scrollbarYHeight));
                    updateScroll(element, "top", scrollTop)
                }

                var currentTop = null,
                    currentPageY = null,
                    mouseMoveHandler = function(e) {
                        updateScrollTop(e.pageY - currentPageY), updateGeometry(element), e.stopPropagation(), e.preventDefault()
                    },
                    mouseUpHandler = function() {
                        _.stopScrolling(element, "y"), i.event.unbind(i.ownerDocument, "mousemove", mouseMoveHandler)
                    };
                i.event.bind(i.scrollbarY, "mousedown", function(e) {
                    currentPageY = e.pageY, currentTop = _.toInt(dom.css(i.scrollbarY, "top")) * i.railYRatio, _.startScrolling(element, "y"), i.event.bind(i.ownerDocument, "mousemove", mouseMoveHandler), i.event.once(i.ownerDocument, "mouseup", mouseUpHandler), e.stopPropagation(), e.preventDefault()
                })
            }

            var _ = require("../../lib/helper"),
                dom = require("../../lib/dom"),
                instances = require("../instances"),
                updateGeometry = require("../update-geometry"),
                updateScroll = require("../update-scroll");
            module.exports = function(element) {
                var i = instances.get(element);
                bindMouseScrollXHandler(element, i), bindMouseScrollYHandler(element, i)
            }
        }, {
            "../../lib/dom": 3,
            "../../lib/helper": 6,
            "../instances": 18,
            "../update-geometry": 19,
            "../update-scroll": 20
        }],
        12: [function(require, module, exports) {
            "use strict";

            function bindKeyboardHandler(element, i) {
                function shouldPreventDefault(deltaX, deltaY) {
                    var scrollTop = element.scrollTop;
                    if (0 === deltaX) {
                        if (!i.scrollbarYActive) return !1;
                        if (0 === scrollTop && deltaY > 0 || scrollTop >= i.contentHeight - i.containerHeight && deltaY < 0) return !i.settings.wheelPropagation
                    }
                    var scrollLeft = element.scrollLeft;
                    if (0 === deltaY) {
                        if (!i.scrollbarXActive) return !1;
                        if (0 === scrollLeft && deltaX < 0 || scrollLeft >= i.contentWidth - i.containerWidth && deltaX > 0) return !i.settings.wheelPropagation
                    }
                    return !0
                }

                var hovered = !1;
                i.event.bind(element, "mouseenter", function() {
                    hovered = !0
                }), i.event.bind(element, "mouseleave", function() {
                    hovered = !1
                });
                var shouldPrevent = !1;
                i.event.bind(i.ownerDocument, "keydown", function(e) {
                    if (!(e.isDefaultPrevented && e.isDefaultPrevented() || e.defaultPrevented)) {
                        var focused = dom.matches(i.scrollbarX, ":focus") || dom.matches(i.scrollbarY, ":focus");
                        if (hovered || focused) {
                            var activeElement = document.activeElement ? document.activeElement : i.ownerDocument.activeElement;
                            if (activeElement) {
                                if ("IFRAME" === activeElement.tagName) activeElement = activeElement.contentDocument.activeElement;
                                else
                                    for (; activeElement.shadowRoot;) activeElement = activeElement.shadowRoot.activeElement;
                                if (_.isEditable(activeElement)) return
                            }
                            var deltaX = 0,
                                deltaY = 0;
                            switch (e.which) {
                                case 37:
                                    deltaX = e.metaKey ? -i.contentWidth : e.altKey ? -i.containerWidth : -30;
                                    break;
                                case 38:
                                    deltaY = e.metaKey ? i.contentHeight : e.altKey ? i.containerHeight : 30;
                                    break;
                                case 39:
                                    deltaX = e.metaKey ? i.contentWidth : e.altKey ? i.containerWidth : 30;
                                    break;
                                case 40:
                                    deltaY = e.metaKey ? -i.contentHeight : e.altKey ? -i.containerHeight : -30;
                                    break;
                                case 33:
                                    deltaY = 90;
                                    break;
                                case 32:
                                    deltaY = e.shiftKey ? 90 : -90;
                                    break;
                                case 34:
                                    deltaY = -90;
                                    break;
                                case 35:
                                    deltaY = e.ctrlKey ? -i.contentHeight : -i.containerHeight;
                                    break;
                                case 36:
                                    deltaY = e.ctrlKey ? element.scrollTop : i.containerHeight;
                                    break;
                                default:
                                    return
                            }
                            updateScroll(element, "top", element.scrollTop - deltaY), updateScroll(element, "left", element.scrollLeft + deltaX), updateGeometry(element), shouldPrevent = shouldPreventDefault(deltaX, deltaY), shouldPrevent && e.preventDefault()
                        }
                    }
                })
            }

            var _ = require("../../lib/helper"),
                dom = require("../../lib/dom"),
                instances = require("../instances"),
                updateGeometry = require("../update-geometry"),
                updateScroll = require("../update-scroll");
            module.exports = function(element) {
                bindKeyboardHandler(element, instances.get(element))
            }
        }, {
            "../../lib/dom": 3,
            "../../lib/helper": 6,
            "../instances": 18,
            "../update-geometry": 19,
            "../update-scroll": 20
        }],
        13: [function(require, module, exports) {
            "use strict";

            function bindMouseWheelHandler(element, i) {
                function shouldPreventDefault(deltaX, deltaY) {
                    var scrollTop = element.scrollTop;
                    if (0 === deltaX) {
                        if (!i.scrollbarYActive) return !1;
                        if (0 === scrollTop && deltaY > 0 || scrollTop >= i.contentHeight - i.containerHeight && deltaY < 0) return !i.settings.wheelPropagation
                    }
                    var scrollLeft = element.scrollLeft;
                    if (0 === deltaY) {
                        if (!i.scrollbarXActive) return !1;
                        if (0 === scrollLeft && deltaX < 0 || scrollLeft >= i.contentWidth - i.containerWidth && deltaX > 0) return !i.settings.wheelPropagation
                    }
                    return !0
                }

                function getDeltaFromEvent(e) {
                    var deltaX = e.deltaX,
                        deltaY = -1 * e.deltaY;
                    return void 0 !== deltaX && void 0 !== deltaY || (deltaX = -1 * e.wheelDeltaX / 6, deltaY = e.wheelDeltaY / 6), e.deltaMode && 1 === e.deltaMode && (deltaX *= 10, deltaY *= 10), deltaX !== deltaX && deltaY !== deltaY && (deltaX = 0, deltaY = e.wheelDelta), e.shiftKey ? [-deltaY, -deltaX] : [deltaX, deltaY]
                }

                function shouldBeConsumedByChild(deltaX, deltaY) {
                    var child = element.querySelector("textarea:hover, select[multiple]:hover, .ps-child:hover");
                    if (child) {
                        if (!window.getComputedStyle(child).overflow.match(/(scroll|auto)/)) return !1;
                        var maxScrollTop = child.scrollHeight - child.clientHeight;
                        if (maxScrollTop > 0 && !(0 === child.scrollTop && deltaY > 0 || child.scrollTop === maxScrollTop && deltaY < 0)) return !0;
                        var maxScrollLeft = child.scrollLeft - child.clientWidth;
                        if (maxScrollLeft > 0 && !(0 === child.scrollLeft && deltaX < 0 || child.scrollLeft === maxScrollLeft && deltaX > 0)) return !0
                    }
                    return !1
                }

                function mousewheelHandler(e) {
                    var delta = getDeltaFromEvent(e),
                        deltaX = delta[0],
                        deltaY = delta[1];
                    shouldBeConsumedByChild(deltaX, deltaY) || (shouldPrevent = !1, i.settings.useBothWheelAxes ? i.scrollbarYActive && !i.scrollbarXActive ? (deltaY ? updateScroll(element, "top", element.scrollTop - deltaY * i.settings.wheelSpeed) : updateScroll(element, "top", element.scrollTop + deltaX * i.settings.wheelSpeed), shouldPrevent = !0) : i.scrollbarXActive && !i.scrollbarYActive && (deltaX ? updateScroll(element, "left", element.scrollLeft + deltaX * i.settings.wheelSpeed) : updateScroll(element, "left", element.scrollLeft - deltaY * i.settings.wheelSpeed), shouldPrevent = !0) : (updateScroll(element, "top", element.scrollTop - deltaY * i.settings.wheelSpeed), updateScroll(element, "left", element.scrollLeft + deltaX * i.settings.wheelSpeed)), updateGeometry(element), (shouldPrevent = shouldPrevent || shouldPreventDefault(deltaX, deltaY)) && (e.stopPropagation(), e.preventDefault()))
                }

                var shouldPrevent = !1;
                void 0 !== window.onwheel ? i.event.bind(element, "wheel", mousewheelHandler) : void 0 !== window.onmousewheel && i.event.bind(element, "mousewheel", mousewheelHandler)
            }

            var instances = require("../instances"),
                updateGeometry = require("../update-geometry"),
                updateScroll = require("../update-scroll");
            module.exports = function(element) {
                bindMouseWheelHandler(element, instances.get(element))
            }
        }, { "../instances": 18, "../update-geometry": 19, "../update-scroll": 20 }],
        14: [function(require, module, exports) {
            "use strict";

            function bindNativeScrollHandler(element, i) {
                i.event.bind(element, "scroll", function() {
                    updateGeometry(element)
                })
            }

            var instances = require("../instances"),
                updateGeometry = require("../update-geometry");
            module.exports = function(element) {
                bindNativeScrollHandler(element, instances.get(element))
            }
        }, { "../instances": 18, "../update-geometry": 19 }],
        15: [function(require, module, exports) {
            "use strict";

            function bindSelectionHandler(element, i) {
                function getRangeNode() {
                    var selection = window.getSelection ? window.getSelection() : document.getSelection ? document.getSelection() : "";
                    return 0 === selection.toString().length ? null : selection.getRangeAt(0).commonAncestorContainer
                }

                function startScrolling() {
                    scrollingLoop || (scrollingLoop = setInterval(function() {
                        if (!instances.get(element)) return void clearInterval(scrollingLoop);
                        updateScroll(element, "top", element.scrollTop + scrollDiff.top), updateScroll(element, "left", element.scrollLeft + scrollDiff.left), updateGeometry(element)
                    }, 50))
                }

                function stopScrolling() {
                    scrollingLoop && (clearInterval(scrollingLoop), scrollingLoop = null), _.stopScrolling(element)
                }

                var scrollingLoop = null,
                    scrollDiff = { top: 0, left: 0 },
                    isSelected = !1;
                i.event.bind(i.ownerDocument, "selectionchange", function() {
                    element.contains(getRangeNode()) ? isSelected = !0 : (isSelected = !1, stopScrolling())
                }), i.event.bind(window, "mouseup", function() {
                    isSelected && (isSelected = !1, stopScrolling())
                }), i.event.bind(window, "keyup", function() {
                    isSelected && (isSelected = !1, stopScrolling())
                }), i.event.bind(window, "mousemove", function(e) {
                    if (isSelected) {
                        var mousePosition = { x: e.pageX, y: e.pageY },
                            containerGeometry = {
                                left: element.offsetLeft,
                                right: element.offsetLeft + element.offsetWidth,
                                top: element.offsetTop,
                                bottom: element.offsetTop + element.offsetHeight
                            };
                        mousePosition.x < containerGeometry.left + 3 ? (scrollDiff.left = -5, _.startScrolling(element, "x")) : mousePosition.x > containerGeometry.right - 3 ? (scrollDiff.left = 5, _.startScrolling(element, "x")) : scrollDiff.left = 0, mousePosition.y < containerGeometry.top + 3 ? (scrollDiff.top = containerGeometry.top + 3 - mousePosition.y < 5 ? -5 : -20, _.startScrolling(element, "y")) : mousePosition.y > containerGeometry.bottom - 3 ? (scrollDiff.top = mousePosition.y - containerGeometry.bottom + 3 < 5 ? 5 : 20, _.startScrolling(element, "y")) : scrollDiff.top = 0, 0 === scrollDiff.top && 0 === scrollDiff.left ? stopScrolling() : startScrolling()
                    }
                })
            }

            var _ = require("../../lib/helper"),
                instances = require("../instances"),
                updateGeometry = require("../update-geometry"),
                updateScroll = require("../update-scroll");
            module.exports = function(element) {
                bindSelectionHandler(element, instances.get(element))
            }
        }, { "../../lib/helper": 6, "../instances": 18, "../update-geometry": 19, "../update-scroll": 20 }],
        16: [function(require, module, exports) {
            "use strict";

            function bindTouchHandler(element, i, supportsTouch, supportsIePointer) {
                function shouldPreventDefault(deltaX, deltaY) {
                    var scrollTop = element.scrollTop,
                        scrollLeft = element.scrollLeft,
                        magnitudeX = Math.abs(deltaX),
                        magnitudeY = Math.abs(deltaY);
                    if (magnitudeY > magnitudeX) {
                        if (deltaY < 0 && scrollTop === i.contentHeight - i.containerHeight || deltaY > 0 && 0 === scrollTop) return !i.settings.swipePropagation
                    } else if (magnitudeX > magnitudeY && (deltaX < 0 && scrollLeft === i.contentWidth - i.containerWidth || deltaX > 0 && 0 === scrollLeft)) return !i.settings.swipePropagation;
                    return !0
                }

                function applyTouchMove(differenceX, differenceY) {
                    updateScroll(element, "top", element.scrollTop - differenceY), updateScroll(element, "left", element.scrollLeft - differenceX), updateGeometry(element)
                }

                function globalTouchStart() {
                    inGlobalTouch = !0
                }

                function globalTouchEnd() {
                    inGlobalTouch = !1
                }

                function getTouch(e) {
                    return e.targetTouches ? e.targetTouches[0] : e
                }

                function shouldHandle(e) {
                    return !(!e.targetTouches || 1 !== e.targetTouches.length) || !(!e.pointerType || "mouse" === e.pointerType || e.pointerType === e.MSPOINTER_TYPE_MOUSE)
                }

                function touchStart(e) {
                    if (shouldHandle(e)) {
                        inLocalTouch = !0;
                        var touch = getTouch(e);
                        startOffset.pageX = touch.pageX, startOffset.pageY = touch.pageY, startTime = (new Date).getTime(), null !== easingLoop && clearInterval(easingLoop), e.stopPropagation()
                    }
                }

                function touchMove(e) {
                    if (!inLocalTouch && i.settings.swipePropagation && touchStart(e), !inGlobalTouch && inLocalTouch && shouldHandle(e)) {
                        var touch = getTouch(e),
                            currentOffset = { pageX: touch.pageX, pageY: touch.pageY },
                            differenceX = currentOffset.pageX - startOffset.pageX,
                            differenceY = currentOffset.pageY - startOffset.pageY;
                        applyTouchMove(differenceX, differenceY), startOffset = currentOffset;
                        var currentTime = (new Date).getTime(),
                            timeGap = currentTime - startTime;
                        timeGap > 0 && (speed.x = differenceX / timeGap, speed.y = differenceY / timeGap, startTime = currentTime), shouldPreventDefault(differenceX, differenceY) && (e.stopPropagation(), e.preventDefault())
                    }
                }

                function touchEnd() {
                    !inGlobalTouch && inLocalTouch && (inLocalTouch = !1, clearInterval(easingLoop), easingLoop = setInterval(function() {
                        return instances.get(element) && (speed.x || speed.y) ? Math.abs(speed.x) < .01 && Math.abs(speed.y) < .01 ? void clearInterval(easingLoop) : (applyTouchMove(30 * speed.x, 30 * speed.y), speed.x *= .8, void(speed.y *= .8)) : void clearInterval(easingLoop)
                    }, 10))
                }

                var startOffset = {},
                    startTime = 0,
                    speed = {},
                    easingLoop = null,
                    inGlobalTouch = !1,
                    inLocalTouch = !1;
                supportsTouch ? (i.event.bind(window, "touchstart", globalTouchStart), i.event.bind(window, "touchend", globalTouchEnd), i.event.bind(element, "touchstart", touchStart), i.event.bind(element, "touchmove", touchMove), i.event.bind(element, "touchend", touchEnd)) : supportsIePointer && (window.PointerEvent ? (i.event.bind(window, "pointerdown", globalTouchStart), i.event.bind(window, "pointerup", globalTouchEnd), i.event.bind(element, "pointerdown", touchStart), i.event.bind(element, "pointermove", touchMove), i.event.bind(element, "pointerup", touchEnd)) : window.MSPointerEvent && (i.event.bind(window, "MSPointerDown", globalTouchStart), i.event.bind(window, "MSPointerUp", globalTouchEnd), i.event.bind(element, "MSPointerDown", touchStart), i.event.bind(element, "MSPointerMove", touchMove), i.event.bind(element, "MSPointerUp", touchEnd)))
            }

            var _ = require("../../lib/helper"),
                instances = require("../instances"),
                updateGeometry = require("../update-geometry"),
                updateScroll = require("../update-scroll");
            module.exports = function(element) {
                if (_.env.supportsTouch || _.env.supportsIePointer) {
                    bindTouchHandler(element, instances.get(element), _.env.supportsTouch, _.env.supportsIePointer)
                }
            }
        }, { "../../lib/helper": 6, "../instances": 18, "../update-geometry": 19, "../update-scroll": 20 }],
        17: [function(require, module, exports) {
            "use strict";
            var _ = require("../lib/helper"),
                cls = require("../lib/class"),
                instances = require("./instances"),
                updateGeometry = require("./update-geometry"),
                handlers = {
                    "click-rail": require("./handler/click-rail"),
                    "drag-scrollbar": require("./handler/drag-scrollbar"),
                    keyboard: require("./handler/keyboard"),
                    wheel: require("./handler/mouse-wheel"),
                    touch: require("./handler/touch"),
                    selection: require("./handler/selection")
                },
                nativeScrollHandler = require("./handler/native-scroll");
            module.exports = function(element, userSettings) {
                userSettings = "object" == typeof userSettings ? userSettings : {}, cls.add(element, "ps-container");
                var i = instances.add(element);
                i.settings = _.extend(i.settings, userSettings), cls.add(element, "ps-theme-" + i.settings.theme), i.settings.handlers.forEach(function(handlerName) {
                    handlers[handlerName](element)
                }), nativeScrollHandler(element), updateGeometry(element)
            }
        }, {
            "../lib/class": 2,
            "../lib/helper": 6,
            "./handler/click-rail": 10,
            "./handler/drag-scrollbar": 11,
            "./handler/keyboard": 12,
            "./handler/mouse-wheel": 13,
            "./handler/native-scroll": 14,
            "./handler/selection": 15,
            "./handler/touch": 16,
            "./instances": 18,
            "./update-geometry": 19
        }],
        18: [function(require, module, exports) {
            "use strict";

            function Instance(element) {
                function focus() {
                    cls.add(element, "ps-focus")
                }

                function blur() {
                    cls.remove(element, "ps-focus")
                }

                var i = this;
                i.settings = _.clone(defaultSettings), i.containerWidth = null, i.containerHeight = null, i.contentWidth = null, i.contentHeight = null, i.isRtl = "rtl" === dom.css(element, "direction"), i.isNegativeScroll = function() {
                    var originalScrollLeft = element.scrollLeft,
                        result = null;
                    return element.scrollLeft = -1, result = element.scrollLeft < 0, element.scrollLeft = originalScrollLeft, result
                }(), i.negativeScrollAdjustment = i.isNegativeScroll ? element.scrollWidth - element.clientWidth : 0, i.event = new EventManager, i.ownerDocument = element.ownerDocument || document, i.scrollbarXRail = dom.appendTo(dom.e("div", "ps-scrollbar-x-rail"), element), i.scrollbarX = dom.appendTo(dom.e("div", "ps-scrollbar-x"), i.scrollbarXRail), i.scrollbarX.setAttribute("tabindex", 0), i.event.bind(i.scrollbarX, "focus", focus), i.event.bind(i.scrollbarX, "blur", blur), i.scrollbarXActive = null, i.scrollbarXWidth = null, i.scrollbarXLeft = null, i.scrollbarXBottom = _.toInt(dom.css(i.scrollbarXRail, "bottom")), i.isScrollbarXUsingBottom = i.scrollbarXBottom === i.scrollbarXBottom, i.scrollbarXTop = i.isScrollbarXUsingBottom ? null : _.toInt(dom.css(i.scrollbarXRail, "top")), i.railBorderXWidth = _.toInt(dom.css(i.scrollbarXRail, "borderLeftWidth")) + _.toInt(dom.css(i.scrollbarXRail, "borderRightWidth")), dom.css(i.scrollbarXRail, "display", "block"), i.railXMarginWidth = _.toInt(dom.css(i.scrollbarXRail, "marginLeft")) + _.toInt(dom.css(i.scrollbarXRail, "marginRight")), dom.css(i.scrollbarXRail, "display", ""), i.railXWidth = null, i.railXRatio = null, i.scrollbarYRail = dom.appendTo(dom.e("div", "ps-scrollbar-y-rail"), element), i.scrollbarY = dom.appendTo(dom.e("div", "ps-scrollbar-y"), i.scrollbarYRail), i.scrollbarY.setAttribute("tabindex", 0), i.event.bind(i.scrollbarY, "focus", focus), i.event.bind(i.scrollbarY, "blur", blur), i.scrollbarYActive = null, i.scrollbarYHeight = null, i.scrollbarYTop = null, i.scrollbarYRight = _.toInt(dom.css(i.scrollbarYRail, "right")), i.isScrollbarYUsingRight = i.scrollbarYRight === i.scrollbarYRight, i.scrollbarYLeft = i.isScrollbarYUsingRight ? null : _.toInt(dom.css(i.scrollbarYRail, "left")), i.scrollbarYOuterWidth = i.isRtl ? _.outerWidth(i.scrollbarY) : null, i.railBorderYWidth = _.toInt(dom.css(i.scrollbarYRail, "borderTopWidth")) + _.toInt(dom.css(i.scrollbarYRail, "borderBottomWidth")), dom.css(i.scrollbarYRail, "display", "block"), i.railYMarginHeight = _.toInt(dom.css(i.scrollbarYRail, "marginTop")) + _.toInt(dom.css(i.scrollbarYRail, "marginBottom")), dom.css(i.scrollbarYRail, "display", ""), i.railYHeight = null, i.railYRatio = null
            }

            function getId(element) {
                return element.getAttribute("data-ps-id")
            }

            function setId(element, id) {
                element.setAttribute("data-ps-id", id)
            }

            function removeId(element) {
                element.removeAttribute("data-ps-id")
            }

            var _ = require("../lib/helper"),
                cls = require("../lib/class"),
                defaultSettings = require("./default-setting"),
                dom = require("../lib/dom"),
                EventManager = require("../lib/event-manager"),
                guid = require("../lib/guid"),
                instances = {};
            exports.add = function(element) {
                var newId = guid();
                return setId(element, newId), instances[newId] = new Instance(element), instances[newId]
            }, exports.remove = function(element) {
                delete instances[getId(element)], removeId(element)
            }, exports.get = function(element) {
                return instances[getId(element)]
            }
        }, {
            "../lib/class": 2,
            "../lib/dom": 3,
            "../lib/event-manager": 4,
            "../lib/guid": 5,
            "../lib/helper": 6,
            "./default-setting": 8
        }],
        19: [function(require, module, exports) {
            "use strict";

            function getThumbSize(i, thumbSize) {
                return i.settings.minScrollbarLength && (thumbSize = Math.max(thumbSize, i.settings.minScrollbarLength)), i.settings.maxScrollbarLength && (thumbSize = Math.min(thumbSize, i.settings.maxScrollbarLength)), thumbSize
            }

            function updateCss(element, i) {
                var xRailOffset = { width: i.railXWidth };
                i.isRtl ? xRailOffset.left = i.negativeScrollAdjustment + element.scrollLeft + i.containerWidth - i.contentWidth : xRailOffset.left = element.scrollLeft, i.isScrollbarXUsingBottom ? xRailOffset.bottom = i.scrollbarXBottom - element.scrollTop : xRailOffset.top = i.scrollbarXTop + element.scrollTop, dom.css(i.scrollbarXRail, xRailOffset);
                var yRailOffset = { top: element.scrollTop, height: i.railYHeight };
                i.isScrollbarYUsingRight ? i.isRtl ? yRailOffset.right = i.contentWidth - (i.negativeScrollAdjustment + element.scrollLeft) - i.scrollbarYRight - i.scrollbarYOuterWidth : yRailOffset.right = i.scrollbarYRight - element.scrollLeft : i.isRtl ? yRailOffset.left = i.negativeScrollAdjustment + element.scrollLeft + 2 * i.containerWidth - i.contentWidth - i.scrollbarYLeft - i.scrollbarYOuterWidth : yRailOffset.left = i.scrollbarYLeft + element.scrollLeft, dom.css(i.scrollbarYRail, yRailOffset), dom.css(i.scrollbarX, {
                    left: i.scrollbarXLeft,
                    width: i.scrollbarXWidth - i.railBorderXWidth
                }), dom.css(i.scrollbarY, { top: i.scrollbarYTop, height: i.scrollbarYHeight - i.railBorderYWidth })
            }

            var _ = require("../lib/helper"),
                cls = require("../lib/class"),
                dom = require("../lib/dom"),
                instances = require("./instances"),
                updateScroll = require("./update-scroll");
            module.exports = function(element) {
                var i = instances.get(element);
                i.containerWidth = element.clientWidth, i.containerHeight = element.clientHeight, i.contentWidth = element.scrollWidth, i.contentHeight = element.scrollHeight;
                var existingRails;
                element.contains(i.scrollbarXRail) || (existingRails = dom.queryChildren(element, ".ps-scrollbar-x-rail"), existingRails.length > 0 && existingRails.forEach(function(rail) {
                    dom.remove(rail)
                }), dom.appendTo(i.scrollbarXRail, element)), element.contains(i.scrollbarYRail) || (existingRails = dom.queryChildren(element, ".ps-scrollbar-y-rail"), existingRails.length > 0 && existingRails.forEach(function(rail) {
                    dom.remove(rail)
                }), dom.appendTo(i.scrollbarYRail, element)), !i.settings.suppressScrollX && i.containerWidth + i.settings.scrollXMarginOffset < i.contentWidth ? (i.scrollbarXActive = !0, i.railXWidth = i.containerWidth - i.railXMarginWidth, i.railXRatio = i.containerWidth / i.railXWidth, i.scrollbarXWidth = getThumbSize(i, _.toInt(i.railXWidth * i.containerWidth / i.contentWidth)), i.scrollbarXLeft = _.toInt((i.negativeScrollAdjustment + element.scrollLeft) * (i.railXWidth - i.scrollbarXWidth) / (i.contentWidth - i.containerWidth))) : i.scrollbarXActive = !1, !i.settings.suppressScrollY && i.containerHeight + i.settings.scrollYMarginOffset < i.contentHeight ? (i.scrollbarYActive = !0, i.railYHeight = i.containerHeight - i.railYMarginHeight, i.railYRatio = i.containerHeight / i.railYHeight, i.scrollbarYHeight = getThumbSize(i, _.toInt(i.railYHeight * i.containerHeight / i.contentHeight)), i.scrollbarYTop = _.toInt(element.scrollTop * (i.railYHeight - i.scrollbarYHeight) / (i.contentHeight - i.containerHeight))) : i.scrollbarYActive = !1, i.scrollbarXLeft >= i.railXWidth - i.scrollbarXWidth && (i.scrollbarXLeft = i.railXWidth - i.scrollbarXWidth), i.scrollbarYTop >= i.railYHeight - i.scrollbarYHeight && (i.scrollbarYTop = i.railYHeight - i.scrollbarYHeight), updateCss(element, i), i.scrollbarXActive ? cls.add(element, "ps-active-x") : (cls.remove(element, "ps-active-x"), i.scrollbarXWidth = 0, i.scrollbarXLeft = 0, updateScroll(element, "left", 0)), i.scrollbarYActive ? cls.add(element, "ps-active-y") : (cls.remove(element, "ps-active-y"), i.scrollbarYHeight = 0, i.scrollbarYTop = 0, updateScroll(element, "top", 0))
            }
        }, { "../lib/class": 2, "../lib/dom": 3, "../lib/helper": 6, "./instances": 18, "./update-scroll": 20 }],
        20: [function(require, module, exports) {
            "use strict";
            var lastTop, lastLeft, instances = require("./instances"),
                createDOMEvent = function(name) {
                    var event = document.createEvent("Event");
                    return event.initEvent(name, !0, !0), event
                };
            module.exports = function(element, axis, value) {
                if (void 0 === element) throw "You must provide an element to the update-scroll function";
                if (void 0 === axis) throw "You must provide an axis to the update-scroll function";
                if (void 0 === value) throw "You must provide a value to the update-scroll function";
                "top" === axis && value <= 0 && (element.scrollTop = value = 0, element.dispatchEvent(createDOMEvent("ps-y-reach-start"))), "left" === axis && value <= 0 && (element.scrollLeft = value = 0, element.dispatchEvent(createDOMEvent("ps-x-reach-start")));
                var i = instances.get(element);
                "top" === axis && value >= i.contentHeight - i.containerHeight && (value = i.contentHeight - i.containerHeight, value - element.scrollTop <= 1 ? value = element.scrollTop : element.scrollTop = value, element.dispatchEvent(createDOMEvent("ps-y-reach-end"))), "left" === axis && value >= i.contentWidth - i.containerWidth && (value = i.contentWidth - i.containerWidth, value - element.scrollLeft <= 1 ? value = element.scrollLeft : element.scrollLeft = value, element.dispatchEvent(createDOMEvent("ps-x-reach-end"))), lastTop || (lastTop = element.scrollTop), lastLeft || (lastLeft = element.scrollLeft), "top" === axis && value < lastTop && element.dispatchEvent(createDOMEvent("ps-scroll-up")), "top" === axis && value > lastTop && element.dispatchEvent(createDOMEvent("ps-scroll-down")), "left" === axis && value < lastLeft && element.dispatchEvent(createDOMEvent("ps-scroll-left")), "left" === axis && value > lastLeft && element.dispatchEvent(createDOMEvent("ps-scroll-right")), "top" === axis && (element.scrollTop = lastTop = value, element.dispatchEvent(createDOMEvent("ps-scroll-y"))), "left" === axis && (element.scrollLeft = lastLeft = value, element.dispatchEvent(createDOMEvent("ps-scroll-x")))
            }
        }, { "./instances": 18 }],
        21: [function(require, module, exports) {
            "use strict";
            var _ = require("../lib/helper"),
                dom = require("../lib/dom"),
                instances = require("./instances"),
                updateGeometry = require("./update-geometry"),
                updateScroll = require("./update-scroll");
            module.exports = function(element) {
                var i = instances.get(element);
                i && (i.negativeScrollAdjustment = i.isNegativeScroll ? element.scrollWidth - element.clientWidth : 0, dom.css(i.scrollbarXRail, "display", "block"), dom.css(i.scrollbarYRail, "display", "block"), i.railXMarginWidth = _.toInt(dom.css(i.scrollbarXRail, "marginLeft")) + _.toInt(dom.css(i.scrollbarXRail, "marginRight")), i.railYMarginHeight = _.toInt(dom.css(i.scrollbarYRail, "marginTop")) + _.toInt(dom.css(i.scrollbarYRail, "marginBottom")), dom.css(i.scrollbarXRail, "display", "none"), dom.css(i.scrollbarYRail, "display", "none"), updateGeometry(element), updateScroll(element, "top", element.scrollTop), updateScroll(element, "left", element.scrollLeft), dom.css(i.scrollbarXRail, "display", ""), dom.css(i.scrollbarYRail, "display", ""))
            }
        }, { "../lib/dom": 3, "../lib/helper": 6, "./instances": 18, "./update-geometry": 19, "./update-scroll": 20 }]
    }, {}, [1]);