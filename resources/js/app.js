require('./bootstrap');
import {isPrivateMode} from './packages/is-private';

if(document.getElementById("window_dimensions")) {
    document.getElementById("window_dimensions").innerHTML = window.innerWidth + ' x ' + window.innerHeight;
}

setTimeout(function () {
    isPrivateMode().then(function (isPrivate) {
        if(document.getElementById("is_incognito")) {
            document.getElementById("is_incognito").innerHTML = isPrivate.toString();
        }
    });
}, 100);