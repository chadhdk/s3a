(function(){
    const container = document.getElementById('response');
    const filters = document.querySelectorAll('.filter');
    filters.forEach(button=>{
        button.addEventListener('click',filterArticles);
    })

    function filterArticles(e){
        e.preventDefault();
        const filter = e.currentTarget;
        const term =filter.dataset.id;
        filters.forEach((link)=>link.classList.remove('active'));
        container.classList.add('loading');
        if (term!='reset'){
            filter.classList.add('active');
        }
        fetch(`/wp-json/confetti/v1/filter?taxonomy=${term}`)
            .then(response=>response.json())
            .then(data => changeResponse(data))
            .catch(error=>{
                console.log(error);
                container.classList.remove('loading');
            });
    }
    function changeResponse(data){
        container.innerHTML = data;
        location.hash = '#response';
        container.classList.remove('loading');
        location.hash = '';
    }


    

}());