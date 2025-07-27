// Salva lo scroll prima di lasciare la pagina
window.addEventListener("beforeunload", function () {
    sessionStorage.setItem("scrollPos", window.scrollY);
});

// Reimposta lo scroll dopo il reload
window.addEventListener("load", function () {
    const scrollPos = sessionStorage.getItem("scrollPos");
    if (scrollPos) window.scrollTo(0, parseInt(scrollPos));
});
