<script>
    (function () {
        var container = document.querySelector('.cp-style1');

        if (!container) {
            return;
        }

        var button = container.querySelector('.cp-button');
        var panel = container.querySelector('.cp-panel');
        var whatsappLinks = container.querySelectorAll('.cp-whatsapp');

        function setPanel(open) {
            panel.style.display = open ? 'block' : 'none';
            button.setAttribute('aria-expanded', open ? 'true' : 'false');
            button.setAttribute('aria-label', open ? 'Close contact options' : 'Open contact options');
            button.classList.toggle('rotateForward', open);
            button.classList.toggle('rotateBackward', !open);
        }

        whatsappLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                var number = link.getAttribute('data-number');
                var message = link.getAttribute('data-message') || '';
                var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                var baseUrl = isMobile ? 'https://wa.me/' : 'https://web.whatsapp.com/send?phone=';
                var separator = isMobile ? '/?text=' : '&text=';

                event.preventDefault();
                window.open(baseUrl + encodeURIComponent(number) + separator + encodeURIComponent(message), '_blank', 'noopener,noreferrer');
            });
        });

        button.addEventListener('click', function (event) {
            event.stopPropagation();
            setPanel(button.getAttribute('aria-expanded') !== 'true');
        });

        panel.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        document.addEventListener('click', function () {
            setPanel(false);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                setPanel(false);
                button.focus();
            }
        });
    })();
</script>
