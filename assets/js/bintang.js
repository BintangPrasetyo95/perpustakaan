$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Pilih satu atau lebih'
    });
});

console.log('Script is running!');
let preloader = document.querySelector('#preloader');
console.log('Preloader:', preloader);
if (preloader) {
  document.addEventListener('DOMContentLoaded', () => {
    preloader.remove();
  });
}

// Use document.querySelector instead of select
let backtotop = document.querySelector('.back-to-top');

if (backtotop) {
    const toggleBacktotop = () => {
        if (window.scrollY > 100) {
            backtotop.classList.add('active');
        } else {
            backtotop.classList.remove('active');
        }
    };

    // Use window.onload instead of window.load
    window.onload = toggleBacktotop;

    // Use standard addEventListener for the scroll event
    window.addEventListener('scroll', toggleBacktotop);
}

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})