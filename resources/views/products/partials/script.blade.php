<script>
    $(document).ready(function() {
        const $purchasePriceInput = $('#purchase_price');
        const $salePriceInput = $('#sale_price');
        const $imageInput = $('#image');
        const $stockInput = $('#stock');

        function formatRupiah(value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function parseRupiah(value) {
            return parseFloat(value.replace(/[,]/g, '') || 0);
        }

        function showError($element, message) {
            let $error = $element.next('.error-message');
            if ($error.length === 0) {
                $error = $('<span class="error-message text-danger"></span>');
                $element.after($error);
            }
            $error.text(message);
        }

        function hideError($element) {
            $element.next('.error-message').remove();
        }

        $purchasePriceInput.on('input', function() {
            const rawValue = parseRupiah($(this).val());
            if (rawValue <= 0) {
                showError($(this), 'Harga beli harus lebih besar dari 0.');
            } else {
                hideError($(this));
                const salePrice = rawValue * 1.3;
                $salePriceInput.val(formatRupiah(Math.floor(salePrice)));
            }
            $(this).val(formatRupiah(rawValue));
        });

        $stockInput.on('input', function() {
            const stockValue = parseInt($(this).val()) || 0;
            if (stockValue < 0) {
                showError($(this), 'Stok tidak boleh kurang dari 0.');
            } else {
                hideError($(this));
            }
        });

        $imageInput.on('change', function() {
            const file = this.files[0];
            if (file) {
                const validExtensions = ['image/jpeg', 'image/png'];
                const maxSize = 100 * 1024; // 100KB
                if (!validExtensions.includes(file.type)) {
                    showError($(this), 'Format file harus JPG atau PNG.');
                } else if (file.size > maxSize) {
                    showError($(this), 'Ukuran file maksimal 100KB.');
                } else {
                    hideError($(this));
                }
            }
        });


        var isClickHandled = false;

        function previewImage(event) {
            var imageUpload = $('#image-upload');
            var file = event.target.files[0];

            if (file) {
                imageUpload.addClass('uploaded');
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Buat elemen gambar
                    var img = $('<img>')
                        .attr('src', e.target.result)
                        .attr('alt', 'Uploaded Image')
                        .addClass('uploaded-image')
                        .css({
                            width: '80px',
                            height: '80px',
                            objectFit: 'cover'
                        });

                    $('#image-preview img').remove();
                    $('#image-preview').append(img);
                    $('#image-name').text(file.name).show();
                };

                reader.readAsDataURL(file);
            }
        }

        $('#image-upload')
            .on('dragover', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).css('border-color', '#1856e7');
            })
            .on('dragleave', function() {
                $(this).css('border-color', '#eee');
            })
            .on('drop', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).css('border-color', '#1856e7');

                var file = event.originalEvent.dataTransfer.files[0];
                if (file) {
                    $('#image')[0].files = event.originalEvent.dataTransfer.files;
                    previewImage({
                        target: $('#image')[0]
                    });
                }
            });

        $('#image-upload').on('click', function() {
            if (isClickHandled) return;
            isClickHandled = true;

            var input = $('#image');
            if (input[0].files.length === 0) {
                input.click();
            }
        });

        $('#image').on('change', function() {
            if (this.files.length > 0) {
                previewImage({
                    target: this
                });
            }

            isClickHandled = false;
        });

    });
</script>
