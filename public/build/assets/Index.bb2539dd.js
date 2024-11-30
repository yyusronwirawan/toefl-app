import{L as b}from"./Layout.842a4804.js";import{L as g,H as f,r as x,o as a,c as i,a as k,w as y,b as t,d as o,t as s,F as u,e as w,m as v,f as h,g as d,j as V}from"./app.a22bdfaf.js";import{S as T}from"./sweetalert2.all.ecb1f0e1.js";import{_ as P}from"./_plugin-vue_export-helper.cdc0426e.js";const B={layout:b,components:{Link:g,Head:f},props:{vouchers:Object},setup(){return{buyVoucher:(l,n)=>{T.fire({title:"Apakah Anda yakin akan membeli paket ini ?",text:"jika membeli paket ini, silakan lakukan konfirmasi",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Ya",cancelButtonText:"Tidak"}).then(_=>{_.isConfirmed&&v.Inertia.get(`/user/vouchers/${l}/buy?category_id=${n}`)})}}},data(){return{colors:["danger","primary","warning","success"]}},methods:{formatPrice(r){return(r/1).toFixed().replace(".",",").toString().replace(/\B(?=(\d{3})+(?!\d))/g,".")}}},C={class:"page-wrapper"},L={class:"page-content"},S=h('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Voucher</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li><li class="breadcrumb-item active" aria-current="page">Pembelian Voucher</li></ol></nav></div></div><h4 class="mb-0 text-uppercase text-center">Pilih Voucher Sesuai Targetmu....</h4><br><h6 class="text-center">Scroll kebawah untuk melihat lebih banyak voucher</h6><hr>',5),H={key:0},N=h('<div class="row row-cols-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12"><div class="col"><div class="card border-bottom border-3 border-0"><div class="card-body"><h5 class="card-title text-center">Voucher Belum Tersedia.</h5></div></div></div></div>',1),j=[N],A={class:"pricing-table"},F={key:0,class:"alert alert-danger border-0"},R={class:"row row-cols-1 row-cols-lg-3"},D={class:"card mb-5 mb-lg-0"},E={key:0,class:"card-header bg-primary py-3"},I={class:"card-title text-white text-center"},M=t("br",null,null,-1),O={class:"text-white text-center"},Y=d(),$={class:"badge bg-warning text-dark"},q={class:"card-price text-white text-center"},z={class:"term"},G={key:1,class:"card-header bg-danger py-3"},J={class:"card-title text-white text-center"},K=t("br",null,null,-1),Q={class:"text-white text-center"},U=d(),W={class:"badge bg-warning text-dark"},X={class:"card-price text-white text-center"},Z={class:"term"},ee={class:"card-body"},te={class:"text-center"},se=t("hr",null,null,-1),ae=["innerHTML"],ie=t("hr",null,null,-1),re={key:0},ce={class:"text-center"},oe=t("hr",null,null,-1),ne={class:"d-grid"},de=["onClick"],le=t("br",null,null,-1);function _e(r,l,n,_,ue,c){const m=x("Head");return a(),i(u,null,[k(m,null,{default:y(()=>{var e;return[t("title",null,s((e=r.$page.props.setting.app_name)!=null?e:"Atur Setting Terlebih Dahulu")+" - Data Voucher",1)]}),_:1}),t("div",C,[t("div",L,[S,n.vouchers.length?o("",!0):(a(),i("div",H,j)),t("div",A,[r.$page.props.session.error?(a(),i("div",F,s(r.$page.props.session.error),1)):o("",!0),t("div",R,[(a(!0),i(u,null,w(n.vouchers,(e,p)=>(a(),i("div",{class:"col",key:p},[t("div",D,[e.category.name=="TOEFL"?(a(),i("div",E,[t("h5",I,s(e.code),1),M,t("h5",O,[t("s",null,"Rp."+s(c.formatPrice(e.price_before_discount)),1),Y,t("span",$,s(c.formatPrice((e.price_before_discount-e.price_after_discount)/e.price_before_discount*100))+"%",1)]),t("h6",q,[d("Rp."+s(c.formatPrice(e.price_after_discount)),1),t("span",z,"/"+s(e.active_period)+" "+s(e.type),1)])])):o("",!0),e.category.name=="TOEIC"?(a(),i("div",G,[t("h5",J,s(e.code),1),K,t("h5",Q,[t("s",null,"Rp."+s(c.formatPrice(e.price_before_discount)),1),U,t("span",W,s(c.formatPrice((e.price_before_discount-e.price_after_discount)/e.price_before_discount*100))+"%",1)]),t("h6",X,[d("Rp."+s(c.formatPrice(e.price_after_discount)),1),t("span",Z,"/"+s(e.active_period)+" "+s(e.type),1)])])):o("",!0),t("div",ee,[t("h6",te,s(e.name),1),se,t("div",{innerHTML:e.description,style:{"min-height":"175px"}},null,8,ae),ie,e.user_limit&&e.user_limit>e.voucher_selected_transacation_count?(a(),i("div",re,[t("h6",ce,"Tersisa "+s(e.user_limit-e.voucher_selected_transacation_count)+" kuota dari "+s(e.user_limit),1),oe])):o("",!0),t("div",ne,[t("a",{href:"#",onClick:V(he=>_.buyVoucher(e.id,e.category_id),["prevent"]),class:"btn btn-outline-primary px-5 radius-30"},"Pilih Paket",8,de)])])]),le]))),128))])])])])],64)}const fe=P(B,[["render",_e]]);export{fe as default};