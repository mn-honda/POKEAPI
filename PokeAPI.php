<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = 'PokeAPI.css'>
    <title>Pokemon</title>
</head>
<body>
    <h1> ポケモン図鑑</h1>

</body>
</html>

<?php
    if(isset($_GET["prev"])){
        $page = $_GET["page"] - 10;
    }
    elseif(isset($_GET["next"])){
        $page = $_GET["page"] + 10;
    }
    else{
        $page = 0;
    }
    /** PokeAPI のデータを取得する(id=11から20のポケモンのデータ) */
    // offset = 何番目から　limit = offsetから何番目まで
    $url = "https://pokeapi.co/api/v2/pokemon/?limit=10&offset={$page}";
    $response = file_get_contents($url);
    // レスポンスデータは JSON 形式なので、デコードして連想配列にする
    $data = json_decode($response, true);

    print("<div class = 'poke'>");
    foreach($data['results'] as $key => $value){
        $poke_url = $value['url'];
        $poke_response = file_get_contents($poke_url);
        $poke_data = json_decode($poke_response, true);

        print("<div class = 'img'>");
        $img = ($poke_data['sprites']['front_default']);
        echo"<img src = '{$img}'><br>";
        echo "なまえ: " ."{$value['name']}" ."<br>";
        echo "たかさ: " ."{$poke_data['height']}" ."<br>";
        echo "おもさ: " ."{$poke_data['weight']}" ."<br>";
        print("</div>");
    }
    print("</div>");
    // ページネーション
    echo <<< _FORM_
    <form action="PokeAPI.php">
    <input type="submit" name = "prev" value = "前へ">
    <input type="submit" name = "next" value = "次へ">
    <input type="hidden" name = "page" value = "{$page}">
    </form>
    _FORM_;
    ?>





