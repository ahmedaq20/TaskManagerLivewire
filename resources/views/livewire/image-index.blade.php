<div class="max-w-7xl mx-auto flex">
    <!-- عرض الصور -->
    <div class="w-8/12 mr-6"> <!-- إضافة margin-right -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($this->images as $image)
                <div class="flex flex-col justify-center items-center bg-slate-50 rounded-lg shadow-lg p-4 mt-6">
                    <img class="h-40 w-40 object-cover rounded-md" src="{{ asset('storage/images/' . $image->name) }}" alt="{{ $image->name }}">
                    <div class="mt-3">
                        <x-primary-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click='download({{ $image->id }})'>
                            Download
                        </x-primary-button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- نموذج رفع الصور -->
    <div class="w-4/12">
        <form class="mt-4 bg-white p-6 rounded-lg shadow-lg" wire:submit.prevent="save">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Upload Image</label>
                <input wire:model="photos" type="file" multiple
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                @if ($photos)
                    <div class="grid grid-cols-3 gap-2 mt-3">
                        @foreach ($photos as $photo)
                            <img class="h-20 w-20 object-cover rounded-md" src="{{ $photo->temporaryUrl() }}">
                        @endforeach
                    </div>
                @endif
                @error('photos')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                @error('photos.*')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <x-primary-button class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Upload</x-primary-button>
        </form>
    </div>
</div>
