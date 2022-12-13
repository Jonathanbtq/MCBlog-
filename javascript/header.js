const headerFlc = document.querySelector('.derou_header');
const deroulFlc = document.querySelector('.derou_div_header');

console.log(headerFlc);

headerFlc.addEventListener('click', function(){
    deroulFlc.classList.toggle('derou_div_header_flex');
})