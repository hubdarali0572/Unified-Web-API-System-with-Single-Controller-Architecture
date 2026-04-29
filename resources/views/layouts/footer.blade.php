<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-center px-4 py-3 border-top small">
    <p class="text-dark mb-1 mb-md-0">Copyright ©
        <span id="current-year">
        </span>
        <a href="/dashboard" target="_blank" style="color: #042954;" >Single Controller Web & Api</a>
       
    </p>
</footer>

<script>
    document.getElementById('current-year').textContent = new Date().getFullYear();
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Show message form confirmation then leave page -->
<script>
    $(function() {
        let isFormDirty = false;
        let isNavigating = false;

        // Detect changes in form inputs
        $('form').on('submit', function() {
            isNavigating = true;
        });

        $('form').on('change input', 'input, select, textarea', function() {
            isFormDirty = true;
        });

        // Global click handler for links
        $('a').on('click', function(e) {
            const $this = $(this);
            const isCancelLink = $this.attr('onclick')?.includes('confirmCancel');
            const href = $this.attr('href');

            if (isFormDirty && !isNavigating && !isCancelLink && href && href !== 'javascript:void(0);') {
                e.preventDefault();

                Swal.fire({
                    html: '<p class="custom-swal-title">Changes you made may not be saved.</p>',
                    icon: 'warning',
                    iconColor: 'grey',
                    showCancelButton: true,
                    confirmButtonColor: '#286090',
                    cancelButtonColor: '#c9302c',
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Leave',
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'swal2-confirm-custom',
                        cancelButton: 'swal2-cancel-custom'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        isNavigating = true;
                        window.location.href = href;
                    }
                });
            }
        });

        // Cancel button confirmation (same SweetAlert)
        window.confirmCancel = function(url) {
            if (isNavigating) {
                // If already confirmed once, just go directly
                window.location.href = url;
                return;
            }

            Swal.fire({
                html: '<p class="custom-swal-title">Changes you made may not be saved.</p>',
                icon: 'warning',
                iconColor: 'grey',
                showCancelButton: true,
                confirmButtonColor: '#286090',
                cancelButtonColor: '#c9302c',
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Leave',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'swal2-confirm-custom',
                    cancelButton: 'swal2-cancel-custom'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    isNavigating = true;
                    window.location.href = url;
                }
            });
        };
    });
</script>



<!-- phone Number -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.getElementById('phone');
        const clearButton = document.getElementById('clearButton');
        const fullPhoneNumber = document.getElementById('fullPhoneNumber');

        // Phone input events
        phoneInput.addEventListener('input', function() {
            // Allow only numbers
            this.value = this.value.replace(/\D/g, '');

            // Limit to 10 digits (Pakistani mobile format)
            if (this.value.length > 10) {
                this.value = this.value.slice(0, 10);
            }

            // Make sure it starts with a 3 (for Pakistani mobile numbers)
            if (this.value.length > 0 && this.value[0] !== '3') {
                this.value = '3' + this.value.substring(1);
            }

            // Show clear button only when there's input AND user is actively typing/focusing
            clearButton.style.display = this.value && document.activeElement === this ? 'block' : 'none';

            // Update full phone number hidden field
            fullPhoneNumber.value = '+92' + this.value;
        });

        // Show clear button on focus if there's a value
        phoneInput.addEventListener('focus', function() {
            if (this.value) {
                clearButton.style.display = 'block';
            }
        });

        // Hide clear button on blur (when input loses focus)
        phoneInput.addEventListener('blur', function() {
            // Small delay to allow for click on clear button
            setTimeout(() => {
                clearButton.style.display = 'none';
            }, 200);
        });

        // Clear button
        clearButton.addEventListener('click', function() {
            phoneInput.value = '';
            clearButton.style.display = 'none';
            fullPhoneNumber.value = '+92';
        });

        // Initialize
        clearButton.style.display = phoneInput.value ? 'block' : 'none';
        if (phoneInput.value) {
            fullPhoneNumber.value = '+92' + phoneInput.value;
        }
    });
</script>