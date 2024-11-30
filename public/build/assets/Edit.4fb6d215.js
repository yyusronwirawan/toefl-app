import{L as f}from"./Layout.842a4804.js";import{L as h,H as g,i as y,r as c,o as n,c as l,a as u,w as b,b as e,j as k,k as _,l as x,n as d,t as r,d as m,v as S,F as w,m as D,f as N,g as V}from"./app.a22bdfaf.js";import{S as L}from"./sweetalert2.all.ecb1f0e1.js";import{_ as B}from"./_plugin-vue_export-helper.cdc0426e.js";const C={layout:f,components:{Link:h,Head:g},props:{errors:Object,category:Object},setup(i){const t=y({name:i.category.name,thumbnail:"",development_status:i.category.development_status});return{form:t,submit:()=>{D.Inertia.post(`/admin/categories/${i.category.id}`,{forceFormData:!0,_method:"put",name:t.name,thumbnail:t.thumbnail,development_status:t.development_status},{onSuccess:()=>{L.fire({title:"Success!",text:"Kategori Berhasil Diupdate!.",icon:"success",showConfirmButton:!1,timer:1e3})}})}}}},K={class:"page-wrapper"},P={class:"page-content"},T=N('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Kategori Peminatan</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li><li class="breadcrumb-item active" aria-current="page">Edit Kategori Peminatan</li></ol></nav></div></div>',1),j={class:"card border-top border-0 border-3 border-primary"},E={class:"card-body"},H={class:"d-lg-flex align-items-center"},F={class:"ms-auto"},M=V("Kembali"),A={class:"col-12"},I=e("label",{class:"form-label"},"Nama",-1),O={key:0,class:"invalid-feedback"},U={class:"col-12"},z=e("label",{class:"form-label"},"Thumbnail",-1),q={key:0,class:"invalid-feedback"},G={class:"col-12"},J=e("label",{class:"form-label"},"Status Development",-1),Q=e("option",{value:""},"[ Pilih ]",-1),R=e("option",{value:"development"},"Development",-1),W=e("option",{value:"production"},"Production",-1),X=[Q,R,W],Y={key:0,class:"invalid-feedback"},Z=e("div",{class:"col-12"},[e("button",{type:"submit",class:"btn btn-primary btn-sm btn-sm px-5"},"Submit")],-1);function $(i,t,s,o,ee,te){const v=c("Head"),p=c("Link");return n(),l(w,null,[u(v,null,{default:b(()=>{var a;return[e("title",null,r((a=i.$page.props.setting.app_name)!=null?a:"Atur Setting Terlebih Dahulu")+" - Edit Kategori Peminatan",1)]}),_:1}),e("div",K,[e("div",P,[T,e("div",j,[e("div",E,[e("div",H,[e("div",F,[u(p,{href:"/admin/categories",class:"btn btn-primary btn-sm btn-sm mt-2 mt-lg-0"},{default:b(()=>[M]),_:1})])]),e("form",{onSubmit:t[3]||(t[3]=k((...a)=>o.submit&&o.submit(...a),["prevent"])),class:"row g-3"},[e("div",A,[I,_(e("input",{type:"text",class:d(["form-control",{"is-invalid":s.errors.name}]),"onUpdate:modelValue":t[0]||(t[0]=a=>o.form.name=a),placeholder:"Nama"},null,2),[[x,o.form.name]]),s.errors.name?(n(),l("div",O,r(s.errors.name),1)):m("",!0)]),e("div",U,[z,e("input",{type:"file",class:d(["form-control",{"is-invalid":s.errors.thumbnail}]),onInput:t[1]||(t[1]=a=>o.form.thumbnail=a.target.files[0]),placeholder:"Thumbnail"},null,34),s.errors.thumbnail?(n(),l("div",q,r(s.errors.thumbnail),1)):m("",!0)]),e("div",G,[J,_(e("select",{"onUpdate:modelValue":t[2]||(t[2]=a=>o.form.development_status=a),class:d([{"is-invalid":s.errors.development_status},"form-select"])},X,2),[[S,o.form.development_status]]),s.errors.development_status?(n(),l("div",Y,r(s.errors.development_status),1)):m("",!0)]),Z],32)])])])])],64)}const ne=B(C,[["render",$]]);export{ne as default};
