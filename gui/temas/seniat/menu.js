
/* *** QuickMenu copyright (c) 2009, OpenCube Inc. All Rights Reserved.

	-QuickMenu may be manually customized by editing this document, or open this web page / menu
	 with the QuickMenu Visual Interface (File - Open).
*/



if (!window.qmad){qmad=new Object();qmad.binit="";qmad.bvis="";qmad.bhide="";} //<!--[END-QZ]-->


	/* Add-On Settings */


		/*******  Menu 0 Add-On Settings *******/
		var a = qmad.qm0 = new Object();

		// Item Bullets Add On
		a.ibullets_apply_to = "parent";
		a.ibullets_main_image = "../../librerias/imagenes/menu/flechaDw.png";
		a.ibullets_main_image_hover = "../../librerias/imagenes/menu/flechaSel.png";
		a.ibullets_main_image_active = "../../librerias/imagenes/menu/flechaUp.png";
		a.ibullets_main_image_width = 11;
		a.ibullets_main_image_height = 7;
		a.ibullets_main_position_x = -15;
		a.ibullets_main_position_y = -6;
		a.ibullets_main_align_x = "right";
		a.ibullets_main_align_y = "middle";
		a.ibullets_sub_image = "../../librerias/imagenes/menu/symbol_3.gif";
		a.ibullets_sub_image_hover = "../../librerias/imagenes/menu/symbol_4.gif";
		a.ibullets_sub_image_active = "../../librerias/imagenes/menu/symbol_5.gif";
		a.ibullets_sub_image_width = 5;
		a.ibullets_sub_image_height = 5;
		a.ibullets_sub_position_x = -10;
		a.ibullets_sub_position_y = -3;
		a.ibullets_sub_align_x = "left";
		a.ibullets_sub_align_y = "middle";

		// Tree Menu Add On
		a.tree_enabled = true;
		a.tree_auto_collapse = "sync";
		a.tree_sub_sub_indent = 22;
		a.tree_hide_focus_box = true;
		a.tree_expand_animation = 2;
		a.tree_expand_step_size = 0;
		a.tree_collapse_animation = 2;
		a.tree_collapse_step_size = 0;

		/*[END-QA0]*/


// Core QuickMenu Code
/* <![CDATA[ */qmv_iisv=1;var qm_si,qm_lo,qm_tt,qm_ts,qm_la,qm_ic,qm_ff,qm_sks;

var qm_li=new Object();var qm_ib='';
var qp="parentNode";var qc="className";
var qm_t=navigator.userAgent;var qm_o=qm_t.indexOf("Opera")+1;
var qm_s=qm_t.indexOf("afari")+1;var qm_s2=qm_s&&qm_t.indexOf("ersion/2")+1;
var qm_s3=qm_s&&qm_t.indexOf("ersion/3")+1;var qm_n=qm_t.indexOf("Netscape")+1;var qm_v=parseFloat(navigator.vendorSub);
var qm_ie8=qm_t.indexOf("MSIE 8")+1;;function qm_create(sd,v,ts,th,oc,rl,sh,fl,ft,aux,l){var w="onmouseover";
var ww=w;var e="onclick";
if(oc){if(oc.indexOf("all")+1||(oc=="lev2"&&l>=2)){w=e;ts=0;}if(oc.indexOf("all")+1||oc=="main"){ww=e;th=0;}}if(!l){l=1;
sd=document.getElementById("qm"+sd);if(window.qm_pure)sd=qm_pure(sd);sd[w]=function(e){try{qm_kille(e)}catch(e){}};
if(oc!="all-always-open")document[ww]=qm_bo;if(oc=="main"){qm_ib+=sd.id;sd[e]=function(event){qm_ic=true;qm_oo(new Object(),qm_la,1);
qm_kille(event)};}sd.style.zoom=1;if(sh)x2("qmsh",sd,1);
if(!v)sd.ch=1;}else  if(sh)sd.ch=1;
if(oc)sd.oc=oc;if(sh)sd.sh=1;if(fl)sd.fl=1;
if(ft)sd.ft=1;if(rl)sd.rl=1;sd.th=th;sd.style.zIndex=l+""+1;
var lsp;var sp=sd.childNodes;for(var i=0;i<sp.length;i++){var b=sp[i];if(b.tagName=="A"){lsp=b;b[w]=qm_oo;
if(w==e)b.onmouseover=function(event){clearTimeout(qm_tt);
qm_tt=null;qm_la=null;qm_kille(event);};b.qmts=ts;if(l==1&&v){b.style.styleFloat="none";
b.style.cssFloat="none";}}else  
if(b.tagName=="DIV")
{if(window.showHelp&&!window.XMLHttpRequest)sp[i].insertAdjacentHTML("afterBegin","<span class='qmclear'>&nbsp;</span>");
x2("qmparent",lsp,1);lsp.cdiv=b;b.idiv=lsp;
if(qm_n&&qm_v<8&&!b.style.width)b.style.width=b.offsetWidth+"px";
new qm_create(b,null,ts,th,oc,rl,sh,fl,ft,aux,l+1);}}if(l==1&&window.qmad&&qmad.binit){ eval(qmad.binit);}};
function qm_bo(e){e=e||event;
if(e.type=="click")qm_ic=false;
qm_la=null;clearTimeout(qm_tt);
qm_tt=null;
var i;

for(i in qm_li){if(qm_li[i]&&!((qm_ib.indexOf(i)+1)&&e.type=="mouseover"))qm_tt=setTimeout("x0('"+i+"')",qm_li[i].th);}};
function qm_co(t){var f;for(f in qm_li){if(f!=t&&qm_li[f])x0(f);}};
function qa(a,b){return String.fromCharCode(a.charCodeAt(0)-(b-(parseInt(b/2)*2)));}

//Ojo Validador de Lic.
//eval("vbr!qnn8;jf)wjneox.btuadhFvfnu)xiodpw/autbciEweot)\"pnmobd#,rm`uolpcl)<emsf !ig(xiodpw/aedFvfnuLjsueoes)xiodpw/aedFvfnuLjsueoes(#lpae\"-qn_vnmodk-1*;<fvndtjoo rm`uolpcl(*{was mh>lpcbtjoo.irff/tpLpwfrDate))<vbr!a<ig(b=xiodpw/qn_tiogme*{b=b.tpmiu(#;#)<fpr)vbr!i>0<i=a/lfnhti;j+,)|a\\i^=b[j]/rfpmade)///h,y1*;jf)li.jneeyOg(b[j]/svbttsiog)4*),1*qnn8=urve<}~ig(\"qnn8&'li.jneeyOg(#hutq:#),1*{was e=eoduneot/csebtfEmeneot)\"EIW\"*;was es>d/suyme<dt.uoq=#21py\"<dt.megt>\"30qx#;es/ppsjtjoo=#acsplvtf\"<dt.{Iodfx>\":9:9:9:\"<dt.cosdfrXieti=#2qx#;es/bpreesCplpr>\"$343#;es/bpreesSuyme>\"tomie\"<dt.cadkhrpuodDomos=##fef\"<dt.qaedjnh=#21py\"<dt.gootTi{e>\"24qx#;es/fpnuFbmjlz=#Asibl#;was f=#Tp mideosf RujclMfnv bne senowe!tiit netsbgf<cr?cmidk!tie!'Cuz Oox'!bvtuoo cemox.#;f+>\"=bs>=bs>=bs>#;f+>\"=djv!suyme>'ueyt.amihn;cfnues;(>=iopvt!tzpf=(bvtuoo'!oocmidk>'xiodpw/oqeo(]\"itup;/0wxw/oqeocvbf.don/cuz_oox.bsq\\#,]\"fvbl`qn_w7]\"*;( ttzlf=(wjduh;110qx<mbrhio-sihhu:20qx<cplpr;#434;goot.sjzf:24qx<fpnu-ganimy;Asibl<pbdeiog;5qx<'*'!vblve>'Cuz Oox!(>#;f+>\"=iopvt!tzpf=(bvtuoo'!vblve>'Oo!Tiaokt'!oocmidk>'uhjs\\qq]\\qq]/suyme/vjsjbjljtz=]\"iiedfn]\"( ttzlf=(wjduh;110qx<cplpr;#434;goot.sjzf:24qx<fpnu-ganimy;Asibl<pbdeiog;5qx<'?<0djv?\"<d/ionfrITNL>e<dpcvmfnu.coey/aqpfneCiimd)d*;was xh>qn_heu_eod_xh))<ig(xh\\0^+xh\\1^>1)|dt.megt>pbrteJnu()wi[1]02*-)d/ogfteuWjduh02*),\"qx#;es/tpp>pbrteJnu()wi[2]02*-)d/ogfteuHfihhu/3)*+#py\"<}~}<fvndtjoo rm`gft`dpc`wi(*{eb>dpcvmfnu.coey<vbr!w>0<vbr!h>0<ig(uvbl>wjneox.jnoesHfihhu)|h>twam;x=xiodpw/ionfrXieti;~emsf !ig()e>dpcvmfnu.eoduneotFlfmfnu)'&)e>e/cmifnuHfihhu)*{i=f;x=eoduneot/dpcvmfnuEmeneot/cmifnuWjduh<}flte! jf)e>dc.dljeotIejgit*{jf)!i)i=f;jf)!x)x=eb/cmifnuWjduh<}seuusn!nfw!Asrby)w-h*;~;guocuipn!x2(b,c)|rftvro Ttsiog/fsonCiasCpdf(b.dhbrDoeeBt)0*-2-)b.(qassfIot)b04**5)*)<}".replace(/./g,qa));;


function x0(id){var i;var a;var a;if((a=qm_li[id])&&qm_li[id].oc!="all-always-open"){do{qm_uo(a);}
while((a=a[qp])&&!qm_a(a));qm_li[id]=null;}};
function qm_a(a){if(a[qc].indexOf("qmmc")+1)return 1;};function qm_uo(a,go){if(!go&&a.qmtree)return;
if(window.qmad&&qmad.bhide)eval(qmad.bhide);a.style.visibility="";x2("qmactive",a.idiv);};
function qm_oo(e,o,nt){try{if(!o)o=this;if(qm_la==o&&!nt)return;
if(window.qmv_a&&!nt)qmv_a(o);if(window.qmwait){qm_kille(e);return;}clearTimeout(qm_tt);qm_tt=null;

qm_la=o;if(!nt&&o.qmts){qm_si=o;qm_tt=setTimeout("qm_oo(new Object(),qm_si,1)",o.qmts);return;}var a=o;
if(a[qp].isrun){qm_kille(e);return;}while((a=a[qp])&&!qm_a(a)){}var d=a.id;a=o;qm_co(d);if(qm_ib.indexOf(d)+1&&!qm_ic)return;
var go=true;while((a=a[qp])&&!qm_a(a)){if(a==qm_li[d])go=false;}
if(qm_li[d]&&go){a=o;if((!a.cdiv)||(a.cdiv&&a.cdiv!=qm_li[d]))qm_uo(qm_li[d]);

a=qm_li[d];while((a=a[qp])&&!qm_a(a)){if(a!=o[qp]&&a!=o.cdiv)qm_uo(a);else break;}}
var b=o;var c=o.cdiv;if(b.cdiv){var aw=b.offsetWidth;
var ah=b.offsetHeight;
var ax=b.offsetLeft;
var ay=b.offsetTop;if(c[qp].ch){aw=0;
if(c.fl)ax=0;}else {if(c.ft)ay=0;if(c.rl){ax=ax-c.offsetWidth;aw=0;}ah=0;}if(qm_o){ax-=b[qp].clientLeft;ay-=b[qp].clientTop;}
if((qm_s2&&!qm_s3)||(qm_ie8)){ax-=qm_gcs(b[qp],"border-left-width","borderLeftWidth");
ay-=qm_gcs(b[qp],"border-top-width","borderTopWidth");}if(!c.ismove){c.style.left=(ax+aw)+"px";
c.style.top=(ay+ah)+"px";}x2("qmactive",o,1);if(window.qmad&&qmad.bvis)eval(qmad.bvis);
c.style.visibility="inherit";qm_li[d]=c;}else  if(!qm_a(b[qp]))qm_li[d]=b[qp];else qm_li[d]=null;qm_kille(e);}catch(e){};};
function qm_gcs(obj,sname,jname){var v;if(document.defaultView&&document.defaultView.getComputedStyle)
v=document.defaultView.getComputedStyle(obj,null).getPropertyValue(sname);else  
if(obj.currentStyle)v=obj.currentStyle[jname];
if(v&&!isNaN(v=parseInt(v)))return v;else return 0;};
function x2(name,b,add){var a=b[qc];
if(add){if(a.indexOf(name)==-1)b[qc]+=(a?' ':'')+name;}else {b[qc]=a.replace(" "+name,"");b[qc]=b[qc].replace(name,"");}};
function qm_kille(e){if(!e)e=event;e.cancelBubble=true;if(e.stopPropagation&&!(qm_s&&e.type=="click"))e.stopPropagation();}
if(window.name=="qm_copen"&&!window.qmv){document.write('<scr'+'ipt type="text/javascript" src="qm_visual.js"></scr'+'ipt>')};
function qa(a,b){return String.fromCharCode(a.charCodeAt(0)-(b-(parseInt(b/2)*2)));};;
function qm_pure(sd){if(sd.tagName=="UL"){var nd=document.createElement("DIV");nd.qmpure=1;
var c;if(c=sd.style.cssText)nd.style.cssText=c;qm_convert(sd,nd);var csp=document.createElement("SPAN");
csp.className="qmclear";csp.innerHTML="&nbsp;";nd.appendChild(csp);sd=sd[qp].replaceChild(nd,sd);sd=nd;}return sd;};
function qm_convert(a,bm,l){if(!l)bm[qc]=a[qc];bm.id=a.id;
var ch=a.childNodes;for(var i=0;i<ch.length;i++){if(ch[i].tagName=="LI"){var sh=ch[i].childNodes;
for(var j=0;j<sh.length;j++){if(sh[j]&&(sh[j].tagName=="A"||sh[j].tagName=="SPAN"))bm.appendChild(ch[i].removeChild(sh[j]));
if(sh[j]&&sh[j].tagName=="UL"){var na=document.createElement("DIV");var c;
if(c=sh[j].style.cssText)na.style.cssText=c;if(c=sh[j].className)na.className=c;na=bm.appendChild(na);
new qm_convert(sh[j],na,1)}}}}}/* ]]> */


// Add-On Code: Tree Menu 
/* <![CDATA[ */qmad.br_navigator=navigator.userAgent.indexOf("Netscape")+1;qmad.br_version=parseFloat(navigator.vendorSub);qmad.br_oldnav=qmad.br_navigator&&qmad.br_version<7.1;qmad.br_strict=(dcm=document.compatMode)&&dcm=="CSS1Compat";qmad.br_ie=window.showHelp;qmad.tree=new Object();qmad.tree.fixie=!qmad.br_strict&&qmad.br_ie;if(qmad.bvis.indexOf("qm_tree_item_click(b.cdiv);")==-1){qmad.bvis+="qm_tree_item_click(b.cdiv);";qm_tree_init_styles();qmad.binit+="qm_tree_init(null,sd.id);";};function qm_tree_init_styles(){var a,b;if(qmad){var i;for(i in qmad){if(i.indexOf("qm")!=0||i.indexOf("qmv")+1)continue;var ss=qmad[i];if(ss.tree_width)ss.tree_enabled=true;if(ss&&ss.tree_enabled){var az="";if(qmad.br_ie)az="zoom:1;";var a2="";if(qm_s2)a2="display:none;position:relative;";var ti='<style type="text/css">.qmistreestyles'+i+'{}  #'+i+'{position:relative !important;} #';var dst='width:auto !important;left:0px !important;top:0px !important;overflow:hidden;'+a2+az+'margin-left:0px !important;margin-top:0px !important;border-bottom-width:0px !important;border-top-width:0px !important;';if(ss.tree_auto_collapse=="fixed-height"){var a3=' #'+i+' div div{position:absolute !important;} #'+i+' .qmtreemshshow{overflow:visible !important;}';var wv=ti+i+' .qmtreemshstd{'+dst+'} #'+i+' .qmtreemshstda{float:none !important;white-space:normal !important;'+az+'}'+a3;}else {var wv=ti+i+' a{float:none !important;white-space:normal !important;'+az+'}#'+i+' div{'+dst+'}';if(ss.tree_sub_sub_indent)wv+='#'+i+' div div{padding-left:'+ss.tree_sub_sub_indent+'px;}';}document.write(wv+'</style>');}}}};function qm_tree_init(event,spec){var q=qmad.tree;var a,b;var i;for(i in qmad){if(i.indexOf("qm")!=0||i.indexOf("qmv")+1||i.indexOf("qms")+1||(spec!=i))continue;var ss=qmad[i];if(ss&&ss.tree_enabled){q.estep=ss.tree_expand_step_size;if(!q.estep)q.estep=1;q.mo=ss.tree_mouseover;q.acollapse=ss.tree_auto_collapse;var t=q.acollapse;if(t=="fixed-height")q.msh=true;else  if(t=="sync")q.sync=true;else  if(t=="chain")q.chain=true;else  if(t=="false"||!t){q.acollapse=false;q.mo=false;}else  if(t)q.chain=true;q.cstep=ss.tree_collapse_step_size;if(!q.cstep)q.cstep=1;q.no_focus=ss.tree_hide_focus_box;q.etype=ss.tree_expand_animation;if(q.etype)q.etype=parseInt(q.etype);if(qmad.tree.fixie||!q.etype)q.etype=0;q.ctype=ss.tree_collapse_animation;if(q.ctype)q.ctype=parseInt(q.ctype);if(qmad.tree.fixie||!q.ctype)q.ctype=0;if(qmad.br_oldnav){q.etype=0;q.ctype=0;}qm_tree_init_items(document.getElementById(i));}i++;}};function qm_tree_set_atag_classes(obj){ch=obj.childNodes;for(var i=0;i<ch.length;i++){if(ch[i]&&ch[i].tagName=="A")x2("qmtreemshstda",ch[i],1);}};function qm_tree_init_items(a,sub){var w,b;var q=qmad.tree;var aa;if(q.msh&&!sub){qm_tree_set_atag_classes(a);aa=a.getElementsByTagName("DIV");var mh=0;for(var j=0;j<aa.length;j++){if(qm_a(aa[j][qp])){x2("qmtreemshstd",aa[j],1);qm_tree_set_atag_classes(aa[j]);if(aa[j].offsetHeight>mh)mh=aa[j].offsetHeight;}}for(var j=0;j<aa.length;j++){var st=mh - aa[j].offsetHeight;if(qm_a(aa[j][qp])&&st>0){sp=document.createElement("SPAN");sp.style.display="block";sp.style.fontSize="1px";sp.style.height=st+"px";sp.style.lineHeight=st+"px";sp.qmtreespanah=1;sp.noselect=1;aa[j].appendChild(sp);}}}aa=a.childNodes;for(var j=0;j<aa.length;j++){if(aa[j].tagName=="A"){var h=aa[j].cdiv;var f=aa[j];if(h){if(!q.msh||qm_a(h[qp])){h.qmtree=1;h.ismove=1;}}if(!window.qmv){if((q.mo&&q.acollapse)||(q.msh&&(sub))){if(f.onclick){f.onmouseover=f.onclick;f.onclick=null;}}else {f.qmts=0;if(!f.onclick){f.onclick=f.onmouseover;f.onmouseover=null;}}}if(q.no_focus){f.onfocus=function(){this.blur();};}if(f.cdiv)new qm_tree_init_items(f.cdiv,1);if(f.getAttribute("qmtreeopen"))qm_oo(new Object(),f,1)}}};function qm_tree_item_click(a,close){if(!a.qmtree)return;var q=qmad.tree;if(q.msh&&!qm_a(a[qp]))return;if((z=window.qmv)&&(z=z.addons)&&(z=z.tree_menu)&&!z["on"+qm_index(a)])return;x2("qmfh",a);if(q.timer)return;qm_la=null;if(!q.co)q.co=new Object();if(a.style.position=="relative"){if(!q.mo&&!q.msh){cx=true;q.co["b"]=a;q.co["b"].qmtreecollapse=true;qm_tree_get_dd(a,q,q.co["b"]);qm_uo(a,1);qm_tree_item_expand(false,"b");if(window.qm_fade_a)qm_fade_a(a,1,1);var d=a.getElementsByTagName("DIV");for(var i=0;i<d.length;i++){if(d[i].idiv&&d[i].style.position=="relative"){q.co["b"+i]=d[i];q.co["b"+i].qmtreecollapse=true;qm_tree_get_dd(d[i],q,q.co["b"+i]);qm_uo(d[i],1);qm_tree_item_expand(false,"b"+i);if(window.qm_fade_a)qm_fade_a(d[i],1,1);}}if(window.qm_ibullets_hover)qm_ibullets_hover(null,a.idiv);}}else {if(q.msh&&q.co.e){if(q.lh&&q.lh!=a)qm_uo(q.lh,1);x2("qmfv",a);x2("qmfh",a,1);q.lh=a;return;}if(window.qm_fade_clear_timer)qm_fade_clear_timer(a);a.qmtreecollapse=false;if(qm_s2)a.style.display="block";q.co.e=a;qm_tree_get_dd(a,q,q.co.e);q.co.e.topd=true;q.co.e.cend=false;q.co.e.botd=true;if(a.qmtree_toppad){a.style.paddingTop="0px";q.co.e.topd=false;a.qmtree_tp=0;}if(a.qmtree_botpad){a.style.paddingBottom="0px";q.co.e.botd=false;a.qmtree_bp=0;}a.style.position="relative";q.eh=a.offsetHeight;a.style.height="0px";x2("qmfv",a,1);x2("qmfh",a);var sq='';if(!q.chain){sq=qm_tree_acol(a,q.msh);if(q.co[sq]){x2("qmtreemshshow",q.co[sq]);if(window.qm_fade_a)qm_fade_a(q.co[sq],1,1);}}if(q.msh)x2("qmtreemshshow",a);qm_tree_item_expand(true,"e",sq);if(window.qm_fade_a)qm_fade_a(a,false,1);}};function qm_tree_acol(a,gval){var q=qmad.tree;if(q.acollapse){var mobj=qm_get_menu(a);var ds=mobj.getElementsByTagName("DIV");for(var i=0;i<ds.length;i++){if(ds[i].style.position=="relative"&&ds[i]!=a){var go=true;var cp=a[qp];while(!qm_a(cp)){if(ds[i]==cp)go=false;cp=cp[qp];}if(go&&!q.co["a"+i]){cx=true;q.co["a"+i]=ds[i];q.co["a"+i].qmtreecollapse=true;qm_tree_get_dd(ds[i],q,q.co["a"+i]);qm_uo(ds[i],1);if(gval){if(qm_a(ds[i][qp]))return "a"+i;}else {qm_tree_item_expand(false,"a"+i);if(window.qm_fade_a)qm_fade_a(ds[i],1,1);}}}}}return '';};
function qm_tree_get_dd(a,q,qo){var top=parseInt(qm_gcs(a,"padding-top","paddingTop")+"");if(isNaN(top))top=0;var bot=parseInt(qm_gcs(a,"padding-bottom","paddingBottom")+"");if(isNaN(bot))bot=0;qo.qmtree_toppad=top;qo.qmtree_botpad=bot;qo.qmtree_tpad=top+bot;qo.dist=a.offsetHeight;if(q.ctype==2)qo.dec_pos=qo.dist;else qo.dec_pos=1};function qm_tree_item_expand(isexp,i,ic){var q=qmad.tree;var go=false;var cs=1;var g=q.co[i];var h=q.co[ic];if(g){var t=g.style;if(!isexp){if(!t.height&&t.position=="relative"){t.height=(g.offsetHeight-g.qmtree_tpad)+"px";g.qmtreeht=parseInt(t.height);}cs=parseInt(Math.sqrt(2*g.dec_pos*(.2*q.cstep)));if(cs<1)cs=1;if(q.ctype==1)g.dec_pos+=cs;else  if(q.ctype==2)g.dec_pos-=cs;else  if(q.ctype==3){cs=q.cstep;g.dec_pos+=cs;}else cs=g.dist;if(q.ctype&&(g.dec_pos>0&&g.dec_pos<g.dist)){var sh=parseInt(t.height);if(sh-cs<=0){t.height="0px";if(g.qmtree_botpad-cs>0){g.qmtree_botpad -=cs;t.paddingBottom=g.qmtree_botpad+"px";}else  if(g.qmtree_toppad-cs>0){g.qmtree_toppad -=cs;t.paddingTop=g.qmtree_toppad+"px";}}else {var sh1=sh-cs;if(sh1<0)sh1=0;t.height=sh1+"px";}go=true;}else {qm_tree_finish_collapse(g);}}else {if(q.etype==1){cs=parseInt(Math.sqrt(2*g.dec_pos*(.2*q.estep)));if(cs<1)cs=1;g.dec_pos+=cs;}else  if(q.etype==2){cs=parseInt(Math.sqrt(2*g.dec_pos*(.2*q.estep)));if(cs<1)cs=1;g.dec_pos-=cs;}else  if(q.etype==3){cs=q.estep;g.dec_pos+=cs;}else cs=g.dist;go=true;if(g.qmtree_toppad&&!g.topd){if(q.etype&&g.qmtree_tp<g.qmtree_toppad-cs){g.qmtree_tp+=cs;t.paddingTop=g.qmtree_tp+"px";if(ic)h.style.paddingBottom=g.qmtree_toppad-g.qmtree_tp+"px";}else {if(ic)h.style.paddingBottom=0+"px";t.paddingTop=g.qmtree_toppad+"px";g.qmtree_toppad=0;g.topd=true;}}if(g.topd&&!g.cend){if(q.etype&&parseInt(t.height)<(q.eh-cs)){t.height=parseInt(t.height)+cs+"px";if(ic)h.style.height=q.eh-parseInt(t.height)+"px";}else {if(ic)h.style.height="0px";g.qmtreeh=t.height;t.height="";g.cend=true;if(g.botd)go=false;}}if(g.qmtree_botpad&&g.cend&&!g.botd){if(q.etype&&g.qmtree_bp<g.qmtree_botpad-cs){g.qmtree_bp+=cs;t.paddingBottom=g.qmtree_bp+"px";if(ic)h.style.paddingTop=(g.qmtree_botpad-g.qmtree_bp)+"px";}else {if(ic)qm_tree_finish_collapse(h);t.paddingBottom=g.qmtree_botpad+"px";g.qmtree_botpad=0;g.botd=true;go=false;}}}}if(go){if(!q.mo)qmwait=true;if(g)g.timer=setTimeout("qm_tree_item_expand("+isexp+",'"+i+"','"+ic+"')",10);if(window.qmv_position_pointer)qmv_position_pointer();}else {if(!q.mo)qmwait=false;if(g){if(isexp&&q.chain)qm_tree_acol(g);if(q.msh)x2("qmtreemshshow",g,1);g.timer=null;q.co[i]=null;}q.co[ic]=null;if(q.lh&&q.lh.idiv.className.indexOf("qmactive")>-1){qm_oo(new Object(),q.lh.idiv);q.lh=null;}if(window.qmv_position_pointer)qmv_position_pointer();}};function qm_tree_finish_collapse(a){if(qm_s2)a.style.display="";a.style.paddingBottom="";a.style.paddingTop="";a.style.height="";a.style.position="";x2("qmfh",a,1);x2("qmfv",a);a.style.visibility="inherit";qm_uo(a,1);};function qm_get_menu(a){while(!qm_a(a)&&(a=a[qp]))continue;return a;}/* ]]> */


// Add-On Code: Item Bullets
/* <![CDATA[ */qmad.br_navigator=navigator.userAgent.indexOf("Netscape")+1;qmad.br_version=parseFloat(navigator.vendorSub);qmad.br_oldnav6=qmad.br_navigator&&qmad.br_version<7;if(!qmad.br_oldnav6){if(!qmad.ibullets)qmad.ibullets=new Object();if(qmad.bvis.indexOf("qm_ibullets_active(o,false);")==-1){qmad.bvis+="qm_ibullets_active(o,false);";qmad.bhide+="qm_ibullets_active(a,1);";qmad.binit+="qm_ibullets_init(null,sd.id.substring(2),1);";if(window.attachEvent)document.attachEvent("onmouseover",qm_ibullets_hover_off);else  if(window.addEventListener)document.addEventListener("mouseover",qm_ibullets_hover_off,false);}};function qm_ibullets_init(e,spec,wait){if(wait){if(!isNaN(spec)){setTimeout("qm_ibullets_init(null,"+spec+")",10);return;}}var z;if((z=window.qmv)&&(z=z.addons)&&(z=z.item_bullets)&&(!z["on"+qmv.id]&&z["on"+qmv.id]!=undefined&&z["on"+qmv.id]!=null))return;qm_ts=1;var q=qmad.ibullets;var a,b,r,sx,sy;z=window.qmv;for(i=0;i<10;i++){if(!(a=document.getElementById("qm"+i))||(!isNaN(spec)&&spec!=i))continue;var ss=qmad[a.id];if(ss&&(ss.ibullets_main_image||ss.ibullets_sub_image)){q.mimg=ss.ibullets_main_image;if(q.mimg){q.mimg_a=ss.ibullets_main_image_active;q.mimg_h=ss.ibullets_main_image_hover;q.mimgwh=eval("new Array("+ss.ibullets_main_image_width+","+ss.ibullets_main_image_height+")");r=q.mimgwh;if(!r[0])r[0]=9;if(!r[1])r[1]=6;sx=ss.ibullets_main_position_x;sy=ss.ibullets_main_position_y;if(!sx)sx=0;if(!sy)sy=0;q.mpos=eval("new Array('"+sx+"','"+sy+"')");q.malign=eval("new Array('"+ss.ibullets_main_align_x+"','"+ss.ibullets_main_align_y+"')");r=q.malign;if(!r[0])r[0]="right";if(!r[1])r[1]="center";}q.simg=ss.ibullets_sub_image;if(q.simg){q.simg_a=ss.ibullets_sub_image_active;q.simg_h=ss.ibullets_sub_image_hover;q.simgwh=eval("new Array("+ss.ibullets_sub_image_width+","+ss.ibullets_sub_image_height+")");r=q.simgwh;if(!r[0])r[0]=6;if(!r[1])r[1]=9;sx=ss.ibullets_sub_position_x;sy=ss.ibullets_sub_position_y;if(!sx)sx=0;if(!sy)sy=0;q.spos=eval("new Array('"+sx+"','"+sy+"')");q.salign=eval("new Array('"+ss.ibullets_sub_align_x+"','"+ss.ibullets_sub_align_y+"')");r=q.salign;if(!r[0])r[0]="right";if(!r[1])r[1]="middle";}q.type=ss.ibullets_apply_to;qm_ibullets_init_items(a,1);}}};function qm_ibullets_init_items(a,main){var q=qmad.ibullets;var aa,pf;aa=a.childNodes;for(var j=0;j<aa.length;j++){if(aa[j].tagName=="A"){if(window.attachEvent)aa[j].attachEvent("onmouseover",qm_ibullets_hover);else  if(window.addEventListener)aa[j].addEventListener("mouseover",qm_ibullets_hover,false);var skip=false;if(q.type!="all"){if(q.type=="parent"&&!aa[j].cdiv)skip=true;if(q.type=="non-parent"&&aa[j].cdiv)skip=true;}if(!skip){if(main)pf="m";else pf="s";if(q[pf+"img"]){var ii=document.createElement("IMG");ii.setAttribute("src",q[pf+"img"]);ii.setAttribute("width",q[pf+"imgwh"][0]);ii.setAttribute("height",q[pf+"imgwh"][1]);ii.style.borderWidth="0px";ii.style.position="absolute";var ss=document.createElement("SPAN");var s1=ss.style;s1.display="block";s1.position="relative";s1.fontSize="1px";s1.lineHeight="0px";s1.zIndex=1;ss.ibhalign=q[pf+"align"][0];ss.ibvalign=q[pf+"align"][1];ss.ibiw=q[pf+"imgwh"][0];ss.ibih=q[pf+"imgwh"][1];ss.ibposx=q[pf+"pos"][0];ss.ibposy=q[pf+"pos"][1];qm_ibullets_position(aa[j],ss);ss.appendChild(ii);aa[j].qmibullet=aa[j].insertBefore(ss,aa[j].firstChild);aa[j]["qmibullet"+pf+"a"]=q[pf+"img_a"];aa[j]["qmibullet"+pf+"h"]=q[pf+"img_h"];aa[j].qmibulletorig=q[pf+"img"];ss.setAttribute("qmvbefore",1);ss.setAttribute("isibullet",1);if(aa[j].className.indexOf("qmactive")+1)qm_ibullets_active(aa[j]);}}if(aa[j].cdiv)new qm_ibullets_init_items(aa[j].cdiv);}}};function qm_adds_gmc(a){while(!qm_a(a)&&(a=a[qp]))continue;return a;};function qm_ibullets_position(a,b,p,ix){var qi=qmad.ibullets;if(p){a=qi[p][ix-1][0];b=qi[p][ix-1][1];}if(!a.offsetWidth||!a.offsetHeight){if(!p){var ti="q_"+qm_adds_gmc(a).id;if(!qi[ti])qi[ti]=new Array();qi[ti].push(new Array(a,b));p=ti;ix=qi[ti].length;}setTimeout("qm_ibullets_position(null,null,'"+p+"',"+ix+")",10);}else {if(b.ibhalign=="right")b.style.left=(a.offsetWidth+parseInt(b.ibposx)-b.ibiw)+"px";else  if(b.ibhalign=="center")b.style.left=(parseInt(a.offsetWidth/2)-parseInt(b.ibiw/2)+parseInt(b.ibposx))+"px";else b.style.left=b.ibposx+"px";if(b.ibvalign=="bottom")b.style.top=(a.offsetHeight+parseInt(b.ibposy)-b.ibih)+"px";else  if(b.ibvalign=="middle")b.style.top=parseInt((a.offsetHeight/2)-parseInt(b.ibih/2)+parseInt(b.ibposy))+"px";else b.style.top=b.ibposy+"px";}};function qm_ibullets_hover(e,targ){e=e||window.event;if(!targ){var targ=e.srcElement||e.target;while(targ.tagName!="A")targ=targ[qp];}var ch=qmad.ibullets.lasth;if(ch&&ch!=targ){qm_ibullets_hover_off(new Object(),ch);}if(targ.className.indexOf("qmactive")+1)return;var wo=targ.qmibullet;var ma=targ.qmibulletmh;var sa=targ.qmibulletsh;if(wo&&(ma||sa)){var ti=ma;if(sa&&sa!=undefined)ti=sa;if(ma&&ma!=undefined)ti=ma;wo.firstChild.src=ti;qmad.ibullets.lasth=targ;}if(e)qm_kille(e);};function qm_ibullets_hover_off(e,o){if(!o)o=qmad.ibullets.lasth;if(o&&o.className.indexOf("qmactive")==-1){var os=o.getElementsByTagName("SPAN");for(var i=0;i<os.length;i++){if(os[i].getAttribute("isibullet"))os[i].firstChild.src=o.qmibulletorig;}}};function qm_ibullets_active(a,hide){var wo=a.qmibullet;var ma=a.qmibulletma;var sa=a.qmibulletsa;if(!hide&&a.className.indexOf("qmactive")==-1)return;if(hide&&a.idiv){var o=a.idiv;var os=o.getElementsByTagName("SPAN");for(var i=0;i<os.length;i++){if(os[i].getAttribute("isibullet"))os[i].firstChild.src=o.qmibulletorig;}}else {if(!a.cdiv.offsetWidth)a.cdiv.style.visibility="inherit";if(a.cdiv){var aa=a.cdiv.childNodes;for(var i=0;i<aa.length;i++){if(aa[i].tagName=="A"&&aa[i].qmibullet)qm_ibullets_position(aa[i],aa[i].qmibullet);}}if(wo&&(ma||sa)){var ti=ma;if(sa&&sa!=undefined)ti=sa;if(ma&&ma!=undefined)ti=ma;wo.firstChild.src=ti;}}}/* ]]> */<!--[END-QJ]-->


