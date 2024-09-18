document.querySelectorAll('.txtOnly').forEach(function (element) {
    element.addEventListener('keypress', function (e) {
        var regex = /^[a-zA-Z\s]+$/;
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (!regex.test(str)) {
            e.preventDefault();
            return false;
        }
        return true;
    });
});

document.querySelectorAll('.NumOnly').forEach(function (element) {
    element.addEventListener('keyup', function (event) {
        this.value = this.value.replace(/[^\d]+/, '');
        if (event.which < 48 || event.which > 57) {
            event.preventDefault();
        }
    });
});


document.querySelectorAll('.txtNum').forEach(function (element) {
    element.addEventListener('keypress', function (e) {
        var regex = /^[a-zA-Z0-9\s]+$/;
        var str = String.fromCharCode(e.charCode || e.which);
        if (!regex.test(str)) {
            e.preventDefault();
        }
    });
});

document.querySelectorAll('.special-char').forEach(function (element) {
    element.addEventListener('keyup', function () {
        var yourInput = this.value;
        var re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        
        if (isSplChar) {
            var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            this.value = no_spl_char;
        }
    });
});



document.querySelectorAll('.price-field').forEach(function (element) {
    element.addEventListener('keyup', function () {
        var val = this.value;
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.]/g, '');
            if (val.split('.').length > 2) {
                val = val.replace(/\.+$/, ""); 
            }
        }
        this.value = val;
    });
});
