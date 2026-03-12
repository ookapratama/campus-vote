<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $candidate->title }} {{ $candidate->name }} | PILREK USN Kolaka</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
    
    <style>
        :root {
            --pilrek-navy: #0a1628;
            --pilrek-blue: #0d2b5a;
            --pilrek-blue-light: #163e7a;
            --pilrek-gold: #d4a843;
            --pilrek-gray-bg: #f4f7fa;
            --font-main: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--pilrek-gray-bg);
            font-family: var(--font-main);
            color: #2d3436;
            margin: 0;
            padding: 0;
        }

        /* --- HEADER --- */
        .hero-bg {
            background: linear-gradient(135deg, var(--pilrek-navy) 0%, var(--pilrek-blue) 100%);
            padding: 30px 0 120px 0;
            position: relative;
            overflow: hidden;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            color: var(--pilrek-gold);
            transform: translateX(-5px);
        }

        /* --- MAIN WRAPPER --- */
        .profile-wrapper {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            margin-top: -70px;
            position: relative;
            z-index: 5;
            margin-bottom: 50px;
        }

        /* --- FOTO KIRI (NORMAL, TIDAK STICKY) --- */
        .photo-column {
            /* Efek sticky sudah dihapus di sini */
            margin-bottom: 30px;
        }

        .photo-large {
            width: 100%;
            aspect-ratio: 3/4; 
            border-radius: 20px;
            overflow: hidden;
            background: var(--pilrek-blue-light);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .photo-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
        }

        /* --- INFO KANAN --- */
        .candidate-tag {
            background: rgba(212,168,67,0.15);
            color: #b38a2d;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 15px;
        }

        .info-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--pilrek-navy);
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .position-text {
            font-size: 1.1rem;
            color: var(--pilrek-blue-light);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid #eee;
        }

        .detail-box {
            margin-bottom: 35px;
        }

        .detail-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
            font-weight: 800;
            color: var(--pilrek-navy);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 15px;
        }

        .detail-title i {
            color: var(--pilrek-gold);
            font-size: 1.2rem;
        }

        .detail-text {
            font-size: 1.05rem;
            line-height: 1.7;
            color: #4a4a4a;
        }

        .text-pre-line {
            white-space: pre-line;
        }

        .mission-list {
            padding-left: 20px;
            margin: 0;
            white-space: normal;
        }

        .mission-list li {
            margin-bottom: 8px;
            padding-left: 5px;
            color: #4a4a4a;
            line-height: 1.6;
            font-size: 1.05rem;
        }

        /* --- RESPONSIVE MOBILE & TABLET --- */
        @media (max-width: 991.98px) {
            .info-header h1 { font-size: 2rem; }
            .profile-wrapper { padding: 30px; }
        }

        @media (max-width: 767.98px) {
            .hero-bg { padding-bottom: 100px; }
            .profile-wrapper { 
                padding: 25px;
                margin-top: -60px;
            }
            .photo-large {
                max-width: 300px;
                margin: 0 auto;
            }
            .info-header { text-align: center; }
            .position-text { justify-content: center; }
        }
    </style>
</head>
<body>

    <div class="hero-bg">
        <div class="container">
            <a href="{{ route('pilrek.home') }}#kandidat" class="btn-back">
                <i class="ri-arrow-left-line"></i> Kembali
            </a>
        </div>
    </div>

    <div class="container">
        <div class="profile-wrapper">
            <div class="row">
                
                <div class="col-lg-4 col-md-5">
                    <div class="photo-column">
                        <div class="photo-large">
                            @if ($candidate->photo)
                                <img src="{{ $candidate->photo_url }}" alt="{{ $candidate->name }}">
                            @else
                                <div class="h-100 d-flex align-items-center justify-content-center text-white-50">
                                    <i class="ri-user-3-line" style="font-size: 6rem;"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-7 ps-lg-5">
                    
                    <div class="info-header">
                        <div class="candidate-tag">Bakal Calon Rektor</div>
                        <h1>{{ $candidate->title }} {{ $candidate->name }}</h1>
                        @if ($candidate->position)
                            <div class="position-text">
                                <i class="ri-briefcase-4-line"></i> {{ $candidate->position }}
                            </div>
                        @endif
                    </div>

                    @if ($candidate->bio)
                    <div class="detail-box">
                        <div class="detail-title"><i class="ri-user-line"></i> Biografi Singkat</div>
                        <div class="detail-text">{{ $candidate->bio }}</div>
                    </div>
                    @endif

                    @if ($candidate->vision)
                    <div class="detail-box">
                        <div class="detail-title"><i class="ri-lightbulb-line"></i> Visi Utama</div>
                        <div class="detail-text">{{ $candidate->vision }}</div>
                    </div>
                    @endif

                    @if ($candidate->mission)
                    <div class="detail-box">
                        <div class="detail-title"><i class="ri-list-check-3"></i> Misi & Program Kerja</div>
                        <div class="detail-text">
                            @php
                                $lines = array_filter(explode("\n", $candidate->mission), fn($l) => trim($l) !== '');
                            @endphp
                            @if (count($lines) > 1)
                                <ul class="mission-list">
                                    @foreach ($lines as $line)
                                        <li>{{ trim($line) }}</li>
                                    @endforeach
                                </ul>
                            @else
                                {{ $candidate->mission }}
                            @endif
                        </div>
                    </div>
                    @endif

                </div> </div>
        </div>
    </div>

    <footer class="py-4 text-center text-muted small">
        <div class="container">
            &copy; 2026 Panitia Pemilihan Rektor USN Kolaka. Seluruh Hak Cipta Dilindungi.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 