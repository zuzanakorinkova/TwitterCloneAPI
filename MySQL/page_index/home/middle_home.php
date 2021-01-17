<div id="s1">
    <div id="s_home_1">
        <div>
            <img id="userImage" height="50vh" src="../../assets/<?=$_SESSION['avatar']?>" alt="">
        </div>
         <form onsubmit="post(); return false">
                <div id="sub_home1_1" contenteditable="true" data-type="string" data-min="2" data-max="140">
                  What is happening?
                </div>
            <div id="sub_home1_2">
                <svg width="2rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 32.75"><defs><style>.cls-1{opacity:0.4;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g class="cls-1"><path d="M0,0V32.75H40V0H0ZM.91,1H39.09v26.5L30.34,17a.42.42,0,0,0-.41-.16.48.48,0,0,0-.26.16L22.83,25,13.07,13.06a.42.42,0,0,0-.41-.16.48.48,0,0,0-.26.16L.91,26.53ZM23.18,7A3.34,3.34,0,0,0,20,10.42a3.34,3.34,0,0,0,3.18,3.47,3.34,3.34,0,0,0,3.18-3.47A3.34,3.34,0,0,0,23.18,7Zm-.23,1a1.77,1.77,0,0,1,.23,0,2.37,2.37,0,0,1,2.27,2.48,2.28,2.28,0,1,1-4.54,0A2.42,2.42,0,0,1,23,7.94ZM12.71,14.13,27.17,31.76H.91V28ZM30,18.1,39.09,29v2.79H28.39l-4.95-6.05Z"/></g></g></g></svg>
                <svg width="2rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 39 32.49"><defs><style>.cls-1{opacity:0.4;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g class="cls-1"><path d="M.48,32.49h38a.52.52,0,0,0,.48-.56V.55s0-.06,0-.08,0-.08,0-.11a.26.26,0,0,0,0-.09s0-.06,0-.09A.34.34,0,0,0,38.79.1l-.06,0h0a.25.25,0,0,0-.09,0l-.09,0H.48A.52.52,0,0,0,0,.56V31.94A.52.52,0,0,0,.48,32.49ZM38.05,9H35.49l2.56-6Zm-.3-7.85L34.42,9H27.88l3.33-7.85Zm-7.61,0L26.81,9H20.27L23.6,1.11Zm-7.61,0L19.21,9H12.66L16,1.11Zm-7.61,0L11.6,9H5.05L8.38,1.11Zm-14,0H7.31L4,9H1Zm0,9h37.1V31.37H1Z"/></g></g></g></svg>
                <svg width="2rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36.01 36.01"><defs><style>.cls-1{opacity:0.5;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g class="cls-1"><path d="M18,0A18,18,0,1,0,36,18,18,18,0,0,0,18,0Zm0,34.88A16.87,16.87,0,1,1,34.88,18,16.89,16.89,0,0,1,18,34.88Z"/><path d="M18,28c-3.81,0-7-1.94-7.84-4.55H9c.82,3.24,4.55,5.69,9,5.69s8.21-2.45,9-5.69H25.84C25,26.09,21.82,28,18,28Z"/><rect x="8.74" y="12.02" width="5.33" height="1.71"/><rect x="22.96" y="12.02" width="5.33" height="1.71"/></g></g></g></svg>    
                <button>post</button>
            </div>     
        </form> 
    </div>

    <div id="s_home_2">
        
            <?php
            require_once(__DIR__.'/../function-time.php');
            require_once(__DIR__.'/../../private/db.php');
                $query = $db->prepare('SELECT posts.*, users.iUserId,users.sName, users.sLastName, users.sAvatarUrl, followers.iUserFkFollower, followers.iUserFkFollowee 
                                        FROM followers
                                        JOIN posts ON followers.iUserFkFollowee = posts.iUserFk 
                                        JOIN users ON followers.iUserFkFollowee = users.iUserId
                                        WHERE followers.iUserFkFollower = :userId ORDER BY posts.dCreated DESC LIMIT 5');
                $query->bindValue(':userId', $_SESSION['userId']);
                $query->execute();
                $rows = $query->fetchAll();
                
                foreach($rows as $row){
                    ?>
                  <div class="s_post" id="<?=$row[0]?>">
                        <div>
                            <img height="40vh" src="../../assets/<?=$row[10]?>" alt="">
                        </div>
                        <div id="user_post">
                            <div class="user-information">
                                <a href=""><b><?=$row[8].' '.$row[9]?></b></a>
                                <span><?=time_elapsed_string($row[6])?></span>
                            </div> 
                            <div class="post">
                                <p><?=$row[2]?></p>
                            </div>
                            <div id="icons">
                                <div>
                                    <button onclick="likePost()" class="like"><svg width="1.5rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.29 26.34"><defs><style></style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g class="cls-1"><path class="cls-2" d="M24.61,1C21.1-.47,17.45.8,15.14,4.15,12.83.8,9.17-.44,5.67,1,2.39,2.34-.57,6.22.66,11.61c1.12,4.85,5,8.51,8,10.71A30,30,0,0,0,15,25.93s.08,0,.16,0,.11,0,.15,0a33.6,33.6,0,0,0,6.35-3.61c3-2.2,6.85-5.86,8-10.74C30.84,6.19,27.88,2.3,24.61,1Z"/></g></g></g></svg> 
                                        <span style="opacity: 0.5; font-size: 0.7rem;"><?=$row[3]?></span> 
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