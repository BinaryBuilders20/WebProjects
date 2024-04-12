const form = document.querySelector('.typing-area');
const inputField = form.querySelector('.input-field');
const chatBox = document.querySelector('.chat-box');
const sendBtn = form.querySelector('button');

form.addEventListener('submit', function(e) {
    e.preventDefault();
});

sendBtn.addEventListener('click', function() {
    let req = new XMLHttpRequest();
    req.open("POST", "php/insert-message.php", true);
    req.onload = function() {
        if (req.readyState === XMLHttpRequest.DONE) {
            if (req.status === 200) {
                inputField.value = ""; // Clear input field after sending message
                scrollChatToBottom();
            }
        }
    };
    let formData = new FormData(form);
    req.send(formData);
});

chatBox.addEventListener('mouseenter', function() {
    chatBox.classList.add('active');
});

chatBox.addEventListener('mouseleave', function() {
    chatBox.classList.remove('active');
});

setInterval(function() {
    let req = new XMLHttpRequest();
    req.open("POST", "php/get-message.php", true);
    req.onload = function() {
        if (req.readyState === XMLHttpRequest.DONE) {
            if (req.status === 200) {
                let data = req.response;
                chatBox.innerHTML = data;
                if (!chatBox.classList.contains('active')) {
                    scrollChatToBottom();
                }
            }
        }
    };
    let formData = new FormData(form);
    req.send(formData);
}, 500);

function scrollChatToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}
