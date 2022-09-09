<aside class="main-menu h-full" aria-label="Sidebar">
    <div class="overflow-y-auto py-10 px-5 bg-gray-50 flex flex-col justify-start items-start rounded dark:bg-gray-800 h-full border-r border-gray-50 drop-shadow-xl">
        <a href="{{ route('home') }}" class="flex items-center pl-2.5 mb-5">
            <img src="{{ asset('images/logo.png') }}" class="mr-3 h-6 sm:h-7" alt="{{ config('app.name') }}" />
        </a>
        <ul class="space-y-8 mt-20 h-full w-full">
            @foreach($menu as $key => $value)
                <li>
                    <a
                        href="{{ route($key) }}"
                        class="flex items-center gap-2 p-2 text-base rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ Route::is($key) ? 'text-primary-500 bg-gray-100 font-medium' : 'text-gray-500 font-normal' }}">
                        <i class="fa {{ $value['icon'] }}"></i>
                        <span>@lang($value['title'])</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <div
            href="{{ route('auth.logout') }}"
            class="w-full flex flex-row justify-start items-center gap-2 p-2 text-base rounded-lg dark:text-white dark:hover:bg-gray-700 text-gray-500 font-normal">
            <a href="{{ route('my-profile') }}">
                <x-user-avatar :user="auth()->user()" />
            </a>
            <div class="flex flex-col justify-center items-start gap-0">
                <a href="{{ route('my-profile') }}">{{ auth()->user()->name }}</a>
                <a href="{{ route('auth.logout') }}" class="flex flex-row justify-start items-center gap-2 text-gray-500 hover:text-red-500 text-xs font-normal">
                    @lang('Sign out')
                    <i class="fa fa-sign-out"></i>
                </a>
            </div>
        </div>
    </div>
</aside>
