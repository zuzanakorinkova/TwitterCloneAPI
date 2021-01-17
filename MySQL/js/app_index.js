async function post(){
    var form = new FormData()
    var sPost = event.target.querySelector("[contenteditable]").innerHTML
    form.append("post", sPost)
    var connection = await fetch('../../api/api-post.php',{method:"POST", body: form})
    let ajData = await connection.json()
    let userData = ajData['user_data']

    userData.forEach(jItem => {
    divPost = `
    <div class="s_post">
    <div>
        <img id="userImage" height="40vh" src="../../assets/${jItem[2]}" alt="">
    </div>
      <div id="user_post">
        <div class="user-information">
             <a href=""><b>${jItem[0]} ${jItem[1]}</b></a>
            <span>just now</span>
         </div> 
        <div class="post">
            <p>${sPost}</p>
         </div>
        <div id="icons">
          <div> <button onclick="likePost()" class="like"><svg width="1.5rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.29 26.34"><defs><style></style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g class="cls-1"><path class="cls-2" d="M24.61,1C21.1-.47,17.45.8,15.14,4.15,12.83.8,9.17-.44,5.67,1,2.39,2.34-.57,6.22.66,11.61c1.12,4.85,5,8.51,8,10.71A30,30,0,0,0,15,25.93s.08,0,.16,0,.11,0,.15,0a33.6,33.6,0,0,0,6.35-3.61c3-2.2,6.85-5.86,8-10.74C30.84,6.19,27.88,2.3,24.61,1Z"/></g></g></g></svg> <span style="opacity: 0.5; font-size: 0.7rem;">0</span></button> </div>
        </div>
      </div>
    </div>
    `
    // document.querySelector("#own_post").style.display = "grid"
    document.querySelector("#s_home_2").insertAdjacentHTML('afterbegin', divPost)
    })
  }


async function likePost(){
  event.target.querySelector('path').style.fill = '#d100e9'
  let likes = event.target.nextElementSibling.innerText 
  console.log(likes)
    likes++
    event.target.nextElementSibling.innerText = likes //RESET THE LIKES
    let form = new FormData()
    let postId = document.querySelector('.s_post')
    form.append("id", postId.id)
    let connection = await fetch('../../api/api-like-post.php', {method: "POST", body: form})
    if(connection.ok){
      event.target.disabled = true
    }
    let jResponse = connection.json()
    console.log(jResponse)
  
 
}



function deleteModal(){

    var modalDelete = document.getElementById('deleteModal')
    modalDelete.style.display = "grid"
  
    var closeDelete = document.getElementById('closeDeleteModal')
  closeDelete.onclick = function(){
    modalDelete.style.display = "none"
  }
  window.onclick = function(event) {
    if (event.target == modalDelete) {
      modalDelete.style.display = "none";
    }
  }  
    return;
  }
  

async function deletePost() {
  let divPost = document.querySelector('.s_post')
  let form = new FormData()
  form.append("id", divPost.id)
  let connection = await fetch("../../api/api-delete-post.php", {method : "POST", body : form})   
  let jResponse = await connection.json()
  // console.log(jResponse)
  var modalDelete = document.getElementById('deleteModal')
    if(connection.status == "200"){
        divPost.remove() 
        modalDelete.style.display = "none"
        location.reload()
        return
    }
}

function updateModal(){
  var modalUpdate = document.getElementById('updateModal')
  modalUpdate.style.display = "grid"
  var closeUpdate = document.getElementById('closeUpdateModal')
  closeUpdate.onclick = function(){
    modalUpdate.style.display = "none"
}
  window.onclick = function(event) {
  if (event.target == modalUpdate) {
    modalUpdate.style.display = "none";
  }
}
}

async function updateUser(){
  var form = event.target
  var connection = await fetch("../../api/api-update-user.php", {method: "POST", body: new FormData(form)})
  let jResponse = await connection.json()
  console.log(jResponse)
  if(connection.status == "200"){
    var modalUpdate = document.getElementById('updateModal')
    modalUpdate.style.display = "none"
    location.reload()
    return
  }
}


function showSearchResults(){
  document.querySelector('#searchResults').style.display = 'grid'
}
function hideSearchResults(){
  document.querySelector('#searchResults').style.display = 'none'
}
 async function startSearch(){
  //check that the input has data, dont run if it does not have any data
  if(document.querySelector('#searchText').value.length < 1){
      return
  }
  //  console.log(document.querySelector('#searchText').value)

  let sSearchFor = document.querySelector('#searchText').value
  let connection = await fetch('../../api/api-search-user.php?userProfileName='+sSearchFor)
if(!connection.ok){}
let ajData = await connection.json()
// console.log(ajData)
document.querySelector('#searchResults').innerHTML = " "

ajData.forEach(jItem => {
  let sResultDiv = `
  <a href="../../middle_user.php" style="text-decoration: none; color: black; display: grid; grid-template-columns: 0.2fr 1fr; align-items: center; gap: 1rem; margin-top: 0.5rem;" class="result" id="${jItem[0]}">
  <img id="userImage" height="50vh" src="../../assets/${jItem[4]}" alt=""> 
    <div>
      <div> <b>${jItem[1]}</b> <b>${jItem[2]}</b></div>
      <div> <span style="opacity: 0.5; font-size: 15px;">${jItem[3]}</span> </div>
   </div> 
  </a>
  `
  document.querySelector('#searchResults').insertAdjacentHTML('afterbegin', sResultDiv)
})

}

async function follow(){
  // console.log(event.target.parentNode.id)
  var userId = event.target.parentNode.id
  if(event.target.innerHTML = "Follow"){
    event.target.innerHTML = "Following"
    event.target.style.backgroundColor = "#ec8434"
    event.target.style.color = "#ffffff"

    var connection = await fetch("../../api/api-follow-user.php/api-follow-user.php?followUserId="+userId)
    let jResponse = await connection.json()
    console.log(jResponse)
    if(connection.status == "200"){}

  }else{
    event.target.innerHTML = "Follow"
  } 
}