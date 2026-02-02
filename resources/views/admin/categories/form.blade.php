<form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
    @csrf

    <div>
        <label class="font-semibold">Category Name</label>
        <input type="text" name="name" class="w-full rounded-xl border p-3">
    </div>

    <button class="px-6 py-3 bg-blue-600 text-white rounded-xl">
        Add Category
    </button>
</form>
