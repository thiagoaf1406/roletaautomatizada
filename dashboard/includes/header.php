
            <div class="header">
                <div class="logo logo-dark" style="overflow:hidden;">
                    <a href="<?=DASHBOARD?>">
                        <img src="<?=ADMIN?>assets/images/logo/<?=$sistema->logo?>" style="width:60%;" alt="<?=TITULO?>">
                        <img class="logo-fold" src="<?=ADMIN?>assets/images/logo/<?=$sistema->logo?>" alt="<?=TITULO?>">
                    </a>
                </div>
                <div class="logo logo-white" style="overflow:hidden;">
                    <a href="<?=DASHBOARD?>">
                        <img src="<?=ADMIN?>assets/images/logo/<?=$sistema->logo?>" style="width:60%;" alt="<?=TITULO?>">
                        <img class="logo-fold" src="<?=ADMIN?>assets/images/logo/<?=$sistema->logo?>" alt="<?=TITULO?>">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image  m-h-10 m-r-15">
                                    <img src="<?=URL?>imagens/usuarios/default.png"  alt="">
                                </div>
                            </div>
                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex m-r-50">
                                        <div class="m-l-10">
                                            <p class="m-b-0 text-dark font-weight-semibold"><?=$nome?></p>
                                            <p class="m-b-0 opacity-07"><?=$sobrenome?></p>
                                        </div>
                                    </div>
                                </div>
                                <a href="perfil" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                            <span class="m-l-10">Editar Perfil</span>
                                        </div>
                                    </div>
                                </a>
                                <a href="logout" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">Sair</span>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>    