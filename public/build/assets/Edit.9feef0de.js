import{L as y}from"./Layout.842a4804.js";import{L as h,H as x,i as k,r as g,o as s,c as o,a as u,w as b,b as a,j as p,k as n,l as c,n as m,t as d,d as _,F as C,m as V,f as N,g as S}from"./app.a22bdfaf.js";import{S as w}from"./sweetalert2.all.ecb1f0e1.js";import{_ as D}from"./_plugin-vue_export-helper.cdc0426e.js";const L={layout:y,components:{Link:h,Head:x},props:{errors:Object,valueCategory:Object,detailValueCategory:Object},setup(r){const e=k({min_grade:r.detailValueCategory.min_grade,max_grade:r.detailValueCategory.max_grade,category_grade:r.detailValueCategory.category_grade,final_grade:r.detailValueCategory.final_grade});return{form:e,submit:()=>{V.Inertia.put(`/admin/value-categories/${r.valueCategory.id}/detail-value-categories/${r.detailValueCategory.id}`,{value_category_id:r.valueCategory.id,min_grade:e.min_grade,max_grade:e.max_grade,category_grade:e.category_grade,final_grade:e.final_grade},{onSuccess:()=>{w.fire({title:"Success!",text:"Detail Kategori Penilaian Berhasil Disimpan!.",icon:"success",showConfirmButton:!1,timer:1e3})}})}}}},M={class:"page-wrapper"},j={class:"page-content"},B=N('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Kategori Penilaian</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li><li class="breadcrumb-item active" aria-current="page">Edit Detail Kategori Penilaian</li></ol></nav></div></div>',1),K={class:"card border-top border-0 border-3 border-primary"},A={class:"card-body"},E={class:"d-lg-flex align-items-center"},H={class:"ms-auto"},P=S("Kembali"),O={class:"col-12"},T=a("label",{class:"form-label"},"Nilai Minimal",-1),U={key:0,class:"invalid-feedback"},F={class:"col-12"},z=a("label",{class:"form-label"},"Nilai Maksimal",-1),I={key:0,class:"invalid-feedback"},q={class:"col-12"},G=a("label",{class:"form-label"},"Nilai Akhir",-1),J={key:0,class:"invalid-feedback"},Q=a("div",{class:"col-12"},[a("button",{type:"submit",class:"btn btn-primary btn-sm px-5"},"Submit")],-1);function R(r,e,i,l,W,X){const f=g("Head"),v=g("Link");return s(),o(C,null,[u(f,null,{default:b(()=>{var t;return[a("title",null,d((t=r.$page.props.setting.app_name)!=null?t:"Atur Setting Terlebih Dahulu")+" - Edit Detail Kategori Penilaian",1)]}),_:1}),a("div",M,[a("div",j,[B,a("div",K,[a("div",A,[a("div",E,[a("div",H,[u(v,{href:`/admin/value-categories/${i.valueCategory.id}/detail-value-categories`,class:"btn btn-primary btn-sm mt-2 mt-lg-0"},{default:b(()=>[P]),_:1},8,["href"])])]),a("form",{onSubmit:e[3]||(e[3]=p((...t)=>l.submit&&l.submit(...t),["prevent"])),class:"row g-3"},[a("div",O,[T,n(a("input",{type:"number",class:m(["form-control",{"is-invalid":i.errors.min_grade}]),"onUpdate:modelValue":e[0]||(e[0]=t=>l.form.min_grade=t),placeholder:"Nilai Minimal"},null,2),[[c,l.form.min_grade]]),i.errors.min_grade?(s(),o("div",U,d(i.errors.min_grade),1)):_("",!0)]),a("div",F,[z,n(a("input",{type:"number",class:m(["form-control",{"is-invalid":i.errors.max_grade}]),"onUpdate:modelValue":e[1]||(e[1]=t=>l.form.max_grade=t),placeholder:"Nilai Maksimal"},null,2),[[c,l.form.max_grade]]),i.errors.max_grade?(s(),o("div",I,d(i.errors.max_grade),1)):_("",!0)]),a("div",q,[G,n(a("input",{type:"text",class:m(["form-control",{"is-invalid":i.errors.final_grade}]),"onUpdate:modelValue":e[2]||(e[2]=t=>l.form.final_grade=t),placeholder:"Nilai Akhir"},null,2),[[c,l.form.final_grade]]),i.errors.final_grade?(s(),o("div",J,d(i.errors.final_grade),1)):_("",!0)]),Q],32)])])])])],64)}const ea=D(L,[["render",R]]);export{ea as default};
