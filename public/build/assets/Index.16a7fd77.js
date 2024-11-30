import{L as x}from"./Layout.842a4804.js";import{H as y,L as w,r as l,o,c as i,a as n,w as r,b as s,t,d,F as b,e as f,f as p}from"./app.a22bdfaf.js";import{P as T}from"./Pagination.5243b31c.js";import{_ as k}from"./_plugin-vue_export-helper.cdc0426e.js";const S={layout:x,components:{Head:y,Pagination:T,Link:w},props:{totalStudent:String,totalStudentActive:String,totalStudentNonActive:String,totalStudentMember:String,totalTransactionToday:String,totalTransactionMonthly:String,totalTransactionYearly:String,totalTransactionPending:String,totalTransactionPaid:String,totalTransactionDone:String,totalTransactionFailed:String,transactions:Object},methods:{formatPrice(c){return"Rp."+(c/1).toFixed(2).replace(".",",").toString().replace(/\B(?=(\d{3})+(?!\d))/g,".")}}},P={class:"page-wrapper"},A={class:"page-content"},N={class:"row row-cols-1 row-cols-md-2 row-cols-xl-4"},B={class:"col"},D={class:"card radius-10 bg-primary bg-gradient"},F={class:"card-body"},L={class:"d-flex align-items-center"},M=s("p",{class:"mb-0 text-white"},"Total Peserta",-1),I={class:"my-1 text-white"},H=s("div",{class:"text-white ms-auto font-35"},[s("i",{class:"bx bxs-group"})],-1),V={class:"col"},j={class:"card radius-10 bg-danger bg-gradient"},C={class:"card-body"},K={class:"d-flex align-items-center"},Y=s("p",{class:"mb-0 text-white"},"Total Akun Aktif",-1),E={class:"my-1 text-white"},J=s("div",{class:"text-white ms-auto font-35"},[s("i",{class:"bx bxs-group"})],-1),O={class:"col"},R={class:"card radius-10 bg-warning bg-gradient"},U={class:"card-body"},q={class:"d-flex align-items-center"},z=s("p",{class:"mb-0 text-dark"},"Total Akun Non-Aktif",-1),G={class:"text-dark my-1"},Q=s("div",{class:"text-dark ms-auto font-35"},[s("i",{class:"bx bx-user-pin"})],-1),W={class:"col"},X={class:"card radius-10 bg-success bg-gradient"},Z={class:"card-body"},$={class:"d-flex align-items-center"},ss=s("p",{class:"mb-0 text-white"},"Total Peserta Menjadi Member",-1),ts={class:"my-1 text-white"},as=s("div",{class:"text-white ms-auto font-35"},[s("i",{class:"bx bx-comment-detail"})],-1),es={class:"row row-cols-1 row-cols-md-2 row-cols-xl-4"},os={class:"col"},is={class:"card radius-10 border-start border-0 border-3 border-info"},ds={class:"card-body"},ns={class:"d-flex align-items-center"},cs=s("p",{class:"mb-0 text-secondary"},"Transakasi Hari Ini",-1),ls={class:"my-1 text-info"},rs=s("div",{class:"widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"},[s("i",{class:"bx bxs-cart"})],-1),_s={class:"col"},hs={class:"card radius-10 border-start border-0 border-3 border-success"},bs={class:"card-body"},us={class:"d-flex align-items-center"},gs=s("p",{class:"mb-0 text-secondary"},"Total Transaksi Bulan Ini",-1),ms={class:"my-1 text-success"},vs=s("div",{class:"widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"},[s("i",{class:"bx bxs-bar-chart-alt-2"})],-1),xs={class:"col"},ys={class:"card radius-10 border-start border-0 border-3 border-danger"},ws={class:"card-body"},fs={class:"d-flex align-items-center"},ps=s("p",{class:"mb-0 text-secondary"},"Total Transaksi Tahun Ini",-1),Ts={class:"my-1 text-danger"},ks=s("div",{class:"widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"},[s("i",{class:"bx bxs-wallet"})],-1),Ss=p('<div class="col"><div class="card radius-10 border-start border-0 border-3 border-warning"><div class="card-body"><div class="d-flex align-items-center"><div><p class="mb-0 text-secondary">Total Pemasukan Bulan Ini</p><h4 class="my-1 text-warning">0</h4></div><div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="bx bxs-group"></i></div></div></div></div></div>',1),Ps={class:"row row-cols-1 row-cols-md-2 row-cols-xl-4"},As={class:"col"},Ns={class:"card radius-10 border-start border-0 border-3 border-warning"},Bs={class:"card-body"},Ds={class:"d-flex align-items-center"},Fs=s("p",{class:"mb-0 text-secondary"},"Transaksi Pending",-1),Ls={class:"my-1"},Ms=s("div",{class:"widgets-icons bg-light-warning text-warning ms-auto"},[s("i",{class:"bx bxs-wallet"})],-1),Is={class:"col"},Hs={class:"card radius-10 border-start border-0 border-3 border-success"},Vs={class:"card-body"},js={class:"d-flex align-items-center"},Cs=s("p",{class:"mb-0 text-secondary"},"Transaksi Dibayar",-1),Ks={class:"my-1"},Ys=s("div",{class:"widgets-icons bg-light-success text-success ms-auto"},[s("i",{class:"bx bxs-wallet"})],-1),Es={class:"col"},Js={class:"card radius-10 border-start border-0 border-3 border-danger"},Os={class:"card-body"},Rs={class:"d-flex align-items-center"},Us=s("p",{class:"mb-0 text-secondary"},"Transaksi Failed",-1),qs={class:"my-1"},zs=s("div",{class:"widgets-icons bg-light-danger text-danger ms-auto"},[s("i",{class:"bx bxs-wallet"})],-1),Gs={class:"col"},Qs={class:"card radius-10 border-start border-0 border-3 border-primary"},Ws={class:"card-body"},Xs={class:"d-flex align-items-center"},Zs=s("p",{class:"mb-0 text-secondary"},"Transaksi Selesai",-1),$s={class:"my-1"},st=s("div",{class:"widgets-icons bg-light-primary text-primary ms-auto"},[s("i",{class:"bx bxs-wallet"})],-1),tt={class:"card border-top border-0 border-3 border-primary"},at={class:"card-body"},et=s("div",{class:"d-flex align-items-center"},[s("div",null,[s("h6",{class:"mb-3"},"Transaksi Bulan Ini")])],-1),ot={class:"table-responsive"},it={class:"table mb-0"},dt=s("thead",{class:"table-light"},[s("tr",null,[s("th",null,"No"),s("th",null,"Kode Transaksi"),s("th",null,"Kategori"),s("th",null,"Judul Ujian"),s("th",null,"Nama Peserta"),s("th",null,"Maksimal Bayar"),s("th",null,"Total"),s("th",null,"Status"),s("th",null,"Actions")])],-1),nt={key:0,align:"center",colspan:"9"},ct={key:0,class:"badge bg-warning"},lt={key:1,class:"badge bg-primary"},rt={key:2,class:"badge bg-danger"},_t={key:3,class:"badge bg-success"},ht={class:"d-flex order-actions"},bt=s("i",{class:"bx bx-grid-alt"},null,-1),ut=s("i",{class:"bx bx-credit-card-front"},null,-1);function gt(c,u,a,mt,vt,g){const m=l("Head"),_=l("Link"),v=l("Pagination");return o(),i(b,null,[n(m,null,{default:r(()=>{var e;return[s("title",null,t((e=c.$page.props.setting.app_name)!=null?e:"Atur Setting Terlebih Dahulu")+" - Data Kategori",1)]}),_:1}),s("div",P,[s("div",A,[s("div",N,[s("div",B,[s("div",D,[s("div",F,[s("div",L,[s("div",null,[M,s("h4",I,t(a.totalStudent),1)]),H])])])]),s("div",V,[s("div",j,[s("div",C,[s("div",K,[s("div",null,[Y,s("h4",E,t(a.totalStudentActive),1)]),J])])])]),s("div",O,[s("div",R,[s("div",U,[s("div",q,[s("div",null,[z,s("h4",G,t(a.totalStudentNonActive),1)]),Q])])])]),s("div",W,[s("div",X,[s("div",Z,[s("div",$,[s("div",null,[ss,s("h4",ts,t(a.totalStudentMember),1)]),as])])])])]),s("div",es,[s("div",os,[s("div",is,[s("div",ds,[s("div",ns,[s("div",null,[cs,s("h4",ls,t(a.totalTransactionToday),1)]),rs])])])]),s("div",_s,[s("div",hs,[s("div",bs,[s("div",us,[s("div",null,[gs,s("h4",ms,t(a.totalTransactionMonthly),1)]),vs])])])]),s("div",xs,[s("div",ys,[s("div",ws,[s("div",fs,[s("div",null,[ps,s("h4",Ts,t(a.totalTransactionYearly),1)]),ks])])])]),Ss]),s("div",Ps,[s("div",As,[s("div",Ns,[s("div",Bs,[s("div",Ds,[s("div",null,[Fs,s("h4",Ls,t(a.totalTransactionPending),1)]),Ms])])])]),s("div",Is,[s("div",Hs,[s("div",Vs,[s("div",js,[s("div",null,[Cs,s("h4",Ks,t(a.totalTransactionPaid),1)]),Ys])])])]),s("div",Es,[s("div",Js,[s("div",Os,[s("div",Rs,[s("div",null,[Us,s("h4",qs,t(a.totalTransactionFailed),1)]),zs])])])]),s("div",Gs,[s("div",Qs,[s("div",Ws,[s("div",Xs,[s("div",null,[Zs,s("h4",$s,t(a.totalTransactionDone),1)]),st])])])])]),s("div",tt,[s("div",at,[et,s("div",ot,[s("table",it,[dt,s("tbody",null,[s("tr",null,[a.transactions.data.length?d("",!0):(o(),i("td",nt,"Data Transaksi kosong"))]),(o(!0),i(b,null,f(a.transactions.data,(e,h)=>(o(),i("tr",{key:h},[s("td",null,t(++h+(a.transactions.current_page-1)*a.transactions.per_page),1),s("td",null,t(e.code),1),s("td",null,t(e.exam.category.name),1),s("td",null,t(e.exam.title),1),s("td",null,t(e.user.name),1),s("td",null,t(e.maximum_payment_time),1),s("td",null,t(g.formatPrice(e.total_purchases)),1),s("td",null,[e.transaction_status=="pending"?(o(),i("span",ct,"Pending")):d("",!0),e.transaction_status=="paid"?(o(),i("span",lt,"Paid")):d("",!0),e.transaction_status=="failed"?(o(),i("span",rt,"Failed")):d("",!0),e.transaction_status=="done"?(o(),i("span",_t,"Done")):d("",!0)]),s("td",null,[s("div",ht,[n(_,{href:`/admin/transactions/${e.id}`,style:{margin:"5px"}},{default:r(()=>[bt]),_:2},1032,["href"]),n(_,{href:`/admin/transactions/${e.id}/invoice`,style:{margin:"5px"}},{default:r(()=>[ut]),_:2},1032,["href"])])])]))),128))])])]),n(v,{links:a.transactions.links,align:"end"},null,8,["links"])])])])])],64)}const pt=k(S,[["render",gt]]);export{pt as default};
