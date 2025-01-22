// Ekspor fungsi utama untuk digunakan di app.js
export function initializeUpload() {
    // Input dan Preview Image
    const imageInput = document.getElementById('imageInput');
    const uploadForm = document.getElementById('uploadForm');
    const removeImageBtn = document.getElementById('removeImageBtn');

    // Event Listeners
    if (imageInput) {
        imageInput.addEventListener('change', function () {
            previewImage(this);
        });
    }

    if (removeImageBtn) {
        removeImageBtn.addEventListener('click', removeImage);
    }

    if (uploadForm) {
        uploadForm.addEventListener('submit', function (e) {
            const fileInput = document.getElementById('imageInput');
            if (!fileInput.files || fileInput.files.length === 0) {
                e.preventDefault();
                showNotification('Silakan pilih gambar terlebih dahulu!', 'error');
                return false;
            }
            document.getElementById('loadingIndicator').classList.remove('hidden');
            return true;
        });
    }

    // Sample Images
    document.querySelectorAll('img[alt^="Sample"]').forEach(img => {
        img.addEventListener('click', handleSampleImageClick);
    });

    // Check Messages
    checkSessionMessages();
}

function checkSessionMessages() {
    const successMessage = document.querySelector('meta[name="success-message"]')?.content;
    const errorMessage = document.querySelector('meta[name="error-message"]')?.content;

    if (successMessage) {
        showNotification(successMessage, 'success');
    }
    if (errorMessage) {
        showNotification(errorMessage, 'error');
    }
}

function showNotification(message, type = 'error') {
    // Remove existing notification
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }

    // Create notification
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;

    document.body.appendChild(notification);

    // Animation
    requestAnimationFrame(() => {
        notification.classList.add('slide-in');
    });

    // Auto dismiss
    setTimeout(() => {
        if (notification) {
            notification.classList.add('slide-out');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }
    }, 5000);
}

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const uploadBox = document.getElementById('uploadBox');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
            uploadBox.classList.add('hidden');
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    const preview = document.getElementById('imagePreview');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const uploadBox = document.getElementById('uploadBox');
    const fileInput = document.getElementById('imageInput');

    preview.src = '';
    previewContainer.classList.add('hidden');
    uploadBox.classList.remove('hidden');
    fileInput.value = '';
}

async function handleSampleImageClick() {
    try {
        const response = await fetch(this.src);
        const blob = await response.blob();
        const file = new File([blob], 'sample.png', { type: 'image/png' });

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);

        const fileInput = document.getElementById('imageInput');
        fileInput.files = dataTransfer.files;

        previewImage(fileInput);
    } catch (error) {
        console.error('Error handling sample image:', error);
        showNotification('Gagal memuat gambar contoh', 'error');
    }
}
