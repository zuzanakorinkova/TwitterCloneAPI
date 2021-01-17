async function signup(){
    var form = event.target
    var connection = await fetch("../api/api-signup.php", {method: "POST", body: new FormData(form)})
    
        if(connection.status == 200){
            location.href = "../page_index/home/index.php"
        }else if(connection.status == 400){
            console.log('missing credentials')
        } else{ 
            alert('contact system admin') //code DIV!!
        }   
    }
    
async function login(){
    var connection = await fetch("../api/api-login.php", {method: "POST", body: new FormData(event.target)})
    if(connection.status == 200){
        location.href = "../page_index/home/index.php"
    }else if(connection.status == 400){
        console.log('cannot login')
    } else{ 
        alert('contact system admin') 
    }
}





 