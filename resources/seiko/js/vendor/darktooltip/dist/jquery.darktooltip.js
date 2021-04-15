/*
 * DarkTooltip v0.4.0
 * Simple customizable tooltip with confirm option and 3d effects
 * (c)2014 Rubén Torres - rubentdlh@gmail.com
 * Released under the MIT license
 */
!function(t){function i(t,i){this.bearer=t,this.options=i,this.hideEvent,this.mouseOverMode="hover"==this.options.trigger||"mouseover"==this.options.trigger||"onmouseover"==this.options.trigger}i.prototype={show:function(){var t=this;this.options.modal&&this.modalLayer.css("display","block"),this.tooltip.css("display","block"),t.mouseOverMode&&(this.tooltip.mouseover(function(){clearTimeout(t.hideEvent)}),this.tooltip.mouseout(function(){clearTimeout(t.hideEvent),t.hide()}))},hide:function(){var t=this;this.hideEvent=setTimeout(function(){t.tooltip.hide()},100),t.options.modal&&t.modalLayer.hide(),this.options.onClose()},toggle:function(){this.tooltip.is(":visible")?this.hide():this.show()},addAnimation:function(){switch(this.options.animation){case"none":break;case"fadeIn":this.tooltip.addClass("animated"),this.tooltip.addClass("fadeIn");break;case"flipIn":this.tooltip.addClass("animated"),this.tooltip.addClass("flipIn")}},setContent:function(){if(t(this.bearer).css("cursor","pointer"),this.options.content)this.content=this.options.content;else{if(!this.bearer.attr("data-tooltip"))return;this.content=this.bearer.attr("data-tooltip")}if("#"==this.content.charAt(0)){if(this.options.delete_content){var i=t(this.content).html();t(this.content).html(""),this.content=i,delete i}else t(this.content).hide(),this.content=t(this.content).html();this.contentType="html"}else this.contentType="text";tooltipId="",""!=this.bearer.attr("id")&&(tooltipId="id='darktooltip-"+this.bearer.attr("id")+"'"),this.modalLayer=t("<ins class='darktooltip-modal-layer'></ins>"),this.tooltip=t("<ins "+tooltipId+" class = 'dark-tooltip "+this.options.theme+" "+this.options.size+" "+this.options.gravity+"'><div>"+this.content+"</div><div class = 'tip'></div></ins>"),this.tip=this.tooltip.find(".tip"),t("body").append(this.modalLayer),t("body").append(this.tooltip),"html"==this.contentType&&this.tooltip.css("max-width","none"),this.tooltip.css("opacity",this.options.opacity),this.addAnimation(),this.options.confirm&&this.addConfirm()},setPositions:function(){var t=this.bearer.offset().left,i=this.bearer.offset().top;switch(this.options.gravity){case"south":t+=this.bearer.outerWidth()/2-this.tooltip.outerWidth()/2,i+=-this.tooltip.outerHeight()-this.tip.outerHeight()/2;break;case"west":t+=this.bearer.outerWidth()+this.tip.outerWidth()/2,i+=this.bearer.outerHeight()/2-this.tooltip.outerHeight()/2;break;case"north":t+=this.bearer.outerWidth()/2-this.tooltip.outerWidth()/2,i+=this.bearer.outerHeight()+this.tip.outerHeight()/2;break;case"east":t+=-this.tooltip.outerWidth()-this.tip.outerWidth()/2,i+=this.bearer.outerHeight()/2-this.tooltip.outerHeight()/2}this.options.autoLeft&&this.tooltip.css("left",t),this.options.autoTop&&this.tooltip.css("top",i)},setEvents:function(){var i,o=this,s=o.options.hoverDelay;o.mouseOverMode?this.bearer.mouseenter(function(){i=setTimeout(function(){o.setPositions(),o.show()},s)}).mouseleave(function(){clearTimeout(i),o.hide()}):("click"==this.options.trigger||"onclik"==this.options.trigger)&&(this.tooltip.click(function(t){t.stopPropagation()}),this.bearer.click(function(t){t.preventDefault(),o.setPositions(),o.toggle(),t.stopPropagation()}),t("html").click(function(){o.hide()}))},activate:function(){this.setContent(),this.content&&this.setEvents()},addConfirm:function(){this.tooltip.append("<ul class = 'confirm'><li class = 'darktooltip-yes'>"+this.options.yes+"</li><li class = 'darktooltip-no'>"+this.options.no+"</li></ul>"),this.setConfirmEvents()},setConfirmEvents:function(){var t=this;this.tooltip.find("li.darktooltip-yes").click(function(i){t.onYes(),i.stopPropagation()}),this.tooltip.find("li.darktooltip-no").click(function(i){t.onNo(),i.stopPropagation()})},finalMessage:function(){if(this.options.finalMessage){var t=this;t.tooltip.find("div:first").html(this.options.finalMessage),t.tooltip.find("ul").remove(),t.setPositions(),setTimeout(function(){t.hide(),t.setContent()},t.options.finalMessageDuration)}else this.hide()},onYes:function(){this.options.onYes(this.bearer),this.finalMessage()},onNo:function(){this.options.onNo(this.bearer),this.hide()}},t.fn.darkTooltip=function(o){return this.each(function(){o=t.extend({},t.fn.darkTooltip.defaults,o);var s=new i(t(this),o);s.activate()})},t.fn.darkTooltip.defaults={animation:"none",confirm:!1,content:"",finalMessage:"",finalMessageDuration:1e3,gravity:"south",hoverDelay:0,modal:!1,no:"No",onNo:function(){},onYes:function(){},opacity:.9,size:"medium",theme:"dark",trigger:"hover",yes:"Yes",autoTop:!0,autoLeft:!0,onClose:function(){}}}(jQuery);
