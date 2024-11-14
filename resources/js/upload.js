// resources/js/upload.js
const handleImageUpload = (input) => {
    const uploadSection = document.getElementById('uploadSection');
    const previewSection = document.getElementById('previewSection');
    const submitButton = document.getElementById('submitButton');
    const preview = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            uploadSection.classList.add('hidden');
            previewSection.classList.remove('hidden');
            submitButton.classList.remove('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

const removeImage = () => {
    const uploadSection = document.getElementById('uploadSection');
    const previewSection = document.getElementById('previewSection');
    const submitButton = document.getElementById('submitButton');
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('imagePreview');

    imageInput.value = '';
    preview.src = '';
    uploadSection.classList.remove('hidden');
    previewSection.classList.add('hidden');
    submitButton.classList.add('hidden');
}

const handleSampleImage = async (img) => {
    try {
        const response = await fetch(img.src);
        const blob = await response.blob();
        const file = new File([blob], 'sample.jpg', { type: 'image/jpeg' });
        
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        
        const fileInput = document.getElementById('imageInput');
        fileInput.files = dataTransfer.files;
        
        handleImageUpload(fileInput);
    } catch (error) {
        console.error('Error handling sample image:', error);
    }
}

const initializeUpload = () => {
    const uploadForm = document.getElementById('uploadForm');
    if (uploadForm) {
        uploadForm.onsubmit = () => {
            document.getElementById('loadingIndicator').classList.remove('hidden');
            return true;
        }
    }

    const imageInput = document.getElementById('imageInput');
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            handleImageUpload(this);
        });
    }

    const removeButton = document.querySelector('[onclick="removeImage()"]');
    if (removeButton) {
        removeButton.onclick = removeImage;
    }

    document.querySelectorAll('img[alt^="Sample"]').forEach(img => {
        img.addEventListener('click', () => handleSampleImage(img));
    });
}

export {
    initializeUpload,
    handleImageUpload,
    removeImage,
    handleSampleImage
}