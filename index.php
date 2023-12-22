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
                const doms = createDom(data.name, data.time);
                document.querySelector('#result').append(doms[0], doms[1]);
            })
        });
    
    function createDom(name, time) {
        const nameDom = document.createElement('div');
        nameDom.textContent = name;
        nameDom.style.width = '70%'
        const timeDom = document.createElement('div');
        timeDom.textContent = time;
        timeDom.style.width = '30%'
        return [nameDom, timeDom];
    }

</script>

</html>
