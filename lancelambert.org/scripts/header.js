(function($, Edge, compId){
//images folder
var im='images/';

var fonts = {};


var resources = [
];
var symbols = {
"stage": {
   version: "1.0.0",
   minimumCompatibleVersion: "0.1.7",
   build: "1.0.1.204",
   baseState: "Base State",
   initialState: "Base State",
   gpuAccelerate: false,
   resizeInstances: false,
   content: {
         dom: [
         {
            id:'Text',
            type:'text',
            rect:['177px','7px','auto','17px','auto','auto'],
            text:" for the new June 2013 Middle East Update",
            font:['Arial, Helvetica, sans-serif',12,"rgba(0,0,0,1)","600","none",""],
            transform:[[],[],['0deg','0deg'],['1','0']]
         },
         {
            id:'TextCopy',
            type:'text',
            rect:['149px','30px','auto','17px','auto','auto'],
            text:" for the more information on the vision for our web site",
            font:['Arial, Helvetica, sans-serif',12,"rgba(0,0,0,1)","600","none",""],
            transform:[[],[],['0deg','0deg'],['1','0']]
         },
         {
            id:'TextCopy2',
            type:'text',
            rect:['68px','50px','95px','17px','auto','auto'],
            text:"Download and<br>",
            font:['Arial, Helvetica, sans-serif',12,"rgba(0,0,0,1)","600","none",""],
            transform:[[],[],['0deg','0deg'],['1','0']]
         },
         {
            id:'TextCopy3',
            type:'text',
            rect:['340px','50px','179px','17px','auto','auto'],
            text:"for free on the audio page",
            font:['Arial, Helvetica, sans-serif',12,"rgba(0,0,0,1)","600","none",""],
            transform:[[],[],['0deg','0deg'],['1','0']]
         },
         {
            id:'Text2',
            type:'text',
            rect:['106px','7px','auto','17px','auto','auto'],
            cursor:['pointer'],
            text:"Click here",
            align:"left",
            font:['Arial, Helvetica, sans-serif',12,"rgba(0,42,255,1.00)","600","none","normal"],
            transform:[[],[],['0deg','0deg'],['1','0']]
         },
         {
            id:'Text2Copy',
            type:'text',
            rect:['78px','30px','auto','17px','auto','auto'],
            cursor:['pointer'],
            text:"Click here",
            align:"left",
            font:['Arial, Helvetica, sans-serif',12,"rgba(0,42,255,1.00)","600","none","normal"],
            transform:[[],[],['0deg','0deg'],['1','0']]
         },
         {
            id:'Text2Copy3',
            type:'text',
            rect:['166px','50px','auto','17px','auto','auto'],
            cursor:['pointer'],
            text:"listen to digital messages<br>",
            align:"left",
            font:['Arial, Helvetica, sans-serif',12,"rgba(0,42,255,1.00)","600","none","normal"],
            transform:[[],[],['0deg','0deg'],['1','0']]
         },
         {
            id:'Arrow-32',
            type:'image',
            rect:['62px','0px','32px','32px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"Arrow-32.png",'0px','0px'],
            transform:[[],[],[],['0.6','0.6']]
         },
         {
            id:'Arrow-32Copy',
            type:'image',
            rect:['42px','23px','32px','32px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"Arrow-32.png",'0px','0px'],
            transform:[[],[],[],['0.6','0.6']]
         },
         {
            id:'Arrow-32Copy2',
            type:'image',
            rect:['23px','43px','32px','32px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"Arrow-32.png",'0px','0px'],
            transform:[[],[],[],['0.6','0.6']]
         }],
         symbolInstances: [

         ]
      },
   states: {
      "Base State": {
         "${_Arrow-32}": [
            ["style", "top", '0.4px'],
            ["transform", "scaleY", '0.6'],
            ["transform", "scaleX", '0.6'],
            ["style", "opacity", '0'],
            ["style", "left", '61.6px']
         ],
         "${_TextCopy3}": [
            ["transform", "scaleX", '1'],
            ["style", "font-weight", '600'],
            ["style", "left", '335px'],
            ["style", "font-size", '12px'],
            ["style", "top", '52px'],
            ["transform", "skewY", '0deg'],
            ["transform", "scaleY", '0'],
            ["transform", "skewX", '0deg'],
            ["style", "height", '17px'],
            ["style", "font-family", 'Arial, Helvetica, sans-serif'],
            ["style", "opacity", '1'],
            ["style", "width", '179px']
         ],
         "${_Text2Copy}": [
            ["color", "color", 'rgba(0,42,255,1)'],
            ["transform", "scaleX", '1'],
            ["style", "opacity", '1'],
            ["style", "left", '78px'],
            ["style", "font-size", '12px'],
            ["style", "top", '31px'],
            ["style", "cursor", 'pointer'],
            ["transform", "skewY", '0deg'],
            ["transform", "skewX", '0deg'],
            ["style", "height", '17px'],
            ["style", "font-family", 'Arial, Helvetica, sans-serif'],
            ["transform", "scaleY", '0'],
            ["style", "font-weight", '600']
         ],
         "${_Text2}": [
            ["style", "font-weight", '600'],
            ["color", "color", 'rgba(0,42,255,1.00)'],
            ["style", "opacity", '1'],
            ["style", "left", '106px'],
            ["style", "font-size", '12px'],
            ["style", "top", '9px'],
            ["transform", "skewY", '0deg'],
            ["transform", "scaleY", '0'],
            ["transform", "skewX", '0deg'],
            ["style", "height", '17px'],
            ["style", "font-family", 'Arial, Helvetica, sans-serif'],
            ["transform", "scaleX", '1'],
            ["style", "cursor", 'pointer']
         ],
         "${_Arrow-32Copy2}": [
            ["style", "top", '43.58px'],
            ["transform", "scaleY", '0.6'],
            ["transform", "scaleX", '0.6'],
            ["style", "opacity", '0'],
            ["style", "left", '14.6px']
         ],
         "${_Text2Copy2}": [
            ["color", "color", 'rgba(0,42,255,1)'],
            ["style", "opacity", '1'],
            ["style", "left", '106px'],
            ["style", "font-size", '12px'],
            ["style", "top", '7px'],
            ["style", "cursor", 'pointer'],
            ["transform", "scaleY", '1'],
            ["transform", "skewX", '0deg'],
            ["style", "height", '17px'],
            ["transform", "scaleX", '1'],
            ["transform", "skewY", '0deg'],
            ["style", "font-weight", '600']
         ],
         "${_Text}": [
            ["transform", "scaleX", '1'],
            ["style", "font-weight", '600'],
            ["style", "left", '177px'],
            ["style", "font-size", '12px'],
            ["style", "top", '9px'],
            ["transform", "skewY", '0deg'],
            ["transform", "skewX", '0deg'],
            ["style", "height", '17px'],
            ["style", "font-family", 'Arial, Helvetica, sans-serif'],
            ["style", "opacity", '1'],
            ["transform", "scaleY", '0']
         ],
         "${_TextCopy2}": [
            ["transform", "scaleX", '1'],
            ["style", "font-weight", '600'],
            ["style", "left", '69px'],
            ["style", "font-size", '12px'],
            ["style", "top", '52px'],
            ["style", "width", '95px'],
            ["transform", "scaleY", '0'],
            ["transform", "skewX", '0deg'],
            ["style", "height", '17px'],
            ["style", "font-family", 'Arial, Helvetica, sans-serif'],
            ["style", "opacity", '1'],
            ["transform", "skewY", '0deg']
         ],
         "${_Stage}": [
            ["color", "background-color", 'rgba(255,255,255,0.00)'],
            ["style", "width", '600px'],
            ["style", "height", '80px'],
            ["style", "overflow", 'hidden']
         ],
         "${_Arrow-32Copy}": [
            ["style", "top", '22.6px'],
            ["transform", "scaleY", '0.6'],
            ["transform", "scaleX", '0.6'],
            ["style", "opacity", '0'],
            ["style", "left", '33.6px']
         ],
         "${_TextCopy}": [
            ["transform", "scaleX", '1'],
            ["style", "font-weight", '600'],
            ["style", "left", '149px'],
            ["style", "font-size", '12px'],
            ["style", "top", '31px'],
            ["transform", "skewY", '0deg'],
            ["transform", "skewX", '0deg'],
            ["style", "height", '17px'],
            ["style", "font-family", 'Arial, Helvetica, sans-serif'],
            ["transform", "scaleY", '0'],
            ["style", "opacity", '1']
         ],
         "${_Text2Copy3}": [
            ["style", "font-weight", '600'],
            ["color", "color", 'rgba(0,42,255,1)'],
            ["style", "opacity", '1'],
            ["style", "left", '167px'],
            ["style", "font-size", '12px'],
            ["style", "top", '52px'],
            ["transform", "scaleY", '0'],
            ["transform", "skewY", '0deg'],
            ["transform", "skewX", '0deg'],
            ["style", "height", '17px'],
            ["style", "font-family", 'Arial, Helvetica, sans-serif'],
            ["transform", "scaleX", '1'],
            ["style", "cursor", 'pointer']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 11433,
         autoPlay: true,
         labels: {
            "start": 250
         },
         timeline: [
            { id: "eid34", tween: [ "transform", "${_TextCopy}", "scaleY", '1', { fromValue: '0'}], position: 1121, duration: 436, easing: "easeInOutExpo" },
            { id: "eid53", tween: [ "style", "${_Arrow-32Copy}", "left", '47.6px', { fromValue: '33.6px'}], position: 1557, duration: 436, easing: "easeOutBack" },
            { id: "eid85", tween: [ "style", "${_Arrow-32Copy}", "left", '47.6px', { fromValue: '33.6px'}], position: 7371, duration: 436, easing: "easeOutBack" },
            { id: "eid105", tween: [ "style", "${_TextCopy3}", "left", '339px', { fromValue: '335px'}], position: 1992, duration: 0 },
            { id: "eid46", tween: [ "style", "${_Arrow-32}", "left", '75.6px', { fromValue: '61.6px'}], position: 686, duration: 436, easing: "easeOutBack" },
            { id: "eid88", tween: [ "style", "${_Arrow-32}", "left", '75.6px', { fromValue: '61.6px'}], position: 6500, duration: 436, easing: "easeOutBack" },
            { id: "eid33", tween: [ "transform", "${_Text2Copy}", "scaleY", '1', { fromValue: '0'}], position: 1121, duration: 436, easing: "easeInOutExpo" },
            { id: "eid80", tween: [ "style", "${_Arrow-32Copy2}", "opacity", '1', { fromValue: '0'}], position: 2428, duration: 0, easing: "easeInOutExpo" },
            { id: "eid81", tween: [ "style", "${_Arrow-32Copy2}", "opacity", '0', { fromValue: '1'}], position: 2864, duration: 255, easing: "easeOutBack" },
            { id: "eid83", tween: [ "style", "${_Arrow-32Copy2}", "opacity", '1', { fromValue: '0'}], position: 8242, duration: 0, easing: "easeInOutExpo" },
            { id: "eid84", tween: [ "style", "${_Arrow-32Copy2}", "opacity", '0', { fromValue: '1'}], position: 8678, duration: 255, easing: "easeOutBack" },
            { id: "eid38", tween: [ "transform", "${_TextCopy2}", "scaleY", '1', { fromValue: '0'}], position: 1992, duration: 436, easing: "easeInOutExpo" },
            { id: "eid40", tween: [ "transform", "${_Text2Copy3}", "scaleY", '1', { fromValue: '0'}], position: 1992, duration: 436, easing: "easeInOutExpo" },
            { id: "eid16", tween: [ "transform", "${_Text2}", "scaleY", '1', { fromValue: '0'}], position: 250, duration: 436, easing: "easeInOutExpo" },
            { id: "eid67", tween: [ "style", "${_Text2Copy3}", "left", '167px', { fromValue: '167px'}], position: 2350, duration: 0, easing: "easeInOutExpo" },
            { id: "eid91", tween: [ "style", "${_Arrow-32Copy2}", "top", '43.58px', { fromValue: '43.58px'}], position: 9250, duration: 0, easing: "easeOutBack" },
            { id: "eid66", tween: [ "style", "${_TextCopy2}", "left", '69px', { fromValue: '69px'}], position: 2350, duration: 0, easing: "easeInOutExpo" },
            { id: "eid14", tween: [ "transform", "${_Text}", "scaleY", '1', { fromValue: '0'}], position: 250, duration: 436, easing: "easeInOutExpo" },
            { id: "eid54", tween: [ "style", "${_Arrow-32Copy}", "opacity", '1', { fromValue: '0'}], position: 1557, duration: 0, easing: "easeInOutExpo" },
            { id: "eid55", tween: [ "style", "${_Arrow-32Copy}", "opacity", '0', { fromValue: '1'}], position: 1992, duration: 255, easing: "easeOutBack" },
            { id: "eid86", tween: [ "style", "${_Arrow-32Copy}", "opacity", '1', { fromValue: '0'}], position: 7371, duration: 0, easing: "easeInOutExpo" },
            { id: "eid87", tween: [ "style", "${_Arrow-32Copy}", "opacity", '0', { fromValue: '1'}], position: 7806, duration: 255, easing: "easeOutBack" },
            { id: "eid39", tween: [ "transform", "${_TextCopy3}", "scaleY", '1', { fromValue: '0'}], position: 1992, duration: 436, easing: "easeInOutExpo" },
            { id: "eid42", tween: [ "style", "${_Arrow-32}", "opacity", '1', { fromValue: '0'}], position: 686, duration: 0, easing: "easeInOutExpo" },
            { id: "eid49", tween: [ "style", "${_Arrow-32}", "opacity", '0', { fromValue: '1'}], position: 1121, duration: 255, easing: "easeOutBack" },
            { id: "eid89", tween: [ "style", "${_Arrow-32}", "opacity", '1', { fromValue: '0'}], position: 6500, duration: 0, easing: "easeInOutExpo" },
            { id: "eid90", tween: [ "style", "${_Arrow-32}", "opacity", '0', { fromValue: '1'}], position: 6935, duration: 255, easing: "easeOutBack" },
            { id: "eid79", tween: [ "style", "${_Arrow-32Copy2}", "left", '35.33px', { fromValue: '14.6px'}], position: 2428, duration: 436, easing: "easeOutBack" },
            { id: "eid82", tween: [ "style", "${_Arrow-32Copy2}", "left", '35.33px', { fromValue: '14.6px'}], position: 8242, duration: 436, easing: "easeOutBack" }         ]
      }
   }
}
};


Edge.registerCompositionDefn(compId, symbols, fonts, resources);

/**
 * Adobe Edge DOM Ready Event Handler
 */
$(window).ready(function() {
     Edge.launchComposition(compId);
});
})(jQuery, AdobeEdge, "header_animation");
