(()=>{"use strict";const e=window.wp.element,n=window.wp.components,t=window.wp.compose,o=window.wp.blockEditor,r=window.wp.hooks;var a=function(){return(a=Object.assign||function(e){for(var n,t=1,o=arguments.length;t<o;t++)for(var r in n=arguments[t])Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r]);return e}).apply(this,arguments)};const i=function(n){return e.createElement("svg",a({viewBox:"-15 77 581 640",width:24,height:24},n),e.createElement("path",{fill:"#1e1e1e",d:"M489.5 227L315.9 126.8c-22.1-12.8-58.4-12.8-80.5 0L61.8 227c-22.1 12.8-40.3 44.2-40.3 69.7v200.5c0 25.6 18.1 56.9 40.3 69.7l173.6 100.2c22.1 12.8 58.4 12.8 80.5 0L489.5 567c22.2-12.8 40.3-44.2 40.3-69.7V296.8c0-25.6-18.1-57-40.3-69.8zM401 300.4v59.3H241v-59.3h160zM163.3 490.9c-16.4 0-29.6-13.3-29.6-29.6 0-16.4 13.3-29.6 29.6-29.6s29.6 13.3 29.6 29.6-13.3 29.6-29.6 29.6zm0-131.2c-16.4 0-29.6-13.3-29.6-29.6s13.3-29.6 29.6-29.6 29.6 13.3 29.6 29.6-13.3 29.6-29.6 29.6zM241 490.9v-59.3h160v59.3H241z"}))};var l=window.jQuery,c=function(){return(c=Object.assign||function(e){for(var n,t=1,o=arguments.length;t<o;t++)for(var r in n=arguments[t])Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r]);return e}).apply(this,arguments)},u=(0,t.createHigherOrderComponent)((function(t){return function(r){var a=(0,e.useState)(null),u=a[0],s=a[1];return(0,e.useEffect)((function(){var e,n,t,o,r;(null===(e=window.gppcmtData)||void 0===e?void 0:e.initFormId)&&(n=void 0,t=void 0,r=function(){var e,n;return function(e,n){var t,o,r,a,i={label:0,sent:function(){if(1&r[0])throw r[1];return r[1]},trys:[],ops:[]};return a={next:l(0),throw:l(1),return:l(2)},"function"==typeof Symbol&&(a[Symbol.iterator]=function(){return this}),a;function l(a){return function(l){return function(a){if(t)throw new TypeError("Generator is already executing.");for(;i;)try{if(t=1,o&&(r=2&a[0]?o.return:a[0]?o.throw||((r=o.return)&&r.call(o),0):o.next)&&!(r=r.call(o,a[1])).done)return r;switch(o=0,r&&(a=[2&a[0],r.value]),a[0]){case 0:case 1:r=a;break;case 4:return i.label++,{value:a[1],done:!1};case 5:i.label++,o=a[1],a=[0];continue;case 7:a=i.ops.pop(),i.trys.pop();continue;default:if(!((r=(r=i.trys).length>0&&r[r.length-1])||6!==a[0]&&2!==a[0])){i=0;continue}if(3===a[0]&&(!r||a[1]>r[0]&&a[1]<r[3])){i.label=a[1];break}if(6===a[0]&&i.label<r[1]){i.label=r[1],r=a;break}if(r&&i.label<r[2]){i.label=r[2],i.ops.push(a);break}r[2]&&i.ops.pop(),i.trys.pop();continue}a=n.call(e,i)}catch(e){a=[6,e],o=0}finally{t=r=0}if(5&a[0])throw a[1];return{value:a[0]?a[1]:void 0,done:!0}}([a,l])}}}(this,(function(t){switch(t.label){case 0:return e=s,[4,(o=null===(n=window.gppcmtData)||void 0===n?void 0:n.initFormId,r=window.ajaxurl,a=window.gppcmtData,a.postId&&o?l.when(l.post(r,{action:"gppcmt_get_form",nonce:a.nonce,formId:o,postId:a.postId})).then((function(e){var n=l.parseJSON(e);if(n.id){void 0===window.gf_vars&&(window.gf_vars={}),window.form=n,window.gf_vars.mergeTags=n.mergeTags;var t=new window.gfMergeTagsObj(n);return l.when(t.getMergeTags(n.fields,"#content"))}return null})):l.when(null))];case 1:return e.apply(void 0,[t.sent()]),[2]}var o,r,a}))},new((o=void 0)||(o=Promise))((function(e,a){function i(e){try{c(r.next(e))}catch(e){a(e)}}function l(e){try{c(r.throw(e))}catch(e){a(e)}}function c(n){var t;n.done?e(n.value):(t=n.value,t instanceof o?t:new o((function(e){e(t)}))).then(i,l)}c((r=r.apply(n,t||[])).next())})))}),[]),e.createElement(e.Fragment,null,e.createElement(t,c({},r)),e.createElement(o.BlockControls,null,e.createElement(n.Toolbar,null,u&&e.createElement(n.DropdownMenu,{icon:i,label:"Select a merge tag to insert"},(function(t){var o=t.onClose;return e.createElement(e.Fragment,null,Object.values(u).map((function(t){return e.createElement(n.MenuGroup,{key:t.label,label:t.label},t.tags.map((function(t){return e.createElement(n.MenuItem,{key:t.tag,icon:!1,onClick:function(){!function(e,n){var t,o=null===(t=null===window||void 0===window?void 0:window.getSelection())||void 0===t?void 0:t.getRangeAt(0);o?(o.startOffset!==o.endOffset&&o.deleteContents(),o.insertNode(document.createTextNode(e))):console.error("Unable to add merge tag. window.getSelection() may not be available.")}(t.tag),o()}},t.label)})))})))})))))}}),"withInspectorControl");(0,r.addFilter)("editor.BlockEdit","gp-post-content-merge-tags/toolbar",u)})();
//# sourceMappingURL=gp-post-content-merge-tags-gutenberg.js.map