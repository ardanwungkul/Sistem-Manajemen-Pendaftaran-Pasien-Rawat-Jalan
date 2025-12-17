<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="space-y-2">
            <div>
                <label class="!text-sm md:!text-sm" for="email">Email</label>
                <input type="text"
                    class="block mt-1 w-full rounded-xl autofill:!bg-white border border-gray-300 focus:ring-0 !text-sm md:!text-sm"
                    name="email" id="email" :value="old('email')" required placeholder="Masukkan Email"
                    autocomplete="email">
            </div>

            <div>
                <label class="!text-sm md:!text-sm" for="password">Password</label>
                <input type="password"
                    class="block mt-1 w-full rounded-xl autofill:!bg-white border border-gray-300 focus:ring-0 !text-sm md:!text-sm"
                    name="password" id="password" :value="old('password')" placeholder="Masukkan Password" required
                    autocomplete="password">
            </div>

            <div>
                <button type="submit"
                    class="bg-blue-900 hover:opacity-90 transition-all duration-300 text-white rounded-xl w-full py-2 px-3 text-sm mt-3">
                    Masuk
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>
