import{L as d}from"./Layout.842a4804.js";import{L as u,H as m,r as a,o as _,c as p,a as l,w as o,b as t,t as n,F as b,f as h,g as v}from"./app.a22bdfaf.js";import{_ as g}from"./_plugin-vue_export-helper.cdc0426e.js";const f={layout:d,components:{Link:u,Head:m},props:{announcement:Object}},x={class:"page-wrapper"},L={class:"page-content"},k=h('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Pengumuman</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li><li class="breadcrumb-item active" aria-current="page">Edit Pengumuman</li></ol></nav></div></div>',1),y={class:"card"},H={class:"card-body"},w={class:"d-lg-flex align-items-center"},D={class:"ms-auto"},N=v("Kembali"),S={class:"table mb-0"},T=t("tr",null,[t("th",null,"Judul")],-1),V=t("tr",null,[t("td",{colspan:"2"})],-1),B=t("tr",null,[t("th",null,"Dibuat")],-1),E=t("tr",null,[t("td",{colspan:"2"})],-1),P=t("tr",null,[t("th",null,"Deskripsi")],-1),j=["innerHTML"];function A(c,C,e,F,M,$){const i=a("Head"),r=a("Link");return _(),p(b,null,[l(i,null,{default:o(()=>{var s;return[t("title",null,n((s=c.$page.props.setting.app_name)!=null?s:"Atur Setting Terlebih Dahulu")+" - Edit Pengumuman",1)]}),_:1}),t("div",x,[t("div",L,[k,t("div",y,[t("div",H,[t("div",w,[t("div",D,[l(r,{href:"/user/announcements",class:"btn btn-primary btn-sm mt-2 mt-lg-0"},{default:o(()=>[N]),_:1})])]),t("table",S,[t("tbody",null,[T,t("tr",null,[t("td",null,n(e.announcement.title),1)]),V,B,t("tr",null,[t("td",null,n(e.announcement.created_at),1)]),E,P,t("tr",null,[t("td",null,[t("div",{innerHTML:e.announcement.description},null,8,j)])])])])])])])])],64)}const q=g(f,[["render",A]]);export{q as default};