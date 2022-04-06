<?php
    $alphabet = array ('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    $flames = array ('Soulmates','Friends','Lovers','Anger','Married','Engaged');
    $zodiac = array('', 'Capricorn', 'Aquarius', 'Pisces', 'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo', 'Libra', 'Scorpio', 'Sagittarius', 'Capricorn');
    $lastDate = array('', 19, 18, 20, 20, 21, 21, 22, 22, 21, 22, 21, 20, 19);

    $name1 = isset($_GET['name1']) ? $_GET['name1'] : null;
    $name2 = isset($_GET['name2']) ? $_GET['name2'] : null;
    $birthday1 = isset($_GET['birthday1']) ? $_GET['birthday1'] : null;
    $birthday2 = isset($_GET['birthday2']) ? $_GET['birthday2'] : null;

    if ($name1 && $name2 && $birthday1 && $birthday2)
    {
        //save the values from the birthday input strings into the Y-n-j format
        $date1 = DateTime::createFromFormat("Y-n-j", $birthday1);
        $date2 = DateTime::createFromFormat("Y-n-j", $birthday2);

        //get the zodiac for each person
        $zodiac1 = ($date1->format("j") > $lastDate[$date1->format("n")]) ? $zodiac[$date1->format("n") + 1] : $zodiac[$date1->format("n")];
        $zodiac2 = ($date2->format("j") > $lastDate[$date2->format("n")]) ? $zodiac[$date2->format("n") + 1] : $zodiac[$date2->format("n")];

        $totalCount = 0;

        //this loops through each alphabet. It counts the amount of times the alphabet appears in each name.
        //if both names have more than 0 occurences of the alphabet, that means it's a common letter
        //and the counts will be added to totalCount.
        for ($i = 0; $i < 26; $i++)
        {
            $count1 = substr_count(strtolower($name1), $alphabet[$i]);
            $count2 = substr_count(strtolower($name2), $alphabet[$i]);

            if ($count1 > 0 && $count2 > 0)
                $totalCount = $totalCount + $count1 + $count2;
        }

        //get the result
        $result = $flames[$totalCount % 6];
    }
?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>FLAMES</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" />
</head>
<body>
    <div class="container">
        <h1>FLAMES</h1>
        <div class="box">
            <form action="LE1_JannatriN.php" method="get">
                <h3>Person 1</h3>
                <div class="form-group">
                    <div class="input-group">
                        <label for="name1">Name:</label>
                        <input type="text" id="name1" name="name1">
                    </div>
                    <div class="input-group">
                        <label for="birthday1">Birthday:</label>
                        <input type="date" id="birthday1" name="birthday1">
                    </div>
                </div>
                <hr>
                <h3>Person 2</h3>
                <div class="form-group">
                    <div class="input-group">
                        <label for="name2">Name:</label>
                        <input type="text" id="name2" name="name2">
                    </div>
                    <div class="input-group">
                        <label for="birthday2">Birthday:</label>
                        <input type="date" id="birthday2" name="birthday2">
                    </div>
                </div>
                <div class="form-group">
                    <input class="button" type="submit" value="SUBMIT">
                </div>
            </form>
        </div>
        <div class="box" id="result">
            <?php
                if ($name1 && $name2 && $birthday1 && $birthday2)
                {
                    echo "<h4>You two are...</h4>";
                    echo "<h1>".$result."!</h1>";
                    echo "<p>".$name1." is <strong>".$zodiac1."</strong> while ".$name2." is <strong>".$zodiac2."</strong>.</p>";
                }
                else
                {
                    echo "<h4>Complete the form to get your FLAMES result!</h4>";
                }
            ?>
        </div>
    </div>
</body>
</html>