/*
Copyright 2013 Adobe Systems Inc.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and limitations under the License.
*/

/*
Gradient Maps support
Author: Alan Greenblatt (blatt@adobe.com, @agreenblatt, blattchat.com)
*/

window.GradientMaps = function(scope) {
  console.log("Heyo! Gradientmaps init!")
    function GradientMaps() {
        this.init();
    }
    
    GradientMaps.prototype = {
        init: function() {
        },

        calcStopsArray: function(stopsDecl) {    
            /*
             * Each stop consists of a color and an optional percentage or length
             * stops: <color-stop> [, <color-stop>]
             * <color-stop>: color [ <percentage> | <length> ]?
             *
             * If the first color-stop does not have a length or percentage, it defaults to 0%
             * If the last color-stop does not have a length or percentage, it defaults to 100%
             * If a color-stop, other than the first or last, does not have a length or percentage, it is assigned the position half way between the previous and the next stop.
             * If a color-stop, other than the first or last, has a specified position less than the previous stop, its position is changed to be equal to the largest specified position of any prior color-stop.
             */
        
            var matches = stopsDecl.match(/(((rgb|hsl)a?\(\d{1,3},\s*\d{1,3},\s*\d{1,3}(?:,\s*0?\.?\d+)?\)|\w+|#[0-9a-fA-F]{1,6})(\s+(0?\.\d+|\d{1,3}%))?)/g);
        
            var stopsDeclArr = stopsDecl.split(',');
            var stops = [];
        
            matches.forEach(function(colorStop) {
                var colorStopMatches = colorStop.match(/(?:((rgb|hsl)a?\(\d{1,3},\s*\d{1,3},\s*\d{1,3}(?:,\s*0?\.?\d+)?\)|\w+|#[0-9a-fA-F]{1,6})(\s+(?:0?\.\d+|\d{1,3}%))?)/);
                if (colorStopMatches && colorStopMatches.length >= 4) {
                    posMatch = colorStopMatches[3];
                    stops.push({
                        color: parseCSSColor(colorStopMatches[1]),
                        pos: posMatch ? parse_css_float(posMatch) * 100 : null
                    })
                }
            });
        
            /*
             * Need to calculate the positions where they aren't specified.
             * In the case of the first and last stop, we may even have to add a new stop.
             * 
             * Go through the array of stops, finding ones where the position is not specified.
             * Then, find the next specified position or terminate on the last stop.
             * Finally, evenly distribute the unspecified positions, with the first stop at 0 
             * and the last stop at 100.
             */
        
            if (stops.length >= 1) {
                // If the first stop's position is not specified, set it to 0.
                var stop = stops[0];
                if (!stop.pos)
                    stop.pos = 0;
                else
                    stop.pos = Math.min(100, Math.max(0, stop.pos));
        
                var currentPos = stop.pos;
        
                // If the last stop's position is not specified, set it to 100.
                stop = stops[stops.length-1];
                if (!stop.pos)
                    stop.pos = 100;
                else
                    stop.pos = Math.min(100, Math.max(0, stop.pos));
        
                // Make sure that all positions are in ascending order
                for (var i = 1; i < stops.length-1; i++) {
                    stop = stops[i];
                    if (stop.pos && stop.pos < currentPos)
                        stop.pos = currentPos;
                    if (stop.pos > 100) stop.pos = 100;
                    currentPos = stop.pos;
                }
        
                // Find any runs of unpositioned stops and calculate them
                var i = 1;
                while (i < (stops.length-1)) {
                    if (!stops[i].pos) {
                        // Find the next positioned stop.  You'll always have at least the
                        // last stop at 100.
                        for (var j = i+1; j < stops.length; j++) {
                            if (stops[j].pos)
                                break;
                        }
        
                        var startPos = stops[i-1].pos;
                        var endPos = stops[j].pos;
                        var nStops = j - 1 + 1;
        
                        var delta = Math.round((endPos - startPos) / nStops);
                        while (i < j) {
                            stops[i].pos = stops[i-1].pos + delta;
                            i++;
                        }
                    }
        
                    i++;
                }
        
                if (stops[0].pos != 0) {
                    stops.unshift({
                        color: stops[0].color,
                        pos: 0
                    });
                }
        
                if (stops[stops.length-1].pos != 100) {
                    stops.push({
                        color: stops[stops.length-1].color,
                        pos: 100
                    })
                }
            }
        
            return stops;
        },

        findMatchingDistributedNSegs: function(stops) {
            var maxNumSegs = 100;
            var matched = false;
            for (var nSegs = 1; !matched && nSegs <= maxNumSegs; nSegs++) {
                var segSize = maxNumSegs / nSegs;
                matched = true;
                for (var i = 1; i < stops.length-1; i++) {
                    var pos = stops[i].pos;
                    if (pos < segSize) {
                        matched = false;
                        break;
                    }
                    var rem = pos % segSize;
                    var maxDiff = 1.0;
                    if (!(rem < maxDiff || (segSize - rem) < maxDiff)) {
                        matched = false;
                        break;
                    }
                }
        
                if (matched)
                    return nSegs;
            }       
        
            return nSegs; 
        },

        calcDistributedColors: function(stops, nSegs) {
            var colors = [stops[0].color];
        
            var segSize = 100 / nSegs;
            for (var i = 1; i < stops.length-1; i++) {
                var stop = stops[i];
                var n = Math.round(stop.pos / segSize);
                colors[n] = stop.color;
            }
            
            colors[nSegs] = stops[stops.length-1].color;
        
            var i = 1;
            while (i < colors.length) {
                if (!colors[i]) {
                    for (var j = i+1; j < colors.length; j++) {
                        if (colors[j])
                            break;
                    }
        
                    // Need to evenly distribute colors stops from svgStop[i-1] to svgStop[j]
        
                    var startColor = colors[i-1];
                    var r = startColor[0];
                    var g = startColor[1];
                    var b = startColor[2];
                    var a = startColor[3];
        
                    var endColor = colors[j];
        
                    var nSegs = j - i + 1;
                    var dr = (endColor[0] - r) / nSegs;
                    var dg = (endColor[1] - g) / nSegs;
                    var db = (endColor[2] - b) / nSegs;
                    var da = (endColor[3] - a) / nSegs;
        
                    while (i < j) {
                        r += dr;
                        g += dg;
                        b += db;
                        a += da;
                        colors[i] = [r, g, b, a];
                        i++;
                    }
                }
                i++;
            }
        
            return colors;
        },
        
        addElement: function(doc, parent, tagname, ns, attributes) {
            var elem = ns ? doc.createElementNS(ns, tagname) : doc.createElement(tagname);
            if (attributes) {
                Object.keys(attributes).forEach(function(key, index, keys) {
                    elem.setAttribute(key, attributes[key]);
                });
                    //elem.setAttribute(attr.name, attr.value);
            }
        
            if (parent) parent.appendChild(elem);
            return elem;
        },

        addSVGComponentTransferFilter: function(elem, colors) {
            var filter = null;
            var svg = null;
            var svgns = 'http://www.w3.org/2000/svg';
            var filterID = elem.getAttribute('data-gradientmap-filter');
        
            var svgIsNew = false;
        
            var doc = elem.ownerDocument;
            
            if (filterID) {
                filter = doc.getElementById(filterID);
                if (filter) {
                    // Remove old component transfer function
                    var componentTransfers = filter.getElementsByTagNameNS(svgns, 'feComponentTransfer');
                    if (componentTransfers) {
                        for (var i = componentTransfers.length-1; i >= 0; --i)
                            filter.removeChild(componentTransfers[i]);
        
                       svg = filter.parentElement;
                    }
                }
            }
        
            // The last thing to be set previously is 'svg'.  If that is still null, that will handle any errors
            if (!svg) {
                var svg = this.addElement(doc, null, 'svg', svgns, {
                    'version': '1.1',
                    'width': 0,
                    'height': 0
                });
        
                filterID = 'filter-' + (new Date().getTime());
                filter = this.addElement(doc, svg, 'filter', svgns, {'id': filterID});
                elem.setAttribute('data-gradientmap-filter', filterID);
        
                // First, apply a color matrix to turn the source into a grayscale
                var colorMatrix = this.addElement(doc, filter, 'feColorMatrix', svgns, {
                    'type': 'matrix',
                    'values': '0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0 0 0 1 0',
                    'result': 'gray'
                });
        
                svgIsNew = true;
            }
        
            // Now apply a component transfer to remap the colors
            var componentTransfer = this.addElement(doc, filter, 'feComponentTransfer', svgns, {'color-interpolation-filters': 'sRGB'});
        
            var redTableValues = "";
            var greenTableValues = "";
            var blueTableValues = "";
            var alphaTableValues = "";
        
            colors.forEach(function(color, index, colors) {
                redTableValues += (color[0] / 255.0 + " ");
                greenTableValues += (color[1] / 255.0 + " ");
                blueTableValues += (color[2] / 255.0 + " ");
                alphaTableValues += (color[3] + " ");
            });
        
            this.addElement(doc, componentTransfer, 'feFuncR', svgns, {'type': 'table', 'tableValues': redTableValues.trim()});
            this.addElement(doc, componentTransfer, 'feFuncG', svgns, {'type': 'table', 'tableValues': greenTableValues.trim()});
            this.addElement(doc, componentTransfer, 'feFuncB', svgns, {'type': 'table', 'tableValues': blueTableValues.trim()});
            this.addElement(doc, componentTransfer, 'feFuncA', svgns, {'type': 'table', 'tableValues': alphaTableValues.trim()});
        
            if (svgIsNew)
                elem.parentElement.insertBefore(svg, elem);
        
            var filterDecl = 'url(#' + filterID + ')';
            elem.style['-webkit-filter'] = filterDecl;
            elem.style['filter'] = filterDecl;
        
            //elem.setAttribute('style', '-webkit-filter: url(#' + filterID + '); filter: url(#' + filterID + ')');
        },

        applyGradientMap: function(elem, gradient) {
            var stops = this.calcStopsArray(gradient);
            var nSegs = this.findMatchingDistributedNSegs(stops);
            var colors = this.calcDistributedColors(stops, nSegs);
        
            this.addSVGComponentTransferFilter(elem, colors);
        },
        
        removeGradientMap: function(elem) {
            var filterID = elem.getAttribute('data-gradientmap-filter');
            if (filterID) {
                var doc = elem.ownerDocument;
                var filter = doc.getElementById(filterID);
                if (filter) {
                    var svg = filter.parentElement;
                    svg.removeChild(filter);
                    if (svg.childNodes.length <= 0) {
                        var parent = svg.parentElement;
                        parent.removeChild(svg);
                    }
                }
                elem.removeAttribute('data-gradientmap-filter');
                elem.style['-webkit-filter'] = '';
                elem.style['filter'] = '';
            }
        },
    }
    
    return new GradientMaps();
}(window);

// (c) Dean McNamee <dean@gmail.com>, 2012.
//
// https://github.com/deanm/css-color-parser-js
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to
// deal in the Software without restriction, including without limitation the
// rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
// sell copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
// FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
// IN THE SOFTWARE.

// http://www.w3.org/TR/css3-color/
var kCSSColorTable = {
  "transparent": [0,0,0,0],
  "black": [0,0,0,1], "gray": [128,128,128,1], "grey": [128,128,128,1],
  saltypurple:[201,0,160,1], saltypink:[252,2,98,1], saltyorange: [255,158,1,1], 
  saltygreen: [216,235,0], saltyblue: [47,36,219], saltyteal: [47,246,246]}

function clamp_css_byte(i) {  // Clamp to integer 0 .. 255.
  i = Math.round(i);  // Seems to be what Chrome does (vs truncation).
  return i < 0 ? 0 : i > 255 ? 255 : i;
}

function clamp_css_float(f) {  // Clamp to float 0.0 .. 1.0.
  return f < 0 ? 0 : f > 1 ? 1 : f;
}

function parse_css_int(str) {  // int or percentage.
  if (str[str.length - 1] === '%')
    return clamp_css_byte(parseFloat(str) / 100 * 255);
  return clamp_css_byte(parseInt(str));
}

function parse_css_float(str) {  // float or percentage.
  if (str[str.length - 1] === '%')
    return clamp_css_float(parseFloat(str) / 100);
  return clamp_css_float(parseFloat(str));
}

function css_hue_to_rgb(m1, m2, h) {
  if (h < 0) h += 1;
  else if (h > 1) h -= 1;

  if (h * 6 < 1) return m1 + (m2 - m1) * h * 6;
  if (h * 2 < 1) return m2;
  if (h * 3 < 2) return m1 + (m2 - m1) * (2/3 - h) * 6;
  return m1;
}

function parseCSSColor(css_str) {
  // Remove all whitespace, not compliant, but should just be more accepting.
  var str = css_str.replace(/ /g, '').toLowerCase();

  // Color keywords (and transparent) lookup.
  if (str in kCSSColorTable) return kCSSColorTable[str].slice();  // dup.

  // #abc and #abc123 syntax.
  if (str[0] === '#') {
    if (str.length === 4) {
      var iv = parseInt(str.substr(1), 16);  // TODO(deanm): Stricter parsing.
      if (!(iv >= 0 && iv <= 0xfff)) return null;  // Covers NaN.
      return [((iv & 0xf00) >> 4) | ((iv & 0xf00) >> 8),
              (iv & 0xf0) | ((iv & 0xf0) >> 4),
              (iv & 0xf) | ((iv & 0xf) << 4),
              1];
    } else if (str.length === 7) {
      var iv = parseInt(str.substr(1), 16);  // TODO(deanm): Stricter parsing.
      if (!(iv >= 0 && iv <= 0xffffff)) return null;  // Covers NaN.
      return [(iv & 0xff0000) >> 16,
              (iv & 0xff00) >> 8,
              iv & 0xff,
              1];
    }

    return null;
  }

  var op = str.indexOf('('), ep = str.indexOf(')');
  if (op !== -1 && ep + 1 === str.length) {
    var fname = str.substr(0, op);
    var params = str.substr(op+1, ep-(op+1)).split(',');
    var alpha = 1;  // To allow case fallthrough.
    switch (fname) {
      case 'rgba':
        if (params.length !== 4) return null;
        alpha = parse_css_float(params.pop());
        // Fall through.
      case 'rgb':
        if (params.length !== 3) return null;
        return [parse_css_int(params[0]),
                parse_css_int(params[1]),
                parse_css_int(params[2]),
                alpha];
      case 'hsla':
        if (params.length !== 4) return null;
        alpha = parse_css_float(params.pop());
        // Fall through.
      case 'hsl':
        if (params.length !== 3) return null;
        var h = (((parseFloat(params[0]) % 360) + 360) % 360) / 360;  // 0 .. 1
        // NOTE(deanm): According to the CSS spec s/l should only be
        // percentages, but we don't bother and let float or percentage.
        var s = parse_css_float(params[1]);
        var l = parse_css_float(params[2]);
        var m2 = l <= 0.5 ? l * (s + 1) : l + s - l * s;
        var m1 = l * 2 - m2;
        return [clamp_css_byte(css_hue_to_rgb(m1, m2, h+1/3) * 255),
                clamp_css_byte(css_hue_to_rgb(m1, m2, h) * 255),
                clamp_css_byte(css_hue_to_rgb(m1, m2, h-1/3) * 255),
                alpha];
      default:
        return null;
    }
  }

  return null;
}

try { exports.parseCSSColor = parseCSSColor } catch(e) { }


var saltyPurple = kCSSColorTable.saltypurple
var saltyPink = kCSSColorTable.saltypink
var saltyOrange = kCSSColorTable.saltyorange
var saltyGreen = kCSSColorTable.saltygreen
var saltyBlue = kCSSColorTable.saltyblue 
var saltyTeal = kCSSColorTable.saltyteal
var saltyGrads = [ 
 "saltyPurple, saltyGreen"
, "saltyPurple, saltyOrange"
, "saltyPurple, saltyTeal"
, "saltyPink, saltyGreen"
, "saltyPink, saltyTeal"
, "saltyBlue, saltyPink"
, "saltyBlue, saltyOrange"
, "saltyBlue, saltyGreen"
, "saltyBlue, saltyTeal"
]

// var saltyGrads = [
// "#C900A0, #FF9E01",
// "#FC0262, #D8EB00",
// "#2F24DB, #2FF6F6"
// ]

  var randomGradient = function() {
    console.log("Hello, RandomGradient function!")
    var gradientMap = "#C900A0, #D8EB00";
      var target = document.getElementsByClassName("random-grad");
      for (var i = 0; i < target.length; i++) {
          gradientMap = saltyGrads[Math.floor(Math.random() * saltyGrads.length)];
          var current = target[i];
         GradientMaps.applyGradientMap(current, gradientMap);
    }
  }

  randomGradient();