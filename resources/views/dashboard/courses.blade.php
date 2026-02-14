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
                    <div class="grid" style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">
                        @foreach($recordings as $recording)
                            <div class="dashboard-card" style="padding: 0; overflow: hidden; position: relative;">
                                <div style="position: relative;">
                                    @if($recording->thumbnail_url)
                                        <div
                                            style="height: 180px; background-image: url('{{ asset($recording->thumbnail_url) }}'); background-size: cover; background-position: center;">
                                        </div>
                                    @else
                                        <div
                                            style="height: 180px; background: var(--dark-light); display: flex; align-items: center; justify-content: center;">
                                            <span style="font-size: 3rem;">🎬</span>
                                        </div>
                                    @endif

                                    <!-- Play Overlay -->
                                    <div class="play-overlay"
                                        onclick="openVideoModal('{{ asset($recording->video_url) }}', '{{ $recording->title }}')">
                                        <div
                                            style="background: rgba(16, 185, 129, 0.9); width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 20px rgba(16, 185, 129, 0.4);">
                                            <svg style="width: 20px; height: 20px; fill: white; margin-left: 3px;"
                                                viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div style="padding: 1.25rem;">
                                    <div style="font-weight: bold; font-size: 1rem; margin-bottom: 0.5rem; color: var(--white);">
                                        {{ $recording->title }}
                                    </div>
                                    <div style="font-size: 0.8rem; color: var(--gray); margin-bottom: 0.5rem;">
                                        {{ $recording->published_at->format('l, M d, Y') }}
                                    </div>
                                    @if($recording->description)
                                        <div style="font-size: 0.85rem; color: var(--gray-light); line-height: 1.4;">
                                            {{ \Illuminate\Support\Str::limit($recording->description, 60) }}
                                        </div>
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
                style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.95); z-index: 9999; align-items: center; justify-content: center;">
                <button onclick="closeVideoModal()"
                    style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: white; font-size: 2rem; cursor: pointer; z-index: 10001;">&times;</button>

                <div style="width: 90%; max-width: 1000px; position: relative;">
                    <h3 id="videoTitle" style="color: white; margin-bottom: 1rem; font-size: 1.25rem;"></h3>
                    <div
                        style="position: relative; padding-bottom: 56.25%; height: 0; background: black; border-radius: 8px; overflow: hidden; box-shadow: 0 0 50px rgba(0,0,0,0.5);">
                        <video id="videoPlayer" controls controlsList="nodownload" oncontextmenu="return false;"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                            <source src="" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        <!-- Security Overlay -->
                        <div
                            style="position: absolute; top: 10px; right: 10px; opacity: 0.3; pointer-events: none; font-size: 0.8rem; color: white; font-weight: bold;">
                            {{ auth()->user()->id }} - {{ auth()->user()->email }}
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function openVideoModal(url, title) {
                    const modal = document.getElementById('videoModal');
                    const player = document.getElementById('videoPlayer');
                    const titleEl = document.getElementById('videoTitle');

                    player.src = url;
                    titleEl.innerText = title;
                    modal.style.display = 'flex';
                    player.play();
                }

                function closeVideoModal() {
                    const modal = document.getElementById('videoModal');
                    const player = document.getElementById('videoPlayer');

                    player.pause();
                    player.src = '';
                    modal.style.display = 'none';
                }
            </script>

            <style>
                .play-overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.3);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    opacity: 0;
                    transition: opacity 0.3s ease;
                    cursor: pointer;
                }

                .dashboard-card:hover .play-overlay {
                    opacity: 1;
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
                    <p style="font-size: 0.85rem; color: var(--gray-light); margin-top: 5px;">Bina SL ke trade karna
                        suicide hai. Isay hamesha use karain.</p>
                </div>

                <div class="mastery-rule">
                    Account ka sirf <span class="tip-highlight-green">1-2% Risk</span> karain.
                    <p style="font-size: 0.85rem; color: var(--gray-light); margin-top: 5px;">Chote nuksan se ghabrain
                        mat, ye game ka hissa hai.</p>
                </div>

                <div class="mastery-rule">
                    <span class="tip-highlight-green">Emotional Trading</span> se bachain.
                    <p style="font-size: 0.85rem; color: var(--gray-light); margin-top: 5px;">Loss ke baad revenge
                        trading mat karain, plan par stick rahain.</p>
                </div>

                <div class="mastery-rule">
                    Hamesha <span class="tip-highlight-red">Trend ka saath</span> dain.
                    <p style="font-size: 0.85rem; color: var(--gray-light); margin-top: 5px;">Trend is your friend.
                        Kabhi b trend ke against mat jayen.</p>
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
    </style>
@endpush