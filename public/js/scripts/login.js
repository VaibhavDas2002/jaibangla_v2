document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('mobile_no').addEventListener('keyup', function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });

    document.getElementById('login_otp').addEventListener('keyup', function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });

    window.onload = function () {
        document.getElementById('captcha').setAttribute('autocomplete', 'off');
        document.getElementById('login_otp').setAttribute('autocomplete', 'off');
    };
});

const checkbox = document.getElementById('checkbox');

checkbox.addEventListener('change', () => {
    document.body.classList.toggle('dark');
});

const getCookie = (name) => {
    return localStorage.getItem(name);
};

const setFontSize = (fontType) => {
    let fontSize = getCookie("fontSize");

    if (fontSize !== null) {
        fontSize = parseInt(fontSize, 10);
        document.body.style.fontSize = fontSize + "px";
        document.querySelectorAll('a, p, input[type=text]').forEach(el => {
            el.style.fontSize = fontSize + "px";
        });
    } else {
        const fs = window.getComputedStyle(document.body).fontSize;
        fontSize = parseInt(fs, 10);
        document.body.style.fontSize = fs;
        document.querySelectorAll('a, p, input[type=text]').forEach(el => {
            el.style.fontSize = fs;
        });
    }

    if (fontType === 'increase') {
        if (fontSize < 20) {
            fontSize += 2;
        }
    } else if (fontType === 'decrease') {
        if (fontSize > 10) {
            fontSize -= 2;
        }
    } else {
        fontSize = 14;
        localStorage.clear();
    }

    localStorage.setItem('fontSize', fontSize);
    document.body.style.fontSize = fontSize + "px";
    document.querySelectorAll('a, p, input[type=text]').forEach(el => {
        el.style.fontSize = fontSize + "px";
    });
};

document.getElementById('largerTextLink').addEventListener('click', function () {
    setFontSize('increase');
});

document.getElementById('resetFont').addEventListener('click', function () {
    setFontSize();
    localStorage.clear();
});

document.getElementById('smallerTextLink').addEventListener('click', function () {
    setFontSize('decrease');
});