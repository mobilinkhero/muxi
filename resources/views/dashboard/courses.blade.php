@extends('layouts.dashboard')

@section('title', 'My Mentorship & Live Training')

@section('content')
    <div style="padding: 2rem;">
        <header style="margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--white); margin-bottom: 0.5rem;">Live Training
                    Portal</h1>
                <p style="color: var(--gray); font-size: 1.1rem;">Track your live mentorship sessions and practical
                    progress.</p>
            </div>
            <div
                style="background: rgba(16, 185, 129, 0.1); padding: 0.5rem 1rem; border-radius: 8px; border: 1px solid rgba(16,185,129,0.2);">
                <span style="color: #10B981; font-weight: bold; font-size: 0.9rem;">● Practical Focused Learning</span>
            </div>
        </header>

        <!-- Coaching Stats -->
        <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            <div class="dashboard-card" style="display: flex; align-items: center; gap: 1.5rem; padding: 1.5rem;">
                <div
                    style="font-size: 2.5rem; background: rgba(99, 102, 241, 0.1); width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border-radius: 15px;">
                    📺</div>
                <div>
                    <div style="font-size: 1.8rem; font-weight: 800; color: var(--white);">{{ $stats['sessions_attended'] }}
                    </div>
                    <div style="font-size: 0.8rem; color: var(--gray); text-transform: uppercase; letter-spacing: 1px;">Live
                        Sessions</div>
                </div>
            </div>

            <div class="dashboard-card" style="display: flex; align-items: center; gap: 1.5rem; padding: 1.5rem;">
                <div
                    style="font-size: 2.5rem; background: rgba(245, 158, 11, 0.1); width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border-radius: 15px;">
                    ⏳</div>
                <div>
                    <div style="font-size: 1.8rem; font-weight: 800; color: #f59e0b;">{{ $stats['upcoming_sessions'] }}
                    </div>
                    <div style="font-size: 0.8rem; color: var(--gray); text-transform: uppercase; letter-spacing: 1px;">
                        Scheduled Next</div>
                </div>
            </div>

            <div class="dashboard-card" style="display: flex; align-items: center; gap: 1.5rem; padding: 1.5rem;">
                <div
                    style="font-size: 2.5rem; background: rgba(239, 68, 68, 0.1); width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border-radius: 15px;">
                    🏃</div>
                <div>
                    <div style="font-size: 1.8rem; font-weight: 800; color: #ef4444;">{{ $stats['late_entries'] }}</div>
                    <div style="font-size: 0.8rem; color: var(--gray); text-transform: uppercase; letter-spacing: 1px;">Late
                        Joins</div>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
            <!-- Enrolled Programs -->
            <div>
                <h2 style="font-size: 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 1.8rem;">🎓</span> My Programs
                </h2>

                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @forelse($orders as $order)
                        <div class="dashboard-card"
                            style="padding: 0; overflow: hidden; display: flex; border: 1px solid rgba(255,255,255,0.05);">
                            <div
                                style="width: 12px; background: linear-gradient(to bottom, var(--primary), var(--primary-light));">
                            </div>
                            <div
                                style="padding: 1.5rem; flex: 1; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h3 style="font-size: 1.3rem; color: var(--white); margin-bottom: 0.5rem;">
                                        {{ $order->service_name }}
                                    </h3>
                                    <div style="display: flex; gap: 1rem;">
                                        <span style="font-size: 0.85rem; color: var(--gray-light);">Status: <b
                                                style="color: #10B981;">Active Enrollment</b></span>
                                        <span style="font-size: 0.85rem; color: var(--gray-light);">Type: <b>Live
                                                Coaching</b></span>
                                    </div>
                                </div>
                                <a href="{{ route('dashboard.stats') }}" class="btn btn-primary"
                                    style="padding: 0.75rem 1.5rem;">
                                    View Class Log
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="dashboard-card" style="text-align: center; padding: 4rem 2rem;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">🛰️</div>
                            <h3 style="color: var(--white); margin-bottom: 1rem;">No Active Enrollment</h3>
                            <p style="color: var(--gray); margin-bottom: 2rem;">Start your practical trading journey today.</p>
                            <a href="/learn" class="btn btn-primary">Browse Practical Programs</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Practical Tasks / Announcements -->
            <div>
                <h2 style="font-size: 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 1.8rem;">📝</span> Today's Tasks
                </h2>
                <div class="dashboard-card"
                    style="background: rgba(255,255,255,0.02); border-color: rgba(255,255,255,0.05);">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li
                            style="padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; gap: 10px;">
                            <input type="checkbox" style="margin-top: 4px;">
                            <div>
                                <div style="font-size: 0.95rem; color: var(--white); font-weight: 500;">Review Daily Chart
                                    Setup</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Follow the live practical session
                                    method.</div>
                            </div>
                        </li>
                        <li
                            style="padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; gap: 10px;">
                            <input type="checkbox" style="margin-top: 4px;">
                            <div>
                                <div style="font-size: 0.95rem; color: var(--white); font-weight: 500;">Join Morning Live
                                    Stream</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Discord/Meet link will be active at 10
                                    AM.</div>
                            </div>
                        </li>
                        <li style="padding: 1rem 0; display: flex; gap: 10px;">
                            <input type="checkbox" style="margin-top: 4px;">
                            <div>
                                <div style="font-size: 0.95rem; color: var(--white); font-weight: 500;">Submit Risk
                                    Management Quiz</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Required for next practical level.</div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Session Recordings -->
            <div style="margin-top: 2.5rem;">
                <h2 style="font-size: 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 1.8rem;">📽️</span> Session Recordings
                </h2>

                @if(isset($recordings) && $recordings->count() > 0)
                    <div class="grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem;">
                        @foreach($recordings as $recording)
                            <div class="dashboard-card {{ !$recording->is_unlocked ? 'locked-recording' : '' }}" 
                                 style="padding: 0; overflow: hidden; position: relative; {{ !$recording->is_unlocked ? 'opacity: 0.6; filter: grayscale(1);' : '' }}; display: flex; flex-direction: column;">
                                
                                <div style="position: relative; height: 180px;">
                                    @if($recording->thumbnail_url)
                                        <div
                                            style="height: 100%; background-image: url('{{ asset($recording->thumbnail_url) }}'); background-size: cover; background-position: center;">
                                        </div>
                                    @else
                                        <div
                                            style="height: 100%; background: var(--dark-light); display: flex; align-items: center; justify-content: center;">
                                            <span style="font-size: 3rem;">🎬</span>
                                        </div>
                                    @endif

                                    @if($recording->is_unlocked)
                                        <!-- Play Overlay (Always semi-visible for clarity, glows on hover) -->
                                        <div class="video-thumbnail-container" style="position: relative; cursor: pointer;"
                                        onclick="openVideoModal('{{ route('stream.video', $recording->id) }}', '{{ addslashes($recording->title) }}', {{ $recording->id }})">
                                            <div class="play-overlay">
                                                <div class="play-btn-circle">
                                                    <svg style="width: 24px; height: 24px; fill: white; margin-left: 3px;"
                                                        viewBox="0 0 24 24">
                                                        <path d="M8 5v14l11-7z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Locked Overlay -->
                                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; backdrop-filter: blur(2px);">
                                            <div style="text-align: center;">
                                                <div style="font-size: 2.5rem; margin-bottom: 5px;">🔒</div>
                                                <div style="font-size: 0.75rem; color: white; font-weight: bold; background: rgba(239, 68, 68, 0.8); padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">Locked</div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Progress Bar Container -->
                                    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 5px; background: rgba(255,255,255,0.1);">
                                        <div style="width: {{ $recording->user_progress }}%; height: 100%; background: #10B981; transition: width 0.3s; box-shadow: 0 0 10px #10B981;"></div>
                                    </div>
                                </div>

                                <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                                        <div style="font-weight: 700; font-size: 1.1rem; color: var(--white); line-height: 1.2;">
                                            {{ $recording->title }}
                                        </div>
                                        @if($recording->is_completed)
                                            <span style="background: rgba(16, 185, 129, 0.2); color: #10B981; font-size: 0.65rem; padding: 3px 8px; border-radius: 4px; border: 1px solid rgba(16, 185, 129, 0.3); font-weight: 800; white-space: nowrap;">FINISHED ✅</span>
                                        @endif
                                    </div>
                                    
                                    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.8rem; color: var(--gray); margin-bottom: 1rem;">
                                        <span>📅 {{ $recording->published_at->format('M d, Y') }}</span>
                                        <span>•</span>
                                        <span>🕒 Session Recording</span>
                                    </div>

                                    @if($recording->description)
                                        <p style="font-size: 0.85rem; color: var(--gray-light); line-height: 1.5; margin-bottom: 1.5rem; flex: 1;">
                                            {{ \Illuminate\Support\Str::limit($recording->description, 100) }}
                                        </p>
                                    @endif

                                    @if($recording->is_unlocked)
                                        <button onclick="openVideoModal('{{ route('stream.video', $recording->id) }}', '{{ addslashes($recording->title) }}', {{ $recording->id }})" 
                                                class="btn btn-primary" style="width: 100%; justify-content: center; gap: 8px; padding: 0.8rem;">
                                            <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M8 5v14l11-7z" /></svg>
                                            Watch Session
                                        </button>
                                    @else
                                        <button disabled class="btn" style="width: 100%; background: rgba(255,255,255,0.05); color: var(--gray); border: 1px solid rgba(255,255,255,0.1); cursor: not-allowed; padding: 0.8rem;">
                                            Complete Previous Session First
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                @else
                    <div class="dashboard-card"
                        style="text-align: center; padding: 3rem; background: rgba(255,255,255,0.02); border-style: dashed;">
                        <div style="font-size: 2rem; margin-bottom: 1rem;">📼</div>
                        <p style="color: var(--gray);">No session recordings available yet.</p>
                    </div>
                @endif
            </div>

            <!-- Video Modal -->
            <div id="videoModal"
                style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.98); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(15px);">

                <button onclick="closeVideoModal()"
                    style="position: absolute; top: 20px; right: 20px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; width: 40px; height: 40px; border-radius: 50%; font-size: 1.5rem; cursor: pointer; z-index: 10001; display: flex; align-items: center; justify-content: center; transition: all 0.3s;">&times;</button>

                <div style="width: 90%; max-width: 1000px; position: relative;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h3 id="videoTitle"
                            style="color: white; font-size: 1.25rem; font-weight: 700; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">
                        </h3>
                        <div
                            style="font-size: 0.8rem; color: #ef4444; font-weight: bold; background: rgba(239, 68, 68, 0.1); padding: 5px 10px; border-radius: 4px; border: 1px solid rgba(239, 68, 68, 0.2);">
                            ⚠️ Protected Content
                        </div>
                    </div>

                <div id="videoContainer"
                    style="position: relative; width: 100%; aspect-ratio: 16/9; background: #000; border-radius: 12px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.8); border: 1px solid rgba(255,255,255,0.1);">
                    
                    <!-- Protective Overlay (Blocks Sniffers but lets controls be clicked) -->
                    <div id="videoProtector" style="position: absolute; top: 0; left: 0; width: 100%; height: calc(100% - 60px); z-index: 10; cursor: default;"></div>
                    
                    <video id="videoPlayer" playsinline controls controlsList="nodownload noplaybackrate" disablepictureinpicture
                        style="width: 100%; height: 100%;">
                    </video>

                    <!-- Loading Spinner -->
                    <div id="videoLoader" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #000; z-index: 20; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                        <div class="spinner" style="width: 40px; height: 40px; border: 4px solid rgba(16, 185, 129, 0.1); border-top-color: #10B981; border-radius: 50%; animation: spin 1s linear infinite;"></div>
                        <p style="color: var(--gray); margin-top: 1rem; font-size: 0.8rem;">Loading Secure Stream...</p>
                    </div>

                    <!-- Dynamic Floating Watermark -->
                    <div id="dynamicWatermark"
                        style="position: absolute; top: 10%; left: 10%; pointer-events: none; z-index: 40; opacity: 0.4; font-size: 1.2rem; font-weight: 900; color: rgba(255,255,255,0.3); text-shadow: 0 0 5px rgba(0,0,0,0.5); transform: rotate(-15deg); white-space: nowrap;">
                        {{ auth()->user()->id }} - {{ auth()->user()->email }} <br>
                        <span style="font-size: 0.8rem;">IP: {{ request()->ip() }}</span>
                    </div>
                </div>

                        <!-- Screen Recording Detection Warning -->
                        <div id="recordingWarning"
                            style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: black; z-index: 100; align-items: center; justify-content: center; flex-direction: column; text-align: center; padding: 2rem;">
                            <div style="font-size: 4rem; margin-bottom: 1rem;">🛑</div>
                            <h2 style="color: #ef4444; margin-bottom: 1rem;">Screen Recording Detected</h2>
                            <p style="color: gray;">Please disable any screen recording software to continue watching.</p>
                        </div>

                    </div>

                    <div style="margin-top: 1rem; color: rgba(255,255,255,0.4); font-size: 0.8rem; text-align: center;">
                        UID: {{ auth()->user()->id }} &bull; Session ID: {{ uniqid() }} &bull; Protected by GSM Shield
                    </div>
                </div>
            </div>

            <script>
                // 0. Global State
                let maxTimeWatched = 0;
                let currentRecordingId = null;
                const video = document.getElementById('videoPlayer');

                // 1. Dynamic Watermark Movement
                function moveWatermark() {
                    const watermark = document.getElementById('dynamicWatermark');
                    const container = document.getElementById('videoContainer');

                    if (!watermark || !container) return;

                    const maxX = container.clientWidth - watermark.clientWidth;
                    const maxY = container.clientHeight - watermark.clientHeight;
            <style>
                .play-overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.2);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    opacity: 1; /* Always visible on mobile/all for clarity */
                    transition: all 0.3s ease;
                    cursor: pointer;
                }

                .play-btn-circle {
                    background: rgba(16, 185, 129, 0.9);
                    width: 60px;
                    height: 60px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 0 30px rgba(16, 185, 129, 0.5);
                    transform: scale(0.9);
                    transition: transform 0.3s ease;
                }

                .dashboard-card:hover .play-btn-circle {
                    transform: scale(1.1);
                    background: #10B981;
                }

                .dashboard-card:hover .play-overlay {
                    background: rgba(0, 0, 0, 0.4);
                }
            </style>

            <div class="dashboard-card"
                style="margin-top: 2rem; background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(0, 0, 0, 0.3)); border: 1px solid rgba(99, 102, 241, 0.2);">
                <h4
                    style="margin-bottom: 1.5rem; color: var(--primary-light); display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 1.2rem;">🛡️</span> Mastery Rules
                </h4>

                <div class="mastery-rule">
                    <span class="tip-highlight-red">STOP LOSS IS MANDATORY!</span>
                    <p style="font-size: 0.85rem; color: var(--gray-light); margin-top: 5px;">Bina SL ke trade karna suicide
                        hai. Isay hamesha use karain.</p>
                </div>

                <div class="mastery-rule">
                    Account ka sirf <span class="tip-highlight-green">1-2% Risk</span> karain.
                    <p style="font-size: 0.85rem; color: var(--gray-light); margin-top: 5px;">Chote nuksan se ghabrain mat,
                        ye game ka hissa hai.</p>
                </div>

                <div class="mastery-rule">
                    <span class="tip-highlight-green">Emotional Trading</span> se bachain.
                    <p style="font-size: 0.85rem; color: var(--gray-light); margin-top: 5px;">Loss ke baad revenge trading
                        mat karain, plan par stick rahain.</p>
                </div>

                <div class="mastery-rule">
                    Hamesha <span class="tip-highlight-red">Trend ka saath</span> dain.
                    <p style="font-size: 0.85rem; color: var(--gray-light); margin-top: 5px;">Trend is your friend. Kabhi b
                        trend ke against mat jayen.</p>
                </div>

                <div
                    style="font-size: 0.8rem; color: var(--gray); margin-top: 1rem; font-style: italic; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1rem;">
                    "Risk management is the only holy grail in trading."
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('styles')
    <style>
        @keyframes glow-red {
            0% {
                text-shadow: 0 0 5px rgba(239, 68, 68, 0.2);
            }

            50% {
                text-shadow: 0 0 15px rgba(239, 68, 68, 0.6), 0 0 20px rgba(239, 68, 68, 0.4);
            }

            100% {
                text-shadow: 0 0 5px rgba(239, 68, 68, 0.2);
            }
        }

        @keyframes glow-green {
            0% {
                text-shadow: 0 0 5px rgba(16, 185, 129, 0.2);
            }

            50% {
                text-shadow: 0 0 15px rgba(16, 185, 129, 0.6), 0 0 20px rgba(16, 185, 129, 0.4);
            }

            100% {
                text-shadow: 0 0 5px rgba(16, 185, 129, 0.2);
            }
        }

        .tip-highlight-red {
            color: #ef4444;
            font-weight: 800;
            animation: glow-red 2s infinite;
        }

        .tip-highlight-green {
            color: #10B981;
            font-weight: 800;
            animation: glow-green 2s infinite;
        }

        .mastery-rule {
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .mastery-rule:last-child {
            border-bottom: none;
        }

        .dashboard-card {
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .locked-recording {
            cursor: not-allowed;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <style>
        /* Plyr Dark Theme Overrides */
        :root {
            --plyr-color-main: #10B981;
            --plyr-video-background: #000;
            --plyr-menu-background: rgba(30, 41, 59, 0.95);
            --plyr-menu-color: #fff;
        }

        .plyr--full-ui input[type=range] {
            color: #10B981;
        }

        .plyr__control--overlaid {
            background: rgba(16, 185, 129, 0.8);
        }

        .plyr--video .plyr__control.plyr__tab-focus,
        .plyr--video .plyr__control:hover,
        .plyr--video .plyr__control[aria-expanded=true] {
            background: #10B981;
        }

        /* High Security Styles */
        #videoProtector {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: calc(100% - 40px); /* Leave controls clickable */
            z-index: 10;
            background: rgba(0,0,0,0.01); /* Invisible but present */
        }

        /* Hide external downloaders (IDM, etc) via CSS if they use common classes */
        .idm_download_panel, [class*="idm_"], [id*="idm_"] {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <script>
        // 0. Global State
        let maxTimeWatched = 0;
        let currentRecordingId = null;
        let plyrPlayer;

        // 1. Dynamic Watermark Movement
        function moveWatermark() {
            const watermark = document.getElementById('dynamicWatermark');
            const container = document.getElementById('videoContainer');

            if (!watermark || !container) return;

            const maxX = container.clientWidth - watermark.clientWidth;
            const maxY = container.clientHeight - watermark.clientHeight;

            const randomX = Math.floor(Math.random() * (maxX > 0 ? maxX : 0));
            const randomY = Math.floor(Math.random() * (maxY > 0 ? maxY : 0));

            watermark.style.transition = 'all 3s ease-in-out';
            watermark.style.transform = `translate(${randomX}px, ${randomY}px) rotate(-15deg)`;
        }

        setInterval(moveWatermark, 3500);

        // 2. Video Modal Logic (Optimized for Speed)
        function openVideoModal(url, title, id) {
            const modal = document.getElementById('videoModal');
            const titleEl = document.getElementById('videoTitle');
            const loader = document.getElementById('videoLoader');
            const vPlayer = document.getElementById('videoPlayer');

            if (!modal || !vPlayer) return;

            modal.style.display = 'flex';
            loader.style.display = 'flex';
            titleEl.innerText = title;
            maxTimeWatched = 0; 
            currentRecordingId = id; 

            const isMov = url.toLowerCase().endsWith('.mov');

            if (plyrPlayer) {
                plyrPlayer.source = {
                    type: 'video',
                    title: title,
                    sources: [{ 
                        src: url,
                        type: isMov ? 'video/mp4' : undefined
                    }]
                };
                plyrPlayer.play().catch(e => {
                    console.log('Play blocked, waiting for user interaction');
                    loader.style.display = 'none';
                });
            } else {
                vPlayer.src = url;
                if (isMov) vPlayer.type = 'video/mp4';
                vPlayer.load();
                vPlayer.play();
            }
        }

        function closeVideoModal() {
            const modal = document.getElementById('videoModal');
            if (plyrPlayer) {
                plyrPlayer.pause();
                plyrPlayer.source = {};
            } else {
                const vPlayer = document.getElementById('videoPlayer');
                vPlayer.pause();
                vPlayer.src = "";
            }
            modal.style.display = 'none';
            window.location.reload();
        }

        // Initialize Everything
        document.addEventListener('DOMContentLoaded', () => {
            // Setup Axios
            if (window.axios) {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
            }

            // Setup Plyr
            const vElement = document.querySelector('#videoPlayer');
            if (vElement) {
                plyrPlayer = new Plyr(vElement, {
                    controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'],
                    settings: ['quality', 'speed'],
                    speed: { selected: 1, options: [1] }
                });

                const loader = document.getElementById('videoLoader');

                plyrPlayer.on('ready', () => loader.style.display = 'none');
                plyrPlayer.on('playing', () => loader.style.display = 'none');
                plyrPlayer.on('waiting', () => loader.style.display = 'flex');
                
                plyrPlayer.on('error', (e) => {
                    console.error('Plyr Error:', e);
                    // Fallback to native if Plyr fails silently
                    const v = document.getElementById('videoPlayer');
                    const currentSrc = plyrPlayer.source;
                    if (currentSrc) {
                         v.src = currentSrc;
                         v.play().catch(err => console.warn('Native fallback play failed:', err));
                    }
                    loader.style.display = 'none';
                });

                // Progression Logic
                plyrPlayer.on('seeking', event => {
                    if (plyrPlayer.currentTime > maxTimeWatched + 2) {
                        plyrPlayer.currentTime = maxTimeWatched;
                        alert('Please watch the session linearly. Skipping ahead is disabled.');
                    }
                });

                plyrPlayer.on('timeupdate', event => {
                    if (plyrPlayer.currentTime > maxTimeWatched) {
                        maxTimeWatched = plyrPlayer.currentTime;
                    }
                });
            }

            // Sync Progress
            setInterval(() => {
                if (plyrPlayer && !plyrPlayer.paused && currentRecordingId) {
                    const duration = plyrPlayer.duration;
                    const currentTime = plyrPlayer.currentTime;
                    const progress = (currentTime / duration) * 100;

                    if (progress > 0) {
                        axios.post('{{ route("dashboard.courses.progress") }}', {
                            recording_id: currentRecordingId,
                            progress: progress,
                            watch_time: currentTime
                        }).catch(err => console.error('Progress sync failed:', err));
                    }
                }
            }, 5000);

            // Anti-Fraud Checks
            document.addEventListener('keydown', (e) => {
                if (e.key === 'PrintScreen') {
                    navigator.clipboard.writeText('Protected Content');
                    e.preventDefault();
                }
                if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I')) {
                    e.preventDefault();
                }
            });

            window.addEventListener('blur', () => {
                if (plyrPlayer && !plyrPlayer.paused) {
                    plyrPlayer.pause();
                    document.title = '🛑 Paused';
                }
            });

            window.addEventListener('focus', () => {
                document.title = 'Mentorship Portal';
            });

            document.addEventListener('contextmenu', e => e.preventDefault());


            // 4. Kill IDM buttons aggressively
            const idmKiller = () => {
                const snifferElements = document.querySelectorAll('[class*="idm_"], [id*="idm_"], .idm_download_panel, [class*="sniffer"], [id*="sniffer"]');
                snifferElements.forEach(el => el.remove());
            };

            const observer = new MutationObserver((mutations) => {
                idmKiller();
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });

            setInterval(idmKiller, 500);
        });
    </script>
@endpush