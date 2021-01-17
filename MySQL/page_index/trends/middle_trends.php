<div id="s_explore_1">
               <?php
               require_once(__DIR__.'/../../private/db.php');

               $query = $db->prepare('SELECT * FROM trends');
               $query->execute();
               $trends = $query->fetchAll();
               foreach($trends as $trend){
                  ?>
                  <div class="s_trends">
                        <div class="trend">
                           <b>#<?=$trend[2]?></b>
                           <p><?=$trend[3]?> mentions</p>
                        </div>
                        <div id="button">
                           <a href=""><button class="like">See more</button> </a>
                        </div>
                  </div>

             <?php
           }
                  ?>
                 
               </div>