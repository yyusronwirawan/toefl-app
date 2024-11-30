import{L as V}from"./Layout.842a4804.js";import{L as S,H as j,i as P,r as y,o as s,c as n,a as x,w as g,b as e,j as D,k as d,v as m,n as c,F as f,e as b,t as l,d as _,l as v,m as p,f as M,g as B}from"./app.a22bdfaf.js";import{S as N}from"./sweetalert2.all.ecb1f0e1.js";import{a as k}from"./index.2dd97047.js";import{E as A}from"./Editor.3884006f.js";import{_ as C}from"./_plugin-vue_export-helper.cdc0426e.js";const O={layout:V,components:{Link:S,Head:j,Editor:A},props:{errors:Object,categories:Object,templates:Object,exam:Object,duration_section:Object},setup(r){const t=P({category_id:r.exam.category_id,question_title_id:r.exam.question_title_id,template_id:r.exam.template_id,title:r.exam.title,duration:r.exam.duration,description:r.exam.description,random_question:r.exam.random_question,random_answer:r.exam.random_answer,show_answer:r.exam.show_answer,show_question_number_navigation:r.exam.show_question_number_navigation,show_question_number:r.exam.show_question_number,next_question_automatically:r.exam.next_question_automatically,show_prev_next_button:r.exam.show_prev_next_button,type_option:r.exam.type_option,price:r.exam.price,duration_type:r.exam.duration_type,duration_section:r.duration_section,button_type_finish:r.exam.button_type_finish,repeat_the_exam:r.exam.repeat_the_exam,print_certificate:r.exam.print_certificate,valid_until:r.exam.valid_until,show_ranking:r.exam.show_ranking,exam_start_time:r.exam.exam_start_time,exam_end_time:r.exam.exam_end_time,total_tolerance:r.exam.total_tolerance,exam_status:r.exam.exam_status,questionTitles:[],valueCategories:[]});return k.get(`/admin/categories/${t.category_id}/question-titles`).then(u=>{t.questionTitles=u.data}).catch(u=>console.error(u)),k.get(`/admin/categories/${t.category_id}/value-categories`).then(u=>{t.valueCategories=u.data}).catch(u=>console.error(u)),{form:t,submit:()=>{p.Inertia.put(`/admin/exams/${r.exam.id}`,{category_id:t.category_id,question_title_id:t.question_title_id,template_id:t.template_id,title:t.title,duration:t.duration,description:t.description,random_question:t.random_question,random_answer:t.random_answer,show_answer:t.show_answer,show_question_number_navigation:t.show_question_number_navigation,show_question_number:t.show_question_number,next_question_automatically:t.next_question_automatically,show_prev_next_button:t.show_prev_next_button,type_option:t.type_option,price:t.price,duration_type:t.duration_type,button_type_finish:t.button_type_finish,repeat_the_exam:t.repeat_the_exam,print_certificate:t.print_certificate,valid_until:t.valid_until,show_ranking:t.show_ranking,exam_start_time:t.exam_start_time,exam_end_time:t.exam_end_time,total_tolerance:t.total_tolerance,exam_status:t.exam_status,duration_section:t.duration_section},{onSuccess:()=>{N.fire({title:"Success!",text:"Ujian Berhasil Disimpan!.",icon:"success",showConfirmButton:!1,timer:1e3})}})},questionTitleData:()=>{t.question_title_id="",k.get(`/admin/categories/${t.category_id}/question-titles`).then(u=>{t.questionTitles=u.data}).catch(u=>console.error(u)),t.value_category_id="",k.get(`/admin/categories/${t.category_id}/value-categories`).then(u=>{t.valueCategories=u.data}).catch(u=>console.error(u))}}}},Y={class:"page-wrapper"},E={class:"page-content"},L=M('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Ujian</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li><li class="breadcrumb-item active" aria-current="page">Edit Ujian</li></ol></nav></div></div>',1),W={class:"card border-top border-0 border-3 border-primary"},H={class:"card-body"},J={class:"d-lg-flex align-items-center"},K={class:"ms-auto"},F=B("Kembali"),I={class:"col-12"},z=e("label",{class:"form-label"},"Kategori",-1),G=e("option",{value:""},"[ Pilih ]",-1),R=["value"],Q={key:0,class:"invalid-feedback"},X={class:"col-12"},Z=e("label",{class:"form-label"},"Paket Soal",-1),$=e("option",{value:""},"[ Pilih ]",-1),ee=["value"],te={key:0,class:"invalid-feedback"},oe={class:"col-12"},ie=e("label",{class:"form-label"},"Template Sertifikat",-1),ae=e("option",{value:""},"[ Pilih ]",-1),se=["value"],ne={key:0,class:"invalid-feedback"},le={class:"col-12"},re=e("label",{class:"form-label"},"Jenis Waktu Ujian",-1),_e=e("option",{value:""},"[ Pilih ]",-1),de=e("option",{value:"1"},"Satu Waktu",-1),ce=e("option",{value:"2"},"Waktu Per Section",-1),me=[_e,de,ce],ue={key:0,class:"invalid-feedback"},ve={key:0,class:"col-12"},he=e("label",{class:"form-label"},"Durasi Seluruh Ujian (Menit)",-1),fe={key:0,class:"invalid-feedback"},be={class:"form-label"},ke=["onUpdate:modelValue"],ye={key:0,class:"invalid-feedback"},xe={class:"col-12"},ge=e("label",{class:"form-label"},"Judul Ujian",-1),we={key:0,class:"invalid-feedback"},qe={class:"col-12"},Ue=e("label",{class:"form-label"},"Harga",-1),Te={key:0,class:"invalid-feedback"},Ve={class:"col-12"},Se=e("label",{class:"form-label"},"Deskripsi Ujian",-1),je={key:0},Pe={class:"col-12"},De=e("label",{class:"form-label"},"Soal Acak",-1),pe=e("option",{value:""},"[ Pilih ]",-1),Me=e("option",{value:"1"},"Ya",-1),Be=e("option",{value:"0"},"Tidak",-1),Ne=[pe,Me,Be],Ae={key:0,class:"invalid-feedback"},Ce={class:"col-12"},Oe=e("label",{class:"form-label"},"Jawaban Acak",-1),Ye=e("option",{value:""},"[ Pilih ]",-1),Ee=e("option",{value:"1"},"Ya",-1),Le=e("option",{value:"0"},"Tidak",-1),We=[Ye,Ee,Le],He={key:0,class:"invalid-feedback"},Je={class:"col-12"},Ke=e("label",{class:"form-label"},"Tampilkan Jawaban",-1),Fe=e("option",{value:""},"[ Pilih ]",-1),Ie=e("option",{value:"1"},"Ya",-1),ze=e("option",{value:"0"},"Tidak",-1),Ge=[Fe,Ie,ze],Re={key:0,class:"invalid-feedback"},Qe={class:"col-12"},Xe=e("label",{class:"form-label"},"Tampilkan Navigasi Nomor Soal",-1),Ze=e("option",{value:""},"[ Pilih ]",-1),$e=e("option",{value:"1"},"Ya",-1),et=e("option",{value:"0"},"Tidak",-1),tt=[Ze,$e,et],ot={key:0,class:"invalid-feedback"},it={class:"col-12"},at=e("label",{class:"form-label"},"Tampilkan Nomor Soal",-1),st=e("option",{value:""},"[ Pilih ]",-1),nt=e("option",{value:"1"},"Ya",-1),lt=e("option",{value:"0"},"Tidak",-1),rt=[st,nt,lt],_t={key:0,class:"invalid-feedback"},dt={class:"col-12"},ct=e("label",{class:"form-label"},"Pertanyaan Selanjutnya Secara Otomatis",-1),mt=e("option",{value:""},"[ Pilih ]",-1),ut=e("option",{value:"1"},"Ya",-1),vt=e("option",{value:"0"},"Tidak",-1),ht=[mt,ut,vt],ft={key:0,class:"invalid-feedback"},bt={class:"col-12"},kt=e("label",{class:"form-label"},"Tampilkan Button Sebelum & Selanjutnya",-1),yt=e("option",{value:""},"[ Pilih ]",-1),xt=e("option",{value:"1"},"Ya",-1),gt=e("option",{value:"0"},"Tidak",-1),wt=[yt,xt,gt],qt={key:0,class:"invalid-feedback"},Ut={class:"col-12"},Tt=e("label",{class:"form-label"},"Tipe Pilihan Ganda",-1),Vt=e("option",{value:""},"[ Pilih ]",-1),St=e("option",{value:"1"},"Button Option dan Soal Menyatu (Normal)",-1),jt=e("option",{value:"2"},"Button Option ke Samping dan jawaban menyatu dengan soal",-1),Pt=[Vt,St,jt],Dt={key:0,class:"invalid-feedback"},pt={class:"col-12"},Mt=e("label",{class:"form-label"},"Tampilan Button Akhiri Ujian / Sesi Selanjutnya",-1),Bt=e("option",{value:""},"[ Pilih ]",-1),Nt=e("option",{value:"1"},"Ditampilkan Pada Setiap Soal",-1),At=e("option",{value:"2"},"Hanya Ditampilkan Pada Soal Terakhir",-1),Ct=[Bt,Nt,At],Ot={key:0,class:"invalid-feedback"},Yt={class:"col-12"},Et=e("label",{class:"form-label"},"Peserta Dapat Mengulangi Ujian",-1),Lt=e("option",{value:""},"[ Pilih ]",-1),Wt=e("option",{value:"0"},"Tidak",-1),Ht=e("option",{value:"1"},"Ya",-1),Jt=[Lt,Wt,Ht],Kt={key:0,class:"invalid-feedback"},Ft={class:"col-12"},It=e("label",{class:"form-label"},"Peserta Dapat Mencetak Sertifikat",-1),zt=e("option",{value:""},"[ Pilih ]",-1),Gt=e("option",{value:"0"},"Tidak",-1),Rt=e("option",{value:"1"},"Ya",-1),Qt=[zt,Gt,Rt],Xt={key:0,class:"invalid-feedback"},Zt={class:"col-12"},$t=e("label",{class:"form-label"},"Masa Berlaku Sertifikat (Kosongkan Jika Tidak Ada)",-1),eo={class:"input-group"},to=e("span",{class:"input-group-text",id:"basic-addon2"},"Tahun",-1),oo={key:0,class:"invalid-feedback"},io={class:"col-12"},ao=e("label",{class:"form-label"},"Tampilkan Ranking Ujian",-1),so=e("option",{value:""},"[ Pilih ]",-1),no=e("option",{value:"0"},"Tidak",-1),lo=e("option",{value:"1"},"Ya",-1),ro=[so,no,lo],_o={key:0,class:"invalid-feedback"},co={class:"col-12"},mo=e("label",{class:"form-label"},"Waktu Akses Mulai Ujian (Optional)",-1),uo={key:0,class:"invalid-feedback"},vo={class:"col-12"},ho=e("label",{class:"form-label"},"Waktu Berakhir Akses Ujian (Optional)",-1),fo={key:0,class:"invalid-feedback"},bo={class:"col-12"},ko=e("label",{class:"form-label"},"Maksimal Toleransi Keluar Tes (Kosongkan Jika Tidak Ada)",-1),yo={key:0,class:"invalid-feedback"},xo={class:"col-12"},go=e("label",{class:"form-label"},"Status Ujian",-1),wo=e("option",{value:""},"[ Pilih ]",-1),qo=e("option",{value:"active"},"Aktive",-1),Uo=e("option",{value:"inactive"},"Inactive",-1),To=[wo,qo,Uo],Vo={key:0,class:"invalid-feedback"},So=e("div",{class:"col-12"},[e("button",{type:"submit",class:"btn btn-primary btn-sm px-5"},"Submit")],-1);function jo(r,t,o,a,u,Po){const w=y("Head"),q=y("Link"),U=y("Editor");return s(),n(f,null,[x(w,null,{default:g(()=>{var i;return[e("title",null,l((i=r.$page.props.setting.app_name)!=null?i:"Atur Setting Terlebih Dahulu")+" - Edit Ujian",1)]}),_:1}),e("div",Y,[e("div",E,[L,e("div",W,[e("div",H,[e("div",J,[e("div",K,[x(q,{href:"/admin/exams",class:"btn btn-primary btn-sm mt-2 mt-lg-0"},{default:g(()=>[F]),_:1})])]),e("form",{onSubmit:t[26]||(t[26]=D((...i)=>a.submit&&a.submit(...i),["prevent"])),class:"row g-3"},[e("div",I,[z,d(e("select",{onChange:t[0]||(t[0]=(...i)=>a.questionTitleData&&a.questionTitleData(...i)),"onUpdate:modelValue":t[1]||(t[1]=i=>a.form.category_id=i),class:c([{"is-invalid":o.errors.category_id},"form-select"])},[G,(s(!0),n(f,null,b(o.categories,(i,h)=>(s(),n("option",{key:h,value:i.id},l(i.name),9,R))),128))],34),[[m,a.form.category_id]]),o.errors.category_id?(s(),n("div",Q,l(o.errors.category_id),1)):_("",!0)]),e("div",X,[Z,d(e("select",{"onUpdate:modelValue":t[2]||(t[2]=i=>a.form.question_title_id=i),class:c([{"is-invalid":o.errors.question_title_id},"form-select"])},[$,(s(!0),n(f,null,b(a.form.questionTitles,i=>(s(),n("option",{value:i.id},l(i.name),9,ee))),256))],2),[[m,a.form.question_title_id]]),o.errors.question_title_id?(s(),n("div",te,l(o.errors.question_title_id),1)):_("",!0)]),e("div",oe,[ie,d(e("select",{"onUpdate:modelValue":t[3]||(t[3]=i=>a.form.template_id=i),class:c([{"is-invalid":o.errors.template_id},"form-select"])},[ae,(s(!0),n(f,null,b(o.templates,i=>(s(),n("option",{value:i.id},l(i.name),9,se))),256))],2),[[m,a.form.template_id]]),o.errors.template_id?(s(),n("div",ne,l(o.errors.template_id),1)):_("",!0)]),e("div",le,[re,d(e("select",{"onUpdate:modelValue":t[4]||(t[4]=i=>a.form.duration_type=i),class:c([{"is-invalid":o.errors.duration_type},"form-select"])},me,2),[[m,a.form.duration_type]]),o.errors.duration_type?(s(),n("div",ue,l(o.errors.duration_type),1)):_("",!0)]),a.form.duration_type==1?(s(),n("div",ve,[he,d(e("input",{type:"number",class:c(["form-control",{"is-invalid":o.errors.duration}]),"onUpdate:modelValue":t[5]||(t[5]=i=>a.form.duration=i),placeholder:"Durasi"},null,2),[[v,a.form.duration]]),o.errors.duration?(s(),n("div",fe,l(o.errors.duration),1)):_("",!0)])):_("",!0),a.form.duration_type==2?(s(!0),n(f,{key:1},b(a.form.valueCategories,(i,h)=>(s(),n("div",{key:h,class:"col-12"},[e("label",be,"Durasi "+l(i.name)+" (Menit)",1),d(e("input",{type:"number",class:"form-control","onUpdate:modelValue":T=>a.form.duration_section[h]=T,placeholder:"Durasi"},null,8,ke),[[v,a.form.duration_section[h]]]),o.errors.duration_section+"."+h?(s(),n("div",ye,l(o.errors.duration_section+"."+h),1)):_("",!0)]))),128)):_("",!0),e("div",xe,[ge,d(e("input",{type:"text",class:c(["form-control",{"is-invalid":o.errors.title}]),"onUpdate:modelValue":t[6]||(t[6]=i=>a.form.title=i),placeholder:"Nama"},null,2),[[v,a.form.title]]),o.errors.title?(s(),n("div",we,l(o.errors.title),1)):_("",!0)]),e("div",qe,[Ue,d(e("input",{type:"number",class:c(["form-control",{"is-invalid":o.errors.price}]),"onUpdate:modelValue":t[7]||(t[7]=i=>a.form.price=i),placeholder:"Nama"},null,2),[[v,a.form.price]]),o.errors.price?(s(),n("div",Te,l(o.errors.price),1)):_("",!0)]),e("div",Ve,[Se,x(U,{"api-key":r.$page.props.setting.tinymce_api_key,modelValue:a.form.description,"onUpdate:modelValue":t[8]||(t[8]=i=>a.form.description=i),init:{images_upload_url:"https://wakalahmu.com/admin/upload",automatic_uploads:!0,height:400,plugins:["advlist autolink lists link image charmap print preview hr anchor pagebreak","searchreplace wordcount visualblocks visualchars code fullscreen","insertdatetime media nonbreaking save table contextmenu directionality","emoticons template paste textcolor colorpicker textpattern imagetools"],toolbar:"insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons",image_advtab:!0}},null,8,["api-key","modelValue","init"]),o.errors.description?(s(),n("div",je,l(o.errors.description),1)):_("",!0)]),e("div",Pe,[De,d(e("select",{"onUpdate:modelValue":t[9]||(t[9]=i=>a.form.random_question=i),class:c([{"is-invalid":o.errors.random_question},"form-select"])},Ne,2),[[m,a.form.random_question]]),o.errors.random_question?(s(),n("div",Ae,l(o.errors.random_question),1)):_("",!0)]),e("div",Ce,[Oe,d(e("select",{"onUpdate:modelValue":t[10]||(t[10]=i=>a.form.random_answer=i),class:c([{"is-invalid":o.errors.random_answer},"form-select"])},We,2),[[m,a.form.random_answer]]),o.errors.random_answer?(s(),n("div",He,l(o.errors.random_answer),1)):_("",!0)]),e("div",Je,[Ke,d(e("select",{"onUpdate:modelValue":t[11]||(t[11]=i=>a.form.show_answer=i),class:c([{"is-invalid":o.errors.show_answer},"form-select"])},Ge,2),[[m,a.form.show_answer]]),o.errors.show_answer?(s(),n("div",Re,l(o.errors.show_answer),1)):_("",!0)]),e("div",Qe,[Xe,d(e("select",{"onUpdate:modelValue":t[12]||(t[12]=i=>a.form.show_question_number_navigation=i),class:c([{"is-invalid":o.errors.show_question_number_navigation},"form-select"])},tt,2),[[m,a.form.show_question_number_navigation]]),o.errors.show_question_number_navigation?(s(),n("div",ot,l(o.errors.show_question_number_navigation),1)):_("",!0)]),e("div",it,[at,d(e("select",{"onUpdate:modelValue":t[13]||(t[13]=i=>a.form.show_question_number=i),class:c([{"is-invalid":o.errors.show_question_number},"form-select"])},rt,2),[[m,a.form.show_question_number]]),o.errors.show_question_number?(s(),n("div",_t,l(o.errors.show_question_number),1)):_("",!0)]),e("div",dt,[ct,d(e("select",{"onUpdate:modelValue":t[14]||(t[14]=i=>a.form.next_question_automatically=i),class:c([{"is-invalid":o.errors.next_question_automatically},"form-select"])},ht,2),[[m,a.form.next_question_automatically]]),o.errors.next_question_automatically?(s(),n("div",ft,l(o.errors.next_question_automatically),1)):_("",!0)]),e("div",bt,[kt,d(e("select",{"onUpdate:modelValue":t[15]||(t[15]=i=>a.form.show_prev_next_button=i),class:c([{"is-invalid":o.errors.show_prev_next_button},"form-select"])},wt,2),[[m,a.form.show_prev_next_button]]),o.errors.show_prev_next_button?(s(),n("div",qt,l(o.errors.show_prev_next_button),1)):_("",!0)]),e("div",Ut,[Tt,d(e("select",{"onUpdate:modelValue":t[16]||(t[16]=i=>a.form.type_option=i),class:c([{"is-invalid":o.errors.type_option},"form-select"])},Pt,2),[[m,a.form.type_option]]),o.errors.type_option?(s(),n("div",Dt,l(o.errors.type_option),1)):_("",!0)]),e("div",pt,[Mt,d(e("select",{"onUpdate:modelValue":t[17]||(t[17]=i=>a.form.button_type_finish=i),class:c([{"is-invalid":o.errors.button_type_finish},"form-select"])},Ct,2),[[m,a.form.button_type_finish]]),o.errors.button_type_finish?(s(),n("div",Ot,l(o.errors.button_type_finish),1)):_("",!0)]),e("div",Yt,[Et,d(e("select",{"onUpdate:modelValue":t[18]||(t[18]=i=>a.form.repeat_the_exam=i),class:c([{"is-invalid":o.errors.repeat_the_exam},"form-select"])},Jt,2),[[m,a.form.repeat_the_exam]]),o.errors.repeat_the_exam?(s(),n("div",Kt,l(o.errors.repeat_the_exam),1)):_("",!0)]),e("div",Ft,[It,d(e("select",{"onUpdate:modelValue":t[19]||(t[19]=i=>a.form.print_certificate=i),class:c([{"is-invalid":o.errors.print_certificate},"form-select"])},Qt,2),[[m,a.form.print_certificate]]),o.errors.print_certificate?(s(),n("div",Xt,l(o.errors.print_certificate),1)):_("",!0)]),e("div",Zt,[$t,e("div",eo,[d(e("input",{type:"number",class:c(["form-control",{"is-invalid":o.errors.valid_until}]),"onUpdate:modelValue":t[20]||(t[20]=i=>a.form.valid_until=i),placeholder:"Masa Berlaku",min:"1"},null,2),[[v,a.form.valid_until]]),to]),o.errors.valid_until?(s(),n("div",oo,l(o.errors.valid_until),1)):_("",!0)]),e("div",io,[ao,d(e("select",{"onUpdate:modelValue":t[21]||(t[21]=i=>a.form.show_ranking=i),class:c([{"is-invalid":o.errors.show_ranking},"form-select"])},ro,2),[[m,a.form.show_ranking]]),o.errors.show_ranking?(s(),n("div",_o,l(o.errors.show_ranking),1)):_("",!0)]),e("div",co,[mo,d(e("input",{type:"datetime-local",class:c(["form-control",{"is-invalid":o.errors.exam_start_time}]),"onUpdate:modelValue":t[22]||(t[22]=i=>a.form.exam_start_time=i),placeholder:"Waktu Mulai Ujian"},null,2),[[v,a.form.exam_start_time]]),o.errors.exam_start_time?(s(),n("div",uo,l(o.errors.exam_start_time),1)):_("",!0)]),e("div",vo,[ho,d(e("input",{type:"datetime-local",class:c(["form-control",{"is-invalid":o.errors.exam_end_time}]),"onUpdate:modelValue":t[23]||(t[23]=i=>a.form.exam_end_time=i),placeholder:"Waktu Selesai Ujian"},null,2),[[v,a.form.exam_end_time]]),o.errors.exam_end_time?(s(),n("div",fo,l(o.errors.exam_end_time),1)):_("",!0)]),e("div",bo,[ko,d(e("input",{type:"number",class:c(["form-control",{"is-invalid":o.errors.total_tolerance}]),"onUpdate:modelValue":t[24]||(t[24]=i=>a.form.total_tolerance=i),placeholder:"Maksimal Toleransi Keluar Tes",min:"0"},null,2),[[v,a.form.total_tolerance]]),o.errors.total_tolerance?(s(),n("div",yo,l(o.errors.total_tolerance),1)):_("",!0)]),e("div",xo,[go,d(e("select",{"onUpdate:modelValue":t[25]||(t[25]=i=>a.form.exam_status=i),class:c([{"is-invalid":o.errors.exam_status},"form-select"])},To,2),[[m,a.form.exam_status]]),o.errors.exam_status?(s(),n("div",Vo,l(o.errors.exam_status),1)):_("",!0)]),So],32)])])])])],64)}const Co=C(O,[["render",jo]]);export{Co as default};
