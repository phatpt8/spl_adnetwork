(function(win, doc, undefined) {
    var JSONP = (function () {
        var counter = 0, head, query, key, window = this, config = {};

        function load(url) {
            var script = document.createElement('script'),
                done = false;
            script.src = url;
            script.async = true;

            script.onload = script.onreadystatechange = function () {
                if (!done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) {
                    done = true;
                    script.onload = script.onreadystatechange = null;
                    if (script && script.parentNode) {
                        script.parentNode.removeChild(script);
                    }
                }
            };
            if (!head) {
                head = document.getElementsByTagName('head')[0];
            }
            head.appendChild(script);
        }

        function encode(str) {
            return encodeURIComponent(str);
        }

        function jsonp(url, params, callback, callbackName) {
            query = (url || '').indexOf('?') === -1 ? '?' : '&';
            params = params || {};
            for (key in params) {
                if (params.hasOwnProperty(key)) {
                    query += encode(key) + "=" + encode(params[key]) + "&";
                }
            }
            var jsonp = "json" + (++counter);
            window[ jsonp ] = function (data) {
                callback(data);
                try {
                    delete window[ jsonp ];
                } catch (e) {
                    window[ jsonp ] = null;
                }
            };

            load(url + query + (callbackName || config['callbackName'] || 'callback') + '=' + jsonp);
            return jsonp;
        }

        function setDefaults(obj) {
            config = obj;
        }

        return {
            get: jsonp,
            script: load,
            init: setDefaults
        };
    }());

    var EventEmitter = {
        handlers: {},
        on: function(event, handler) {
            if (!(event in this.handlers)){
                this.handlers[event] = [];
            }
            this.handlers[event].push(handler);
            return this;
        },
        emit: function(event) {
            var handlerArgs = Array.prototype.slice.call(arguments, 1);
            for (var i = 0; i < this.handlers[event].length; i++) {
                this.handlers[event][i].apply(this, handlerArgs);
            }
            return this;
        }
    };

    function sendLog(url, callback) {
        var image = new Image(1, 1);
        image.onload = callback;
        image.src = url;
    }

    var parseObj = function (obj, callback) {
        for (var row in obj) Object.prototype.hasOwnProperty.call(obj, row) && callback.call(null, obj[row], row, obj)
    };

    var addEvent = function (element, event, handler, d) { /* add event listener */
        return (element.addEventListener ? (element.addEventListener(event, handler, d || false), true) : element.attachEvent ?
            (element.attachEvent("on" + event, handler), true) : false);
    };
    var removeEvent = function (element, event, handler, d) { /* remove event listener */
        return (element.removeEventListener ? (element.removeEventListener(event, handler, d || false), true) : element.detachEvent ?
            (element.detachEvent("on" + event, handler), true) : false);
    };

    var _parent = window.parent || window;
    var noop = function () {};
    var Db = function (obj) {
        Db[" "](obj);
        return obj
    };

    Db[" "] = noop;
    var Eb = function (a, b) {
        try {
            return Db(a[b]), true
        } catch (c) {}
        return false
    };

    var Fb = function (a) {
        try {
            return !!a && null != a.location.href && Eb(a, "foo")
        } catch (b) {
            return false
        }
    };

    var getTopWin = function () {
        if (!Fb(_parent)) {
            for (var a = "." + doc.domain; 2 < a.split(".").length && !Fb(parWin);) doc.domain = a = a.substr(a.indexOf(".") + 1), _parent = window.parent;
            Fb(_parent) || (_parent = win)
        }
        return _parent
    };
    var _topWin = getTopWin(), _topDoc = _topWin.document, userAgent = navigator.userAgent.toLowerCase();

    var psplAdrequest = "http://localhost/spl_adnetwork/admin/adrequest";

    var tb = {
            "\x00": "\\0",
            "\b": "\\b",
            "\f": "\\f",
            "\n": "\\n",
            "\r": "\\r",
            "\t": "\\t",
            "\x0B": "\\x0B",
            '"': '\\"',
            "\\": "\\\\"
        },
        ub = {
            "'": "\\'"
        },
        resolveContent = function (a) {
            a = String(a);
            if (a.quote) return a.quote();
            for (var b = ['"'], c = 0; c < a.length; c++) {
                var d = a.charAt(c),
                    e = d.charCodeAt(0);
                b[c + 1] = tb[d] || (31 < e && 127 > e ? d : vb(d))
            }
            b.push('"');
            return b.join("")
        },
        vb = function (a) {
            if (a in ub) return ub[a];
            if (a in tb) return ub[a] = tb[a];
            var b = a,
                c = a.charCodeAt(0);
            if (31 < c && 127 > c) b = a;
            else {
                if (256 > c) {
                    if (b = "\\x", 16 > c || 256 < c) b += "0"
                } else b = "\\u", 4096 > c && (b += "0");
                b += c.toString(16).toUpperCase()
            }
            return ub[a] = b
        };
    var buildAdNode = function(content, style) {
        var div = doc.createElement("div");
        div.setAttribute("class", "pspl_ad_holder width_" + win.pspl_ad_width + " height_" + win.pspl_ad_height);
        if (style) div.setAttribute("style", style);
        div.innerHTML = content;

        var s = div.getElementsByTagName('script');
        for (var i = 0; i < s.length ; i++) {
            var node=s[i], parent=node.parentElement, d = doc.createElement('script');
            if (node.getAttribute("async") == "" || node.getAttribute("async") == "true") {
                d.async = true;
            }
            //d.async=node.async;
            if (node.src) d.src=node.src;
            if (node.text) d.text=node.text;
            parent.insertBefore(d,node);
            parent.removeChild(node);
        }
        return div; // or div.firstChild
    };

    var psplObjectKeyword = {
        pspl_zone: "id",
        pspl_frameId: 'frameId',
        pspl_unique_id: 'unique_id',
        pspl_url: 'url',
        pspl_hostname: 'hostname',
        pspl_rd: 'random',
        pspl_ad_wdith: 'ad_width',
        pspl_ad_height: 'ad_height'
    };

    var getBannerInfo = function(str){
        try {
            return JSON.parse(str);
        } catch (e) {
            return {};
        }
    };

    var buildClickUrl = function(p) {
        var banner = p.banners[0];
        var info = getBannerInfo(banner.BannerInfo);
        var clkLink = psplAdrequest + "/clickad?";

        var clk = [];
        clk.push(p.zoneId ? "zid=" + p.zoneId : "");
        clk.push(banner.BannerId ? "bid=" + banner.BannerId : "");
        clk.push(banner.BannerPrice ? "price=" + banner.BannerPrice : "");
        clk.push(info.url ? "redirect=" + encodeURIComponent(info.url) : "");
        clk.push("url=" + encodeURIComponent(_topWin.document.location.href));

        return clkLink + clk.join("&");
    };

    var _stringImageAd = function(p, frame) {
        var banner = p.banners[0];
        var info = getBannerInfo(banner.BannerInfo);
        info.url = buildClickUrl(p);

        return ["<div class='pspl' data-banner-id='" + banner.BannerId + "'",
            "><a class='pspl_anchor' title='" + (info.title ? info.title : "") + "' href='",
            (info.url ? info.url : ""),"' target='_blank'>",
            "<img style='width:" + p.width +"px;height:" + p.height + "px;' src='" + (info.file ? (info.file.indexOf("http") > -1 ? info.file : "http:" + info.file ): "") + "'>","</a>","</div>"].join("");
    };

    var Html5VideoAd = {
        setInpage: function (child) {
            this.inpage = document.getElementById(this.inpageId) || document.getElementsByTagName("body")[0];
            this.inpage.innerHTML = child;
            this.container = document.getElementById(this.containerId) || document.getElementsByTagName("video")[0].parentNode;
            this.player = document.getElementById(this.playerId) || document.getElementsByTagName("video")[0];
            this.img = document.getElementById(this.imgId) || document.getElementsByTagName("img")[0];
        },
        init: function(inpageId, playerId, data) {
            var banner = data.banners[0];
            var info = getBannerInfo(banner.BannerInfo);
            info.url = buildClickUrl(data);

            this.inpageId = inpageId;
            this.playerId = playerId;
            this.containerId = playerId + "_container";
            this.imgId = "endImage";

            var playerHtml = [];
            playerHtml.push('<div id="'+ this.containerId +'" style="width: 100%; height:100%;" class="e-inpage-video-container">');
            playerHtml.push('<a target="_blank" href="' + (info.url ? (info.url.indexOf("http") > -1 ? info.url : "http:" + info.url ): "") +'"><video autoplay style = "margin: auto 0px; background-color: transparent; cursor: pointer; width: 100%; height: 100%; border: 0px solid rgb(204, 204, 204); z-index: 9;" id="'+ playerId +'" webkit-playsinline="" muted="" preload="auto"><source type="video/mp4" src = "'+ (info.mediaFile ? (info.mediaFile.indexOf("http") > -1 ? info.mediaFile : "http:" + info.mediaFile ): "") +'" ></source></video></a></div>');
            playerHtml.push('<div id="buttons" class="controls"><div class="off" id="soundButton"></div><div class="closeButton" id="'+ playerId +'_closeButton"></div></div><div id="time" class="controls"><div id="counter">0 seconds</div></div>');
            playerHtml.push('<div id="endImage"><a target="_blank" href="' + (info.url ? (info.url.indexOf("http") > -1 ? info.url : "http:" + info.url ): "") +'"> <img style="width: ' + data.width + 'px; height:' + data.height +'px;" src="' + (info.file ? (info.file.indexOf("http") > -1 ? info.file : "http:" + info.file ): "") + '"></a><div id="replayButton"></div></div>');

            this.setInpage(playerHtml.join(""));
            this.runEvents();
        },
        runEvents: function() {
            var _self = this;
            var clearMouseHandler = false;
            var visibilityState = function() {
                var b;
                document.mozVisibilityState ? b = "mozvisibilitychange" : document.webkitVisibilityState ? b = "webkitvisibilitychange" : document.visibilityState && (b = "visibilitychange");
                return b
            };

            function _checkFocus(e) {
                var vis = document.webkitVisibilityState || document.mozVisibilityState || document.visibilityState || "",
                    b = {
                        visible: 1,
                        hidden: 2,
                        prerender: 3,
                        preview: 4
                    },
                    state = b[vis] || 0;
                if (state == 1) { // visible
                    _self.play();
                } else if (e && e.type && e.type == "blur" || state == 2) {
                    _self.pause();
                }
            }

            function toggleSound(on) {
                if (on) {
                    _self.unmute();
                    soundButton.className = "on";
                } else {
                    _self.mute();
                    soundButton.className = "off";
                }
            }

            function soundHandler(e) {
                if (!clearMouseHandler) {
                    removeEvent(_self.inpage, "mouseover", msOverHandler);
                    removeEvent(_self.inpage, "mouseout", msOutHandler);
                    clearMouseHandler = true;
                }
                toggleSound(_self.player.muted);
            }

            function msOverHandler(){
                toggleSound(true);
            }

            function msOutHandler(){
                toggleSound(false);
            }

            function timeUpdHandler() {
                var counter = document.getElementById("counter");
                if(_self.player && counter){
                    var c = Math.round(Math.floor(_self.player.duration) - Math.floor(_self.player.currentTime));
                    1 < c ?  counter.innerHTML = c + " " + "seconds" : counter.innerHTML = c + " " + "second";
                }
            }

            function closeHandler() {
                _self.player.style.height = "0px";
                _self.removePlayer(function() {
                    _self.img && (_self.img.style.display = "block");
                });
            }

            _checkFocus();
            var soundButton = document.getElementById("soundButton"),
                closeButton = document.getElementById(_self.playerId + "_closeButton");
            addEvent(soundButton, "click", soundHandler);
            addEvent(closeButton, "click", closeHandler);
            addEvent(_self.inpage, "mouseover", msOverHandler);
            addEvent(_self.inpage, "mouseout", msOutHandler);
            addEvent(_self.player, "timeupdate", timeUpdHandler);
            addEvent(window, "focus", _checkFocus);
            addEvent(window, "blur", _checkFocus);
            addEvent(document, visibilityState(), _checkFocus);
            addEvent(_self.player, "ended", function() {
                closeHandler();
            })
        },
        pause: function() {
            this.player && this.player.pause && this.player.pause();
        },
        play: function() {
            !this.terminated && this.player && this.player.play && this.player.play();
        },
        mute: function() {
            this.player && (this.player.muted = true);
        },
        unmute: function() {
            !this.terminated && this.player && (this.player.muted = false);
        },
        removePlayer: function(callback) {
            this.terminated = true;
            this.pause(true);

            function removeElm(elm) {
                elm && elm.parentNode ? elm.parentNode.removeChild(elm) : null
            }
            var _self = this;
            setTimeout(function () {
                removeElm(_self.container);
                removeElm(document.getElementById("buttons"));
                removeElm(document.getElementById("time"));
                callback && callback()
            }, 500)
        }
    };

    var _stringVideoAd = function(p) {
        var banner = p.banners[0];

        var videoAd = function() {
            var frame = _topDoc.getElementById(win.pspl_frameId);
            var data = p;
            var playerId = "inpage_" + Math.round(Math.random() * 10000);

            var scrollInpageVideo = function (elm) {
                var html = _topWin.document.documentElement,
                    rect;

                var padding = 50;

                try {
                    rect = elm.getBoundingClientRect();
                } catch (e) {}

                var seen = (rect != null) && rect.bottom >= padding && rect.right >= padding && rect.top <= html.clientHeight - padding && rect.left <= html.clientWidth - padding;

                if (seen) {
                    Html5VideoAd.play();
                } else {
                    Html5VideoAd.pause();
                }
            };

            addEvent(_topWin, "scroll", function () {
                scrollInpageVideo(frame)
            });

            Html5VideoAd.init(
                "inPage",
                playerId,
                data
            )
        };
        addEvent(win, "load", videoAd);

        return ['<div data-banner-id="' + banner.BannerId + '" id="playerWrapper"><div' + ' id="inPage" class="e-inpage"></div></div>'].join("");
    };

    var _toStrPsplAd = function(data, frame) {
        var formatId = data.format;
        var strLogo = '<style>.logo_pspl_ads{position:absolute;z-index:99999;left:1px;bottom:1px;width:66px;height:15px;padding:0 18px 0 5px;cursor:pointer;overflow:hidden;display: none;background:url(' + (doc.location.protocol == "https:" ? "https:" : "http:") + '//localhost/spl_adnetwork/static/images/icon_eclick.png) 77px 3px no-repeat #EEF3F5}.logo_pspl_ads a{width:100%;font:400 10px/16px arial;display:block;float:left;text-decoration:none;}.logo_pspl_ads:hover a{color:#464646}.txt_by_pspl{color:#009444}</style>'
            + '<div id="logo"><div id="small_e" class="e_pspl_ads" style="position:absolute;z-index: 99999;left:1px;bottom:1px;width:15px;height:15px;cursor: pointer;overflow: hidden;display:block;background: url(' + (doc.location.protocol == "https:" ? "https:" : "http:") + '//localhost/spl_adnetwork/static/images/icon_eclick.png) 3px 3px no-repeat #EEF3F5"></div> <div id="large_e" class="logo_pspl_ads"> <a target="_blank" href="http://localhost/spl_adnetwork/index">Ads by <span class="txt_by_pspl">P_spl</span></a> </div></div>';
        EventEmitter.on('logoAnimation', function() {
            var a = document.getElementById("logo");
            var m = function(a, b) { document.getElementById(a).style.display = "none"; document.getElementById(b).style.display = "block"};
            a.onmouseover = function(){ m("small_e","large_e")};
            a.onmouseout = function(){ m("large_e","small_e")};
        });

        var strPspl = "";

        if (formatId == "101") {
            strPspl = _stringImageAd(data, frame);
        } else if (formatId == "202") {
            strPspl = _stringVideoAd(data, frame);
        }

        return strLogo + strPspl;
    };

    EventEmitter.on('TraceImpression', function(data, callback) {
        if (!data.banners && !data.banners[0]) return;
        callback = callback || undefined;
        var banner = data.banners[0];
        var url = psplAdrequest + '/impression?';

        var imp = [];
        imp.push("id=" + (data.zoneId ? data.zoneId : win.pspl_zone));
        imp.push("bid=" + (banner.BannerId ? banner.BannerId : 888));
        imp.push("url=" + encodeURIComponent(_topWin.document.location.href));

        sendLog(url + imp.join("&"), callback)
    });

    var trueviewLogged = false;
    var detectZoneViewed = function(elm, data, callback) {
        if (!data.banners && !data.banners[0]) return;
        var html = _topWin.document.documentElement,
            rect,
            banner = data.banners[0],
            url = psplAdrequest + '/trueview?',
            imp = [];

        var padding = parseInt(win.pspl_ad_height, 10) / 2;

        try {
            rect = elm.getBoundingClientRect();
        } catch (e) {}

        var seen = (rect != null) && rect.bottom >= padding && rect.right >= padding && rect.top <= html.clientHeight - padding && rect.left <= html.clientWidth - padding;

        if (seen && !trueviewLogged) {
            trueviewLogged = true;
            callback = callback || undefined;
            imp.push("id=" + (data.zoneId ? data.zoneId : win.pspl_zone));
            imp.push("bid=" + (banner.BannerId ? banner.BannerId : 888));
            imp.push("url=" + encodeURIComponent(_topWin.document.location.href));

            sendLog(url + imp.join("&"), callback)
        }
    };

    var polyfillWriteAd = function(frame, adData, pspl) {
        var frameWin = frame.contentWindow;
        var frameDoc = frameWin.document;
        var strJsVal = "";

        parseObj(pspl, function(val, key){
            strJsVal += "pspl_" + key + "=\"" + val + "\";"
        });

        var strContent = _toStrPsplAd(adData, frame);
        var content = "<!DOCTYPE html><html><head>" + "<link rel='stylesheet' type='text/css' href='" + win.pspl_cssUrl + "'>" + "</head><body><script>" + strJsVal + "</script>" + strContent + "</body></html>"; // unfriendly iframe

        if (Fb(frameWin)) {
            if (frameDoc.body && frameDoc.body.firstChild) {
                var body = frameDoc.getElementsByTagName('body')[0];
                body.appendChild(buildAdNode(strContent));
            }
        } else {
            frameWin.location.replace("javascript:" + resolveContent(content));
        }

        EventEmitter.emit("TraceImpression", adData);
        addEvent(window, "load", function() {
            EventEmitter.emit('logoAnimation');
        });

        detectZoneViewed(frame, adData);
        addEvent(_topWin, "scroll", function(){
            detectZoneViewed(frame, adData);
        })

    };

    function closeFrameDocument(w) {
        w != w.parent && w.setTimeout(function () {
            w.document.close();
        }, 0)
    }

    var writePsplAd = function(element, data, pspl) {
        polyfillWriteAd(element, data, pspl);
    };

    function renderPspl(data) {
        var elemId = win.pspl_frameId,
            elem;
        elemId && (elem = _topWin.document.getElementById(elemId));

        var pspl = {};
        parseObj(psplObjectKeyword, function(val, key) {
            pspl[val] = win[key];
        });
        writePsplAd(elem, data, pspl);
    }

    function init() {
        var url = psplAdrequest + '/request?id=' + win.pspl_zone;
        JSONP.get(url, {}, function (resp) {
            if (resp.INVALID) {
                return false;
            }

            renderPspl(resp);
            closeFrameDocument(win);
        })
    }
    init();

})(window, document);