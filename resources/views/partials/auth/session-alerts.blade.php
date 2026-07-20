@if(session('success') || session('error') || session('info'))
<div class="auth-toast-stack" id="authToastStack">
    @if(session('success'))
        <div class="auth-toast auth-toast--success" data-autohide="6000">
            <i class="fa-solid fa-circle-check auth-toast__icon"></i>
            <div class="auth-toast__body">{{ session('success') }}</div>
            <button type="button" class="auth-toast__close" aria-label="Dismiss">&times;</button>
        </div>
    @endif
    @if(session('error'))
        <div class="auth-toast auth-toast--error" data-autohide="8000">
            <i class="fa-solid fa-circle-xmark auth-toast__icon"></i>
            <div class="auth-toast__body">{{ session('error') }}</div>
            <button type="button" class="auth-toast__close" aria-label="Dismiss">&times;</button>
        </div>
    @endif
    @if(session('info'))
        <div class="auth-toast auth-toast--info" data-autohide="7000">
            <i class="fa-solid fa-circle-info auth-toast__icon"></i>
            <div class="auth-toast__body">{{ session('info') }}</div>
            <button type="button" class="auth-toast__close" aria-label="Dismiss">&times;</button>
        </div>
    @endif
</div>
@endif
