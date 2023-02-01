<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $model["title"] ?></title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <style>
            <?php require __DIR__ . "/app.css"; ?>
        </style>
    </head>

    <body>
        <header>
            <nav>
                <div>
                    <ul class="nav__links">
                        <li><a href="https://github.com/firzaaditiya" target="_blank">github</a></li>
                        <li><a href="https://t.me/Hayuza" target="_blank">contact</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <main>
            <div class="container__main">
                <section class="user__inputs">
                    <div>
                        <h1 class="title__text">Hexadecimal to integer32</h1>
                    </div>
    
                    <div>
                        <p>You can convert the hexadecimal code to integer 32, with different results converted.</p>
                        <form action="/convert" method="post">
                            <label for="user__hexin">Hexadecimal String:</label>
                            <textarea name="hexstring" id="user__hexin" cols="40" rows="4" placeholder="hexadecimal code" maxlength="8" class="textarea__inputs" required><?= $_POST["hexstring"] ?? "" ?></textarea>
                            <button type="submit" class="button-submit">Analyze</button>
                        </form>
                    </div>
                </section>
    
                <?php if (isset($model["error"])) { ?>
                <section>
                    <p class="error__message"><?= $model["error"] ?></p>
                </section>
                <?php } ?>
    
                <section class="result__analyze">
                    <table border="1" class="table__result">
                        <thead>
                            <tr>
                                <td>Type</td>
                                <td>Big Endian</td>
                                <td>Little Endian</td>
                                <td>Mid Big Endian</td>
                                <td>Mid Little Endian</td>
                            </tr>
                        </thead>
    
                        <tbody>
                            <tr>
                                <td>Unsigned</td>
                                <td><?= $model["UINT32"]["BIG_ENDIAN"] ?></td>
                                <td><?= $model["UINT32"]["LITTLE_ENDIAN"] ?></td>
                                <td><?= $model["UINT32"]["MID_BIG_ENDIAN"] ?></td>
                                <td><?= $model["UINT32"]["MID_LITTLE_ENDIAN"] ?></td>
                            </tr>
                            <tr>
                                <td>Singed</td>
                                <td><?= $model["INT32"]["BIG_ENDIAN"] ?></td>
                                <td><?= $model["INT32"]["LITTLE_ENDIAN"] ?></td>
                                <td><?= $model["INT32"]["MID_BIG_ENDIAN"] ?></td>
                                <td><?= $model["INT32"]["MID_LITTLE_ENDIAN"] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section>
                    <div class="explains__paraf">
                        <p>this is a simple website that is useful for converting a hexadecimal code to integer32 with varying results, if you are interested in seeing the source code you can check directly on github. the github link is at the bottom</p>
                    </div>
                </section>
            </div>
        </main>

        <footer class="footer">
            <div class="container__footer">
                <div class="row">
                    <div class="footer__col">
                        <h4>Social Links</h4>
                        <div class="social__links">
                            <a href="https://www.facebook.com/yuzaonlyone" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="https://github.com/firzaaditiya" target="_blank"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                    <div class="footer__col">
                        <h4>Other Links</h4>
                        <ul>
                            <li><a href="https://github.com/firzaaditiya/web-project-hex2int32" target="_blank">Source Code</a></li>
                            <li><a href="https://tujuanpelajar.blogspot.com" target="_blank">Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>