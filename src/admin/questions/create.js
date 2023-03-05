const submit_btn = document.querySelector('#submit_btn');
const inputDoms = Array.from(document.querySelectorAll('.required'))
inputDoms.forEach(inputDom => {
    inputDom.addEventListener('input', () => {
    const isFilled = inputDoms.filter(d => d.value).length === inputDoms.length
    submit_btn.disabled = !isFilled
    })
})