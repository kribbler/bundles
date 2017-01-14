//MooTools More, <http://mootools.net/more>. Copyright (c) 2006-2009 Aaron Newton <http://clientcide.com/>, Valerio Proietti <http://mad4milk.net> & the MooTools team <http://mootools.net/developers>, MIT Style License.

MooTools.More={'version':'1.2.4.4','build':'6f6057dc645fdb7547689183b2311063bd653ddf'};Fx.Scroll=new Class({Extends:Fx,options:{offset:{x:0,y:0},wheelStops:true},initialize:function(element,options){this.element=this.subject=document.id(element);this.parent(options);var cancel=this.cancel.bind(this,false);if($type(this.element)!='element')this.element=document.id(this.element.getDocument().body);var stopper=this.element;if(this.options.wheelStops){this.addEvent('start',function(){stopper.addEvent('mousewheel',cancel);},true);this.addEvent('complete',function(){stopper.removeEvent('mousewheel',cancel);},true);}},set:function(){var now=Array.flatten(arguments);if(Browser.Engine.gecko)now=[Math.round(now[0]),Math.round(now[1])];this.element.scrollTo(now[0],now[1]);},compute:function(from,to,delta){return[0,1].map(function(i){return Fx.compute(from[i],to[i],delta);});},start:function(x,y){if(!this.check(x,y))return this;var scrollSize=this.element.getScrollSize(),scroll=this.element.getScroll(),values={x:x,y:y};for(var z in values){var max=scrollSize[z];if($chk(values[z]))values[z]=($type(values[z])=='number')?values[z]:max;else values[z]=scroll[z];values[z]+=this.options.offset[z];}
return this.parent([scroll.x,scroll.y],[values.x,values.y]);},toTop:function(){return this.start(false,0);},toLeft:function(){return this.start(0,false);},toRight:function(){return this.start('right',false);},toBottom:function(){return this.start(false,'bottom');},toElement:function(el){var position=document.id(el).getPosition(this.element);return this.start(position.x,position.y);},scrollIntoView:function(el,axes,offset){axes=axes?$splat(axes):['x','y'];var to={};el=document.id(el);var pos=el.getPosition(this.element);var size=el.getSize();var scroll=this.element.getScroll();var containerSize=this.element.getSize();var edge={x:pos.x+size.x,y:pos.y+size.y};['x','y'].each(function(axis){if(axes.contains(axis)){if(edge[axis]>scroll[axis]+containerSize[axis])to[axis]=edge[axis]-containerSize[axis];if(pos[axis]<scroll[axis])to[axis]=pos[axis];}
if(to[axis]==null)to[axis]=scroll[axis];if(offset&&offset[axis])to[axis]=to[axis]+offset[axis];},this);if(to.x!=scroll.x||to.y!=scroll.y)this.start(to.x,to.y);return this;},scrollToCenter:function(el,axes,offset){axes=axes?$splat(axes):['x','y'];el=$(el);var to={},pos=el.getPosition(this.element),size=el.getSize(),scroll=this.element.getScroll(),containerSize=this.element.getSize(),edge={x:pos.x+size.x,y:pos.y+size.y};['x','y'].each(function(axis){if(axes.contains(axis)){to[axis]=pos[axis]-(containerSize[axis]-size[axis])/2;}
if(to[axis]==null)to[axis]=scroll[axis];if(offset&&offset[axis])to[axis]=to[axis]+offset[axis];},this);if(to.x!=scroll.x||to.y!=scroll.y)this.start(to.x,to.y);return this;}});var Asset={javascript:function(source,properties){properties=$extend({onload:$empty,document:document,check:$lambda(true)},properties);if(properties.onLoad)properties.onload=properties.onLoad;var script=new Element('script',{src:source,type:'text/javascript'});var load=properties.onload.bind(script),check=properties.check,doc=properties.document;delete properties.onload;delete properties.check;delete properties.document;script.addEvents({load:load,readystatechange:function(){if(['loaded','complete'].contains(this.readyState))load();}}).set(properties);if(Browser.Engine.webkit419)var checker=(function(){if(!$try(check))return;$clear(checker);load();}).periodical(50);return script.inject(doc.head);},css:function(source,properties){return new Element('link',$merge({rel:'stylesheet',media:'screen',type:'text/css',href:source},properties)).inject(document.head);},image:function(source,properties){properties=$merge({onload:$empty,onabort:$empty,onerror:$empty},properties);var image=new Image();var element=document.id(image)||new Element('img');['load','abort','error'].each(function(name){var type='on'+name;var cap=name.capitalize();if(properties['on'+cap])properties[type]=properties['on'+cap];var event=properties[type];delete properties[type];image[type]=function(){if(!image)return;if(!element.parentNode){element.width=image.width;element.height=image.height;}
image=image.onload=image.onabort=image.onerror=null;event.delay(1,element,element);element.fireEvent(name,element,1);};});image.src=element.src=source;if(image&&image.complete)image.onload.delay(1);return element.set(properties);},images:function(sources,options){options=$merge({onComplete:$empty,onProgress:$empty,onError:$empty,properties:{}},options);sources=$splat(sources);var images=[];var counter=0;return new Elements(sources.map(function(source){return Asset.image(source,$extend(options.properties,{onload:function(){options.onProgress.call(this,counter,sources.indexOf(source));counter++;if(counter==sources.length)options.onComplete();},onerror:function(){options.onError.call(this,counter,sources.indexOf(source));counter++;if(counter==sources.length)options.onComplete();}}));}));}};var Scroller=new Class({Implements:[Events,Options],options:{area:20,velocity:1,onChange:function(x,y){this.element.scrollTo(x,y);},fps:50},initialize:function(element,options){this.setOptions(options);this.element=document.id(element);this.docBody=document.id(this.element.getDocument().body);this.listener=($type(this.element)!='element')?this.docBody:this.element;this.timer=null;this.bound={attach:this.attach.bind(this),detach:this.detach.bind(this),getCoords:this.getCoords.bind(this)};},start:function(){this.listener.addEvents({mouseover:this.bound.attach,mouseout:this.bound.detach});},stop:function(){this.listener.removeEvents({mouseover:this.bound.attach,mouseout:this.bound.detach});this.detach();this.timer=$clear(this.timer);},attach:function(){this.listener.addEvent('mousemove',this.bound.getCoords);},detach:function(){this.listener.removeEvent('mousemove',this.bound.getCoords);this.timer=$clear(this.timer);},getCoords:function(event){this.page=(this.listener.get('tag')=='body')?event.client:event.page;if(!this.timer)this.timer=this.scroll.periodical(Math.round(1000/this.options.fps),this);},scroll:function(){var size=this.element.getSize(),scroll=this.element.getScroll(),pos=this.element!=this.docBody?this.element.getOffsets():{x:0,y:0},scrollSize=this.element.getScrollSize(),change={x:0,y:0};for(var z in this.page){if(this.page[z]<(this.options.area+pos[z])&&scroll[z]!=0){change[z]=(this.page[z]-this.options.area-pos[z])*this.options.velocity;}else if(this.page[z]+this.options.area>(size[z]+pos[z])&&scroll[z]+size[z]!=scrollSize[z]){change[z]=(this.page[z]-size[z]+this.options.area-pos[z])*this.options.velocity;}}
if(change.y||change.x)this.fireEvent('change',[scroll.x+change.x,scroll.y+change.y]);}});