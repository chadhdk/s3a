(function(){
    const blocks = document.querySelectorAll('.block');
    document.addEventListener('DOMContentLoaded',()=>{
        if(window.scrollY>100){
            blocks.forEach(block=>block.classList.add('slide-active'));
        }
    })
    
    const mediaQuery = window.matchMedia("(prefers-reduced-motion: reduce)");
    const confetti = document.querySelector('.page.home');
    let isConfettiShowing = false;
    let observer = new IntersectionObserver((entries,observer)=>{
        entries.forEach(entry=>{
            if(entry.intersectionRatio>0.7){
                entry.target.classList.add('triggered')
            }
            else if(entry.intersectionRatio>0.2){
                entry.target.classList.add('visible','slide-active');
                entry.target.classList.remove('triggered');
            }
            else if(entry.intersectionRatio>=0){
                entry.target.classList.remove('visible');
                entry.target.classList.remove('triggered');
                    if(isConfettiShowing == true){
                        document.removeEventListener("scroll", confettiPosition);
                        isConfettiShowing = false;
                    }
            }
            
        });
    }, {rootMargin:"0% 0% 25% 0%",threshold: [0,0.25,0.5,0.75,1]});
    blocks.forEach(block=>{observer.observe(block)});


    
	// Check if the media query matches or is not available.

	function confettiPosition(){
		const scrollAmount = window.pageYOffset || document.documentElement.scrollTop;
		const totalHeight =document.body.scrollHeight;
		const ratio = scrollAmount/totalHeight;
		confetti.style.backgroundPosition = `50% ${50 - ratio*5}%, 50% ${50 + ratio*10}%, 50% ${50 + ratio*15}%`;
	}

}());