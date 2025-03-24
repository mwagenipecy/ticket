import{a as dt,c as lt}from"./popper-0e930465.js";var vt='<svg width="16" height="6" xmlns="http://www.w3.org/2000/svg"><path d="M0 6s1.796-.013 4.67-3.615C5.851.9 6.93.006 8 0c1.07-.006 2.148.887 3.343 2.385C14.233 6.005 16 6 16 6H0z"></svg>',mt="tippy-box",Pe="tippy-content",ke="tippy-backdrop",je="tippy-arrow",$e="tippy-svg-arrow",L={passive:!0,capture:!0},We=function(){return document.body};function oe(e,r,i){if(Array.isArray(e)){var a=e[r];return a??(Array.isArray(i)?i[r]:i)}return e}function fe(e,r){var i={}.toString.call(e);return i.indexOf("[object")===0&&i.indexOf(r+"]")>-1}function ze(e,r){return typeof e=="function"?e.apply(void 0,r):e}function Re(e,r){if(r===0)return e;var i;return function(a){clearTimeout(i),i=setTimeout(function(){e(a)},r)}}function ht(e){return e.split(/\s+/).filter(Boolean)}function I(e){return[].concat(e)}function Ne(e,r){e.indexOf(r)===-1&&e.push(r)}function gt(e){return e.filter(function(r,i){return e.indexOf(r)===i})}function bt(e){return e.split("-")[0]}function X(e){return[].slice.call(e)}function Ue(e){return Object.keys(e).reduce(function(r,i){return e[i]!==void 0&&(r[i]=e[i]),r},{})}function R(){return document.createElement("div")}function J(e){return["Element","Fragment"].some(function(r){return fe(e,r)})}function yt(e){return fe(e,"NodeList")}function Tt(e){return fe(e,"MouseEvent")}function wt(e){return!!(e&&e._tippy&&e._tippy.reference===e)}function At(e){return J(e)?[e]:yt(e)?X(e):Array.isArray(e)?e:X(document.querySelectorAll(e))}function ae(e,r){e.forEach(function(i){i&&(i.style.transitionDuration=r+"ms")})}function _(e,r){e.forEach(function(i){i&&i.setAttribute("data-state",r)})}function Et(e){var r,i=I(e),a=i[0];return a!=null&&(r=a.ownerDocument)!=null&&r.body?a.ownerDocument:document}function Ot(e,r){var i=r.clientX,a=r.clientY;return e.every(function(d){var l=d.popperRect,u=d.popperState,m=d.props,v=m.interactiveBorder,b=bt(u.placement),h=u.modifiersData.offset;if(!h)return!0;var H=b==="bottom"?h.top.y:0,P=b==="top"?h.bottom.y:0,N=b==="right"?h.left.x:0,O=b==="left"?h.right.x:0,k=l.top-a+H>v,Q=a-l.bottom-P>v,Z=l.left-i+N>v,j=i-l.right-O>v;return k||Q||Z||j})}function se(e,r,i){var a=r+"EventListener";["transitionend","webkitTransitionEnd"].forEach(function(d){e[a](d,i)})}function Ve(e,r){for(var i=r;i;){var a;if(e.contains(i))return!0;i=i.getRootNode==null||(a=i.getRootNode())==null?void 0:a.host}return!1}var E={isTouch:!1},Be=0;function Dt(){E.isTouch||(E.isTouch=!0,window.performance&&document.addEventListener("mousemove",qe))}function qe(){var e=performance.now();e-Be<20&&(E.isTouch=!1,document.removeEventListener("mousemove",qe)),Be=e}function Ct(){var e=document.activeElement;if(wt(e)){var r=e._tippy;e.blur&&!r.state.isVisible&&e.blur()}}function Lt(){document.addEventListener("touchstart",Dt,L),window.addEventListener("blur",Ct)}var St=typeof window<"u"&&typeof document<"u",xt=St?!!window.msCrypto:!1,Mt={animateFill:!1,followCursor:!1,inlinePositioning:!1,sticky:!1},It={allowHTML:!1,animation:"fade",arrow:!0,content:"",inertia:!1,maxWidth:350,role:"tooltip",theme:"",zIndex:9999},w=Object.assign({appendTo:We,aria:{content:"auto",expanded:"auto"},delay:0,duration:[300,250],getReferenceClientRect:null,hideOnClick:!0,ignoreAttributes:!1,interactive:!1,interactiveBorder:2,interactiveDebounce:0,moveTransition:"",offset:[0,10],onAfterUpdate:function(){},onBeforeUpdate:function(){},onCreate:function(){},onDestroy:function(){},onHidden:function(){},onHide:function(){},onMount:function(){},onShow:function(){},onShown:function(){},onTrigger:function(){},onUntrigger:function(){},onClickOutside:function(){},placement:"top",plugins:[],popperOptions:{},render:null,showOnCreate:!1,touch:!0,trigger:"mouseenter focus",triggerTarget:null},Mt,It),Rt=Object.keys(w),Nt=function(r){var i=Object.keys(r);i.forEach(function(a){w[a]=r[a]})};function Ye(e){var r=e.plugins||[],i=r.reduce(function(a,d){var l=d.name,u=d.defaultValue;if(l){var m;a[l]=e[l]!==void 0?e[l]:(m=w[l])!=null?m:u}return a},{});return Object.assign({},e,i)}function Ut(e,r){var i=r?Object.keys(Ye(Object.assign({},w,{plugins:r}))):Rt,a=i.reduce(function(d,l){var u=(e.getAttribute("data-tippy-"+l)||"").trim();if(!u)return d;if(l==="content")d[l]=u;else try{d[l]=JSON.parse(u)}catch{d[l]=u}return d},{});return a}function _e(e,r){var i=Object.assign({},r,{content:ze(r.content,[e])},r.ignoreAttributes?{}:Ut(e,r.plugins));return i.aria=Object.assign({},w.aria,i.aria),i.aria={expanded:i.aria.expanded==="auto"?r.interactive:i.aria.expanded,content:i.aria.content==="auto"?r.interactive?null:"describedby":i.aria.content},i}var Vt=function(){return"innerHTML"};function ce(e,r){e[Vt()]=r}function Fe(e){var r=R();return e===!0?r.className=je:(r.className=$e,J(e)?r.appendChild(e):ce(r,e)),r}function He(e,r){J(r.content)?(ce(e,""),e.appendChild(r.content)):typeof r.content!="function"&&(r.allowHTML?ce(e,r.content):e.textContent=r.content)}function G(e){var r=e.firstElementChild,i=X(r.children);return{box:r,content:i.find(function(a){return a.classList.contains(Pe)}),arrow:i.find(function(a){return a.classList.contains(je)||a.classList.contains($e)}),backdrop:i.find(function(a){return a.classList.contains(ke)})}}function Ke(e){var r=R(),i=R();i.className=mt,i.setAttribute("data-state","hidden"),i.setAttribute("tabindex","-1");var a=R();a.className=Pe,a.setAttribute("data-state","hidden"),He(a,e.props),r.appendChild(i),i.appendChild(a),d(e.props,e.props);function d(l,u){var m=G(r),v=m.box,b=m.content,h=m.arrow;u.theme?v.setAttribute("data-theme",u.theme):v.removeAttribute("data-theme"),typeof u.animation=="string"?v.setAttribute("data-animation",u.animation):v.removeAttribute("data-animation"),u.inertia?v.setAttribute("data-inertia",""):v.removeAttribute("data-inertia"),v.style.maxWidth=typeof u.maxWidth=="number"?u.maxWidth+"px":u.maxWidth,u.role?v.setAttribute("role",u.role):v.removeAttribute("role"),(l.content!==u.content||l.allowHTML!==u.allowHTML)&&He(b,e.props),u.arrow?h?l.arrow!==u.arrow&&(v.removeChild(h),v.appendChild(Fe(u.arrow))):v.appendChild(Fe(u.arrow)):h&&v.removeChild(h)}return{popper:r,onUpdate:d}}Ke.$$tippy=!0;var Bt=1,K=[],ue=[];function _t(e,r){var i=_e(e,Object.assign({},w,Ye(Ue(r)))),a,d,l,u=!1,m=!1,v=!1,b=!1,h,H,P,N=[],O=Re(Oe,i.interactiveDebounce),k,Q=Bt++,Z=null,j=gt(i.plugins),Xe={isEnabled:!0,isVisible:!1,isDestroyed:!1,isMounted:!1,isShown:!1},t={id:Q,reference:e,popper:R(),popperInstance:Z,props:i,state:Xe,plugins:j,clearDelayTimeouts:rt,setProps:it,setContent:ot,show:at,hide:st,hideWithInteractivity:ut,enable:tt,disable:nt,unmount:ct,destroy:ft};if(!i.render)return t;var pe=i.render(t),f=pe.popper,de=pe.onUpdate;f.setAttribute("data-tippy-root",""),f.id="tippy-"+t.id,t.popper=f,e._tippy=t,f._tippy=t;var Ge=j.map(function(n){return n.fn(t)}),Je=e.hasAttribute("aria-expanded");return we(),B(),$(),y("onCreate",[t]),i.showOnCreate&&Me(),f.addEventListener("mouseenter",function(){t.props.interactive&&t.state.isVisible&&t.clearDelayTimeouts()}),f.addEventListener("mouseleave",function(){t.props.interactive&&t.props.trigger.indexOf("mouseenter")>=0&&U().addEventListener("mousemove",O)}),t;function le(){var n=t.props.touch;return Array.isArray(n)?n:[n,0]}function ve(){return le()[0]==="hold"}function A(){var n;return!!((n=t.props.render)!=null&&n.$$tippy)}function D(){return k||e}function U(){var n=D().parentNode;return n?Et(n):document}function V(){return G(f)}function me(n){return t.state.isMounted&&!t.state.isVisible||E.isTouch||h&&h.type==="focus"?0:oe(t.props.delay,n?0:1,w.delay)}function $(n){n===void 0&&(n=!1),f.style.pointerEvents=t.props.interactive&&!n?"":"none",f.style.zIndex=""+t.props.zIndex}function y(n,o,s){if(s===void 0&&(s=!0),Ge.forEach(function(c){c[n]&&c[n].apply(c,o)}),s){var p;(p=t.props)[n].apply(p,o)}}function he(){var n=t.props.aria;if(n.content){var o="aria-"+n.content,s=f.id,p=I(t.props.triggerTarget||e);p.forEach(function(c){var g=c.getAttribute(o);if(t.state.isVisible)c.setAttribute(o,g?g+" "+s:s);else{var T=g&&g.replace(s,"").trim();T?c.setAttribute(o,T):c.removeAttribute(o)}})}}function B(){if(!(Je||!t.props.aria.expanded)){var n=I(t.props.triggerTarget||e);n.forEach(function(o){t.props.interactive?o.setAttribute("aria-expanded",t.state.isVisible&&o===D()?"true":"false"):o.removeAttribute("aria-expanded")})}}function ee(){U().removeEventListener("mousemove",O),K=K.filter(function(n){return n!==O})}function W(n){if(!(E.isTouch&&(v||n.type==="mousedown"))){var o=n.composedPath&&n.composedPath()[0]||n.target;if(!(t.props.interactive&&Ve(f,o))){if(I(t.props.triggerTarget||e).some(function(s){return Ve(s,o)})){if(E.isTouch||t.state.isVisible&&t.props.trigger.indexOf("click")>=0)return}else y("onClickOutside",[t,n]);t.props.hideOnClick===!0&&(t.clearDelayTimeouts(),t.hide(),m=!0,setTimeout(function(){m=!1}),t.state.isMounted||te())}}}function ge(){v=!0}function be(){v=!1}function ye(){var n=U();n.addEventListener("mousedown",W,!0),n.addEventListener("touchend",W,L),n.addEventListener("touchstart",be,L),n.addEventListener("touchmove",ge,L)}function te(){var n=U();n.removeEventListener("mousedown",W,!0),n.removeEventListener("touchend",W,L),n.removeEventListener("touchstart",be,L),n.removeEventListener("touchmove",ge,L)}function Qe(n,o){Te(n,function(){!t.state.isVisible&&f.parentNode&&f.parentNode.contains(f)&&o()})}function Ze(n,o){Te(n,o)}function Te(n,o){var s=V().box;function p(c){c.target===s&&(se(s,"remove",p),o())}if(n===0)return o();se(s,"remove",H),se(s,"add",p),H=p}function S(n,o,s){s===void 0&&(s=!1);var p=I(t.props.triggerTarget||e);p.forEach(function(c){c.addEventListener(n,o,s),N.push({node:c,eventType:n,handler:o,options:s})})}function we(){ve()&&(S("touchstart",Ee,{passive:!0}),S("touchend",De,{passive:!0})),ht(t.props.trigger).forEach(function(n){if(n!=="manual")switch(S(n,Ee),n){case"mouseenter":S("mouseleave",De);break;case"focus":S(xt?"focusout":"blur",Ce);break;case"focusin":S("focusout",Ce);break}})}function Ae(){N.forEach(function(n){var o=n.node,s=n.eventType,p=n.handler,c=n.options;o.removeEventListener(s,p,c)}),N=[]}function Ee(n){var o,s=!1;if(!(!t.state.isEnabled||Le(n)||m)){var p=((o=h)==null?void 0:o.type)==="focus";h=n,k=n.currentTarget,B(),!t.state.isVisible&&Tt(n)&&K.forEach(function(c){return c(n)}),n.type==="click"&&(t.props.trigger.indexOf("mouseenter")<0||u)&&t.props.hideOnClick!==!1&&t.state.isVisible?s=!0:Me(n),n.type==="click"&&(u=!s),s&&!p&&z(n)}}function Oe(n){var o=n.target,s=D().contains(o)||f.contains(o);if(!(n.type==="mousemove"&&s)){var p=ne().concat(f).map(function(c){var g,T=c._tippy,x=(g=T.popperInstance)==null?void 0:g.state;return x?{popperRect:c.getBoundingClientRect(),popperState:x,props:i}:null}).filter(Boolean);Ot(p,n)&&(ee(),z(n))}}function De(n){var o=Le(n)||t.props.trigger.indexOf("click")>=0&&u;if(!o){if(t.props.interactive){t.hideWithInteractivity(n);return}z(n)}}function Ce(n){t.props.trigger.indexOf("focusin")<0&&n.target!==D()||t.props.interactive&&n.relatedTarget&&f.contains(n.relatedTarget)||z(n)}function Le(n){return E.isTouch?ve()!==n.type.indexOf("touch")>=0:!1}function Se(){xe();var n=t.props,o=n.popperOptions,s=n.placement,p=n.offset,c=n.getReferenceClientRect,g=n.moveTransition,T=A()?G(f).arrow:null,x=c?{getBoundingClientRect:c,contextElement:c.contextElement||D()}:e,Ie={name:"$$tippy",enabled:!0,phase:"beforeWrite",requires:["computeStyles"],fn:function(q){var M=q.state;if(A()){var pt=V(),ie=pt.box;["placement","reference-hidden","escaped"].forEach(function(Y){Y==="placement"?ie.setAttribute("data-placement",M.placement):M.attributes.popper["data-popper-"+Y]?ie.setAttribute("data-"+Y,""):ie.removeAttribute("data-"+Y)}),M.attributes.popper={}}}},C=[{name:"offset",options:{offset:p}},{name:"preventOverflow",options:{padding:{top:2,bottom:2,left:5,right:5}}},{name:"flip",options:{padding:5}},{name:"computeStyles",options:{adaptive:!g}},Ie];A()&&T&&C.push({name:"arrow",options:{element:T,padding:3}}),C.push.apply(C,(o==null?void 0:o.modifiers)||[]),t.popperInstance=lt(x,f,Object.assign({},o,{placement:s,onFirstUpdate:P,modifiers:C}))}function xe(){t.popperInstance&&(t.popperInstance.destroy(),t.popperInstance=null)}function et(){var n=t.props.appendTo,o,s=D();t.props.interactive&&n===We||n==="parent"?o=s.parentNode:o=ze(n,[s]),o.contains(f)||o.appendChild(f),t.state.isMounted=!0,Se()}function ne(){return X(f.querySelectorAll("[data-tippy-root]"))}function Me(n){t.clearDelayTimeouts(),n&&y("onTrigger",[t,n]),ye();var o=me(!0),s=le(),p=s[0],c=s[1];E.isTouch&&p==="hold"&&c&&(o=c),o?a=setTimeout(function(){t.show()},o):t.show()}function z(n){if(t.clearDelayTimeouts(),y("onUntrigger",[t,n]),!t.state.isVisible){te();return}if(!(t.props.trigger.indexOf("mouseenter")>=0&&t.props.trigger.indexOf("click")>=0&&["mouseleave","mousemove"].indexOf(n.type)>=0&&u)){var o=me(!1);o?d=setTimeout(function(){t.state.isVisible&&t.hide()},o):l=requestAnimationFrame(function(){t.hide()})}}function tt(){t.state.isEnabled=!0}function nt(){t.hide(),t.state.isEnabled=!1}function rt(){clearTimeout(a),clearTimeout(d),cancelAnimationFrame(l)}function it(n){if(!t.state.isDestroyed){y("onBeforeUpdate",[t,n]),Ae();var o=t.props,s=_e(e,Object.assign({},o,Ue(n),{ignoreAttributes:!0}));t.props=s,we(),o.interactiveDebounce!==s.interactiveDebounce&&(ee(),O=Re(Oe,s.interactiveDebounce)),o.triggerTarget&&!s.triggerTarget?I(o.triggerTarget).forEach(function(p){p.removeAttribute("aria-expanded")}):s.triggerTarget&&e.removeAttribute("aria-expanded"),B(),$(),de&&de(o,s),t.popperInstance&&(Se(),ne().forEach(function(p){requestAnimationFrame(p._tippy.popperInstance.forceUpdate)})),y("onAfterUpdate",[t,n])}}function ot(n){t.setProps({content:n})}function at(){var n=t.state.isVisible,o=t.state.isDestroyed,s=!t.state.isEnabled,p=E.isTouch&&!t.props.touch,c=oe(t.props.duration,0,w.duration);if(!(n||o||s||p)&&!D().hasAttribute("disabled")&&(y("onShow",[t],!1),t.props.onShow(t)!==!1)){if(t.state.isVisible=!0,A()&&(f.style.visibility="visible"),$(),ye(),t.state.isMounted||(f.style.transition="none"),A()){var g=V(),T=g.box,x=g.content;ae([T,x],0)}P=function(){var C;if(!(!t.state.isVisible||b)){if(b=!0,f.offsetHeight,f.style.transition=t.props.moveTransition,A()&&t.props.animation){var re=V(),q=re.box,M=re.content;ae([q,M],c),_([q,M],"visible")}he(),B(),Ne(ue,t),(C=t.popperInstance)==null||C.forceUpdate(),y("onMount",[t]),t.props.animation&&A()&&Ze(c,function(){t.state.isShown=!0,y("onShown",[t])})}},et()}}function st(){var n=!t.state.isVisible,o=t.state.isDestroyed,s=!t.state.isEnabled,p=oe(t.props.duration,1,w.duration);if(!(n||o||s)&&(y("onHide",[t],!1),t.props.onHide(t)!==!1)){if(t.state.isVisible=!1,t.state.isShown=!1,b=!1,u=!1,A()&&(f.style.visibility="hidden"),ee(),te(),$(!0),A()){var c=V(),g=c.box,T=c.content;t.props.animation&&(ae([g,T],p),_([g,T],"hidden"))}he(),B(),t.props.animation?A()&&Qe(p,t.unmount):t.unmount()}}function ut(n){U().addEventListener("mousemove",O),Ne(K,O),O(n)}function ct(){t.state.isVisible&&t.hide(),t.state.isMounted&&(xe(),ne().forEach(function(n){n._tippy.unmount()}),f.parentNode&&f.parentNode.removeChild(f),ue=ue.filter(function(n){return n!==t}),t.state.isMounted=!1,y("onHidden",[t]))}function ft(){t.state.isDestroyed||(t.clearDelayTimeouts(),t.unmount(),Ae(),delete e._tippy,t.state.isDestroyed=!0,y("onDestroy",[t]))}}function F(e,r){r===void 0&&(r={});var i=w.plugins.concat(r.plugins||[]);Lt();var a=Object.assign({},r,{plugins:i}),d=At(e),l=d.reduce(function(u,m){var v=m&&_t(m,a);return v&&u.push(v),u},[]);return J(e)?l[0]:l}F.defaultProps=w;F.setDefaultProps=Nt;F.currentInput=E;Object.assign({},dt,{effect:function(r){var i=r.state,a={popper:{position:i.options.strategy,left:"0",top:"0",margin:"0"},arrow:{position:"absolute"},reference:{}};Object.assign(i.elements.popper.style,a.popper),i.styles=a,i.elements.arrow&&Object.assign(i.elements.arrow.style,a.arrow)}});var Ft={name:"animateFill",defaultValue:!1,fn:function(r){var i;if(!((i=r.props.render)!=null&&i.$$tippy))return{};var a=G(r.popper),d=a.box,l=a.content,u=r.props.animateFill?Ht():null;return{onCreate:function(){u&&(d.insertBefore(u,d.firstElementChild),d.setAttribute("data-animatefill",""),d.style.overflow="hidden",r.setProps({arrow:!1,animation:"shift-away"}))},onMount:function(){if(u){var v=d.style.transitionDuration,b=Number(v.replace("ms",""));l.style.transitionDelay=Math.round(b/10)+"ms",u.style.transitionDuration=v,_([u],"visible")}},onShow:function(){u&&(u.style.transitionDuration="0ms")},onHide:function(){u&&_([u],"hidden")}}}};function Ht(){var e=R();return e.className=ke,_([e],"hidden"),e}F.setDefaultProps({render:Ke});window.tippy=F;window.roundArrow=vt;window.animateFillPlugin=Ft;
