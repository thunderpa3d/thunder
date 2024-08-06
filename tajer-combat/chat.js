function sendMessage() {
    const senderNameInput = document.getElementById('senderName');
    const messageInput = document.getElementById('messageInput');
    const senderName = senderNameInput.value.trim();
    const messageText = messageInput.value.trim();
    
    if (senderName && messageText) {
        // إنشاء عنصر جديد للرسالة
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', 'sent');
        messageDiv.innerHTML = `
            <div class="sender">${senderName}</div>
            <p>${messageText}</p>
        `;

        // إضافة الرسالة إلى الحاوية
        const messagesContainer = document.getElementById('messages');
        messagesContainer.appendChild(messageDiv);

        // تنظيف حقول الإدخال
        senderNameInput.value = '';
        messageInput.value = '';

        // تمرير الرسائل تلقائيًا إلى الأسفل
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
}
