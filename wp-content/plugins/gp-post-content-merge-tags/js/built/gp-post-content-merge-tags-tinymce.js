(()=>{"use strict";function t(t,e){if(!t||t.length<=e)return t;var n=e/2;return t.substr(0,n)+"..."+t.substr(t.length-(n-1),n)}var e=window.jQuery,n=window.jQuery,a=!1,s=window.gppcmtData;window.tinymce.PluginManager.add("gppcmt",(function(r,o){r.addButton("gppcmt",{type:"menubutton",title:"Insert Gravity Forms Merge Tags",image:s.gfBaseUrl+"/images/icon-drop-list.png",classes:"gppcmt",menu:[]});var i=setInterval((function(){r.controlManager.buttons.gppcmt&&(clearInterval(i),c(s.initFormId))}),100);function l(t,e){switch(t){case"form":c(parseInt(e));break;case"back":c(0);break;case"field":r.insertContent(String(e))}}function c(o){void 0===o&&(o=0);var i=n(r.controlManager.buttons.gppcmt.$el.find("button"));i.data("content")||i.data("content",i.html()),i.html('<span style="display:inline-block;width:20px;height:20px;padding:0;text-align:center;"><img src="'+s.gfBaseUrl+'/images/spinner.gif" style="margin-top:2px;" /></span>'),function(n,a){void 0===a&&(a=!0);var s=window.ajaxurl,r=window.gppcmtData;return e.when(e.post(s,{action:"gppcmt_get_form",nonce:r.nonce,formId:n,postId:r.postId})).then((function(n){var s=e.parseJSON(n),r=[];if(s.id){a&&r.push({text:"↩ View All Forms",type:"back",value:-1},{text:"-"}),void 0===window.gf_vars&&(window.gf_vars={}),window.form=s,window.gf_vars.mergeTags=s.mergeTags;var o=new window.gfMergeTagsObj(s).getMergeTags(s.fields,"#content");for(var i in o)if(o.hasOwnProperty(i)){var l=o[i].label,c=o[i].tags;if(!(c.length<=0)){l&&r.push({text:"-"},{text:"- "+l+" -",classes:"header"});for(var g=0;g<c.length;g++)r.push({type:"field",text:t(c[g].label,40),value:c[g].tag,classes:"field"})}}}else for(r.push({text:"- Select a Form -",classes:"header"}),g=0;g<s.length;g++)r.push({type:"form",text:s[g].title,value:s[g].id,classes:"form"});return e.when(r)}))}(o).done((function(t){i.html(i.data("content")),function(t){r.buttons.gppcmt.menu.splice(0,r.buttons.gppcmt.menu.length);for(var e=0;e<t.length;e++)r.buttons.gppcmt.menu.push({text:t[e].text,classes:t[e].classes,onclick:function(t){l(this.type,this.value)}.bind(t[e])})}(t),r.controlManager.buttons.gppcmt.menu=null,a&&n(r.getContainer()).is(":visible")&&r.controlManager.buttons.gppcmt.showMenu(),a=!0}))}}))})();
//# sourceMappingURL=gp-post-content-merge-tags-tinymce.js.map