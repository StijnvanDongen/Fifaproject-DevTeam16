<?php





?>
    </div>
</main>
<footer>
    <?php

    do{
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.kanye.rest",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $quote = $response = json_decode($response, true);

        curl_close($curl);
    }
    while(strlen($quote['quote']) > 86);

    ?>

    <div class="container">
        <p>Copyright by Dev-Team 16 &copy;  <?php echo "|| Kanye says : " . $quote['quote'];?></p>
    </div>
</footer>
</body>
</html>


