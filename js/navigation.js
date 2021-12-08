/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
document.addEventListener('DOMContentLoaded',()=>{


	const siteNavigation = document.getElementById( 'site-navigation' );
	const buttonHamburger = document.getElementById( 'hamburger' );
	const navLinks = siteNavigation.querySelectorAll('li a');
	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	buttonHamburger.addEventListener( 'click', toggleMenu );

	/*Throttle for Scroll event*/
	let throttleTimer;
	const throttle = (callback, time) => {
	if (throttleTimer) return;
		throttleTimer = true;
		setTimeout(() => {
			callback();
			throttleTimer = false;
		}, time);
	}

	navLinks.forEach(link=>link.addEventListener('click',()=>{
		closeMenu();
	}))
	const headerwrap = document.querySelector('.site-header');

	var lastScrollTop = 0;

	document.addEventListener("scroll", ()=>{throttle(headerslide,250);});

	function headerslide(){
		let st = window.pageYOffset || document.documentElement.scrollTop;
		if ( st >= 100 && st <= 300) {
			headerwrap.classList.add("addFixed");
			headerwrap.classList.remove("slideInDown", "slideOut");
		} 
		else if( st > 300 && st <= 600){
			headerwrap.classList.add("slideOut");
			if( st<lastScrollTop){
				headerwrap.classList.remove("slideInDown");
			}
		}
		else if (st > 600 && st<lastScrollTop){
			headerwrap.classList.add("slideOut","slideInDown");
		}
		else if (st > 600 && st>lastScrollTop){
			headerwrap.classList.remove("slideInDown");
		}
		else {
			headerwrap.classList.remove("slideInDown","slideOut","addFixed");
		}
		lastScrollTop = st;
	}

	/*Contact Us Modal*/

	const newsletterModal = document.getElementById( 'pb_signup_container' );
	const newsletterToggle = document.getElementById('newsletter_trigger');
	const newsletterToggle2 = document.getElementById('newsletter_trigger-2');
	const closeNewsletter = document.getElementById('close-signup');
	newsletterToggle.addEventListener( 'click', toggleModal );
	if(newsletterToggle2){
		newsletterToggle2.addEventListener( 'click', toggleModal );
	}
	closeNewsletter.addEventListener( 'click', toggleModal );


	function toggleMenu(){
		siteNavigation.classList.toggle( 'toggled' );
		buttonHamburger.classList.toggle('is-active');
		document.documentElement.classList.toggle('scroll_lock');
		if ( buttonHamburger.getAttribute( 'aria-expanded' ) === 'true' ) {
			buttonHamburger.setAttribute( 'aria-expanded', 'false' );
		} else {
			buttonHamburger.setAttribute( 'aria-expanded', 'true' );
		}
	}

	function closeMenu(){
		siteNavigation.classList.remove( 'toggled' );
		buttonHamburger.classList.remove('is-active');
		buttonHamburger.setAttribute( 'aria-expanded', 'false' );
		document.documentElement.classList.remove('scroll_lock');
	}

	function toggleModal(e){
		//closeMenu();
		newsletterModal.classList.toggle( 'toggled' );
		document.documentElement.classList.toggle('scrolly_lock');
		document.body.classList.toggle('scroll_lock');
		e.currentTarget.classList.toggle('active');
		if ( e.currentTarget.getAttribute( 'aria-expanded' ) === 'true' ) {
			e.currentTarget.setAttribute( 'aria-expanded', 'false' );
		} else {
			e.currentTarget.setAttribute( 'aria-expanded', 'true' );
		}
	}


});