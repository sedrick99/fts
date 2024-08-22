

let isSubOptionsVisible = false;

function toggleSubOptions() {
    const subOptions = document.getElementById("subOptions");
    isSubOptionsVisible = !isSubOptionsVisible;
    subOptions.style.display = isSubOptionsVisible ? 'block' : 'none';
}

