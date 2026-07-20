(function () {
    'use strict';

    /* User dropdown */
    var trigger = document.getElementById('userNavTrigger');
    var dropdown = document.getElementById('userNavDropdown');

    if (trigger && dropdown) {
        trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            var open = dropdown.classList.toggle('is-open');
            trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
        });

        document.addEventListener('click', function () {
            dropdown.classList.remove('is-open');
            trigger.setAttribute('aria-expanded', 'false');
        });

        dropdown.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    }

    /* Session toasts */
    var stack = document.getElementById('authToastStack');
    if (stack) {
        stack.querySelectorAll('.auth-toast').forEach(function (toast) {
            var closeBtn = toast.querySelector('.auth-toast__close');
            var hide = function () {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(20px)';
                setTimeout(function () {
                    toast.remove();
                    if (stack && !stack.children.length) {
                        stack.remove();
                    }
                }, 250);
            };

            if (closeBtn) {
                closeBtn.addEventListener('click', hide);
            }

            var delay = parseInt(toast.getAttribute('data-autohide') || '6000', 10);
            setTimeout(hide, delay);
        });
    }
})();
