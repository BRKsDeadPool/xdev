<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6">
                <h5 class="white-text">Sua ajuda é muito importante!</h5>
                <p class="grey-text text-lighten-4">Nós precisamos da sua ajuda pra tornar o XFind ainda melhor!
                    Veja ao lado algumas das formas de nos ajudar a melhorar.</p>
            </div>
            <div class="col l4 offset-l2">
                <h5 class="white-text">Apoie-nos!</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!">Reporte Erros</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Envie Duvidas</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Envie Sugestões</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Participe do XFind</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © {{ date('Y') }} XFind - Todos os Direitos Reservados
            <a class="grey-text text-lighten-4 right" href="#!">Mais Links</a>
        </div>
    </div>
</footer>

<div class="navbar-fixed-bottom">
    <nav>
        <div class="nav-wrapper">
            <div class="row">
                <div class="col l4">
                    <ul class="nav-mobile" class="center hide-on-med-and-down">
                        <li><a class="waves-effect waves-light" href="{{ url('/chat') }}"><span class="mif" style="position: relative;top: 10px;">chat_bubble</span></a></li>
                    </ul>
                </div>
                <div class="col l4">
                    <div class="row">
                        <div class="col l12">
                            <form class="search" action="{{ url('/search') }}">
                                <div class="row col l12 input-field">
                                    <span class="prefix mdi mdi-account-search"></span>
                                    <input type="text" name="term" id="term" class="search_term" placeholder="Digite o que deseja encontrar">
                                </div>
                                <button hidden type="submit"></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col l4">
                    @include('components.new-post')
                </div>
            </div>
        </div>
    </nav>
</div>