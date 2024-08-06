let mediaItems = JSON.parse(localStorage.getItem('mediaItems')) || [];

function navigateTo(page) {
    window.location.href = page;
}

function uploadMedia() {
    const fileInput = document.getElementById('file-input');
    const description = document.getElementById('description').value;
    const sellerName = document.getElementById('seller-name').value;

    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const mediaItem = {
                id: mediaItems.length,
                src: e.target.result,
                description: description,
                seller: sellerName,
                views: 0,
                likes: 0
            };
            mediaItems.push(mediaItem);
            localStorage.setItem('mediaItems', JSON.stringify(mediaItems));
            navigateTo('center.php');
        };
        reader.readAsDataURL(file);
    } else {
        alert('الرجاء اختيار ملف لرفعه');
    }
}

function displayMedia() {
    const mediaContainer = document.getElementById('media');
    mediaContainer.innerHTML = '';

    mediaItems.forEach(item => {
        const mediaElement = document.createElement('div');
        mediaElement.classList.add('media-item');
        mediaElement.setAttribute('data-id', item.id); // إضافة معرّف الوسائط كبيانات للعنصر

        mediaElement.innerHTML = `
            <img src="${item.src}" alt="خطأ في التحميل">
            <p>${item.description}</p>
            <p><strong>البائع:</strong> ${item.seller}</p>
            <p><strong>المشاهدات:</strong> ${item.views}</p>
            <button onclick="likeMedia(${item.id})">أعجبني (${item.likes})</button>
        `;

        mediaElement.addEventListener('click', () => {
            viewMedia(item.id);
        });

        mediaContainer.appendChild(mediaElement);
    });
}

function viewMedia(id) {
    const mediaItem = mediaItems.find(item => item.id === id);
    if (mediaItem) {
        window.location.href = `details.html?id=${id}`;
    }
}

function likeMedia(id) {
    const mediaItem = mediaItems.find(item => item.id === id);
    if (mediaItem) {
        mediaItem.likes++;
        localStorage.setItem('mediaItems', JSON.stringify(mediaItems));
        displayMedia();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const mediaContainer = document.getElementById('media');
    if (mediaContainer) {
        displayMedia();
    }
});

const title = document.querySelector('.title')
const leaf1 = document.querySelector('.leaf1')
const leaf2 = document.querySelector('.leaf2')
const bush2 = document.querySelector('.bush2')
const mount1 = document.querySelector('.mount1')
const mount2 = document.querySelector('.mount2')

document.addEventListener('scroll', function() {
    let value = window.scrollY
    // console.log(value)
    title.style.marginTop = value * 1.1 + 'px'

    leaf1.style.marginLeft = -value + 'px'
    leaf2.style.marginLeft = value + 'px'

    bush2.style.marginBottom = -value+ 'px'

    mount1.style.marginBottom = -value * 2 + 'px'
    mount2.style.marginBottom = -value * 2 + 'px'
})
