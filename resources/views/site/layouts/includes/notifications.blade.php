@foreach (['success', 'danger', 'fail', 'warning', 'info'] as $msg)
    @if($message = Session::get($msg))
        <div class="{{ $msg == 'fail' ? 'bg-red-100 text-reds-5 border-red-200' : 'bg-green-100 text-green-1 border-green-3' }} dark:bg-gray-2 dark:text-white mt-2 px-6 py-2 border-2 rounded relative mx-6" role="alert">
            <div class="mr-4">
                <span class="block sm:inline">{{ $message }}</span>
            </div>
            <span class="cursor-pointer absolute top-0 bottom-0 right-0 {{ $msg == 'fail' ? 'hover:bg-red-100 hover:text-red-600' : 'hover:bg-green-3 hover:text-green-1' }}  w-10 h-10 rounded-full inline-flex items-center justify-center mt-2 mr-3" x-on:click="open = false">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 -mt-4" viewBox="0 0 24 24"
             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
             stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
    </span>
        </div>

        @break
    @endif
@endforeach

@if($errors->any())
    @foreach ($errors->all() as $error)
    <div class="bg-red-300 mt-2  px-6 py-4 rounded-lg relative mb-5" role="alert">
        <div class="mr-4">
            <span class="block sm:inline">{{ $error }}</span>
        </div>
        <span class="cursor-pointer absolute top-0 bottom-0 right-0 hover:bg-red-100 hover:text-red-600 w-10 h-10 rounded-full inline-flex items-center justify-center mt-2 mr-3"
              x-on:click="open = false">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"
             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
             stroke-linejoin="round">
            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
    </span>
    </div>
    @endforeach
@endif

