<main class="main">
    <div id="history" class="main-container">
        <div><p>Desde hace una decada se han empezado a avistar alienigenas en el espacio y han comenzado a atacar tierra. Tu mision es elimar al mayor número de naves alienigenas posible sin ser derrotado. Esperamos tu regreso en la estación espacial, ¡Demuestranos de que estas hecho soldado!</p></div>
        <div><img src="assets/img/MainImg1.jpg" alt=""></div>
    </div>
    <div id="game" class="main-container">
        <div><img src="assets/img/MainImg2.jpg" alt=""></div>
        <div><p>En este juego te haras con el control de una nave de ultima generación con la que tendras que derrotar a los diferentes tipos de alienigenas que se encuentran en el espacio, la nave cuenta con multiples mejoras como numero de disparos, resistencia del escudo, velocidad, etc. Sacale el mejor partido a tu nave y enseñanos tus habilidades en combate.</p></div>
    </div>
    <div id="help" class="main-container">
        <div><p>El juego es totalmente Free-to-Play pero dejaremos un enlace donde podrás <a href="">aportar</a> a una buena causa. Todo el dinero generado se donara a la fundación <a href="https://www.juegaterapia.org/" target="_blank">Juegaterapia</a>, en esta fundación ayudan a los niños enfermos de cancer a tener una estancía mucho mas amena en los hospitales a traves de los videojuegos.</p></div>
        <div class="img-container"><img src="assets/img/MainImg3.jpg" alt=""></div>
    </div>
    <div id="leaderboard" class="main-container leaderboard">
        <div class="leaderboard-container">
            <table class="leaderboard-table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $counter = 1;
                        foreach ($scores as $score){ 
                    ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td><?php echo $score['username']; ?></td>
                                <td><?php echo $score['score']; ?></td>
                                <td><?php echo date('d-m-y', $score['date']); ?></td>
                            </tr>
                    <?php
                            $counter++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div><p>Las mejores puntuaciones se mostraran en este leaderboard. Esfuerzate y da lo mejor de ti para mostrarle a tu amigos quien es el mejor. ¡Enseñale al mundo de lo que eres capaz!</p></div>
    </div>
</main>