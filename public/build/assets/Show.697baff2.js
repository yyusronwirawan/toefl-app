import{L as S}from"./Layout.842a4804.js";import{L as C,H as p,r as b,o as l,c as s,a as _,w as k,b as t,t as n,j as h,d as i,F as y,e as j,m as g,f as A,g as T}from"./app.a22bdfaf.js";import{P as D}from"./Pagination.5243b31c.js";import{S as r}from"./sweetalert2.all.ecb1f0e1.js";import{_ as N}from"./_plugin-vue_export-helper.cdc0426e.js";const H={layout:S,components:{Link:C,Head:p,Pagination:D},props:{exam:Object,rankingExams:Object},setup(o){return{regenerateCode:()=>{r.fire({title:"Generarate Kode Baru !",text:"Apakah Anda Yakin Akan Generate Kode Baru ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Generate Kode"}).then(d=>{d.isConfirmed&&(g.Inertia.get(`/admin/exams/${o.exam.id}/regenerate-block-tokens`),r.fire({title:"Success!",text:"Kode Berhasil Diperbarui.",icon:"success",timer:1e3,showConfirmButton:!1}))})},destroy:d=>{r.fire({title:"Apakah Anda yakin?",text:"Anda tidak akan dapat mengembalikan ini!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Hapus"}).then(c=>{c.isConfirmed&&(g.Inertia.delete(`/admin/exams/grades/${d}/destroy`),r.fire({title:"Deleted!",text:"Nilai Berhasil Dihapus!.",icon:"success",timer:1e3,showConfirmButton:!1}))})},regenerateTryoutScore:d=>{r.fire({title:"Konfirmasi Hitung Ulang Nilai",text:"Hitung ulang nilai akan berpengaruh pada nilai yang sudah ada.",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Hitung Ulang"}).then(c=>{c.isConfirmed&&(g.Inertia.get(`/admin/exams/grades/${d}/regenerate-score`),r.fire({title:"Success!",text:"Hitung Ulang Berhasil.",icon:"success",timer:1e3,showConfirmButton:!1}))})}}}},K={class:"page-wrapper"},P={class:"page-content"},U=A('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Ujian</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li><li class="breadcrumb-item active" aria-current="page">Detail Ujian</li></ol></nav></div></div>',1),M={class:"card border-top border-0 border-3 border-primary"},Y={class:"card-body"},L={class:"d-lg-flex align-items-center"},W={class:"ms-auto"},I=T("Kembali"),q={class:"table mb-0"},G=t("th",{width:"350px"},"Kategori",-1),V=t("td",{width:"10px"},":",-1),J=t("th",null,"Judul Soal",-1),R=t("td",null,":",-1),F=t("th",null,"Template Sertifikat",-1),O=t("td",null,":",-1),z=t("th",null,"Judul Ujian",-1),Q=t("td",null,":",-1),X=t("th",null,"Deskripsi",-1),Z=t("td",null,":",-1),E=["innerHTML"],$=t("th",null,"Soal Acak",-1),tt=t("td",null,":",-1),et=t("th",null,"Jawaban Acak",-1),nt=t("td",null,":",-1),at=t("th",null,"Tampilkan Jawaban",-1),lt=t("td",null,":",-1),st=t("th",null,"Tampilkan Navigasi Nomor Soal",-1),it=t("td",null,":",-1),ot=t("th",null,"Tampilkan Nomor Soal",-1),dt=t("td",null,":",-1),rt=t("th",null,"Pertanyaan Berikutnya Secara Otomatis",-1),ut=t("td",null,":",-1),ct=t("th",null,"Tampilkan Button Sebelum & Selanjutnya",-1),_t=t("td",null,":",-1),ht=t("th",null,"Tipe Pilihan Ganda",-1),mt=t("td",null,":",-1),bt=t("th",null,"Tampilan Button Akhiri Ujian / Sesi Selanjutnya",-1),kt=t("td",null,":",-1),gt=t("th",null,"Peserta Dapat Mengulangi Ujian",-1),xt=t("td",null,":",-1),ft=t("th",null,"Peserta Dapat Mencetak Sertifikat",-1),vt=t("td",null,":",-1),yt=t("th",null,"Masa Berlaku Sertifikat",-1),Tt=t("td",null,":",-1),Bt=t("th",null,"Tampilkan Ranking Ujian",-1),wt=t("td",null,":",-1),St=t("th",null,"Waktu Akses Mulai Ujian",-1),Ct=t("td",null,":",-1),pt=t("th",null,"Waktu Berakhir Akses Ujian",-1),jt=t("td",null,":",-1),At=t("th",null,"Maksimal Toleransi Keluar Tes",-1),Dt=t("td",null,":",-1),Nt={key:0},Ht=t("th",null,"Kode Membuka Blokir",-1),Kt=t("td",null,":",-1),Pt={class:"input-group"},Ut=["value"],Mt=t("i",{class:"bx bx-refresh"},null,-1),Yt=T("Regenerate Kode"),Lt=[Mt,Yt],Wt=t("th",null,"Status Ujian",-1),It=t("td",null,":",-1),qt={key:0,class:"badge bg-primary"},Gt={key:1,class:"badge bg-success"},Vt={key:2,class:"badge bg-danger"},Jt={class:"card border-top border-0 border-3 border-primary"},Rt={class:"card-header mb-3"},Ft={class:"d-flex justify-content-between"},Ot=t("div",{class:"text-start"},[t("h5",{class:"mb-0"},"Ranking Pada Tes Ini")],-1),zt={class:"ms-auto"},Qt=["href"],Xt={class:"card-body"},Zt={class:"table-responsive"},Et={class:"table mb-0"},$t=t("thead",null,[t("tr",null,[t("th",null,"Peringkat"),t("th",null,"Nama"),t("th",null,"Provinsi"),t("th",null,"Kota"),t("th",null,"Status"),t("th",null,"Nilai"),t("th",{width:"140px"},"Action")])],-1),te={key:0,align:"center",colspan:"7"},ee=["onClick"],ne={key:0,class:"badge bg-danger"},ae={key:0,class:"badge bg-primary"},le={class:"d-flex order-actions"},se=["href"],ie=t("i",{class:"bx bx-file"},null,-1),oe=[ie],de=t("i",{class:"bx bx-grid-alt"},null,-1),re=["onClick"],ue=t("i",{class:"bx bx-refresh"},null,-1),ce=[ue],_e=["onClick"],he=t("i",{class:"bx bxs-trash"},null,-1),me=[he];function be(o,m,e,u,d,c){const B=b("Head"),x=b("Link"),w=b("Pagination");return l(),s(y,null,[_(B,null,{default:k(()=>{var a;return[t("title",null,n((a=o.$page.props.setting.app_name)!=null?a:"Atur Setting Terlebih Dahulu")+" - Ujian",1)]}),_:1}),t("div",K,[t("div",P,[U,t("div",M,[t("div",Y,[t("div",L,[t("div",W,[_(x,{href:"/admin/exams",class:"btn btn-primary btn-sm mt-2 mt-lg-0"},{default:k(()=>[I]),_:1})])]),t("table",q,[t("tbody",null,[t("tr",null,[G,V,t("td",null,n(e.exam.category.name),1)]),t("tr",null,[J,R,t("td",null,n(e.exam.question_title.name),1)]),t("tr",null,[F,O,t("td",null,n(e.exam.template.name),1)]),t("tr",null,[z,Q,t("td",null,n(e.exam.title),1)]),t("tr",null,[X,Z,t("td",null,[t("div",{innerHTML:e.exam.description},null,8,E)])]),t("tr",null,[$,tt,t("td",null,n(e.exam.random_question==1?"Ya":"Tidak"),1)]),t("tr",null,[et,nt,t("td",null,n(e.exam.random_answer==1?"Ya":"Tidak"),1)]),t("tr",null,[at,lt,t("td",null,n(e.exam.show_answer==1?"Ya":"Tidak"),1)]),t("tr",null,[st,it,t("td",null,n(e.exam.show_question_number_navigation==1?"Ya":"Tidak"),1)]),t("tr",null,[ot,dt,t("td",null,n(e.exam.show_question_number==1?"Ya":"Tidak"),1)]),t("tr",null,[rt,ut,t("td",null,n(e.exam.next_question_automatically==1?"Ya":"Tidak"),1)]),t("tr",null,[ct,_t,t("td",null,n(e.exam.show_prev_next_button==1?"Ya":"Tidak"),1)]),t("tr",null,[ht,mt,t("td",null,n(e.exam.type_option==1?"Button option dan soal menyatu (Normal)":"Button option ke samping & jawaban menyatu dengan soal"),1)]),t("tr",null,[bt,kt,t("td",null,n(e.exam.button_type_finish==1?"Ditampilkan Pada Setiap Soal":"Hanya Ditampilkan Pada Soal Terakhir"),1)]),t("tr",null,[gt,xt,t("td",null,n(e.exam.repeat_the_exam==1?"Ya":"Tidak"),1)]),t("tr",null,[ft,vt,t("td",null,n(e.exam.print_certificate==1?"Ya":"Tidak"),1)]),t("tr",null,[yt,Tt,t("td",null,n(e.exam.valid_until?e.exam.valid_until+" Tahun":"Tidak Ada Batas Waktu"),1)]),t("tr",null,[Bt,wt,t("td",null,n(e.exam.show_ranking==1?"Ya":"Tidak"),1)]),t("tr",null,[St,Ct,t("td",null,n(e.exam.exam_start_time?o.formatDateWithTimeHourMinute(e.exam.exam_start_time):"Tidak Ada Batas Waktu"),1)]),t("tr",null,[pt,jt,t("td",null,n(e.exam.exam_end_time?o.formatDateWithTimeHourMinute(e.exam.exam_end_time):"Tidak Ada Batas Waktu"),1)]),t("tr",null,[At,Dt,t("td",null,n(e.exam.total_tolerance==null?"Tidak ada":e.exam.total_tolerance+" Kali"),1)]),e.exam.total_tolerance!=null?(l(),s("tr",Nt,[Ht,Kt,t("td",null,[t("div",Pt,[t("input",{type:"text",class:"form form-control form-control-sm",value:e.exam.unblock_token,disabled:""},null,8,Ut),t("a",{href:"#",onClick:m[0]||(m[0]=h(a=>u.regenerateCode(),["prevent"])),class:"btn btn-primary btn-sm"},Lt)])])])):i("",!0),t("tr",null,[Wt,It,t("td",null,[e.exam.exam_status=="active"?(l(),s("span",qt,"Active")):i("",!0),e.exam.exam_status=="inactive"?(l(),s("span",Gt,"Inactive")):i("",!0),e.exam.exam_status=="inprogress"?(l(),s("span",Vt,"Inprogress")):i("",!0)])])])])])]),t("div",Jt,[t("div",Rt,[t("div",Ft,[Ot,t("div",zt,[t("a",{target:"_blank",href:`/admin/exams/${e.exam.id}/export-pdf`,class:"btn btn-danger btn-sm mt-2 mt-lg-0"},"Export Nilai Ke PDF",8,Qt)])])]),t("div",Xt,[t("div",Zt,[t("table",Et,[$t,t("tbody",null,[t("tr",null,[e.rankingExams.data.length?i("",!0):(l(),s("td",te,"Data Ranking kosong"))]),(l(!0),s(y,null,j(e.rankingExams.data,(a,f)=>(l(),s("tr",{key:f},[t("td",null,n(++f+(e.rankingExams.current_page-1)*e.rankingExams.per_page),1),t("td",null,n(a.user.name),1),t("td",null,n(a.user.student&&a.user.student.province?a.user.student.province.name:"-"),1),t("td",null,n(a.user.student&&a.user.student.city?a.user.student.city.name:"-"),1),t("th",null,[t("a",{href:"#",onClick:h(v=>o.unblocked(a.id),["prevent"])},[a.is_blocked==1?(l(),s("span",ne,"Di Blokir, Klik Untuk Membuka")):i("",!0)],8,ee),a.is_blocked==0?(l(),s("span",ae,"Selesai Mengerjakan")):i("",!0)]),t("th",null,n(a.grade==null?"Nilai Belum Di Generate":a.grade),1),t("td",null,[t("div",le,[t("a",{target:"_blank",href:`/admin/exams/${e.exam.id}/grades/${a.id}/certificate`,class:"ms-2"},oe,8,se),_(x,{href:`/admin/exams/${e.exam.id}/grades/${a.id}`,class:"ms-2"},{default:k(()=>[de]),_:2},1032,["href"]),t("a",{href:"#",onClick:h(v=>u.regenerateTryoutScore(a.id),["prevent"]),class:"ms-1"},ce,8,re),t("a",{href:"#",onClick:h(v=>u.destroy(a.id),["prevent"]),class:"ms-2"},me,8,_e)])])]))),128))])]),_(w,{links:e.rankingExams.links,align:"end"},null,8,["links"])])])])])])],64)}const ye=N(H,[["render",be]]);export{ye as default};
