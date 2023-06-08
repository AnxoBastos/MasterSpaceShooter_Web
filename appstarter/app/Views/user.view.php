<main class="account">
    <div class="account-container leaderboard">
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
                        if(!empty($top)){
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
                        if(!empty($new)){
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
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="account-mod-container">
            <form action="/username" method="post" class="username-mod">
                <div class="tittle">
                    <h2>CAMBIAR NOMBRE DE USUARIO</h2>
                </div>
                <div class="mod-inputs">
                    <input placeholder="Nuevo nombre de usuario" type="text" name="newUsername">
                    <input type="submit" name="submitUsername" value="Cambiar"></td>
                </div>
                <?php if( isset($updateUsernameError) ){ ?>
                    <div class="error-container">
                        <span><?php echo $updateUsernameError ?></span>
                    </div>
                <?php } ?>
            </form>
            <form action="/password" method="post" class="password-mod">
                <div class="tittle">
                    <h2>CAMBIAR CONTRASEÑA</h2>
                </div>
                <div class="mod-inputs">
                    <input placeholder="Contraseña actual" type="password" name="actualPassword">
                    <input placeholder="Nueva contraseña" type="password" name="newPassword">
                    <input type="submit" name="submitPassword" value="Cambiar"></td>
                </div>
                <?php if( isset($updatePasswordError) ){ ?>
                    <div class="error-container">
                        <span><?php echo $updatePasswordError ?></span>
                    </div>
                <?php } ?>
            </form>
            <form action="/delete" method="post" class="delete-account">
                <div class="tittle">
                    <h2>BORRAR CUENTA</h2>
                </div>
                <div class="mod-inputs">
                    <input placeholder="Contraseña actual" type="password" name="password">
                    <input type="submit" name="submitDelete" value="Borrar"></td>
                </div>
            </form>
        </div>
    </div>
</main>