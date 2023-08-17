document.addEventListener('DOMContentLoaded', function () {
    let cut = document.getElementById('cut');
    let copy = document.getElementById('copy');
    let link = document.getElementById('link');
    let short_link = document.getElementById('short_link');

    link.oninput = function () {
        if (link.value === '') {
            cut.setAttribute('disabled', 'disabled');
            cut.style.backgroundColor = '#b0bdd633';
        } else {
            cut.removeAttribute('disabled');
            cut.style.backgroundColor = '#ffdd57';
        }
    }

    cut.onclick = function () {
        return link.value !== '';
    }
})
