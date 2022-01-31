(function(){
    const swiperHero = document.querySelector('.swiper-hero');
    const swiperCarousel = document.querySelectorAll('.carousel');
    if(swiperHero){
        const swiper = new Swiper('.swiper-hero', {
            loop: true,
            effect:'fade',
            pagination: {
            el: '.swiper-pagination',
            clickable:true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 5000,
            }
        });
    }
    if(swiperCarousel.length>0){
        swiperCarousel.forEach(carousel=>{
            let options= { 
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                simulateTouch:true,
                centeredSlides:true,
                slidesPerView: 1,
                spaceBetween:16,
            }
            if(!carousel.classList.contains('carousel--one_up')){
                options.breakpoints ={
                    700:{
                        slidesPerView:2
                    },
                    1000:{
                        slidesPerView:3
                    },
                    1200:{
                        slidesPerView:3,
                        spaceBetween:24,
                    }
                }
            }
            const carouselInstance = new Swiper(carousel,options);
        })
    }
}());

