<section class="space-y-6" x-data="{ confirmingUserDeletion: false }">
    <header>
        <h2 class="text-lg font-medium text-black">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-700">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    </header>

    {{-- This button will now show the form below instead of a modal --}}
    <x-danger-button
        x-show="!confirmingUserDeletion"
        x-on:click.prevent="confirmingUserDeletion = true"
    >{{ __('Delete Account') }}</x-danger-button>

    {{-- This is the confirmation form that will appear on the page --}}
    <div x-show="confirmingUserDeletion" class="mt-6 p-6 bg-red-50 border border-red-200 rounded-lg">
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-black">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-700">
                {{ __('Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                {{-- This button now hides the form --}}
                <x-secondary-button x-on:click="confirmingUserDeletion = false">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </div>
</section>