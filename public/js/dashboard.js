const content = document.getElementById('content')
const links = document.querySelectorAll('.nav-item')

links.forEach(link => {
    link.addEventListener('click', () => {
        const page = link.dataset.page
        loadPage(page)
        setActive(link)
    })
})

function loadPage(page) {
    fetch(`/admin/content/${page}`)
        .then(res => res.text())
        .then(html => {
            content.innerHTML = html
            history.pushState({ page }, '', `#${page}`)
        })
} 

function setActive(activeLink) {
    links.forEach(l => l.classList.remove('active'))
    activeLink.classList.add('active')
}

window.addEventListener('DOMContentLoaded', (e) => {
    // e.preventDefault();
    const page = location.hash.replace('#', '') || 'home'
    const activeLink = Array.from(links).find(link => link.dataset.page === page) || links[0]
    setActive(activeLink)
    loadPage(page)
})
function logout(){
    
}
window.toggleBalanceForm = function(userId) {
    var elementId = 'form-balance-' + userId;
    var form = document.getElementById(elementId);
    
    if (form) {
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    } else {
        console.error("Could not find element with id: " + elementId);
    }
}
