importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyBYAhtmrB5qPnwpCkfUy3h0cLMo0eBRCZk",
    authDomain: "shopkart-997fe.firebaseapp.com",
    projectId: "shopkart-997fe",
    storageBucket: "shopkart-997fe.firebasestorage.app",
    messagingSenderId: "643889723942",
    appId: "1:643889723942:web:a083c43a0137d52d9204e7",
    measurementId: "G-B2TE5X0PJ1"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    return self.registration.showNotification(payload.data.title, {
        body: payload.data.body ? payload.data.body : '',
        icon: payload.data.icon ? payload.data.icon : ''
    });
});