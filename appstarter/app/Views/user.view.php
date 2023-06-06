<main class="account">
    <div id="top" class="account-container leaderboard">
        <div class="leaderboard-container">
            <table class="leaderboard-table">
                <caption>Top Scores</caption>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $counter = 1;
                        foreach ($top as $score){ 
                    ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
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
        <div class="leaderboard-container">
            <table class="leaderboard-table">
                <caption>New Scores</caption>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $counter = 1;
                        foreach ($new as $score){ 
                    ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
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
        <div class="account-mod-container">
            <form class="username-mod">
                <div class="tittle">
                    <h2>CAMBIAR NOMBRE DE USUARIO</h2>
                </div>
                <div class="mod-inputs">
                    <input placeholder="Nuevo nombre de usuario" type="text">
                    <input type="submit" name="submitLogin" value="Cambiar"></td>
                </div>
            </form>
            <form class="password-mod">
                <div class="tittle">
                    <h2>CAMBIAR CONTRASEÑA</h2>
                </div>
                <div class="mod-inputs">
                    <input placeholder="Contraseña actual" type="password">
                    <input placeholder="Nueva contraseña" type="password">
                    <input type="submit" name="submitLogin" value="Cambiar"></td>
                </div>
            </form>
            <form class="delete-account">
                <div class="tittle">
                    <h2>BORRAR CUENTA</h2>
                </div>
                <div class="mod-inputs">
                    <input placeholder="Contraseña actual" type="password">
                    <input type="submit" name="submitLogin" value="Borrar"></td>
                </div>
            </form>
        </div>
    </div>
</main>