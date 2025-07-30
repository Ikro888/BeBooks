const inputFile = document.getElementById('foto');
        const imagePreview = document.getElementById('imgpreview');
        const icon = document.querySelector('#previewcont .icon');

        inputFile.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                icon.style.display = 'none'; // Esconde o ícone
                imagePreview.style.display = 'block'; // Mostra a tag de imagem

                reader.addEventListener('load', function() {
                    imagePreview.setAttribute('src', this.result);
                });

                reader.readAsDataURL(file);
            } else {
                icon.style.display = 'block'; // Mostra o ícone de volta
                imagePreview.style.display = 'none'; // Esconde a imagem
                imagePreview.setAttribute('src', '');
            }
        });