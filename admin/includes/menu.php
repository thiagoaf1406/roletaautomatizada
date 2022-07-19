            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="<?=ADMIN?>">
                                <span class="icon-holder">
                                    <i class="anticon anticon-setting"></i>
                                </span>
                                <span class="title">Painel de Tarefas</span>
                            </a>
                        </li>
                        <? if($super == 'Sim'){ ?>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fas fa-users-cog"></i>
                                </span>
                                <span class="title">Administradores</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li <?=$ativa == 'Admin' ? 'class="active"' : ''?> >
                                    <a href="admins/admin">Novo</a>
                                </li>
                                <li <?=$ativa == 'Admins' ? 'class="active"' : ''?> >
                                    <a href="admins/">Gerenciar</a>
                                </li>
                            </ul>
                        </li>
                        <? } ?>
                        <? if($super == 'Sim'){ ?>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-sliders"></i>
                                </span>
                                <span class="title">Evolution</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li <?=$ativa == 'Evolution Estratégias' ? 'class="active"' : ''?> >
                                    <a href="evolution/estrategias">Estratégias</a>
                                </li>
                                <li <?=$ativa == 'Evolution Layout' ? 'class="active"' : ''?> >
                                    <a href="evolution/layout">Layout</a>
                                </li>
                                <li <?=$ativa == 'Evolution Roletas' ? 'class="active"' : ''?> >
                                    <a href="evolution/roletas">Roletas</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-sliders"></i>
                                </span>
                                <span class="title">Playtech</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li <?=$ativa == 'Playtech Estratégias' ? 'class="active"' : ''?> >
                                    <a href="playtech/estrategias">Estratégias</a>
                                </li>
                                <li <?=$ativa == 'Playtech Layout' ? 'class="active"' : ''?> >
                                    <a href="playtech/layout">Layout</a>
                                </li>
                                <li <?=$ativa == 'Playtech Roletas' ? 'class="active"' : ''?> >
                                    <a href="playtech/roletas">Roletas</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-sliders"></i>
                                </span>
                                <span class="title">Pragmatic</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li <?=$ativa == 'Pragmatic Estratégias' ? 'class="active"' : ''?> >
                                    <a href="pragmatic/estrategias">Estratégias</a>
                                </li>
                                <li <?=$ativa == 'Pragmatic Layout' ? 'class="active"' : ''?> >
                                    <a href="pragmatic/layout">Layout</a>
                                </li>
                                <li <?=$ativa == 'Pragmatic Roletas' ? 'class="active"' : ''?> >
                                    <a href="pragmatic/roletas">Roletas</a>
                                </li>
                            </ul>
                        </li>
                        <? } ?>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-share-alt"></i>
                                </span>
                                <span class="title">Grupos</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li <?=$ativa == 'Grupo' ? 'class="active"' : ''?> >
                                    <a href="grupos/grupo">Novo</a>
                                </li>
                                <li <?=$ativa == 'Grupos' ? 'class="active"' : ''?> >
                                    <a href="grupos">Grupos</a>
                                </li>
                            </ul>
                        </li>
                        <? if($super == 'Sim'){ ?>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="sistema">
                                <span class="icon-holder">
                                    <i class="anticon anticon-code"></i>
                                </span>
                                <span class="title">Sistema</span>
                            </a>
                        </li>
                        <? } ?>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="fas fa-user"></i>
                                </span>
                                <span class="title">Usuários</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li <?=$ativa == 'Usuário' ? 'class="active"' : ''?> >
                                    <a href="usuarios/usuario">Novo</a>
                                </li>
                                <li <?=$ativa == 'Usuários' ? 'class="active"' : ''?> >
                                    <a href="usuarios/">Gerenciar</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="logout">
                                <span class="icon-holder">
                                    <i class="anticon anticon-logout"></i>
                                </span>
                                <span class="title">Sair</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>