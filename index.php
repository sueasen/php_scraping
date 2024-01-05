<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>scraping test</title>
</head>

<body>
    <p> scraping test </p>
    <div id='result' style="display:flex; flex-wrap: wrap; width:500px"></div>
</body>
<script type="text/javascript">

    fetch("scraping.php")
        .then(response => response.json())
        .then(json => {
            console.log(json);
            [...json].forEach(data => {
                document.querySelector('#result').append(
                    createDiv(data.name, '70%')
                    , createDiv(data.time, '30%'));
            })
        });
    
    function createDiv(text, width) {
        const div = document.createElement('div');
        div.textContent = text;
        div.style.width = width;
        return div;
    }

</script>

</html>
