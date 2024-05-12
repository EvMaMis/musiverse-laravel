document.querySelectorAll('div.btn-try').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault()


        const scrollTarget = document.querySelector('div.btn-start')

        const  topOffset = 0
        const elementPosition = scrollTarget.getBoundingClientRect().top
        console.log(elementPosition)
        const offSetPosition = elementPosition - topOffset - 400

        window.scrollBy({
            top: offSetPosition,
            behavior: 'smooth',
        })
    })
})
