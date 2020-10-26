<?php


?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>KANT-MEN</title>
        <link href="CSS/styleGlowne.css" rel="stylesheet" type="text/css">
        <script>
            function convertCurrency() {
                var from = Document.getElementById("from").value;
                var to = Document.getElementById("to").value;
                var xmlhttp = new XMLHttpRequest();
                var url = "http://api.fixer.io/latest?symbols=" + from + "," + to;
                xmlhttp.open("GET", url, true);
                xmlhttp.send();
                xmlhttp.onreadystatechange = function() {
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var result = xmlhttp.responseText;
                        var jsResult = JSON.parse(result);
                        var oneUnit = jsResult.rates[to]/jsResult.rates[from];
                        var amt = document.getElementById("fromAmount").value;
                        document.getElementById("toAmount").value = (oneUnit*amt).toFixed(2);
                    }
                }
            }
        </script>
    </head>
    <body>
        <header>
            <nav class="nawigacja-menu">
                <div class="czesc-gorna">
                    <div class="logo">
                        Logo
                    </div>
                    <div class="logowanie-rejestracja">
                        Logowanie/Rejestracja
                    </div>
                </div>
                <div class="czesc-dolna">
                    <div class="strona-glowna">Strona główna</div>
                    <div class="kurs-walut">Kursy Walut</div>
                    <div class="kurs-kruszcow">Kursy Kruszców</div>
                    <div class="forum">Forum</div>
                </div>
            </nav>
        </header>

        <main>
            <div id="calculator">
                <h2 id="calculator-header">Currency converter</h2>
                <table id="calculator-table">
                    <tr>
                        <td><input id="fromAmount" type="text" value="100" onkeyup="convertCurrency();"></td>
                        <td>
                            <select id="from" onchange="convertCurrency();">
                                <option value="PLN" selected>Polski złoty (PLN)</option>
                                <option value="EUR">Euro (EUR)</option>
                                <option value="USD">Dolar amerykański (USD)</option>
                                <option value="GBP">Funt brytyjski (GBP)</option>
                                <option value="CHF">Frank szwajcarski (CHF)</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input id="toAmount" type="text" disabled></td>
                        <td>
                            <select id="to" onchange="convertCurrency();">
                                <option value="PLN" selected>Polski złoty (PLN)</option>
                                <option value="EUR">Euro (EUR)</option>
                                <option value="USD" selected>Dolar amerykański (USD)</option>
                                <option value="GBP">Funt brytyjski (GBP)</option>
                                <option value="CHF">Frank szwajcarski (CHF)</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt distinctio ipsam magnam molestias
                odit optio quae? Debitis fugiat incidunt ipsam ipsum magnam officiis omnis pariatur perspiciatis
                praesentium repudiandae! Inventore, obcaecati.
            </div>
            <div>Ab aliquam commodi cum deleniti dolore dolores eius est explicabo hic inventore ipsa laudantium, minus,
                nam natus nihil, nostrum officiis pariatur placeat porro quidem quod sequi suscipit totam ut voluptatum?
            </div>
            <div>Facilis illo ipsa vel! Accusantium, aspernatur blanditiis dignissimos eaque esse excepturi
                exercitationem expedita explicabo minima nam nobis quae quis quos reiciendis sit soluta tempora tenetur
                unde velit voluptas voluptate voluptates.
            </div>
            <div>Debitis doloremque dolorum facere inventore ipsa praesentium repellat. Adipisci aperiam assumenda
                commodi consequatur dicta doloremque dolores exercitationem facere illum minima nesciunt numquam odio,
                quibusdam quisquam ratione rerum sed similique ullam.
            </div>
            <div>Consectetur, delectus dolorum earum exercitationem harum illo ipsa modi nulla possimus quia quo sed
                veniam voluptate! Distinctio earum itaque iure minus nisi officia perspiciatis repudiandae vero. Optio
                possimus sequi ut!
            </div>
            <div>Ad aliquid aspernatur dolorum ea enim fugiat harum ipsam ipsum laboriosam magnam nam nemo nostrum
                numquam odio officia, optio quae quaerat quam qui recusandae reiciendis reprehenderit saepe sapiente
                suscipit temporibus.
            </div>
            <div>Aliquid consequuntur corporis dolore dolores libero modi necessitatibus officiis omnis quae quod quos
                recusandae sunt unde vitae, voluptatem. Assumenda commodi deleniti harum in magni obcaecati porro quidem
                reprehenderit tempora voluptates?
            </div>
            <div>Ad, aliquid consectetur cumque deserunt dolore ducimus esse harum laudantium libero natus non officia
                officiis quae quas similique vitae voluptatibus. Cum dicta et fugit odio pariatur, quasi quia recusandae
                reprehenderit.
            </div>
            <div>Aliquid ducimus error quis soluta voluptas. Animi architecto enim itaque odit quibusdam, similique sit
                tempore. Aperiam commodi consequatur distinctio eos explicabo nobis, nostrum, obcaecati omnis optio quas
                quos similique voluptas.
            </div>
            <div>Ad, debitis dicta distinctio dolore ea eum harum in inventore ipsa itaque maiores minima molestias
                mollitia nam neque nostrum, odit perspiciatis, quaerat quisquam repellendus sequi temporibus unde
                veritatis voluptate voluptatum.
            </div>
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt distinctio ipsam magnam molestias
                odit optio quae? Debitis fugiat incidunt ipsam ipsum magnam officiis omnis pariatur perspiciatis
                praesentium repudiandae! Inventore, obcaecati.
            </div>
            <div>Ab aliquam commodi cum deleniti dolore dolores eius est explicabo hic inventore ipsa laudantium, minus,
                nam natus nihil, nostrum officiis pariatur placeat porro quidem quod sequi suscipit totam ut voluptatum?
            </div>
            <div>Facilis illo ipsa vel! Accusantium, aspernatur blanditiis dignissimos eaque esse excepturi
                exercitationem expedita explicabo minima nam nobis quae quis quos reiciendis sit soluta tempora tenetur
                unde velit voluptas voluptate voluptates.
            </div>
            <div>Debitis doloremque dolorum facere inventore ipsa praesentium repellat. Adipisci aperiam assumenda
                commodi consequatur dicta doloremque dolores exercitationem facere illum minima nesciunt numquam odio,
                quibusdam quisquam ratione rerum sed similique ullam.
            </div>
            <div>Consectetur, delectus dolorum earum exercitationem harum illo ipsa modi nulla possimus quia quo sed
                veniam voluptate! Distinctio earum itaque iure minus nisi officia perspiciatis repudiandae vero. Optio
                possimus sequi ut!
            </div>
            <div>Ad aliquid aspernatur dolorum ea enim fugiat harum ipsam ipsum laboriosam magnam nam nemo nostrum
                numquam odio officia, optio quae quaerat quam qui recusandae reiciendis reprehenderit saepe sapiente
                suscipit temporibus.
            </div>
            <div>Aliquid consequuntur corporis dolore dolores libero modi necessitatibus officiis omnis quae quod quos
                recusandae sunt unde vitae, voluptatem. Assumenda commodi deleniti harum in magni obcaecati porro quidem
                reprehenderit tempora voluptates?
            </div>
            <div>Ad, aliquid consectetur cumque deserunt dolore ducimus esse harum laudantium libero natus non officia
                officiis quae quas similique vitae voluptatibus. Cum dicta et fugit odio pariatur, quasi quia recusandae
                reprehenderit.
            </div>
            <div>Aliquid ducimus error quis soluta voluptas. Animi architecto enim itaque odit quibusdam, similique sit
                tempore. Aperiam commodi consequatur distinctio eos explicabo nobis, nostrum, obcaecati omnis optio quas
                quos similique voluptas.
            </div>
            <div>Ad, debitis dicta distinctio dolore ea eum harum in inventore ipsa itaque maiores minima molestias
                mollitia nam neque nostrum, odit perspiciatis, quaerat quisquam repellendus sequi temporibus unde
                veritatis voluptate voluptatum.
            </div>
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt distinctio ipsam magnam molestias
                odit optio quae? Debitis fugiat incidunt ipsam ipsum magnam officiis omnis pariatur perspiciatis
                praesentium repudiandae! Inventore, obcaecati.
            </div>
            <div>Ab aliquam commodi cum deleniti dolore dolores eius est explicabo hic inventore ipsa laudantium, minus,
                nam natus nihil, nostrum officiis pariatur placeat porro quidem quod sequi suscipit totam ut voluptatum?
            </div>
            <div>Facilis illo ipsa vel! Accusantium, aspernatur blanditiis dignissimos eaque esse excepturi
                exercitationem expedita explicabo minima nam nobis quae quis quos reiciendis sit soluta tempora tenetur
                unde velit voluptas voluptate voluptates.
            </div>
            <div>Debitis doloremque dolorum facere inventore ipsa praesentium repellat. Adipisci aperiam assumenda
                commodi consequatur dicta doloremque dolores exercitationem facere illum minima nesciunt numquam odio,
                quibusdam quisquam ratione rerum sed similique ullam.
            </div>
            <div>Consectetur, delectus dolorum earum exercitationem harum illo ipsa modi nulla possimus quia quo sed
                veniam voluptate! Distinctio earum itaque iure minus nisi officia perspiciatis repudiandae vero. Optio
                possimus sequi ut!
            </div>
            <div>Ad aliquid aspernatur dolorum ea enim fugiat harum ipsam ipsum laboriosam magnam nam nemo nostrum
                numquam odio officia, optio quae quaerat quam qui recusandae reiciendis reprehenderit saepe sapiente
                suscipit temporibus.
            </div>
            <div>Aliquid consequuntur corporis dolore dolores libero modi necessitatibus officiis omnis quae quod quos
                recusandae sunt unde vitae, voluptatem. Assumenda commodi deleniti harum in magni obcaecati porro quidem
                reprehenderit tempora voluptates?
            </div>
            <div>Ad, aliquid consectetur cumque deserunt dolore ducimus esse harum laudantium libero natus non officia
                officiis quae quas similique vitae voluptatibus. Cum dicta et fugit odio pariatur, quasi quia recusandae
                reprehenderit.
            </div>
            <div>Aliquid ducimus error quis soluta voluptas. Animi architecto enim itaque odit quibusdam, similique sit
                tempore. Aperiam commodi consequatur distinctio eos explicabo nobis, nostrum, obcaecati omnis optio quas
                quos similique voluptas.
            </div>
            <div>Ad, debitis dicta distinctio dolore ea eum harum in inventore ipsa itaque maiores minima molestias
                mollitia nam neque nostrum, odit perspiciatis, quaerat quisquam repellendus sequi temporibus unde
                veritatis voluptate voluptatum.
            </div>
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt distinctio ipsam magnam molestias
                odit optio quae? Debitis fugiat incidunt ipsam ipsum magnam officiis omnis pariatur perspiciatis
                praesentium repudiandae! Inventore, obcaecati.
            </div>
            <div>Ab aliquam commodi cum deleniti dolore dolores eius est explicabo hic inventore ipsa laudantium, minus,
                nam natus nihil, nostrum officiis pariatur placeat porro quidem quod sequi suscipit totam ut voluptatum?
            </div>
            <div>Facilis illo ipsa vel! Accusantium, aspernatur blanditiis dignissimos eaque esse excepturi
                exercitationem expedita explicabo minima nam nobis quae quis quos reiciendis sit soluta tempora tenetur
                unde velit voluptas voluptate voluptates.
            </div>
            <div>Debitis doloremque dolorum facere inventore ipsa praesentium repellat. Adipisci aperiam assumenda
                commodi consequatur dicta doloremque dolores exercitationem facere illum minima nesciunt numquam odio,
                quibusdam quisquam ratione rerum sed similique ullam.
            </div>
            <div>Consectetur, delectus dolorum earum exercitationem harum illo ipsa modi nulla possimus quia quo sed
                veniam voluptate! Distinctio earum itaque iure minus nisi officia perspiciatis repudiandae vero. Optio
                possimus sequi ut!
            </div>
            <div>Ad aliquid aspernatur dolorum ea enim fugiat harum ipsam ipsum laboriosam magnam nam nemo nostrum
                numquam odio officia, optio quae quaerat quam qui recusandae reiciendis reprehenderit saepe sapiente
                suscipit temporibus.
            </div>
            <div>Aliquid consequuntur corporis dolore dolores libero modi necessitatibus officiis omnis quae quod quos
                recusandae sunt unde vitae, voluptatem. Assumenda commodi deleniti harum in magni obcaecati porro quidem
                reprehenderit tempora voluptates?
            </div>
            <div>Ad, aliquid consectetur cumque deserunt dolore ducimus esse harum laudantium libero natus non officia
                officiis quae quas similique vitae voluptatibus. Cum dicta et fugit odio pariatur, quasi quia recusandae
                reprehenderit.
            </div>
            <div>Aliquid ducimus error quis soluta voluptas. Animi architecto enim itaque odit quibusdam, similique sit
                tempore. Aperiam commodi consequatur distinctio eos explicabo nobis, nostrum, obcaecati omnis optio quas
                quos similique voluptas.
            </div>
            <div>Ad, debitis dicta distinctio dolore ea eum harum in inventore ipsa itaque maiores minima molestias
                mollitia nam neque nostrum, odit perspiciatis, quaerat quisquam repellendus sequi temporibus unde
                veritatis voluptate voluptatum.
            </div>
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt distinctio ipsam magnam molestias
                odit optio quae? Debitis fugiat incidunt ipsam ipsum magnam officiis omnis pariatur perspiciatis
                praesentium repudiandae! Inventore, obcaecati.
            </div>
            <div>Ab aliquam commodi cum deleniti dolore dolores eius est explicabo hic inventore ipsa laudantium, minus,
                nam natus nihil, nostrum officiis pariatur placeat porro quidem quod sequi suscipit totam ut voluptatum?
            </div>
            <div>Facilis illo ipsa vel! Accusantium, aspernatur blanditiis dignissimos eaque esse excepturi
                exercitationem expedita explicabo minima nam nobis quae quis quos reiciendis sit soluta tempora tenetur
                unde velit voluptas voluptate voluptates.
            </div>
            <div>Debitis doloremque dolorum facere inventore ipsa praesentium repellat. Adipisci aperiam assumenda
                commodi consequatur dicta doloremque dolores exercitationem facere illum minima nesciunt numquam odio,
                quibusdam quisquam ratione rerum sed similique ullam.
            </div>
            <div>Consectetur, delectus dolorum earum exercitationem harum illo ipsa modi nulla possimus quia quo sed
                veniam voluptate! Distinctio earum itaque iure minus nisi officia perspiciatis repudiandae vero. Optio
                possimus sequi ut!
            </div>
            <div>Ad aliquid aspernatur dolorum ea enim fugiat harum ipsam ipsum laboriosam magnam nam nemo nostrum
                numquam odio officia, optio quae quaerat quam qui recusandae reiciendis reprehenderit saepe sapiente
                suscipit temporibus.
            </div>
            <div>Aliquid consequuntur corporis dolore dolores libero modi necessitatibus officiis omnis quae quod quos
                recusandae sunt unde vitae, voluptatem. Assumenda commodi deleniti harum in magni obcaecati porro quidem
                reprehenderit tempora voluptates?
            </div>
            <div>Ad, aliquid consectetur cumque deserunt dolore ducimus esse harum laudantium libero natus non officia
                officiis quae quas similique vitae voluptatibus. Cum dicta et fugit odio pariatur, quasi quia recusandae
                reprehenderit.
            </div>
            <div>Aliquid ducimus error quis soluta voluptas. Animi architecto enim itaque odit quibusdam, similique sit
                tempore. Aperiam commodi consequatur distinctio eos explicabo nobis, nostrum, obcaecati omnis optio quas
                quos similique voluptas.
            </div>
            <div>Ad, debitis dicta distinctio dolore ea eum harum in inventore ipsa itaque maiores minima molestias
                mollitia nam neque nostrum, odit perspiciatis, quaerat quisquam repellendus sequi temporibus unde
                veritatis voluptate voluptatum.
            </div>
        </main>

        <footer>

        </footer>
    </body>
</html>