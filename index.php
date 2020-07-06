<!doctype html>
<html leng="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css?<?php echo time();?>">
      <link href="https://fonts.googleapis.com/css?family=PT+Sans|Playfair+Display+SC" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="nav-menu" role="menubar">
            <a href="index.php" aria-current="page" role="menuitem"><span class="visually-hidden">Текущий пункт:</span>Главная</a>
            <a href="category.php" role="menuitem">Категории</a>
            <a href="authors.php" role="menuitem">Авторы</a>
            <?php
                if(isset($_COOKIE['user']) == 'admin'){
                    echo '<a href="lk_admin.php" role="menuitem">Личный кабинет</a>';
                }else if(isset($_COOKIE['user'])){
                    echo'<a href="lk.php" role="menuitem">Личный кабинет</a>';
                }else{
                    echo'<a href="registr.php" role="menuitem">Личный кабинет</a>';
                }
            ?>
        </nav>
    </header>
    <main>
        <img class="my_img" src="img/подайте3.png" alt="фон">
        <style>.my_img {
            width: 100%;
            height: auto;
            }
            .nav-menu {
                padding-top: 30px;
                height: 80px;
            }
            #app{
                margin-top: 150px;
                margin-bottom: 40px;
                color: white;
                background-color: black;
                font-family: "Playfair Display SC", serif !important;
                text-align: center;
            }
            .cards{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-template-rows: 1fr;
                width: 90%;
                margin: 0 auto;
                grid-column-gap: 10px;
            }
            .card__content, .card_image{
                background-color: black;
                color: white;
            }
            .card__content{
                font-size: 17px;
            }
            .card__content > button > a{
                color: black;
            }
            .card__title{
                font-weight: 600;
                margin-bottom: 10px;
                font-size: 20px;
            }
            h1{
                text-align: center;
                margin-bottom: 20px;
                font-size: 45px;
            }
            @media screen and (max-width: 768px) {
                .cards{
                    grid-template-columns: 1fr 1fr;
                    grid-template-rows: 1fr 1fr;
                }
                .card__content{
                    font-size: 15px;
                }
                .card__title{
                    font-size: 17px;
                }
                h1{
                    font-size: 35px;
                }
            }
            @media screen and (max-width: 462px) {
                .cards{
                    grid-template-columns: 1fr;
                    grid-template-rows: 1fr 1fr 1fr;
                }
                .card__content{
                    font-size: 15px;
                }
                .card__title{
                    font-size: 17px;
                }
                h1{
                    font-size: 30px;
                }
            }
            @media screen and (max-width: 376px) {
                .cards{
                    grid-template-columns: 1fr;
                    grid-template-rows: 1fr 1fr 1fr;
                }
                #app{
                    margin-top: 70px;
                }
                .card__content{
                    font-size: 15px;
                }
                .card__title{
                    font-size: 17px;
                }
                h1{
                    font-size: 22px;
                }
            }
        </style>
    </div>
    <div id="app">
        <h1>{{ header_name }}</h1>
        <div class="main">
            <ul class="cards">
                <li class="cards_item" v-for="product in products" id="product.id">
                    <div class="card">
                        <div class="card__image"><img v-bind:src="product.img"></div>
                        <div class="card__content">
                            <h2 class="card__title">{{ product.title }}</h2>
                            <p class="card__text">{{ product.text }}</p><br>
                            <button class="button is-warning"><a v-bind:href="product.link" class="btn">{{ btn.title }}</a></button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
    var app = new Vue({
        el: '#app',
        data: {
            header_name: 'Наши преимущества',
            btn: {
                title: 'Вперёд',
            },
            products: [{
                    id: '1a',
                    title: 'Современные поэты',
                    text: 'На нашем сайте вы найдете стихи только лучших современных поэтов',
                    link: 'authors.php',
                    img: 'img/1.jpg'
                },
                {
                    id: '2b',
                    title: 'Возможность стать известным',
                    text: 'После регистрации в качестве "автора" вы можете публиковать свои стихи',
                    link: 'registr.php',
                    img: 'img/3.jpg'
                },
                {
                    id: '3c',
                    title: 'Лучшие стихи',
                    text: 'Все стихи распределены по категориям, можете выбрать то,что вам интересно',
                    link: 'category.php',
                    img: 'img/2.jpg'
                },
            ],
        }
    })
    </script>
    </main>
    <footer></footer>
</body>
</html>


