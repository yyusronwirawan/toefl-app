import{L as p}from"./Layout.842a4804.js";import{L as x,H as C,i as S,r as b,o as l,c as r,a as v,w as u,b as e,j as V,k as c,v as f,n as d,F as y,e as w,t as n,d as m,l as _,m as N,f as B,g as L}from"./app.a22bdfaf.js";import{S as P}from"./sweetalert2.all.ecb1f0e1.js";import{_ as K}from"./_plugin-vue_export-helper.cdc0426e.js";const j={layout:p,components:{Link:x,Head:C},props:{errors:Object,valueCategory:Object,categories:Object},setup(i){const a=S({name:i.valueCategory.name,category_id:i.valueCategory.category_id,assessment_type:i.valueCategory.assessment_type,section:i.valueCategory.section,variable:i.valueCategory.variable});return{form:a,submit:()=>{N.Inertia.put(`/admin/value-categories/${i.valueCategory.id}`,{name:a.name,category_id:a.category_id,assessment_type:a.assessment_type,section:a.section,variable:a.variable},{onSuccess:()=>{P.fire({title:"Success!",text:"Kategori Penilaian Berhasil Diupdate!.",icon:"success",showConfirmButton:!1,timer:1e3})}})}}}},T={class:"page-wrapper"},U={class:"page-content"},D=B('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Kategori Penilaian</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li><li class="breadcrumb-item active" aria-current="page">Tambah Kategori Penilaian</li></ol></nav></div></div>',1),H={class:"card border-top border-0 border-3 border-primary"},J={class:"card-body"},E={class:"d-lg-flex align-items-center"},M={class:"ms-auto"},O=L("Kembali"),A={class:"col-12"},F=e("label",{class:"form-label"},"Category",-1),z=e("option",{value:""},"[ Pilih ]",-1),I=["value"],q={key:0,class:"invalid-feedback"},G={class:"col-12"},Q=e("label",{class:"form-label"},"Nama Kategori",-1),R={key:0,class:"invalid-feedback"},W={class:"col-12"},X=e("label",{class:"form-label"},"Jenis Penilaian",-1),Y=e("option",{value:""},"[ Pilih ]",-1),Z=e("option",{value:"1"},"Nilai = Jumlah Benar : Total Soal",-1),$=e("option",{value:"2"},"Nilai = Jumlah Jawaban Benar",-1),ee=[Y,Z,$],ae={key:0,class:"invalid-feedback"},se={class:"col-12"},te=e("label",{class:"form-label"},"Section",-1),oe={key:0,class:"invalid-feedback"},ie={class:"col-12"},le=e("label",{class:"form-label"},"Variable",-1),re={key:0,class:"invalid-feedback"},ne=e("div",{class:"col-12"},[e("button",{type:"submit",class:"btn btn-primary btn-sm px-5"},"Submit")],-1);function ce(i,a,s,o,de,me){const g=b("Head"),h=b("Link");return l(),r(y,null,[v(g,null,{default:u(()=>{var t;return[e("title",null,n((t=i.$page.props.setting.app_name)!=null?t:"Atur Setting Terlebih Dahulu")+" - Edit Kategori Penilaian",1)]}),_:1}),e("div",T,[e("div",U,[D,e("div",H,[e("div",J,[e("div",E,[e("div",M,[v(h,{href:"/admin/value-categories",class:"btn btn-primary btn-sm mt-2 mt-lg-0"},{default:u(()=>[O]),_:1})])]),e("form",{onSubmit:a[5]||(a[5]=V((...t)=>o.submit&&o.submit(...t),["prevent"])),class:"row g-3"},[e("div",A,[F,c(e("select",{"onUpdate:modelValue":a[0]||(a[0]=t=>o.form.category_id=t),class:d([{"is-invalid":s.errors.category_id},"form-select"])},[z,(l(!0),r(y,null,w(s.categories,(t,k)=>(l(),r("option",{key:k,value:t.id},n(t.name),9,I))),128))],2),[[f,o.form.category_id]]),s.errors.category_id?(l(),r("div",q,n(s.errors.category_id),1)):m("",!0)]),e("div",G,[Q,c(e("input",{type:"text",class:d(["form-control",{"is-invalid":s.errors.name}]),"onUpdate:modelValue":a[1]||(a[1]=t=>o.form.name=t),placeholder:"Nama"},null,2),[[_,o.form.name]]),s.errors.name?(l(),r("div",R,n(s.errors.name),1)):m("",!0)]),e("div",W,[X,c(e("select",{"onUpdate:modelValue":a[2]||(a[2]=t=>o.form.assessment_type=t),class:d([{"is-invalid":s.errors.assessment_type},"form-select"])},ee,2),[[f,o.form.assessment_type]]),s.errors.assessment_type?(l(),r("div",ae,n(s.errors.assessment_type),1)):m("",!0)]),e("div",se,[te,c(e("input",{type:"text",class:d(["form-control",{"is-invalid":s.errors.section}]),"onUpdate:modelValue":a[3]||(a[3]=t=>o.form.section=t),placeholder:"Section"},null,2),[[_,o.form.section]]),s.errors.section?(l(),r("div",oe,n(s.errors.section),1)):m("",!0)]),e("div",ie,[le,c(e("input",{type:"text",class:d(["form-control",{"is-invalid":s.errors.variable}]),"onUpdate:modelValue":a[4]||(a[4]=t=>o.form.variable=t),placeholder:"variable"},null,2),[[_,o.form.variable]]),s.errors.variable?(l(),r("div",re,n(s.errors.variable),1)):m("",!0)]),ne],32)])])])])],64)}const fe=K(j,[["render",ce]]);export{fe as default};
