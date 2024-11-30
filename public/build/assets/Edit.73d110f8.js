import{L as v}from"./Layout.842a4804.js";import{L as h,H as p,i as y,r as _,o as r,c as o,a as k,w as u,b as e,j as x,k as c,l as b,n as m,t as l,d,F as B,m as N,f as S,g as w}from"./app.a22bdfaf.js";import{S as V}from"./sweetalert2.all.ecb1f0e1.js";import{_ as L}from"./_plugin-vue_export-helper.cdc0426e.js";const C={layout:v,components:{Link:h,Head:p},props:{errors:Object,bank:Object},setup(i){const a=y({bank_name:i.bank.bank_name,rekening_number:i.bank.rekening_number,rekening_name:i.bank.rekening_name,image:"",is_active:i.bank.is_active});return{form:a,submit:()=>{N.Inertia.post(`/admin/banks/${i.bank.id}`,{forceFormData:!0,_method:"put",bank_name:a.bank_name,rekening_number:a.rekening_number,rekening_name:a.rekening_name,image:a.image,is_active:a.is_active},{onSuccess:()=>{V.fire({title:"Success!",text:"Bank Berhasil Diupdate!.",icon:"success",showConfirmButton:!1,timer:1e3})}})}}}},D={class:"page-wrapper"},j={class:"page-content"},E=S('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Bank</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li><li class="breadcrumb-item active" aria-current="page">Edit Bank</li></ol></nav></div></div>',1),H={class:"card border-top border-0 border-3 border-primary"},A={class:"card-body"},F={class:"d-lg-flex align-items-center"},T={class:"ms-auto"},U=w("Kembali"),I={class:"col-12"},M=e("label",{class:"form-label"},"Nama Bank",-1),O={key:0,class:"invalid-feedback"},z={class:"col-12"},K=e("label",{class:"form-label"},"Logo Bank",-1),R={key:0,class:"invalid-feedback"},q={class:"col-12"},G=e("label",{class:"form-label"},"Nomor Rekening",-1),J={key:0,class:"invalid-feedback"},P={class:"col-12"},Q=e("label",{class:"form-label"},"Atas Nama",-1),W={key:0,class:"invalid-feedback"},X=e("div",{class:"col-12"},[e("button",{type:"submit",class:"btn btn-primary btn-sm px-5"},"Submit")],-1);function Y(i,a,n,t,Z,$){const f=_("Head"),g=_("Link");return r(),o(B,null,[k(f,null,{default:u(()=>{var s;return[e("title",null,l((s=i.$page.props.setting.app_name)!=null?s:"Atur Setting Terlebih Dahulu")+" - Edit Bank",1)]}),_:1}),e("div",D,[e("div",j,[E,e("div",H,[e("div",A,[e("div",F,[e("div",T,[k(g,{href:"/admin/banks",class:"btn btn-primary btn-sm mt-2 mt-lg-0"},{default:u(()=>[U]),_:1})])]),e("form",{onSubmit:a[4]||(a[4]=x((...s)=>t.submit&&t.submit(...s),["prevent"])),class:"row g-3"},[e("div",I,[M,c(e("input",{type:"text",class:m(["form-control",{"is-invalid":n.errors.bank_name}]),"onUpdate:modelValue":a[0]||(a[0]=s=>t.form.bank_name=s),placeholder:"Nama"},null,2),[[b,t.form.bank_name]]),n.errors.bank_name?(r(),o("div",O,l(n.errors.bank_name),1)):d("",!0)]),e("div",z,[K,e("input",{type:"file",class:m(["form-control",{"is-invalid":n.errors.image}]),onInput:a[1]||(a[1]=s=>t.form.image=s.target.files[0]),placeholder:"image"},null,34),n.errors.image?(r(),o("div",R,l(n.errors.image),1)):d("",!0)]),e("div",q,[G,c(e("input",{type:"text",class:m(["form-control",{"is-invalid":n.errors.rekening_number}]),"onUpdate:modelValue":a[2]||(a[2]=s=>t.form.rekening_number=s),placeholder:"Nama"},null,2),[[b,t.form.rekening_number]]),n.errors.rekening_number?(r(),o("div",J,l(n.errors.rekening_number),1)):d("",!0)]),e("div",P,[Q,c(e("input",{type:"text",class:m(["form-control",{"is-invalid":n.errors.rekening_name}]),"onUpdate:modelValue":a[3]||(a[3]=s=>t.form.rekening_name=s),placeholder:"Nama"},null,2),[[b,t.form.rekening_name]]),n.errors.rekening_name?(r(),o("div",W,l(n.errors.rekening_name),1)):d("",!0)]),X],32)])])])])],64)}const te=L(C,[["render",Y]]);export{te as default};
