 <!-- Inicio Navbar -->
 <nav class="navbar">
        <div class="navbar-content">
            <div class="bars">
                <i class="fa-solid fa-bars"></i>
            </div>
            <img src="<?= URLADM;?>app/adms/assets/image/logo/logo.png" alt="Celke" class="logo">
        </div>

        <div class="navbar-content">
           

            <div class="avatar">
            <?php 
                        
                if((!empty($_SESSION['user_image'])) 
                            and (file_exists("app/adms/assets/image/users/"  . $_SESSION['user_id'] . $_SESSION['user_image'])))
                        {
                                echo  "<img src='".URLADM."app/adms/assets/image/users/"
                                .$_SESSION['user_id'] . "/" .$_SESSION['user_image']. "' width='40' height='40'><br><br>";
                        }else{
                            echo  "<img src='".URLADM."app/adms/assets/image/users/user.png' width='40' height='40'>";
                        }
            ?>
                <div class="dropdown-menu setting">
                    <a href="<?= URLADM ; ?>view-profile/index" class="item">
                        <span class="fa-solid fa-user"></span>
                        Perfil
                    </a>
                        
                    </a>
                    <a href="<?= URLADM ; ?>edit-profile/index" class="item">
                        <span class="fa-solid fa-gear"></span> Editar Perfil
                    </a>
                    <a href="<?= URLADM ; ?>logout/index" class="item">
                        <span class="fa-solid fa-arrow-right-from-bracket"></span> Sair
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Fim Navbar -->