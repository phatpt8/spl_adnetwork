(function (win, doc, undefined) {
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

    function sendLog(url, callback) {
        var image = new Image(1, 1);
        image.onload = callback;
        image.src = url;
    }

    function buildUrl(domain, path, protocol) { /* build url with protocol */
        protocol = protocol || (document.location.protocol == "https:" ? "https" : "http");
        return [protocol, "://", domain, path].join("");
    }

    var pspl = /(^| )adsbypspl($| )/,
        self = this,
        psplAdrequest = "http://localhost/spl_adnetwork/admin/adrequest",
        psplStatic = "http://localhost/spl_adnetwork/static/js/embed/";


    var triggerLogPageview = function() {

    };

    var triggerLogTrueImp = function() {

    };

    var Sa = function (a, b) {
        if (!(2 > arguments.length))
            for (var c = 1, d = arguments.length; c < d; ++c) a.push(arguments[c])
    };

    var buildStrFrame = function (ifrObj, width, height) {
        var frameArr = ["<iframe"], css, ifrAttr;
        for (ifrAttr in ifrObj) {
            if(ifrObj.hasOwnProperty(ifrAttr) &&  ifrAttr != "className") {
                Sa(frameArr, ifrAttr + "=" + ifrObj[ifrAttr]);
            } else {
                Sa(frameArr, "class" + "=" + ifrObj[ifrAttr]);
            }
        }
        frameArr.push('style="position:absolute;left:0;top:0;"');
        frameArr.push("></iframe>");
        css = "display:block;border:none;height:" + height + "px;margin:0 auto;padding:0;position:relative;visibility:visible;width:" + width + "px;background-color:transparent;";

        return ['<ins id="', ifrObj.id + "_ins", '" style="', css, '"><div id="',ifrObj.id,'_div" class="ad_wrapper_protection">', frameArr.join(" "), "</div></ins>"].join("")
    };

    var _toFrameGlobalVar = function (obj) {
        var arr = [];
        for (var o in obj) {
            var oo;
            if (typeof obj[o] == "number") {
                oo = obj[o];
            } else if (typeof obj[o] == "string") {
                oo = "\"" + obj[o] + "\"";
            } else {
                oo = "\"\""
            }
            arr.push(o + "=" + oo);
        }
        arr.push("");
        return arr.join(";");
    };

    var _toStrCss = function(){
        var url = psplStatic + 'css/pspl.css';
        var l = ["<link "];
        l.push('rel=','\"stylesheet\" ');
        l.push('type=','\"text/css\" ');
        l.push('href=','\"'+ url +'\" >');
        return l.join("");
    };

    var _toStrJs = function () {
        var scrt = xa("script");
        return ["<", scrt, ' src="', psplStatic, 'js/implementads.js', '"></', scrt, ">"].join("")
    };

    var writeStructElement = function (element, params) {
        var ifm = {},
            width = params.pspl_ad_width || 0,
            height = params.pspl_ad_height || 0;

        ifm.width = '"' + width + '"';
        ifm.height = '"' + height + '"';
        ifm.frameborder = '"0"';
        ifm.marginwidth = '"0"';
        ifm.marginheight = '"0"';
        ifm.vspace = '"0"';
        ifm.hspace = '"0"';
        ifm.allowtransparency = '"true"';
        ifm.scrolling = '"no"';
        ifm.allowfullscreen = '"true"';

        function writeStrFrame(objFrame, params) {
            for (var id = objFrame.id, h = 0; !id || win.document.getElementById(id);) {
                id = "pspl_ads_frame" + h++;
            }
            objFrame.id = params.pspl_frameId = id;
            objFrame.name = id;

            var width = Number(params.pspl_ad_width),
                height = Number(params.pspl_ad_height);

            element.innerHTML = buildStrFrame(objFrame, width, height);

            return ifm.id;
        }
        writeStrFrame(ifm, params);

        var psplInFrameCss = _toStrCss();
        var psplInFrameJs = _toStrJs();
        params.pspl_cssUrl = psplStatic + 'css/pspl.css';
        params.pspl_jsUrl = psplStatic + 'js/implementads.js';
        var psplInFrameConfig = _toFrameGlobalVar(params);
        var psplInFrameHtml = ["<!doctype html><html><head><meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=yes'>", psplInFrameCss ,"</head><body style='margin: 0; padding: 0;'>", "<", "script", ">", "eclick_unique_id=", win.pspl_unique_id, ";" + psplInFrameConfig, "</", "script", ">", psplInFrameJs, "</body></html>"].join("");

        writeContent(params.pspl_frameId, psplInFrameHtml, true)();
        return true;
    };

    var Ma = {
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
        Na = {
            "'": "\\'"
        };
    var xa = function (a) {
        xa[" "](a);
        return a
    };
    xa[" "] = function () {
    };

    var Eb = function (a, b) {
        try {
            return xa(a[b]), true
        } catch (c) {
        }
        return false
    };
    var ya = function (a) {
        try {
            var b;
            if (b = !!a && null != a.location.href) a: {
                try {
                    xa(a.foo);
                    b = true;
                    break a
                } catch (c) {
                }
                b = false
            }
            return b
        } catch (d) {
            return false
        }
    };

    var writeContent = function (id, str, bool) {
        return function () {
            try {
                var ifrCnt = win.document.getElementById(id).contentWindow;
                if (ya(ifrCnt)) {
                    var h = win.document.getElementById(id).contentWindow,
                        k = h.document;
                    k.body && k.body.firstChild || (k.open(), k.write(str));
                } else {
                    var l = win.document.getElementById(id).contentWindow,
                        m;

                    str = String(str);
                    if (str.quote) {
                        m = str.quote();
                    } else {
                        ifrCnt = ['"'];
                        for (h = 0; h < str.length; h++) {
                            var n = str.charAt(h),
                                u = n.charCodeAt(0),
                                k = h + 1,
                                x;
                            if (!(x = Ma[n])) {
                                var y;
                                if (31 < u && 127 > u) y = n;
                                else {
                                    var r = n;
                                    if (r in Na) y =
                                        Na[r];
                                    else if (r in Ma) y = Na[r] = Ma[r];
                                    else {
                                        var A = r,
                                            q = r.charCodeAt(0);
                                        if (31 < q && 127 > q) A = r;
                                        else {
                                            if (256 > q) {
                                                if (A = "\\x", 16 > q || 256 < q) A += "0"
                                            } else A = "\\u", 4096 > q && (A += "0");
                                            A += q.toString(16).toUpperCase()
                                        }
                                        y = Na[r] = A
                                    }
                                }
                                x = y
                            }
                            ifrCnt[k] = x
                        }
                        ifrCnt.push('"');
                        m = ifrCnt.join("");
                    }
                    l.location.replace("javascript:" + m)
                }
            } catch (ex) {
            }

        }
    };

    var renderAd = function(elem, params){
        for (var attrList = elem.attributes, attrLength = attrList.length, e = 0; e < attrLength; e++) {
            var attr = attrList[e], attrVal;
            if (/data-/.test(attr.name)) {
                var ecAttr = attr.name.replace("data", "pspl").replace(/-/g, "_");
                params.hasOwnProperty(ecAttr) || (attrVal = attr.value, null === attrVal || (params[ecAttr] = attrVal))
            }
        }


        return writeStructElement(elem, params);
    };

    var setUniqueId = function (a) {
        a.pspl_unique_id ? ++a.pspl_unique_id : a.pspl_unique_id = 1
    };
    
    var initSplAd = function(elem, params) {
        elem.setAttribute("data-adsbypspl", "done");

        /*
         *  render QC - return render success or not, then log
         * */

        triggerLogPageview();
        setUniqueId(win);
        if(renderAd(elem, params)) {
            /*
             *  SEND LOG START
             * */
            triggerLogTrueImp()
        }
    };

    var seekPsplIns = function (a) { /* check ins adsbypspl */
            for (var ecIns = document.getElementsByTagName("ins"), c = 0, ins = ecIns[c]; c < ecIns.length; ins = ecIns[++c])
                if (checkSplIns(ins) && (!a || ins.id == a)) {
                    return ins
                }
            return null
        },
        checkSplIns = function (a) { /* check ins tag has attribute adsbypspl */
            return pspl.test(a.className) && "done" != a.getAttribute("data-adsbypspl");
        },
        pushSplAd = function (params) { /* check ads done or not */
            var elem = params.element;

            if (elem) {
                if (!checkSplIns(elem) && (elem = elem.id && seekPsplIns(elem.id), !elem)) throw Error("adsbypspl: 'element' has already been filled.");
                if (!("innerHTML" in elem)) throw Error("adsbypspl.push(): 'element' is not a good DOM element.");
            } else if (elem = seekPsplIns(), !elem) throw Error("adsbypspl.push(): All ins elements in the DOM with class=adsbypspl already have ads in them.");

            initSplAd(elem, params, win);
        };

    var init = function () {
        var pspl, params;
        if ((pspl = win.adsbypspl) && pspl.shift) {
            for (var i = 20; (params = pspl.shift()) && 0 < i--;) {
                try {
                    pushSplAd(params);
                } catch (error) {
                    throw win.setTimeout(init, 0), error;
                }
            }
        }

        pspl && pspl.loaded || (win.adsbypspl = {
            push: pushSplAd,
            loaded: true
        });
    };
    init();


})(window, document);