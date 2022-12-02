import { Tooltip } from 'bootstrap';

function enableTooltip() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new Tooltip(tooltipTriggerEl)
    })
}


document.addEventListener("DOMContentLoaded", () => {
    enableTooltip()
});