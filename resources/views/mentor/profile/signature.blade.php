<x-app-layout>
    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a]">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('mentor.dashboard') }}" class="text-cyan-400 hover:text-cyan-300">&larr; Kembali</a>
                <h2 class="text-2xl text-white font-bold">Tanda Tangan Mentor</h2>
                <p class="text-slate-400">Upload file gambar tanda tangan Anda (PNG/JPG).</p>
            </div>

            <div class="glass-dark rounded-xl p-6">
                @if(session('success'))
                    <div class="text-green-400 mb-4">{{ session('success') }}</div>
                @endif

                <form action="{{ route('mentor.profile.signature.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="block mb-3">
                        <input type="file" name="signature" accept="image/*" />
                    </label>
                    <div>
                        <button class="bg-cyan-600 text-white px-4 py-2 rounded">Unggah</button>
                    </div>
                </form>

                <div class="mt-6">
                    <h3 class="text-white font-semibold">Tanda Tangan Saat Ini</h3>
                    @if($mentor->signature)
                        <img src="{{ asset('storage/'.$mentor->signature) }}" alt="Signature" class="h-28 mt-2" />
                    @else
                        <div class="text-slate-400">Belum ada tanda tangan.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
