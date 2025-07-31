<!-- resources/views/home.blade.php -->
@extends('layouts.homepage.app')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Section --}}
    <section id="hero">
        <div class="row align-items-center mt-4">
            <div class="col">
                <h1>HR Apps - <span class="text-primary">Tingkatkan Manajemen HR Anda</span> </h1>
                <p>Tingkatkan Manajemen HR Anda dengan menyederhanakan operasional sumber daya manusia Anda dengan
                    <strong>HR Apps</strong>
                    kami
                    yang
                    intuitif. Mulai dari pelacakan pelamar hingga tinjauan kinerja, berdayakan tim Anda dengan perangkat
                    komprehensif yang dirancang untuk mengoptimalkan efisiensi dan mendorong pertumbuhan.</p>
                <p>Siap merevolusi proses HR Anda ?</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Coba Sekarang </a>
            </div>
            <div class="col">
                <img src={{ asset('images/hero.jpg') }} alt="management" class="img-fluid">
            </div>
        </div>
    </section>
    <section id="features" class="mt-5">
        <div class="row">
            <div class="col text-center">
                <h2>Kenapa Memilih HR Apps ?</h2>
                <p>HR Apps dirancang untuk memenuhi kebutuhan manajemen sumber daya manusia modern. Dengan antarmuka yang
                    intuitif dan fitur yang komprehensif, kami membantu Anda mengelola proses HR dengan lebih efisien.</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <h2>Fitur Utama</h2>
                <p>HR Apps menawarkan berbagai fitur untuk memenuhi kebutuhan manajemen sumber daya manusia Anda.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4 text-center">
                <img src={{ asset('images/feature1.png') }} alt="Feature 1" class="img-fluid mb-3">
                <h3>Pelacakan Pelamar</h3>
                <p>Kelola pelamar dengan mudah, mulai dari pengajuan hingga penawaran kerja.</p>
            </div>
            <div class="col-md-4 text-center">
                <img src={{ asset('images/feature2.png') }} alt="Feature 2" class="img-fluid mb-3">
                <h3>Tinjauan Kinerja</h3>
                <p>Lakukan tinjauan kinerja yang komprehensif untuk meningkatkan produktivitas tim.</p>
            </div>
            <div class="col-md-4 text-center">
                <img src={{ asset('images/feature3.png') }} alt="Feature 3" class="img-fluid mb-3">
                <h3>Manajemen Cuti</h3>
                <p>Atur dan lacak permintaan cuti karyawan dengan mudah.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col text-center">
                <a href="/features" class="btn btn-secondary">Lihat Semua Fitur</a>
            </div>
        </div>
    </section>
    <section id="testimonials" class="mt-5">
        <div class="row">
            <div class="col text-center">
                <h2>Apa Kata Pengguna Kami ?</h2>
                <p>Berikut adalah beberapa testimoni dari pengguna HR Apps yang telah merasakan manfaatnya.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4 text-center">
                <blockquote class="blockquote">
                    <p>"HR Apps telah mengubah cara kami mengelola sumber daya manusia. Prosesnya menjadi lebih efisien dan
                        mudah."</p>
                    <footer class="blockquote-footer">- John Doe, CEO Perusahaan XYZ</footer>
                </blockquote>
            </div>
            <div class="col-md-4 text-center">
                <blockquote class="blockquote">
                    <p>"Fitur pelacakan pelamar sangat membantu kami dalam menemukan kandidat terbaik untuk tim kami."</p>
                    <footer class="blockquote-footer">- Jane Smith, Manajer HR Perusahaan ABC</footer>
                </blockquote>
            </div>
            <div class="col-md-4 text-center">
                <blockquote class="blockquote">
                    <p>"Tinjauan kinerja yang mudah digunakan membantu kami meningkatkan produktivitas tim."</p>
                    <footer class="blockquote-footer">- Michael Johnson, Direktur Operasional Perusahaan DEF</footer>
                </blockquote>
            </div>
        </div>

    </section>
    <section id="cta" class="mt-5 text-center">
        <div class="row">
            <div class="col">
                <h2>Siap Meningkatkan Manajemen HR Anda ?</h2>
                <p>Daftar sekarang dan mulai gunakan HR Apps untuk mengelola sumber daya manusia Anda dengan lebih efisien.
                </p>
                <a href="/register" class="btn btn-primary">Daftar Sekarang</a>
            </div>
        </div>

    </section>
    <section>
        <div class="row mt-5">
            <div class="col text-center">
                <h2>Hubungi Kami</h2>
                <p>Jika Anda memiliki pertanyaan atau ingin mengetahui lebih lanjut tentang HR Apps, jangan ragu untuk
                    menghubungi kami.</p>
                <a href="/contact" class="btn btn-secondary">Hubungi Kami</a>
            </div>
        </div>
    </section>
    <section>
        <div class="row mt-5">
            <div class="col text-center">
                <h2>Ikuti Kami di Media Sosial</h2>
                <p>Ikuti kami di media sosial untuk mendapatkan pembaruan terbaru tentang HR Apps.</p>
                <a href="https://www.facebook.com" class="btn btn-primary">Facebook</a>
                <a href="https://www.twitter.com" class="btn btn-info">Twitter</a>
                <a href="https://www.linkedin.com" class="btn btn-secondary">LinkedIn</a>
            </div>
        </div>
    </section>
@endsection
