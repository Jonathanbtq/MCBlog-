const general = document.querySelector('.chat_container_main');
const creatif = document.querySelector('.chat_container_main_crea');
const survie = document.querySelector('.chat_container_main_surv');
const mods = document.querySelector('.chat_container_main_mods');

function chat_onglet(){
    if(general.style.display == 'block'){
        general.style.display = 'block';
        creatif.style.display = 'none';
        survie.style.display = 'none';
        mods.style.display = 'none';
    }else{
        general.style.display = 'block';
        creatif.style.display = 'none';
        survie.style.display = 'none';
        mods.style.display = 'none';
    }
}
function chat_creatif_onglet(){
    if(creatif.style.display == 'block'){
        general.style.display = 'none';
        creatif.style.display = 'block';
        survie.style.display = 'none';
        mods.style.display = 'none';
    }else{
        creatif.style.display = 'block';
        general.style.display = 'none';
        survie.style.display = 'none';
        mods.style.display = 'none';
    }
}
function chat_survie_onglet(){
    if(survie.style.display == 'block'){
        general.style.display = 'none';
        creatif.style.display = 'none';
        survie.style.display = 'block';
        mods.style.display = 'none';
    }else{
        survie.style.display = 'block';
        general.style.display = 'none';
        creatif.style.display = 'none';
        mods.style.display = 'none';
    }
}
function chat_mods_onglet(){
    if(mods.style.display == 'block'){
        general.style.display = 'none';
        creatif.style.display = 'none';
        survie.style.display = 'none';
        mods.style.display = 'block';
    }else{
        mods.style.display = 'block';
        general.style.display = 'none';
        creatif.style.display = 'none';
        survie.style.display = 'none';
    }
}