/*
jquery-resizable
Version 0.35 - 11/18/2019
© 2015-2019 Rick Strahl, West Wind Technologies
www.west-wind.com
Licensed under MIT License
*/
(function (factory, undefined) {
    if (typeof define === 'function' && define.amd) {
        // AMD
        define(['jquery'], factory);
    } else if (typeof module === 'object' && typeof module.exports === 'object') {
        // CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Global jQuery
        factory(jQuery);
    }
}(function ($, undefined) {

    if ($.fn.resizableSafe)
        return;

    $.fn.resizableSafe = function fnResizable(options) {
        var defaultOptions = {
            // selector for handle that starts dragging
            handleSelector: null,
            // resize the width
            resizeWidth: true,
            // resize the height
            resizeHeight: true,
            // the side that the width resizing is relative to
            resizeWidthFrom: 'right',
            // the side that the height resizing is relative to
            resizeHeightFrom: 'bottom',
            // hook into start drag operation (event passed)
            onDragStart: null,
            // hook into stop drag operation (event passed)
            onDragEnd: null,
            // hook into each drag operation (event passed)
            onDrag: null,
            // disable touch-action on $handle
            // prevents browser level actions like forward back gestures
            touchActionNone: true,
            // instance id
            instanceId: null
        };
        if (typeof options == "object")
            defaultOptions = $.extend(defaultOptions, options);

        return this.each(function () {
            var opt = $.extend({}, defaultOptions);
            if (!opt.instanceId)
                opt.instanceId = "rsz_" + new Date().getTime();

            var startPos, startTransition;

            // get the element to resize 
            var $el = $(this);
            var $handle;

            if (options === 'destroy') {
                opt = $el.data('resizable');
                if (!opt)
                    return;

                $handle = getHandle(opt.handleSelector, $el);
                $handle.off("mousedown." + opt.instanceId + " touchstart." + opt.instanceId);
                if (opt.touchActionNone)
                    $handle.css("touch-action", "");
                $el.removeClass("resizable");
                return;
            }

            $el.data('resizable', opt);

            // get the drag handle

            $handle = getHandle(opt.handleSelector, $el);

            if (opt.touchActionNone)
                $handle.css("touch-action", "none");

            $el.addClass("resizable");
            $handle.on("mousedown." + opt.instanceId + " touchstart." + opt.instanceId, startDragging);

            function noop(e) {
                e.stopPropagation();
                e.preventDefault();
            };

            function startDragging(e) {
                // Prevent dragging a ghost image in HTML5 / Firefox and maybe others    
                if (e.preventDefault) {
                    e.preventDefault();
                }

                startPos = getMousePos(e);
                startPos.width = parseInt($el.width(), 10);
                startPos.height = parseInt($el.height(), 10);

                startTransition = $el.css("transition");
                $el.css("transition", "none");

                if (opt.onDragStart) {
                    if (opt.onDragStart(e, $el, opt) === false)
                        return;
                }

                $(document).on('mousemove.' + opt.instanceId, doDrag);
                $(document).on('mouseup.' + opt.instanceId, stopDragging);
                if (window.Touch || navigator.maxTouchPoints) {
                    $(document).on('touchmove.' + opt.instanceId, doDrag);
                    $(document).on('touchend.' + opt.instanceId, stopDragging);
                }
                $(document).on('selectstart.' + opt.instanceId, noop); // disable selection
                $("iframe").css("pointer-events", "none");
            }

            function doDrag(e) {

                var pos = getMousePos(e), newWidth, newHeight;

                if (opt.resizeWidthFrom === 'left')
                    newWidth = startPos.width - pos.x + startPos.x;
                else
                    newWidth = startPos.width + pos.x - startPos.x;

                if (opt.resizeHeightFrom === 'top')
                    newHeight = startPos.height - pos.y + startPos.y;
                else
                    newHeight = startPos.height + pos.y - startPos.y;

                if (!opt.onDrag || opt.onDrag(e, $el, newWidth, newHeight, opt) !== false) {
                    if (opt.resizeHeight)
                        $el.height(newHeight);

                    if (opt.resizeWidth)
                        $el.width(newWidth);
                }
            }

            function stopDragging(e) {
                e.stopPropagation();
                e.preventDefault();

                $(document).off('mousemove.' + opt.instanceId);
                $(document).off('mouseup.' + opt.instanceId);

                if (window.Touch || navigator.maxTouchPoints) {
                    $(document).off('touchmove.' + opt.instanceId);
                    $(document).off('touchend.' + opt.instanceId);
                }
                $(document).off('selectstart.' + opt.instanceId, noop);

                // reset changed values
                $el.css("transition", startTransition);
                $("iframe").css("pointer-events", "auto");

                if (opt.onDragEnd)
                    opt.onDragEnd(e, $el, opt);

                return false;
            }

            function getMousePos(e) {
                var pos = { x: 0, y: 0, width: 0, height: 0 };
                if (typeof e.clientX === "number") {
                    pos.x = e.clientX;
                    pos.y = e.clientY;
                } else if (e.originalEvent.touches) {
                    pos.x = e.originalEvent.touches[0].clientX;
                    pos.y = e.originalEvent.touches[0].clientY;
                } else
                    return null;

                return pos;
            }

            function getHandle(selector, $el) {
                if (selector && selector.trim()[0] === ">") {
                    selector = selector.trim().replace(/^>\s*/, "");
                    return $el.find(selector);
                }

                // Search for the selector, but only in the parent element to limit the scope
                // This works for multiple objects on a page (using .class syntax most likely)
                // as long as each has a separate parent container. 
                return selector ? $el.parent().find(selector) : $el;
            }
        });
    };

    if (!$.fn.resizable)
        $.fn.resizable = $.fn.resizableSafe;
}));


"use strict";
! function(e, t) {
    "function" == typeof define && define.amd ? define(t) : "object" == typeof exports ? module.exports = t() : e.ResizeSensor = t()
}("undefined" != typeof window ? window : this, function() {
    if ("undefined" == typeof window) return null;
    var t = "undefined" != typeof window && window.Math == Math ? window : "undefined" != typeof self && self.Math == Math ? self : Function("return this")(),
        b = t.requestAnimationFrame || t.mozRequestAnimationFrame || t.webkitRequestAnimationFrame || function(e) {
            return t.setTimeout(e, 20)
        },
        o = t.cancelAnimationFrame || t.mozCancelAnimationFrame || t.webkitCancelAnimationFrame || function(e) {
            t.clearTimeout(e)
        };

    function r(e, t) {
        var n = Object.prototype.toString.call(e),
            i = "[object Array]" === n || "[object NodeList]" === n || "[object HTMLCollection]" === n || "[object Object]" === n || "undefined" != typeof jQuery && e instanceof jQuery || "undefined" != typeof Elements && e instanceof Elements,
            o = 0,
            r = e.length;
        if (i)
            for (; o < r; o++) t(e[o]);
        else t(e)
    }

    function A(e) {
        if (!e.getBoundingClientRect) return {
            width: e.offsetWidth,
            height: e.offsetHeight
        };
        var t = e.getBoundingClientRect();
        return {
            width: Math.round(t.width),
            height: Math.round(t.height)
        }
    }

    function x(t, n) {
        Object.keys(n).forEach(function(e) {
            t.style[e] = n[e]
        })
    }
    var s = function(t, n) {
        var y = 0;

        function S() {
            var n, i, o = [];
            this.add = function(e) {
                o.push(e)
            }, this.call = function(e) {
                for (n = 0, i = o.length; n < i; n++) o[n].call(this, e)
            }, this.remove = function(e) {
                var t = [];
                for (n = 0, i = o.length; n < i; n++) o[n] !== e && t.push(o[n]);
                o = t
            }, this.length = function() {
                return o.length
            }
        }

        function i(n, e) {
            if (n)
                if (n.resizedAttached) n.resizedAttached.add(e);
                else {
                    n.resizedAttached = new S, n.resizedAttached.add(e), n.resizeSensor = document.createElement("div"), n.resizeSensor.dir = "ltr", n.resizeSensor.className = "resize-sensor";
                    var t = {
                            pointerEvents: "none",
                            position: "absolute",
                            left: "0px",
                            top: "0px",
                            right: "0px",
                            bottom: "0px",
                            overflow: "hidden",
                            zIndex: "-1",
                            visibility: "hidden",
                            maxWidth: "100%"
                        },
                        i = {
                            position: "absolute",
                            left: "0px",
                            top: "0px",
                            transition: "all 1s ease-in-out"
                        };
                    x(n.resizeSensor, t);
                    var o = document.createElement("div");
                    o.className = "resize-sensor-expand", x(o, t);
                    var r = document.createElement("div");
                    x(r, i), o.appendChild(r);
                    var s = document.createElement("div");
                    s.className = "resize-sensor-shrink", x(s, t);
                    var d = document.createElement("div");
                    x(d, i), x(d, {
                        width: "200%",
                        height: "200%"
                    }), s.appendChild(d), n.resizeSensor.appendChild(o), n.resizeSensor.appendChild(s), n.appendChild(n.resizeSensor);
                    var a = window.getComputedStyle(n),
                        c = a ? a.getPropertyValue("position") : null;
                    "absolute" !== c && "relative" !== c && "fixed" !== c && "sticky" !== c && (n.style.position = "relative");
                    var f = !1,
                        h = 0,
                        l = A(n),
                        u = 0,
                        p = 0,
                        m = !0;
                    y = 0;
                    var v = function() {
                        if (m) {
                            if (0 === n.offsetWidth && 0 === n.offsetHeight) return void(y = y || b(function() {
                                y = 0, v()
                            }));
                            m = !1
                        }
                        var e, t;
                        e = n.offsetWidth, t = n.offsetHeight, r.style.width = e + 10 + "px", r.style.height = t + 10 + "px", o.scrollLeft = e + 10, o.scrollTop = t + 10, s.scrollLeft = e + 10, s.scrollTop = t + 10
                    };
                    n.resizeSensor.resetSensor = v;
                    var z = function() {
                            h = 0, f && (u = l.width, p = l.height, n.resizedAttached && n.resizedAttached.call(l))
                        },
                        w = function() {
                            l = A(n), (f = l.width !== u || l.height !== p) && !h && (h = b(z)), v()
                        },
                        g = function(e, t, n) {
                            e.attachEvent ? e.attachEvent("on" + t, n) : e.addEventListener(t, n)
                        };
                    g(o, "scroll", w), g(s, "scroll", w), y = b(function() {
                        y = 0, v()
                    })
                }
        }
        r(t, function(e) {
            i(e, n)
        }), this.detach = function(e) {
            y || (o(y), y = 0), s.detach(t, e)
        }, this.reset = function() {
            t.resizeSensor.resetSensor()
        }
    };
    if (s.reset = function(e) {
            r(e, function(e) {
                e.resizeSensor.resetSensor()
            })
        }, s.detach = function(e, t) {
            r(e, function(e) {
                e && (e.resizedAttached && "function" == typeof t && (e.resizedAttached.remove(t), e.resizedAttached.length()) || e.resizeSensor && (e.contains(e.resizeSensor) && e.removeChild(e.resizeSensor), delete e.resizeSensor, delete e.resizedAttached))
            })
        }, "undefined" != typeof MutationObserver) {
        var n = new MutationObserver(function(e) {
            for (var t in e)
                if (e.hasOwnProperty(t))
                    for (var n = e[t].addedNodes, i = 0; i < n.length; i++) n[i].resizeSensor && s.reset(n[i])
        });
        document.addEventListener("DOMContentLoaded", function(e) {
            n.observe(document.body, {
                childList: !0,
                subtree: !0
            })
        })
    }
    return s
});

