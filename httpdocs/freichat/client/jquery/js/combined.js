/** @license
 *
 * SoundManager 2: JavaScript Sound for the Web
 * ----------------------------------------------
 * http://schillmania.com/projects/soundmanager2/
 *
 * Copyright (c) 2007, Scott Schiller. All rights reserved.
 * Code provided under the BSD License:
 * http://schillmania.com/projects/soundmanager2/license.txt
 *
 * V2.97a.20121104
 */
(function(Q){function R(R,fa){function S(b){return c.preferFlash&&y&&!c.ignoreFlash&&void 0!==c.flash[b]&&c.flash[b]}function m(b){return function(c){var e=this._s;return!e||!e._a?null:b.call(this,c)}}this.setupOptions={url:R||null,flashVersion:8,debugMode:!0,debugFlash:!1,useConsole:!0,consoleOnly:!0,waitForWindowLoad:!1,bgColor:"#ffffff",useHighPerformance:!1,flashPollingInterval:null,html5PollingInterval:null,flashLoadTimeout:1E3,wmode:null,allowScriptAccess:"always",useFlashBlock:!1,useHTML5Audio:!0,
html5Test:/^(probably|maybe)$/i,preferFlash:!0,noSWFCache:!1};this.defaultOptions={autoLoad:!1,autoPlay:!1,from:null,loops:1,onid3:null,onload:null,whileloading:null,onplay:null,onpause:null,onresume:null,whileplaying:null,onposition:null,onstop:null,onfailure:null,onfinish:null,multiShot:!0,multiShotEvents:!1,position:null,pan:0,stream:!0,to:null,type:null,usePolicyFile:!1,volume:100};this.flash9Options={isMovieStar:null,usePeakData:!1,useWaveformData:!1,useEQData:!1,onbufferchange:null,ondataerror:null};
this.movieStarOptions={bufferTime:3,serverURL:null,onconnect:null,duration:null};this.audioFormats={mp3:{type:['audio/mpeg; codecs="mp3"',"audio/mpeg","audio/mp3","audio/MPA","audio/mpa-robust"],required:!0},mp4:{related:["aac","m4a","m4b"],type:['audio/mp4; codecs="mp4a.40.2"',"audio/aac","audio/x-m4a","audio/MP4A-LATM","audio/mpeg4-generic"],required:!1},ogg:{type:["audio/ogg; codecs=vorbis"],required:!1},wav:{type:['audio/wav; codecs="1"',"audio/wav","audio/wave","audio/x-wav"],required:!1}};this.movieID=
"sm2-container";this.id=fa||"sm2movie";this.debugID="soundmanager-debug";this.debugURLParam=/([#?&])debug=1/i;this.versionNumber="V2.97a.20121104";this.altURL=this.movieURL=this.version=null;this.enabled=this.swfLoaded=!1;this.oMC=null;this.sounds={};this.soundIDs=[];this.didFlashBlock=this.muted=!1;this.filePattern=null;this.filePatterns={flash8:/\.mp3(\?.*)?$/i,flash9:/\.mp3(\?.*)?$/i};this.features={buffering:!1,peakData:!1,waveformData:!1,eqData:!1,movieStar:!1};this.sandbox={};this.html5={usingFlash:null};
this.flash={};this.ignoreFlash=this.html5Only=!1;var Da,c=this,Ea=null,g=null,T,q=navigator.userAgent,h=Q,ga=h.location.href.toString(),k=document,ha,Fa,ia,j,v=[],I=!1,J=!1,i=!1,s=!1,ja=!1,K,r,ka,U,la,A,B,C,Ga,ma,V,W,D,na,L,oa,X,E,Ha,pa,Ia,Y,Ja,M=null,qa=null,t,ra,F,Z,$,G,n,N=!1,sa=!1,Ka,La,Ma,aa=0,O=null,ba,p=null,Na,ca,P,w,ta,ua,Oa,l,bb=Array.prototype.slice,z=!1,Pa,y,va,Qa,u,Ra,wa=q.match(/(ipad|iphone|ipod)/i),x=q.match(/msie/i),cb=q.match(/webkit/i),xa=q.match(/safari/i)&&!q.match(/chrome/i),
ya=q.match(/opera/i),za=q.match(/(mobile|pre\/|xoom)/i)||wa,Sa=!ga.match(/usehtml5audio/i)&&!ga.match(/sm2\-ignorebadua/i)&&xa&&!q.match(/silk/i)&&q.match(/OS X 10_6_([3-7])/i),Aa=void 0!==k.hasFocus?k.hasFocus():null,da=xa&&(void 0===k.hasFocus||!k.hasFocus()),Ta=!da,Ua=/(mp3|mp4|mpa|m4a|m4b)/i,Ba=k.location?k.location.protocol.match(/http/i):null,Va=!Ba?"http://":"",Wa=/^\s*audio\/(?:x-)?(?:mpeg4|aac|flv|mov|mp4||m4v|m4a|m4b|mp4v|3gp|3g2)\s*(?:$|;)/i,Xa="mpeg4 aac flv mov mp4 m4v f4v m4a m4b mp4v 3gp 3g2".split(" "),
db=RegExp("\\.("+Xa.join("|")+")(\\?.*)?$","i");this.mimePattern=/^\s*audio\/(?:x-)?(?:mp(?:eg|3))\s*(?:$|;)/i;this.useAltURL=!Ba;za&&(c.useHTML5Audio=!0,c.preferFlash=!1,wa&&(z=c.ignoreFlash=!0));var Ca;try{Ca=void 0!==Audio&&void 0!==(ya&&void 0!==opera&&10>opera.version()?new Audio(null):new Audio).canPlayType}catch(fb){Ca=!1}this.hasHTML5=Ca;this.setup=function(b){var d=!c.url;void 0!==b&&(i&&p&&c.ok()&&(void 0!==b.flashVersion||void 0!==b.url))&&G(t("setupLate"));ka(b);d&&(L&&void 0!==b.url)&&
c.beginDelayedInit();!L&&(void 0!==b.url&&"complete"===k.readyState)&&setTimeout(D,1);return c};this.supported=this.ok=function(){return p?i&&!s:c.useHTML5Audio&&c.hasHTML5};this.getMovie=function(b){return T(b)||k[b]||h[b]};this.createSound=function(b,d){function e(){a=Z(a);c.sounds[a.id]=new Da(a);c.soundIDs.push(a.id);return c.sounds[a.id]}var a,f=null;if(!i||!c.ok())return G(void 0),!1;void 0!==d&&(b={id:b,url:d});a=r(b);a.url=ba(a.url);if(n(a.id,!0))return c.sounds[a.id];ca(a)?(f=e(),f._setup_html5(a)):
(8<j&&null===a.isMovieStar&&(a.isMovieStar=!(!a.serverURL&&!(a.type&&a.type.match(Wa)||a.url.match(db)))),a=$(a,void 0),f=e(),8===j?g._createSound(a.id,a.loops||1,a.usePolicyFile):(g._createSound(a.id,a.url,a.usePeakData,a.useWaveformData,a.useEQData,a.isMovieStar,a.isMovieStar?a.bufferTime:!1,a.loops||1,a.serverURL,a.duration||null,a.autoPlay,!0,a.autoLoad,a.usePolicyFile),a.serverURL||(f.connected=!0,a.onconnect&&a.onconnect.apply(f))),!a.serverURL&&(a.autoLoad||a.autoPlay)&&f.load(a));!a.serverURL&&
a.autoPlay&&f.play();return f};this.destroySound=function(b,d){if(!n(b))return!1;var e=c.sounds[b],a;e._iO={};e.stop();e.unload();for(a=0;a<c.soundIDs.length;a++)if(c.soundIDs[a]===b){c.soundIDs.splice(a,1);break}d||e.destruct(!0);delete c.sounds[b];return!0};this.load=function(b,d){return!n(b)?!1:c.sounds[b].load(d)};this.unload=function(b){return!n(b)?!1:c.sounds[b].unload()};this.onposition=this.onPosition=function(b,d,e,a){return!n(b)?!1:c.sounds[b].onposition(d,e,a)};this.clearOnPosition=function(b,
d,e){return!n(b)?!1:c.sounds[b].clearOnPosition(d,e)};this.start=this.play=function(b,d){var e=!1;return!i||!c.ok()?(G("soundManager.play(): "+t(!i?"notReady":"notOK")),e):!n(b)?(d instanceof Object||(d={url:d}),d&&d.url&&(d.id=b,e=c.createSound(d).play()),e):c.sounds[b].play(d)};this.setPosition=function(b,d){return!n(b)?!1:c.sounds[b].setPosition(d)};this.stop=function(b){return!n(b)?!1:c.sounds[b].stop()};this.stopAll=function(){for(var b in c.sounds)c.sounds.hasOwnProperty(b)&&c.sounds[b].stop()};
this.pause=function(b){return!n(b)?!1:c.sounds[b].pause()};this.pauseAll=function(){var b;for(b=c.soundIDs.length-1;0<=b;b--)c.sounds[c.soundIDs[b]].pause()};this.resume=function(b){return!n(b)?!1:c.sounds[b].resume()};this.resumeAll=function(){var b;for(b=c.soundIDs.length-1;0<=b;b--)c.sounds[c.soundIDs[b]].resume()};this.togglePause=function(b){return!n(b)?!1:c.sounds[b].togglePause()};this.setPan=function(b,d){return!n(b)?!1:c.sounds[b].setPan(d)};this.setVolume=function(b,d){return!n(b)?!1:c.sounds[b].setVolume(d)};
this.mute=function(b){var d=0;b instanceof String&&(b=null);if(b)return!n(b)?!1:c.sounds[b].mute();for(d=c.soundIDs.length-1;0<=d;d--)c.sounds[c.soundIDs[d]].mute();return c.muted=!0};this.muteAll=function(){c.mute()};this.unmute=function(b){b instanceof String&&(b=null);if(b)return!n(b)?!1:c.sounds[b].unmute();for(b=c.soundIDs.length-1;0<=b;b--)c.sounds[c.soundIDs[b]].unmute();c.muted=!1;return!0};this.unmuteAll=function(){c.unmute()};this.toggleMute=function(b){return!n(b)?!1:c.sounds[b].toggleMute()};
this.getMemoryUse=function(){var b=0;g&&8!==j&&(b=parseInt(g._getMemoryUse(),10));return b};this.disable=function(b){var d;void 0===b&&(b=!1);if(s)return!1;s=!0;for(d=c.soundIDs.length-1;0<=d;d--)Ia(c.sounds[c.soundIDs[d]]);K(b);l.remove(h,"load",B);return!0};this.canPlayMIME=function(b){var d;c.hasHTML5&&(d=P({type:b}));!d&&p&&(d=b&&c.ok()?!!(8<j&&b.match(Wa)||b.match(c.mimePattern)):null);return d};this.canPlayURL=function(b){var d;c.hasHTML5&&(d=P({url:b}));!d&&p&&(d=b&&c.ok()?!!b.match(c.filePattern):
null);return d};this.canPlayLink=function(b){return void 0!==b.type&&b.type&&c.canPlayMIME(b.type)?!0:c.canPlayURL(b.href)};this.getSoundById=function(b){if(!b)throw Error("soundManager.getSoundById(): sID is null/undefined");return c.sounds[b]};this.onready=function(b,c){if("function"===typeof b)c||(c=h),la("onready",b,c),A();else throw t("needFunction","onready");return!0};this.ontimeout=function(b,c){if("function"===typeof b)c||(c=h),la("ontimeout",b,c),A({type:"ontimeout"});else throw t("needFunction",
"ontimeout");return!0};this._wD=this._writeDebug=function(){return!0};this._debug=function(){};this.reboot=function(){var b,d;for(b=c.soundIDs.length-1;0<=b;b--)c.sounds[c.soundIDs[b]].destruct();if(g)try{x&&(qa=g.innerHTML),M=g.parentNode.removeChild(g)}catch(e){}qa=M=p=null;c.enabled=L=i=N=sa=I=J=s=c.swfLoaded=!1;c.soundIDs=[];c.sounds={};g=null;for(b in v)if(v.hasOwnProperty(b))for(d=v[b].length-1;0<=d;d--)v[b][d].fired=!1;h.setTimeout(c.beginDelayedInit,20)};this.getMoviePercent=function(){return g&&
"PercentLoaded"in g?g.PercentLoaded():null};this.beginDelayedInit=function(){ja=!0;D();setTimeout(function(){if(sa)return!1;X();W();return sa=!0},20);C()};this.destruct=function(){c.disable(!0)};Da=function(b){var d,e,a=this,f,Ya,Za,H,h,k,m=!1,i=[],l=0,q,s,p=null;e=d=null;this.sID=this.id=b.id;this.url=b.url;this._iO=this.instanceOptions=this.options=r(b);this.pan=this.options.pan;this.volume=this.options.volume;this.isHTML5=!1;this._a=null;this.id3={};this._debug=function(){};this.load=function(b){var c=
null;void 0!==b?a._iO=r(b,a.options):(b=a.options,a._iO=b,p&&p!==a.url&&(a._iO.url=a.url,a.url=null));a._iO.url||(a._iO.url=a.url);a._iO.url=ba(a._iO.url);b=a.instanceOptions=a._iO;if(b.url===a.url&&0!==a.readyState&&2!==a.readyState)return 3===a.readyState&&b.onload&&b.onload.apply(a,[!!a.duration]),a;a.loaded=!1;a.readyState=1;a.playState=0;a.id3={};if(ca(b))c=a._setup_html5(b),c._called_load||(a._html5_canplay=!1,a.url!==b.url&&(a._a.src=b.url,a.setPosition(0)),a._a.autobuffer="auto",a._a.preload=
"auto",a._a._called_load=!0,b.autoPlay&&a.play());else try{a.isHTML5=!1,a._iO=$(Z(b)),b=a._iO,8===j?g._load(a.id,b.url,b.stream,b.autoPlay,b.usePolicyFile):g._load(a.id,b.url,!!b.stream,!!b.autoPlay,b.loops||1,!!b.autoLoad,b.usePolicyFile)}catch(d){E({type:"SMSOUND_LOAD_JS_EXCEPTION",fatal:!0})}a.url=b.url;return a};this.unload=function(){0!==a.readyState&&(a.isHTML5?(H(),a._a&&(a._a.pause(),ta(a._a,"about:blank"),p="about:blank")):8===j?g._unload(a.id,"about:blank"):g._unload(a.id),f());return a};
this.destruct=function(b){a.isHTML5?(H(),a._a&&(a._a.pause(),ta(a._a),z||Za(),a._a._s=null,a._a=null)):(a._iO.onfailure=null,g._destroySound(a.id));b||c.destroySound(a.id,!0)};this.start=this.play=function(b,c){var d,e;e=!0;e=null;c=void 0===c?!0:c;b||(b={});a.url&&(a._iO.url=a.url);a._iO=r(a._iO,a.options);a._iO=r(b,a._iO);a._iO.url=ba(a._iO.url);a.instanceOptions=a._iO;if(a._iO.serverURL&&!a.connected)return a.getAutoPlay()||a.setAutoPlay(!0),a;ca(a._iO)&&(a._setup_html5(a._iO),h());1===a.playState&&
!a.paused&&((d=a._iO.multiShot)||(e=a));if(null!==e)return e;b.url&&b.url!==a.url&&a.load(a._iO);a.loaded||(0===a.readyState?(a.isHTML5||(a._iO.autoPlay=!0),a.load(a._iO),a.instanceOptions=a._iO):2===a.readyState&&(e=a));if(null!==e)return e;!a.isHTML5&&(9===j&&0<a.position&&a.position===a.duration)&&(b.position=0);if(a.paused&&0<=a.position&&(!a._iO.serverURL||0<a.position))a.resume();else{a._iO=r(b,a._iO);if(null!==a._iO.from&&null!==a._iO.to&&0===a.instanceCount&&0===a.playState&&!a._iO.serverURL){d=
function(){a._iO=r(b,a._iO);a.play(a._iO)};if(a.isHTML5&&!a._html5_canplay)a.load({oncanplay:d}),e=!1;else if(!a.isHTML5&&!a.loaded&&(!a.readyState||2!==a.readyState))a.load({onload:d}),e=!1;if(null!==e)return e;a._iO=s()}(!a.instanceCount||a._iO.multiShotEvents||!a.isHTML5&&8<j&&!a.getAutoPlay())&&a.instanceCount++;a._iO.onposition&&0===a.playState&&k(a);a.playState=1;a.paused=!1;a.position=void 0!==a._iO.position&&!isNaN(a._iO.position)?a._iO.position:0;a.isHTML5||(a._iO=$(Z(a._iO)));a._iO.onplay&&
c&&(a._iO.onplay.apply(a),m=!0);a.setVolume(a._iO.volume,!0);a.setPan(a._iO.pan,!0);a.isHTML5?(h(),e=a._setup_html5(),a.setPosition(a._iO.position),e.play()):(e=g._start(a.id,a._iO.loops||1,9===j?a._iO.position:a._iO.position/1E3,a._iO.multiShot),9===j&&!e&&a._iO.onplayerror&&a._iO.onplayerror.apply(a))}return a};this.stop=function(b){var c=a._iO;1===a.playState&&(a._onbufferchange(0),a._resetOnPosition(0),a.paused=!1,a.isHTML5||(a.playState=0),q(),c.to&&a.clearOnPosition(c.to),a.isHTML5?a._a&&(b=
a.position,a.setPosition(0),a.position=b,a._a.pause(),a.playState=0,a._onTimer(),H()):(g._stop(a.id,b),c.serverURL&&a.unload()),a.instanceCount=0,a._iO={},c.onstop&&c.onstop.apply(a));return a};this.setAutoPlay=function(b){a._iO.autoPlay=b;a.isHTML5||(g._setAutoPlay(a.id,b),b&&!a.instanceCount&&1===a.readyState&&a.instanceCount++)};this.getAutoPlay=function(){return a._iO.autoPlay};this.setPosition=function(b){void 0===b&&(b=0);var c=a.isHTML5?Math.max(b,0):Math.min(a.duration||a._iO.duration,Math.max(b,
0));a.position=c;b=a.position/1E3;a._resetOnPosition(a.position);a._iO.position=c;if(a.isHTML5){if(a._a&&a._html5_canplay&&a._a.currentTime!==b)try{a._a.currentTime=b,(0===a.playState||a.paused)&&a._a.pause()}catch(d){}}else b=9===j?a.position:b,a.readyState&&2!==a.readyState&&g._setPosition(a.id,b,a.paused||!a.playState,a._iO.multiShot);a.isHTML5&&a.paused&&a._onTimer(!0);return a};this.pause=function(b){if(a.paused||0===a.playState&&1!==a.readyState)return a;a.paused=!0;a.isHTML5?(a._setup_html5().pause(),
H()):(b||void 0===b)&&g._pause(a.id,a._iO.multiShot);a._iO.onpause&&a._iO.onpause.apply(a);return a};this.resume=function(){var b=a._iO;if(!a.paused)return a;a.paused=!1;a.playState=1;a.isHTML5?(a._setup_html5().play(),h()):(b.isMovieStar&&!b.serverURL&&a.setPosition(a.position),g._pause(a.id,b.multiShot));!m&&b.onplay?(b.onplay.apply(a),m=!0):b.onresume&&b.onresume.apply(a);return a};this.togglePause=function(){if(0===a.playState)return a.play({position:9===j&&!a.isHTML5?a.position:a.position/1E3}),
a;a.paused?a.resume():a.pause();return a};this.setPan=function(b,c){void 0===b&&(b=0);void 0===c&&(c=!1);a.isHTML5||g._setPan(a.id,b);a._iO.pan=b;c||(a.pan=b,a.options.pan=b);return a};this.setVolume=function(b,d){void 0===b&&(b=100);void 0===d&&(d=!1);a.isHTML5?a._a&&(a._a.volume=Math.max(0,Math.min(1,b/100))):g._setVolume(a.id,c.muted&&!a.muted||a.muted?0:b);a._iO.volume=b;d||(a.volume=b,a.options.volume=b);return a};this.mute=function(){a.muted=!0;a.isHTML5?a._a&&(a._a.muted=!0):g._setVolume(a.id,
0);return a};this.unmute=function(){a.muted=!1;var b=void 0!==a._iO.volume;a.isHTML5?a._a&&(a._a.muted=!1):g._setVolume(a.id,b?a._iO.volume:a.options.volume);return a};this.toggleMute=function(){return a.muted?a.unmute():a.mute()};this.onposition=this.onPosition=function(b,c,d){i.push({position:parseInt(b,10),method:c,scope:void 0!==d?d:a,fired:!1});return a};this.clearOnPosition=function(a,b){var c,a=parseInt(a,10);if(isNaN(a))return!1;for(c=0;c<i.length;c++)if(a===i[c].position&&(!b||b===i[c].method))i[c].fired&&
l--,i.splice(c,1)};this._processOnPosition=function(){var b,c;b=i.length;if(!b||!a.playState||l>=b)return!1;for(b-=1;0<=b;b--)c=i[b],!c.fired&&a.position>=c.position&&(c.fired=!0,l++,c.method.apply(c.scope,[c.position]));return!0};this._resetOnPosition=function(a){var b,c;b=i.length;if(!b)return!1;for(b-=1;0<=b;b--)c=i[b],c.fired&&a<=c.position&&(c.fired=!1,l--);return!0};s=function(){var b=a._iO,c=b.from,d=b.to,e,f;f=function(){a.clearOnPosition(d,f);a.stop()};e=function(){if(null!==d&&!isNaN(d))a.onPosition(d,
f)};null!==c&&!isNaN(c)&&(b.position=c,b.multiShot=!1,e());return b};k=function(){var b,c=a._iO.onposition;if(c)for(b in c)if(c.hasOwnProperty(b))a.onPosition(parseInt(b,10),c[b])};q=function(){var b,c=a._iO.onposition;if(c)for(b in c)c.hasOwnProperty(b)&&a.clearOnPosition(parseInt(b,10))};h=function(){a.isHTML5&&Ka(a)};H=function(){a.isHTML5&&La(a)};f=function(b){b||(i=[],l=0);m=!1;a._hasTimer=null;a._a=null;a._html5_canplay=!1;a.bytesLoaded=null;a.bytesTotal=null;a.duration=a._iO&&a._iO.duration?
a._iO.duration:null;a.durationEstimate=null;a.buffered=[];a.eqData=[];a.eqData.left=[];a.eqData.right=[];a.failures=0;a.isBuffering=!1;a.instanceOptions={};a.instanceCount=0;a.loaded=!1;a.metadata={};a.readyState=0;a.muted=!1;a.paused=!1;a.peakData={left:0,right:0};a.waveformData={left:[],right:[]};a.playState=0;a.position=null;a.id3={}};f();this._onTimer=function(b){var c,f=!1,g={};if(a._hasTimer||b){if(a._a&&(b||(0<a.playState||1===a.readyState)&&!a.paused))c=a._get_html5_duration(),c!==d&&(d=c,
a.duration=c,f=!0),a.durationEstimate=a.duration,c=1E3*a._a.currentTime||0,c!==e&&(e=c,f=!0),(f||b)&&a._whileplaying(c,g,g,g,g);return f}};this._get_html5_duration=function(){var b=a._iO;return(b=a._a&&a._a.duration?1E3*a._a.duration:b&&b.duration?b.duration:null)&&!isNaN(b)&&Infinity!==b?b:null};this._apply_loop=function(a,b){a.loop=1<b?"loop":""};this._setup_html5=function(b){var b=r(a._iO,b),c=decodeURI,d=z?Ea:a._a,e=c(b.url),g;z?e===Pa&&(g=!0):e===p&&(g=!0);if(d){if(d._s)if(z)d._s&&(d._s.playState&&
!g)&&d._s.stop();else if(!z&&e===c(p))return a._apply_loop(d,b.loops),d;g||(f(!1),d.src=b.url,Pa=p=a.url=b.url,d._called_load=!1)}else a._a=b.autoLoad||b.autoPlay?new Audio(b.url):ya&&10>opera.version()?new Audio(null):new Audio,d=a._a,d._called_load=!1,z&&(Ea=d);a.isHTML5=!0;a._a=d;d._s=a;Ya();a._apply_loop(d,b.loops);b.autoLoad||b.autoPlay?a.load():(d.autobuffer=!1,d.preload="auto");return d};Ya=function(){if(a._a._added_events)return!1;var b;a._a._added_events=!0;for(b in u)u.hasOwnProperty(b)&&
a._a&&a._a.addEventListener(b,u[b],!1);return!0};Za=function(){var b;a._a._added_events=!1;for(b in u)u.hasOwnProperty(b)&&a._a&&a._a.removeEventListener(b,u[b],!1)};this._onload=function(b){b=!!b||!a.isHTML5&&8===j&&a.duration;a.loaded=b;a.readyState=b?3:2;a._onbufferchange(0);a._iO.onload&&a._iO.onload.apply(a,[b]);return!0};this._onbufferchange=function(b){if(0===a.playState||b&&a.isBuffering||!b&&!a.isBuffering)return!1;a.isBuffering=1===b;a._iO.onbufferchange&&a._iO.onbufferchange.apply(a);return!0};
this._onsuspend=function(){a._iO.onsuspend&&a._iO.onsuspend.apply(a);return!0};this._onfailure=function(b,c,d){a.failures++;if(a._iO.onfailure&&1===a.failures)a._iO.onfailure(a,b,c,d)};this._onfinish=function(){var b=a._iO.onfinish;a._onbufferchange(0);a._resetOnPosition(0);a.instanceCount&&(a.instanceCount--,a.instanceCount||(q(),a.playState=0,a.paused=!1,a.instanceCount=0,a.instanceOptions={},a._iO={},H(),a.isHTML5&&(a.position=0)),(!a.instanceCount||a._iO.multiShotEvents)&&b&&b.apply(a))};this._whileloading=
function(b,c,d,e){var f=a._iO;a.bytesLoaded=b;a.bytesTotal=c;a.duration=Math.floor(d);a.bufferLength=e;a.durationEstimate=!a.isHTML5&&!f.isMovieStar?f.duration?a.duration>f.duration?a.duration:f.duration:parseInt(a.bytesTotal/a.bytesLoaded*a.duration,10):a.duration;a.isHTML5||(a.buffered=[{start:0,end:a.duration}]);(3!==a.readyState||a.isHTML5)&&f.whileloading&&f.whileloading.apply(a)};this._whileplaying=function(b,c,d,e,f){var g=a._iO;if(isNaN(b)||null===b)return!1;a.position=Math.max(0,b);a._processOnPosition();
!a.isHTML5&&8<j&&(g.usePeakData&&(void 0!==c&&c)&&(a.peakData={left:c.leftPeak,right:c.rightPeak}),g.useWaveformData&&(void 0!==d&&d)&&(a.waveformData={left:d.split(","),right:e.split(",")}),g.useEQData&&(void 0!==f&&f&&f.leftEQ)&&(b=f.leftEQ.split(","),a.eqData=b,a.eqData.left=b,void 0!==f.rightEQ&&f.rightEQ&&(a.eqData.right=f.rightEQ.split(","))));1===a.playState&&(!a.isHTML5&&(8===j&&!a.position&&a.isBuffering)&&a._onbufferchange(0),g.whileplaying&&g.whileplaying.apply(a));return!0};this._oncaptiondata=
function(b){a.captiondata=b;a._iO.oncaptiondata&&a._iO.oncaptiondata.apply(a,[b])};this._onmetadata=function(b,c){var d={},e,f;e=0;for(f=b.length;e<f;e++)d[b[e]]=c[e];a.metadata=d;a._iO.onmetadata&&a._iO.onmetadata.apply(a)};this._onid3=function(b,c){var d=[],e,f;e=0;for(f=b.length;e<f;e++)d[b[e]]=c[e];a.id3=r(a.id3,d);a._iO.onid3&&a._iO.onid3.apply(a)};this._onconnect=function(b){b=1===b;if(a.connected=b)a.failures=0,n(a.id)&&(a.getAutoPlay()?a.play(void 0,a.getAutoPlay()):a._iO.autoLoad&&a.load()),
a._iO.onconnect&&a._iO.onconnect.apply(a,[b])};this._ondataerror=function(){0<a.playState&&a._iO.ondataerror&&a._iO.ondataerror.apply(a)}};oa=function(){return k.body||k._docElement||k.getElementsByTagName("div")[0]};T=function(b){return k.getElementById(b)};r=function(b,d){var e=b||{},a,f;a=void 0===d?c.defaultOptions:d;for(f in a)a.hasOwnProperty(f)&&void 0===e[f]&&(e[f]="object"!==typeof a[f]||null===a[f]?a[f]:r(e[f],a[f]));return e};U={onready:1,ontimeout:1,defaultOptions:1,flash9Options:1,movieStarOptions:1};
ka=function(b,d){var e,a=!0,f=void 0!==d,g=c.setupOptions;for(e in b)if(b.hasOwnProperty(e))if("object"!==typeof b[e]||null===b[e]||b[e]instanceof Array)f&&void 0!==U[d]?c[d][e]=b[e]:void 0!==g[e]?(c.setupOptions[e]=b[e],c[e]=b[e]):void 0===U[e]?(G(t(void 0===c[e]?"setupUndef":"setupError",e),2),a=!1):c[e]instanceof Function?c[e].apply(c,b[e]instanceof Array?b[e]:[b[e]]):c[e]=b[e];else if(void 0===U[e])G(t(void 0===c[e]?"setupUndef":"setupError",e),2),a=!1;else return ka(b[e],e);return a};var $a=
function(b){var b=bb.call(b),c=b.length;ea?(b[1]="on"+b[1],3<c&&b.pop()):3===c&&b.push(!1);return b},ab=function(b,c){var e=b.shift(),a=[eb[c]];if(ea)e[a](b[0],b[1]);else e[a].apply(e,b)},ea=h.attachEvent,eb={add:ea?"attachEvent":"addEventListener",remove:ea?"detachEvent":"removeEventListener"};l={add:function(){ab($a(arguments),"add")},remove:function(){ab($a(arguments),"remove")}};u={abort:m(function(){}),canplay:m(function(){var b=this._s,c;if(b._html5_canplay)return!0;b._html5_canplay=!0;b._onbufferchange(0);
c=void 0!==b._iO.position&&!isNaN(b._iO.position)?b._iO.position/1E3:null;if(b.position&&this.currentTime!==c)try{this.currentTime=c}catch(e){}b._iO._oncanplay&&b._iO._oncanplay()}),canplaythrough:m(function(){var b=this._s;b.loaded||(b._onbufferchange(0),b._whileloading(b.bytesLoaded,b.bytesTotal,b._get_html5_duration()),b._onload(!0))}),ended:m(function(){this._s._onfinish()}),error:m(function(){this._s._onload(!1)}),loadeddata:m(function(){var b=this._s;!b._loaded&&!xa&&(b.duration=b._get_html5_duration())}),
loadedmetadata:m(function(){}),loadstart:m(function(){this._s._onbufferchange(1)}),play:m(function(){this._s._onbufferchange(0)}),playing:m(function(){this._s._onbufferchange(0)}),progress:m(function(b){var c=this._s,e,a,f=0,f=b.target.buffered;e=b.loaded||0;var g=b.total||1;c.buffered=[];if(f&&f.length){e=0;for(a=f.length;e<a;e++)c.buffered.push({start:1E3*f.start(e),end:1E3*f.end(e)});f=1E3*(f.end(0)-f.start(0));e=f/(1E3*b.target.duration)}isNaN(e)||(c._onbufferchange(0),c._whileloading(e,g,c._get_html5_duration()),
e&&(g&&e===g)&&u.canplaythrough.call(this,b))}),ratechange:m(function(){}),suspend:m(function(b){var c=this._s;u.progress.call(this,b);c._onsuspend()}),stalled:m(function(){}),timeupdate:m(function(){this._s._onTimer()}),waiting:m(function(){this._s._onbufferchange(1)})};ca=function(b){return b.serverURL||b.type&&S(b.type)?!1:b.type?P({type:b.type}):P({url:b.url})||c.html5Only};ta=function(b,c){b&&(b.src=c)};P=function(b){if(!c.useHTML5Audio||!c.hasHTML5)return!1;var d=b.url||null,b=b.type||null,
e=c.audioFormats,a;if(b&&void 0!==c.html5[b])return c.html5[b]&&!S(b);if(!w){w=[];for(a in e)e.hasOwnProperty(a)&&(w.push(a),e[a].related&&(w=w.concat(e[a].related)));w=RegExp("\\.("+w.join("|")+")(\\?.*)?$","i")}a=d?d.toLowerCase().match(w):null;!a||!a.length?b&&(d=b.indexOf(";"),a=(-1!==d?b.substr(0,d):b).substr(6)):a=a[1];a&&void 0!==c.html5[a]?d=c.html5[a]&&!S(a):(b="audio/"+a,d=c.html5.canPlayType({type:b}),d=(c.html5[a]=d)&&c.html5[b]&&!S(b));return d};Oa=function(){function b(a){var b,e,f=
b=!1;if(!d||"function"!==typeof d.canPlayType)return b;if(a instanceof Array){b=0;for(e=a.length;b<e;b++)if(c.html5[a[b]]||d.canPlayType(a[b]).match(c.html5Test))f=!0,c.html5[a[b]]=!0,c.flash[a[b]]=!!a[b].match(Ua);b=f}else a=d&&"function"===typeof d.canPlayType?d.canPlayType(a):!1,b=!(!a||!a.match(c.html5Test));return b}if(!c.useHTML5Audio||!c.hasHTML5)return!1;var d=void 0!==Audio?ya&&10>opera.version()?new Audio(null):new Audio:null,e,a,f={},g;g=c.audioFormats;for(e in g)if(g.hasOwnProperty(e)&&
(a="audio/"+e,f[e]=b(g[e].type),f[a]=f[e],e.match(Ua)?(c.flash[e]=!0,c.flash[a]=!0):(c.flash[e]=!1,c.flash[a]=!1),g[e]&&g[e].related))for(a=g[e].related.length-1;0<=a;a--)f["audio/"+g[e].related[a]]=f[e],c.html5[g[e].related[a]]=f[e],c.flash[g[e].related[a]]=f[e];f.canPlayType=d?b:null;c.html5=r(c.html5,f);return!0};t=function(){};Z=function(b){8===j&&(1<b.loops&&b.stream)&&(b.stream=!1);return b};$=function(b){if(b&&!b.usePolicyFile&&(b.onid3||b.usePeakData||b.useWaveformData||b.useEQData))b.usePolicyFile=
!0;return b};G=function(){};ha=function(){return!1};Ia=function(b){for(var c in b)b.hasOwnProperty(c)&&"function"===typeof b[c]&&(b[c]=ha)};Y=function(b){void 0===b&&(b=!1);(s||b)&&c.disable(b)};Ja=function(b){var d=null;if(b)if(b.match(/\.swf(\?.*)?$/i)){if(d=b.substr(b.toLowerCase().lastIndexOf(".swf?")+4))return b}else b.lastIndexOf("/")!==b.length-1&&(b+="/");b=(b&&-1!==b.lastIndexOf("/")?b.substr(0,b.lastIndexOf("/")+1):"./")+c.movieURL;c.noSWFCache&&(b+="?ts="+(new Date).getTime());return b};
ma=function(){j=parseInt(c.flashVersion,10);8!==j&&9!==j&&(c.flashVersion=j=8);var b=c.debugMode||c.debugFlash?"_debug.swf":".swf";c.useHTML5Audio&&(!c.html5Only&&c.audioFormats.mp4.required&&9>j)&&(c.flashVersion=j=9);c.version=c.versionNumber+(c.html5Only?" (HTML5-only mode)":9===j?" (AS3/Flash 9)":" (AS2/Flash 8)");8<j?(c.defaultOptions=r(c.defaultOptions,c.flash9Options),c.features.buffering=!0,c.defaultOptions=r(c.defaultOptions,c.movieStarOptions),c.filePatterns.flash9=RegExp("\\.(mp3|"+Xa.join("|")+
")(\\?.*)?$","i"),c.features.movieStar=!0):c.features.movieStar=!1;c.filePattern=c.filePatterns[8!==j?"flash9":"flash8"];c.movieURL=(8===j?"soundmanager2.swf":"soundmanager2_flash9.swf").replace(".swf",b);c.features.peakData=c.features.waveformData=c.features.eqData=8<j};Ha=function(b,c){if(!g)return!1;g._setPolling(b,c)};pa=function(){c.debugURLParam.test(ga)&&(c.debugMode=!0)};n=this.getSoundById;F=function(){var b=[];c.debugMode&&b.push("sm2_debug");c.debugFlash&&b.push("flash_debug");c.useHighPerformance&&
b.push("high_performance");return b.join(" ")};ra=function(){t("fbHandler");var b=c.getMoviePercent(),d={type:"FLASHBLOCK"};if(c.html5Only)return!1;c.ok()?c.oMC&&(c.oMC.className=[F(),"movieContainer","swf_loaded"+(c.didFlashBlock?" swf_unblocked":"")].join(" ")):(p&&(c.oMC.className=F()+" movieContainer "+(null===b?"swf_timedout":"swf_error")),c.didFlashBlock=!0,A({type:"ontimeout",ignoreInit:!0,error:d}),E(d))};la=function(b,c,e){void 0===v[b]&&(v[b]=[]);v[b].push({method:c,scope:e||null,fired:!1})};
A=function(b){b||(b={type:c.ok()?"onready":"ontimeout"});if(!i&&b&&!b.ignoreInit||"ontimeout"===b.type&&(c.ok()||s&&!b.ignoreInit))return!1;var d={success:b&&b.ignoreInit?c.ok():!s},e=b&&b.type?v[b.type]||[]:[],a=[],f,d=[d],g=p&&c.useFlashBlock&&!c.ok();b.error&&(d[0].error=b.error);b=0;for(f=e.length;b<f;b++)!0!==e[b].fired&&a.push(e[b]);if(a.length){b=0;for(f=a.length;b<f;b++)a[b].scope?a[b].method.apply(a[b].scope,d):a[b].method.apply(this,d),g||(a[b].fired=!0)}return!0};B=function(){h.setTimeout(function(){c.useFlashBlock&&
ra();A();"function"===typeof c.onload&&c.onload.apply(h);c.waitForWindowLoad&&l.add(h,"load",B)},1)};va=function(){if(void 0!==y)return y;var b=!1,c=navigator,e=c.plugins,a,f=h.ActiveXObject;if(e&&e.length)(c=c.mimeTypes)&&(c["application/x-shockwave-flash"]&&c["application/x-shockwave-flash"].enabledPlugin&&c["application/x-shockwave-flash"].enabledPlugin.description)&&(b=!0);else if(void 0!==f&&!q.match(/MSAppHost/i)){try{a=new f("ShockwaveFlash.ShockwaveFlash")}catch(g){}b=!!a}return y=b};Na=function(){var b,
d,e=c.audioFormats;if(wa&&q.match(/os (1|2|3_0|3_1)/i))c.hasHTML5=!1,c.html5Only=!0,c.oMC&&(c.oMC.style.display="none");else if(c.useHTML5Audio&&(!c.html5||!c.html5.canPlayType))c.hasHTML5=!1;if(c.useHTML5Audio&&c.hasHTML5)for(d in e)if(e.hasOwnProperty(d)&&(e[d].required&&!c.html5.canPlayType(e[d].type)||c.preferFlash&&(c.flash[d]||c.flash[e[d].type])))b=!0;c.ignoreFlash&&(b=!1);c.html5Only=c.hasHTML5&&c.useHTML5Audio&&!b;return!c.html5Only};ba=function(b){var d,e,a=0;if(b instanceof Array){d=0;
for(e=b.length;d<e;d++)if(b[d]instanceof Object){if(c.canPlayMIME(b[d].type)){a=d;break}}else if(c.canPlayURL(b[d])){a=d;break}b[a].url&&(b[a]=b[a].url);b=b[a]}return b};Ka=function(b){b._hasTimer||(b._hasTimer=!0,!za&&c.html5PollingInterval&&(null===O&&0===aa&&(O=h.setInterval(Ma,c.html5PollingInterval)),aa++))};La=function(b){b._hasTimer&&(b._hasTimer=!1,!za&&c.html5PollingInterval&&aa--)};Ma=function(){var b;if(null!==O&&!aa)return h.clearInterval(O),O=null,!1;for(b=c.soundIDs.length-1;0<=b;b--)c.sounds[c.soundIDs[b]].isHTML5&&
c.sounds[c.soundIDs[b]]._hasTimer&&c.sounds[c.soundIDs[b]]._onTimer()};E=function(b){b=void 0!==b?b:{};"function"===typeof c.onerror&&c.onerror.apply(h,[{type:void 0!==b.type?b.type:null}]);void 0!==b.fatal&&b.fatal&&c.disable()};Qa=function(){if(!Sa||!va())return!1;var b=c.audioFormats,d,e;for(e in b)if(b.hasOwnProperty(e)&&("mp3"===e||"mp4"===e))if(c.html5[e]=!1,b[e]&&b[e].related)for(d=b[e].related.length-1;0<=d;d--)c.html5[b[e].related[d]]=!1};this._setSandboxType=function(){};this._externalInterfaceOK=
function(){if(c.swfLoaded)return!1;(new Date).getTime();c.swfLoaded=!0;da=!1;Sa&&Qa();setTimeout(ia,x?100:1)};X=function(b,d){function e(a,b){return'<param name="'+a+'" value="'+b+'" />'}if(I&&J)return!1;if(c.html5Only)return ma(),c.oMC=T(c.movieID),ia(),J=I=!0,!1;var a=d||c.url,f=c.altURL||a,g=oa(),h=F(),j=null,j=k.getElementsByTagName("html")[0],i,m,l,j=j&&j.dir&&j.dir.match(/rtl/i),b=void 0===b?c.id:b;ma();c.url=Ja(Ba?a:f);d=c.url;c.wmode=!c.wmode&&c.useHighPerformance?"transparent":c.wmode;if(null!==
c.wmode&&(q.match(/msie 8/i)||!x&&!c.useHighPerformance)&&navigator.platform.match(/win32|win64/i))c.wmode=null;g={name:b,id:b,src:d,quality:"high",allowScriptAccess:c.allowScriptAccess,bgcolor:c.bgColor,pluginspage:Va+"www.macromedia.com/go/getflashplayer",title:"JS/Flash audio component (SoundManager 2)",type:"application/x-shockwave-flash",wmode:c.wmode,hasPriority:"true"};c.debugFlash&&(g.FlashVars="debug=1");c.wmode||delete g.wmode;if(x)a=k.createElement("div"),m=['<object id="'+b+'" data="'+
d+'" type="'+g.type+'" title="'+g.title+'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="'+Va+'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">',e("movie",d),e("AllowScriptAccess",c.allowScriptAccess),e("quality",g.quality),c.wmode?e("wmode",c.wmode):"",e("bgcolor",c.bgColor),e("hasPriority","true"),c.debugFlash?e("FlashVars",g.FlashVars):"","</object>"].join("");else for(i in a=k.createElement("embed"),g)g.hasOwnProperty(i)&&a.setAttribute(i,g[i]);
pa();h=F();if(g=oa())if(c.oMC=T(c.movieID)||k.createElement("div"),c.oMC.id)l=c.oMC.className,c.oMC.className=(l?l+" ":"movieContainer")+(h?" "+h:""),c.oMC.appendChild(a),x&&(i=c.oMC.appendChild(k.createElement("div")),i.className="sm2-object-box",i.innerHTML=m),J=!0;else{c.oMC.id=c.movieID;c.oMC.className="movieContainer "+h;i=h=null;c.useFlashBlock||(c.useHighPerformance?h={position:"fixed",width:"8px",height:"8px",bottom:"0px",left:"0px",overflow:"hidden"}:(h={position:"absolute",width:"6px",height:"6px",
top:"-9999px",left:"-9999px"},j&&(h.left=Math.abs(parseInt(h.left,10))+"px")));cb&&(c.oMC.style.zIndex=1E4);if(!c.debugFlash)for(l in h)h.hasOwnProperty(l)&&(c.oMC.style[l]=h[l]);try{x||c.oMC.appendChild(a),g.appendChild(c.oMC),x&&(i=c.oMC.appendChild(k.createElement("div")),i.className="sm2-object-box",i.innerHTML=m),J=!0}catch(n){throw Error(t("domError")+" \n"+n.toString());}}return I=!0};W=function(){if(c.html5Only)return X(),!1;if(g||!c.url)return!1;g=c.getMovie(c.id);g||(M?(x?c.oMC.innerHTML=
qa:c.oMC.appendChild(M),M=null,I=!0):X(c.id,c.url),g=c.getMovie(c.id));"function"===typeof c.oninitmovie&&setTimeout(c.oninitmovie,1);return!0};C=function(){setTimeout(Ga,1E3)};Ga=function(){var b,d=!1;if(!c.url||N)return!1;N=!0;l.remove(h,"load",C);if(da&&!Aa)return!1;i||(b=c.getMoviePercent(),0<b&&100>b&&(d=!0));setTimeout(function(){b=c.getMoviePercent();if(d)return N=!1,h.setTimeout(C,1),!1;!i&&Ta&&(null===b?c.useFlashBlock||0===c.flashLoadTimeout?c.useFlashBlock&&ra():Y(!0):0!==c.flashLoadTimeout&&
Y(!0))},c.flashLoadTimeout)};V=function(){if(Aa||!da)return l.remove(h,"focus",V),!0;Aa=Ta=!0;N=!1;C();l.remove(h,"focus",V);return!0};Ra=function(){};K=function(b){if(i)return!1;if(c.html5Only)return i=!0,B(),!0;var d=!0,e;if(!c.useFlashBlock||!c.flashLoadTimeout||c.getMoviePercent())i=!0,s&&(e={type:!y&&p?"NO_FLASH":"INIT_TIMEOUT"});if(s||b)c.useFlashBlock&&c.oMC&&(c.oMC.className=F()+" "+(null===c.getMoviePercent()?"swf_timedout":"swf_error")),A({type:"ontimeout",error:e,ignoreInit:!0}),E(e),d=
!1;s||(c.waitForWindowLoad&&!ja?l.add(h,"load",B):B());return d};Fa=function(){var b,d=c.setupOptions;for(b in d)d.hasOwnProperty(b)&&(void 0===c[b]?c[b]=d[b]:c[b]!==d[b]&&(c.setupOptions[b]=c[b]))};ia=function(){if(i)return!1;if(c.html5Only)return i||(l.remove(h,"load",c.beginDelayedInit),c.enabled=!0,K()),!0;W();try{g._externalInterfaceTest(!1),Ha(!0,c.flashPollingInterval||(c.useHighPerformance?10:50)),c.debugMode||g._disableDebug(),c.enabled=!0,c.html5Only||l.add(h,"unload",ha)}catch(b){return E({type:"JS_TO_FLASH_EXCEPTION",
fatal:!0}),Y(!0),K(),!1}K();l.remove(h,"load",c.beginDelayedInit);return!0};D=function(){if(L)return!1;L=!0;Fa();pa();!y&&c.hasHTML5&&c.setup({useHTML5Audio:!0,preferFlash:!1});Oa();c.html5.usingFlash=Na();p=c.html5.usingFlash;Ra();!y&&p&&c.setup({flashLoadTimeout:1});k.removeEventListener&&k.removeEventListener("DOMContentLoaded",D,!1);W();return!0};ua=function(){"complete"===k.readyState&&(D(),k.detachEvent("onreadystatechange",ua));return!0};na=function(){ja=!0;l.remove(h,"load",na)};va();l.add(h,
"focus",V);l.add(h,"load",C);l.add(h,"load",na);k.addEventListener?k.addEventListener("DOMContentLoaded",D,!1):k.attachEvent?k.attachEvent("onreadystatechange",ua):E({type:"NO_DOM2_EVENTS",fatal:!0})}var fa=null;if(void 0===Q.SM2_DEFER||!SM2_DEFER)fa=new R;Q.SoundManager=R;Q.soundManager=fa})(window);


(function (a) {
a.fn.dcSlick = function (b) {
        var c = {
            classWrapper: "dc-slick",
            classContent: "dc-slick-content",
            width: 260,
            idWrapper: "dc-slick-9",
            location: "left",
            align: "top",
            offset: "100px",
            speed: "slow",
            tabText: "Click",
            classTab: "tab",
            classOpen: "slick-open",
            classClose: "slick-close",
            classToggle: "slick-toggle",
            autoClose: true
        };
        var b = a.extend(c, b);
        var d = this;
        return d.each(function (b) {
            function x(b) {
                var d = a("." + c.classContent, b);
                var e = j.css("border-top-width");
                var f = j.css("border-right-width");
                var g = j.css("border-bottom-width");
                var h = j.css("border-left-width");
                var i = k.outerWidth(true);
                var l = i + "px";
                var m = k.outerHeight(true);
                var n = m + "px";
                var o = d.height();
                var p = d.outerHeight(true) - o;
                var v = u - m;
                a(b).addClass(c.location).addClass("align-" + c.align).css({
                    position: "fixed",
                    zIndex: 1e4
                });
                if (r > v) {
                    o = v - s - p;
                    t = v + "px"
                }
                d.css({
                    height: o + "px"
                });
                if (c.location == "left") {
                    a(b).css({
                        marginLeft: "-" + q
                    });
                    k.css({
                        marginRight: "-" + l
                    });
                    a(b).css({
                        top: c.offset
                    })
                }
                if (c.location == "right") {
                    a(b).css({
                        marginRight: "-" + q
                    });
                    k.css({
                        marginLeft: "-" + l
                    });
                    a(b).css({
                        top: c.offset
                    })
                }
                if (c.location == "top") {
                    a(b).css({
                        marginTop: "-" + t
                    });
                    k.css({
                        marginBottom: "-" + n
                    });
                    if (c.align == "left") {
                        a(b).css({
                            left: c.offset
                        });
                        k.css({
                            left: 0
                        })
                    } else {
                        a(b).css({
                            right: c.offset
                        });
                        k.css({
                            right: 0
                        })
                    }
                }
                if (c.location == "bottom") {
                    a(b).css({
                        marginBottom: "-" + t
                    });
                    k.css({
                        marginTop: "-" + n
                    });
                    if (c.align == "left") {
                        a(b).css({
                            left: c.offset
                        });
                        k.css({
                            left: 0
                        })
                    } else {
                        a(b).css({
                            right: c.offset
                        });
                        k.css({
                            right: 0
                        })
                    }
                }
            }
            function w() {
                j.css({
                    zIndex: 1e4
                });
                if (j.hasClass("active")) {
                    if (c.location == "bottom") {
                        j.animate({
                            marginBottom: "-" + t
                        }, c.speed)
                    }
                    if (c.location == "top") {
                        j.animate({
                            marginTop: "-" + t
                        }, c.speed)
                    }
                    if (c.location == "left") {
                        j.animate({
                            marginLeft: "-" + q
                        }, c.speed)
                    }
                    if (c.location == "right") {
                        j.animate({
                            marginRight: "-" + q
                        }, c.speed)
                    }
                    j.removeClass("active")
                }
            }
            function v() {
                a("." + c.classWrapper).css({
                    zIndex: 1e4
                });
                j.css({
                    zIndex: 10001
                });
                if (c.location == "bottom") {
                    j.animate({
                        marginBottom: "-=5px"
                    }, "fast").animate({
                        marginBottom: 0
                    }, c.speed)
                }
                if (c.location == "top") {
                    j.animate({
                        marginTop: "-=5px"
                    }, "fast").animate({
                        marginTop: 0
                    }, c.speed)
                }
                if (c.location == "left") {
                    j.animate({
                        marginLeft: "-=5px"
                    }, "fast").animate({
                        marginLeft: 0
                    }, c.speed)
                }
                if (c.location == "right") {
                    j.animate({
                        marginRight: "-=5px"
                    }, "fast").animate({
                        marginRight: 0
                    }, c.speed)
                }
                j.addClass("active")
            }
            var e = d.html();
            d.css("float", "left");
            var f = d.width();
            var g = '<div class="' + c.classTab + '"><span>' + c.tabText + "</span></div>";
            a(this).remove();
            var h = c.idWrapper;
            var i = '<div id="' + h + '" class="' + c.classWrapper + '">' + g + '<div class="' + c.classContent + '">' + e + "</div></div>";
            a("body").append(i);
            var j = a("#" + h);
            var k = a("." + c.classTab, j);
            k.css({
                position: "absolute"
            });
            var l = a("." + c.classOpen);
            var m = a("." + c.classClose);
            var n = a("." + c.classToggle);
            var o = j.height();
            var p = j.outerWidth();
            var q = p + "px";
            var r = j.outerHeight();
            var s = r - o;
            var t = r + "px";
            var u = a(window).height();
            x(j);
            if (c.autoClose == true) {
                a("body").mouseup(function (b) {
                    if (j.hasClass("active")) {
                        if (!a(b.target).parents("#" + c.idWrapper + "." + c.classWrapper).length) {
                            if (!(a(b.target).hasClass(c.classOpen) || a(b.target).hasClass(c.classToggle))) {
                                w()
                            }
                        }
                    }
                })
            }
            k.click(function () {
                if (j.hasClass("active")) {
                    w()
                } else {
                    v()
                }
            });
            a(l).click(function (a) {
                v();
                a.preventDefault()
            });
            a(m).click(function (a) {
                if (j.hasClass("active")) {
                    w()
                }
                a.preventDefault()
            });
            a(n).click(function (a) {
                if (j.hasClass("active")) {
                    w()
                } else {
                    v()
                }
                a.preventDefault()
            })
        })
    }
})(jQuery);



(function (a) {
    a.fn.dragx = function (b) {
        var c = {
            repos: false,
            draggable: true,
            containment: "document",
            scroll: false,
            handle: this,
            stack: this,
            animate: true,
            id: freichatusers,
            restore: false,
            restoreElem: "#frei_",
            speed: 500,
            right:"0px"
        };
        var d = a.extend(c, b);
        d.handle = "#chatboxhead_"+d.id;
        var e = a(this);
        var f = Get_Cookie("frei_stat_" + d.id);
        if (f != null) {
            f = f.split("&")
        } else {
            f = new Array("en", "closed", "max", "clear", null, null)
        }
        if (d.draggable == true) {
            e.draggable();
            e.draggable({
                stop: function (b, c) {
                    var top = e.offset().top - $jn(window).scrollTop();
                    //var top = e.offset().top - $jn(window).scrollTop();
                    if (d.animate == true) {
                        //var h = a(window).height() - 604 + 284 + "px";
                        if (top < 0) {
                            e.animate({
                                top: "0px"
                            }, d.speed, function () {
                                Set_Cookie("frei_stat_" + d.id, f[0] + "&" + f[1] + "&" + f[2] + "&" + f[3] + "&" + top + "&" + e.offset().left)
                            })
                        } else if (top > 400) {e.css("top","auto");
                            e.animate({
                                bottom: "0px"
                            }, d.speed, function () {
                                Set_Cookie("frei_stat_" + d.id, f[0] + "&" + f[1] + "&" + f[2] + "&" + f[3] + "&" + top + "&" + e.offset().left)
                            })
                        } else {
                            Set_Cookie("frei_stat_" + d.id, f[0] + "&" + f[1] + "&" + f[2] + "&" + f[3] + "&" + top + "&" + e.offset().left)
                        }
                    }
                }
            }, {
                containment: d.containment
            }, {
                scroll: d.scroll
            }, {
                handle: d.handle
            }, {
                cursor: "move"
            })
        } else {
            e.draggable("disable")
        }
        if (d.repos == true) {
            //console.log(e);
            if(f[4] !=0 && f[5] != 0)
            e.css({
                "top": f[4]+"px",
                "left": f[5]+"px"
            });//, d.speed, function () {
            //    repos = true
            //})
        }
        if (d.restore == true) {
            e.css({
                "top" :"auto",
                "left":"auto"
            });
            //e.find("> div").css("position","absolute");
           e.animate({
                bottom: "0px",
                right: d.right
            }, d.speed, function () {
              //  repos = true
            })

        }
        return e
    }
})(jQuery);
