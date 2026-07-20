<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} — {{ $mode === 'demo' ? 'Demo' : 'Reader' }}</title>
    <link rel="stylesheet" href="{{ url('assets/css/vendor/bootstrap.min.css') }}">
    <style>
        * { user-select: none !important; -webkit-user-select: none !important; }
        html, body { margin: 0; padding: 0; height: 100%; overflow: hidden; background: #1a1a2e; }
        .reader-toolbar {
            background: #16213e; color: #fff; padding: 10px 20px;
            display: flex; justify-content: space-between; align-items: center;
            position: fixed; top: 0; left: 0; right: 0; z-index: 100; height: 56px;
        }
        .reader-toolbar a { color: #fff; text-decoration: none; }
        #viewer-container {
            position: fixed; top: 56px; left: 0; right: 0; bottom: 0;
            overflow: auto; background: #2d2d44;
            display: flex; flex-direction: column; align-items: center;
            padding: 20px 0;
        }
        #pdf-canvas-wrap { position: relative; margin-bottom: 16px; box-shadow: 0 4px 24px rgba(0,0,0,.4); }
        canvas { display: block; max-width: 100%; height: auto !important; }
        .watermark {
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            pointer-events: none; z-index: 10;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; color: rgba(0,0,0,0.08); transform: rotate(-30deg);
            font-weight: bold; text-align: center; overflow: hidden;
        }
        .page-nav { color: #fff; }
        .page-nav button { margin: 0 4px; }
        .demo-badge {
            background: #ffc107; color: #000; padding: 4px 10px;
            border-radius: 4px; font-size: 0.75rem; margin-left: 8px;
        }
        #purchase-modal .modal-content { border-radius: 12px; }
        @media print { body * { display: none !important; } }
    </style>
</head>
<body oncontextmenu="return false;" ondragstart="return false;">

<div class="reader-toolbar">
    <div>
        <a href="{{ route('books.show', $book) }}">&larr; Back</a>
        <span class="ms-3">{{ $book->title }}</span>
        @if($mode === 'demo')
            <span class="demo-badge">Demo — Page 1 only</span>
        @endif
    </div>
    <div class="page-nav">
        <button class="btn btn-sm btn-light" id="prev-page" disabled>&larr; Prev</button>
        <span id="page-num">1</span> / <span id="page-count">1</span>
        <button class="btn btn-sm btn-light" id="next-page">Next &rarr;</button>
    </div>
</div>

<div id="viewer-container">
    <div id="pdf-canvas-wrap">
        <canvas id="pdf-canvas"></canvas>
        <div class="watermark" id="watermark">{{ $watermark }}</div>
    </div>
</div>

@if($mode === 'demo')
<div class="modal fade" id="purchase-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Purchase required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">This is a <strong>free demo</strong> — only page 1 is available.</p>
                <p class="mb-0 text-muted">Purchase this book to read all {{ $book->total_pages }} pages in the secure viewer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Stay on demo</button>
                <a href="{{ $purchaseUrl }}" class="btn btn-success">Purchase book</a>
            </div>
        </div>
    </div>
</div>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="{{ url('assets/js/plugins/bootstrap.min.js') }}"></script>
<script>
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    const MODE = @json($mode);
    const MAX_DEMO_PAGES = 1;
    const streamUrl = @json($streamUrl);
    const purchaseModalEl = document.getElementById('purchase-modal');
    const purchaseModal = purchaseModalEl ? new bootstrap.Modal(purchaseModalEl) : null;

    let pdfDoc = null;
    let pageNum = 1;
    let pageRendering = false;
    let pageNumPending = null;
    const canvas = document.getElementById('pdf-canvas');
    const ctx = canvas.getContext('2d', { willReadFrequently: false });

    document.addEventListener('contextmenu', e => e.preventDefault());
    document.addEventListener('keydown', e => {
        if ((e.ctrlKey || e.metaKey) && ['p','s','c','a','u'].includes(e.key.toLowerCase())) e.preventDefault();
        if (e.key === 'PrintScreen') { navigator.clipboard?.writeText(''); }

        if (MODE === 'demo' && ['ArrowRight', 'PageDown', ' '].includes(e.key)) {
            e.preventDefault();
            promptPurchase();
        }
    });
    document.addEventListener('keyup', e => { if (e.key === 'PrintScreen') alert('Screenshots are disabled for protected content.'); });

    function promptPurchase() {
        if (purchaseModal) {
            purchaseModal.show();
        } else {
            alert('Demo preview is page 1 only. Please purchase the book to continue reading.');
        }
    }

    function getMaxPages() {
        if (!pdfDoc) return 1;
        return MODE === 'demo' ? MAX_DEMO_PAGES : pdfDoc.numPages;
    }

    function renderPage(num) {
        if (MODE === 'demo' && num > MAX_DEMO_PAGES) {
            promptPurchase();
            return;
        }

        pageRendering = true;
        pdfDoc.getPage(num).then(page => {
            const viewport = page.getViewport({ scale: 1.5 });
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            return page.render({ canvasContext: ctx, viewport }).promise;
        }).then(() => {
            pageRendering = false;
            pageNum = num;
            document.getElementById('page-num').textContent = num;
            document.getElementById('page-count').textContent = getMaxPages();
            document.getElementById('prev-page').disabled = num <= 1;
            document.getElementById('next-page').disabled = MODE !== 'demo' && num >= getMaxPages();
            if (pageNumPending !== null) {
                const pending = pageNumPending;
                pageNumPending = null;
                renderPage(pending);
            }
        }).catch(() => {
            pageRendering = false;
        });
    }

    function queueRenderPage(num) {
        if (MODE === 'demo' && num > MAX_DEMO_PAGES) {
            promptPurchase();
            return;
        }
        if (pageRendering) pageNumPending = num;
        else renderPage(num);
    }

    document.getElementById('prev-page').addEventListener('click', () => {
        if (pageNum <= 1) return;
        queueRenderPage(pageNum - 1);
    });

    document.getElementById('next-page').addEventListener('click', () => {
        if (MODE === 'demo') {
            if (pageNum >= MAX_DEMO_PAGES) {
                promptPurchase();
            }
            return;
        }
        if (pageNum >= getMaxPages()) return;
        queueRenderPage(pageNum + 1);
    });

    fetch(streamUrl, { credentials: 'same-origin' })
        .then(r => { if (!r.ok) throw new Error('Access denied'); return r.arrayBuffer(); })
        .then(data => pdfjsLib.getDocument({ data, disableAutoFetch: true, disableStream: false }).promise)
        .then(pdf => {
            pdfDoc = pdf;
            renderPage(1);
        })
        .catch(() => {
            document.getElementById('viewer-container').innerHTML =
                '<p style="color:#fff;text-align:center;margin-top:80px;">Unable to load book. Please purchase or try again.</p>';
        });
</script>
</body>
</html>
