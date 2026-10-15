@csrf

<div class="bg-white border border-neutral-200 p-8 md:p-10">

    <div class="mb-6">
        <label class="field-label">NAMA MODEL</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="field">
        @error('name') <p class="field-error">{{ $message }}</p> @enderror
    </div>

    <div class="mb-6">
        <label class="field-label">DESKRIPSI</label>
        <textarea name="description" rows="4" class="field">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description') <p class="field-error">{{ $message }}</p> @enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-6 mb-6">
        <div>
            <label class="field-label">HARGA (RUPIAH)</label>
            <input type="number" name="price" min="0" value="{{ old('price', $product->price ?? '') }}" class="field">
            @error('price') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="field-label">SEGMEN</label>
            <select name="segment" class="field">
                @foreach(\App\Models\Product::SEGMENTS as $value => $label)
                    <option value="{{ $value }}" @selected(old('segment', $product->segment ?? '') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('segment') <p class="field-error">{{ $message }}</p> @enderror
        </div>
    </div>

    <p class="text-[11px] font-bold tracking-[0.25em] mt-10 mb-5 pb-3 border-b">SPESIFIKASI (OPSIONAL)</p>

    <div class="grid sm:grid-cols-2 gap-6 mb-6">
        @foreach([
            'power'        => ['TENAGA', 'mis. 525 PS'],
            'acceleration' => ['0–100 KM/JAM', 'mis. 3,2 detik'],
            'top_speed'    => ['KECEPATAN MAKS.', 'mis. 296 km/jam'],
            'seats'        => ['KAPASITAS', 'mis. 2 kursi'],
            'drivetrain'   => ['PENGGERAK', 'mis. RWD / AWD'],
        ] as $field => [$label, $placeholder])
            <div>
                <label class="field-label">{{ $label }}</label>
                <input type="text" name="{{ $field }}" value="{{ old($field, $product->$field ?? '') }}" placeholder="{{ $placeholder }}" class="field">
                @error($field) <p class="field-error">{{ $message }}</p> @enderror
            </div>
        @endforeach
    </div>

    <div class="mb-10">
        <label class="field-label">GAMBAR</label>

        @if(!empty($product->image))
            <div class="car-stage w-64 p-4 mb-3">
                <img src="{{ $product->image_url }}" alt="" class="w-full object-contain">
            </div>
            <p class="text-xs text-neutral-500 mb-2">Kosongkan jika tidak ingin mengganti gambar.</p>
        @else
            <p class="text-xs text-neutral-500 mb-2">Disarankan PNG berlatar transparan, tampak samping.</p>
        @endif

        <input type="file" name="image" accept="image/*" class="text-sm">
        @error('image') <p class="field-error">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center gap-6">
        <button class="btn btn-dark">SIMPAN</button>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-bold tracking-widest text-neutral-500 hover:text-black">BATAL</a>
    </div>
</div>
