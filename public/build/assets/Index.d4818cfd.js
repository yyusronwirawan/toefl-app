import{L as y}from"./Layout.842a4804.js";import{P as w}from"./Pagination.5243b31c.js";import{S as x}from"./sweetalert2.all.ecb1f0e1.js";import{L as S,H as B,r as d,o as s,c as a,a as r,w as _,b as e,d as i,t as l,F as u,e as C,m as $,f as h,j as P,g as p}from"./app.a22bdfaf.js";import{_ as T}from"./_plugin-vue_export-helper.cdc0426e.js";const L={layout:y,components:{Link:S,Head:B,Pagination:w},props:{exams:Object},setup(){return{buyExam:c=>{x.fire({title:"Apakah Anda yakin akan membeli paket ini ?",text:"jika membeli paket ini, silakan lakukan konfirmasi",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Ya",cancelButtonText:"Tidak"}).then(n=>{n.isConfirmed&&$.Inertia.get(`/user/transactions/exams/${c}/buy`)})}}},methods:{formatPrice(o){return(o/1).toFixed().replace(".",",").toString().replace(/\B(?=(\d{3})+(?!\d))/g,".")}}},j={class:"page-wrapper"},A={class:"page-content"},E={class:"page-breadcrumb d-none d-sm-flex align-items-center mb-3"},N=h('<div class="breadcrumb-title pe-3">Try Out</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li><li class="breadcrumb-item active" aria-current="page">Soal</li></ol></nav></div>',2),V={class:"ms-auto"},H=p("Kembali"),D=e("hr",null,null,-1),F={key:0},I=h('<div class="row row-cols-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12"><div class="col"><div class="card border-bottom border-3 border-0"><div class="card-body"><h5 class="card-title text-center">Soal Belum Tersedia.</h5></div></div></div></div>',1),K=[I],O={key:1,class:"alert alert-danger border-0"},Y={class:"row"},M={class:"card border-bottom border-3 border-0"},R={class:"p-2"},q=["src"],z={class:"card-body"},G={class:"card-title"},J=e("p",{class:"card-text"},"Kerjakan Soal Sesuai Perintah Yang Ada Dalam Informasi.",-1),Q=e("hr",null,null,-1),U={key:0,class:"text-center"},W={key:0},X=e("h5",null,[e("span",{class:"badge badge-pill bg-primary ms-1"},"Enrolled")],-1),Z=[X],ee={key:1},te={class:"badge badge-pill bg-danger ms-1"},se=e("hr",null,null,-1),ae={class:"text-center"},oe={key:0},ne=p("Kerjakan Soal"),re={key:1},ie=["onClick"],le={key:2,class:"row"},ce={class:"col"},de=e("br",null,null,-1),_e=e("br",null,null,-1);function me(o,c,n,b,ue,g){const v=d("Head"),m=d("Link"),k=d("Pagination");return s(),a(u,null,[r(v,null,{default:_(()=>{var t;return[e("title",null,l((t=o.$page.props.setting.app_name)!=null?t:"Atur Setting Terlebih Dahulu")+" - Soal",1)]}),_:1}),e("div",j,[e("div",A,[e("div",E,[N,e("div",V,[r(m,{href:"/user/categories",class:"btn btn-primary btn-sm mt-2 mt-lg-0"},{default:_(()=>[H]),_:1})])]),D,n.exams.data.length?i("",!0):(s(),a("div",F,K)),o.$page.props.session.error?(s(),a("div",O,l(o.$page.props.session.error),1)):i("",!0),e("div",Y,[(s(!0),a(u,null,C(n.exams.data,(t,f)=>(s(),a("div",{class:"col-xs-12 col-sm-6 col-md-6 col-lg-3",key:f},[e("div",M,[e("div",R,[e("img",{src:"/storage/upload_files/categories/"+t.category.thumbnail,class:"card-img"},null,8,q)]),e("div",z,[e("h6",G,l(t.title),1),J,Q,o.$page.props.auth.user.member_type==2&&o.$page.props.setting.add_voucher_purchase==1?(s(),a("div",U,[t.transaction.length>0?(s(),a("div",W,Z)):(s(),a("div",ee,[e("h5",null,[e("span",te,"Rp. "+l(g.formatPrice(t.price)),1)])])),se])):i("",!0),e("div",ae,[t.transaction.length>0||o.$page.props.auth.user.member_type==1||o.$page.props.setting.add_voucher_purchase==0?(s(),a("div",oe,[r(m,{href:`/user/categories/${t.category_id}/exams/${t.id}`,class:"btn btn-outline-primary w-100 btn-sm"},{default:_(()=>[ne]),_:2},1032,["href"])])):(s(),a("div",re,[e("a",{href:"#",onClick:P(he=>b.buyExam(t.id),["prevent"]),class:"btn btn-outline-primary w-100 btn-block btn-sm"},"Beli Paket Try Out",8,ie)]))])])])]))),128))]),n.exams.data.length?(s(),a("div",le,[e("div",ce,[r(k,{links:n.exams.links,align:"center"},null,8,["links"]),de,_e])])):i("",!0)])])],64)}const fe=T(L,[["render",me]]);export{fe as default};
