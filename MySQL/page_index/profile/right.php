<section id="right">
  <form id="searchForm" action="">
          <input id="searchText" type="text" placeholder="Search" onfocus="showSearchResults();" onblur="hideSearchResults();" oninput="startSearch();">
       <button><svg width="1.5rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.95 24.95"><defs><style>.cls-1{opacity:0.4;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M17.35,3a10.17,10.17,0,1,0-.25,14.61L24.47,25l.48-.48L17.58,17.1A10.17,10.17,0,0,0,17.35,3ZM3.45,16.87a9.49,9.49,0,1,1,13.42,0h0A9.5,9.5,0,0,1,3.45,16.87Z"/></g></g></svg></button>   
  </form>
      <div id="searchResults" style=" z-index: 1;width: 21rem; position: absolute; top: 160px; display: none; background-color: #ffffff; border-radius: 10px;  box-shadow: 5px 5px 15px 10px #2927a90c; padding: 1rem; margin-top: 0.1rem;">
      
      </div>

      <div id="trends">
      <?php
         require_once(__DIR__.'/../../private/db.php');
         require_once(__DIR__.'/../function-time.php');
         $query = $db->prepare('SELECT trends.*, posts.dCreated FROM trends JOIN posts ON posts.iPostId = trends.iPostFk LIMIT 3');
               $query->execute();
               $trends = $query->fetchAll();
               foreach($trends as $trend){
      ?>

    <div id="trend_single">
      <div id="trend_content">
        <b>#<?=$trend[2]?></b>
        <p><?=$trend[3]?> mentions</p>
      </div>
      <span><?=time_elapsed_string($trend[4])?></span>
    </div>
   
        <?php
      }
        ?>
          </div>
  <div id="users_to_follow">
  <?php
     $query = $db->prepare('SELECT u.iUserId, u.sName, u.sLastName, u.sEmail, u.sAvatarUrl FROM users AS u 
     WHERE iUserId NOT IN (SELECT f.iUserFkFollowee FROM followers AS f WHERE f.iUserFkFollower = :userId) 
     ORDER BY u.iUserId DESC 
     LIMIT 0,2');
     $query->bindValue(':userId', $_SESSION['userId']);
     $query->execute();
     $users = $query->fetchAll();
     foreach($users as $user){
  ?>
    <div id="<?=$user[0]?>" class="user_single">
        <img src="../../assets/<?=$user[4]?>" alt="">
        
       <form action="../user" method="POST" id="user_to_follow_info">
          <button><p><b><?=$user[1].' '.$user[2]?></b> <br> <span><?=$user[3]?></span> </p></button>
     </form> 
        <button id="followButton" onclick="follow()">Follow</button>
    </div>
     <?php } ?>
  </div>
</section>