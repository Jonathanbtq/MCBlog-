const textDiv = document.querySelector('.text_div');
const btn_div = document.querySelector('.btn_text');
const btn_div_txt = document.querySelector('.desc_div_profil');

function masquer_div(){
    if(textDiv.style.display == 'none') {
        textDiv.style.display = 'block';
        btn_div_txt.style.display = 'none';
    }else {
        textDiv.style.display = 'none';
        btn_div_txt.style.display = 'block';
    }

    if(btn_div.style.display == 'none') {
        btn_div.style.display = 'block';
    }else {
        btn_div.style.display = 'none';
    }
};

const btn_avatar = document.querySelector('.btn_pdp');
const btn_img = document.querySelector('.img_session');

function masquer_img(){

    if(btn_avatar.style.display == 'none'){
        btn_avatar.style.display = 'block';
    }else{
        btn_avatar.style.display = 'none';
    }
};