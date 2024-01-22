<?php
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        require_once "../includes/dbh.inc.php";

        $query = "SELECT * FROM studentData WHERE studentId = '201401111';";

        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
  }
  else {
      header("Location: dashboard.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="dashboard.css" rel="stylesheet" type="text/css" />
  <link href="../text.css" rel="stylesheet" type="text/css" />
  <title>Dashboard</title>
</head>
<body>
  <div class='web-box'>
    <div class='sidebar-box'>
      <div class='profile-box'>
        <img src='../images/profile-pic.png' class='profile-pic'>
        <div class='profile-text-box'>
          <p class='profile-text-name'>Lau Ka Yue</p>
          <p class='profile-text-class'>10B 09</p>
        </div>
        <button class='profile-button'>
          <img src=''>  
        </button>
      </div>
      <hr class='sidebar-line'>
      <div class='nav-bar-big-box'>
        <div class='nav-bar-box'>
          <a class='nav-selected-button' href='../dashboard/dashboard.html'>
            <img src='../images/dashboard-dot.png' style='object-fit: cover;size: 12px;'>
            dashboard
          </a>
          <a class='nav-button'>
            <img src='../images/events-dot.png' style='object-fit: cover;size: 12px;'>
            events
          </a>
          <a class='nav-button'>
            <img src='../images/news-dot.png' style='object-fit: cover;size: 12px;'>
            news
          </a>
          <a class='nav-button' href='../leaderboard/leaderboard.php'>
            <img src='../images/leaderboard-dot.png' style='object-fit: cover;size: 12px;'>
            leaderboard
          </a>
        </div>
      </div>
    </div>
    <div class='body-box'>
      <div class='header-box'>
        <div class='heading-box'>
          <p class='heading'>This is your math clubspace.</p>
          <p class='subheading'>Welcome back, 10B 09!</p>
        </div>
        <div class='today-box'>
          <div class='today-date'>
            <p class='today-date-text'>Today's date is <span id='date'><span id='date'></span></span></p>
            <div class="today-img-box"></div>
          </div>
          <p class='today-time' id='time'></p>
        </div>
      </div>
      <div class='content-box'>
        <div class='dashboard-box'>
          <div class='dashboard-left-box'>
            <div class='points-box'>
              <div>
                <p class='dashboard-heading'>Your points</p>
                <img class='dashboard-icon' src='../images/points-icon.png'>     
              </div>
              <p class='points'>150</p>
            </div>
            <div class='membership-box'>
              <p class='dashboard-heading'>Membership</p>
              <img class='dashboard-icon' src='../images/membership-icon.png'>
              <p class='membership'>Silver</p>
            </div>
            <div class='streak-box'>
              <div>
                <p class='dashboard-heading'>Streak</p>
                <img class='dashboard-icon' src='../images/streak-icon.png'>
              </div>
              <p class='streak'>
                <?php
                  $allEvents = ["a", "b", "c"];
                  $participatedEvents = $results["participatedEvents"];
                
                  $participatedBoolArray = [];
                  foreach ($allEvents as $event) {
                    array_push($participatedBoolArray, in_array($event, $participatedEvents));
                  }

                  $streak = 0;
                  foreach ($participatedBoolArray as $event) {
                    $streak = $event ? $streak + 1 : 0;
                  }

                  echo $streak;
                ?>
              </p>
            </div>
          </div>
          <div class='redeeming-box'>
            <div class="redeem-header">
              <p class="dashboard-heading">Prize redemption</p>
              <img class="dashboard-icon" src="../images/prize-icon.png">
            </div>
            <div class="redeeming-body-box">
              <div class="prize-list-box"></div>
              <div class="prize-redeem-box">
                <div class="prize-selection-box">
                  <div class="prize-selection-div">
                    <label> 
                      <select class="prize-selection"></select>
                    </label>  
                  </div>
                  <div class="prize-quantity-box">
                    <button class="quantity-button">-</button>
                    <div class="quantity-text">1</div>
                    <button class="quantity-button">+</button>
                  </div>
                </div>

                <button class="prize-redeem-button">Redeem your prize</button>
                <p class="prize-redeem-reminder">You will receive your prize at the end of this term</p>
              </div>
            </div>
          </div>
        </div>
        <div class='content-line'></div>
        <div class='guides-box'>
          <p class='guides-heading'>Guides</p>
          <div class='guides-item'>
            <p class='guides-item-text'>What are points?</p>
            <a>
              <img src='../images/arrow.png' class="arrow">
            </a>
          </div>
          <div class='guides-item'>
            <p class='guides-item-text'>How do I gain points?</p>
            <a>
              <img src='../images/arrow.png' class="arrow">
            </a>
          </div>
          <div class='guides-item'>
            <p class='guides-item-text'>Other FAQs</p>
            <a>
              <img src='../images/arrow.png' class="arrow">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="../script.js"></script>
<script src="dashboard.js"></script>
</html>