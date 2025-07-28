//---------------------------------------generic------------------------------------------------
const tabs = document.querySelectorAll(".tab-btn");
const contents = document.querySelectorAll(".contenuto");

function showTab(tabName) {
    contents.forEach(c => c.classList.add("hidden"));
    document.querySelector(`[data-content="${tabName}"]`).classList.remove("hidden");

    tabs.forEach(t => {
    t.classList.remove("bg-orange-400", "text-white", "font-semibold");
    t.classList.add("bg-white", "text-gray-700");
    });

    const activeTab = document.querySelector(`[data-tab="${tabName}"]`);
    activeTab.classList.remove("bg-white", "text-gray-700");
    activeTab.classList.add("bg-orange-400", "text-white", "font-semibold");
}

// Inizializzazione: mostra la prima tab
showTab("physiological");

tabs.forEach(tab => {
    tab.addEventListener("click", () => {
    const tabName = tab.getAttribute("data-tab");
    showTab(tabName);
    });
});


// ----------------------------------next pathological history----------------------------------
const type = document.getElementById('type');
type.addEventListener('change', function() {
    if (this.value === 'ALTRO') {
        document.getElementById('problem').classList.replace('hidden', 'block');
        document.getElementById('problem-label').classList.replace('hidden', 'block');
        document.getElementById('problem').required = true; // Mark the input as required
    } else {
        document.getElementById('problem').classList.replace('block', 'hidden');
        document.getElementById('problem-label').classList.replace('block', 'hidden');
        document.getElementById('problem').value = ''; // Clear the input if not needed
        document.getElementById('problem').required = false; // Mark the input as not required
    }
});