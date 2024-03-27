const inputs = document.getElementsByTagName("input")
function switchColorBlur(e){
    for (elem of inputs){
        const target = e.target;
        if(target.value.trim() === ""){
            target.style.borderColor = "red";
        } else {
            target.style.borderColor = "green";
        } 
    }
}

for(elem of inputs){
    elem.addEventListener("blur", switchColorBlur);
}