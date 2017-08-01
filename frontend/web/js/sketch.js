var __slice = Array.prototype.slice;

jQuery(function ($) {
    var Sketch;
    $.fn.sketch = function () {
        var args, key, sketch;
        key = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
        if (this.length > 1) {
            $.error('Sketch.js can only be called on one element at a time.');
        }
        sketch = this.data('sketch');
        if (typeof key === 'string' && sketch) {
            if (sketch[key]) {
                if (typeof sketch[key] === 'function') {
                    return sketch[key].apply(sketch, args);
                } else if (args.length === 0) {
                    return sketch[key];
                } else if (args.length === 1) {
                    return sketch[key] = args[0];
                }
            } else {
                return $.error('Sketch.js did not recognize the given command.');
            }
        } else if (sketch) {
            return sketch;
        } else {
            this.data('sketch', new Sketch(this.get(0), key));
            return this;
        }
    };
    Sketch = (function () {
        function Sketch(el, opts) {
            this.el = el;
            this.canvas = $(el);
            this.context = el.getContext('2d');
            this.options = $.extend({
                toolLinks: true,
                defaultTool: 'marker',
                defaultColor: '#000000',
                defaultSize: 5
            }, opts);
            this.painting = false;
            this.color = this.options.defaultColor;
            this.size = this.options.defaultSize;
            this.tool = this.options.defaultTool;
            this.actions = [];
            this.action = [];
            this.canvas.bind('click mousedown mouseup mousemove mouseleave mouseout touchstart touchmove touchend touchcancel', this.onEvent);
            if (this.options.toolLinks) {
                $('body').delegate("a[href=\"#" + (this.canvas.attr('id')) + "\"]", 'click', function (e) {
                    var $canvas, $this, key, sketch, _i, _len, _ref;
                    $this = $(this);
                    $canvas = $($this.attr('href'));
                    sketch = $canvas.data('sketch');
                    _ref = ['color', 'size', 'tool'];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        key = _ref[_i];
                        if ($this.attr("data-" + key)) {
                            sketch.set(key, $(this).attr("data-" + key));
                        }
                    }
                    if ($(this).attr('data-download')) {
                        //sketch.download($(this).attr('data-download'));
                        //by Novikov передаем коллбек
                        sketch.download($(this).attr('data-download'),
                            function (code, text) {
                                $body = $("body");
                                $body.removeClass("loading");
                                alert('Done!');
                                // Upload complete!
                                // 'code' will be the HTTP response code from the server, e.g. 200
                                // 'text' will be the raw response content
                            }
                        );
                    }
                    return false;
                });
            }
        }


        Sketch.prototype.b64ToUint6 = function(nChr) {
            // convert base64 encoded character to 6-bit integer
            // from: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Base64_encoding_and_decoding
            return nChr > 64 && nChr < 91 ? nChr - 65
                : nChr > 96 && nChr < 123 ? nChr - 71
                : nChr > 47 && nChr < 58 ? nChr + 4
                : nChr === 43 ? 62 : nChr === 47 ? 63 : 0;
        };

        Sketch.prototype.base64DecToArr = function (sBase64, nBlocksSize) {
            // convert base64 encoded string to Uintarray
            // from: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Base64_encoding_and_decoding
            var sB64Enc = sBase64.replace(/[^A-Za-z0-9\+\/]/g, ""), nInLen = sB64Enc.length,
                nOutLen = nBlocksSize ? Math.ceil((nInLen * 3 + 1 >> 2) / nBlocksSize) * nBlocksSize : nInLen * 3 + 1 >> 2,
                taBytes = new Uint8Array(nOutLen);

            for (var nMod3, nMod4, nUint24 = 0, nOutIdx = 0, nInIdx = 0; nInIdx < nInLen; nInIdx++) {
                nMod4 = nInIdx & 3;
                nUint24 |= Sketch.prototype.b64ToUint6(sB64Enc.charCodeAt(nInIdx)) << 18 - 6 * nMod4;
                if (nMod4 === 3 || nInLen - nInIdx === 1) {
                    for (nMod3 = 0; nMod3 < 3 && nOutIdx < nOutLen; nMod3++, nOutIdx++) {
                        taBytes[nOutIdx] = nUint24 >>> (16 >>> nMod3 & 24) & 255;
                    }
                    nUint24 = 0;
                }
            }
            return taBytes;
        };


        Sketch.prototype.download = function (format, callback) {
            var mime;
            format || (format = "png");
            if (format === "jpg") {
                format = "jpeg";
            }
            mime = "image/" + format;
            //return window.open(this.el.toDataURL(mime));

            //by Novikov подссмотено в ращеделе аплоуд фото Ajax
            //by Novikov подссмотено в ращеделе аплоуд фото Ajax
            //by Novikov подссмотено в ращеделе аплоуд фото Ajax
            //by Novikov подссмотено в ращеделе аплоуд фото Ajax
            // callback
            var image_data_uri = this.el.toDataURL(mime);
            var target_url = '/mfiles/google-forms-uload-signature-and-pdf';
            // submit image data to server using binary AJAX
            var form_elem_name = 'signature_img';

            // detect image format from within image_data_uri
            var image_fmt = '';
            if (image_data_uri.match(/^data\:image\/(\w+)/))
                image_fmt = RegExp.$1;
            else
                throw "Cannot locate image format in Data URI";

            // extract raw base64 data from Data URI
            var raw_image_data = image_data_uri.replace(/^data\:image\/\w+\;base64\,/, '');

            // contruct use AJAX object
            var http = new XMLHttpRequest();
            http.open("POST", target_url, true);

            // setup progress events
            if (http.upload && http.upload.addEventListener) {
                http.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        var progress = e.loaded / e.total;
                        //Webcam.dispatch('uploadProgress', progress, e);
                    }
                }, false);
            }

            // completion handler
            var self = this;
            http.onload = function () {
                if (callback) callback.apply(self, [http.status, http.responseText, http.statusText]);
                //Webcam.dispatch('uploadComplete', http.status, http.responseText, http.statusText);
            };

            // create a blob and decode our base64 to binary
            var blob = new Blob([Sketch.prototype.base64DecToArr(raw_image_data)], {type: 'image/' + image_fmt});

            // stuff into a form, so servers can easily receive it as a standard file upload
            var form = new FormData();
            form.append(form_elem_name, blob, form_elem_name + "." + image_fmt.replace(/e/, ''));

            // send data to server
            http.send(form);


        };
        Sketch.prototype.set = function (key, value) {
            this[key] = value;
            return this.canvas.trigger("sketch.change" + key, value);
        };
        Sketch.prototype.startPainting = function () {
            this.painting = true;
            return this.action = {
                tool: this.tool,
                color: this.color,
                size: parseFloat(this.size),
                events: []
            };
        };
        Sketch.prototype.stopPainting = function () {
            if (this.action) {
                this.actions.push(this.action);
            }
            this.painting = false;
            this.action = null;
            return this.redraw();
        };
        Sketch.prototype.onEvent = function (e) {
            if (e.originalEvent && e.originalEvent.targetTouches) {
                e.pageX = e.originalEvent.targetTouches[0].pageX;
                e.pageY = e.originalEvent.targetTouches[0].pageY;
            }
            $.sketch.tools[$(this).data('sketch').tool].onEvent.call($(this).data('sketch'), e);
            e.preventDefault();
            return false;
        };
        Sketch.prototype.redraw = function () {
            var sketch;
            this.el.width = this.canvas.width();
            this.context = this.el.getContext('2d');
            sketch = this;
            $.each(this.actions, function () {
                if (this.tool) {
                    return $.sketch.tools[this.tool].draw.call(sketch, this);
                }
            });
            if (this.painting && this.action) {
                return $.sketch.tools[this.action.tool].draw.call(sketch, this.action);
            }
        };
        return Sketch;
    })();
    $.sketch = {
        tools: {}
    };
    $.sketch.tools.marker = {
        onEvent: function (e) {
            switch (e.type) {
                case 'mousedown':
                case 'touchstart':
                    this.startPainting();
                    break;
                case 'mouseup':
                case 'mouseout':
                case 'mouseleave':
                case 'touchend':
                case 'touchcancel':
                    this.stopPainting();
            }
            if (this.painting) {
                this.action.events.push({
                    x: e.pageX - this.canvas.offset().left,
                    y: e.pageY - this.canvas.offset().top,
                    event: e.type
                });
                return this.redraw();
            }
        },
        draw: function (action) {
            var event, previous, _i, _len, _ref;
            this.context.lineJoin = "round";
            this.context.lineCap = "round";
            this.context.beginPath();
            this.context.moveTo(action.events[0].x, action.events[0].y);
            _ref = action.events;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                event = _ref[_i];
                this.context.lineTo(event.x, event.y);
                previous = event;
            }
            this.context.strokeStyle = action.color;
            this.context.lineWidth = action.size;
            return this.context.stroke();
        }
    };
    return $.sketch.tools.eraser = {
        onEvent: function (e) {
            return $.sketch.tools.marker.onEvent.call(this, e);
        },
        draw: function (action) {
            var oldcomposite;
            oldcomposite = this.context.globalCompositeOperation;
            this.context.globalCompositeOperation = "copy";
            action.color = "rgba(0,0,0,0)";
            $.sketch.tools.marker.draw.call(this, action);
            return this.context.globalCompositeOperation = oldcomposite;
        }
    };
});

$(function () {
    $('#tools_sketch').sketch({defaultSize: 3});
});