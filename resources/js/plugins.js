! function() {
    for (var t, e = ["assert", "clear", "count", "debug", "dir", "dirxml", "error", "exception", "group", "groupCollapsed", "groupEnd", "info", "log", "markTimeline", "profile", "profileEnd", "table", "time", "timeEnd", "timeline", "timelineEnd", "timeStamp", "trace", "warn"], i = e.length, s = window.console = window.console || {}; i--;) s[t = e[i]] || (s[t] = function() {})
}(),
    function() {
        var t = [].indexOf || function(t) {
                for (var e = 0, i = this.length; e < i; e++)
                    if (e in this && this[e] === t) return e;
                return -1
            },
            e = [].slice;
        ! function(t, e) {
            "function" == typeof define && define.amd ? define("waypoints", ["jquery"], function(i) {
                return e(i, t)
            }) : e(t.jQuery, t)
        }(this, function(i, s) {
            var n, o, r, a, l, h, c, u, d, p, f, g, m, v, y, w;
            return n = i(s), u = t.call(s, "ontouchstart") >= 0, a = {
                horizontal: {},
                vertical: {}
            }, l = 1, c = {}, h = "waypoints-context-id", f = "resize.waypoints", g = "scroll.waypoints", m = 1, v = "waypoints-waypoint-ids", y = "waypoint", w = "waypoints", o = function() {
                function t(t) {
                    var e = this;
                    this.$element = t, this.element = t[0], this.didResize = !1, this.didScroll = !1, this.id = "context" + l++, this.oldScroll = {
                        x: t.scrollLeft(),
                        y: t.scrollTop()
                    }, this.waypoints = {
                        horizontal: {},
                        vertical: {}
                    }, t.data(h, this.id), c[this.id] = this, t.bind(g, function() {
                        var t;
                        if (!e.didScroll && !u) return e.didScroll = !0, t = function() {
                            return e.doScroll(), e.didScroll = !1
                        }, s.setTimeout(t, i[w].settings.scrollThrottle)
                    }), t.bind(f, function() {
                        var t;
                        if (!e.didResize) return e.didResize = !0, t = function() {
                            return i[w]("refresh"), e.didResize = !1
                        }, s.setTimeout(t, i[w].settings.resizeThrottle)
                    })
                }
                return t.prototype.doScroll = function() {
                    var t, e = this;
                    return t = {
                        horizontal: {
                            newScroll: this.$element.scrollLeft(),
                            oldScroll: this.oldScroll.x,
                            forward: "right",
                            backward: "left"
                        },
                        vertical: {
                            newScroll: this.$element.scrollTop(),
                            oldScroll: this.oldScroll.y,
                            forward: "down",
                            backward: "up"
                        }
                    }, !u || t.vertical.oldScroll && t.vertical.newScroll || i[w]("refresh"), i.each(t, function(t, s) {
                        var n, o, r;
                        return r = [], o = s.newScroll > s.oldScroll, n = o ? s.forward : s.backward, i.each(e.waypoints[t], function(t, e) {
                            var i, n;
                            return s.oldScroll < (i = e.offset) && i <= s.newScroll ? r.push(e) : s.newScroll < (n = e.offset) && n <= s.oldScroll ? r.push(e) : void 0
                        }), r.sort(function(t, e) {
                            return t.offset - e.offset
                        }), o || r.reverse(), i.each(r, function(t, e) {
                            if (e.options.continuous || t === r.length - 1) return e.trigger([n])
                        })
                    }), this.oldScroll = {
                        x: t.horizontal.newScroll,
                        y: t.vertical.newScroll
                    }
                }, t.prototype.refresh = function() {
                    var t, e, s, n = this;
                    return s = i.isWindow(this.element), e = this.$element.offset(), this.doScroll(), t = {
                        horizontal: {
                            contextOffset: s ? 0 : e.left,
                            contextScroll: s ? 0 : this.oldScroll.x,
                            contextDimension: this.$element.width(),
                            oldScroll: this.oldScroll.x,
                            forward: "right",
                            backward: "left",
                            offsetProp: "left"
                        },
                        vertical: {
                            contextOffset: s ? 0 : e.top,
                            contextScroll: s ? 0 : this.oldScroll.y,
                            contextDimension: s ? i[w]("viewportHeight") : this.$element.height(),
                            oldScroll: this.oldScroll.y,
                            forward: "down",
                            backward: "up",
                            offsetProp: "top"
                        }
                    }, i.each(t, function(t, e) {
                        return i.each(n.waypoints[t], function(t, s) {
                            var n, o, r, a, l;
                            if (n = s.options.offset, r = s.offset, o = i.isWindow(s.element) ? 0 : s.$element.offset()[e.offsetProp], i.isFunction(n) ? n = n.apply(s.element) : "string" == typeof n && (n = parseFloat(n), s.options.offset.indexOf("%") > -1 && (n = Math.ceil(e.contextDimension * n / 100))), s.offset = o - e.contextOffset + e.contextScroll - n, (!s.options.onlyOnScroll || null == r) && s.enabled) return null !== r && r < (a = e.oldScroll) && a <= s.offset ? s.trigger([e.backward]) : null !== r && r > (l = e.oldScroll) && l >= s.offset ? s.trigger([e.forward]) : null === r && e.oldScroll >= s.offset ? s.trigger([e.forward]) : void 0
                        })
                    })
                }, t.prototype.checkEmpty = function() {
                    if (i.isEmptyObject(this.waypoints.horizontal) && i.isEmptyObject(this.waypoints.vertical)) return this.$element.unbind([f, g].join(" ")), delete c[this.id]
                }, t
            }(), r = function() {
                function t(t, e, s) {
                    var n, o;
                    "bottom-in-view" === (s = i.extend({}, i.fn[y].defaults, s)).offset && (s.offset = function() {
                        var t;
                        return t = i[w]("viewportHeight"), i.isWindow(e.element) || (t = e.$element.height()), t - i(this).outerHeight()
                    }), this.$element = t, this.element = t[0], this.axis = s.horizontal ? "horizontal" : "vertical", this.callback = s.handler, this.context = e, this.enabled = s.enabled, this.id = "waypoints" + m++, this.offset = null, this.options = s, e.waypoints[this.axis][this.id] = this, a[this.axis][this.id] = this, (n = null != (o = t.data(v)) ? o : []).push(this.id), t.data(v, n)
                }
                return t.prototype.trigger = function(t) {
                    if (this.enabled) return null != this.callback && this.callback.apply(this.element, t), this.options.triggerOnce ? this.destroy() : void 0
                }, t.prototype.disable = function() {
                    return this.enabled = !1
                }, t.prototype.enable = function() {
                    return this.context.refresh(), this.enabled = !0
                }, t.prototype.destroy = function() {
                    return delete a[this.axis][this.id], delete this.context.waypoints[this.axis][this.id], this.context.checkEmpty()
                }, t.getWaypointsByElement = function(t) {
                    var e, s;
                    return (s = i(t).data(v)) ? (e = i.extend({}, a.horizontal, a.vertical), i.map(s, function(t) {
                        return e[t]
                    })) : []
                }, t
            }(), p = {
                init: function(t, e) {
                    return null == e && (e = {}), null == e.handler && (e.handler = t), this.each(function() {
                        var t, s, n, a;
                        return t = i(this), n = null != (a = e.context) ? a : i.fn[y].defaults.context, i.isWindow(n) || (n = t.closest(n)), n = i(n), (s = c[n.data(h)]) || (s = new o(n)), new r(t, s, e)
                    }), i[w]("refresh"), this
                },
                disable: function() {
                    return p._invoke(this, "disable")
                },
                enable: function() {
                    return p._invoke(this, "enable")
                },
                destroy: function() {
                    return p._invoke(this, "destroy")
                },
                prev: function(t, e) {
                    return p._traverse.call(this, t, e, function(t, e, i) {
                        if (e > 0) return t.push(i[e - 1])
                    })
                },
                next: function(t, e) {
                    return p._traverse.call(this, t, e, function(t, e, i) {
                        if (e < i.length - 1) return t.push(i[e + 1])
                    })
                },
                _traverse: function(t, e, n) {
                    var o, r;
                    return null == t && (t = "vertical"), null == e && (e = s), r = d.aggregate(e), o = [], this.each(function() {
                        var e;
                        return e = i.inArray(this, r[t]), n(o, e, r[t])
                    }), this.pushStack(o)
                },
                _invoke: function(t, e) {
                    return t.each(function() {
                        var t;
                        return t = r.getWaypointsByElement(this), i.each(t, function(t, i) {
                            return i[e](), !0
                        })
                    }), this
                }
            }, i.fn[y] = function() {
                var t, s;
                return s = arguments[0], t = 2 <= arguments.length ? e.call(arguments, 1) : [], p[s] ? p[s].apply(this, t) : i.isFunction(s) ? p.init.apply(this, arguments) : i.isPlainObject(s) ? p.init.apply(this, [null, s]) : s ? i.error("The " + s + " method does not exist in jQuery Waypoints.") : i.error("jQuery Waypoints needs a callback function or handler option.")
            }, i.fn[y].defaults = {
                context: s,
                continuous: !0,
                enabled: !0,
                horizontal: !1,
                offset: 0,
                triggerOnce: !1
            }, d = {
                refresh: function() {
                    return i.each(c, function(t, e) {
                        return e.refresh()
                    })
                },
                viewportHeight: function() {
                    var t;
                    return null != (t = s.innerHeight) ? t : n.height()
                },
                aggregate: function(t) {
                    var e, s, n;
                    return e = a, t && (e = null != (n = c[i(t).data(h)]) ? n.waypoints : void 0), e ? (s = {
                        horizontal: [],
                        vertical: []
                    }, i.each(s, function(t, n) {
                        return i.each(e[t], function(t, e) {
                            return n.push(e)
                        }), n.sort(function(t, e) {
                            return t.offset - e.offset
                        }), s[t] = i.map(n, function(t) {
                            return t.element
                        }), s[t] = i.unique(s[t])
                    }), s) : []
                },
                above: function(t) {
                    return null == t && (t = s), d._filter(t, "vertical", function(t, e) {
                        return e.offset <= t.oldScroll.y
                    })
                },
                below: function(t) {
                    return null == t && (t = s), d._filter(t, "vertical", function(t, e) {
                        return e.offset > t.oldScroll.y
                    })
                },
                left: function(t) {
                    return null == t && (t = s), d._filter(t, "horizontal", function(t, e) {
                        return e.offset <= t.oldScroll.x
                    })
                },
                right: function(t) {
                    return null == t && (t = s), d._filter(t, "horizontal", function(t, e) {
                        return e.offset > t.oldScroll.x
                    })
                },
                enable: function() {
                    return d._invoke("enable")
                },
                disable: function() {
                    return d._invoke("disable")
                },
                destroy: function() {
                    return d._invoke("destroy")
                },
                extendFn: function(t, e) {
                    return p[t] = e
                },
                _invoke: function(t) {
                    var e;
                    return e = i.extend({}, a.vertical, a.horizontal), i.each(e, function(e, i) {
                        return i[t](), !0
                    })
                },
                _filter: function(t, e, s) {
                    var n, o;
                    return (n = c[i(t).data(h)]) ? (o = [], i.each(n.waypoints[e], function(t, e) {
                        if (s(n, e)) return o.push(e)
                    }), o.sort(function(t, e) {
                        return t.offset - e.offset
                    }), i.map(o, function(t) {
                        return t.element
                    })) : []
                }
            }, i[w] = function() {
                var t, i;
                return i = arguments[0], t = 2 <= arguments.length ? e.call(arguments, 1) : [], d[i] ? d[i].apply(null, t) : d.aggregate.call(null, i)
            }, i[w].settings = {
                resizeThrottle: 100,
                scrollThrottle: 30
            }, n.load(function() {
                return i[w]("refresh")
            })
        })
    }.call(this),
    function(t, e, i, s) {
        function n(e, i) {
            this.settings = null, this.options = t.extend({}, n.Defaults, i), this.$element = t(e), this.drag = t.extend({}, d), this.state = t.extend({}, p), this.e = t.extend({}, f), this._plugins = {}, this._supress = {}, this._current = null, this._speed = null, this._coordinates = [], this._breakpoint = null, this._width = null, this._items = [], this._clones = [], this._mergers = [], this._invalidated = {}, this._pipe = [], t.each(n.Plugins, t.proxy(function(t, e) {
                this._plugins[t[0].toLowerCase() + t.slice(1)] = new e(this)
            }, this)), t.each(n.Pipe, t.proxy(function(e, i) {
                this._pipe.push({
                    filter: i.filter,
                    run: t.proxy(i.run, this)
                })
            }, this)), this.setup(), this.initialize()
        }

        function o(t) {
            if (t.touches !== s) return {
                x: t.touches[0].pageX,
                y: t.touches[0].pageY
            };
            if (t.touches === s) {
                if (t.pageX !== s) return {
                    x: t.pageX,
                    y: t.pageY
                };
                if (t.pageX === s) return {
                    x: t.clientX,
                    y: t.clientY
                }
            }
        }

        function r(t) {
            var e, s, n = i.createElement("div"),
                o = t;
            for (e in o)
                if (s = o[e], void 0 !== n.style[s]) return n = null, [s, e];
            return [!1]
        }

        function a() {
            return r(["transition", "WebkitTransition", "MozTransition", "OTransition"])[1]
        }

        function l() {
            return r(["transform", "WebkitTransform", "MozTransform", "OTransform", "msTransform"])[0]
        }

        function h() {
            return r(["perspective", "webkitPerspective", "MozPerspective", "OPerspective", "MsPerspective"])[0]
        }

        function c() {
            return "ontouchstart" in e || !!navigator.msMaxTouchPoints
        }

        function u() {
            return e.navigator.msPointerEnabled
        }
        var d, p, f;
        d = {
            start: 0,
            startX: 0,
            startY: 0,
            current: 0,
            currentX: 0,
            currentY: 0,
            offsetX: 0,
            offsetY: 0,
            distance: null,
            startTime: 0,
            endTime: 0,
            updatedX: 0,
            targetEl: null
        }, p = {
            isTouch: !1,
            isScrolling: !1,
            isSwiping: !1,
            direction: !1,
            inMotion: !1
        }, f = {
            _onDragStart: null,
            _onDragMove: null,
            _onDragEnd: null,
            _transitionEnd: null,
            _resizer: null,
            _responsiveCall: null,
            _goToLoop: null,
            _checkVisibile: null
        }, n.Defaults = {
            items: 3,
            loop: !1,
            center: !1,
            mouseDrag: !0,
            touchDrag: !0,
            pullDrag: !0,
            freeDrag: !1,
            margin: 0,
            stagePadding: 0,
            merge: !1,
            mergeFit: !0,
            autoWidth: !1,
            startPosition: 0,
            rtl: !1,
            smartSpeed: 250,
            fluidSpeed: !1,
            dragEndSpeed: !1,
            responsive: {},
            responsiveRefreshRate: 200,
            responsiveBaseElement: e,
            responsiveClass: !1,
            fallbackEasing: "swing",
            info: !1,
            nestedItemSelector: !1,
            itemElement: "div",
            stageElement: "div",
            themeClass: "owl-theme",
            baseClass: "owl-carousel",
            itemClass: "owl-item",
            centerClass: "center",
            activeClass: "active"
        }, n.Width = {
            Default: "default",
            Inner: "inner",
            Outer: "outer"
        }, n.Plugins = {}, n.Pipe = [{
            filter: ["width", "items", "settings"],
            run: function(t) {
                t.current = this._items && this._items[this.relative(this._current)]
            }
        }, {
            filter: ["items", "settings"],
            run: function() {
                var t = this._clones;
                (this.$stage.children(".cloned").length !== t.length || !this.settings.loop && t.length > 0) && (this.$stage.children(".cloned").remove(), this._clones = [])
            }
        }, {
            filter: ["items", "settings"],
            run: function() {
                var t, e, i = this._clones,
                    s = this._items,
                    n = this.settings.loop ? i.length - Math.max(2 * this.settings.items, 4) : 0;
                for (t = 0, e = Math.abs(n / 2); e > t; t++) n > 0 ? (this.$stage.children().eq(s.length + i.length - 1).remove(), i.pop(), this.$stage.children().eq(0).remove(), i.pop()) : (i.push(i.length / 2), this.$stage.append(s[i[i.length - 1]].clone().addClass("cloned")), i.push(s.length - 1 - (i.length - 1) / 2), this.$stage.prepend(s[i[i.length - 1]].clone().addClass("cloned")))
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function() {
                var t, e, i, s = this.settings.rtl ? 1 : -1,
                    n = (this.width() / this.settings.items).toFixed(3),
                    o = 0;
                for (this._coordinates = [], e = 0, i = this._clones.length + this._items.length; i > e; e++) t = this._mergers[this.relative(e)], t = this.settings.mergeFit && Math.min(t, this.settings.items) || t, o += (this.settings.autoWidth ? this._items[this.relative(e)].width() + this.settings.margin : n * t) * s, this._coordinates.push(o)
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function() {
                var e, i, s = (this.width() / this.settings.items).toFixed(3),
                    n = {
                        width: Math.abs(this._coordinates[this._coordinates.length - 1]) + 2 * this.settings.stagePadding,
                        "padding-left": this.settings.stagePadding || "",
                        "padding-right": this.settings.stagePadding || ""
                    };
                if (this.$stage.css(n), n = {
                        width: this.settings.autoWidth ? "auto" : s - this.settings.margin
                    }, n[this.settings.rtl ? "margin-left" : "margin-right"] = this.settings.margin, !this.settings.autoWidth && t.grep(this._mergers, function(t) {
                        return t > 1
                    }).length > 0)
                    for (e = 0, i = this._coordinates.length; i > e; e++) n.width = Math.abs(this._coordinates[e]) - Math.abs(this._coordinates[e - 1] || 0) - this.settings.margin, this.$stage.children().eq(e).css(n);
                else this.$stage.children().css(n)
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(t) {
                t.current && this.reset(this.$stage.children().index(t.current))
            }
        }, {
            filter: ["position"],
            run: function() {
                this.animate(this.coordinates(this._current))
            }
        }, {
            filter: ["width", "position", "items", "settings"],
            run: function() {
                var t, e, i, s, n = this.settings.rtl ? 1 : -1,
                    o = 2 * this.settings.stagePadding,
                    r = this.coordinates(this.current()) + o,
                    a = r + this.width() * n,
                    l = [];
                for (i = 0, s = this._coordinates.length; s > i; i++) t = this._coordinates[i - 1] || 0, e = Math.abs(this._coordinates[i]) + o * n, (this.op(t, "<=", r) && this.op(t, ">", a) || this.op(e, "<", r) && this.op(e, ">", a)) && l.push(i);
                this.$stage.children("." + this.settings.activeClass).removeClass(this.settings.activeClass), this.$stage.children(":eq(" + l.join("), :eq(") + ")").addClass(this.settings.activeClass), this.settings.center && (this.$stage.children("." + this.settings.centerClass).removeClass(this.settings.centerClass), this.$stage.children().eq(this.current()).addClass(this.settings.centerClass))
            }
        }], n.prototype.initialize = function() {
            if (this.trigger("initialize"), this.$element.addClass(this.settings.baseClass).addClass(this.settings.themeClass).toggleClass("owl-rtl", this.settings.rtl), this.browserSupport(), this.settings.autoWidth && !0 !== this.state.imagesLoaded) {
                var e, i, n;
                if (e = this.$element.find("img"), i = this.settings.nestedItemSelector ? "." + this.settings.nestedItemSelector : s, n = this.$element.children(i).width(), e.length && 0 >= n) return this.preloadAutoWidthImages(e), !1
            }
            this.$element.addClass("owl-loading"), this.$stage = t("<" + this.settings.stageElement + ' class="owl-stage"/>').wrap('<div class="owl-stage-outer">'), this.$element.append(this.$stage.parent()), this.replace(this.$element.children().not(this.$stage.parent())), this._width = this.$element.width(), this.refresh(), this.$element.removeClass("owl-loading").addClass("owl-loaded"), this.eventsCall(), this.internalEvents(), this.addTriggerableEvents(), this.trigger("initialized")
        }, n.prototype.setup = function() {
            var e = this.viewport(),
                i = this.options.responsive,
                s = -1,
                n = null;
            i ? (t.each(i, function(t) {
                e >= t && t > s && (s = Number(t))
            }), n = t.extend({}, this.options, i[s]), delete n.responsive, n.responsiveClass && this.$element.attr("class", function(t, e) {
                return e.replace(/\b owl-responsive-\S+/g, "")
            }).addClass("owl-responsive-" + s)) : n = t.extend({}, this.options), (null === this.settings || this._breakpoint !== s) && (this.trigger("change", {
                property: {
                    name: "settings",
                    value: n
                }
            }), this._breakpoint = s, this.settings = n, this.invalidate("settings"), this.trigger("changed", {
                property: {
                    name: "settings",
                    value: this.settings
                }
            }))
        }, n.prototype.optionsLogic = function() {
            this.$element.toggleClass("owl-center", this.settings.center), this.settings.loop && this._items.length < this.settings.items && (this.settings.loop = !1), this.settings.autoWidth && (this.settings.stagePadding = !1, this.settings.merge = !1)
        }, n.prototype.prepare = function(e) {
            var i = this.trigger("prepare", {
                content: e
            });
            return i.data || (i.data = t("<" + this.settings.itemElement + "/>").addClass(this.settings.itemClass).append(e)), this.trigger("prepared", {
                content: i.data
            }), i.data
        }, n.prototype.update = function() {
            for (var e = 0, i = this._pipe.length, s = t.proxy(function(t) {
                return this[t]
            }, this._invalidated), n = {}; i > e;)(this._invalidated.all || t.grep(this._pipe[e].filter, s).length > 0) && this._pipe[e].run(n), e++;
            this._invalidated = {}
        }, n.prototype.width = function(t) {
            switch (t = t || n.Width.Default) {
                case n.Width.Inner:
                case n.Width.Outer:
                    return this._width;
                default:
                    return this._width - 2 * this.settings.stagePadding + this.settings.margin
            }
        }, n.prototype.refresh = function() {
            if (0 === this._items.length) return !1;
            (new Date).getTime(), this.trigger("refresh"), this.setup(), this.optionsLogic(), this.$stage.addClass("owl-refresh"), this.update(), this.$stage.removeClass("owl-refresh"), this.state.orientation = e.orientation, this.watchVisibility(), this.trigger("refreshed")
        }, n.prototype.eventsCall = function() {
            this.e._onDragStart = t.proxy(function(t) {
                this.onDragStart(t)
            }, this), this.e._onDragMove = t.proxy(function(t) {
                this.onDragMove(t)
            }, this), this.e._onDragEnd = t.proxy(function(t) {
                this.onDragEnd(t)
            }, this), this.e._onResize = t.proxy(function(t) {
                this.onResize(t)
            }, this), this.e._transitionEnd = t.proxy(function(t) {
                this.transitionEnd(t)
            }, this), this.e._preventClick = t.proxy(function(t) {
                this.preventClick(t)
            }, this)
        }, n.prototype.onThrottledResize = function() {
            e.clearTimeout(this.resizeTimer), this.resizeTimer = e.setTimeout(this.e._onResize, this.settings.responsiveRefreshRate)
        }, n.prototype.onResize = function() {
            return !!this._items.length && (this._width !== this.$element.width() && (!this.trigger("resize").isDefaultPrevented() && (this._width = this.$element.width(), this.invalidate("width"), this.refresh(), void this.trigger("resized"))))
        }, n.prototype.eventsRouter = function(t) {
            var e = t.type;
            "mousedown" === e || "touchstart" === e ? this.onDragStart(t) : "mousemove" === e || "touchmove" === e ? this.onDragMove(t) : "mouseup" === e || "touchend" === e ? this.onDragEnd(t) : "touchcancel" === e && this.onDragEnd(t)
        }, n.prototype.internalEvents = function() {
            var i = (c(), u());
            this.settings.mouseDrag ? (this.$stage.on("mousedown", t.proxy(function(t) {
                this.eventsRouter(t)
            }, this)), this.$stage.on("dragstart", function() {
                return !1
            }), this.$stage.get(0).onselectstart = function() {
                return !1
            }) : this.$element.addClass("owl-text-select-on"), this.settings.touchDrag && !i && this.$stage.on("touchstart touchcancel", t.proxy(function(t) {
                this.eventsRouter(t)
            }, this)), this.transitionEndVendor && this.on(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd, !1), !1 !== this.settings.responsive && this.on(e, "resize", t.proxy(this.onThrottledResize, this))
        }, n.prototype.onDragStart = function(s) {
            var n, r, a, l;
            if (3 === (n = s.originalEvent || s || e.event).which || this.state.isTouch) return !1;
            if ("mousedown" === n.type && this.$stage.addClass("owl-grab"), this.trigger("drag"), this.drag.startTime = (new Date).getTime(), this.speed(0), this.state.isTouch = !0, this.state.isScrolling = !1, this.state.isSwiping = !1, this.drag.distance = 0, r = o(n).x, a = o(n).y, this.drag.offsetX = this.$stage.position().left, this.drag.offsetY = this.$stage.position().top, this.settings.rtl && (this.drag.offsetX = this.$stage.position().left + this.$stage.width() - this.width() + this.settings.margin), this.state.inMotion && this.support3d) l = this.getTransformProperty(), this.drag.offsetX = l, this.animate(l), this.state.inMotion = !0;
            else if (this.state.inMotion && !this.support3d) return this.state.inMotion = !1, !1;
            this.drag.startX = r - this.drag.offsetX, this.drag.startY = a - this.drag.offsetY, this.drag.start = r - this.drag.startX, this.drag.targetEl = n.target || n.srcElement, this.drag.updatedX = this.drag.start, ("IMG" === this.drag.targetEl.tagName || "A" === this.drag.targetEl.tagName) && (this.drag.targetEl.draggable = !1), t(i).on("mousemove.owl.dragEvents mouseup.owl.dragEvents touchmove.owl.dragEvents touchend.owl.dragEvents", t.proxy(function(t) {
                this.eventsRouter(t)
            }, this))
        }, n.prototype.onDragMove = function(t) {
            var i, n, r, a, l, h;
            this.state.isTouch && (this.state.isScrolling || (i = t.originalEvent || t || e.event, n = o(i).x, r = o(i).y, this.drag.currentX = n - this.drag.startX, this.drag.currentY = r - this.drag.startY, this.drag.distance = this.drag.currentX - this.drag.offsetX, this.drag.distance < 0 ? this.state.direction = this.settings.rtl ? "right" : "left" : this.drag.distance > 0 && (this.state.direction = this.settings.rtl ? "left" : "right"), this.settings.loop ? this.op(this.drag.currentX, ">", this.coordinates(this.minimum())) && "right" === this.state.direction ? this.drag.currentX -= (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length) : this.op(this.drag.currentX, "<", this.coordinates(this.maximum())) && "left" === this.state.direction && (this.drag.currentX += (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length)) : (a = this.coordinates(this.settings.rtl ? this.maximum() : this.minimum()), l = this.coordinates(this.settings.rtl ? this.minimum() : this.maximum()), h = this.settings.pullDrag ? this.drag.distance / 5 : 0, this.drag.currentX = Math.max(Math.min(this.drag.currentX, a + h), l + h)), (this.drag.distance > 8 || this.drag.distance < -8) && (i.preventDefault !== s ? i.preventDefault() : i.returnValue = !1, this.state.isSwiping = !0), this.drag.updatedX = this.drag.currentX, (this.drag.currentY > 16 || this.drag.currentY < -16) && !1 === this.state.isSwiping && (this.state.isScrolling = !0, this.drag.updatedX = this.drag.start), this.animate(this.drag.updatedX)))
        }, n.prototype.onDragEnd = function(e) {
            var s, n;
            if (this.state.isTouch) {
                if ("mouseup" === e.type && this.$stage.removeClass("owl-grab"), this.trigger("dragged"), this.drag.targetEl.removeAttribute("draggable"), this.state.isTouch = !1, this.state.isScrolling = !1, this.state.isSwiping = !1, 0 === this.drag.distance && !0 !== this.state.inMotion) return this.state.inMotion = !1, !1;
                this.drag.endTime = (new Date).getTime(), s = this.drag.endTime - this.drag.startTime, (Math.abs(this.drag.distance) > 3 || s > 300) && this.removeClick(this.drag.targetEl), n = this.closest(this.drag.updatedX), this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed), this.current(n), this.invalidate("position"), this.update(), this.settings.pullDrag || this.drag.updatedX !== this.coordinates(n) || this.transitionEnd(), this.drag.distance = 0, t(i).off(".owl.dragEvents")
            }
        }, n.prototype.removeClick = function(i) {
            this.drag.targetEl = i, t(i).on("click.preventClick", this.e._preventClick), e.setTimeout(function() {
                t(i).off("click.preventClick")
            }, 300)
        }, n.prototype.preventClick = function(e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = !1, e.stopPropagation && e.stopPropagation(), t(e.target).off("click.preventClick")
        }, n.prototype.getTransformProperty = function() {
            var t, i;
            return t = e.getComputedStyle(this.$stage.get(0), null).getPropertyValue(this.vendorName + "transform"), t = t.replace(/matrix(3d)?\(|\)/g, "").split(","), i = 16 === t.length, !0 !== i ? t[4] : t[12]
        }, n.prototype.closest = function(e) {
            var i = -1,
                s = this.width(),
                n = this.coordinates();
            return this.settings.freeDrag || t.each(n, t.proxy(function(t, o) {
                return e > o - 30 && o + 30 > e ? i = t : this.op(e, "<", o) && this.op(e, ">", n[t + 1] || o - s) && (i = "left" === this.state.direction ? t + 1 : t), -1 === i
            }, this)), this.settings.loop || (this.op(e, ">", n[this.minimum()]) ? i = e = this.minimum() : this.op(e, "<", n[this.maximum()]) && (i = e = this.maximum())), i
        }, n.prototype.animate = function(e) {
            this.trigger("translate"), this.state.inMotion = this.speed() > 0, this.support3d ? this.$stage.css({
                transform: "translate3d(" + e + "px,0px, 0px)",
                transition: this.speed() / 1e3 + "s"
            }) : this.state.isTouch ? this.$stage.css({
                left: e + "px"
            }) : this.$stage.animate({
                left: e
            }, this.speed() / 1e3, this.settings.fallbackEasing, t.proxy(function() {
                this.state.inMotion && this.transitionEnd()
            }, this))
        }, n.prototype.current = function(t) {
            if (t === s) return this._current;
            if (0 === this._items.length) return s;
            if (t = this.normalize(t), this._current !== t) {
                var e = this.trigger("change", {
                    property: {
                        name: "position",
                        value: t
                    }
                });
                e.data !== s && (t = this.normalize(e.data)), this._current = t, this.invalidate("position"), this.trigger("changed", {
                    property: {
                        name: "position",
                        value: this._current
                    }
                })
            }
            return this._current
        }, n.prototype.invalidate = function(t) {
            this._invalidated[t] = !0
        }, n.prototype.reset = function(t) {
            (t = this.normalize(t)) !== s && (this._speed = 0, this._current = t, this.suppress(["translate", "translated"]), this.animate(this.coordinates(t)), this.release(["translate", "translated"]))
        }, n.prototype.normalize = function(e, i) {
            var n = i ? this._items.length : this._items.length + this._clones.length;
            return !t.isNumeric(e) || 1 > n ? s : e = this._clones.length ? (e % n + n) % n : Math.max(this.minimum(i), Math.min(this.maximum(i), e))
        }, n.prototype.relative = function(t) {
            return t = this.normalize(t), t -= this._clones.length / 2, this.normalize(t, !0)
        }, n.prototype.maximum = function(t) {
            var e, i, s, n = 0,
                o = this.settings;
            if (t) return this._items.length - 1;
            if (!o.loop && o.center) e = this._items.length - 1;
            else if (o.loop || o.center)
                if (o.loop || o.center) e = this._items.length + o.items;
                else {
                    if (!o.autoWidth && !o.merge) throw "Can not detect maximum absolute position.";
                    for (revert = o.rtl ? 1 : -1, i = this.$stage.width() - this.$element.width();
                         (s = this.coordinates(n)) && !(s * revert >= i);) e = ++n
                }
            else e = this._items.length - o.items;
            return e
        }, n.prototype.minimum = function(t) {
            return t ? 0 : this._clones.length / 2
        }, n.prototype.items = function(t) {
            return t === s ? this._items.slice() : (t = this.normalize(t, !0), this._items[t])
        }, n.prototype.mergers = function(t) {
            return t === s ? this._mergers.slice() : (t = this.normalize(t, !0), this._mergers[t])
        }, n.prototype.clones = function(e) {
            var i = this._clones.length / 2,
                n = i + this._items.length,
                o = function(t) {
                    return t % 2 == 0 ? n + t / 2 : i - (t + 1) / 2
                };
            return e === s ? t.map(this._clones, function(t, e) {
                return o(e)
            }) : t.map(this._clones, function(t, i) {
                return t === e ? o(i) : null
            })
        }, n.prototype.speed = function(t) {
            return t !== s && (this._speed = t), this._speed
        }, n.prototype.coordinates = function(e) {
            var i = null;
            return e === s ? t.map(this._coordinates, t.proxy(function(t, e) {
                return this.coordinates(e)
            }, this)) : (this.settings.center ? (i = this._coordinates[e], i += (this.width() - i + (this._coordinates[e - 1] || 0)) / 2 * (this.settings.rtl ? -1 : 1)) : i = this._coordinates[e - 1] || 0, i)
        }, n.prototype.duration = function(t, e, i) {
            return Math.min(Math.max(Math.abs(e - t), 1), 6) * Math.abs(i || this.settings.smartSpeed)
        }, n.prototype.to = function(i, s) {
            if (this.settings.loop) {
                var n = i - this.relative(this.current()),
                    o = this.current(),
                    r = this.current(),
                    a = this.current() + n,
                    l = 0 > r - a,
                    h = this._clones.length + this._items.length;
                a < this.settings.items && !1 === l ? (o = r + this._items.length, this.reset(o)) : a >= h - this.settings.items && !0 === l && (o = r - this._items.length, this.reset(o)), e.clearTimeout(this.e._goToLoop), this.e._goToLoop = e.setTimeout(t.proxy(function() {
                    this.speed(this.duration(this.current(), o + n, s)), this.current(o + n), this.update()
                }, this), 30)
            } else this.speed(this.duration(this.current(), i, s)), this.current(i), this.update()
        }, n.prototype.next = function(t) {
            t = t || !1, this.to(this.relative(this.current()) + 1, t)
        }, n.prototype.prev = function(t) {
            t = t || !1, this.to(this.relative(this.current()) - 1, t)
        }, n.prototype.transitionEnd = function(t) {
            return (t === s || (t.stopPropagation(), (t.target || t.srcElement || t.originalTarget) === this.$stage.get(0))) && (this.state.inMotion = !1, void this.trigger("translated"))
        }, n.prototype.viewport = function() {
            var s;
            if (this.options.responsiveBaseElement !== e) s = t(this.options.responsiveBaseElement).width();
            else if (e.innerWidth) s = e.innerWidth;
            else {
                if (!i.documentElement || !i.documentElement.clientWidth) throw "Can not detect viewport width.";
                s = i.documentElement.clientWidth
            }
            return s
        }, n.prototype.replace = function(e) {
            this.$stage.empty(), this._items = [], e && (e = e instanceof jQuery ? e : t(e)), this.settings.nestedItemSelector && (e = e.find("." + this.settings.nestedItemSelector)), e.filter(function() {
                return 1 === this.nodeType
            }).each(t.proxy(function(t, e) {
                e = this.prepare(e), this.$stage.append(e), this._items.push(e), this._mergers.push(1 * e.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)
            }, this)), this.reset(t.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0), this.invalidate("items")
        }, n.prototype.add = function(t, e) {
            e = e === s ? this._items.length : this.normalize(e, !0), this.trigger("add", {
                content: t,
                position: e
            }), 0 === this._items.length || e === this._items.length ? (this.$stage.append(t), this._items.push(t), this._mergers.push(1 * t.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)) : (this._items[e].before(t), this._items.splice(e, 0, t), this._mergers.splice(e, 0, 1 * t.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)), this.invalidate("items"), this.trigger("added", {
                content: t,
                position: e
            })
        }, n.prototype.remove = function(t) {
            (t = this.normalize(t, !0)) !== s && (this.trigger("remove", {
                content: this._items[t],
                position: t
            }), this._items[t].remove(), this._items.splice(t, 1), this._mergers.splice(t, 1), this.invalidate("items"), this.trigger("removed", {
                content: null,
                position: t
            }))
        }, n.prototype.addTriggerableEvents = function() {
            var e = t.proxy(function(e, i) {
                return t.proxy(function(t) {
                    t.relatedTarget !== this && (this.suppress([i]), e.apply(this, [].slice.call(arguments, 1)), this.release([i]))
                }, this)
            }, this);
            t.each({
                next: this.next,
                prev: this.prev,
                to: this.to,
                destroy: this.destroy,
                refresh: this.refresh,
                replace: this.replace,
                add: this.add,
                remove: this.remove
            }, t.proxy(function(t, i) {
                this.$element.on(t + ".owl.carousel", e(i, t + ".owl.carousel"))
            }, this))
        }, n.prototype.watchVisibility = function() {
            function i(t) {
                return t.offsetWidth > 0 && t.offsetHeight > 0
            }
            i(this.$element.get(0)) || (this.$element.addClass("owl-hidden"), e.clearInterval(this.e._checkVisibile), this.e._checkVisibile = e.setInterval(t.proxy(function() {
                i(this.$element.get(0)) && (this.$element.removeClass("owl-hidden"), this.refresh(), e.clearInterval(this.e._checkVisibile))
            }, this), 500))
        }, n.prototype.preloadAutoWidthImages = function(e) {
            var i, s, n, o;
            i = 0, s = this, e.each(function(r, a) {
                n = t(a), (o = new Image).onload = function() {
                    i++, n.attr("src", o.src), n.css("opacity", 1), i >= e.length && (s.state.imagesLoaded = !0, s.initialize())
                }, o.src = n.attr("src") || n.attr("data-src") || n.attr("data-src-retina")
            })
        }, n.prototype.destroy = function() {
            this.$element.hasClass(this.settings.themeClass) && this.$element.removeClass(this.settings.themeClass), !1 !== this.settings.responsive && t(e).off("resize.owl.carousel"), this.transitionEndVendor && this.off(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd);
            for (var s in this._plugins) this._plugins[s].destroy();
            (this.settings.mouseDrag || this.settings.touchDrag) && (this.$stage.off("mousedown touchstart touchcancel"), t(i).off(".owl.dragEvents"), this.$stage.get(0).onselectstart = function() {}, this.$stage.off("dragstart", function() {
                return !1
            })), this.$element.off(".owl"), this.$stage.children(".cloned").remove(), this.e = null, this.$element.removeData("owlCarousel"), this.$stage.children().contents().unwrap(), this.$stage.children().unwrap(), this.$stage.unwrap()
        }, n.prototype.op = function(t, e, i) {
            var s = this.settings.rtl;
            switch (e) {
                case "<":
                    return s ? t > i : i > t;
                case ">":
                    return s ? i > t : t > i;
                case ">=":
                    return s ? i >= t : t >= i;
                case "<=":
                    return s ? t >= i : i >= t
            }
        }, n.prototype.on = function(t, e, i, s) {
            t.addEventListener ? t.addEventListener(e, i, s) : t.attachEvent && t.attachEvent("on" + e, i)
        }, n.prototype.off = function(t, e, i, s) {
            t.removeEventListener ? t.removeEventListener(e, i, s) : t.detachEvent && t.detachEvent("on" + e, i)
        }, n.prototype.trigger = function(e, i, s) {
            var n = {
                    item: {
                        count: this._items.length,
                        index: this.current()
                    }
                },
                o = t.camelCase(t.grep(["on", e, s], function(t) {
                    return t
                }).join("-").toLowerCase()),
                r = t.Event([e, "owl", s || "carousel"].join(".").toLowerCase(), t.extend({
                    relatedTarget: this
                }, n, i));
            return this._supress[e] || (t.each(this._plugins, function(t, e) {
                e.onTrigger && e.onTrigger(r)
            }), this.$element.trigger(r), this.settings && "function" == typeof this.settings[o] && this.settings[o].apply(this, r)), r
        }, n.prototype.suppress = function(e) {
            t.each(e, t.proxy(function(t, e) {
                this._supress[e] = !0
            }, this))
        }, n.prototype.release = function(e) {
            t.each(e, t.proxy(function(t, e) {
                delete this._supress[e]
            }, this))
        }, n.prototype.browserSupport = function() {
            if (this.support3d = h(), this.support3d) {
                this.transformVendor = l();
                var t = ["transitionend", "webkitTransitionEnd", "transitionend", "oTransitionEnd"];
                this.transitionEndVendor = t[a()], this.vendorName = this.transformVendor.replace(/Transform/i, ""), this.vendorName = "" !== this.vendorName ? "-" + this.vendorName.toLowerCase() + "-" : ""
            }
            this.state.orientation = e.orientation
        }, t.fn.owlCarousel = function(e) {
            return this.each(function() {
                t(this).data("owlCarousel") || t(this).data("owlCarousel", new n(this, e))
            })
        }, t.fn.owlCarousel.Constructor = n
    }(window.Zepto || window.jQuery, window, document),
    function(t, e) {
        var i = function(e) {
            this._core = e, this._loaded = [], this._handlers = {
                "initialized.owl.carousel change.owl.carousel": t.proxy(function(e) {
                    if (e.namespace && this._core.settings && this._core.settings.lazyLoad && (e.property && "position" == e.property.name || "initialized" == e.type))
                        for (var i = this._core.settings, s = i.center && Math.ceil(i.items / 2) || i.items, n = i.center && -1 * s || 0, o = (e.property && e.property.value || this._core.current()) + n, r = this._core.clones().length, a = t.proxy(function(t, e) {
                            this.load(e)
                        }, this); n++ < s;) this.load(r / 2 + this._core.relative(o)), r && t.each(this._core.clones(this._core.relative(o++)), a)
                }, this)
            }, this._core.options = t.extend({}, i.Defaults, this._core.options), this._core.$element.on(this._handlers)
        };
        i.Defaults = {
            lazyLoad: !1
        }, i.prototype.load = function(i) {
            var s = this._core.$stage.children().eq(i),
                n = s && s.find(".owl-lazy");
            !n || t.inArray(s.get(0), this._loaded) > -1 || (n.each(t.proxy(function(i, s) {
                var n, o = t(s),
                    r = e.devicePixelRatio > 1 && o.attr("data-src-retina") || o.attr("data-src");
                this._core.trigger("load", {
                    element: o,
                    url: r
                }, "lazy"), o.is("img") ? o.one("load.owl.lazy", t.proxy(function() {
                    o.css("opacity", 1), this._core.trigger("loaded", {
                        element: o,
                        url: r
                    }, "lazy")
                }, this)).attr("src", r) : (n = new Image, n.onload = t.proxy(function() {
                    o.css({
                        "background-image": "url(" + r + ")",
                        opacity: "1"
                    }), this._core.trigger("loaded", {
                        element: o,
                        url: r
                    }, "lazy")
                }, this), n.src = r)
            }, this)), this._loaded.push(s.get(0)))
        }, i.prototype.destroy = function() {
            var t, e;
            for (t in this.handlers) this._core.$element.off(t, this.handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Lazy = i
    }(window.Zepto || window.jQuery, window, document),
    function(t) {
        var e = function(i) {
            this._core = i, this._handlers = {
                "initialized.owl.carousel": t.proxy(function() {
                    this._core.settings.autoHeight && this.update()
                }, this),
                "changed.owl.carousel": t.proxy(function(t) {
                    this._core.settings.autoHeight && "position" == t.property.name && this.update()
                }, this),
                "loaded.owl.lazy": t.proxy(function(t) {
                    this._core.settings.autoHeight && t.element.closest("." + this._core.settings.itemClass) === this._core.$stage.children().eq(this._core.current()) && this.update()
                }, this)
            }, this._core.options = t.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers)
        };
        e.Defaults = {
            autoHeight: !1,
            autoHeightClass: "owl-height"
        }, e.prototype.update = function() {
            this._core.$stage.parent().height(this._core.$stage.children().eq(this._core.current()).height()).addClass(this._core.settings.autoHeightClass)
        }, e.prototype.destroy = function() {
            var t, e;
            for (t in this._handlers) this._core.$element.off(t, this._handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.AutoHeight = e
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, i) {
        var s = function(e) {
            this._core = e, this._videos = {}, this._playing = null, this._fullscreen = !1, this._handlers = {
                "resize.owl.carousel": t.proxy(function(t) {
                    this._core.settings.video && !this.isInFullScreen() && t.preventDefault()
                }, this),
                "refresh.owl.carousel changed.owl.carousel": t.proxy(function() {
                    this._playing && this.stop()
                }, this),
                "prepared.owl.carousel": t.proxy(function(e) {
                    var i = t(e.content).find(".owl-video");
                    i.length && (i.css("display", "none"), this.fetch(i, t(e.content)))
                }, this)
            }, this._core.options = t.extend({}, s.Defaults, this._core.options), this._core.$element.on(this._handlers), this._core.$element.on("click.owl.video", ".owl-video-play-icon", t.proxy(function(t) {
                this.play(t)
            }, this))
        };
        s.Defaults = {
            video: !1,
            videoHeight: !1,
            videoWidth: !1
        }, s.prototype.fetch = function(t, e) {
            var i = t.attr("data-vimeo-id") ? "vimeo" : "youtube",
                s = t.attr("data-vimeo-id") || t.attr("data-youtube-id"),
                n = t.attr("data-width") || this._core.settings.videoWidth,
                o = t.attr("data-height") || this._core.settings.videoHeight,
                r = t.attr("href");
            if (!r) throw new Error("Missing video URL.");
            if ((s = r.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/))[3].indexOf("youtu") > -1) i = "youtube";
            else {
                if (!(s[3].indexOf("vimeo") > -1)) throw new Error("Video URL not supported.");
                i = "vimeo"
            }
            s = s[6], this._videos[r] = {
                type: i,
                id: s,
                width: n,
                height: o
            }, e.attr("data-video", r), this.thumbnail(t, this._videos[r])
        }, s.prototype.thumbnail = function(e, i) {
            var s, n, o, r = i.width && i.height ? 'style="width:' + i.width + "px;height:" + i.height + 'px;"' : "",
                a = e.find("img"),
                l = "src",
                h = "",
                c = this._core.settings,
                u = function(t) {
                    n = '<div class="owl-video-play-icon"></div>', s = c.lazyLoad ? '<div class="owl-video-tn ' + h + '" ' + l + '="' + t + '"></div>' : '<div class="owl-video-tn" style="opacity:1;background-image:url(' + t + ')"></div>', e.after(s), e.after(n)
                };
            return e.wrap('<div class="owl-video-wrapper"' + r + "></div>"), this._core.settings.lazyLoad && (l = "data-src", h = "owl-lazy"), a.length ? (u(a.attr(l)), a.remove(), !1) : void("youtube" === i.type ? (o = "http://img.youtube.com/vi/" + i.id + "/hqdefault.jpg", u(o)) : "vimeo" === i.type && t.ajax({
                type: "GET",
                url: "http://vimeo.com/api/v2/video/" + i.id + ".json",
                jsonp: "callback",
                dataType: "jsonp",
                success: function(t) {
                    o = t[0].thumbnail_large, u(o)
                }
            }))
        }, s.prototype.stop = function() {
            this._core.trigger("stop", null, "video"), this._playing.find(".owl-video-frame").remove(), this._playing.removeClass("owl-video-playing"), this._playing = null
        }, s.prototype.play = function(e) {
            this._core.trigger("play", null, "video"), this._playing && this.stop();
            var i, s, n = t(e.target || e.srcElement),
                o = n.closest("." + this._core.settings.itemClass),
                r = this._videos[o.attr("data-video")],
                a = r.width || "100%",
                l = r.height || this._core.$stage.height();
            "youtube" === r.type ? i = '<iframe width="' + a + '" height="' + l + '" src="http://www.youtube.com/embed/' + r.id + "?autoplay=1&v=" + r.id + '" frameborder="0" allowfullscreen></iframe>' : "vimeo" === r.type && (i = '<iframe src="http://player.vimeo.com/video/' + r.id + '?autoplay=1" width="' + a + '" height="' + l + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'), o.addClass("owl-video-playing"), this._playing = o, s = t('<div style="height:' + l + "px; width:" + a + 'px" class="owl-video-frame">' + i + "</div>"), n.after(s)
        }, s.prototype.isInFullScreen = function() {
            var s = i.fullscreenElement || i.mozFullScreenElement || i.webkitFullscreenElement;
            return s && t(s).parent().hasClass("owl-video-frame") && (this._core.speed(0), this._fullscreen = !0), !(s && this._fullscreen && this._playing) && (this._fullscreen ? (this._fullscreen = !1, !1) : !this._playing || this._core.state.orientation === e.orientation || (this._core.state.orientation = e.orientation, !1))
        }, s.prototype.destroy = function() {
            var t, e;
            this._core.$element.off("click.owl.video");
            for (t in this._handlers) this._core.$element.off(t, this._handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Video = s
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, i, s) {
        var n = function(e) {
            this.core = e, this.core.options = t.extend({}, n.Defaults, this.core.options), this.swapping = !0, this.previous = s, this.next = s, this.handlers = {
                "change.owl.carousel": t.proxy(function(t) {
                    "position" == t.property.name && (this.previous = this.core.current(), this.next = t.property.value)
                }, this),
                "drag.owl.carousel dragged.owl.carousel translated.owl.carousel": t.proxy(function(t) {
                    this.swapping = "translated" == t.type
                }, this),
                "translate.owl.carousel": t.proxy(function() {
                    this.swapping && (this.core.options.animateOut || this.core.options.animateIn) && this.swap()
                }, this)
            }, this.core.$element.on(this.handlers)
        };
        n.Defaults = {
            animateOut: !1,
            animateIn: !1
        }, n.prototype.swap = function() {
            if (1 === this.core.settings.items && this.core.support3d) {
                this.core.speed(0);
                var e, i = t.proxy(this.clear, this),
                    s = this.core.$stage.children().eq(this.previous),
                    n = this.core.$stage.children().eq(this.next),
                    o = this.core.settings.animateIn,
                    r = this.core.settings.animateOut;
                this.core.current() !== this.previous && (r && (e = this.core.coordinates(this.previous) - this.core.coordinates(this.next), s.css({
                    left: e + "px"
                }).addClass("animated owl-animated-out").addClass(r).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", i)), o && n.addClass("animated owl-animated-in").addClass(o).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", i))
            }
        }, n.prototype.clear = function(e) {
            t(e.target).css({
                left: ""
            }).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut), this.core.transitionEnd()
        }, n.prototype.destroy = function() {
            var t, e;
            for (t in this.handlers) this.core.$element.off(t, this.handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Animate = n
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, i) {
        var s = function(e) {
            this.core = e, this.core.options = t.extend({}, s.Defaults, this.core.options), this.handlers = {
                "translated.owl.carousel refreshed.owl.carousel": t.proxy(function() {
                    this.autoplay()
                }, this),
                "play.owl.autoplay": t.proxy(function(t, e, i) {
                    this.play(e, i)
                }, this),
                "stop.owl.autoplay": t.proxy(function() {
                    this.stop()
                }, this),
                "mouseover.owl.autoplay": t.proxy(function() {
                    this.core.settings.autoplayHoverPause && this.pause()
                }, this),
                "mouseleave.owl.autoplay": t.proxy(function() {
                    this.core.settings.autoplayHoverPause && this.autoplay()
                }, this)
            }, this.core.$element.on(this.handlers)
        };
        s.Defaults = {
            autoplay: !1,
            autoplayTimeout: 5e3,
            autoplayHoverPause: !1,
            autoplaySpeed: !1
        }, s.prototype.autoplay = function() {
            this.core.settings.autoplay && !this.core.state.videoPlay ? (e.clearInterval(this.interval), this.interval = e.setInterval(t.proxy(function() {
                this.play()
            }, this), this.core.settings.autoplayTimeout)) : e.clearInterval(this.interval)
        }, s.prototype.play = function() {
            return !0 === i.hidden || this.core.state.isTouch || this.core.state.isScrolling || this.core.state.isSwiping || this.core.state.inMotion ? void 0 : !1 === this.core.settings.autoplay ? void e.clearInterval(this.interval) : void this.core.next(this.core.settings.autoplaySpeed)
        }, s.prototype.stop = function() {
            e.clearInterval(this.interval)
        }, s.prototype.pause = function() {
            e.clearInterval(this.interval)
        }, s.prototype.destroy = function() {
            var t, i;
            e.clearInterval(this.interval);
            for (t in this.handlers) this.core.$element.off(t, this.handlers[t]);
            for (i in Object.getOwnPropertyNames(this)) "function" != typeof this[i] && (this[i] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.autoplay = s
    }(window.Zepto || window.jQuery, window, document),
    function(t) {
        "use strict";
        var e = function(i) {
            this._core = i, this._initialized = !1, this._pages = [], this._controls = {}, this._templates = [], this.$element = this._core.$element, this._overrides = {
                next: this._core.next,
                prev: this._core.prev,
                to: this._core.to
            }, this._handlers = {
                "prepared.owl.carousel": t.proxy(function(e) {
                    this._core.settings.dotsData && this._templates.push(t(e.content).find("[data-dot]").andSelf("[data-dot]").attr("data-dot"))
                }, this),
                "add.owl.carousel": t.proxy(function(e) {
                    this._core.settings.dotsData && this._templates.splice(e.position, 0, t(e.content).find("[data-dot]").andSelf("[data-dot]").attr("data-dot"))
                }, this),
                "remove.owl.carousel prepared.owl.carousel": t.proxy(function(t) {
                    this._core.settings.dotsData && this._templates.splice(t.position, 1)
                }, this),
                "change.owl.carousel": t.proxy(function(t) {
                    if ("position" == t.property.name && !this._core.state.revert && !this._core.settings.loop && this._core.settings.navRewind) {
                        var e = this._core.current(),
                            i = this._core.maximum(),
                            s = this._core.minimum();
                        t.data = t.property.value > i ? e >= i ? s : i : t.property.value < s ? i : t.property.value
                    }
                }, this),
                "changed.owl.carousel": t.proxy(function(t) {
                    "position" == t.property.name && this.draw()
                }, this),
                "refreshed.owl.carousel": t.proxy(function() {
                    this._initialized || (this.initialize(), this._initialized = !0), this._core.trigger("refresh", null, "navigation"), this.update(), this.draw(), this._core.trigger("refreshed", null, "navigation")
                }, this)
            }, this._core.options = t.extend({}, e.Defaults, this._core.options), this.$element.on(this._handlers)
        };
        e.Defaults = {
            nav: !1,
            navRewind: !0,
            navText: ["prev", "next"],
            navSpeed: !1,
            navElement: "div",
            navContainer: !1,
            navContainerClass: "owl-nav",
            navClass: ["owl-prev", "owl-next"],
            slideBy: 1,
            dotClass: "owl-dot",
            dotsClass: "owl-dots",
            dots: !0,
            dotsEach: !1,
            dotData: !1,
            dotsSpeed: !1,
            dotsContainer: !1,
            controlsClass: "owl-controls"
        }, e.prototype.initialize = function() {
            var e, i, s = this._core.settings;
            s.dotsData || (this._templates = [t("<div>").addClass(s.dotClass).append(t("<span>")).prop("outerHTML")]), s.navContainer && s.dotsContainer || (this._controls.$container = t("<div>").addClass(s.controlsClass).appendTo(this.$element)), this._controls.$indicators = s.dotsContainer ? t(s.dotsContainer) : t("<div>").hide().addClass(s.dotsClass).appendTo(this._controls.$container), this._controls.$indicators.on("click", "div", t.proxy(function(e) {
                var i = t(e.target).parent().is(this._controls.$indicators) ? t(e.target).index() : t(e.target).parent().index();
                e.preventDefault(), this.to(i, s.dotsSpeed)
            }, this)), e = s.navContainer ? t(s.navContainer) : t("<div>").addClass(s.navContainerClass).prependTo(this._controls.$container), this._controls.$next = t("<" + s.navElement + ">"), this._controls.$previous = this._controls.$next.clone(), this._controls.$previous.addClass(s.navClass[0]).html(s.navText[0]).hide().prependTo(e).on("click", t.proxy(function() {
                this.prev(s.navSpeed)
            }, this)), this._controls.$next.addClass(s.navClass[1]).html(s.navText[1]).hide().appendTo(e).on("click", t.proxy(function() {
                this.next(s.navSpeed)
            }, this));
            for (i in this._overrides) this._core[i] = t.proxy(this[i], this)
        }, e.prototype.destroy = function() {
            var t, e, i, s;
            for (t in this._handlers) this.$element.off(t, this._handlers[t]);
            for (e in this._controls) this._controls[e].remove();
            for (s in this.overides) this._core[s] = this._overrides[s];
            for (i in Object.getOwnPropertyNames(this)) "function" != typeof this[i] && (this[i] = null)
        }, e.prototype.update = function() {
            var t, e, i, s = this._core.settings,
                n = this._core.clones().length / 2,
                o = n + this._core.items().length,
                r = s.center || s.autoWidth || s.dotData ? 1 : s.dotsEach || s.items;
            if ("page" !== s.slideBy && (s.slideBy = Math.min(s.slideBy, s.items)), s.dots || "page" == s.slideBy)
                for (this._pages = [], t = n, e = 0, i = 0; o > t; t++)(e >= r || 0 === e) && (this._pages.push({
                    start: t - n,
                    end: t - n + r - 1
                }), e = 0, ++i), e += this._core.mergers(this._core.relative(t))
        }, e.prototype.draw = function() {
            var e, i, s = "",
                n = this._core.settings,
                o = (this._core.$stage.children(), this._core.relative(this._core.current()));
            if (!n.nav || n.loop || n.navRewind || (this._controls.$previous.toggleClass("disabled", 0 >= o), this._controls.$next.toggleClass("disabled", o >= this._core.maximum())), this._controls.$previous.toggle(n.nav), this._controls.$next.toggle(n.nav), n.dots) {
                if (e = this._pages.length - this._controls.$indicators.children().length, n.dotData && 0 !== e) {
                    for (i = 0; i < this._controls.$indicators.children().length; i++) s += this._templates[this._core.relative(i)];
                    this._controls.$indicators.html(s)
                } else e > 0 ? (s = new Array(e + 1).join(this._templates[0]), this._controls.$indicators.append(s)) : 0 > e && this._controls.$indicators.children().slice(e).remove();
                this._controls.$indicators.find(".active").removeClass("active"), this._controls.$indicators.children().eq(t.inArray(this.current(), this._pages)).addClass("active")
            }
            this._controls.$indicators.toggle(n.dots)
        }, e.prototype.onTrigger = function(e) {
            var i = this._core.settings;
            e.page = {
                index: t.inArray(this.current(), this._pages),
                count: this._pages.length,
                size: i && (i.center || i.autoWidth || i.dotData ? 1 : i.dotsEach || i.items)
            }
        }, e.prototype.current = function() {
            var e = this._core.relative(this._core.current());
            return t.grep(this._pages, function(t) {
                return t.start <= e && t.end >= e
            }).pop()
        }, e.prototype.getPosition = function(e) {
            var i, s, n = this._core.settings;
            return "page" == n.slideBy ? (i = t.inArray(this.current(), this._pages), s = this._pages.length, e ? ++i : --i, i = this._pages[(i % s + s) % s].start) : (i = this._core.relative(this._core.current()), s = this._core.items().length, e ? i += n.slideBy : i -= n.slideBy), i
        }, e.prototype.next = function(e) {
            t.proxy(this._overrides.to, this._core)(this.getPosition(!0), e)
        }, e.prototype.prev = function(e) {
            t.proxy(this._overrides.to, this._core)(this.getPosition(!1), e)
        }, e.prototype.to = function(e, i, s) {
            var n;
            s ? t.proxy(this._overrides.to, this._core)(e, i) : (n = this._pages.length, t.proxy(this._overrides.to, this._core)(this._pages[(e % n + n) % n].start, i))
        }, t.fn.owlCarousel.Constructor.Plugins.Navigation = e
    }(window.Zepto || window.jQuery, window, document),
    function(t, e) {
        "use strict";
        var i = function(s) {
            this._core = s, this._hashes = {}, this.$element = this._core.$element, this._handlers = {
                "initialized.owl.carousel": t.proxy(function() {
                    "URLHash" == this._core.settings.startPosition && t(e).trigger("hashchange.owl.navigation")
                }, this),
                "prepared.owl.carousel": t.proxy(function(e) {
                    var i = t(e.content).find("[data-hash]").andSelf("[data-hash]").attr("data-hash");
                    this._hashes[i] = e.content
                }, this)
            }, this._core.options = t.extend({}, i.Defaults, this._core.options), this.$element.on(this._handlers), t(e).on("hashchange.owl.navigation", t.proxy(function() {
                var t = e.location.hash.substring(1),
                    i = this._core.$stage.children(),
                    s = this._hashes[t] && i.index(this._hashes[t]) || 0;
                return !!t && void this._core.to(s, !1, !0)
            }, this))
        };
        i.Defaults = {
            URLhashListener: !1
        }, i.prototype.destroy = function() {
            var i, s;
            t(e).off("hashchange.owl.navigation");
            for (i in this._handlers) this._core.$element.off(i, this._handlers[i]);
            for (s in Object.getOwnPropertyNames(this)) "function" != typeof this[s] && (this[s] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Hash = i
    }(window.Zepto || window.jQuery, window, document),
    function() {
        function t() {
            S.keyboardSupport && c("keydown", s)
        }

        function e() {
            if (!k && document.body) {
                k = !0;
                var e = document.body,
                    i = document.documentElement,
                    s = window.innerHeight,
                    n = e.scrollHeight;
                if (z = document.compatMode.indexOf("CSS") >= 0 ? i : e, w = e, t(), top != self) E = !0;
                else if (n > s && (e.offsetHeight <= s || i.offsetHeight <= s)) {
                    var o = document.createElement("div");
                    o.style.cssText = "position:absolute; z-index:-10000; top:0; left:0; right:0; height:" + z.scrollHeight + "px", document.body.appendChild(o);
                    var r, a = function() {
                        r || (r = setTimeout(function() {
                            $ || (o.style.height = "0", o.style.height = z.scrollHeight + "px", r = null)
                        }, 500))
                    };
                    setTimeout(a, 10);
                    var l = {
                        attributes: !0,
                        childList: !0,
                        characterData: !1
                    };
                    if ((_ = new X(a)).observe(e, l), z.offsetHeight <= s) {
                        var h = document.createElement("div");
                        h.style.clear = "both", e.appendChild(h)
                    }
                }
                S.fixedBackground || $ || (e.style.backgroundAttachment = "scroll", i.style.backgroundAttachment = "scroll")
            }
        }

        function i(t, e, i) {
            if (d(e, i), 1 != S.accelerationMax) {
                var s = Date.now() - L;
                if (s < S.accelerationDelta) {
                    var n = (1 + 50 / s) / 2;
                    n > 1 && (n = Math.min(n, S.accelerationMax), e *= n, i *= n)
                }
                L = Date.now()
            }
            if (O.push({
                    x: e,
                    y: i,
                    lastX: 0 > e ? .99 : -.99,
                    lastY: 0 > i ? .99 : -.99,
                    start: Date.now()
                }), !H) {
                var o = t === document.body,
                    r = function(s) {
                        for (var n = Date.now(), a = 0, l = 0, h = 0; h < O.length; h++) {
                            var c = O[h],
                                u = n - c.start,
                                d = u >= S.animationTime,
                                p = d ? 1 : u / S.animationTime;
                            S.pulseAlgorithm && (p = y(p));
                            var f = c.x * p - c.lastX >> 0,
                                g = c.y * p - c.lastY >> 0;
                            a += f, l += g, c.lastX += f, c.lastY += g, d && (O.splice(h, 1), h--)
                        }
                        o ? window.scrollBy(a, l) : (a && (t.scrollLeft += a), l && (t.scrollTop += l)), e || i || (O = []), O.length ? W(r, t, 1e3 / S.frameRate + 1) : H = !1
                    };
                W(r, t, 0), H = !0
            }
        }

        function s(t) {
            var e = t.target,
                s = t.ctrlKey || t.altKey || t.metaKey || t.shiftKey && t.keyCode !== P.spacebar;
            document.contains(w) || (w = document.activeElement);
            var o = /^(button|submit|radio|checkbox|file|color|image)$/i;
            if (/^(textarea|select|embed|object)$/i.test(e.nodeName) || u(e, "input") && !o.test(e.type) || u(w, "video") || m(t) || e.isContentEditable || t.defaultPrevented || s) return !0;
            if ((u(e, "button") || u(e, "input") && o.test(e.type)) && t.keyCode === P.spacebar) return !0;
            var a = 0,
                l = 0,
                h = r(w),
                c = h.clientHeight;
            switch (h == document.body && (c = window.innerHeight), t.keyCode) {
                case P.up:
                    l = -S.arrowScroll;
                    break;
                case P.down:
                    l = S.arrowScroll;
                    break;
                case P.spacebar:
                    l = -(t.shiftKey ? 1 : -1) * c * .9;
                    break;
                case P.pageup:
                    l = .9 * -c;
                    break;
                case P.pagedown:
                    l = .9 * c;
                    break;
                case P.home:
                    l = -h.scrollTop;
                    break;
                case P.end:
                    var d = h.scrollHeight - h.scrollTop - c;
                    l = d > 0 ? d + 10 : 0;
                    break;
                case P.left:
                    a = -S.arrowScroll;
                    break;
                case P.right:
                    a = S.arrowScroll;
                    break;
                default:
                    return !0
            }
            i(h, a, l), t.preventDefault(), n()
        }

        function n() {
            clearTimeout(x), x = setInterval(function() {
                A = {}
            }, 1e3)
        }

        function o(t, e) {
            for (var i = t.length; i--;) A[j(t[i])] = e;
            return e
        }

        function r(t) {
            var e = [],
                i = document.body,
                s = z.scrollHeight;
            do {
                var n = A[j(t)];
                if (n) return o(e, n);
                if (e.push(t), s === t.scrollHeight) {
                    var r = l(z) && l(i) || h(z);
                    if (E && a(z) || !E && r) return o(e, I())
                } else if (a(t) && h(t)) return o(e, t)
            } while (t = t.parentElement)
        }

        function a(t) {
            return t.clientHeight + 10 < t.scrollHeight
        }

        function l(t) {
            return "hidden" !== getComputedStyle(t, "").getPropertyValue("overflow-y")
        }

        function h(t) {
            var e = getComputedStyle(t, "").getPropertyValue("overflow-y");
            return "scroll" === e || "auto" === e
        }

        function c(t, e) {
            window.addEventListener(t, e, !1)
        }

        function u(t, e) {
            return (t.nodeName || "").toLowerCase() === e.toLowerCase()
        }

        function d(t, e) {
            t = t > 0 ? 1 : -1, e = e > 0 ? 1 : -1, (T.x !== t || T.y !== e) && (T.x = t, T.y = e, O = [], L = 0)
        }

        function p(t) {
            return t ? (D.length || (D = [t, t, t]), t = Math.abs(t), D.push(t), D.shift(), clearTimeout(b), b = setTimeout(function() {
                window.localStorage && (localStorage.SS_deltaBuffer = D.join(","))
            }, 1e3), !g(120) && !g(100)) : void 0
        }

        function f(t, e) {
            return Math.floor(t / e) == t / e
        }

        function g(t) {
            return f(D[0], t) && f(D[1], t) && f(D[2], t)
        }

        function m(t) {
            var e = t.target,
                i = !1;
            if (-1 != document.URL.indexOf("www.youtube.com/watch"))
                do {
                    if (i = e.classList && e.classList.contains("html5-video-controls")) break
                } while (e = e.parentNode);
            return i
        }

        function v(t) {
            var e, i, s;
            return t *= S.pulseScale, 1 > t ? e = t - (1 - Math.exp(-t)) : (i = Math.exp(-1), t -= 1, s = 1 - Math.exp(-t), e = i + s * (1 - i)), e * S.pulseNormalize
        }

        function y(t) {
            return t >= 1 ? 1 : 0 >= t ? 0 : (1 == S.pulseNormalize && (S.pulseNormalize /= v(1)), v(t))
        }
        var w, _, x, b, C = {
                frameRate: 150,
                animationTime: 400,
                stepSize: 120,
                pulseAlgorithm: !0,
                pulseScale: 4,
                pulseNormalize: 1,
                accelerationDelta: 20,
                accelerationMax: 1,
                keyboardSupport: !0,
                arrowScroll: 50,
                touchpadSupport: !0,
                fixedBackground: !0,
                excluded: ""
            },
            S = C,
            $ = !1,
            E = !1,
            T = {
                x: 0,
                y: 0
            },
            k = !1,
            z = document.documentElement,
            D = [],
            M = /^Mac/.test(navigator.platform),
            P = {
                left: 37,
                up: 38,
                right: 39,
                down: 40,
                spacebar: 32,
                pageup: 33,
                pagedown: 34,
                end: 35,
                home: 36
            },
            S = C,
            O = [],
            H = !1,
            L = Date.now(),
            j = function() {
                var t = 0;
                return function(e) {
                    return e.uniqueID || (e.uniqueID = t++)
                }
            }(),
            A = {};
        window.localStorage && localStorage.SS_deltaBuffer && (D = localStorage.SS_deltaBuffer.split(","));
        var N, W = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function(t, e, i) {
                window.setTimeout(t, i || 1e3 / 60)
            },
            X = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver,
            I = function() {
                var t;
                return function() {
                    if (!t) {
                        var e = document.createElement("div");
                        e.style.cssText = "height:10000px;width:1px;", document.body.appendChild(e);
                        var i = document.body.scrollTop;
                        document.documentElement.scrollTop, window.scrollBy(0, 1), t = document.body.scrollTop != i ? document.body : document.documentElement, window.scrollBy(0, -1), document.body.removeChild(e)
                    }
                    return t
                }
            }();
        "onwheel" in document.createElement("div") ? N = "wheel" : "onmousewheel" in document.createElement("div") && (N = "mousewheel"), N && (c(N, function(t) {
            k || e();
            var s = t.target,
                o = r(s);
            if (!o || t.defaultPrevented || t.ctrlKey) return !0;
            if (u(w, "embed") || u(s, "embed") && /\.pdf/i.test(s.src) || u(w, "object")) return !0;
            var a = -t.wheelDeltaX || t.deltaX || 0,
                l = -t.wheelDeltaY || t.deltaY || 0;
            return M && (t.wheelDeltaX && f(t.wheelDeltaX, 120) && (a = t.wheelDeltaX / Math.abs(t.wheelDeltaX) * -120), t.wheelDeltaY && f(t.wheelDeltaY, 120) && (l = t.wheelDeltaY / Math.abs(t.wheelDeltaY) * -120)), a || l || (l = -t.wheelDelta || 0), 1 === t.deltaMode && (a *= 40, l *= 40), !(S.touchpadSupport || !p(l)) || (Math.abs(a) > 1.2 && (a *= S.stepSize / 120), Math.abs(l) > 1.2 && (l *= S.stepSize / 120), i(o, a, l), t.preventDefault(), void n())
        }), c("mousedown", function(t) {
            w = t.target
        }), c("load", e))
    }(),
    function(t) {
        "function" == typeof define && define.amd ? define(["jquery"], t) : t(jQuery)
    }(function(t) {
        function e(e, i, s) {
            var n = i.hash.slice(1),
                o = document.getElementById(n) || document.getElementsByName(n)[0];
            if (o) {
                e && e.preventDefault();
                var r = t(s.target);
                if (!(s.lock && r.is(":animated") || s.onBefore && !1 === s.onBefore(e, o, r))) {
                    if (s.stop && r._scrollable().stop(!0), s.hash) {
                        var a = o.id === n ? "id" : "name",
                            l = t("<a> </a>").attr(a, n).css({
                                position: "absolute",
                                top: t(window).scrollTop(),
                                left: t(window).scrollLeft()
                            });
                        o[a] = "", t("body").prepend(l), location.hash = i.hash, l.remove(), o[a] = n
                    }
                    r.scrollTo(o, s).trigger("notify.serialScroll", [o])
                }
            }
        }
        var i = location.href.replace(/#.*/, ""),
            s = t.localScroll = function(e) {
                t("body").localScroll(e)
            };
        return s.defaults = {
            duration: 1e3,
            axis: "y",
            event: "click",
            stop: !0,
            target: window
        }, t.fn.localScroll = function(n) {
            function o() {
                return !!this.href && !!this.hash && this.href.replace(this.hash, "") == i && (!n.filter || t(this).is(n.filter))
            }
            return (n = t.extend({}, s.defaults, n)).hash && location.hash && (n.target && window.scrollTo(0, 0), e(0, location, n)), n.lazy ? this.on(n.event, "a,area", function(t) {
                o.call(this) && e(t, this, n)
            }) : this.find("a,area").filter(o).bind(n.event, function(t) {
                e(t, this, n)
            }).end().end()
        }, s.hash = function() {}, s
    }),
    function(t) {
        "function" == typeof define && define.amd ? define(["jquery"], t) : t(jQuery)
    }(function(t) {
        function e(e) {
            return t.isFunction(e) || "object" == typeof e ? e : {
                top: e,
                left: e
            }
        }
        var i = t.scrollTo = function(e, i, s) {
            return t(window).scrollTo(e, i, s)
        };
        return i.defaults = {
            axis: "xy",
            duration: parseFloat(t.fn.jquery) >= 1.3 ? 0 : 1,
            limit: !0
        }, i.window = function(e) {
            return t(window)._scrollable()
        }, t.fn._scrollable = function() {
            return this.map(function() {
                var e = this;
                if (!(!e.nodeName || -1 != t.inArray(e.nodeName.toLowerCase(), ["iframe", "#document", "html", "body"]))) return e;
                var i = (e.contentWindow || e).document || e.ownerDocument || e;
                return /webkit/i.test(navigator.userAgent) || "BackCompat" == i.compatMode ? i.body : i.documentElement
            })
        }, t.fn.scrollTo = function(s, n, o) {
            return "object" == typeof n && (o = n, n = 0), "function" == typeof o && (o = {
                onAfter: o
            }), "max" == s && (s = 9e9), o = t.extend({}, i.defaults, o), n = n || o.duration, o.queue = o.queue && o.axis.length > 1, o.queue && (n /= 2), o.offset = e(o.offset), o.over = e(o.over), this._scrollable().each(function() {
                function r(t) {
                    h.animate(u, n, o.easing, t && function() {
                        t.call(this, c, o)
                    })
                }
                if (null != s) {
                    var a, l = this,
                        h = t(l),
                        c = s,
                        u = {},
                        d = h.is("html,body");
                    switch (typeof c) {
                        case "number":
                        case "string":
                            if (/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(c)) {
                                c = e(c);
                                break
                            }
                            if (!(c = d ? t(c) : t(c, this)).length) return;
                        case "object":
                            (c.is || c.style) && (a = (c = t(c)).offset())
                    }
                    var p = t.isFunction(o.offset) && o.offset(l, c) || o.offset;
                    t.each(o.axis.split(""), function(t, e) {
                        var s = "x" == e ? "Left" : "Top",
                            n = s.toLowerCase(),
                            f = "scroll" + s,
                            g = l[f],
                            m = i.max(l, e);
                        if (a) u[f] = a[n] + (d ? 0 : g - h.offset()[n]), o.margin && (u[f] -= parseInt(c.css("margin" + s)) || 0, u[f] -= parseInt(c.css("border" + s + "Width")) || 0), u[f] += p[n] || 0, o.over[n] && (u[f] += c["x" == e ? "width" : "height"]() * o.over[n]);
                        else {
                            var v = c[n];
                            u[f] = v.slice && "%" == v.slice(-1) ? parseFloat(v) / 100 * m : v
                        }
                        o.limit && /^\d+$/.test(u[f]) && (u[f] = u[f] <= 0 ? 0 : Math.min(u[f], m)), !t && o.queue && (g != u[f] && r(o.onAfterFirst), delete u[f])
                    }), r(o.onAfter)
                }
            }).end()
        }, i.max = function(e, i) {
            var s = "x" == i ? "Width" : "Height",
                n = "scroll" + s;
            if (!t(e).is("html,body")) return e[n] - t(e)[s.toLowerCase()]();
            var o = "client" + s,
                r = e.ownerDocument.documentElement,
                a = e.ownerDocument.body;
            return Math.max(r[n], a[n]) - Math.min(r[o], a[o])
        }, i
    }),
    function(t) {
        "use strict";
        t.fn.counterUp = function(e) {
            var i = t.extend({
                time: 400,
                delay: 10
            }, e);
            return this.each(function() {
                var e = t(this),
                    s = i;
                e.waypoint(function() {
                    var t = [],
                        i = s.time / s.delay,
                        n = e.text(),
                        o = /[0-9]+,[0-9]+/.test(n);
                    n = n.replace(/,/g, "");
                    /^[0-9]+$/.test(n);
                    for (var r = /^[0-9]+\.[0-9]+$/.test(n), a = r ? (n.split(".")[1] || []).length : 0, l = i; l >= 1; l--) {
                        var h = parseInt(n / i * l);
                        if (r && (h = parseFloat(n / i * l).toFixed(a)), o)
                            for (;
                                /(\d+)(\d{3})/.test(h.toString());) h = h.toString().replace(/(\d+)(\d{3})/, "$1,$2");
                        t.unshift(h)
                    }
                    e.data("counterup-nums", t), e.text("0");
                    e.data("counterup-func", function() {
                        e.text(e.data("counterup-nums").shift()), e.data("counterup-nums").length ? setTimeout(e.data("counterup-func"), s.delay) : (e.data("counterup-nums"), e.data("counterup-nums", null), e.data("counterup-func", null))
                    }), setTimeout(e.data("counterup-func"), s.delay)
                }, {
                    offset: "100%",
                    triggerOnce: !0
                })
            })
        }
    }(jQuery),
    function() {
        var t, e, i, s, n, o = function(t, e) {
                return function() {
                    return t.apply(e, arguments)
                }
            },
            r = [].indexOf || function(t) {
                for (var e = 0, i = this.length; i > e; e++)
                    if (e in this && this[e] === t) return e;
                return -1
            };
        e = function() {
            function t() {}
            return t.prototype.extend = function(t, e) {
                var i, s;
                for (i in e) s = e[i], null == t[i] && (t[i] = s);
                return t
            }, t.prototype.isMobile = function(t) {
                return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(t)
            }, t.prototype.addEvent = function(t, e, i) {
                return null != t.addEventListener ? t.addEventListener(e, i, !1) : null != t.attachEvent ? t.attachEvent("on" + e, i) : t[e] = i
            }, t.prototype.removeEvent = function(t, e, i) {
                return null != t.removeEventListener ? t.removeEventListener(e, i, !1) : null != t.detachEvent ? t.detachEvent("on" + e, i) : delete t[e]
            }, t.prototype.innerHeight = function() {
                return "innerHeight" in window ? window.innerHeight : document.documentElement.clientHeight
            }, t
        }(), i = this.WeakMap || this.MozWeakMap || (i = function() {
            function t() {
                this.keys = [], this.values = []
            }
            return t.prototype.get = function(t) {
                var e, i, s, n;
                for (e = i = 0, s = (n = this.keys).length; s > i; e = ++i)
                    if (n[e] === t) return this.values[e]
            }, t.prototype.set = function(t, e) {
                var i, s, n, o;
                for (i = s = 0, n = (o = this.keys).length; n > s; i = ++s)
                    if (o[i] === t) return void(this.values[i] = e);
                return this.keys.push(t), this.values.push(e)
            }, t
        }()), t = this.MutationObserver || this.WebkitMutationObserver || this.MozMutationObserver || (t = function() {
            function t() {
                "undefined" != typeof console && null !== console && console.warn("MutationObserver is not supported by your browser."), "undefined" != typeof console && null !== console && console.warn("WOW.js cannot detect dom mutations, please call .sync() after loading new content.")
            }
            return t.notSupported = !0, t.prototype.observe = function() {}, t
        }()), s = this.getComputedStyle || function(t) {
            return this.getPropertyValue = function(e) {
                var i;
                return "float" === e && (e = "styleFloat"), n.test(e) && e.replace(n, function(t, e) {
                    return e.toUpperCase()
                }), (null != (i = t.currentStyle) ? i[e] : void 0) || null
            }, this
        }, n = /(\-([a-z]){1})/g, this.WOW = function() {
            function n(t) {
                null == t && (t = {}), this.scrollCallback = o(this.scrollCallback, this), this.scrollHandler = o(this.scrollHandler, this), this.start = o(this.start, this), this.scrolled = !0, this.config = this.util().extend(t, this.defaults), this.animationNameCache = new i
            }
            return n.prototype.defaults = {
                boxClass: "wow",
                animateClass: "animated",
                offset: 0,
                mobile: !0,
                live: !0
            }, n.prototype.init = function() {
                var t;
                return this.element = window.document.documentElement, "interactive" === (t = document.readyState) || "complete" === t ? this.start() : this.util().addEvent(document, "DOMContentLoaded", this.start), this.finished = []
            }, n.prototype.start = function() {
                var e, i, s, n;
                if (this.stopped = !1, this.boxes = function() {
                        var t, i, s, n;
                        for (n = [], t = 0, i = (s = this.element.querySelectorAll("." + this.config.boxClass)).length; i > t; t++) e = s[t], n.push(e);
                        return n
                    }.call(this), this.all = function() {
                        var t, i, s, n;
                        for (n = [], t = 0, i = (s = this.boxes).length; i > t; t++) e = s[t], n.push(e);
                        return n
                    }.call(this), this.boxes.length)
                    if (this.disabled()) this.resetStyle();
                    else {
                        for (i = 0, s = (n = this.boxes).length; s > i; i++) e = n[i], this.applyStyle(e, !0);
                        this.util().addEvent(window, "scroll", this.scrollHandler), this.util().addEvent(window, "resize", this.scrollHandler), this.interval = setInterval(this.scrollCallback, 50)
                    } return this.config.live ? new t(function(t) {
                    return function(e) {
                        var i, s, n, o, r;
                        for (r = [], n = 0, o = e.length; o > n; n++) s = e[n], r.push(function() {
                            var t, e, n, o;
                            for (o = [], t = 0, e = (n = s.addedNodes || []).length; e > t; t++) i = n[t], o.push(this.doSync(i));
                            return o
                        }.call(t));
                        return r
                    }
                }(this)).observe(document.body, {
                    childList: !0,
                    subtree: !0
                }) : void 0
            }, n.prototype.stop = function() {
                return this.stopped = !0, this.util().removeEvent(window, "scroll", this.scrollHandler), this.util().removeEvent(window, "resize", this.scrollHandler), null != this.interval ? clearInterval(this.interval) : void 0
            }, n.prototype.sync = function() {
                return t.notSupported ? this.doSync(this.element) : void 0
            }, n.prototype.doSync = function(t) {
                var e, i, s, n, o;
                if (null == t && (t = this.element), 1 === t.nodeType) {
                    for (o = [], i = 0, s = (n = (t = t.parentNode || t).querySelectorAll("." + this.config.boxClass)).length; s > i; i++) e = n[i], r.call(this.all, e) < 0 ? (this.boxes.push(e), this.all.push(e), this.stopped || this.disabled() ? this.resetStyle() : this.applyStyle(e, !0), o.push(this.scrolled = !0)) : o.push(void 0);
                    return o
                }
            }, n.prototype.show = function(t) {
                return this.applyStyle(t), t.className = t.className + " " + this.config.animateClass
            }, n.prototype.applyStyle = function(t, e) {
                var i, s, n;
                return s = t.getAttribute("data-wow-duration"), i = t.getAttribute("data-wow-delay"), n = t.getAttribute("data-wow-iteration"), this.animate(function(o) {
                    return function() {
                        return o.customStyle(t, e, s, i, n)
                    }
                }(this))
            }, n.prototype.animate = "requestAnimationFrame" in window ? function(t) {
                return window.requestAnimationFrame(t)
            } : function(t) {
                return t()
            }, n.prototype.resetStyle = function() {
                var t, e, i, s, n;
                for (n = [], e = 0, i = (s = this.boxes).length; i > e; e++) t = s[e], n.push(t.style.visibility = "visible");
                return n
            }, n.prototype.customStyle = function(t, e, i, s, n) {
                return e && this.cacheAnimationName(t), t.style.visibility = e ? "hidden" : "visible", i && this.vendorSet(t.style, {
                    animationDuration: i
                }), s && this.vendorSet(t.style, {
                    animationDelay: s
                }), n && this.vendorSet(t.style, {
                    animationIterationCount: n
                }), this.vendorSet(t.style, {
                    animationName: e ? "none" : this.cachedAnimationName(t)
                }), t
            }, n.prototype.vendors = ["moz", "webkit"], n.prototype.vendorSet = function(t, e) {
                var i, s, n, o;
                o = [];
                for (i in e) s = e[i], t["" + i] = s, o.push(function() {
                    var e, o, r, a;
                    for (a = [], e = 0, o = (r = this.vendors).length; o > e; e++) n = r[e], a.push(t["" + n + i.charAt(0).toUpperCase() + i.substr(1)] = s);
                    return a
                }.call(this));
                return o
            }, n.prototype.vendorCSS = function(t, e) {
                var i, n, o, r, a, l;
                for (i = (n = s(t)).getPropertyCSSValue(e), r = 0, a = (l = this.vendors).length; a > r; r++) o = l[r], i = i || n.getPropertyCSSValue("-" + o + "-" + e);
                return i
            }, n.prototype.animationName = function(t) {
                var e;
                try {
                    e = this.vendorCSS(t, "animation-name").cssText
                } catch (i) {
                    e = s(t).getPropertyValue("animation-name")
                }
                return "none" === e ? "" : e
            }, n.prototype.cacheAnimationName = function(t) {
                return this.animationNameCache.set(t, this.animationName(t))
            }, n.prototype.cachedAnimationName = function(t) {
                return this.animationNameCache.get(t)
            }, n.prototype.scrollHandler = function() {
                return this.scrolled = !0
            }, n.prototype.scrollCallback = function() {
                var t;
                return !this.scrolled || (this.scrolled = !1, this.boxes = function() {
                    var e, i, s, n;
                    for (n = [], e = 0, i = (s = this.boxes).length; i > e; e++)(t = s[e]) && (this.isVisible(t) ? this.show(t) : n.push(t));
                    return n
                }.call(this), this.boxes.length || this.config.live) ? void 0 : this.stop()
            }, n.prototype.offsetTop = function(t) {
                for (var e; void 0 === t.offsetTop;) t = t.parentNode;
                for (e = t.offsetTop; t = t.offsetParent;) e += t.offsetTop;
                return e
            }, n.prototype.isVisible = function(t) {
                var e, i, s, n, o;
                return i = t.getAttribute("data-wow-offset") || this.config.offset, o = window.pageYOffset, n = o + Math.min(this.element.clientHeight, this.util().innerHeight()) - i, s = this.offsetTop(t), e = s + t.clientHeight, n >= s && e >= o
            }, n.prototype.util = function() {
                return null != this._util ? this._util : this._util = new e
            }, n.prototype.disabled = function() {
                return !this.config.mobile && this.util().isMobile(navigator.userAgent)
            }, n
        }()
    }.call(this);