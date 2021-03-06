require('./bootstrap');
require('./packages/modernizr');
import {isPrivateMode} from './packages/is-private';
import 'alpinejs';
import htmlToImage from 'html-to-image';
import download from 'downloadjs';

if (document.getElementById("window_dimensions")) {
    document.getElementById("window_dimensions").innerHTML = window.innerWidth + ' x ' + window.innerHeight;
}

setTimeout(function () {
    isPrivateMode().then(function (isPrivate) {
        if (document.getElementById("is_incognito")) {
            document.getElementById("is_incognito").innerHTML = isPrivate.toString();
        }
    });
}, 100);

window.sendEmail = function () {
    const node = document.getElementById('data').innerText;
    let mailToLink = "mailto:?body=" + encodeURIComponent(node);
    window.open(mailToLink, '_blank');
}

window.copyClipboard = function () {
    const navLinks = document.getElementById("nav-links");
    navLinks.style.display = "none";
    const textToCopy = document.getElementById("data").innerText;
    const myTemporaryInputElement = document.createElement("textarea");
    navLinks.style.display = "block";
    myTemporaryInputElement.value = textToCopy;
    document.body.appendChild(myTemporaryInputElement);
    myTemporaryInputElement.select();
    document.execCommand("Copy");
    document.body.removeChild(myTemporaryInputElement);
}

window.saveImage = function () {
    const node = document.getElementById('data');
    htmlToImage.toPng(node)
        .then(function (dataUrl) {
            let date = new Date();
            download(dataUrl, 'browser_is-'+date.toUTCString()+'.png');
        })
        .catch(function (error) {
            console.error('oops, something went wrong!', error);
        });
}