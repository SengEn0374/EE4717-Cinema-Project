<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJ Theatres - Home</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <div id="wrapper">
        <header>
            <img id='company_logo' src="headerv2.PNG" alt="Logo" width="300px">
            <table class="social">
                <tr>
                    <td>
                        <p>Follow us</p>
                    </td>
                    <td>
                        <a href="www.facebook.com"><img class="social" src="facebook-logo.jpg" alt="fb-logo" width="37px"></a>
                    </td>
                    <td>
                        <a href="www.instagram.com"><img class="social" src="instagram-logo.png" alt="ig-logo" width="20px"></a>
                    </td>
                </tr>
            </table>
        </header>
        <div id="nav">
            <nav>
                <ul class="nav">
                    <li class="nav"><a href="index.html">Home</a></li>
                    <li class="nav"><a href="movies.html">Movies</a></li>
                    <li class="nav"><a href="cinema.html">Cinema</a></li>
                    <li class="nav"><a class="active" href="javascript:openModal()">Check Booking</a></li> <!--trigger js to open modal-->
                </ul>
            </nav>
        </div>
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h3>Check Booking</h3>
                </div>
                <div class="modal-body">
                    <br>
                    <form action="post.php"> <!--php script to check method, match detail and fetch data from db-->
                        <label for="check_method">Method:&nbsp;</label>
                        <select name="check_method" id="check_method">
                            <option value="email" selected>Email address</option>
                            <option value="bookid">Transaction ID</option>
                            <option value="hp">Phone number</option>
                        </select>
                        <br><br>
                        <input type="text" required>
                        <input type="submit" value="Submit">
                        <!-- <a> tag as place holder for php file. TOBE REMOLVED-->
                        <a href="confirmation.html"><input type="button" value="test button to be removed"></a>
                    </form>
                    <br><br><br>
                    <p>SE: redirect to another page (modified confirmation page)</p>
                </div>
            </div>
        </div>
        <script>
            var modal = document.getElementById("myModal");
            var btn = document.getElementById("myBtn");
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal 
            function openModal() {
                modal.style.display = "block";
            }
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>

        <div class="confirmation">
            <?php
                $servername ="localhost";
                $username = "f32ee";
                $password = "f32ee";
                $dbname = "f32ee";

                $method = $_POST['check_method'];
                if ($method == 'email') {
                    $attr = 'email';
                    echo "checking with ".$attr.": ";
                    $email = $_POST['user_detail'];
                    echo $email."<br>";
                }

                if (!get_magic_quotes_gpc()) {
                    $email = addslashes($email);
                  }

                $db = mysqli_connect($servername, $username, $password, $dbname);
                if(!$db) {
                    die("Connection error:" . mysqli_connect_error());
                }
                // else {
                //     echo "connection success!";
                // }



                $query = "SELECT * FROM BOOKINGS, MOVIE, SHOWTIME 
                WHERE BOOKINGS.showtime_id=SHOWTIME.showtime_id 
                AND SHOWTIME.movie_id=MOVIE.movie_id
                AND email='$email'";
                $result = $db->query($query);
                $num_results = $result->num_rows;
                

                if ($num_results < 1){
                    echo "no records found";
                }
                else {
                    echo "<p>".$num_results." records found</p>";
                    $i = 0;
                    for ($i=0; $i <$num_results; $i++) {
                        $row = $result->fetch_assoc(); // fetches row iteratively
                        echo "<p>".($i+1).". "; // .$row['timestamp'];
                        echo htmlspecialchars(stripslashes($row['title']));
                        echo "<br /><hr>Movie Title: ";
                        echo stripslashes($row['movie_name']);
                        echo "<br />Date & Time: ";
                        echo stripslashes($row['date_time']);
                        echo "<br />Hall: ";
                        echo stripslashes($row['hall_id']);
                        echo "<br />Seats: ";
                        echo stripslashes($row['seats']);
                        echo "<hr>";
                        echo "</p>";
                     }
                }


                // echo $row;
                // // if (count($row))
                // $book_id = $row['book_id'];
                // $time = $row['date_time'];
                // echo "<p>time of purchase: ".$time;"</p>"
            ?>

        </div>        

        <div class="push"></div>
        <footer class="footer">
           <table>
               <tr>
                   <td><a href="tnc.html"><small><b>Terms and Conditions</b></small></a></td>
               </tr>
               <tr>
                   <td><small><i>By using our servicces, you hereby agree to these terms. When you 
                       access this website, you acknowledge that you <br>have read and agree to abide by 
                       the terms described. If you do not agree to the terms, 
                       you should exit this site. <br>&copy; SJ Groups Company</i></small>
                       
                    </td>
               </tr>
           </table>
        </footer>
    </div>

</body>
</html>