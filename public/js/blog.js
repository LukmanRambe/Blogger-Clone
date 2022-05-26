// #### NAVBAR ####
const navSearchBarInput = document.querySelector('.search-bar input')
const navSearchBarBtn = document.querySelector('.search-bar button')

if (!window.location.href.match(/posts/)) {
	navSearchBarInput.style.display = 'none'
	navSearchBarBtn.style.display = 'none'
}

const logoutBtn = document.querySelector('#logoutBtn')

if (window.location.href.match(/online/)) {
	logoutBtn.style.display = 'none'
}

// #### SIDEBAR LINKS ####
const sidebarLinks = document.querySelectorAll('.sidebar-links a')
const href = window.location.href

sidebarLinks.forEach(link => {
	if (href.includes(link.href)) {
		link.classList.add('active')
	}
})

// #### BOOTSTRAP TOOLTIPS ####
const tooltipTriggerList = [].slice.call(
	document.querySelectorAll('[data-bs-toggle="tooltip"]')
)

const tooltipList = tooltipTriggerList.map(tooltipTriggerEl => {
	return new bootstrap.Tooltip(tooltipTriggerEl)
})
