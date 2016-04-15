(function(win, doc, undefined) {
    var _parent = window.parent || window
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


})(window, document);