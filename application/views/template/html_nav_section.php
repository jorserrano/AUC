

<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-light bg-gradient-x-grey-blue">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a href="index.html" class="navbar-brand">
                        <h3 class="brand-text">AUC</h3>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="fa fa-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div id="navbar-mobile" class="collapse navbar-collapse">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="ft-menu"></i></a></li>

                    <li class="nav-item d-none d-md-block"><a href="<?= $url ?>/AUCReportes" class="nav-link ">Sistemas de Reportería</a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
                <span class="avatar avatar-online">
                  <img src="app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span>
                            <span class="user-name"><?php echo "Usuario Registrado" ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
<!--                            -->
<!--                            <a href="#" class="dropdown-item"><i class="ft-user"></i> Edit Profile</a>-->
<!--                            -->
<!--                            <div class="dropdown-divider"></div>-->

                            <form  action="<?= $url ?>/Indicadores/index" method="post">
                                <input type="hidden" value="1" name="salir" />
                                <button type="submit" class="btn btn-cyan dropdown-item" style="margin-left: 1rem;">
                                    <i class="ft-power"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
