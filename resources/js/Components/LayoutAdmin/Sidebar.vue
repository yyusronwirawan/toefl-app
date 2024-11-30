<template>
    <!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
                <div style="text-align:center;" v-if="$page.props.setting && $page.props.setting.logo">
                    <img v-bind:src="'/storage/upload_files/settings/' + $page.props.setting.logo" style="height:45px;"/>
                </div>
				<div v-else>
					<h4 class="logo-text" style="font-size:18px;">{{ $page.props.setting.app_name ?? 'Isi Setting Terlebih Dahulu' }}</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
			</div>
			<!--navigation-->
            <!-- admin -->
			<ul class="metismenu" id="menu" v-if="$page.props.auth.user.level == 1">
                <li>
					<Link href="/admin/dashboard" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</Link>
				</li>
				<li class="menu-label">Manajemen</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-grid-alt'></i>
						</div>
						<div class="menu-title">Master Data</div>
					</a>
					<ul>
                        <li>
                            <Link href="/admin/users" class="menu-clicked">
                               <i class="bx bx-right-arrow-alt"></i>User
					        </Link>
                        </li>
                        <li>
                            <Link href="/admin/categories" class="menu-clicked">
                               <i class="bx bx-right-arrow-alt"></i>Kategori
					        </Link>
                        </li>
                        <li>
                            <Link href="/admin/value-categories" class="menu-clicked">
                               <i class="bx bx-right-arrow-alt"></i>Kategori Penilaian
					        </Link>
                        </li>
                        <li>
                            <Link href="/admin/question-titles" class="menu-clicked">
                               <i class="bx bx-right-arrow-alt"></i>Paket Soal
					        </Link>
                        </li>
					</ul>
				</li>
                <li>
					<Link href="/admin/exams" class="menu-clicked">
                        <div class="parent-icon"><i class='bx bx-message-square-edit'></i>
						</div>
						<div class="menu-title">Ujian</div>
					</Link>
				</li>
                <li>
                    <Link href="/admin/announcements" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-message-square-detail'></i>
						</div>
						<div class="menu-title">Pengumuman</div>
					</Link>
                </li>
                <li>
                    <Link href="/admin/faqs" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-message-add'></i>
						</div>
						<div class="menu-title">Faq</div>
					</Link>
                </li>
                <li class="menu-label">Transaksi</li>
                <li>
					<Link href="/admin/banks">
						<div class="parent-icon"><i class='bx bx-credit-card-front'></i>
						</div>
						<div class="menu-title menu-clicked">Bank</div>
					</Link>
				</li>
                <li>
                    <Link href="/admin/transactions">
						<div class="parent-icon"><i class='bx bx-transfer'></i>
						</div>
						<div class="menu-title menu-clicked">Transaksi</div>
					</Link>
				</li>
                <li class="menu-label">Setting</li>
                <li>
					<Link href="/admin/templates">
						<div class="parent-icon"><i class='bx bx-file'></i>
						</div>
						<div class="menu-title menu-clicked">Template Sertifikat</div>
					</Link>
				</li>
                <li>
					<Link href="/admin/settings">
						<div class="parent-icon"><i class='bx bx-cog'></i>
						</div>
						<div class="menu-title menu-clicked">Setting</div>
					</Link>
				</li>
			</ul>

            <!-- user -->
            <ul class="metismenu" id="menu" v-if="$page.props.auth.user.level == 2">
                <li class="menu-label">Navigation</li>
				<li>
					<Link href="/user/dashboard" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-home-circle'></i></div>
						<div class="menu-title">Dashboard</div>
					</Link>
				</li>
                <li>
                    <Link href="/user/announcements" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-message-square-detail'></i></div>
						<div class="menu-title">Pengumuman</div>
					</Link>
                </li>
                <li>
                    <Link href="/user/faqs" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-message-add'></i></div>
						<div class="menu-title">Faq</div>
					</Link>
                </li>
                <li class="menu-label">Ujian</li>
				<li>
					<Link href="/user/categories" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-home-circle'></i></div>
						<div class="menu-title">Ujian</div>
					</Link>
				</li>
                <li>
                    <Link href="/user/grades" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-message-square-detail'></i></div>
						<div class="menu-title">Riwayat Ujian</div>
					</Link>
                </li>
                <li class="menu-label">Transaksi</li>
                <li>
					<Link href="/user/transactions" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-transfer-alt'></i></div>
						<div class="menu-title">Riwayat Transaksi</div>
					</Link>
				</li>
                <li>
					<Link href="/user/voucher-activations" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-outline'></i></div>
						<div class="menu-title">Aktivasi Voucher</div>
					</Link>
				</li>
                <!-- <li class="menu-label">Materi & Event</li>
                <li>
					<Link href="/on-progress" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-repeat'></i></div>
						<div class="menu-title">Bahasan Materi</div>
                    </Link>
				</li>
                <li>
					<Link href="/on-progress" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-video-recording'></i></div>
						<div class="menu-title">Pembelajaran Online</div>
                    </Link>
				</li>
				<li>
					<Link href="/on-progress" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-video-recording'></i></div>
						<div class="menu-title">Event Online</div>
                    </Link>
				</li> -->
                <li class="menu-label">Management Akun</li>
                <li>
					<Link href="/user/users" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-user'></i></div>
						<div class="menu-title">Profil</div>
					</Link>
				</li>
                <!-- <li>
					<Link href="/on-progress" class="menu-clicked">
						<div class="parent-icon"><i class='bx bx-transfer-alt'></i></div>
						<div class="menu-title">Affiliate Program</div>
					</Link>
				</li> -->
                <li class="menu-label">&nbsp;</li>
                <li class="menu-label">&nbsp;</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
</template>

<script>
    // import Link
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        // register component
        components: {
            Link
        }
    }
</script>
