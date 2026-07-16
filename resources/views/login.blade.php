<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Masuk — SIPKD BPKAD Kutai Timur</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <style>
            :root {
                --bar-navy: #1F3864;
                --bar-navy-soft: #2E4E8F;
                --bar-gold: #F0B429;
                --bar-line: #c9d2e3;
                --bar-bg: #eef1f6;
            }

            * {
                box-sizing: border-box
            }

            html,
            body {
                height: 100%
            }

            body {
                margin: 0;
                font-family: "Segoe UI", system-ui, Arial, sans-serif;
                font-size: 14px;
                color: #1b1b1b;
                background: var(--bar-bg);
            }

            .shell {
                display: flex;
                min-height: 100vh
            }

            /* ---------- PANEL KIRI (BRANDING) ---------- */
            .brand-panel {
                flex: 1 1 52%;
                background:
                    radial-gradient(1100px 600px at 12% 8%, rgba(240, 180, 41, .13), transparent 60%),
                    linear-gradient(155deg, #1F3864 0%, #18294b 55%, #101d38 100%);
                color: #cdd8ee;
                padding: 48px 56px;
                display: flex;
                flex-direction: column;
                position: relative;
                overflow: hidden;
            }

            /* garis dekoratif menyerupai kop dokumen */
            .brand-panel::after {
                content: "";
                position: absolute;
                right: -140px;
                bottom: -160px;
                width: 520px;
                height: 520px;
                border-radius: 50%;
                border: 1px solid rgba(255, 255, 255, .06);
                box-shadow: 0 0 0 60px rgba(255, 255, 255, .025);
            }

            .bp-top {
                display: flex;
                align-items: center;
                gap: 12px;
                position: relative;
                z-index: 2
            }

            .brand-mark {
                width: 44px;
                height: 44px;
                flex: 0 0 44px;
                border-radius: 8px;
                background: var(--bar-gold);
                color: var(--bar-navy);
                display: grid;
                place-items: center;
                font-weight: 800;
                font-size: 17px;
                letter-spacing: -.5px;
            }

            .bp-top b {
                color: #fff;
                font-size: 19px;
                letter-spacing: .6px;
                display: block;
                line-height: 1.15
            }

            .bp-top small {
                color: #8fa4cc;
                font-size: 11px;
                letter-spacing: 1px;
                text-transform: uppercase
            }

            .bp-mid {
                margin: auto 0;
                position: relative;
                z-index: 2;
                max-width: 460px
            }

            .bp-mid h1 {
                color: #fff;
                font-size: 31px;
                font-weight: 700;
                line-height: 1.28;
                margin: 0 0 14px;
                letter-spacing: -.2px;
            }

            .bp-mid h1 span {
                color: var(--bar-gold)
            }

            .bp-mid p {
                font-size: 14px;
                line-height: 1.65;
                color: #a9bad9;
                margin: 0 0 30px
            }

            .feat {
                display: flex;
                align-items: flex-start;
                gap: 12px;
                margin-bottom: 16px
            }

            .feat i {
                width: 32px;
                height: 32px;
                flex: 0 0 32px;
                border-radius: 7px;
                background: rgba(255, 255, 255, .07);
                border: 1px solid rgba(255, 255, 255, .10);
                display: grid;
                place-items: center;
                color: var(--bar-gold);
                font-size: 14px;
            }

            .feat b {
                color: #e6ecf8;
                font-size: 13px;
                font-weight: 600;
                display: block;
                line-height: 1.3
            }

            .feat small {
                color: #8fa4cc;
                font-size: 11.5px;
                line-height: 1.5
            }

            .bp-foot {
                position: relative;
                z-index: 2;
                font-size: 11.5px;
                color: #7b90b8;
                border-top: 1px solid rgba(255, 255, 255, .09);
                padding-top: 16px;
                display: flex;
                gap: 16px;
                flex-wrap: wrap;
                align-items: center;
            }

            .bp-foot a {
                color: #8fa4cc;
                text-decoration: none
            }

            .bp-foot a:hover {
                color: #fff
            }

            /* ---------- PANEL KANAN (FORM) ---------- */
            .form-panel {
                flex: 1 1 48%;
                background: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 40px 24px;
            }

            .form-box {
                width: 100%;
                max-width: 376px
            }

            .fp-logo {
                display: none;
                align-items: center;
                gap: 10px;
                margin-bottom: 26px
            }

            .fp-logo .brand-mark {
                width: 38px;
                height: 38px;
                flex: 0 0 38px;
                font-size: 14px
            }

            .fp-logo b {
                color: var(--bar-navy);
                font-size: 16px;
                display: block;
                line-height: 1.15
            }

            .fp-logo small {
                color: #7b8494;
                font-size: 10px;
                letter-spacing: .8px;
                text-transform: uppercase
            }

            .fp-head {
                margin-bottom: 24px
            }

            .fp-head h2 {
                font-size: 21px;
                font-weight: 700;
                color: var(--bar-navy);
                margin: 0 0 4px
            }

            .fp-head p {
                font-size: 13px;
                color: #6b7482;
                margin: 0
            }

            .form-label {
                font-weight: 600;
                font-size: 12.5px;
                margin-bottom: 5px;
                color: #3a4353
            }

            .input-wrap {
                position: relative
            }

            .input-wrap>i.lead-ico {
                position: absolute;
                left: 12px;
                top: 50%;
                transform: translateY(-50%);
                color: #96a0b3;
                font-size: 14px;
                pointer-events: none;
            }

            .form-control {
                font-size: 13.5px;
                padding: 10px 12px 10px 36px;
                border: 1px solid #dfe4ec;
                border-radius: 7px;
                background: #f8fafc;
                transition: border-color .14s, background .14s, box-shadow .14s;
            }

            .form-control:focus {
                background: #fff;
                border-color: var(--bar-navy-soft);
                box-shadow: 0 0 0 3px rgba(46, 78, 143, .13);
            }

            .form-control.is-invalid {
                border-color: #c00000;
                background: #fffafa
            }

            .form-control.is-invalid:focus {
                box-shadow: 0 0 0 3px rgba(192, 0, 0, .12)
            }

            .invalid-feedback {
                font-size: 11.5px
            }

            .toggle-pw {
                position: absolute;
                right: 4px;
                top: 50%;
                transform: translateY(-50%);
                border: 0;
                background: transparent;
                color: #8a94a6;
                width: 32px;
                height: 32px;
                border-radius: 6px;
                display: grid;
                place-items: center;
                font-size: 14px;
            }

            .toggle-pw:hover {
                color: var(--bar-navy);
                background: #eef1f6
            }

            .row-opt {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin: 14px 0 20px
            }

            .form-check-label {
                font-size: 12.5px;
                color: #5b6474
            }

            .form-check-input:checked {
                background-color: var(--bar-navy);
                border-color: var(--bar-navy)
            }

            .link-gold {
                font-size: 12.5px;
                color: var(--bar-navy-soft);
                text-decoration: none;
                font-weight: 600
            }

            .link-gold:hover {
                color: var(--bar-navy);
                text-decoration: underline
            }

            .btn-masuk {
                width: 100%;
                background: var(--bar-navy);
                color: #fff;
                border: 0;
                border-radius: 7px;
                padding: 11px;
                font-size: 14px;
                font-weight: 600;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                transition: background .14s, transform .06s;
            }

            .btn-masuk:hover {
                background: #152647
            }

            .btn-masuk:active {
                transform: translateY(1px)
            }

            .btn-masuk:disabled {
                opacity: .72;
                cursor: not-allowed
            }

            .divider {
                display: flex;
                align-items: center;
                gap: 12px;
                margin: 22px 0;
                color: #a4adbd;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .divider::before,
            .divider::after {
                content: "";
                flex: 1;
                height: 1px;
                background: #e6eaf1
            }

            .btn-sso {
                width: 100%;
                background: #fff;
                color: #3a4353;
                border: 1px solid #dfe4ec;
                border-radius: 7px;
                padding: 10px;
                font-size: 13px;
                font-weight: 600;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
            }

            .btn-sso:hover {
                background: #f6f8fb;
                border-color: var(--bar-navy-soft);
                color: var(--bar-navy)
            }

            .btn-sso i {
                color: var(--bar-gold);
                font-size: 15px
            }

            .alert-err {
                display: none;
                background: #fdecec;
                border: 1px solid #eeb0b0;
                color: #7a2020;
                border-radius: 7px;
                padding: 10px 12px;
                font-size: 12.5px;
                margin-bottom: 18px;
                align-items: flex-start;
                gap: 8px;
            }

            .alert-err.show {
                display: flex
            }

            .note {
                margin-top: 24px;
                padding: 11px 13px;
                background: #f6f8fb;
                border: 1px solid #e6eaf1;
                border-radius: 7px;
                font-size: 11.5px;
                color: #6b7482;
                line-height: 1.55;
            }

            .note i {
                color: var(--bar-navy-soft)
            }

            .fp-foot {
                margin-top: 26px;
                text-align: center;
                font-size: 11px;
                color: #96a0b3;
                line-height: 1.6;
            }

            /* ---------- RESPONSIVE ---------- */
            @media (max-width:991.98px) {
                .brand-panel {
                    display: none
                }

                .form-panel {
                    flex: 1 1 100%
                }

                .fp-logo {
                    display: flex
                }

                body {
                    background: #fff
                }
            }

            @media (min-width:992px) and (max-width:1199.98px) {
                .brand-panel {
                    padding: 40px 40px;
                    flex-basis: 46%
                }

                .bp-mid h1 {
                    font-size: 26px
                }
            }
        </style>
    </head>

    <body>

        <div class="shell">

            <!-- ============ PANEL BRANDING ============ -->
            <section class="brand-panel">
                <div class="bp-top">
                    <div class="brand-mark">KT</div>
                    <div>
                        <b>SIPKD</b>
                        <small>BPKAD Kutai Timur</small>
                    </div>
                </div>

                <div class="bp-mid">
                    <h1>Sistem Informasi<br>Pengelolaan <span>Keuangan Daerah</span></h1>
                    <p>
                        Rekonsiliasi penerimaan dan pengeluaran antara SKPKD dan SKPD
                        dalam satu alur kerja terpadu — dari penerbitan SP2D hingga
                        penandatanganan berita acara.
                    </p>

                    <div class="feat">
                        <i class="bi bi-file-earmark-check"></i>
                        <div>
                            <b>Berita Acara Otomatis</b>
                            <small>Catatan BUD dan SKPD ditarik langsung dari SP2D dan Buku Kas Umum.</small>
                        </div>
                    </div>
                    <div class="feat">
                        <i class="bi bi-arrow-left-right"></i>
                        <div>
                            <b>Deteksi Selisih Seketika</b>
                            <small>Perbedaan catatan dan potensi sisa UP/GU/TU terhitung secara real-time.</small>
                        </div>
                    </div>
                    <div class="feat">
                        <i class="bi bi-pen"></i>
                        <div>
                            <b>Tanda Tangan Elektronik</b>
                            <small>Alur persetujuan berjenjang dengan jejak audit yang terekam penuh.</small>
                        </div>
                    </div>
                </div>

                <div class="bp-foot">
                    <span>&copy; 2026 Pemerintah Kabupaten Kutai Timur</span>
                    <a href="#">Panduan</a>
                    <a href="#">Kebijakan Privasi</a>
                    <span class="ms-auto"><i class="bi bi-shield-check"></i> Versi 2.4.1</span>
                </div>
            </section>

            <!-- ============ PANEL FORM ============ -->
            <section class="form-panel">
                <div class="form-box">

                    <!-- logo untuk layar kecil -->
                    <div class="fp-logo">
                        <div class="brand-mark">KT</div>
                        <div>
                            <b>SIPKD</b>
                            <small>BPKAD Kutai Timur</small>
                        </div>
                    </div>

                    <div class="fp-head">
                        <h2>Masuk ke Akun Anda</h2>
                        <p>Gunakan Username dan kata sandi yang terdaftar.</p>
                    </div>

                    <div class="alert-err" id="alertErr">
                        <i class="bi bi-exclamation-triangle-fill mt-1"></i>
                        <div>
                            <b>Gagal masuk.</b>
                            <span id="errMsg">NIP atau kata sandi tidak sesuai. Sisa percobaan: 4 kali.</span>
                        </div>
                    </div>

                    <form id="formLogin" novalidate method="POST" action="{{ route('auth.goLogin') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <div class="input-wrap">
                                <i class="bi bi-person lead-ico"></i>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Masukkan username" autocomplete="username" required>
                            </div>
                            <div class="invalid-feedback">Username wajib diisi.</div>
                        </div>

                        <div class="mb-1">
                            <label class="form-label" for="pw">Kata Sandi</label>
                            <div class="input-wrap">
                                <i class="bi bi-lock lead-ico"></i>
                                <input type="password" class="form-control pe-5" id="pw" name="password"
                                    placeholder="Masukkan kata sandi" autocomplete="current-password" required>
                                <button type="button" class="toggle-pw" onclick="lihatSandi(this)"
                                    aria-label="Tampilkan kata sandi">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback">Kata sandi wajib diisi.</div>
                        </div>

                        <div class="row-opt">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" id="ingat">
                                <label class="form-check-label" for="ingat">Ingat saya</label>
                            </div>
                            {{-- <a href="#" class="link-gold">Lupa kata sandi?</a> --}}
                        </div>

                        <button type="submit" class="btn-masuk" id="btnMasuk">
                            <span id="btnLabel"><i class="bi bi-box-arrow-in-right"></i> Masuk</span>
                        </button>
                    </form>

                    {{-- <div class="divider">atau</div>

                    <button type="button" class="btn-sso" onclick="ssoDemo()">
                        <i class="bi bi-shield-lock-fill"></i> Masuk dengan SSO Pemkab
                    </button> --}}

                    <div class="note">
                        <i class="bi bi-info-circle"></i>
                        Akun dibuat oleh Administrator BPKAD. Bila belum memiliki akses,
                        silahkan hubungi administrator di BPKAD Kutai Timur untuk pembuatan akun.
                    </div>

                    <div class="fp-foot">
                        Dilindungi reCAPTCHA &middot; Aktivitas masuk direkam untuk keperluan audit.<br>
                        <span class="d-lg-none">&copy; 2026 Pemerintah Kabupaten Kutai Timur &middot; Versi 2.4.1</span>
                    </div>

                </div>
            </section>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function lihatSandi(btn) {
                const pw = document.getElementById('pw');
                const ico = btn.querySelector('i');
                const show = pw.type === 'password';
                pw.type = show ? 'text' : 'password';
                ico.className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
                btn.setAttribute('aria-label', show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
            }

            // document.getElementById('formLogin').addEventListener('submit', e => {
            //     e.preventDefault();
            //     const nip = document.getElementById('nip');
            //     const pw = document.getElementById('pw');
            //     const err = document.getElementById('alertErr');

            //     err.classList.remove('show');
            //     [nip, pw].forEach(el => el.classList.toggle('is-invalid', !el.value.trim()));

            //     if (!nip.value.trim() || !pw.value.trim()) {
            //         (!nip.value.trim() ? nip : pw).focus();
            //         return;
            //     }

            //     // Simulasi proses autentikasi
            //     const btn = document.getElementById('btnMasuk');
            //     const lbl = document.getElementById('btnLabel');
            //     btn.disabled = true;
            //     lbl.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memverifikasi...';

            //     setTimeout(() => {
            //         btn.disabled = false;
            //         lbl.innerHTML = '<i class="bi bi-box-arrow-in-right"></i> Masuk';
            //         err.classList.add('show');
            //         pw.classList.add('is-invalid');
            //         pw.value = '';
            //         pw.focus();
            //     }, 1300);
            // });

            // // Bersihkan tanda galat saat mulai mengetik ulang
            // ['nip', 'pw'].forEach(id => {
            //     document.getElementById(id).addEventListener('input', e => {
            //         e.target.classList.remove('is-invalid');
            //         document.getElementById('alertErr').classList.remove('show');
            //     });
            // });

            function ssoDemo() {
                alert('Mengalihkan ke SSO Pemkab Kutai Timur...');
            }
        </script>
    </body>

</html>
