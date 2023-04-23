@props(['listing'])

<div class="bg-gray-50 border border-gray-200 rounded p-6">
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src={{$listing['logo'] ? asset("storage/{$listing -> logo}") : asset("images/no-image.png") }}
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listing/{{$listing -> id}}">{{$listing -> title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing -> company}}</div>
            <x-listing-tag  :tags="$listing -> tags"  />
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing -> location}}
            </div>
            <form method="POST" action="/listings/{{$listing -> id}}">
                @csrf
                @method('DELETE')
                <button class="text-red-500">
                   <i class="fa-solid fa-trash"></i> 
                   DELETE
                </button>
            </form>
        </div>
    </div>
</div>