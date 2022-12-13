const mapContent=document.querySelector('.btn_post_img_hover');
const mapContentb=document.querySelector('.btn_post_img');

const contentDiv = document.querySelector('.prem_post_add');
const imagesDiv = document.querySelector('.postadd_img_div');

    mapContent.addEventListener('click', function() {
        if(mapContent.className == "btn_post_img"){
            mapContent.className = "btn_post_img_hover";
            mapContentb.className = "btn_post_img";

            contentDiv.style.display = "block";
            imagesDiv.style.display = "none";
        }else{
            mapContentb.className = "btn_post_img";

            imagesDiv.style.display = "none";
        }
    });
    mapContentb.addEventListener('click', function() {
        if(mapContentb.className == "btn_post_img"){
            mapContentb.className = "btn_post_img_hover";
            mapContent.className = "btn_post_img";

            imagesDiv.style.display = "block"
            contentDiv.style.display = "none"
        }else{
            mapContent.className = "btn_post_img";

            imagesDiv.style.display = "block"
        }
    });


const uploadedImageDiv = document.getElementById("uploadedImage");
const fileUpload = document.getElementById("fileUpload");
const petiteImg = document.querySelector(".container_upl_imgpostadd");
fileUpload.addEventListener("change", getImage, false);
newImgcount = 0;

function getImage() {
    const imageToProcess = this.files[0];

    let newImg = new Image(imageToProcess.width, imageToProcess.height);
    newImg.src = URL.createObjectURL(imageToProcess);

    let newImgB = new Image(imageToProcess.width, imageToProcess.height);
    newImgB.src = URL.createObjectURL(imageToProcess);

    uploadedImageDiv.appendChild(newImg);
    petiteImg.appendChild(newImgB);
    newImg.classList.add("img_addpost_newimg");
    newImgB.classList.add("img_addpost_newimgB");
    newImgB.setAttribute("name", "imageadd");
    newImgB.setAttribute("type", "file");
    newImgcount++;

    if(newImgcount <= 1){
        newInput = document.createElement("input");
        newInput.value = newImg;
        newInput.name = "primaryImg";
        newInput.type = "hidden";
        petiteImg.appendChild(newInput);
    }else {
        newInput = document.createElement("input");
        newInput.value = newImg;
        newInput.name = "imageadd";
        newInput.type = "hidden";
        petiteImg.appendChild(newInput);
    }
    
    
    const primaryimg = document.querySelector('.img_addpost_newimgB');
    primaryimg.classList.add("primaryImg");
    primaryimg.setAttribute("name", "primaryImg");

    if(newImgcount > 1) {
        let imgnewp = document.querySelector('.img_addpost_newimg');
        imgnewp.remove();
    }
    if(newImg){
        const box_input = document.querySelector('.box_input_postadd');
        box_input.style.display ="none";
    }
}

/*---Faire apparaitre le input----*/


const btn_input = document.querySelector('.btn_hidden_input_postadd');
const box_input = document.querySelector('.box_input_postadd');
box_input.style.display = "none";

btn_input.addEventListener('click', function() {
    box_input.style.display = "block";
})

const btn_map = document.querySelector('.btn_post_img_hover');
const btn_img = document.querySelector('.btn_post_img');

btn_map.addEventListener('click', function() {
    box_input.style.display = "block";
})

btn_img.addEventListener('click', function() {
    box_input.style.display = "none";
})
