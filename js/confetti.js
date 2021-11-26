(function(){
	const mediaQuery = window.matchMedia("(prefers-reduced-motion: reduce)");
	// Check if the media query matches or is not available.
	const confetti = document.querySelector('.page.home');
	if (!mediaQuery.matches) {
		
		document.addEventListener("scroll", confettiPosition);
	} 
	function confettiPosition(){
		const scrollAmount = window.pageYOffset || document.documentElement.scrollTop;
		const totalHeight =document.body.scrollHeight;
		const ratio = scrollAmount/totalHeight;
		confetti.style.backgroundPosition = `50% ${50 - ratio*25}%, 50% ${50 + ratio*50}%, 50% ${50 + ratio*75}%`;
	}
}());
