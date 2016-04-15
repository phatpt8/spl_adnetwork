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




})(window, document);