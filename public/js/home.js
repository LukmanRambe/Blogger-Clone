// #### FOOTER COPYRIGHT ####
const year = new Date().getFullYear()
const copyright = document.querySelector('.footer-copyright')

copyright.innerHTML = `Copyright &#169; ${year} Blogger`

// #### BACK TO TOP ####
const backToTop = document.querySelector('.back-to-top')

window.addEventListener('scroll', () => {
	const scrollHeight = window.pageYOffset

	if (scrollHeight < 500) {
		backToTop.style.display = 'none'
	} else if (scrollHeight > 500) {
		backToTop.style.display = 'block'
	}
})

backToTop.addEventListener('click', () => {
	scrollTo({
		top: 0,
		left: 0
	})
})
