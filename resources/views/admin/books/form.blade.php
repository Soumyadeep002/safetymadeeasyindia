@extends('admin.layout.main')
@section('main-container')

<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.books.index') }}">Books</a></li>
        <li class="breadcrumb-item">{{ $book ? 'Edit' : 'Add' }} Book</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ $book ? route('admin.books.update', $book) : route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($book) @method('PUT') @endif

            <div class="form-group">
                <label>Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $book->title ?? '') }}" required>
            </div>

            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $book->author ?? '') }}">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $book->description ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label class="d-block mb-2">Pricing breakdown *</label>
                <div class="row">
                    <div class="col-md-4">
                        <label class="small text-muted">Base price (INR)</label>
                        <input type="number" name="base_price" id="base_price" class="form-control pricing-input"
                               step="0.01" min="0" required
                               value="{{ old('base_price', optional($book)->base_price ?? optional($book)->price ?? 0) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="small text-muted">GST (%)</label>
                        <input type="number" name="gst_percent" id="gst_percent" class="form-control pricing-input"
                               step="0.01" min="0" max="100" required
                               value="{{ old('gst_percent', optional($book)->gst_percent ?? 18) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="small text-muted">Gateway charges (%)</label>
                        <input type="number" name="gateway_charge_percent" id="gateway_charge_percent" class="form-control pricing-input"
                               step="0.01" min="0" max="100" required
                               value="{{ old('gateway_charge_percent', optional($book)->gateway_charge_percent ?? 2) }}">
                    </div>
                </div>
                <div class="alert alert-light border mt-3 mb-0" id="pricing-preview">
                    <div class="d-flex justify-content-between"><span>Base price</span><span id="preview-base">₹0.00</span></div>
                    <div class="d-flex justify-content-between"><span>GST</span><span id="preview-gst">₹0.00</span></div>
                    <div class="d-flex justify-content-between"><span>Gateway charges</span><span id="preview-gateway">₹0.00</span></div>
                    <div class="d-flex justify-content-between fw-bold border-top pt-2 mt-2"><span>Final price (customer pays)</span><span id="preview-final" class="text-success">₹0.00</span></div>
                </div>
                <small class="text-muted d-block mt-2">Final price is calculated automatically: base + GST + gateway charges on the subtotal.</small>
            </div>

            <div class="form-group">
                <label>Cover Image</label>
                <input type="file" name="cover" class="form-control" accept="image/*">
                @if($book?->cover_image)
                    <img src="{{ $book->coverUrl() }}" class="mt-2" width="100" alt="">
                @endif
            </div>

            <div class="form-group">
                <label>Book PDF {{ $book ? '(leave empty to keep current)' : '*' }}</label>
                <input type="file" name="pdf" class="form-control" accept="application/pdf" {{ $book ? '' : 'required' }}>
                <small class="text-muted">Max 50MB. Any standard PDF is accepted (including encrypted/compressed). Page 1 is used as the free demo preview.</small>
            </div>

            @if($book)
            <div class="form-group form-check">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ $book->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active (visible to users)</label>
            </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-primary mt-3">{{ $book ? 'Update Book' : 'Upload Book' }}</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
</div>

<script>
(function () {
    function formatInr(value) {
        return '₹' + value.toFixed(2);
    }

    function updatePreview() {
        var base = parseFloat(document.getElementById('base_price').value) || 0;
        var gstPct = parseFloat(document.getElementById('gst_percent').value) || 0;
        var gwPct = parseFloat(document.getElementById('gateway_charge_percent').value) || 0;

        var gstAmount = Math.round(base * gstPct) / 100;
        var subtotal = Math.round((base + gstAmount) * 100) / 100;
        var gwAmount = Math.round(subtotal * gwPct) / 100;
        var finalPrice = Math.round((subtotal + gwAmount) * 100) / 100;

        document.getElementById('preview-base').textContent = formatInr(base);
        document.getElementById('preview-gst').textContent = formatInr(gstAmount) + ' (' + gstPct + '%)';
        document.getElementById('preview-gateway').textContent = formatInr(gwAmount) + ' (' + gwPct + '%)';
        document.getElementById('preview-final').textContent = formatInr(finalPrice);
    }

    document.querySelectorAll('.pricing-input').forEach(function (el) {
        el.addEventListener('input', updatePreview);
    });

    updatePreview();
})();
</script>

@endsection
