!function(){var e={184:function(e,t){var a;!function(){"use strict";var r={}.hasOwnProperty;function n(){for(var e=[],t=0;t<arguments.length;t++){var a=arguments[t];if(a){var s=typeof a;if("string"===s||"number"===s)e.push(a);else if(Array.isArray(a)&&a.length){var o=n.apply(null,a);o&&e.push(o)}else if("object"===s)for(var i in a)r.call(a,i)&&a[i]&&e.push(i)}}return e.join(" ")}e.exports?(n.default=n,e.exports=n):void 0===(a=function(){return n}.apply(t,[]))||(e.exports=a)}()},573:function(e){"use strict";var t=/["'&<>]/;e.exports=function(e){var a,r=""+e,n=t.exec(r);if(!n)return r;var s="",o=0,i=0;for(o=n.index;o<r.length;o++){switch(r.charCodeAt(o)){case 34:a="&quot;";break;case 38:a="&amp;";break;case 39:a="&#39;";break;case 60:a="&lt;";break;case 62:a="&gt;";break;default:continue}i!==o&&(s+=r.substring(i,o)),i=o+1,s+=a}return i!==o?s+r.substring(i,o):s}}},t={};function a(r){var n=t[r];if(void 0!==n)return n.exports;var s=t[r]={exports:{}};return e[r](s,s.exports,a),s.exports}a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,{a:t}),t},a.d=function(e,t){for(var r in t)a.o(t,r)&&!a.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},a.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){"use strict";var e=window.wp.element,t=window.wp.i18n,r=window.wp.blocks,n=window.wp.blockEditor,s=window.wp.components,o=window.wp.apiFetch,i=a.n(o);class l extends e.Component{render(){const{className:t,episodeRef:a,episodeId:r,episodes:n,activateEpisode:s}=this.props;return(0,e.createElement)("div",{className:t},"Select podcast Episode",(0,e.createElement)("select",{ref:a,className:"castos-select",defaultValue:r},n.map(((t,a)=>(0,e.createElement)("option",{key:t.id,value:t.id},t.title)))),(0,e.createElement)("button",{className:"button",onClick:s},"Go"))}}var c=l,d=window.React,p=a.n(d),m=a(573),u=a.n(m);function h(){return h=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var a=arguments[t];for(var r in a)Object.prototype.hasOwnProperty.call(a,r)&&(e[r]=a[r])}return e},h.apply(this,arguments)}function y(e,t){if(null==e)return{};var a,r,n={},s=Object.keys(e);for(r=0;r<s.length;r++)a=s[r],t.indexOf(a)>=0||(n[a]=e[a]);return n}function f(e){var t=e.attributes,a=void 0===t?{}:t,r=e.children,n=void 0===r?null:r,s=e.selfClose,o=void 0!==s&&s,i=e.tagName;return o?p().createElement(i,a):p().createElement(i,a,n)}var b=function(){function e(){}var t=e.prototype;return t.attribute=function(e,t){return t},t.node=function(e,t){return t},e}(),g=/(url|image|image-set)\(/i,v=function(e){var t,a;function r(){return e.apply(this,arguments)||this}return a=e,(t=r).prototype=Object.create(a.prototype),t.prototype.constructor=t,t.__proto__=a,r.prototype.attribute=function(e,t){return"style"===e&&Object.keys(t).forEach((function(e){String(t[e]).match(g)&&delete t[e]})),t},r}(b),E={a:{content:9,self:!1,type:105},address:{invalid:["h1","h2","h3","h4","h5","h6","address","article","aside","section","div","header","footer"],self:!1},audio:{children:["track","source"]},br:{type:9,void:!0},body:{content:127},button:{content:8,type:105},caption:{content:1,parent:["table"]},col:{parent:["colgroup"],void:!0},colgroup:{children:["col"],parent:["table"]},details:{children:["summary"],type:97},dd:{content:1,parent:["dl"]},dl:{children:["dt","dd"],type:1},dt:{content:1,invalid:["footer","header"],parent:["dl"]},figcaption:{content:1,parent:["figure"]},footer:{invalid:["footer","header"]},header:{invalid:["footer","header"]},hr:{type:1,void:!0},img:{void:!0},li:{content:1,parent:["ul","ol","menu"]},main:{self:!1},ol:{children:["li"],type:1},picture:{children:["source","img"],type:25},rb:{parent:["ruby","rtc"]},rp:{parent:["ruby","rtc"]},rt:{content:8,parent:["ruby","rtc"]},rtc:{content:8,parent:["ruby"]},ruby:{children:["rb","rp","rt","rtc"]},source:{parent:["audio","video","picture"],void:!0},summary:{content:8,parent:["details"]},table:{children:["caption","colgroup","thead","tbody","tfoot","tr"],type:1},tbody:{parent:["table"],children:["tr"]},td:{content:1,parent:["tr"]},tfoot:{parent:["table"],children:["tr"]},th:{content:1,parent:["tr"]},thead:{parent:["table"],children:["tr"]},tr:{parent:["table","tbody","thead","tfoot"],children:["th","td"]},track:{parent:["audio","video"],void:!0},ul:{children:["li"],type:1},video:{children:["track","source"]},wbr:{type:9,void:!0}};function N(e){return function(t){E[t]=h({},e,E[t])}}["address","main","div","figure","p","pre"].forEach(N({content:1,type:65})),["abbr","b","bdi","bdo","cite","code","data","dfn","em","i","kbd","mark","q","ruby","samp","strong","sub","sup","time","u","var"].forEach(N({content:8,type:73})),["p","pre"].forEach(N({content:8,type:65})),["s","small","span","del","ins"].forEach(N({content:8,type:9})),["article","aside","footer","header","nav","section","blockquote"].forEach(N({content:1,type:67})),["h1","h2","h3","h4","h5","h6"].forEach(N({content:8,type:69})),["audio","canvas","iframe","img","video"].forEach(N({type:89}));var w=Object.freeze(E),_=["applet","base","body","command","embed","frame","frameset","head","html","link","meta","noscript","object","script","style","title"],k=Object.keys(w).filter((function(e){return"canvas"!==e&&"iframe"!==e})),x=Object.freeze({alt:1,cite:1,class:1,colspan:3,controls:4,datetime:1,default:4,disabled:4,dir:1,height:1,href:1,id:1,kind:1,label:1,lang:1,loading:1,loop:4,media:1,muted:4,poster:1,role:1,rowspan:3,scope:1,sizes:1,span:3,start:3,style:5,src:1,srclang:1,srcset:1,target:1,title:1,type:1,width:1}),C=Object.freeze({class:"className",colspan:"colSpan",datetime:"dateTime",rowspan:"rowSpan",srclang:"srcLang",srcset:"srcSet"}),F=/^<(!doctype|(html|head|body)(\s|>))/i,P=/^(aria\x2D|data\x2D|[0-9A-Z_a-z\u017F\u212A]+:)/i,S=/{{{(\w+)\/?}}}/;function T(){if("undefined"!=typeof window&&"undefined"!=typeof document)return document.implementation.createHTMLDocument("Interweave")}var I,A=function(){function e(e,t,a,r){void 0===t&&(t={}),void 0===a&&(a=[]),void 0===r&&(r=[]),this.allowed=void 0,this.banned=void 0,this.blocked=void 0,this.container=void 0,this.content=[],this.props=void 0,this.matchers=void 0,this.filters=void 0,this.keyIndex=void 0,this.props=t,this.matchers=a,this.filters=[].concat(r,[new v]),this.keyIndex=-1,this.container=this.createContainer(e||""),this.allowed=new Set(t.allowList||k),this.banned=new Set(_),this.blocked=new Set(t.blockList)}var t=e.prototype;return t.applyAttributeFilters=function(e,t){return this.filters.reduce((function(t,a){return null!==t&&"function"==typeof a.attribute?a.attribute(e,t):t}),t)},t.applyNodeFilters=function(e,t){return this.filters.reduce((function(t,a){return null!==t&&"function"==typeof a.node?a.node(e,t):t}),t)},t.applyMatchers=function(e,t){var a=this,r={},n=this.props,s=e,o=0,i=null;return this.matchers.forEach((function(e){var l=e.asTag().toLowerCase(),c=a.getTagConfig(l);if(!n[e.inverseName]&&a.isTagAllowed(l)&&a.canRenderChild(t,c)){for(var d="";s&&(i=e.match(s));){var p=i,m=p.index,u=p.length,f=p.match,b=p.valid,g=p.void,v=y(p,["index","length","match","valid","void"]),E=e.propName+o;m>0&&(d+=s.slice(0,m)),b?(d+=g?"{{{"+E+"/}}}":"{{{"+E+"}}}"+f+"{{{/"+E+"}}}",a.keyIndex+=1,o+=1,r[E]={children:f,matcher:e,props:h({},n,v,{key:a.keyIndex})}):d+=f,e.greedy?(s=d+s.slice(m+u),d=""):s=s.slice(m+(u||f.length))}e.greedy||(s=d+s)}})),0===o?e:this.replaceTokens(s,r)},t.canRenderChild=function(e,t){return!(!e.tagName||!t.tagName)&&!e.void&&(e.children.length>0?e.children.includes(t.tagName):!(e.invalid.length>0&&e.invalid.includes(t.tagName))&&(t.parent.length>0?t.parent.includes(e.tagName):!(!e.self&&e.tagName===t.tagName)&&Boolean(e&&e.content&t.type)))},t.convertLineBreaks=function(e){var t=this.props,a=t.noHtml,r=t.disableLineBreaks;if(a||r||e.match(/<((?:\/[ a-z]+)|(?:[ a-z]+\/))>/gi))return e;var n=e.replace(/\r\n/g,"\n");return(n=n.replace(/\n{3,}/g,"\n\n\n")).replace(/\n/g,"<br/>")},t.createContainer=function(e){var t=(a.g.INTERWEAVE_SSR_POLYFILL||T)();if(t){var r=this.props.containerTagName||"body",n="body"===r||"fragment"===r?t.body:t.createElement(r);return e.match(F)||(n.innerHTML=this.convertLineBreaks(this.props.escapeHtml?u()(e):e)),n}},t.extractAttributes=function(e){var t=this,a=this.props.allowAttributes,r={},n=0;return 1===e.nodeType&&e.attributes?(Array.from(e.attributes).forEach((function(s){var o=s.name,i=s.value,l=o.toLowerCase(),c=x[l]||x[o];if(t.isSafe(e)&&(l.match(P)||(a||c&&2!==c)&&!l.match(/^on/)&&!i.replace(/(\s|\0|&#x0([9AD]);)/,"").match(/(javascript|vbscript|livescript|xss):/i))){var d="style"===l?t.extractStyleAttribute(e):i;4===c?d=!0:3===c?d=Number.parseFloat(String(d)):5!==c&&(d=String(d)),r[C[l]||l]=t.applyAttributeFilters(l,d),n+=1}})),0===n?null:r):null},t.extractStyleAttribute=function(e){var t={};return Array.from(e.style).forEach((function(a){var r=e.style[a];"string"!=typeof r&&"number"!=typeof r||(t[a.replace(/-([a-z])/g,(function(e,t){return t.toUpperCase()}))]=r)})),t},t.getTagConfig=function(e){var t={children:[],content:0,invalid:[],parent:[],self:!0,tagName:"",type:0,void:!1};return w[e]?h({},t,w[e],{tagName:e}):t},t.isSafe=function(e){if("undefined"!=typeof HTMLAnchorElement&&e instanceof HTMLAnchorElement){var t=e.getAttribute("href");if(t&&"#"===t.charAt(0))return!0;var a=e.protocol.toLowerCase();return":"===a||"http:"===a||"https:"===a||"mailto:"===a||"tel:"===a}return!0},t.isTagAllowed=function(e){return!this.banned.has(e)&&!this.blocked.has(e)&&(this.props.allowElements||this.allowed.has(e))},t.parse=function(){return this.container?this.parseNode(this.container,this.getTagConfig(this.container.nodeName.toLowerCase())):[]},t.parseNode=function(e,t){var a=this,r=this.props,n=r.noHtml,s=r.noHtmlExceptMatchers,o=r.allowElements,i=r.transform,l=[],c="";return Array.from(e.childNodes).forEach((function(e){if(1===e.nodeType){var r=e.nodeName.toLowerCase(),d=a.getTagConfig(r);c&&(l.push(c),c="");var m,u=a.applyNodeFilters(r,e);if(!u)return;if(i){a.keyIndex+=1;var y=a.keyIndex;m=a.parseNode(u,d);var b=i(u,m,d);if(null===b)return;if(void 0!==b)return void l.push(p().cloneElement(b,{key:y}));a.keyIndex=y-1}if(a.banned.has(r))return;if(n||s&&"br"!==r||!a.isTagAllowed(r)||!o&&!a.canRenderChild(t,d))l=l.concat(a.parseNode(u,d.tagName?d:t));else{a.keyIndex+=1;var g=a.extractAttributes(u),v={tagName:r};g&&(v.attributes=g),d.void&&(v.selfClose=d.void),l.push(p().createElement(f,h({},v,{key:a.keyIndex}),m||a.parseNode(u,d)))}}else if(3===e.nodeType){var E=n&&!s?e.textContent:a.applyMatchers(e.textContent||"",t);Array.isArray(E)?l=l.concat(E):c+=E}})),c&&l.push(c),l},t.replaceTokens=function(e,t){if(!e.includes("{{{"))return e;for(var a=[],r=e,n=null;n=r.match(S);){var s=n,o=s[0],i=s[1],l=n.index,c=o.includes("/");l>0&&(a.push(r.slice(0,l)),r=r.slice(l));var d=t[i],p=d.children,m=d.matcher,u=d.props,h=void 0;if(c)h=o.length,a.push(m.createElement(p,u));else{var y=r.match(new RegExp("{{{/"+i+"}}}"));h=y.index+y[0].length,a.push(m.createElement(this.replaceTokens(r.slice(o.length,y.index),t),u))}r=r.slice(h)}return r.length>0&&a.push(r),0===a.length?"":1===a.length&&"string"==typeof a[0]?a[0]:a},e}();function R(e){var t,a=e.attributes,r=e.containerTagName,n=e.content,s=e.emptyContent,o=e.parsedContent,i=e.tagName,l=r||i||"div",c="fragment"===l||e.noWrap;if(o)t=o;else{var d=new A(n||"",e).parse();d.length>0&&(t=d)}return t||(t=s),c?p().createElement(p().Fragment,null,t):p().createElement(f,{attributes:a,tagName:l},t)}(I=function(e,t,a){this.greedy=!1,this.options=void 0,this.propName=void 0,this.inverseName=void 0,this.factory=void 0,this.options=h({},t),this.propName=e,this.inverseName="no"+(e.charAt(0).toUpperCase()+e.slice(1)),this.factory=a||null}.prototype).createElement=function(e,t){return this.factory?p().createElement(this.factory,t,e):this.replaceWith(e,t)},I.doMatch=function(e,t,a,r){return void 0===r&&(r=!1),function(e,t,a,r){void 0===r&&(r=!1);var n=e.match(t instanceof RegExp?t:new RegExp(t,"i"));return n?h({match:n[0],void:r},a(n),{index:n.index,length:n[0].length,valid:!0}):null}(e,t,a,r)},I.onBeforeParse=function(e,t){return e},I.onAfterParse=function(e,t){return e};var D=function(e){var t=e.attributes,a=e.content,r=void 0===a?"":a,n=e.disableFilters,s=void 0!==n&&n,o=e.disableMatchers,i=void 0!==o&&o,l=e.emptyContent,c=void 0===l?null:l,d=e.filters,m=void 0===d?[]:d,u=e.matchers,h=void 0===u?[]:u,f=e.onAfterParse,b=void 0===f?null:f,g=e.onBeforeParse,v=void 0===g?null:g,E=e.tagName,N=void 0===E?"span":E,w=e.noWrap,_=void 0!==w&&w,k=y(e,["attributes","content","disableFilters","disableMatchers","emptyContent","filters","matchers","onAfterParse","onBeforeParse","tagName","noWrap"]),x=i?[]:h,C=s?[]:m,F=v?[v]:[],P=b?[b]:[];x.forEach((function(e){e.onBeforeParse&&F.push(e.onBeforeParse.bind(e)),e.onAfterParse&&P.push(e.onAfterParse.bind(e))}));var S=F.reduce((function(t,a){return a(t,e)}),r||""),T=new A(S,k,x,C),I=P.reduce((function(t,a){return a(t,e)}),T.parse());return p().createElement(R,{attributes:t,containerTagName:e.containerTagName,emptyContent:c,tagName:N,noWrap:_,parsedContent:0===I.length?void 0:I})};class O extends e.Component{render(){return(0,e.createElement)("p",{className:this.props.className},(0,e.createElement)(D,{content:this.props.audioPlayer}))}}var B=O;class j extends e.Component{constructor(e){let{attributes:t,setAttributes:a,className:r}=e;super(...arguments),this.episodeRef=React.createRef();let n=!0;t.audio_player&&(n=!1);const s={audioPlayer:t.audio_player||""};this.state={className:r,editing:n,episode:s,episodes:[],setAttributes:a}}componentDidMount(){i()({path:"ssp/v1/episodes"}).then((e=>{let t=[];Object.keys(e).map((function(a){let r={id:e[a].id,title:e[a].title.rendered};t.push(r)})),this.setState({episodes:t})}))}render(){const{editing:a,episodes:r,episode:o,className:l,setAttributes:d}=this.state,p=(0,e.createElement)(n.BlockControls,{key:"controls"},(0,e.createElement)(s.Toolbar,null,(0,e.createElement)(s.Button,{className:"components-icon-button components-toolbar__control",label:(0,t.__)("Select Podcast","seriously-simple-podcasting"),onClick:()=>{this.setState({editing:!0})},icon:"edit"})));return a?(0,e.createElement)(c,{className:l,episodeRef:this.episodeRef,episodes:r,activateEpisode:()=>{const e=this.episodeRef.current.value,t="ssp/v1/audio_player?ssp_podcast_id="+e;i()({path:t}).then((t=>{const a={episodeId:e,audioPlayer:t.audio_player};this.setState({episode:a,editing:!1}),d({id:e,audio_player:a.audioPlayer})}))}}):[p,(0,e.createElement)(B,{className:l,audioPlayer:o.audioPlayer})]}}var U=j,L=a(184),M=a.n(L);class z extends e.Component{render(){const{className:t,episodeId:a,episodeTitle:r,episodeFileUrl:n,episodeData:s}=this.props,{rssFeedUrl:o,subscribeUrls:i,embedCode:l}=s,c=[];return Object.keys(i).forEach(((t,a)=>{const r=i[t].url;if(""!==r){const a=i[t].key,n=i[t].label,s="Subscribe on "+i[t].label;c.push((0,e.createElement)("a",{key:t,href:r,target:"_blank",className:a,title:s,rel:"noopener noreferrer"},(0,e.createElement)("span",null),n))}})),(0,e.createElement)("div",{className:"player-panels player-panels-"+a},(0,e.createElement)("div",{className:"subscribe player-panel subscribe-"+a},(0,e.createElement)("div",{className:"close-btn close-btn-"+a},(0,e.createElement)("span",null),(0,e.createElement)("span",null)),(0,e.createElement)("div",{className:"panel__inner"},(0,e.createElement)("div",{className:"subscribe-icons"},c),(0,e.createElement)("div",{className:"player-panel-row"},(0,e.createElement)("div",{className:"title"},"RSS Feed"),(0,e.createElement)("div",null,(0,e.createElement)("input",{readOnly:!0,value:o,className:"input-rss input-rss-"+a})),(0,e.createElement)("button",{className:"copy-rss copy-rss-"+a})))),(0,e.createElement)("div",{className:"share share-"+a+" player-panel"},(0,e.createElement)("div",{className:"close-btn close-btn-"+a},(0,e.createElement)("span",null),(0,e.createElement)("span",null)),(0,e.createElement)("div",{className:"player-panel-row"},(0,e.createElement)("div",{className:"title"},"Share"),(0,e.createElement)("div",{className:"icons-holder"},(0,e.createElement)("a",{href:"https://www.facebook.com/sharer/sharer.php?u="+n+"&t="+r,target:"_blank",className:"share-icon facebook",title:"Share on Facebook",rel:"noopener noreferrer"},(0,e.createElement)("span",null)),(0,e.createElement)("a",{href:"https://twitter.com/intent/tweet?text="+n+"&url="+r,target:"_blank",className:"share-icon twitter",title:"Share on Twitter",rel:"noopener noreferrer"},(0,e.createElement)("span",null)),(0,e.createElement)("a",{href:n,target:"_blank",className:"share-icon download",title:"Download",rel:"noopener noreferrer"},(0,e.createElement)("span",null)))),(0,e.createElement)("div",{className:"player-panel-row"},(0,e.createElement)("div",{className:"title"},"Link"),(0,e.createElement)("div",null,(0,e.createElement)("input",{readOnly:!0,value:n,className:"input-link input-link-"+a})),(0,e.createElement)("button",{className:"copy-link copy-link-"+a})),(0,e.createElement)("div",{className:"player-panel-row"},(0,e.createElement)("div",{className:"title"},"Embed"),(0,e.createElement)("div",{style:{height:"10px"}},(0,e.createElement)("input",{readOnly:!0,value:l,className:"input-embed input-embed-"+a})),(0,e.createElement)("button",{className:"copy-embed copy-embed-"+a}))))}}var H=z;class W extends e.Component{render(){try{const{className:t,episodeId:a,episodeImage:r,episodeTitle:n,episodeFileUrl:s,episodeDuration:o,episodeData:i}=this.props,{playerMode:l}=i,c=M()(t,"castos-player",l+"-mode"),d={background:"url("+r+") center center no-repeat",WebkitBackgroundSize:"cover",backgroundSize:"cover"},p="player__artwork player__artwork-"+a,m="play-btn play-btn-"+a,u="pause-btn pause-btn-"+a+" hide",h="/wp-content/plugins/seriously-simple-podcasting/assets/css/images/player/images/icon-loader.svg",y="loader loader-"+a+" hide",f="clip clip-"+a,b="ssp-progress progress-"+a,g="progress__filled progress__filled-"+a,v="playback playback-"+a,E="player-btn__volume player-btn__volume-"+a,N="player-btn__speed player-btn__speed-"+a,w="timer-"+a,_="duration-"+a,k="subscribe-btn-"+a,x="share-btn-"+a;return(0,e.createElement)("div",{className:c,"data-episode":a},(0,e.createElement)("div",{className:"player"},(0,e.createElement)("div",{className:"player__main"},(0,e.createElement)("div",{className:p,style:d}),(0,e.createElement)("div",{className:"player__body"},(0,e.createElement)("div",{className:"currently-playing"},(0,e.createElement)("div",{className:"show"},(0,e.createElement)("strong",null,n)),(0,e.createElement)("div",{className:"episode-title"},n)),(0,e.createElement)("div",{className:"play-progress"},(0,e.createElement)("div",{className:"play-pause-controls"},(0,e.createElement)("button",{title:"Play",className:m},(0,e.createElement)("span",{className:"screen-reader-text"},"Play Episode")),(0,e.createElement)("button",{alt:"Pause",className:u},(0,e.createElement)("span",{className:"screen-reader-text"},"Pause Episode")),(0,e.createElement)("img",{src:h,className:y})),(0,e.createElement)("div",null,(0,e.createElement)("audio",{preload:"none",className:f},(0,e.createElement)("source",{loop:!0,preload:"none",src:s})),(0,e.createElement)("div",{className:b,title:"Seek"},(0,e.createElement)("span",{className:g})),(0,e.createElement)("div",{className:v},(0,e.createElement)("div",{className:"playback__controls"},(0,e.createElement)("button",{className:E,title:"Mute/Unmute"},(0,e.createElement)("span",{className:"screen-reader-text"},"Mute/Unmute Episode")),(0,e.createElement)("button",{"data-skip":"-10",className:"player-btn__rwd",title:"Rewind 10 seconds"},(0,e.createElement)("span",{className:"screen-reader-text"},"Rewind 10 Seconds")),(0,e.createElement)("button",{"data-speed":"1",className:N,title:"Playback Speed"},"1x"),(0,e.createElement)("button",{"data-skip":"30",className:"player-btn__fwd",title:"Fast Forward 30 seconds"},(0,e.createElement)("span",{className:"screen-reader-text"},"Fast Forward 30 seconds"))),(0,e.createElement)("div",{className:"playback__timers"},(0,e.createElement)("time",{id:w},"00:00"),(0,e.createElement)("span",null,"/"),(0,e.createElement)("time",{id:_},o))))),(0,e.createElement)("nav",{className:"player-panels-nav"},(0,e.createElement)("button",{className:"subscribe-btn",id:k,title:"Subscribe"},"Subscribe"),(0,e.createElement)("button",{className:"share-btn",id:x,title:"Share"},"Share"))))),(0,e.createElement)(H,{className:t,episodeId:a,episodeTitle:n,episodeFileUrl:s,episodeData:i}))}catch(e){console.log("Error:",e),this.state={error:e}}}}var q=W;class V extends e.Component{constructor(e){let{attributes:t,setAttributes:a,className:r}=e;super(...arguments),this.episodeRef=React.createRef();const n={episodeImage:t.image||"",episodeFileUrl:t.file||"",episodeTitle:t.title||"",episodeDuration:t.duration||"",episodeDownloadUrl:t.download||"",episodeData:t.episode_data||""};let s=!0;t.title&&(s=!1),this.state={editing:s,className:r,episodes:[],episode:n,setAttributes:a}}componentDidMount(){i()({path:"ssp/v1/episodes"}).then((e=>{let t=[];Object.keys(e).map((function(a){let r={id:e[a].id,title:e[a].title.rendered};t.push(r)})),this.setState({episodes:t})}))}render(){const{editing:a,episodes:r,episode:o,className:l,setAttributes:d}=this.state,p=(0,e.createElement)(n.BlockControls,{key:"controls"},(0,e.createElement)(s.Toolbar,null,(0,e.createElement)(s.Button,{className:"components-icon-button components-toolbar__control",label:(0,t.__)("Select Podcast","seriously-simple-podcasting"),onClick:()=>{this.setState({editing:!0})},icon:"edit"})));return a?(0,e.createElement)(c,{className:l,episodeRef:this.episodeRef,episodes:r,activateEpisode:()=>{const e=this.episodeRef.current.value;let t="ssp/v1/episodes?include="+e;i()({path:t}).then((t=>{const a={episodeId:e,episodeImage:t[0].episode_player_image,episodeFileUrl:t[0].player_link,episodeTitle:t[0].title.rendered,episodeDuration:t[0].meta.duration,episodeDownloadUrl:t[0].download_link,episodeData:t[0].episode_data};this.setState({key:e,episode:a,editing:!1}),d({id:e,image:a.episodeImage,file:a.episodeFileUrl,title:a.episodeTitle,duration:a.episodeDuration,download:a.episodeDownloadUrl,episode_data:a.episodeData})}))}}):[p,(0,e.createElement)(q,{key:"castos-player",className:this.state.className,episodeId:o.episodeId,episodeImage:o.episodeImage,episodeTitle:o.episodeTitle,episodeFileUrl:o.episodeFileUrl,episodeDuration:o.episodeDuration,episodeData:o.episodeData})]}}var G=V,Y=window.wp.serverSideRender,Z=a.n(Y);class J extends e.Component{constructor(e){let{attributes:t,setAttributes:a,className:r}=e;super(...arguments),this.episodeRef=React.createRef();let n=!0;t.episodeId&&(n=!1),this.state={editing:n,className:r,episodes:[],setAttributes:a,episodeId:t.episodeId}}componentDidMount(){this._isMounted=!0,i()({path:"ssp/v1/episodes?per_page=100&get_additional_options=true"}).then((e=>{let t=[];Object.keys(e).map((function(a){let r={id:e[a].id,title:e[a].title.rendered};t.push(r)})),this.setState({episodes:t})}))}componentWillUnmount(){this._isMounted=!1}render(){const{editing:a,episodes:r,episodeId:o,className:i,setAttributes:l}=this.state,d=(0,e.createElement)(n.BlockControls,{key:"controls"},(0,e.createElement)(s.Toolbar,null,(0,e.createElement)(s.Button,{className:"components-icon-button components-toolbar__control",label:(0,t.__)("Select Podcast","seriously-simple-podcasting"),onClick:()=>{this.setState({editing:!0})},icon:"edit"})));return a?(0,e.createElement)(c,{className:i,episodeRef:this.episodeRef,episodes:r,activateEpisode:()=>{let e=this.episodeRef.current.value;this.setState({episodeId:e,editing:!1}),l({episodeId:e})}}):[d,(0,e.createElement)(Z(),{className:i,key:"castos-player",block:"seriously-simple-podcasting/castos-html-player",attributes:{episodeId:o}})]}}var K=J;class Q extends e.Component{render(){const{className:t,post:a}=this.props;return a.audio_player?(0,e.createElement)(B,{className:t,audioPlayer:a.audio_player}):(0,e.createElement)(q,{className:t,episodeImage:a.episode_player_image,episodeFileUrl:a.player_link,episodeTitle:a.title.rendered,episodeDuration:a.meta.duration,episodeDownloadUrl:a.download_link,episodeData:a.episode_data})}}var X=Q;class $ extends e.Component{render(){const{className:a,title:r,download:n,duration:s}=this.props,o=n+"?ref=download",i=n+"?ref=new_window";return(0,e.createElement)("p",{className:a},(0,e.createElement)("a",{href:o,title:r,className:"podcast-meta-download"},(0,t.__)("Download File","seriously-simple-podcasting"))," | ",(0,e.createElement)("a",{href:i,target:"_blank",title:r,className:"podcast-meta-new-window"},(0,t.__)("Play in new window","seriously-simple-podcasting"))," | ",(0,e.createElement)("span",{className:"podcast-meta-duration"},(0,t.__)("Duration","seriously-simple-podcasting"),": ",s))}}var ee=$;class te extends e.Component{render(){const{className:t,post:a,attributes:r}=this.props;console.log(a);const n=M()("podcast-image-link",{"hide-featured-image":!r.featuredImage}),s=M()(t,"podcast-player",{"hide-player":!r.player}),o=M()("podcast-excerpt",{"hide-excerpt":!r.excerpt}),i=a.episode_featured_image?(0,e.createElement)("img",{src:a.episode_featured_image}):"";return(0,e.createElement)("article",{className:t},(0,e.createElement)("h2",null,(0,e.createElement)("a",{className:"entry-title-link",rel:"bookmark",href:a.link},(0,e.createElement)(D,{content:a.title.rendered}))),(0,e.createElement)("div",{className:"podcast-content"},(0,e.createElement)("a",{className:n,href:a.link,"aria-hidden":"true",tabIndex:"-1"},i),(0,e.createElement)(X,{className:s,post:a}),(0,e.createElement)(ee,{className:s,title:a.title.rendered,download:a.download_link,duration:a.meta.duration}),(0,e.createElement)("div",{className:o},(0,e.createElement)(D,{content:a.excerpt.rendered}))))}}var ae=te;class re extends e.Component{constructor(e){let{className:t}=e;super(...arguments),this.state={className:t,episodes:[]}}componentDidMount(){i()({path:"ssp/v1/episodes"}).then((e=>{const t=[];Object.keys(e).map((function(a){const r=e[a];t.push(r)})),this.setState({episodes:t})}))}render(){const{className:a,episodes:r}=this.state,{attributes:o,setAttributes:i}=this.props,{featuredImage:l,excerpt:c,player:d}=o,p=(0,e.createElement)(n.InspectorControls,{key:"inspector-controls"},(0,e.createElement)(s.PanelBody,{key:"panel-1",title:(0,t.__)("Featured Image","seriously-simple-podcasting")},(0,e.createElement)(s.PanelRow,null,(0,e.createElement)("label",{htmlFor:"featured-image-form-toggle"},(0,t.__)("Show Featured Image","seriously-simple-podcasting")),(0,e.createElement)(s.FormToggle,{id:"high-contrast-form-toggle",label:(0,t.__)("Show Featured Image","seriously-simple-podcasting"),checked:l,onChange:()=>{i({featuredImage:!l})}}))),(0,e.createElement)(s.PanelBody,{key:"panel-2",title:(0,t.__)("Podcast Player","seriously-simple-podcasting")},(0,e.createElement)(s.PanelRow,null,(0,e.createElement)("label",{htmlFor:"podcast-player-form-toggle"},(0,t.__)("Show Podcast Player","seriously-simple-podcasting")),(0,e.createElement)(s.FormToggle,{id:"podcast-player-form-toggle",label:(0,t.__)("Show Podcast Player","seriously-simple-podcasting"),checked:d,onChange:()=>{i({player:!d})}}))),(0,e.createElement)(s.PanelBody,{key:"panel-3",title:(0,t.__)("Podcast Excerpt","seriously-simple-podcasting")},(0,e.createElement)(s.PanelRow,null,(0,e.createElement)("label",{htmlFor:"podcast-excerpt-form-toggle"},(0,t.__)("Show Podcast Excerpt","seriously-simple-podcasting")),(0,e.createElement)(s.FormToggle,{id:"podcast-excerpt-form-toggle",label:(0,t.__)("Show Podcast Excerpt","seriously-simple-podcasting"),checked:c,onChange:()=>{i({excerpt:!c})}})))),m=r.map((t=>(0,e.createElement)(ae,{key:"podcast-list-item-"+t.id,className:a,post:t,attributes:o})));return[p,(0,e.createElement)("div",{key:"episode-items"},m)]}}var ne=re;const{addFilter:se}=wp.hooks,{createHigherOrderComponent:oe}=wp.compose,{Fragment:ie}=wp.element,{InspectorControls:le}=wp.blockEditor,{PanelBody:ce,ToggleControl:de}=wp.components,pe=["core/freeform","core/heading","core/html","core/list","core/media-text","core/paragraph","core/preformatted","core/pullquote","core/quote","core/table","core/verse","core/columns","core/block","create-block/castos-transcript"],me=["create-block/castos-transcript"];se("blocks.registerBlockType","extend-block/ssp-block-settings",((e,t)=>pe.includes(t)?(e.attributes.hasOwnProperty("hideFromFeed")||(e.attributes.hideFromFeed={type:"boolean",default:null}),e):e)),se("editor.BlockEdit","extend-block/ssp-block-settings",oe((a=>r=>pe.includes(r.name)?(me.includes(r.name)&&null===r.attributes.hideFromFeed&&(r.attributes.hideFromFeed=!0),(0,e.createElement)(ie,null,(0,e.createElement)(a,r),(0,e.createElement)(le,null,(0,e.createElement)(ce,{title:(0,t.__)("Feed Settings"),initialOpen:!0},(0,e.createElement)(de,{label:(0,t.__)("Hide From Podcast RSS Feed"),checked:r.attributes.hideFromFeed,onChange:e=>{r.setAttributes({hideFromFeed:e})}}))))):(0,e.createElement)(a,r)))),(0,r.registerBlockType)("seriously-simple-podcasting/audio-player",{title:(0,t.__)("Audio Player","seriously-simple-podcasting"),icon:"controls-volumeon",category:"layout",supports:{multiple:!1},attributes:{id:{type:"string"},audio_player:{type:"string",source:"html",selector:"span"}},edit:U,save:(t,a)=>{const{id:r,audio_player:n}=t.attributes;return(0,e.createElement)(B,{className:a,audioPlayer:n})}}),(0,r.registerBlockType)("seriously-simple-podcasting/castos-player",{title:(0,t.__)("Castos Player (OLD)","seriously-simple-podcasting"),icon:"controls-volumeon",category:"layout",supports:{multiple:!1},attributes:{id:{type:"string"},image:{type:"string"},file:{type:"string"},title:{type:"string"},duration:{type:"string"},download:{type:"string"},episode_data:{type:"object"}},edit:G,save:(t,a)=>{const{id:r,image:n,file:s,title:o,duration:i,download:l,episode_data:c}=t.attributes;return c?(0,e.createElement)(q,{className:a,episodeId:r,episodeImage:n,episodeFileUrl:s,episodeTitle:o,episodeDuration:i,episodeDownloadUrl:l,episodeData:c}):""}}),(0,r.registerBlockType)("seriously-simple-podcasting/castos-html-player",{title:(0,t.__)("Castos Player","seriously-simple-podcasting"),icon:"controls-volumeon",category:"layout",supports:{multiple:!1},attributes:{episodeId:{type:"string"}},edit:K,save:()=>null}),(0,r.registerBlockType)("seriously-simple-podcasting/podcast-list",{title:(0,t.__)("Podcast List","seriously-simple-podcasting"),icon:"megaphone",category:"widgets",supports:{multiple:!1},attributes:{featuredImage:{type:"boolean",default:!1},excerpt:{type:"boolean",default:!1},player:{type:"boolean",default:!1}},edit:ne})}()}();