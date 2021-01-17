            <div class="modal" id="deleteModal">
               <div class="modal-content">
                  <span class="close" id="closeDeleteModal" onclick="closeModal();"><svg width="1.3rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.47 34.47"><defs><style>.cls-1{opacity:0.5;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g class="cls-1"><g id="a"><path d="M34.26,1.12a.59.59,0,0,0,.21-.46.62.62,0,0,0-.21-.47A.58.58,0,0,0,33.81,0a.65.65,0,0,0-.48.19L17.23,16.3,1.12.19A.6.6,0,0,0,.66,0,.65.65,0,0,0,0,.66a.6.6,0,0,0,.19.46L16.3,17.23.19,33.33a.65.65,0,0,0-.19.48.58.58,0,0,0,.19.45.62.62,0,0,0,.47.21.59.59,0,0,0,.46-.21L17.23,18.17l16.1,16.09a.63.63,0,0,0,.48.21.73.73,0,0,0,.66-.66.63.63,0,0,0-.21-.48L18.17,17.23Z"/></g></g></g></g></svg></span>
                  <p>Are you sure you want to delete this post?</p>
                  <button onclick="deletePost()">Delete</button>
               </div>
            </div>
      <?php
      require_once(__DIR__.'/../../private/db.php');
      $query = $db->prepare('SELECT * FROM users WHERE users.iUserId = :userId');
      $query->bindValue(':userId', $_SESSION['userId']);
      $query->execute();
      $rows = $query->fetchAll();

      foreach($rows as $row){
      ?>
            <div class="modal" id="updateModal">
               <div class="modal-content">
                  <span class="close" id="closeUpdateModal" onclick="closeModal();"><svg width="1.3rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.47 34.47"><defs><style>.cls-1{opacity:0.5;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g class="cls-1"><g id="a"><path d="M34.26,1.12a.59.59,0,0,0,.21-.46.62.62,0,0,0-.21-.47A.58.58,0,0,0,33.81,0a.65.65,0,0,0-.48.19L17.23,16.3,1.12.19A.6.6,0,0,0,.66,0,.65.65,0,0,0,0,.66a.6.6,0,0,0,.19.46L16.3,17.23.19,33.33a.65.65,0,0,0-.19.48.58.58,0,0,0,.19.45.62.62,0,0,0,.47.21.59.59,0,0,0,.46-.21L17.23,18.17l16.1,16.09a.63.63,0,0,0,.48.21.73.73,0,0,0,.66-.66.63.63,0,0,0-.21-.48L18.17,17.23Z"/></g></g></g></g></svg></span>
                  <form id="updateUser" onsubmit="updateUser(); return false">
                     <div id="updateProfileName">
                        <input type="text" name="name" placeholder="Name" value="<?=$row[1]?>">
                        <input type="text" name="lastName" placeholder="Last name" value="<?=$row[2]?>">
                     </div> 
                     <div><input type="text" name="email" placeholder="Email" value="<?=$row[3]?>"></div>
                     <div><input type="text" name="country" placeholder="Country" value="<?=$row[5]?>"></div>  
                     <button>edit</button>
                  </form>
               </div>
            </div>

<div id="s1">
               <div id="s_profile_1">
                
                     <div id="sub_profile_1">
                        <img width="75rem" src="../../assets/<?=$row[6]?>" alt="">
                        <p>
                           <b><?=$row[1].' '.$row[2]?></b>
                           <span><?=$row[3]?></span>
                        </p>
                     </div>
                     <div id="sub_profile_2">
                        <b>Posts</b>
                        <p><?=$row[8]?></p>
                     </div>
                  
                        <div id="sub_profile_3">
                           <b>Following</b>
                           <p><?=$row[7]?></p>
                        </div>
                     <?php
                        }
                     ?>
                        <div id="sub_profile_4">
                           <button onclick="updateModal()">edit</button>
                        </div>    
            </div>
            <div id="s_profile_2">
                     <?php
                        require_once(__DIR__.'/../function-time.php');
                        $query = $db->prepare('SELECT users.iUserId, users.sName, users.sLastName, users.sAvatarUrl, posts.* FROM users JOIN posts ON posts.iUserFk = users.iUserId 
                        WHERE users.iUserId = :userId ORDER BY posts.iPostId DESC LIMIT 10');
                        $query->bindValue(':userId', $_SESSION['userId']);
                        $query->execute();
                        $aRows = $query->fetchAll();

                        foreach($aRows as $aRow){
                           ?>
                     <div class="s_post" id="<?=$aRow[4]?>">
                        <div>
                           <img height="40vh" src="../../assets/<?=$aRow[3]?>" alt="">
                        </div>
                        <div class="user_post">
                           <div class="user-information">
                              <a href=""><b><?=$aRow[1].' '.$aRow[2]?></b></a>
                              <span><?=time_elapsed_string($aRow[10])?></span>
                           </div> 
                           <div class="post">
                              <p><?=$aRow[6]?></p>
                           </div>
                           <div id="icons">
                              <div>
                                 <button  onclick="likePost()" class="like">
                                    <svg width="1.5rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.29 26.34"><defs><style></style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g class="cls-1"><path class="cls-2" d="M24.61,1C21.1-.47,17.45.8,15.14,4.15,12.83.8,9.17-.44,5.67,1,2.39,2.34-.57,6.22.66,11.61c1.12,4.85,5,8.51,8,10.71A30,30,0,0,0,15,25.93s.08,0,.16,0,.11,0,.15,0a33.6,33.6,0,0,0,6.35-3.61c3-2.2,6.85-5.86,8-10.74C30.84,6.19,27.88,2.3,24.61,1Z"/></g></g></g></svg>   
                                    <span style="opacity: 0.5; font-size: 0.7rem;"> <?=$aRow[7]?></span> 
                                 </button>
                              </div>
                              <div>
                                 <button onclick="deleteModal()"><svg width="1.3rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.47 34.47"><defs><style>.cls-1{opacity:0.5;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g class="cls-1"><g id="a"><path d="M34.26,1.12a.59.59,0,0,0,.21-.46.62.62,0,0,0-.21-.47A.58.58,0,0,0,33.81,0a.65.65,0,0,0-.48.19L17.23,16.3,1.12.19A.6.6,0,0,0,.66,0,.65.65,0,0,0,0,.66a.6.6,0,0,0,.19.46L16.3,17.23.19,33.33a.65.65,0,0,0-.19.48.58.58,0,0,0,.19.45.62.62,0,0,0,.47.21.59.59,0,0,0,.46-.21L17.23,18.17l16.1,16.09a.63.63,0,0,0,.48.21.73.73,0,0,0,.66-.66.63.63,0,0,0-.21-.48L18.17,17.23Z"/></g></g></g></g></svg>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>


                           <?php
                        }
                     ?>


            </div>
      </div>


        </div>