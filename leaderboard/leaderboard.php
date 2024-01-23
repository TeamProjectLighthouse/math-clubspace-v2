<?php
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        require_once "../includes/dbh.inc.php";
        
        $query = "SELECT * FROM studentData WHERE points != 0 ORDER BY points DESC;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
  }
  else {
      header("Location: leaderboard.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="leaderboard.css" rel="stylesheet" type="text/css" />
  <link href="../text.css" rel="stylesheet" type="text/css" />
  <title>Leaderboard</title>
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
          <a class='nav-button' href='../dashboard/dashboard.php'>
            <img src='../images/dashboard-dot.png' style='object-fit: cover;size: 12px;'>
            dashboard
          </a>
          <a class='nav-button'>
            <img src='../images/events-dot.png' style='object-fit: cover;width: 12px;'>
            events
            <img src='../images/lock.png' style='object-fit: cover;width: 12px;'>
          </a>
          <a class='nav-button'>
            <img src='../images/news-dot.png' style='object-fit: cover;width: 12px;'>
            news
            <img src='../images/lock.png' style='object-fit: cover;width: 12px;'>
          </a>
          <a class='nav-selected-button' href='../leaderboard/leaderboard.html'>
            <img src='../images/leaderboard-dot.png' style='object-fit: cover;size: 12px;'>
            leaderboard
          </a>
        </div>
      </div>
    </div>
    <div class='body-box'>
      <div class='header-box'>
        <div class='heading-box'>
          <p class='heading'>Leaderboard</p>
          <p class='subheading'>Your rank: 1st</p>
        </div>
        <div class='today-box'>
          <div class='today-date'>
            <p class='today-date-text'>Today's date is <span id='date'></span></p>
            <div class="today-img-box"></div>
          </div>
          <p class='today-time' id='time'></p>
        </div>
      </div>
      <div class='content-box'>
        <div class='leaderboard-box'>
          <table class="leaderboard">
            <tr>
              <th class="rank"></th>
              <th class="class">Class</th>
              <th class="number">Number</th>
              <th class="name">Name</th>
              <th class=points>Points</th>
            </tr>

            <?php

              $rank = 0;
              $leaderboard = [];
              foreach ($results as $row) {
                $rank = $rank + 1;

                $studentId = $row["studentId"];
                $class = $row["class"];
                $cno = $row["cno"];
                $name = $row["ename"];
                $points = $row["points"];
                
                if ($rank <= 5) {
                  echo "
                    <tr class='student'>
                        <td class='rank-{$rank}' style='color: var(--color-gray-blue)'>{$rank}</td>
                        <td class='class'>{$class}</td>
                        <td class='cno'>{$cno}</td>
                        <td class='name'>{$name}</td>
                        <td class='points'>{$points}</td>
                      </tr>
                  ";
                }
              }
            ?>
          </table>
          <div class="leaderboard-line"></div>
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
<!-- <script src="leaderboard.js"></script> -->
</html>
<!-- insert into studentData VALUES
( "201401123", "10B", "邱浩哲", 30, false, "YAU Ho Chit", 180 ),
( "202105017", "7C", "黃安之", 17, false, "WONG On Ji", 120),
( "201907009", "11M", "羅碧城", 24, false, "LUO Bicheng", 130),
( "201401077", "10C", "Max", 24, false, "HUANG Max Linshuo", 100),
( "202206016", "7C", "余欣澄", 18, false, "YU Yan Ching", 30),
( "201701087", "7C", "隋子軒", 30, false, "SUI Tsz Hin", 30),
( "201201065", "12B", "陳湛琳", 13, false, "CHAN Cham Lam", 20),
( "202107011", "9W", "呂盼蔚", 11, false, "LUI Pan Wai", 20),
( "201601121", "8M", "尚嘉諾", 24, false, "SHANKER Sharlen", 10),
( "201401012", "10B", "蔡希愉", 34, true, "CHUA Hei Yu", 20),
( "201401006", "10B", "張家銘", 19, false, "CHEUNG Ka Ming", 20),
( "202206010", "7C", "蔡雅芯", 4, false, "CHOI Nga Sum", 30),
( "201701047", "7C", "侯文德", 24, false, "HAU Man Tak Ethan", 10),
( "202307008", "7C", "林禕晨", 13, false, "LIN Yichen", 20),
( "201701133", "7C", "區巧賢", 1, false, "AU Hau Yin", 10),
( "201807023", "12B", "門睿涵", 24, false, "MEN Ruihan", 10),
("201501017", "9B", "李語嫣", 24, false, "Li Yu Yin Icy", 10),
("201906004", "10B", "繆雲涵", 14, false, "MIAO Yunhan Ivy", 30),
("201301090", "11P", "劉祉延", 8, false, "LAU Tsz Yin", 10) -->