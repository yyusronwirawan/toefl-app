import{L as p}from"./Layout.842a4804.js";import{L as u,H as b,r,o as s,c as t,a as c,w as l,b as e,d as v,F as n,e as g,f as d,t as i,g as f}from"./app.a22bdfaf.js";import{_ as x}from"./_plugin-vue_export-helper.cdc0426e.js";const y={layout:p,components:{Link:u,Head:b},props:{lessons:Object}},k={class:"page-wrapper"},w={class:"page-content"},j=d('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Latihan Soal</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li><li class="breadcrumb-item active" aria-current="page">Data Mata Pelajaran</li></ol></nav></div></div><h4 class="mb-0 text-uppercase text-center">Pilih Mata Pelajaran Yang Akan Anda Kerjakan....</h4><hr>',3),L={key:0},S=d('<div class="row row-cols-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12"><div class="col"><div class="card border-bottom border-3 border-0"><div class="card-body"><h5 class="card-title text-center">Mata Pelajaran Belum Tersedia.</h5></div></div></div></div>',1),P=[S],$={class:"row"},A={class:"col-xs-12 col-sm-6 col-md-6 col-lg-3"},D={class:"card border-bottom border-3 border-0"},N=["src"],V={class:"card-body"},B={class:"card-title"},H=e("p",{class:"card-text",style:{height:"100px"}},"Kerjakan Soal Sesuai Perintah Yang Ada Dalam Informasi.",-1),M=e("hr",null,null,-1),C={class:"text-center"},T=f("Selengkapnya");function F(_,I,o,K,Y,E){const m=r("Head"),h=r("Link");return s(),t(n,null,[c(m,null,{default:l(()=>{var a;return[e("title",null,i((a=_.$page.props.setting.app_name)!=null?a:"Atur Setting Terlebih Dahulu")+" - Data Mata Pelajaran",1)]}),_:1}),e("div",k,[e("div",w,[j,o.lessons.length?v("",!0):(s(),t("div",L,P)),e("div",$,[(s(!0),t(n,null,g(o.lessons,a=>(s(),t("div",A,[e("div",D,[e("img",{src:"/storage/upload_files/lessons/"+a.thumbnail,class:"card-img-top"},null,8,N),e("div",V,[e("h5",B,i(a.name),1),H,M,e("div",C,[c(h,{href:`/user/categories/${a.lesson_category.category.id}/lesson-categories/${a.lesson_category_id}/lessons/${a.id}/exams`,class:"btn btn-outline-primary"},{default:l(()=>[T]),_:2},1032,["href"])])])])]))),256))])])])],64)}const G=x(y,[["render",F]]);export{G as default};
