<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <!-- Category -->
    <select name="category_id" class="w-full rounded-xl border p-3">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <input name="model" placeholder="Model" class="w-full border p-3 rounded-xl">
    <input name="title" placeholder="Title" class="w-full border p-3 rounded-xl">
    <input name="price" placeholder="Price" class="w-full border p-3 rounded-xl">

    <input type="file" name="image">

    <input name="badge_text" placeholder="Badge Text" class="w-full border p-3 rounded-xl">
    <input name="badge_color" placeholder="Badge Color (bg-blue-500)" class="w-full border p-3 rounded-xl">

    <!-- Specs -->
    <div id="specs-wrapper" class="space-y-3">
        <div class="flex gap-3">
            <input name="specs[0][icon]" placeholder="fa-icon" class="w-1/3 border p-2 rounded">
            <input name="specs[0][text]" placeholder="Spec text" class="w-2/3 border p-2 rounded">
        </div>
    </div>

    <button type="button" onclick="addSpec()" class="text-blue-600">
        + Add Spec
    </button>

    <button class="px-6 py-3 bg-green-600 text-white rounded-xl">
        Save Product
    </button>
</form>

<script>
    let specIndex = 1;

    function addSpec() {
        document.getElementById('specs-wrapper').insertAdjacentHTML('beforeend', `
        <div class="flex gap-3">
            <input name="specs[${specIndex}][icon]" class="w-1/3 border p-2 rounded">
            <input name="specs[${specIndex}][text]" class="w-2/3 border p-2 rounded">
        </div>
    `);
        specIndex++;
    }
</script>
