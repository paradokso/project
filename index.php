<?php 

require_once 'setter.php'; ?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Системы автоматизации Программатикс</title>
		<meta name="keywords" content="">
		<meta name="description" content="">
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        
        <link rel="stylesheet" href="static/css/normalize.css">
        <link rel="stylesheet" href="static/css/style.min.css">
    </head>
    <body>

        <header>
            <div class="container">
                <a href="index.php" class="header header-logo"><img src="static/img/logo.png" alt="Logo"></a>
                <div class="header header-titel">
                    <h1>Системы автоматизации Программатикс</h1>
                </div>
                <div class="header header-link"><a href="#contacts">Контакты</a></div>
            </div>
        </header>

        <section class="container">
            <form action="." method="post" class="dropzone" enctype="multipart/form-data" id="form">
                <div class="box box-wide">
                    <h2 class="box-header">1. Информация о плательщике <span class="note">будет браться автоматически из базы</span></h2>
		            <label for="INN">ИНН</label>
                    <input type="text" class="Input" name="INN" id="INN" data-len="12" placeholder="Введите 10 или 12 цифр" required pattern="([0-9]{10})|([0-9]{12})" title="Введите 10 или 12 цифр">
		            <label for="KPP">КПП</label>
                    <input type="text" class="Input" name="KPP" id="KPP" data-len="9" placeholder="Введите 9 цифр" required pattern="[0-9]{9}" title="Введите 9 цифр">
                    <label for="BIC">БИК</label>
                    <input type="text" class="Input" name="BIC" id="BIC" data-len="9" placeholder="Введите 9 цифр" required pattern="[0-9]{9}" title="Введите 9 цифр">
                    <label for="Cor">Корсчет</label>
                    <input type="text" class="Input" name="Cor.Acc" id="Cor" data-len="20" placeholder="Введите 20 цифр" required pattern="[0-9]{20}" title="Введите 20 цифр">
	                <label for="Checking">Расчетный счет</label>
                    <input type="text" class="Input" name="Checking Acc" id="Checking" data-len="20" placeholder="Введите 20 цифр" required pattern="[0-9]{20}" title="Введите 20 цифр">
                </div>
                <div class="box box-file " id="dropzonePreview">
                    <h2 class="box-header">2. Загрузите счет <span class="note">pdf, doc, xls, jpg</span></h2>
                    <!-- MAX_FILE_SIZE  -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000" id="load"/>
                    <input type="file" name="file" class="" id="file" required>
                    <div class="btn rnd-btn box-btn dz-message" id="open">+</div>
                    <span class="note note_long">Нажмите на иконку или перетащите сюда файл</span>
                </div>
                <input type="submit" class="btn form-btn" name="submit" value="Поехали!" id="submit">  
            </form>
            <div class=" meter animate" role="progressbar">
                <span><span></span></span>
            </div>
        </section>

        <section class="container payment" id="payment">
            <div class="declaration">
                <h1 class="payment-headings">Платежное поручение</h1>
                <div class="payment-headings">
                    <span id="response_0"></span>
                    <i>Дата</i>
                </div>
                <div class="payment-headings">
                    <span>электронно</span> <!-- константа -->
                    <i>Вид платежа</i>
                </div>

                <table class="info-table">
                    <tr>
                        <td class="left-bar">
                            <table>
                                <tr>
                                    <td>ИНН <span id="response_1"></span></td>
                                    <td>КПП <span id="response_2"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <span class="block" id="response_3"></span>
                                        Плательщик</td>
                                </tr>
                            </table>
                        </td>
                        <td class="right-bar">
                            <table>
                                <tr>
                                    <td>Сумма</td>
                                    <td><span id="response_4"></span></td>
                                </tr>
                                <tr>
                                    <td>Сч. №</td>
                                    <td><span id="response_5"></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="left-bar">
                            <table>
                                <tr>

                                    <td>
                                        <span class="block" id="response_6"></span>
                                        Банк плательщика</td>
                                </tr>
                            </table>
                        </td>
                        <td class="right-bar">
                            <table>
                                <tr>
                                    <td>БИК</td>
                                    <td><span id="response_7"></span></td>
                                </tr>
                                <tr>
                                    <td>Сч. №</td>
                                    <td><span id="response_8"></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="left-bar">
                            <table>
                                <tr>

                                    <td>
                                        <span class="block" id="response_9"></span>
                                        Банк получателя</td>
                                </tr>
                            </table>
                        </td>
                        <td class="right-bar">
                            <table>
                                <tr>
                                    <td>БИК</td>
                                    <td><span id="response_10"></span></td>
                                </tr>
                                <tr>
                                    <td>Сч. №</td>
                                    <td><span id="response_11"></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="left-bar">
                            <table>
                                <tr>
                                    <td>ИНН <span id="response_12"></span></td>
                                    <td>КПП <span id="response_13"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <span class="block" id="response_14"></span>
                                        Получатель</td>
                                </tr>
                            </table>
                        </td>
                        <td class="right-bar">
                            <table>
                                <tr>
                                    <td>Сч. №</td>
                                    <td><span id="response_15"></span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="closing-row">
                        <td colspan="2">
                            <span class="block" id="response_16"></span>
                            Назначение платежа
                        </td>
                    </tr>
                </table>
            </div>

            <div class="download">
                <h2>Скачать в формате 1С</h2>
                <h5 style="text-align: center" >Название файла: <span id="response_17"></span></h5>
                <a href="#" class="btn rnd-btn download-btn" target="_blank" download>⇩</a>
            </div>

            <article class="warnings">
                <div class="btn rnd-btn warning-btn">!</div>
                <p id="response_18"></p>
            </article>
        </section>

        <footer id="contacts">
            <div class="container">
                <p>© 2006–2015,официальный сайт</p>
                <a href="mailto:poglazoff@gmail.com">poglazoff@gmail.com</a>
                <a href="tel:00000000">00000000</a>
            </div>
        </footer>

        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="static/js/dropzone.js"></script>
        <script src="static/js/script.js"></script>

    </body>
</html>
