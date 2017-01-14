
jQuery(document).ready(function( $ ) {     
    
    function addNew(index) {
        
         var data = '';
         
         data += '<div class="form_fields" id="form_fields_' + (index + 2) + '">';
         data += '<div class="input" style="display: none"><label for="label_' + (index + 2) + '">Label</label> <input type="text" name="label_' + (index + 2) + '"/></div>';    
         data += '<div class="input"><label for="input_type_' + (index + 2) + '">Input type</label> <select name="input_type_' + (index + 2) + '"><option value="text" selected="selected">Text</option> <option value="textarea">Textarea</option><option value="checkbox">Checkbox</option></select></div>';
         data += '<div class="input"><label for="is_required_' + (index + 2) + '">Required</label> <input type="checkbox" name="is_required_' + (index + 2) + '" /></div>';
         data += '<div class="input"><label for="placeholder_' + (index + 2) + '">Placeholder</label> <input type="text" name="placeholder_' + (index + 2) + '" /></div>';
         data += '<div class="input"><label for="validation_' + (index + 2) + '">Validation</label><select name="validation_' + (index + 2) + '"><option value="none">None</option><option value="email" selected="selected">Email</option><option value="number">Number</option><option value="phone">phone</option><option value="text_only">Text only</option></select></div>';
         data += '<div class="remove-add"><input type="button" class="remove" value="-"><input class="add" type="button" value="+"></div>';
         
         data +='</div>'
         $('.form_fields_wrapper .form_fields').eq(index).after(data);

         reCheck();
         
         $('.form_fields_wrapper').find("input[type=button].add").unbind('click');
         $('.form_fields_wrapper').find("input[type=button].add").bind('click', function(event) {
             var index = $(this).parent().parent().index();
             addNew(index);
         });

         $('.form_fields_wrapper').find("input[type=button].remove").unbind('click');
         $('.form_fields_wrapper').find("input[type=button].remove").bind('click', function(event) {
            var index = $(this).parent().parent().index();
            removeOld(index);
         });
         
    }
    
    function removeOld(index) {
        $('.form_fields').eq(index).remove();
        reCheck()
    }
    
    
    function reCheck() {
         $('.form_fields_wrapper .form_fields').each(function(index){
             $('.form_fields').eq(index).attr('id','form_fields_' + (index + 1))
             
             $('.form_fields').eq(index).children().eq(0).children('label').attr('for','label_' + (index + 1));
             $('.form_fields').eq(index).children().eq(0).children('input').attr('name','label_' + (index + 1));
             
             $('.form_fields').eq(index).children().eq(1).children('label').attr('for','input_type_' + (index + 1));
             $('.form_fields').eq(index).children().eq(1).children('select').attr('name','input_type_' + (index + 1));
             
             $('.form_fields').eq(index).children().eq(2).children('label').attr('for','is_required_' + (index + 1));
             $('.form_fields').eq(index).children().eq(2).children('input').attr('name','is_required_' + (index + 1));
             
             $('.form_fields').eq(index).children().eq(3).children('label').attr('for','placeholder_' + (index + 1));
             $('.form_fields').eq(index).children().eq(3).children('input').attr('name','placeholder_' + (index + 1));
             
             $('.form_fields').eq(index).children().eq(4).children('label').attr('for','validation_' + (index + 1));
             $('.form_fields').eq(index).children().eq(4).children('select').attr('name','validation_' + (index + 1));
         });    
     }
    
    $('.form_fields_wrapper .form_fields .add').click(function(){
        var index = $(this).parent().parent().index();
        addNew(index);
    });
    
    $('.form_fields_wrapper .form_fields .remove').click(function(){
        var index = $(this).parent().parent().index();
        removeOld(index);
    });
    
  	
/**
 *
 * Color picker
 * Author: Stefan Petre www.eyecon.ro
 * 
 * Dual licensed under the MIT and GPL licenses
 * 
 */

(function ($) {
    var ColorPicker = function () {
        var
            ids = {},
            inAction,
            charMin = 65,
            visible,
            tpl = '<div class="colorpicker"><div class="colorpicker_color"><div><div></div></div></div><div class="colorpicker_hue"><div></div></div><div class="colorpicker_new_color"></div><div class="colorpicker_current_color"></div><div class="colorpicker_hex"><input type="text" maxlength="6" size="6" /></div><div class="colorpicker_rgb_r colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_submit"></div></div>',
            defaults = {
                eventName: 'click',
                onShow: function () {},
                onBeforeShow: function(){},
                onHide: function () {},
                onChange: function () {},
                onSubmit: function () {},
                color: 'ff0000',
                livePreview: true,
                flat: false
            },
            fillRGBFields = function  (hsb, cal) {
                var rgb = HSBToRGB(hsb);
                $(cal).data('colorpicker').fields
                    .eq(1).val(rgb.r).end()
                    .eq(2).val(rgb.g).end()
                    .eq(3).val(rgb.b).end();
            },
            fillHSBFields = function  (hsb, cal) {
                $(cal).data('colorpicker').fields
                    .eq(4).val(hsb.h).end()
                    .eq(5).val(hsb.s).end()
                    .eq(6).val(hsb.b).end();
            },
            fillHexFields = function (hsb, cal) {
                $(cal).data('colorpicker').fields
                    .eq(0).val(HSBToHex(hsb)).end();
            },
            setSelector = function (hsb, cal) {
                $(cal).data('colorpicker').selector.css('backgroundColor', '#' + HSBToHex({h: hsb.h, s: 100, b: 100}));
                $(cal).data('colorpicker').selectorIndic.css({
                    left: parseInt(150 * hsb.s/100, 10),
                    top: parseInt(150 * (100-hsb.b)/100, 10)
                });
            },
            setHue = function (hsb, cal) {
                $(cal).data('colorpicker').hue.css('top', parseInt(150 - 150 * hsb.h/360, 10));
            },
            setCurrentColor = function (hsb, cal) {
                $(cal).data('colorpicker').currentColor.css('backgroundColor', '#' + HSBToHex(hsb));
            },
            setNewColor = function (hsb, cal) {
                $(cal).data('colorpicker').newColor.css('backgroundColor', '#' + HSBToHex(hsb));
            },
            keyDown = function (ev) {
                var pressedKey = ev.charCode || ev.keyCode || -1;
                if ((pressedKey > charMin && pressedKey <= 90) || pressedKey == 32) {
                    return false;
                }
                var cal = $(this).parent().parent();
                if (cal.data('colorpicker').livePreview === true) {
                    change.apply(this);
                }
            },
            change = function (ev) {
                var cal = $(this).parent().parent(), col;
                if (this.parentNode.className.indexOf('_hex') > 0) {
                    cal.data('colorpicker').color = col = HexToHSB(fixHex(this.value));
                } else if (this.parentNode.className.indexOf('_hsb') > 0) {
                    cal.data('colorpicker').color = col = fixHSB({
                        h: parseInt(cal.data('colorpicker').fields.eq(4).val(), 10),
                        s: parseInt(cal.data('colorpicker').fields.eq(5).val(), 10),
                        b: parseInt(cal.data('colorpicker').fields.eq(6).val(), 10)
                    });
                } else {
                    cal.data('colorpicker').color = col = RGBToHSB(fixRGB({
                        r: parseInt(cal.data('colorpicker').fields.eq(1).val(), 10),
                        g: parseInt(cal.data('colorpicker').fields.eq(2).val(), 10),
                        b: parseInt(cal.data('colorpicker').fields.eq(3).val(), 10)
                    }));
                }
                if (ev) {
                    fillRGBFields(col, cal.get(0));
                    fillHexFields(col, cal.get(0));
                    fillHSBFields(col, cal.get(0));
                }
                setSelector(col, cal.get(0));
                setHue(col, cal.get(0));
                setNewColor(col, cal.get(0));
                cal.data('colorpicker').onChange.apply(cal, [col, HSBToHex(col), HSBToRGB(col)]);
            },
            blur = function (ev) {
                var cal = $(this).parent().parent();
                cal.data('colorpicker').fields.parent().removeClass('colorpicker_focus');
            },
            focus = function () {
                charMin = this.parentNode.className.indexOf('_hex') > 0 ? 70 : 65;
                $(this).parent().parent().data('colorpicker').fields.parent().removeClass('colorpicker_focus');
                $(this).parent().addClass('colorpicker_focus');
            },
            downIncrement = function (ev) {
                var field = $(this).parent().find('input').focus();
                var current = {
                    el: $(this).parent().addClass('colorpicker_slider'),
                    max: this.parentNode.className.indexOf('_hsb_h') > 0 ? 360 : (this.parentNode.className.indexOf('_hsb') > 0 ? 100 : 255),
                    y: ev.pageY,
                    field: field,
                    val: parseInt(field.val(), 10),
                    preview: $(this).parent().parent().data('colorpicker').livePreview                  
                };
                $(document).bind('mouseup', current, upIncrement);
                $(document).bind('mousemove', current, moveIncrement);
            },
            moveIncrement = function (ev) {
                ev.data.field.val(Math.max(0, Math.min(ev.data.max, parseInt(ev.data.val + ev.pageY - ev.data.y, 10))));
                if (ev.data.preview) {
                    change.apply(ev.data.field.get(0), [true]);
                }
                return false;
            },
            upIncrement = function (ev) {
                change.apply(ev.data.field.get(0), [true]);
                ev.data.el.removeClass('colorpicker_slider').find('input').focus();
                $(document).unbind('mouseup', upIncrement);
                $(document).unbind('mousemove', moveIncrement);
                return false;
            },
            downHue = function (ev) {
                var current = {
                    cal: $(this).parent(),
                    y: $(this).offset().top
                };
                current.preview = current.cal.data('colorpicker').livePreview;
                $(document).bind('mouseup', current, upHue);
                $(document).bind('mousemove', current, moveHue);
            },
            moveHue = function (ev) {
                change.apply(
                    ev.data.cal.data('colorpicker')
                        .fields
                        .eq(4)
                        .val(parseInt(360*(150 - Math.max(0,Math.min(150,(ev.pageY - ev.data.y))))/150, 10))
                        .get(0),
                    [ev.data.preview]
                );
                return false;
            },
            upHue = function (ev) {
                fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                $(document).unbind('mouseup', upHue);
                $(document).unbind('mousemove', moveHue);
                return false;
            },
            downSelector = function (ev) {
                var current = {
                    cal: $(this).parent(),
                    pos: $(this).offset()
                };
                current.preview = current.cal.data('colorpicker').livePreview;
                $(document).bind('mouseup', current, upSelector);
                $(document).bind('mousemove', current, moveSelector);
            },
            moveSelector = function (ev) {
                change.apply(
                    ev.data.cal.data('colorpicker')
                        .fields
                        .eq(6)
                        .val(parseInt(100*(150 - Math.max(0,Math.min(150,(ev.pageY - ev.data.pos.top))))/150, 10))
                        .end()
                        .eq(5)
                        .val(parseInt(100*(Math.max(0,Math.min(150,(ev.pageX - ev.data.pos.left))))/150, 10))
                        .get(0),
                    [ev.data.preview]
                );
                return false;
            },
            upSelector = function (ev) {
                fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                $(document).unbind('mouseup', upSelector);
                $(document).unbind('mousemove', moveSelector);
                return false;
            },
            enterSubmit = function (ev) {
                $(this).addClass('colorpicker_focus');
            },
            leaveSubmit = function (ev) {
                $(this).removeClass('colorpicker_focus');
            },
            clickSubmit = function (ev) {
                var cal = $(this).parent();
                var col = cal.data('colorpicker').color;
                cal.data('colorpicker').origColor = col;
                setCurrentColor(col, cal.get(0));
                cal.data('colorpicker').onSubmit(col, HSBToHex(col), HSBToRGB(col), cal.data('colorpicker').el);
            },
            show = function (ev) {
                var cal = $('#' + $(this).data('colorpickerId'));
                cal.data('colorpicker').onBeforeShow.apply(this, [cal.get(0)]);
                var pos = $(this).offset();
                var viewPort = getViewport();
                var top = pos.top + this.offsetHeight;
                var left = pos.left;
                if (top + 176 > viewPort.t + viewPort.h) {
                    top -= this.offsetHeight + 176;
                }
                if (left + 356 > viewPort.l + viewPort.w) {
                    left -= 356;
                }
                cal.css({left: left + 'px', top: top + 'px'});
                if (cal.data('colorpicker').onShow.apply(this, [cal.get(0)]) != false) {
                    cal.show();
                }
                $(document).bind('mousedown', {cal: cal}, hide);
                return false;
            },
            hide = function (ev) {
                if (!isChildOf(ev.data.cal.get(0), ev.target, ev.data.cal.get(0))) {
                    if (ev.data.cal.data('colorpicker').onHide.apply(this, [ev.data.cal.get(0)]) != false) {
                        ev.data.cal.hide();
                    }
                    $(document).unbind('mousedown', hide);
                }
            },
            isChildOf = function(parentEl, el, container) {
                if (parentEl == el) {
                    return true;
                }
                if (parentEl.contains) {
                    return parentEl.contains(el);
                }
                if ( parentEl.compareDocumentPosition ) {
                    return !!(parentEl.compareDocumentPosition(el) & 16);
                }
                var prEl = el.parentNode;
                while(prEl && prEl != container) {
                    if (prEl == parentEl)
                        return true;
                    prEl = prEl.parentNode;
                }
                return false;
            },
            getViewport = function () {
                var m = document.compatMode == 'CSS1Compat';
                return {
                    l : window.pageXOffset || (m ? document.documentElement.scrollLeft : document.body.scrollLeft),
                    t : window.pageYOffset || (m ? document.documentElement.scrollTop : document.body.scrollTop),
                    w : window.innerWidth || (m ? document.documentElement.clientWidth : document.body.clientWidth),
                    h : window.innerHeight || (m ? document.documentElement.clientHeight : document.body.clientHeight)
                };
            },
            fixHSB = function (hsb) {
                return {
                    h: Math.min(360, Math.max(0, hsb.h)),
                    s: Math.min(100, Math.max(0, hsb.s)),
                    b: Math.min(100, Math.max(0, hsb.b))
                };
            }, 
            fixRGB = function (rgb) {
                return {
                    r: Math.min(255, Math.max(0, rgb.r)),
                    g: Math.min(255, Math.max(0, rgb.g)),
                    b: Math.min(255, Math.max(0, rgb.b))
                };
            },
            fixHex = function (hex) {
                var len = 6 - hex.length;
                if (len > 0) {
                    var o = [];
                    for (var i=0; i<len; i++) {
                        o.push('0');
                    }
                    o.push(hex);
                    hex = o.join('');
                }
                return hex;
            }, 
            HexToRGB = function (hex) {
                var hex = parseInt(((hex.indexOf('#') > -1) ? hex.substring(1) : hex), 16);
                return {r: hex >> 16, g: (hex & 0x00FF00) >> 8, b: (hex & 0x0000FF)};
            },
            HexToHSB = function (hex) {
                return RGBToHSB(HexToRGB(hex));
            },
            RGBToHSB = function (rgb) {
                var hsb = {
                    h: 0,
                    s: 0,
                    b: 0
                };
                var min = Math.min(rgb.r, rgb.g, rgb.b);
                var max = Math.max(rgb.r, rgb.g, rgb.b);
                var delta = max - min;
                hsb.b = max;
                if (max != 0) {
                    
                }
                hsb.s = max != 0 ? 255 * delta / max : 0;
                if (hsb.s != 0) {
                    if (rgb.r == max) {
                        hsb.h = (rgb.g - rgb.b) / delta;
                    } else if (rgb.g == max) {
                        hsb.h = 2 + (rgb.b - rgb.r) / delta;
                    } else {
                        hsb.h = 4 + (rgb.r - rgb.g) / delta;
                    }
                } else {
                    hsb.h = -1;
                }
                hsb.h *= 60;
                if (hsb.h < 0) {
                    hsb.h += 360;
                }
                hsb.s *= 100/255;
                hsb.b *= 100/255;
                return hsb;
            },
            HSBToRGB = function (hsb) {
                var rgb = {};
                var h = Math.round(hsb.h);
                var s = Math.round(hsb.s*255/100);
                var v = Math.round(hsb.b*255/100);
                if(s == 0) {
                    rgb.r = rgb.g = rgb.b = v;
                } else {
                    var t1 = v;
                    var t2 = (255-s)*v/255;
                    var t3 = (t1-t2)*(h%60)/60;
                    if(h==360) h = 0;
                    if(h<60) {rgb.r=t1; rgb.b=t2; rgb.g=t2+t3}
                    else if(h<120) {rgb.g=t1; rgb.b=t2; rgb.r=t1-t3}
                    else if(h<180) {rgb.g=t1; rgb.r=t2; rgb.b=t2+t3}
                    else if(h<240) {rgb.b=t1; rgb.r=t2; rgb.g=t1-t3}
                    else if(h<300) {rgb.b=t1; rgb.g=t2; rgb.r=t2+t3}
                    else if(h<360) {rgb.r=t1; rgb.g=t2; rgb.b=t1-t3}
                    else {rgb.r=0; rgb.g=0; rgb.b=0}
                }
                return {r:Math.round(rgb.r), g:Math.round(rgb.g), b:Math.round(rgb.b)};
            },
            RGBToHex = function (rgb) {
                var hex = [
                    rgb.r.toString(16),
                    rgb.g.toString(16),
                    rgb.b.toString(16)
                ];
                $.each(hex, function (nr, val) {
                    if (val.length == 1) {
                        hex[nr] = '0' + val;
                    }
                });
                return hex.join('');
            },
            HSBToHex = function (hsb) {
                return RGBToHex(HSBToRGB(hsb));
            },
            restoreOriginal = function () {
                var cal = $(this).parent();
                var col = cal.data('colorpicker').origColor;
                cal.data('colorpicker').color = col;
                fillRGBFields(col, cal.get(0));
                fillHexFields(col, cal.get(0));
                fillHSBFields(col, cal.get(0));
                setSelector(col, cal.get(0));
                setHue(col, cal.get(0));
                setNewColor(col, cal.get(0));
            };
        return {
            init: function (opt) {
                opt = $.extend({}, defaults, opt||{});
                if (typeof opt.color == 'string') {
                    opt.color = HexToHSB(opt.color);
                } else if (opt.color.r != undefined && opt.color.g != undefined && opt.color.b != undefined) {
                    opt.color = RGBToHSB(opt.color);
                } else if (opt.color.h != undefined && opt.color.s != undefined && opt.color.b != undefined) {
                    opt.color = fixHSB(opt.color);
                } else {
                    return this;
                }
                return this.each(function () {
                    if (!$(this).data('colorpickerId')) {
                        var options = $.extend({}, opt);
                        options.origColor = opt.color;
                        var id = 'collorpicker_' + parseInt(Math.random() * 1000);
                        $(this).data('colorpickerId', id);
                        var cal = $(tpl).attr('id', id);
                        if (options.flat) {
                            cal.appendTo(this).show();
                        } else {
                            cal.appendTo(document.body);
                        }
                        options.fields = cal
                                            .find('input')
                                                .bind('keyup', keyDown)
                                                .bind('change', change)
                                                .bind('blur', blur)
                                                .bind('focus', focus);
                        cal
                            .find('span').bind('mousedown', downIncrement).end()
                            .find('>div.colorpicker_current_color').bind('click', restoreOriginal);
                        options.selector = cal.find('div.colorpicker_color').bind('mousedown', downSelector);
                        options.selectorIndic = options.selector.find('div div');
                        options.el = this;
                        options.hue = cal.find('div.colorpicker_hue div');
                        cal.find('div.colorpicker_hue').bind('mousedown', downHue);
                        options.newColor = cal.find('div.colorpicker_new_color');
                        options.currentColor = cal.find('div.colorpicker_current_color');
                        cal.data('colorpicker', options);
                        cal.find('div.colorpicker_submit')
                            .bind('mouseenter', enterSubmit)
                            .bind('mouseleave', leaveSubmit)
                            .bind('click', clickSubmit);
                        fillRGBFields(options.color, cal.get(0));
                        fillHSBFields(options.color, cal.get(0));
                        fillHexFields(options.color, cal.get(0));
                        setHue(options.color, cal.get(0));
                        setSelector(options.color, cal.get(0));
                        setCurrentColor(options.color, cal.get(0));
                        setNewColor(options.color, cal.get(0));
                        if (options.flat) {
                            cal.css({
                                position: 'relative',
                                display: 'block'
                            });
                        } else {
                            $(this).bind(options.eventName, show);
                        }
                    }
                });
            },
            showPicker: function() {
                return this.each( function () {
                    if ($(this).data('colorpickerId')) {
                        show.apply(this);
                    }
                });
            },
            hidePicker: function() {
                return this.each( function () {
                    if ($(this).data('colorpickerId')) {
                        $('#' + $(this).data('colorpickerId')).hide();
                    }
                });
            },
            setColor: function(col) {
                if (typeof col == 'string') {
                    col = HexToHSB(col);
                } else if (col.r != undefined && col.g != undefined && col.b != undefined) {
                    col = RGBToHSB(col);
                } else if (col.h != undefined && col.s != undefined && col.b != undefined) {
                    col = fixHSB(col);
                } else {
                    return this;
                }
                return this.each(function(){
                    if ($(this).data('colorpickerId')) {
                        var cal = $('#' + $(this).data('colorpickerId'));
                        cal.data('colorpicker').color = col;
                        cal.data('colorpicker').origColor = col;
                        fillRGBFields(col, cal.get(0));
                        fillHSBFields(col, cal.get(0));
                        fillHexFields(col, cal.get(0));
                        setHue(col, cal.get(0));
                        setSelector(col, cal.get(0));
                        setCurrentColor(col, cal.get(0));
                        setNewColor(col, cal.get(0));
                    }
                });
            }
        };
    }();
    $.fn.extend({
        ColorPicker: ColorPicker.init,
        ColorPickerHide: ColorPicker.hidePicker,
        ColorPickerShow: ColorPicker.showPicker,
        ColorPickerSetColor: ColorPicker.setColor
    });
})(jQuery)


  	var currentlyClickedElement = '';
  	
  	$('.color-pick-color').bind("click", function(){
  		currentlyClickedElement = this;
  	});
  	
	$('.color-pick-color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).css("background","#"+hex);
			$(el).attr("data-value", "#"+hex);
			$(el).parent().children(".color-pick").val("#"+hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor($(this).attr("data-value"));
		},
		onChange: function (hsb, hex, rgb) {
			$(currentlyClickedElement).css("background","#"+hex);
			$(currentlyClickedElement).attr("data-value", "#"+hex);
			$(currentlyClickedElement).parent().children(".color-pick").val("#"+hex);
		}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});
	 
 
	$('.color-pick').bind('keyup', function(){
		$(this).parent().children(".color-pick-color").css("background", $(this).val());
	});
    
    var coolBlue = new Array("#727271", "#0084DF", "#084D83", "#005691", "#b7d0e2", "#ffffff", "#004E84", "#5E8FB1", "#292929", "#0084DF", "#00548E", "#005B9A", "#00416F", "#ffffff", "#166CA7", "#005691", "#ffffff", "#454545", "#252525", "#696969", "#f0f0f0", "#d4d4d4", "#005d9d", "#003e69", "#0097ff", "#006fbc");
    var orange = new Array("#727272", "#ffbd3d", "#d88e00", "#fbac14", "#fff2d9", "#ffffff", "#d68b00", "#f7c876", "#292929", "#d68b00", "#d68b00", "#ed9600", "#d68b00", "#ffffff", "#fbac14", "#d68b00", "#fffffff", "#454545", "#252525", "#696969", "#f0f0f0", "#d4d4d4", "#fbac14", "#d68b00", "#ffba3b", "#fbac14");
    var whineRed = new Array("#727272", "#d81f1f", "#a71616", "#bf2525", "#d9aeae", "#ffffff", "#a71616", "#cc5a5a", "#292929", "#bf2525", "#bf2525", "#bf2525", "#a31717", "#ffffff", "#bf2525", "#a31717", "#ffffff", "#454545", "#252525", "#696969", "#f0f0f0", "#d4d4d4", "#bf2525", "#a31717", "#d13030", "#bf2525");
    var greyish = new Array("#727272", "#4d4d4d", "#1d1d1d", "#383838", "#d5d5d5", "#ffffff", "#353535", "#737373", "#292929", "#000000", "#000000", "#4b4b4b", "#353535", "#ffffff", "#4b4b4b", "#353535", "#ffffff", "#454545", "#252525", "#696969", "#f0f0f0", "#d4d4d4", "#4b4b4b", "#353535", "#616161", "#4b4b4b");
	var softPurple = new Array("#727271", "#c394c3", "#a788a7", "#c0a4c0", "#f6ebf6", "#ffffff", "#967696", "#c09cc0", "#292929", "#c09cc0", "#a27aa2", "#b792b7", "#967696", "#ffffff", "#b792b7", "#967696", "#ffffff", "#454545", "#252525", "#696969", "#f0f0f0", "#d4d4d4", "#b792b7", "#967696", "#cca1cc", "#b792b7");
	var cream = new Array("#727271", "#e9b481", "#cc9967", "#e9b481", "#f5e0cc", "#ffffff", "#cc9967", "#ebb887", "#292929", "#ebb887", "#cc9967", "#ebb887", "#cc9967", "#ffffff", "#ebb887", "#cc9967", "#ffffff", "#454545", "#252525", "#696969", "#f0f0f0", "#d4d4d4", "#ebb887", "#cc9967", "#f9c693", "#ebb887");
	var skyBlue = new Array("#727271", "#94cedc", "#46a7be", "#94cedc", "#d5ebf0", "#ffffff", "#5dbcd2", "#8ddaec", "#292929", "#94cedc", "#46a7be", "#56b9d1", "#46a7be", "#ffffff", "#56b9d1", "#46a7be", "#ffffff", "#454545", "#252525", "#696969", "#f0f0f0", "#d4d4d4", "#56b9d1", "#46a7be", "#66cde5", "#56b9d1");
	var easyPink = new Array("#727271", "#f59ac7", "#ea76b0", "#f59ac7", "#ffe6f2", "#ffffff", "#ea76b0", "#f99dcb", "#292929", "#f59ac7", "#ea76b0", "#f59ac7", "#ea76b0", "#ffffff", "#f59ac7", "#ea76b0", "#ffffff", "#454545", "#252525", "#696969", "#f0f0f0", "#d4d4d4", "#f59ac7", "#ea76b0", "#fab6d8", "#f59ac7");
	var grentleGreen = new Array("#727271", "#c2d87f", "#aac067", "#c2d87f", "#f0f7da", "#ffffff", "#aac067", "#c8db88", "#292929", "#c2d87f", "#aac067", "#c2d87f", "#aac067", "#ffffff", "#c2d87f", "#aac067", "#ffffff", "#454545", "#252525", "#696969", "#f0f0f0", "#d4d4d4", "#c2d87f", "#aac067", "#cde08f", "#c2d87f");
    var green = new Array("#727272", "#92bf00", "#719400", "#719400", "#dee8bc", "#ffffff", "#628000", "#accf3a", "#292929", "#89b300", "#719400", "#719400", "#5a7500", "#ffffff", "#89b300", "#719400", "#ffffff", "#454545", "#252525", "#696969", "#f0f0f0", "#d4d4d4", "#719400", "#668500", "#a0d100", "#83ab00");
 
    $("#predefined_colors").bind("change", function(){
    	
    	var table;
    	
    	switch( $(this).val() ) {
    		case "cool-blue" : table = coolBlue; break;
    		case "orange" : table = orange; break;
    		case "whine-red" : table = whineRed; break;
    		case "greyish" : table = greyish; break;
    		case "soft-purple" : table = softPurple; break;
    		case "cream" : table = cream; break;
    		case "sky-blue" : table = skyBlue; break;
    		case "easy-pink" : table = easyPink; break;
    		case "gentle-green" : table = grentleGreen; break;
    		case "green" : table = green; break;
    	}
    	
    	$(".color-pick").each(function(index){
    		$(".color-pick").eq(index).val(table[index]);
    		$(".color-pick").eq(index).parent().children(".color-pick-color").css("background", table[index]);
    		$(".color-pick").eq(index).parent().children(".color-pick-color").attr("data-value", table[index]);
    	});
    });
 



    $(".style-images").each(function( index ) {
        if( $("input[type=radio]").eq(index).is(':checked')) {
            $(".style-images").eq( index ).css({"border":"2px solid #2187c0","cursor":"default"});
        }
    });

    $(".style-images").click(function(){
    
        $("input[type=radio]").eq( $(this).index(".style-images") ).click();
    
        $(".style-images").each(function( index ) {
            $(".style-images").eq( index ).css({"border":"2px solid #efefef","cursor":"pointer"});
        });
    
        $(this).css({"border":"2px solid #2187c0","cursor":"default"});
    });   



    $("#chk_cat_sidebars").click(function(){
        $(".cat_sidebars").toggle();
    })
});

