<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Delete Account Button -->
    <button
        type="button"
        x-data
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
    >
        {{ __('Delete Account') }}
    </button>

    <!-- Modal (using Alpine.js for visibility) -->
    <div
        x-data="{ open: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }"
        x-show="open"
        x-on:open-modal.window="if ($event.detail === 'confirm-user-deletion') open = true"
        x-on:close.window="open = false"
        class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"
        style="display: none;"
        aria-modal="true"
        role="dialog"
    >
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 mx-4 relative">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <label for="password" class="sr-only">
                        {{ __('Password') }}
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="{{ __('Password') }}"
                        class="w-3/4 rounded-md border border-gray-300 px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    />
                    @if ($errors->userDeletion->has('password'))
                        <p class="mt-2 text-sm text-red-600">
                            {{ $errors->userDeletion->first('password') }}
                        </p>
                    @endif
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button
                        type="button"
                        x-on:click="$dispatch('close')"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400"
                    >
                        {{ __('Cancel') }}
                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                    >
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>

            <!-- Close button (optional) -->
            <button
                type="button"
                x-on:click="$dispatch('close')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 focus:outline-none"
                aria-label="Close modal"
            >
                &#x2715;
            </button>
        </div>
    </div>
</section>
