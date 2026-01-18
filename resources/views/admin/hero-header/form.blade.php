<form method="POST"
    action="{{ $header ? route('hero-header.update', $header) : route('hero-header.store') }}">
    @csrf
    @if ($header)
        @method('PUT')
    @endif

    <input class="form-control mb-2" name="badge_text" placeholder="Badge Text"
        value="{{ old('badge_text', $header->badge_text ?? '') }}">

    <input class="form-control mb-2" name="title_small_1" placeholder="YOUR"
        value="{{ old('title_small_1', $header->title_small_1 ?? '') }}">

    <input class="form-control mb-2" name="title_main" placeholder="TECH PARTNER"
        value="{{ old('title_main', $header->title_main ?? '') }}">

    <input class="form-control mb-2" name="title_small_2" placeholder="FOR"
        value="{{ old('title_small_2', $header->title_small_2 ?? '') }}">

    <input class="form-control mb-2" name="title_highlight" placeholder="Success"
        value="{{ old('title_highlight', $header->title_highlight ?? '') }}">

    <textarea class="form-control mb-2" name="description" rows="3">{{ old('description', $header->description ?? '') }}</textarea>

    <input class="form-control mb-2" name="primary_btn_text" placeholder="Primary Button Text"
        value="{{ old('primary_btn_text', $header->primary_btn_text ?? '') }}">

    <input class="form-control mb-2" name="primary_btn_link" placeholder="Primary Button Link"
        value="{{ old('primary_btn_link', $header->primary_btn_link ?? '') }}">

    <input class="form-control mb-2" name="secondary_btn_text" placeholder="Secondary Button Text"
        value="{{ old('secondary_btn_text', $header->secondary_btn_text ?? '') }}">

    <input class="form-control mb-2" name="secondary_btn_link" placeholder="Secondary Button Link"
        value="{{ old('secondary_btn_link', $header->secondary_btn_link ?? '') }}">

    <label>
        <input type="checkbox" name="is_active" value="1" {{ $header->is_active ?? true ? 'checked' : '' }}>
        Active
    </label>

    <button class="btn btn-success mt-3">Save</button>
</form>
