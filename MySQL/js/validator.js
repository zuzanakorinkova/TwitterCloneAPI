
function validateSignup(){
    var form = event.target
    var aElements = form.querySelectorAll("[data-type]")
    for(var i = 0; i < aElements.length; i++){
        var sDataType = aElements[i].getAttribute("data-type")
        switch(sDataType){
            case "string":
                isStringValid(aElements[i])
            break
            case "email":
                isEmailValid(aElements[i])
            break
        }
    }
    // console.log(aElements)
    var aElements = form.querySelectorAll("[data-match='password']")
    var labelPassword = document.querySelector('#labelConfirmPassword')
    // console.log(aElements[0].value)
    if(aElements.length){
    if(aElements[0].value != aElements[1].value){
        labelPassword.style.display = "grid"
    }
}

}
function isStringValid(oElement){
    var iMin = oElement.getAttribute("data-min")
    var iMax = oElement.getAttribute("data-max")
    var labelFirst = document.querySelector("#labelFirst")
    var labelLast = document.querySelector("#labelLast")
    var labelPass = document.querySelector("#labelPass")
    var labelCountry = document.querySelector("#labelCountry")

    if(oElement.value.length < iMin){
        labelFirst.style.display = "grid"
        labelLast.style.display = "grid"
        labelPass.style.display = "grid"
        labelCountry.style.display = "grid"
    }
    if(oElement.value.length > iMax){
        labelFirst.style.display = "grid"
        labelLast.style.display = "grid"
        labelPass.style.display = "grid"
        labelCountry.style.display = "grid"
    }
}

function isEmailValid(oElement){
    var labelEmail = document.querySelector("#labelEmail")
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(!re.test(String(oElement.value).toLowerCase())){
          labelEmail.style.display = "grid"
      }
    
}

function validateLogin(){
    var form = event.target
    var aElements = form.querySelectorAll("[data-type]")
    for(var i = 0; i < aElements.length; i++){
        var sDataType = aElements[i].getAttribute("data-type")
        switch(sDataType){
            case "string":
                isLoginStringValid(aElements[i])
            break
            case "email":
                isLoginEmailValid(aElements[i])
            break
        }
     }
}
function isLoginStringValid(oElement){
    var iMin = oElement.getAttribute("data-min")
    var iMax = oElement.getAttribute("data-max")
    var labelPass = document.querySelector("#labelPass")

    if(oElement.value.length < iMin){
        labelPass.style.display = "grid"
    }
    if(oElement.value.length > iMax){
        labelPass.style.display = "grid"
    }
}

function isLoginEmailValid(oElement){
    var labelEmail = document.querySelector("#labelEmail")
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(!re.test(String(oElement.value).toLowerCase())){
          labelEmail.style.display = "grid"
      }
    
}


