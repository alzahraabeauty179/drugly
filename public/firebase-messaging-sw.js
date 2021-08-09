importScripts("https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.7.1/firebase-messaging.js");


// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
var firebaseConfig = {
    apiKey: "AIzaSyC0ikwpxt9iSASEtG3MC-ShcaHajoG7Cno",
    authDomain: "drugly-36099.firebaseapp.com",
    projectId: "drugly-36099",
    storageBucket: "drugly-36099.appspot.com",
    messagingSenderId: "680734245586",
    appId: "1:680734245586:web:2b4020b3663fdc281d630b",
    measurementId: "G-XE5K3HWJJY"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler( function(payload) {
	const title = "Drugly";
	const options = {
		body: payload.data.status
	};
	return self.registration.showNotification(title, options);
});
