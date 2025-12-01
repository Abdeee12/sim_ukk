<x-app-layout>
    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-6">
                <a href="{{ route('admin.dashboard') }}" class="text-cyan-400 hover:text-cyan-300 mb-2 inline-block">&larr; Kembali</a>
                <h2 class="text-3xl font-bold text-white">Daftar Laporan Harian</h2>
                <p class="text-slate-400">Monitoring laporan yang dikirim oleh siswa.</p>
            </div>

            <div class="glass-dark rounded-xl p-4 overflow-auto">
                @if($laporans->isEmpty())
                    <div class="text-slate-400 p-6">Belum ada laporan.</div>
                @else
                    <table class="w-full text-sm text-left text-white">
                        <thead class="text-xs uppercase bg-slate-800 text-slate-400">
                            <tr>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Siswa</th>
                                <th class="px-4 py-3">Kegiatan</th>
                                <th class="px-4 py-3">Bukti</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporans as $lap)
                                <tr class="border-t border-slate-700">
                                    <td class="px-4 py-3">{{ $lap->tanggal }}</td>
                                    <td class="px-4 py-3">{{ optional($lap->siswa->user)->name ?? '—' }}</td>
                                    <td class="px-4 py-3">{{ Str::limit($lap->detail_kegiatan, 80) }}</td>
                                    <td class="px-4 py-3">@if($lap->path_bukti) <a href="{{ asset('storage/'.$lap->path_bukti) }}" target="_blank" class="text-cyan-300">Lihat</a> @else — @endif</td>
                                    <td class="px-4 py-3">{{ ucfirst($lap->status) }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.laporan.show', $lap) }}" class="text-cyan-300 text-sm">Detail</a>
                                            <a href="{{ route('admin.laporan.edit', $lap) }}" class="text-slate-300 text-sm ml-2">Edit</a>

                                            <form action="{{ route('admin.laporan.updateStatus', $lap) }}" method="POST" class="js-quick-status" data-show-url="{{ route('admin.laporan.show', $lap) }}" onsubmit="return false;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="button" class="js-quick-status-btn text-white bg-green-600 hover:bg-green-500 text-xs px-2 py-1 rounded">Selesai</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $laporans->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
                    <script>
        (function () {
            function getCsrfToken() {
                var el = document.querySelector('meta[name="csrf-token"]');
                if (el) return el.getAttribute('content');
                var input = document.querySelector('input[name="_token"]');
                return input ? input.value : '';
            }

            function mapStatusLabel(status) {
                switch (status) {
                    case 'approved': return 'Selesai';
                    case 'rejected': return 'Ditolak';
                    case 'pending':
                    default:
                        return 'Pending';
                }
            }

            document.querySelectorAll('.js-quick-status-btn').forEach(function(btn){
                btn.addEventListener('click', function(e){
                    if (!confirm('Tandai laporan ini sebagai selesai?')) return;
                    var form = btn.closest('form.js-quick-status');
                    if (!form) return;
                    var url = form.getAttribute('action');
                    var formData = new FormData(form);
                    // Disable button while processing
                    btn.disabled = true;
                    btn.textContent = 'Menyimpan…';

                    fetch(url, {
                        method: 'POST', // use POST with method spoofing
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': getCsrfToken()
                        },
                        body: formData,
                        credentials: 'same-origin'
                    }).then(function(resp){
                        if (!resp.ok) return resp.text().then(function(t){ throw new Error(t || resp.statusText); });
                        return resp.json().catch(function(){ return null; });
                    }).then(function(json){
                        // update the status cell in the same row
                        var row = btn.closest('tr');
                        if (row) {
                            var tds = row.querySelectorAll('td');
                            if (tds && tds.length >= 5) {
                                var newStatus = (json && json.laporan && json.laporan.status) ? json.laporan.status : form.querySelector('input[name="status"]').value;
                                tds[4].textContent = mapStatusLabel(newStatus);
                            }
                            // optional: disable the action button now
                            btn.textContent = 'Selesai';
                            btn.classList.remove('bg-green-600');
                            btn.classList.add('bg-slate-600');
                            btn.disabled = true;
                        }
                    }).catch(function(err){
                        alert('Gagal menyimpan: '+ (err.message || err));
                        btn.disabled = false;
                        btn.textContent = 'Selesai';
                    });
                });
            });
        })();
    </script>
</x-app-layout>
