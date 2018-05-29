<div class="menu">
	<ul class="list">
        @if(Auth::user()->perfil_id == 1 || Auth::user()->perfil_id == 2)                                
            <li class="header">MENÚ  </li>
            <li class="active">
                <a href="/">
                    <i class="material-icons">home</i>
                    <span>Inicio</span>
                </a>
            </li>
        @endif
        @if(Auth::user()->perfil_id == 3)                               
            <li class="header">MENÚ  </li>
            <li>
                <a href="/aportes/create"><i class="material-icons">movie_creation</i>
                    <span>Aportes</span>
                </a>
            </li>
            <li>
                <a href="/contactenos"><i class="material-icons">message</i>
                    <span>Contactenos</span>
                </a>
            </li>
            <li>
                <a href="/notificaciones"><i class="material-icons">warning</i>
                    <span>Notificaciones</span>
                </a>
            </li>
            <li>
                <a href="/perfil"><i class="material-icons">person</i>
                    <span>Perfil</span>
                </a>
            </li>
        @endif
        @if(Auth::user()->perfil_id == 1)
        <li class="header">MENÚ APORTES</li>
        <li>
            <a href="/admin/aportes"><i class="material-icons">movie_creation</i>
                <span>Aportes</span>
            </a>
        </li>
        <li class="header">MENÚ ADMINISTRATIVO</li>
        <li>
            <a  class="menu-toggle">
                <i class="material-icons">people</i>
                <span>Adm. Usuarios</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="/admin/perfiles">
                        <span>- Perfiles de Usuarios</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/usuarios">
                        <span>- Usuarios</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a  class="menu-toggle">
                <i class="material-icons">assignment</i>
                <span>Bitacoras</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="/admin/bitacora_admin">
                        <span>Bitacora Administrador</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/bitacora_editor">
                        <span>Bitacora Editores</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a class="menu-toggle">
                <i class="material-icons">folder_open</i>
                <span>Contenidos</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="/admin/peliculas">
                        <span>- Películas</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/series">
                        <span>- Series</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/temporadas">
                        <span>- Temporadas</span>
                    </a>
                </li>
            </ul>
        </li>      
        <li>
            <a class="menu-toggle">
                <i class="material-icons">settings</i>
                <span>Configuraciones</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="/admin/audios">- Audios</a>
                </li>
                <li>
                    <a href="/admin/categorias">- Categorías</a>
                </li>
                <li>
                    <a href="/admin/etiquetas">- Etiquetas</a>
                </li>
                <li>
                    <a href="/admin/formatos">- Formatos Video</a>
                </li>
                <li>
                    <a href="/admin/generos">- Generos</a>
                </li>
                <li>
                    <a href="/admin/idiomas">- Idiomas</a>
                </li>
                <li>
                    <a href="/admin/motivos">- Motivos</a>
                </li>
                <li>
                    <a href="/admin/tipos_notificaciones">- Tipos de Notificaciones</a>
                </li>
                <li>
                    <a href="/admin/paises">- Paises</a>
                </li>
                <li>
                    <a href="/admin/resoluciones">- Resoluciones</a>
                </li>
                <li>
                    <a href="/admin/sanciones">- Sanciones</a>
                </li>
                <li>
                    <a href="/admin/servidores">- Servidores</a>
                </li>
                <li>
                    <a href="/admin/tamanos">- Tamaños</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="/admin/mensajes"><i class="material-icons">mail</i>
                <span>Mensajes</span>
            </a>
        </li>
        <li>
            <a class="menu-toggle">
                <i class="material-icons">widgets</i>
                <span>Widgets</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="/admin/tipos_widgets">
                        <span>- Tipos de Widget</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/widgets">
                        <span>- Widgets</span>
                    </a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</div>